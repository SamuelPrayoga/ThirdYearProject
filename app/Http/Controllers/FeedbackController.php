<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.feedback', [
            "title" => "Kritik dan Saran"
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create(Request $req)
    // {
    //     // Generate a unique token and store it in the session
    //     $token = Str::random(32);
    //     session(['form_token' => $token]);

    //     // Check if the form has already been submitted
    //     if ($req->input('form_token') !== session('form_token')) {
    //         return redirect()->back()->with('error', 'Form already submitted.');
    //     }

    //     // return $req->file('file')->store()
    //     $feedback = new Feedback;
    //     $feedback->nama = $req->nama;
    //     $feedback->nim = $req->nim;
    //     $feedback->tanggal_ulasan = $req->tanggal_ulasan;
    //     $feedback->nilai_rating = $req->nilai_rating;
    //     $feedback->subjek_ulasan = $req->subjek_ulasan;
    //     $feedback->deskripsi = $req->deskripsi;

    //     if ($req->hasFile('file')) {
    //         $file = $req->file('file');
    //         // Get the file extension
    //         $extension = $file->getClientOriginalExtension();
    //         // Only allow image extensions
    //         if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
    //             $fileName = time() . '.' . $extension;
    //             $file->move('img/Feedback', $fileName);
    //             $feedback->file = $fileName;
    //         } else {
    //             return redirect()->back()->with('error', 'Only image files are allowed.');
    //         }
    //     }

    //     $feedback->save();

    //     // Remove the token from the session
    //     session()->forget('form_token');

    //     return redirect()->back()->with('message', 'Feedback berhasil dikirimkan!');
    // }
    public function create(Request $req)
    {
        // return $req->file('file')->store()
        $feedback = new Feedback;
        $feedback->nama = $req->nama;
        $feedback->nim = $req->nim;
        $feedback->tanggal_ulasan = $req->tanggal_ulasan;
        $feedback->nilai_rating = $req->nilai_rating;
        $feedback->subjek_ulasan = $req->subjek_ulasan;
        $feedback->deskripsi = $req->deskripsi;

        if ($req->hasFile('file')) {
            $file = $req->file('file');
            // Get the file extension
            $extension = $file->getClientOriginalExtension();
            // Only allow image extensions
            if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                $fileName = time() . '.' . $extension;
                $path = $file->storeAs('public/img/Feedback', $fileName);
                $feedback->file = $path;
            } else {
                return redirect()->back()->with('error', 'Submit Form Gagal! Hanya file yang berekstensi .jpg .jpeg .png .gif yang diizinkan.');
            }
            // if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
            //     $fileName = time() . '.' . $extension;
            //     $file->move('img/Feedback', $fileName);
            //     $feedback->file = $fileName;
            // } else {
            //     return redirect()->back()->with('error', 'Submit Form Gagal! Hanya file yang berekstensi .jpg .jpeg .png .gif yang diizinkan.');
            // }
        }

        $feedback->save();
        return redirect()->back()->with('message', 'Feedback berhasil dikirimkan!');
        // return redirect()->back()->with('success', 'Your message here.');
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
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        //
    }
}
