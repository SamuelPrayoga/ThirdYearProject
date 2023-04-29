<?php

namespace App\Http\Controllers;

use App\Models\LaporMakan;
use Illuminate\Http\Request;

class LaporMakanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'waktu_makan' => 'required|array',
            'is_makan' => 'required|boolean'
        ]);

        $user_id = auth()->user()->id;
        $tanggal = $request->input('tanggal');

        $laporan_makanan = LaporMakan::where('user_id', $user_id)
            ->whereDate('tanggal', $tanggal)
            ->first();

        if ($laporan_makanan) {
            return redirect()->back()->with('toast_error', 'Mohon Maaf, Anda sudah mengisi laporan pemberitahuan makan untuk Besok Hari');
        }

        $laporan_makanan = new LaporMakan();
        $laporan_makanan->user_id = $user_id;
        $laporan_makanan->tanggal = $tanggal;
        $laporan_makanan->waktu_makan = implode(", ", $request->input('waktu_makan'));
        $laporan_makanan->is_makan = $request->input('is_makan');
        $laporan_makanan->save();

        return redirect()->back()->with('toast_success', 'Terimakasih! Laporan Pemberitahuan Anda Telah Disampaikan');
    }
}
