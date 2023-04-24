<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\AllergyReport;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

        $report = new AllergyReport([
            'user_id' => Auth::id(),
            'allergies' => json_encode($request->input('allergies')),

        ]);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            if (is_array($file)) {
                foreach ($file as $f) {
                    if (in_array($f->getClientOriginalExtension(), ['doc', 'docx', 'pdf', 'img', 'png', 'jpeg', 'jpg'])) {
                        $filename = $f->getClientOriginalName();
                        $f->move('allergy_reports', $filename);
                        $report->file = $filename;
                    } else {
                        return redirect()->back()->with('error', 'File yang dimasukkan bukan file dokumen atau pdf.');
                    }
                }
            } else {
                if (in_array($file->getClientOriginalExtension(), ['doc', 'docx', 'pdf', 'img', 'png', 'jpeg', 'jpg'])) {
                    $filename = $file->getClientOriginalName();
                    $file->move('img/allergy_reports', $filename);
                    $report->file = $filename;
                } else {
                    return redirect()->back()->with('error', 'File yang dimasukkan bukan file dokumen atau pdf.');
                }
            }
        }
        $allergies = $request->input('allergies');


        $report->save();
        return redirect()->back()->with('message', 'Laporan Alergi Anda berhasil dikirimkan!');
    }

    public function show()
    {
        $title = "Laporan Mahasiswa Alergi";
        $reports = AllergyReport::get();
        $countAllergiesSeafood = DB::table('allergy_reports')
            ->whereJsonContains('allergies', ['Seafood'])
            ->where('Approved', 1)
            ->count();


        $countAllergiesTelur = DB::table('allergy_reports')
            ->whereJsonContains('allergies', ['Telur'])
            ->where('Approved', 1)
            ->count();

        $countAllergiesPedas = DB::table('allergy_reports')
            ->whereJsonContains('allergies', ['Makanan Pedas'])
            ->where('Approved', 1)
            ->count();

        return view('allergy_reports.show', compact('reports', 'title', 'countAllergiesSeafood', 'countAllergiesTelur', 'countAllergiesPedas'));
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

    public function rekapAlergi()
    {
        $title = "Rekapitulasi Makanan Alergi dan Prakiraan Masakan";
        $reports = AllergyReport::get();
        $countAllergiesSeafood = DB::table('allergy_reports')
            ->whereJsonContains('allergies', ['Seafood'])
            ->where('Approved', 1)
            ->count();

        $userCount = DB::table('users')->where('position_id', '=', '1')->count();

        $countAllergiesTelur = DB::table('allergy_reports')
            ->whereJsonContains('allergies', ['Telur'])
            ->where('Approved', 1)
            ->count();

        $countAllergiesPedas = DB::table('allergy_reports')
            ->whereJsonContains('allergies', ['Makanan Pedas'])
            ->where('Approved', 1)
            ->count();
        $countAllergiesLele = DB::table('allergy_reports')
            ->whereJsonContains('allergies', ['Ikan Lele'])
            ->where('Approved', 1)
            ->count();
        $countAllergiesLaut = DB::table('allergy_reports')
            ->whereJsonContains('allergies', ['Ikan Laut'])
            ->where('Approved', 1)
            ->count();
        $countAllergiesDagingSapi = DB::table('allergy_reports')
            ->whereJsonContains('allergies', ['Daging Kerbau/Sapi/Kambing'])
            ->where('Approved', 1)
            ->count();
        $countAllergiesDagingAyam = DB::table('allergy_reports')
            ->whereJsonContains('allergies', ['Daging Ayam'])
            ->where('Approved', 1)
            ->count();
        $countAllergiesIkanMas = DB::table('allergy_reports')
            ->whereJsonContains('allergies', ['Ikan Mas'])
            ->where('Approved', 1)
            ->count();
        $countAllergiesDaunSingkong = DB::table('allergy_reports')
            ->whereJsonContains('allergies', ['Daun Singkong'])
            ->where('Approved', 1)
            ->count();
        $countAllergiesTerung = DB::table('allergy_reports')
            ->whereJsonContains('allergies', ['Terung Hijau'])
            ->where('Approved', 1)
            ->count();
        $countAllergiesKikil = DB::table('allergy_reports')
            ->whereJsonContains('allergies', ['Kikil'])
            ->where('Approved', 1)
            ->count();
        $countAllergiesKedelai = DB::table('allergy_reports')
            ->whereJsonContains('allergies', ['Kacang Kedelai (Tahu/Tempe)'])
            ->where('Approved', 1)
            ->count();
        $countAllergiesKacang = DB::table('allergy_reports')
            ->whereJsonContains('allergies', ['Kacang-Kacangan'])
            ->where('Approved', 1)
            ->count();
        $countAllergiesMujahir = DB::table('allergy_reports')
            ->whereJsonContains('allergies', ['Ikan Mujahir'])
            ->where('Approved', 1)
            ->count();
        $countAllergiesNenas = DB::table('allergy_reports')
            ->whereJsonContains('allergies', ['Nenas'])
            ->where('Approved', 1)
            ->count();
        $countAllergiesPepaya = DB::table('allergy_reports')
            ->whereJsonContains('allergies', ['Pepaya'])
            ->where('Approved', 1)
            ->count();
        $countAllergiesGori = DB::table('allergy_reports')
            ->whereJsonContains('allergies', ['Gori'])
            ->where('Approved', 1)
            ->count();
        $jumlahSeafood = $userCount - $countAllergiesSeafood;
        $jumlahTelur = $userCount - $countAllergiesTelur;
        $jumlahIkanLaut = $userCount - $countAllergiesLaut;
        $jumlahLele = $userCount - $countAllergiesLele;
        $jumlahPedas = $userCount - $countAllergiesPedas;
        $jumlahDaging = $userCount - $countAllergiesDagingSapi;
        $jumlahDagingAyam = $userCount - $countAllergiesDagingAyam;
        $jumlahIkanMas = $userCount - $countAllergiesIkanMas;
        $jumlahDaunSingkong = $userCount - $countAllergiesDaunSingkong;
        $jumlahTerungHijau = $userCount - $countAllergiesTerung;
        $jumlahKikil = $userCount - $countAllergiesKikil;
        $jumlahKedelai = $userCount - $countAllergiesKedelai;
        $jumlahKacangan = $userCount - $countAllergiesKacang;
        $jumlahMujahir = $userCount - $countAllergiesMujahir;
        $jumlahNenas = $userCount - $countAllergiesNenas;
        $jumlahPepaya = $userCount - $countAllergiesPepaya;
        $jumlahGori = $userCount - $countAllergiesGori;
        return view('allergy_reports.rekap', compact(
            'reports',
            'title',
            'countAllergiesSeafood',
            'countAllergiesTelur',
            'countAllergiesPedas',
            'countAllergiesLele',
            'countAllergiesLaut',
            'countAllergiesDagingSapi',
            'countAllergiesDagingAyam',
            'countAllergiesIkanMas',
            'countAllergiesDaunSingkong',
            'countAllergiesTerung',
            'countAllergiesKikil',
            'countAllergiesKedelai',
            'countAllergiesKacang',
            'countAllergiesMujahir',
            'countAllergiesNenas',
            'countAllergiesPepaya',
            'countAllergiesGori',
            'jumlahSeafood',
            'jumlahTelur',
            'jumlahIkanLaut',
            'jumlahLele',
            'jumlahPedas',
            'jumlahDaging',
            'jumlahDagingAyam',
            'jumlahIkanMas',
            'jumlahDaunSingkong',
            'jumlahTerungHijau',
            'jumlahKikil',
            'jumlahKedelai',
            'jumlahKacangan',
            'jumlahMujahir',
            'jumlahNenas',
            'jumlahPepaya',
            'jumlahGori'
        ));
    }
}
