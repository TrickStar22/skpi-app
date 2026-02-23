<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrestasiController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isDosen()) {
            $mahasiswas = User::where('role', 'mahasiswa')
                ->with('prestasis')
                ->get();
            return view('dosen.dashboard', compact('mahasiswas'));
        } else {
            $prestasis = $user->prestasis()->orderBy('created_at', 'desc')->get();
            return view('mahasiswa.dashboard', compact('prestasis'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'kegiatan' => 'required',
            'tingkat' => 'required',
            'pencapaian' => 'required',
            'tahun' => 'required|integer|min:2000|max:2026',
            'penyelenggara' => 'required',
        ]);

        Prestasi::create([
            'user_id' => Auth::id(),
            'kegiatan' => $request->kegiatan,
            'tingkat' => $request->tingkat,
            'pencapaian' => $request->pencapaian,
            'tahun' => $request->tahun,
            'penyelenggara' => $request->penyelenggara,
            'deskripsi' => $request->deskripsi,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Prestasi berhasil ditambahkan!');
    }

    public function verify($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        
        if (Auth::user()->isDosen()) {
            $prestasi->update(['status' => 'verified']);
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }

    public function destroy($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        
        if (Auth::user()->isDosen()) {
            $prestasi->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }

    public function getMahasiswaPrestasi($nim)
    {
        if (Auth::user()->isDosen()) {
            $mahasiswa = User::where('nim', $nim)
                ->with('prestasis')
                ->firstOrFail();
            
            return response()->json($mahasiswa);
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }
}