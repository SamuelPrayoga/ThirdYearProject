<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BarangController;
use App\Models\Pengumuman;

class PengumumanController extends Controller
{

    public function index()
    {
        $perPage = 10;
        $today = date('Y-m-d');
        $pengumuman = DB::table('barangs')
            ->orderBy('kategori')
            ->orderBy('expiry_date', 'desc')
            ->where('showed', 1) // Menampilkan hanya pengumuman dengan nilai showed=1
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
            ->where('showed', 1) // Menampilkan hanya pengumuman dengan nilai showed=1
            ->where('expiry_date', '<', $today) // hanya menampilkan pengumuman yang telah diarsipkan
            ->paginate($perPage);

        return view('home.pengumuman-arsip', [
            "title" => "Pengumuman diarsipkan",
            "pengumumanArsip" => $pengumumanArsip
        ]);
    }

    public function show()
    {
        $pengumuman = DB::table('pengumumen')->get();

        return view('pengumuman.index', [
            "title" => "Pengumuman",
            "pengumuman" => $pengumuman
        ]);
    }
    public function create()
    {
        $title = "Tambah Pengumuman";
        return view('pengumuman.create', compact('title'));
    }

    public function store(Request $request)
    {
        $pengumuman = new Pengumuman;
        $pengumuman->tanggal_pembuatan = now();
        $pengumuman->tanggal_berakhir = $request->tanggal_berakhir;
        $pengumuman->deskripsi = $request->deskripsi;
        $pengumuman->save();

        return redirect()->route('pengumuman.index')
            ->with('toast_success', 'Pengumuman Berhasil Ditambahkan!');
    }

    public function edit($id)
    {
        $pengumuman = Pengumuman::find($id);
        $title = "Edit Pengumuman";
        return view('pengumuman.edit', compact('pengumuman', 'title'));
    }
    public function update(Request $request, $id)
    {
        $title = "Edit Pengumuman";
        $pengumuman = Pengumuman::find($id);
        $pengumuman->deskripsi = $request->input('deskripsi');
        $pengumuman->tanggal_berakhir = $request->input('tanggal_berakhir');
        $pengumuman->save();

        return redirect()->route('pengumuman.index')->with('toast_success', 'Pengumuman berhasil diubah');
    }
    #####
    public function publish($id)
    {
        $pengumuman = Pengumuman::find($id);

        if ($pengumuman) {
            $pengumuman->published = 1;
            $pengumuman->save();

            return redirect()->back()->with('toast_success', 'Pengumuman berhasil dipublikasikan.');
        }

        return redirect()->back()->with('toast_error', 'Pengumuman tidak ditemukan.');
    }
    #####
    public function notPublished($id)
    {
        $pengumuman = Pengumuman::find($id);

        if ($pengumuman) {
            $pengumuman->published = 0;
            $pengumuman->save();

            return redirect()->back()->with('toast_success', 'Pengumuman berhasil disembunyikan.');
        }

        return redirect()->back()->with('toast_error', 'Pengumuman tidak ditemukan.');
    }

    public function showAnnounce()
    {
        $announce = DB::table('pengumumen')->where('published', 1)->get();
        return view('home.index', [
            "announce" => $announce
        ]);
    }

    public function destroy($id)
    {
        $pengumuman = Pengumuman::find($id);
        $pengumuman->delete();

        return redirect()->route('pengumuman.index')->with('toast_success', 'Pengumuman berhasil dihapus');
    }
}
