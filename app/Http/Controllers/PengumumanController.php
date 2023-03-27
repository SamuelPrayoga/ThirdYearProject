<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BarangController;

class PengumumanController extends Controller
{
    // public function index()
    // {
    //     $perPage = 10;
    //     $pengumuman = DB::table('barangs')
    //         ->orderBy('kategori')
    //         ->orderBy('expiry_date', 'desc')
    //         ->paginate($perPage);

    //     return view('home.pengumuman', [
    //         "title" => "Pengumuman",
    //         "pengumuman" => $pengumuman
    //     ]);
    // }
    public function index()
    {
        $perPage = 10;
        $today = date('Y-m-d');
        $pengumuman = DB::table('barangs')
            ->orderBy('kategori')
            ->orderBy('expiry_date', 'desc')
            ->whereDate('expiry_date', '>=', $today) // hanya menampilkan pengumuman yang belum kadaluarsa
            ->paginate($perPage);

        return view('home.pengumuman', [
            "title" => "Pengumuman",
            "pengumuman" => $pengumuman
        ]);
    }

    public function pengumumanArsip()
    {
        $perPage = 10;
        $today = date('Y-m-d');
        $pengumumanArsip = DB::table('barangs')
            ->orderBy('kategori')
            ->orderBy('expiry_date', 'desc')
            ->where('expiry_date', '<', $today) // hanya menampilkan pengumuman yang telah diarsipkan
            ->paginate($perPage);

        return view('home.pengumuman-arsip', [
            "title" => "Pengumuman diarsipkan",
            "pengumumanArsip" => $pengumumanArsip
        ]);
    }
}
