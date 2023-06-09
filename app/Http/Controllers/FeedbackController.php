<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function create(Request $req)
    {
        // Ambil user_id dan tanggal hari ini
        $user_id = $req->UserID;
        // $today = date('Y-m-d');

        // Cek apakah user sudah mengisi feedback pada hari ini
        // $existingFeedback = Feedback::where('user_id', $user_id)->where('date', $today)->first();
        // if ($existingFeedback) {
        //     return redirect()->back()->with('error', 'Gagal! Anda sudah mengisi Feedback pada hari ini. Feedback dapat diisi hanya sekali dalam sehari');
        // }

        // Buat instance baru Feedback
        $feedback = new Feedback;
        $feedback->user_id = $user_id;
        $feedback->date = $req->date;
        // $feedback->date = $today;
        $feedback->value_rating = $req->value_rating;
        $feedback->subject_review = $req->subject_review;
        $feedback->description = $req->description;

        // Cek apakah file valid
        if ($req->hasFile('file') && $req->file('file')->isValid()) {
            $fileExtension = $req->file('file')->extension();
            if (in_array($fileExtension, ['jpeg', 'jpg', 'png', 'gif'])) {
                $file = $req->file('file')->getClientOriginalName();
                $unique_file_name = $user_id . '_' . time() . '_' . $file;
                $req->file('file')->move(public_path('img/Feedback/' . $user_id), $unique_file_name);
                $feedback->file = $unique_file_name;
            } else {
                return redirect()->back()->with('error', 'File harus berupa gambar (jpeg, jpg, png, gif)');
            }
        }

        // Simpan feedback ke database
        $feedback->save();

        return redirect()->back()->with('toast_success', 'Kritik dan Saran berhasil Dikirimkan');
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

    public function forbidden(Request $request)
    {
        return view('home.forbidden', [
            "title" => "Restricted"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $feedbacks = DB::table('feedback')->get();
        return view('home.feedbackku', [
            "title" => "Kritik dan Saranku",
            "feedback" => $feedbacks
        ]);
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
    public function destroy($id)
    {
        $feedback = Feedback::find($id); // Mengambil data laporan alergi berdasarkan ID
        if ($feedback) {
            $feedback->delete(); // Menghapus data laporan alergi dari database
            return redirect()->back()->with('toast_success', 'Feedback berhasil dihapus.'); // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        } else {
            return redirect()->back()->with('toast_error', 'Feedback tidak ditemukan.'); // Redirect kembali ke halaman sebelumnya dengan pesan error
        }
    }

    public function showAll()
    {
        $feedbacks = Feedback::with('user')->get();
        return view('feedback.index', [
            "title" => "Kritik dan Saran",
            "feedbacks" => $feedbacks // Mengganti key "feedback" menjadi "feedbacks"
        ]);
    }
}
