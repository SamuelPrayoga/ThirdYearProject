<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Feedback;
use App\Models\Holiday;
use App\Models\Permission;
use App\Models\LaporMakan;
use App\Models\Pengumuman;
use App\Models\Presence;
use App\Models\User;
use Carbon\CarbonPeriod;
// use Illuminate\Support\Carbon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index()
    {
        $endDate = now()->addDays(1)->toDateString();

        $announce = Pengumuman::where('published', 1)
            ->whereBetween('tanggal_pembuatan', [now()->toDateString(), $endDate])
            ->get();

        $title = "Beranda";

        $today = now()->toDateString();
        $laporan_makanan = LaporMakan::where('created_at', 'like', "$today%")
            ->where('user_id', auth()->id())
            ->first();

        $show_laporkan_makan = true;

        $attendances = Attendance::query()
            // ->with('positions')
            ->forCurrentUser(auth()->user()->position_id)
            ->get()
            ->sortByDesc('data.is_end')
            ->sortByDesc('data.is_start');

        return view('home.index', compact('announce', 'attendances', 'title', 'show_laporkan_makan', 'laporan_makanan'));
    }

    public function show(Attendance $attendance)
    {

        $presences = Presence::query()
            ->where('attendance_id', $attendance->id)
            ->where('user_id', auth()->user()->id)
            ->get();

        $isHasEnterToday = $presences
            ->where('presence_date', now()->toDateString())
            ->isNotEmpty();

        $isTherePermission = Permission::query()
            ->where('permission_date', now()->toDateString())
            ->where('attendance_id', $attendance->id)
            ->where('user_id', auth()->user()->id)
            ->first();

        // $tanggalSekarang = Carbon::now()->toDateString(); // Mendapatkan tanggal saat ini
        // $jamSekarang = Carbon::now()->toTimeString(); // Mendapatkan waktu saat ini

        // $izinIB = LaporMakan::where('is_makan', 1)
        //     ->whereDate('tanggal_berangkat', '<=', $tanggalSekarang)
        //     ->whereDate('tanggal_kembali', '>=', $tanggalSekarang)
        //     ->where(function ($query) use ($jamSekarang) {
        //         $query->whereTime('jam_berangkat', '<=', $jamSekarang)
        //             ->whereTime('jam_kembali', '>=', $jamSekarang);
        //     })
        //     ->latest('created_at')
        //     ->first();

        $data = [
            'is_has_enter_today' => $isHasEnterToday, // sudah absen masuk
            'is_not_out_yet' => $presences->where('presence_out_time', null)->isNotEmpty(), // belum absen pulang
            'is_there_permission' => (bool) $isTherePermission,
            'is_permission_accepted' => $isTherePermission?->is_accepted ?? false,
        ];

        $holiday = $attendance->data->is_holiday_today ? Holiday::query()
            ->where('holiday_date', now()->toDateString())
            ->first() : false;

        $history = Presence::query()
            ->where('user_id', auth()->user()->id)
            ->where('attendance_id', $attendance->id)
            ->get();

        // untuku melihat mahasiswa yang tidak hadir
        $priodDate = CarbonPeriod::create($attendance->created_at->toDateString(), now()->toDateString())
            ->toArray();

        foreach ($priodDate as $i => $date) { // get only stringdate
            $priodDate[$i] = $date->toDateString();
        }

        $priodDate = array_slice(array_reverse($priodDate), 0, 30);

        // $alasanTolak = Permission(Attendance $attendance, Permission $isTherePermission);

        return view('home.show', [
            "title" => "Informasi Kehadiran Makan",
            "attendance" => $attendance,
            "data" => $data,
            "holiday" => $holiday,
            'history' => $history,
            'priodDate' => $priodDate,
            // 'izinIB' => $izinIB,
            // 'isIB' => $isIB,
            // 'alasanTolak' => $alasanTolak,
        ]);
    }
    public function permission(Attendance $attendance)
    {
        return view('home.permission', [
            "title" => "Form Permintaan Izin",
            "attendance" => $attendance
        ]);
    }


    public function sendEnterPresenceUsingQRCode()
    {
        $code = request('code');
        $attendance = Attendance::query()->where('code', $code)->first();

        if ($attendance && $attendance->data->is_start && $attendance->data->is_using_qrcode) { // sama (harus) dengan view
            // fix: user bisa presensi makan dengan tanggal yang sama, cek apakah user id attendance id dan presence date sudah ada
            Presence::create([
                "user_id" => auth()->user()->id,
                "attendance_id" => $attendance->id,
                "presence_date" => now()->toDateString(),
                "presence_enter_time" => now()->toTimeString(),
                "presence_out_time" => null
            ]);

            return response()->json([
                "success" => true,
                "message" => "Kehadiran atas nama '" . auth()->user()->name . "' berhasil dikirim."
            ]);
        }

        return response()->json([
            "success" => false,
            "message" => "Terjadi masalah pada saat melakukan presensi Makan."
        ], 400);
    }

    public function sendOutPresenceUsingQRCode()
    {
        $code = request('code');
        $attendance = Attendance::query()->where('code', $code)->first();

        if (!$attendance)
            return response()->json([
                "success" => false,
                "message" => "Terjadi masalah pada saat melakukan presensi Makan."
            ], 400);

        // jika presensi makan sudah jam pulang (is_end) dan tidak menggunakan qrcode (kebalikan)
        if (!$attendance->data->is_end && !$attendance->data->is_using_qrcode) // sama (harus) dengan view
            return false;

        $presence = Presence::query()
            ->where('user_id', auth()->user()->id)
            ->where('attendance_id', $attendance->id)
            ->where('presence_date', now()->toDateString())
            ->where('presence_out_time', null)
            ->first();

        if (!$presence) // hanya untuk sekedar keamanan (kemungkinan)
            return response()->json([
                "success" => false,
                "message" => "Terjadi masalah pada saat melakukan presensi."
            ], 400);

        // untuk refresh if statement
        $this->data['is_not_out_yet'] = false;
        $presence->update(['presence_out_time' => now()->toTimeString()]);

        return response()->json([
            "success" => true,
            "message" => "Atas nama '" . auth()->user()->name . "' berhasil melakukan presensi pulang makan."
        ]);
    }
}
