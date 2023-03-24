<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login', [
            "title" => "Masuk"
        ]);
    }
    public function authenticate(LoginRequest $request)
    {
        $remember = $request->boolean('remember');
        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials, $remember)) { // login berhasil
            request()->session()->regenerate();
            $data = ["success" => true,            "redirect_to" => auth()->user()->isUser() ? route('home.index') : route('dashboard.index'),            "message" => "Login berhasil, silahkan klik tombol kembali!"];
            return response()->json($data);
        }

        $data = ["success" => false,        "message" => "Password salah, silahkan coba lagi!"];
        return response()->json($data)->setStatusCode(400);
    }
    // public function authenticate(LoginRequest $request){
    //     $remember = $request->boolean('remember');
    //     $credentials = $request->only(['email', 'password']);

    //     if (Auth::attempt($credentials, $remember)) { // login gagal
    //         request()->session()->regenerate();
    //         $data = [
    //             "success" => true,
    //             "redirect_to" => auth()->user()->isUser() ? route('home.index') : route('dashboard.index'),
    //             "message" => "Login berhasil, silahkan klik tombol kembali!"
    //         ];
    //         return response()->json($data);
    //     }

    //     $data = [
    //         "success" => false,
    //         "message" => "Login gagal, silahkan coba lagi!"
    //     ];
    //     //return redirect()->route('auth.login')->with('danger', 'Anda Berhasil Keluar.');
    //     return response()->json($data)->setStatusCode(400);
    // }

    public function logout()
    {
        auth()->logout();

        request()->session()->regenerate();
        request()->session()->regenerateToken();

        return redirect()->route('auth.login');
        // return redirect()->route('auth.login')->with('success', 'Anda Berhasil Keluar.');
    }

    // public function showForgotForm()
    // {
    //     return view('auth.forgetPassword', [
    //         "title" => "Masuk"
    //     ]);
    // }
}
