<?php

namespace App\Http\Controllers;

use App\Models\AllergyReport;
use Illuminate\Http\Request;

class AllergyReportController extends Controller
{
    public function index()
    {
        $reports = AllergyReport::all();
        $title = "Alergi Makanan";
        return view('allergy_reports.index', compact('reports','title'));
    }

    public function create()
    {
        $title = "Lapor Alergi";
        return view('allergy_reports.create', compact('title'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'food_type' => 'required|string',
            'approved' => 'boolean',
        ]);

        AllergyReport::create($validatedData);

        return redirect()->route('home.allergy_reports.index')
            ->with('success', 'Allergy report created successfully.');
    }

    public function edit(AllergyReport $report)
    {
        return view('allergy_reports.edit', compact('report'));
    }

    public function update(Request $request, AllergyReport $report)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'food_type' => 'required|string',
            'approved' => 'boolean',
        ]);

        $report->update($validatedData);

        return redirect()->route('home.allergy_reports.index')
            ->with('success', 'Allergy report updated successfully.');
    }

    public function destroy(AllergyReport $report)
    {
        $report->delete();

        return redirect()->route('home.allergy_reports.index')
            ->with('success', 'Allergy report deleted successfully.');
    }
}
