<?php

namespace App\Http\Controllers;

use App\Models\LaporMakan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class LaporMakanController extends Controller
{

    public function index()
    {
        $title = "Laporan Mahasiswa Makan Jumat-Sabtu";
        $laporan_makanan = LaporMakan::all();
        return view('LapMakan.index', compact('title', 'laporan_makanan'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'waktu_makan' => 'required|array',
            'is_makan' => 'required|boolean'
        ]);

        $user_id = auth()->user()->id;
        $tanggal = $request->input('tanggal');

        // Mengosongkan tabel laporan_makanan pada database setiap minggunya
        DB::table('laporan_makanan')->whereRaw('DATEDIFF(CURDATE(), created_at) >= 7')->delete();

        $laporan_makanan = LaporMakan::where('user_id', $user_id)
            ->whereDate('tanggal', $tanggal)
            ->first();

        if ($laporan_makanan) {
            return redirect()->back()->with('toast_error', 'Mohon Maaf, Anda sudah mengisi laporan pemberitahuan makan untuk Besok Hari');
        }

        $laporan_makanan = new LaporMakan();
        $laporan_makanan->user_id = $user_id;
        $laporan_makanan->tanggal = $tanggal;
        // $laporan_makanan->waktu_makan = implode(", ", $request->input('waktu_makan'));
        $laporan_makanan->waktu_makan = json_encode($request->input('waktu_makan'));
        $laporan_makanan->is_makan = $request->input('is_makan');
        $laporan_makanan->save();

        return redirect()->back()->with('toast_success', 'Terimakasih! Laporan Pemberitahuan Anda Telah Disampaikan');
    }

    public function hapusSemuaLaporan()
    {
        LaporMakan::truncate();

        return redirect()->back()->with('success', 'Semua laporan telah dihapus.');
    }


    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'tanggal' => 'required|date',
    //         'waktu_makan' => 'required|array',
    //         'is_makan' => 'required|boolean'
    //     ]);

    //     $user_id = auth()->user()->id;
    //     $tanggal = $request->input('tanggal');

    //     $laporan_makanan = LaporMakan::where('user_id', $user_id)
    //         ->whereDate('tanggal', $tanggal)
    //         ->first();

    //     if ($laporan_makanan) {
    //         return redirect()->back()->with('toast_error', 'Mohon Maaf, Anda sudah mengisi laporan pemberitahuan makan untuk Besok Hari');
    //     }

    //     $laporan_makanan = new LaporMakan();
    //     $laporan_makanan->user_id = $user_id;
    //     $laporan_makanan->tanggal = $tanggal;
    //     // $laporan_makanan->waktu_makan = implode(", ", $request->input('waktu_makan'));
    //     $laporan_makanan->waktu_makan = json_encode($request->input('waktu_makan'));
    //     $laporan_makanan->is_makan = $request->input('is_makan');
    //     $laporan_makanan->save();

    //     return redirect()->back()->with('toast_success', 'Terimakasih! Laporan Pemberitahuan Anda Telah Disampaikan');
    // }
}
