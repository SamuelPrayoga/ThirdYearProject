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
        $title = "Laporan Mahasiswa Izin Bermalam";
        $laporan_makanan = LaporMakan::all();
        return view('LapMakan.index', compact('title', 'laporan_makanan'));
    }

    public function show()
    {
        $title = "Lapor dan Request Izin Bermalam";
        $izin_bermalam = LaporMakan::where('user_id', auth()->user()->id)->get();
        return view('LapMakan.show', compact('title', 'izin_bermalam'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'tanggal_berangkat' => 'required|date',
            'jam_berangkat' => 'required',
            'tanggal_kembali' => 'required|date',
            'jam_kembali' => 'required',
        ]);

        $previousLaporMakan = LaporMakan::where('user_id', $request->input('UserID'))
            ->where('is_makan', 0)
            ->first();

        if ($previousLaporMakan) {
            return redirect()->back()->with('error', 'Data laporan Anda sebelumnya belum dikonfirmasi. Silahkan tunggu konfirmasi sebelum membuat laporan baru.');
        }

        $laporMakan = new LaporMakan();
        $laporMakan->user_id = $request->input('UserID');
        $laporMakan->tanggal_berangkat = $request->input('tanggal_berangkat');
        $laporMakan->jam_berangkat = $request->input('jam_berangkat');
        $laporMakan->tanggal_kembali = $request->input('tanggal_kembali');
        $laporMakan->jam_kembali = $request->input('jam_kembali');
        $laporMakan->save();

        return redirect()->back()->with('info', 'Terimakasih! Laporan dan Permintaan Izin Bermalam Anda dikirimkan, Silahkan Tunggu Konfirmasi Keasramaan');
    }

    public function edit(Request $request, $id)
    {
        // Validasi input jika diperlukan
        $request->validate([
            'tanggal_berangkat' => 'required',
            'jam_berangkat' => 'required',
            'tanggal_kembali' => 'required',
            'jam_kembali' => 'required',
        ]);

        // Temukan data izin berdasarkan ID
        $izin_bermalam = LaporMakan::findOrFail($id);

        // Update data izin
        $izin_bermalam->tanggal_berangkat = $request->tanggal_berangkat;
        $izin_bermalam->jam_berangkat = $request->jam_berangkat;
        $izin_bermalam->tanggal_kembali = $request->tanggal_kembali;
        $izin_bermalam->jam_kembali = $request->jam_kembali;
        $izin_bermalam->save();

        // Redirect ke halaman yang diinginkan setelah update
        return redirect()->back()->with('success', 'Data berhasil diupdate.');
    }


    public function hapusSemuaLaporan()
    {
        LaporMakan::truncate();

        return redirect()->back()->with('success', 'Semua laporan telah dihapus.');
    }

    public function approved($id)
    {
        $lapor_makan = LaporMakan::find($id);

        if ($lapor_makan) {
            $lapor_makan->is_makan = 1;
            $lapor_makan->save();

            return redirect()->back()->with('success', 'Laporan Izin Bermalam Berhasil disetujui.');
        }

        return redirect()->back()->with('error', 'Data Barang tidak ditemukan.');
    }

    public function decline($id)
    {
        $lapor_makan = LaporMakan::find($id);

        if ($lapor_makan) {
            $lapor_makan->is_makan = 2;
            $lapor_makan->save();

            return redirect()->back()->with('success', 'Laporan Izin Bermalam Berhasil ditolak.');
        }

        return redirect()->back()->with('error', 'Data Barang tidak ditemukan.');
    }
}
