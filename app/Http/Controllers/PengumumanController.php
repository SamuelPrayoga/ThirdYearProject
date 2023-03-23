<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BarangController;

class PengumumanController extends Controller
{
    public function index()
    {
        $perPage = 10;
        $pengumuman = DB::table('barangs')
            ->orderBy('kategori')
            ->orderBy('expiry_date', 'desc')
            ->paginate($perPage);

        return view('home.pengumuman', [
            "title" => "Pengumuman",
            "pengumuman" => $pengumuman
        ]);
    }
}
