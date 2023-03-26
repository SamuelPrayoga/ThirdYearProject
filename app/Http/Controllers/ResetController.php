<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ResetController extends Controller
{
    public function hapusMahasiswa(Request $request)
    {
        // Validasi request
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        // Ambil user berdasarkan ID
        $user = User::with('feedback')->where('id', $request->user_id)->where('position_id', 1)->first();

        // Cek apakah user ditemukan
        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        // Hapus semua feedback terkait user
        $user->feedback()->delete();

        // Hapus user
        $user->delete();

        // Berikan response
        return response()->json(['message' => 'User dan Feedback berhasil dihapus'], 200);
    }
}
