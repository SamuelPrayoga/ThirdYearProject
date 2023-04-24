<?php

namespace App\Http\Controllers;

use App\Models\AllergyReport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;

class ReportController extends Controller
{
    public function exportExcel()
    {
        $reports = AllergyReport::select('id', 'user_id', 'allergies', 'approved')
        ->with(['user' => function ($query) {
            $query->select('id', 'name', 'nim', 'asrama');
        }])
        ->get();
        // $reports = AllergyReport::all(); // ganti dengan model yang sesuai
        return Excel::download(new ReportExport($reports), 'alergi_report.xlsx'); // ReportExport adalah class yang akan dibuat pada langkah selanjutnya
    }
}
