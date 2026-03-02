<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PrestasiController extends Controller
{
    public function index()
{
    $user = Auth::user();

    if ($user->isDosen()) {
        // Untuk dosen: ambil semua mahasiswa
        $mahasiswas = User::where('role', 'mahasiswa')
            ->with('prestasis')
            ->get();
        return view('dosen.dashboard', compact('mahasiswas'));
    } else {
        // Untuk mahasiswa: ambil prestasi sendiri
        $prestasis = $user->prestasis()
            ->orderBy('created_at', 'desc')
            ->get();
        return view('mahasiswa.dashboard', compact('prestasis'));
    }
}
public function printSKPI($nim = null)
{
    if ($nim) {
        // Print oleh dosen (berdasarkan nim)
        $user = User::where('nim', $nim)->firstOrFail();
        $prestasis = Prestasi::where('user_id', $user->id)
            ->where('status', 'verified')
            ->get();
    } else {
        // Print oleh mahasiswa sendiri
        $user = Auth::user();
        $prestasis = Prestasi::where('user_id', $user->id)
            ->where('status', 'verified')
            ->get();
    }

    $data = [
        'user' => $user,
        'prestasis' => $prestasis,
        'tanggal' => now()->format('d F Y'),
    ];

    $pdf = Pdf::loadView('pdf.skpi', $data);
    return $pdf->download('SKPI_'.$user->nama.'_'.$user->nim.'.pdf');
}
   public function store(Request $request)
{
    $request->validate([
        'nama_kegiatan' => 'required',
        'tingkat' => 'required',
        'pencapaian' => 'required',
        'tahun' => 'required|integer|min:2000|max:2026',
        'penyelenggara' => 'required',
        'deskripsi' => 'nullable',
    ]);

    Prestasi::create([
        'user_id' => Auth::id(),
        'nama_kegiatan' => $request->nama_kegiatan,
        'tingkat' => $request->tingkat,
        'pencapaian' => $request->pencapaian,
        'tahun' => $request->tahun,
        'penyelenggara' => $request->penyelenggara,
        'deskripsi' => $request->deskripsi,
        'status' => 'pending',
    ]);

    return redirect()->back()->with('success', 'Prestasi berhasil ditambahkan!');
}
   
}