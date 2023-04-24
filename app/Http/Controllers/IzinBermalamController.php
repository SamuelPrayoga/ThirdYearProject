<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\IzinBermalam;
use Illuminate\Support\Carbon;

class IzinBermalamController extends Controller
{
    public function showFormIB()
    {
        $attendance = Attendance::all();
        $title = "Laporkan Izin Bermalam";
        return view('IzinBermalam.create', compact('title','attendance'));
    }

    public function showIndex()
    {
        $user = auth()->user(); // Ambil user yang sedang login
        $title = "Laporkan Izin Bermalamku";
        $izinBermalams = IzinBermalam::where('user_id', $user->id)->get(); // Ambil semua Izin Bermalam yang disubmit oleh user tersebut
        return view('IzinBermalam.index', compact('title', 'izinBermalams'));
    }

    public function create(Request $request)
    {
        $attendance = Attendance::all();
        $today = Carbon::today();
        $dateToDisallow = $today->subDays(2);

        if ($request->keberangkatan <= $dateToDisallow) {
            return redirect()->back()->withErrors(['error' => 'Anda tidak bisa mengajukan izin bermalam untuk tanggal ini']);
        }

        $izinBermalam = new IzinBermalam([
            'attendance_id' => $request->attendance_id,
            'user_id' => $request->user_id,
            'keberangkatan' => $request->keberangkatan,
            'kedatangan' => $request->kedatangan,
            'alasan' => $request->alasan,
        ]);

        $izinBermalam->save();

        return redirect()->route('home.indexIB')->with('success', 'Izin bermalam berhasil diajukan');
    }

    public function approve(IzinBermalam $izinBermalam)
    {
        $izinBermalam->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Izin bermalam telah disetujui.');
    }

    public function reject(IzinBermalam $izinBermalam)
    {
        $izinBermalam->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Izin bermalam telah ditolak.');
    }
}
