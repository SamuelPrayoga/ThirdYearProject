<?php

namespace App\Http\Controllers;


use App\Models\MenuMakanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MenuMakananController extends Controller
{
    public function index()
    {
        $menumakan = MenuMakanan::query()->get();

        // $menumakan = DB::table('tb_user')->get();
        return view('menumakan.index', [
            "title" => "Menu Makanan Civitas",
            "menumakan" => $menumakan
        ]);
    }

    public function show()
    {
        $menumakan = MenuMakanan::query()->get();

        // $menumakan = DB::table('tb_user')->get();
        return view('admin.menumakan.index', [
            "title" => "Menu Makanan Civitas Institut Teknologi Del",
            "menumakan" => $menumakan
        ]);
    }

    public function create()
    {
        $menumakan = MenuMakanan::query()->get();

        // $menumakan = DB::table('tb_user')->get();
        return view('admin.menumakan.create', [
            "title" => " Tambah Menu Makanan",
        ]);
    }

    public function createmenus(Request $request)
    {
        $menus = new MenuMakanan();
        $menus->tanggal_makan = $request->tanggal_makan;
        $menus->menu_pagi = $request->menu_pagi;
        $menus->menu_siang = $request->menu_siang;
        $menus->menu_malam = $request->menu_malam;
        $menus->save();

        if ($request->hasFile('foto1')) {
            $foto1 = $request->file('foto1');
            $filename1 = time() . '_foto1.' . $foto1->getClientOriginalExtension();
            $foto1->move('public/menu_makanan', $filename1);
            // Simpan nama file ke database jika diperlukan
            $menus->foto1 = $filename1;
        }

        if ($request->hasFile('foto2')) {
            $foto2 = $request->file('foto2');
            $filename2 = time() . '_foto2.' . $foto2->getClientOriginalExtension();
            $foto2->move('public/menu_makanan', $filename2);
            // Simpan nama file ke database jika diperlukan
            $menus->foto2 = $filename2;
        }

        if ($request->hasFile('foto3')) {
            $foto3 = $request->file('foto3');
            $filename3 = time() . '_foto3.' . $foto3->getClientOriginalExtension();
            $foto3->move('public/menu_makanan', $filename3);
            // Simpan nama file ke database jika diperlukan
            $menus->foto3 = $filename3;
        }

        $menus->save();

        return redirect('menumakan/index')->with('success', 'Menu Makanan berhasil ditambahkan');
    }



    public function edit($id)
    {
        $editmenus = MenuMakanan::find($id);

        return view('admin.menumakan.edit', compact('editmenus'), [
            "title" => " Edit Menu Makanan",
        ]);
    }

    public function updatemenus(Request $request, $id)
    {
        $update = MenuMakanan::find($id);

        $update->tanggal_makan = $request->tanggal_makan;
        $update->menu_pagi = $request->menu_pagi;
        $update->menu_siang = $request->menu_siang;
        $update->menu_malam = $request->menu_malam;

        if ($request->hasFile('foto1')) {
            $foto1 = $request->file('foto1');
            $filename1 = time() . '_foto1.' . $foto1->getClientOriginalExtension();
            $foto1->move('public/menu_makanan', $filename1);
            // Remove the old file if exists
            if ($update->foto1) {
                $oldFile1 = public_path('menu_makanan/' . $update->foto1);
                if (file_exists($oldFile1)) {
                    unlink($oldFile1);
                }
            }
            $update->foto1 = $filename1;
        }

        if ($request->hasFile('foto2')) {
            $foto2 = $request->file('foto2');
            $filename2 = time() . '_foto2.' . $foto2->getClientOriginalExtension();
            $foto2->move('public/menu_makanan', $filename2);
            // Remove the old file if exists
            if ($update->foto2) {
                $oldFile2 = public_path('menu_makanan/' . $update->foto2);
                if (file_exists($oldFile2)) {
                    unlink($oldFile2);
                }
            }
            $update->foto2 = $filename2;
        }

        if ($request->hasFile('foto3')) {
            $foto3 = $request->file('foto3');
            $filename3 = time() . '_foto3.' . $foto3->getClientOriginalExtension();
            $foto3->move('public/menu_makanan', $filename3);
            // Remove the old file if exists
            if ($update->foto3) {
                $oldFile3 = public_path('menu_makanan/' . $update->foto3);
                if (file_exists($oldFile3)) {
                    unlink($oldFile3);
                }
            }
            $update->foto3 = $filename3;
        }

        $update->save();

        return redirect('menumakan/index')->with('success', 'Menu Makanan berhasil diubah');
    }


    public function delete($id)
    {
        $menumakan = MenuMakanan::find($id);
        if ($menumakan->delete()) {
            return redirect()->back()->with('success', 'Menu Makanan berhasil dihapus');
        }
    }
}
