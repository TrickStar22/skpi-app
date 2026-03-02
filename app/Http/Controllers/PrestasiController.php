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
            $mahasiswa = User::where('role', 'mahasiswa')
                ->with('prestasis')
                ->get();
            return view('dosen.dashboard', compact('mahasiswa'));
        } else {
            $prestasis = $user->prestasis()
                ->orderBy('created_at', 'desc')
                ->get();
            return view('mahasiswa.dashboard', compact('prestasis'));
        }
    }

    public function printSKPI($nim = null)
    {
        if ($nim) {
            $user = User::where('nim', $nim)->firstOrFail();
            $prestasis = Prestasi::where('user_id', $user->id)
                ->where('status', 'verified')
                ->get();
        } else {
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
        return $pdf->download('SKPI_'.$user->name.'_'.$user->nim.'.pdf');
    }
    
    /**
 * Update identitas mahasiswa
 */
public function updateIdentitas(Request $request)
{
    $request->validate([
        'name' => 'required',
        'tempat_lahir' => 'required',
        'tanggal_lahir' => 'required|date',
        'prodi' => 'required',
        'fakultas' => 'required',
        'ipk' => 'required',
        'masa_studi' => 'required',
        'tanggal_lulus' => 'required|date',
    ]);

    $user = Auth::user();
    
    $user->update([
        'name' => $request->name,
        'tempat_lahir' => $request->tempat_lahir,
        'tanggal_lahir' => $request->tanggal_lahir,
        'prodi' => $request->prodi,
        'fakultas' => $request->fakultas,
        'ipk' => $request->ipk,
        'masa_studi' => $request->masa_studi,
        'tanggal_lulus' => $request->tanggal_lulus,
    ]);

    return redirect()->back()->with('success', 'Identitas berhasil diperbarui!');
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
            'status' => 'verified',
        ]);

        return redirect()->back()->with('success', 'Prestasi berhasil ditambahkan!');
    }
}