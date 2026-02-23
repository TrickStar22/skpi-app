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

    public function loginMahasiswa(Request $request)
    {
        $request->validate([
            'nim' => 'required',
            'name' => 'required',
            'prodi' => 'required',
        ]);

        $user = User::where('nim', $request->nim)->first();

        if (!$user) {
            $user = User::create([
                'name' => $request->name,
                'nim' => $request->nim,
                'prodi' => $request->prodi,
                'role' => 'mahasiswa',
                'email' => $request->nim . '@mahasiswa.com',
                'password' => Hash::make($request->nim),
            ]);
        }

        Auth::login($user);
        return redirect()->route('dashboard');
    }

    public function loginDosen(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Username atau password salah!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}