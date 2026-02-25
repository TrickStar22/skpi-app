<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifikasiMahasiswaController extends Controller
{
    // Tampilkan daftar mahasiswa pending
    public function index()
    {
        $mahasiswas = User::where('role', 'mahasiswa')
            ->where('status_verifikasi', 'pending')
            ->get();
        
        return view('dosen.verifikasi', compact('mahasiswas'));
    }

    // Setujui mahasiswa
    public function setujui($id)
    {
        $user = User::findOrFail($id);
        $user->status_verifikasi = 'verified';
        $user->save();

        return redirect()->back()->with('success', 'Akun mahasiswa disetujui!');
    }

    // Tolak mahasiswa
    public function tolak($id)
    {
        $user = User::findOrFail($id);
        $user->status_verifikasi = 'ditolak';
        $user->save();

        return redirect()->back()->with('success', 'Akun mahasiswa ditolak!');
    }
}