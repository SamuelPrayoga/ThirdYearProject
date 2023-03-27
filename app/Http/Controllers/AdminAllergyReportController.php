<?php

namespace App\Http\Controllers;

use App\Models\AllergyReport;
use Illuminate\Http\Request;
use App\Events\AllergyReportApproved;
use App\Events\AllergyReportCreated;

class AdminAllergyReportController extends Controller
{
    public function show()
    {
        $title = "Laporan Mahasiswa Alergi";
        $reports = AllergyReport::all();
        // $pendingReportsCount = AllergyReport::where('status', 0)->count();
        // event(new AllergyReportCreated($allergyReport));
        return view('allergy_reports.show', compact('reports', 'title'));
    }

    public function showSidebar()
    {
        $jumlah = AllergyReport::where('status', 0)->count();
        return view('partials.sidebar', compact('jumlah'));
    }


    // public function show()
    // {
    //     $title = "Laporan Mahasiswa Alergi";
    //     $reports = AllergyReport::all();
    //     // event(new AllergyReportCreated($allergyReport));
    //     return view('allergy_reports.show', compact('reports', 'title'));
    // }

    public function approve(AllergyReport $report)
    {
        $report->approved = true;

        $report->save();

        return redirect()->back()->with('success', 'Laporan alergi berhasil disetujui.');
    }
    public function reject(AllergyReport $report)
    {
        $report->delete();

        return redirect()->back()->with('success', 'Laporan alergi berhasil ditolak.');
    }
}
