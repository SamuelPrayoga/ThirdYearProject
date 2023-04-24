<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        $title = "Daftar Akun";
        return view('auth.register', compact('title'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nim' => 'required',
            'name' => 'required|max:255',
            'prodi' => 'required',
            'angkatan' => 'required',
            'asrama' => 'required',
            'phone' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        $validatedData['role_id'] = 3;
        $validatedData['position_id'] = 1;
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);
        return redirect('/login')->with('success', 'Registration Succesfull! Please Login');
    }
}
