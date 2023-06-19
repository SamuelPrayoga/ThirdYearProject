<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AllergyReport;
use App\Models\barang;
use App\Models\Feedback;
use Illuminate\Support\Carbon;
use App\Models\LaporMakan;
use App\Models\MenuMakanan;
use App\Models\Permission;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = DB::table('users')->where('position_id', '=', '1')->count();
        $tanggal = date('Y-m-d');
        $tanggal_jumat = date('Y-m-d', strtotime("next Friday", strtotime($tanggal)));
        // mendapatkan tanggal hari Sabtu
        $tanggal_sabtu = date('Y-m-d', strtotime("next Saturday", strtotime($tanggal)));

        $approvedData = AllergyReport::where('approved', 1)
            ->selectRaw('COUNT(*) as count, MONTH(created_at) as month')
            ->groupBy('month')
            ->get();
        $pendingData = AllergyReport::where('approved', 0)
            ->selectRaw('COUNT(*) as count, MONTH(created_at) as month')
            ->groupBy('month')
            ->get();
        $kebersihanData = Feedback::where('subject_review', 'Kebersihan Kantin')
            ->where('value_rating', 'Menyukai')
            ->selectRaw('COUNT(*) as count, MONTH(created_at) as month')
            ->groupBy('month')
            ->get();
        $categories = AllergyReport::pluck('allergies')->toArray();
        $data = AllergyReport::pluck('allergies')->toArray();
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
        $countAllergiesJamur = DB::table('allergy_reports')
            ->whereJsonContains('allergies', ['Jamur'])
            ->where('Approved', 1)
            ->count();

        $today = Carbon::now()->format('Y-m-d');
        $userIB = LaporMakan::where('is_makan', 1)
            ->whereDate('tanggal_berangkat', '<=', $today)
            ->whereDate('tanggal_kembali', '>=', $today)
            ->count();
        $mahasiswaMakan = $userCount - $userIB;
        $today = Carbon::now()->format('Y-m-d');
        $menus = MenuMakanan::whereDate('tanggal_makan', $today)->first();

        $userAllergy = AllergyReport::where('approved', '=', 1)->count();
        $alergiBaruCount = AllergyReport::where('approved', 0)->count();
        $izinMakan = Permission::where('is_accepted', 0)->count();
        $izinIB = LaporMakan::where('is_makan', 0)->count();

        return view('dashboard.index', [
            "title" => "Dashboard",
            "positionCount" => Position::count(),
            "userCount" => $userCount,
            "approvedData" => $approvedData,
            "categories" => $categories,
            "data" => $data,
            "kebersihanData" => $kebersihanData,
            "pendingData" => $pendingData,
            "countAllergiesLaut" => $countAllergiesLaut,
            "countAllergiesPedas" => $countAllergiesPedas,
            "countAllergiesLele" => $countAllergiesLele,
            "countAllergiesTelur" => $countAllergiesTelur,
            "countAllergiesSeafood" => $countAllergiesSeafood,
            "countAllergiesDagingSapi" => $countAllergiesDagingSapi,
            "countAllergiesAyam" => $countAllergiesDagingAyam,
            "countAllergiesIkanMas" => $countAllergiesIkanMas,
            "countAllergiesDaunSingkong" => $countAllergiesDaunSingkong,
            "countAllergiesTerung" => $countAllergiesTerung,
            "countAllergiesKikil" => $countAllergiesKikil,
            "countAllergiesKedelai" => $countAllergiesKedelai,
            "countAllergiesKacang" => $countAllergiesKacang,
            "countAllergiesMujahir" => $countAllergiesMujahir,
            "countAllergiesNenas" => $countAllergiesNenas,
            "countAllergiesPepaya" => $countAllergiesPepaya,
            "countAllergiesGori" => $countAllergiesGori,
            "countAllergiesJamur" => $countAllergiesJamur,
            "userIB" => $userIB,
            "mahasiswaMakan" => $mahasiswaMakan,
            "menus" => $menus,
            "userAllergy" => $userAllergy,
            "alergiBaruCount" => $alergiBaruCount,
            "izinMakan" => $izinMakan,
            "izinIB" => $izinIB,

        ]);
    }
}
