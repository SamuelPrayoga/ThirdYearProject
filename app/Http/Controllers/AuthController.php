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

    try {
        if (Auth::attempt($credentials, $remember)) { // login berhasil
            request()->session()->regenerate();
            return redirect()->route(auth()->user()->isUser() ? 'home.index' : 'dashboard.index')
                ->with('success', 'Login Berhasil, Selamat Datang!');
        }

        return back()->with('error', 'Username atau password Anda salah, silahkan coba lagi!');
    } catch (\Exception $error) {
        return back()->with('error', 'Terjadi kesalahan saat melakukan autentikasi. Silakan coba lagi nanti.');
    }
}




    public function logout()
    {
        auth()->logout();

        request()->session()->regenerate();
        request()->session()->regenerateToken();

        return redirect()->route('auth.login');
    }
}
