<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = DB::table('users')->where('position_id','=','1')->count();

        return view('dashboard.index', [
            "title" => "Dashboard",
            // $products = Product::where('product_id', '!=', $userproducts->id)->get();
            "positionCount" => Position::count(),
            // "userCount" => User::count(),
            // "userCount" => User::where('position_id','=','1')->get()
            "userCount"=> $userCount
        ]);
    }
}
