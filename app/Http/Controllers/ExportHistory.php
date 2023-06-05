<?php

namespace App\Http\Controllers;

use PDF;
use Excel;
use App\Models\Presence;
use Illuminate\Http\Request;

class ExportHistory extends Controller
{
    public function export(Request $request)
    {
        $title = "Histori Makan";
        $history = Presence::all();
        $priodDate = $request->priod_date;

        // Export to PDF
        if ($request->has('pdf')) {
            $pdf = PDF::loadView('history.pdf', compact('history', 'priodDate','title'))->setPaper('a4', 'landscape');
            return $pdf->download('history.pdf');
        }

        // Export to Excel
        if ($request->has('excel')) {
            $data = [];
            $no = 1;

            foreach ($priodDate as $date) {
                $histo = $history->where('presence_date', $date)->first();

                if (!$histo) {
                    $data[] = [
                        'No' => $no++,
                        'Tanggal' => $date,
                        'Waktu Masuk' => '',
                        'Waktu Selesai' => '',
                        'Status' => $date == now()->toDateString() ? 'Belum Makan' : 'Tidak Makan'
                    ];
                } else {
                    $data[] = [
                        'No' => $no++,
                        'Tanggal' => $histo->presence_date,
                        'Waktu Masuk' => $histo->presence_enter_time . ' WIB',
                        'Waktu Selesai' => $histo->presence_out_time ? $histo->presence_out_time . ' WIB' : 'Belum Pulang',
                        'Status' => $histo->is_permission ? 'Izin' : 'Makan'
                    ];
                }
            }

            return Excel::download(new HistoryExport($data), 'history.xlsx');
        }
    }

    public function pdf(Request $request)
    {
        $title = "Histori Makan";
        $priodDate = $request->priod_date;
        $history = Presence::all();

        $pdf = PDF::loadView('history.pdf', compact('priodDate', 'history','title'));
        return $pdf->stream('history.pdf');
    }
}
