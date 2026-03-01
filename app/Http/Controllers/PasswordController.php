<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    // Menampilkan form lupa password
    public function showLupaPasswordForm()
    {
        return view('auth.lupa-password');
    }

    // Proses verifikasi NIM/Email
    public function cekAkun(Request $request)
    {
        $request->validate([
            'login' => 'required',
        ]);

        // Cari user berdasarkan NIM atau email
        $user = User::where('nim', $request->login)
                    ->orWhere('email', $request->login)
                    ->first();

        if (!$user) {
            return back()->with('error', 'NIM/Email tidak ditemukan!')
                        ->withInput();
        }

        // Simpan data user di session untuk step selanjutnya
        session(['reset_user_id' => $user->id]);
        session(['reset_user_login' => $request->login]);

        return redirect()->route('password.reset');
    }

    // Menampilkan form reset password
    public function showResetPasswordForm()
    {
        if (!session('reset_user_id')) {
            return redirect()->route('password.lupa')
                ->with('error', 'Sesi tidak valid! Silakan mulai lagi.');
        }

        return view('auth.reset-password', [
            'login' => session('reset_user_login')
        ]);
    }

    // Proses update password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $userId = session('reset_user_id');

        if (!$userId) {
            return redirect()->route('password.lupa')
                ->with('error', 'Sesi tidak valid! Silakan mulai lagi.');
        }

        $user = User::find($userId);
        
        if (!$user) {
            return redirect()->route('password.lupa')
                ->with('error', 'User tidak ditemukan!');
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        // Hapus session
        session()->forget(['reset_user_id', 'reset_user_login']);

        return redirect()->route('login')
            ->with('success', 'Password berhasil diubah! Silakan login dengan password baru.');
    }
}