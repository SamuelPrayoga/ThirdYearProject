<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UpdateProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        $title = "Ubah Profil";
        return view('auth.editProfile', compact('user', 'title'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $validatedData = $request->validate([
            'phone' => 'required|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',

        ]);

        $user->phone = $validatedData['phone'];
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('avatars'), $filename);
            $user->avatar = $filename;
        }

        // if ($request->hasFile('avatar')) {
        //     $avatar = $request->file('avatar');
        //     $filename = time() . '.' . $avatar->getClientOriginalExtension();
        //     $avatar->storeAs('public/avatars', $filename);
        //     $user->avatar = $filename;
        // }
        $user->save();

        return redirect()->route('home.edit.profile')->with('toast_success', 'Profile berhasil diubah');
    }
}
