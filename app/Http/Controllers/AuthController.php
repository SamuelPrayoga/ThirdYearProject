<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
            $data = [
                "success" => true,
                "redirect_to" => auth()->user()->isUser() ? route('home.index') : route('dashboard.index'),
                "message" => "Login berhasil, silahkan klik tombol kembali!"
            ];
            return response()->json($data);
        }

        $data = [
            "success" => false,
            "message" => "Email atau password salah, silahkan coba lagi!"
        ];
        return response()->json($data, 400);
    }



    public function logout()
    {
        auth()->logout();

        request()->session()->regenerate();
        request()->session()->regenerateToken();

        return redirect()->route('auth.login');
    }
}
