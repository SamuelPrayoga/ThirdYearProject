<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function index()
    {
        return view('holidays.index', [
            "title" => "Izin Sakit"
        ]);
    }

    public function create()
    {
        return view('holidays.create', [
            "title" => "Tambah Data Izin Sakit"
        ]);
    }

    public function edit()
    {
        $ids = request('ids');
        if (!$ids)
            return redirect()->back();
        $ids = explode('-', $ids);

        $holidays = Holiday::query()
            ->whereIn('id', $ids)
            ->get();

        return view('holidays.edit', [
            "title" => "Edit Data Izin Sakit",
            "holidays" => $holidays
        ]);
    }
}
