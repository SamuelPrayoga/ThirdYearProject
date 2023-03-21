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

         if ($req->hasFile('file')) {
             $file = $req->file('file');
             // Get the file extension
             $extension = $file->getClientOriginalExtension();
             // Only allow image extensions

             if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                 $fileName = time() . '.' . $extension;
                 $path = $file->storeAs('public/img/Feedback', $fileName);
                 // Remove the 'public/' prefix to get the public path
                 $publicPath = str_replace('public/', '', $path);
                 $feedback->file = $publicPath;
             } else {
                 return redirect()->back()->with('error', 'Submit Form Gagal! Hanya file yang berekstensi .jpg .jpeg .png .gif yang diizinkan.');
             }
         }

         $feedback->save();
         return redirect()->back()->with('message', 'Feedback berhasil dikirimkan!');
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
