<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('attendances.index', [
            "title" => "Presensi Makan"
        ]);
    }

    public function create()
    {
        return view('attendances.create', [
            "title" => "Tambah Data Presensi Makan"
        ]);
    }

    public function edit()
    {
        return view('attendances.edit', [
            "title" => "Edit Data Presensi Makan",
            "attendance" => Attendance::findOrFail(request('id'))
        ]);
    }
}
