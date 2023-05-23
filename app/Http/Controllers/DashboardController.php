<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AllergyReport;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = DB::table('users')->where('position_id', '=', '1')->count();
        $tanggal = date('Y-m-d');
        $tanggal_jumat = date('Y-m-d', strtotime("next Friday", strtotime($tanggal)));
        // mendapatkan tanggal hari Sabtu
        $tanggal_sabtu = date('Y-m-d', strtotime("next Saturday", strtotime($tanggal)));

        $makan_pagi = DB::table('laporan_makanan')
            ->whereJsonContains('waktu_makan', ['Pagi'])
            ->where('is_makan', 1)
            ->whereRaw('DAYNAME(tanggal) = ?', ['Friday'])
            ->count();
        $makan_siang = DB::table('laporan_makanan')
            ->whereJsonContains('waktu_makan', ['Siang'])
            ->where('is_makan', 1)
            ->whereRaw('DAYNAME(tanggal) = ?', ['Friday'])
            ->count();
        $makan_malam = DB::table('laporan_makanan')
            ->whereJsonContains('waktu_makan', ['Malam'])
            ->where('is_makan', 1)
            ->whereRaw('DAYNAME(tanggal) = ?', ['Friday'])
            ->count();

        $pagi_sabtu = DB::table('laporan_makanan')
            ->whereJsonContains('waktu_makan', ['Pagi'])
            ->where('is_makan', 1)
            ->whereRaw('DAYNAME(tanggal) = ?', ['Saturday'])
            ->count();
        $siang_sabtu = DB::table('laporan_makanan')
            ->whereJsonContains('waktu_makan', ['Siang'])
            ->where('is_makan', 1)
            ->whereRaw('DAYNAME(tanggal) = ?', ['Saturday'])
            ->count();
        $malam_sabtu = DB::table('laporan_makanan')
            ->whereJsonContains('waktu_makan', ['Malam'])
            ->where('is_makan', 1)
            ->whereRaw('DAYNAME(tanggal) = ?', ['Saturday'])
            ->count();
        $approvedData = AllergyReport::where('approved', 1)
            ->selectRaw('COUNT(*) as count, MONTH(created_at) as month')
            ->groupBy('month')
            ->get();
        $pendingData = AllergyReport::where('approved', 0)
            ->selectRaw('COUNT(*) as count, MONTH(created_at) as month')
            ->groupBy('month')
            ->get();


        return view('dashboard.index', [
            "title" => "Dashboard",
            "positionCount" => Position::count(),
            "userCount" => $userCount,
            "makan_pagi" => $makan_pagi,
            "makan_siang" => $makan_siang,
            "makan_malam" => $makan_malam,
            "pagi_sabtu" => $pagi_sabtu,
            "siang_sabtu" => $siang_sabtu,
            "malam_sabtu" => $malam_sabtu,
            "approvedData" => $approvedData,
            "pendingData" => $pendingData
        ]);
    }
}
