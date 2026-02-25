<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

   // Fungsi register mahasiswa
public function registerMahasiswa(Request $request)
{
    $request->validate([
        'nim' => 'required|unique:users',
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'prodi' => 'required',
    ]);

    // Buat user baru dengan status pending
    $user = User::create([
        'name' => $request->name,
        'nim' => $request->nim,
        'email' => $request->email,
        'prodi' => $request->prodi,
        'role' => 'mahasiswa',
        'password' => Hash::make($request->nim), // password default = NIM
        'status_verifikasi' => 'pending',
    ]);

    return redirect()->route('login')
        ->with('success', 'Registrasi berhasil! Silakan tunggu verifikasi dari dosen.');
}

// UPDATE fungsi login mahasiswa
public function loginMahasiswa(Request $request)
{
    $request->validate([
        'nim' => 'required',
        'password' => 'required',
    ]);

    $user = User::where('nim', $request->nim)->first();

    if (!$user) {
        return back()->with('error', 'NIM tidak terdaftar!');
    }

    // Cek status verifikasi
    if ($user->status_verifikasi === 'pending') {
        return back()->with('error', 'Akun Anda masih menunggu verifikasi dosen!');
    }

    if ($user->status_verifikasi === 'ditolak') {
        return back()->with('error', 'Akun Anda ditolak! Hubungi admin.');
    }

    // Coba login
    if (Auth::attempt(['nim' => $request->nim, 'password' => $request->password])) {
        return redirect()->route('dashboard');
    }

    return back()->with('error', 'Password salah!');
}

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}