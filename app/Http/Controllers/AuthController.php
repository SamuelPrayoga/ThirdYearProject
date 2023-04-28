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
            "message" => "Password salah, silahkan coba lagi!"];
        return response()->json($data)->setStatusCode(400);
    }

//     public function authenticate(LoginRequest $request)
// {
//     $remember = $request->boolean('remember');
//     $credentials = $request->only(['email', 'password']);

//     $validator = Validator::make($credentials, [
//         'email' => 'required|email',
//         'password' => 'required',
//     ]);

//     if ($validator->fails()) {
//         $data = [
//             "success" => false,
//             "message" => "Silahkan isi email dan password yang benar"
//         ];
//         return response()->json($data)->setStatusCode(400);
//     }

//     if (Auth::attempt($credentials, $remember)) { // login berhasil
//         request()->session()->regenerate();
//         $data = [
//             "success" => true,
//             "redirect_to" => auth()->user()->isUser() ? route('home.index') : route('dashboard.index'),
//             "message" => "Login berhasil, silahkan klik tombol kembali!"
//         ];
//         return response()->json($data)->with('message', 'Login berhasil, silahkan klik tombol kembali!');
//     } else { // login gagal
//         $data = [
//             "success" => false,
//             "message" => "Password salah, silahkan coba lagi!"
//         ];
//         return response()->json($data)->setStatusCode(400)->with('message', 'Password salah, silahkan coba lagi!');
//     }
// }


    public function logout()
    {
        auth()->logout();

        request()->session()->regenerate();
        request()->session()->regenerateToken();

        return redirect()->route('auth.login');
    }

}
