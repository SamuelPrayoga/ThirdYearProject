<?php

namespace App\Http\Controllers;

use App\Models\AllergyReport;
use Illuminate\Http\Request;

class AdminAllergyReportController extends Controller
{
    public function show()
    {
        $title = "Laporan Mahasiswa Alergi";
        $reports = AllergyReport::all();

        return view('allergy_reports.show', compact('reports', 'title'));
    }

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
