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

// Proses login mahasiswa
public function loginMahasiswa(Request $request)
{
    $request->validate([
        'login' => 'required',      // field ini bisa diisi NIM atau Email
        'password' => 'required',
    ]);

    // Coba cari user berdasarkan NIM
    $user = User::where('nim', $request->login)->first();
    
    // Kalau tidak ketemu, coba cari berdasarkan email
    if (!$user) {
        $user = User::where('email', $request->login)->first();
    }

    if (!$user) {
        return back()->with('error', 'NIM/Email tidak terdaftar!');
    }

    // Cek status verifikasi
    if ($user->status_verifikasi === 'pending') {
        return back()->with('error', 'Akun Anda masih menunggu verifikasi dosen!');
    }

    if ($user->status_verifikasi === 'ditolak') {
        return back()->with('error', 'Akun Anda ditolak! Hubungi admin.');
    }

    // Coba login (coba dengan NIM dulu, kalau gagal coba dengan email)
    if (Auth::attempt(['nim' => $request->login, 'password' => $request->password]) || 
        Auth::attempt(['email' => $request->login, 'password' => $request->password])) {
        return redirect()->route('dashboard');
    }

    return back()->with('error', 'Password salah!');
}

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    // Proses login dosen
    public function loginDosen(Request $request)
    {
    $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    // Coba login
    if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
        return redirect()->route('dashboard');
    }

    // Kalau gagal
    return back()->with('error', 'Username atau password salah!');
    }
}