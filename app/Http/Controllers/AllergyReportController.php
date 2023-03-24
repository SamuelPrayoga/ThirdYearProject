<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\AllergyReport;
use Carbon\Carbon;

class AllergyReportController extends Controller
{
    public function index()
    {
        $reports = Auth::user()->allergyReports;
        $title = "Laporan Alergi";

        return view('allergy_reports.index', compact('reports', 'title'));
    }

    public function create()
    {
        $title = "Laporan Alergi";
        return view('allergy_reports.create', compact('title'));
    }

    public function store(Request $request)
    {
        $lastSubmission = AllergyReport::where('user_id', Auth::id())->orderBy('created_at', 'desc')->first();

        if ($lastSubmission) {
            $threeMonthsAgo = Carbon::now()->subMonths(3);
            if ($lastSubmission->created_at->greaterThanOrEqualTo($threeMonthsAgo)) {
                $nextSubmissionDate = $lastSubmission->created_at->addMonths(3)->format('d M Y');
                return redirect()->back()->with('error', 'Anda hanya dapat mengirimkan laporan alergi sekali dalam 3 bulan. Anda dapat mengirimkan laporan berikutnya pada tanggal ' . $nextSubmissionDate . '.');
            }
        }

        $report = new AllergyReport([
            'user_id' => Auth::id(),
            'allergies' => implode(', ', $request->input('allergies')),
        ]);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            if (is_array($file)) {
                foreach ($file as $f) {
                    if (in_array($f->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif', 'pdf'])) {
                        $filename = $f->getClientOriginalName();
                        $f->move('img/allergy_reports', $filename);
                        $report->file = $filename;
                    } else {
                        return redirect()->back()->with('error', 'File yang dimasukkan bukan file gambar atau pdf.');
                    }
                }
            } else {
                if (in_array($file->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif', 'pdf'])) {
                    $filename = $file->getClientOriginalName();
                    $file->move('img/allergy_reports', $filename);
                    $report->file = $filename;
                } else {
                    return redirect()->back()->with('error', 'File yang dimasukkan bukan file gambar atau pdf.');
                }
            }
        }

        $report->save();
        return redirect()->back()->with('message', 'Laporan Alergi Anda berhasil dikirimkan!');
    }
    // public function store(Request $request)
    // {
    //     $report = new AllergyReport([
    //         'user_id' => Auth::id(),
    //         'allergies' => implode(', ', $request->input('allergies')),
    //     ]);
    //     if ($request->hasFile('file')) {
    //         $file = $request->file('file');
    //         if (is_array($file)) {
    //             foreach ($file as $f) {
    //                 if (in_array($f->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif', 'pdf'])) {
    //                     $filename = $f->getClientOriginalName();
    //                     $f->move('img/allergy_reports', $filename);
    //                     $report->file = $filename;
    //                 } else {
    //                     return response()->json(['error' => 'File yang dimasukkan bukan file gambar atau pdf.'], 400);
    //                 }
    //             }
    //         } else {
    //             if (in_array($file->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif', 'pdf'])) {
    //                 $filename = $file->getClientOriginalName();
    //                 $file->move('img/allergy_reports', $filename);
    //                 $report->file = $filename;
    //             } else {
    //                 return response()->json(['error' => 'File yang dimasukkan bukan file gambar atau pdf.'], 400);
    //             }
    //         }
    //     }

    //     $report->save();
    //     return redirect()->back()->with('message', 'Laporan Anda berhasil dikirimkan!');
    // }

    // public function store(Request $request)
    // {
    //     $report = new AllergyReport([
    //         'user_id' => Auth::id(),
    //         'allergies' => implode(', ', $request->input('allergies')),
    //     ]);
    //     if ($request->hasFile('file')) {
    //         $file = $request->file('file');
    //         if (in_array($file->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif','pdf'])) {
    //             $filename = $file->getClientOriginalName();
    //             $file->move('img/allergy_reports', $filename);
    //             $report->file = $filename;
    //         } else {
    //             return response()->json(['error' => 'File yang dimasukkan bukan file gambar atau pdf.'], 400);
    //         }
    //     }

    //     $report->save();
    //     // return redirect()->route('home.allergy-reports.index')->with('success', 'Laporan alergi berhasil disimpan.');
    //     return redirect()->back()->with('message', 'Laporan Anda berhasil dikirimkan!');
    // }
}
