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
        $feedback = new Feedback;
        $feedback->user_id = $req->UserID;
        $feedback->date = $req->date;
        $feedback->value_rating = $req->value_rating;
        $feedback->subject_review = $req->subject_review;
        $feedback->description = $req->description;
        if ($req->hasFile('file') && $req->file('file')->isValid()) {
            $fileExtension = $req->file('file')->extension();
            if (in_array($fileExtension, ['jpeg', 'jpg', 'png', 'gif'])) {
                $user_id = auth()->user()->id; // Ambil id user yang sedang login
                $file = $req->file('file')->getClientOriginalName();
                $unique_file_name = $user_id . '_' . time() . '_' . $file;
                $req->file('file')->move(public_path('img/Feedback/' . $user_id), $unique_file_name);
                $feedback->file = $unique_file_name;
            } else {
                return redirect()->back()->with('error', 'File harus berupa gambar (jpeg, jpg, png, gif)');
            }
        }
        $feedback->save();
        return redirect()->back()->with('message', 'Feedback berhasil dikirimkan!');
        // if ($req->hasFile('file') && $req->file('file')->isValid()) {
        //     $fileExtension = $req->file('file')->extension();
        //     if (in_array($fileExtension, ['jpeg', 'jpg', 'png', 'gif'])) {
        //         $file = $req->file('file')->getClientOriginalName();
        //         $req->file('file')->move('img/Feedback', $file);
        //         $feedback->file = $file;
        //     } else {
        //         return redirect()->back()->with('error', 'File harus berupa gambar (jpeg, jpg, png, gif)');
        //     }
        // }
        // $feedback->save();
        // return redirect()->back()->with('message', 'Feedback berhasil dikirimkan!');
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
        // $feedbacks = DB::table('feedback')->get();
        // "title" => "Kritik dan Saranku";
        // return view('home.feedbackku', ['feedback' => $feedbacks]);
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
