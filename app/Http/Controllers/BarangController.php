<?php

namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.barang', [
            "title" => "Laporan"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        // // Calculate the expiry date (4 days from now)
        $expiryDate = date('Y-m-d', strtotime('+3 days'));

        // If the user has not submitted a form today, create a new report
        $barang = new Barang;
        $barang->user_id = $req->UserID;
        $barang->name = $req->name;
        $barang->kategori = $req->kategori;
        $barang->description = $req->description;
        $barang->expiry_date = $expiryDate;
        if ($req->hasFile('file')) {
            try {
                $file = $req->file('file');
                if (in_array($file->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif'])) {
                    $filename = $file->getClientOriginalName();
                    $file->move('img/Barang', $filename);
                    $barang->file = $filename;
                } else {
                    return response()->json(['error' => 'File yang dimasukkan bukan file gambar.'], 400);
                }
            } catch (\Throwable $th) {
                return redirect()->back()->withInput();
            }
        }
        $barang->save();
        return redirect()->route('home.pengumuman')->with('toast_success', 'Laporan berhasil dikirimkan');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, barang $barang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(barang $barang)
    {
        //
    }
}
