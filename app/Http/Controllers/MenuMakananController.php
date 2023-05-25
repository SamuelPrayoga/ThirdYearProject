<?php

namespace App\Http\Controllers;


use App\Models\MenuMakanan;
use Illuminate\Http\Request;

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
        $validatedData = $request->validate([
            'tanggal_makan' => 'required|date',
            'menu' => 'required|string'
        ]);
        // Access the submitted form values
        $tanggal_makan = $validatedData['tanggal_makan'];
        $menu = $validatedData['menu'];

        $newMenu = new MenuMakanan();
        $newMenu->tanggal_makan = $tanggal_makan;
        $newMenu->menu = $menu;
        $newMenu->save();
        return redirect('menumakan/index')->with('toast_success', 'Menu Makanan berhasil ditambahkan');
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
