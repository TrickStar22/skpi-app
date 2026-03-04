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
        // UNTUK DOSEN
        $mahasiswa = User::where('role', 'mahasiswa')
            ->with('prestasis')
            ->get();
            
        // CEK APAKAH ADA DATA
        if ($mahasiswa->isEmpty()) {
            return view('dosen.dashboard', compact('mahasiswa'))
                ->with('error', 'Tidak ada data mahasiswa');
        }
        
        return view('dosen.dashboard', compact('mahasiswa'));
        
    } else {
        // UNTUK MAHASISWA
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
 * Update identitas dan tambah prestasi dalam satu form
 */
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

    try {
        Prestasi::create([
    'user_id' => Auth::id(),
    'praktek_program_industri' => $request->praktek_program_industri,
    'judul_proyek_akhir' => $request->judul_proyek_akhir,
    'nilai_tofel_prediksi' => $request->nilai_tofel_prediksi,
    'jumlah_sks' => $request->jumlah_sks,
    'nilai_nkk' => $request->nilai_nkk,
    'ipk' => $request->ipk,
    'jenis_pendidikan' => $request->jenis_pendidikan,
    'nama_perguruan_tinggi' => $request->nama_perguruan_tinggi,
    'sk_pendirian_pt' => $request->sk_pendirian_pt,
    'akreditasi_pt' => $request->akreditasi_pt,
    'jenjang_pendidikan' => $request->jenjang_pendidikan,
    'prodi' => $request->prodi,
    'sk_pendirian_prodi' => $request->sk_pendirian_prodi,
    'akreditasi_prodi' => $request->akreditasi_prodi,
    'jenjang_kualifikasi_kkni' => $request->jenjang_kualifikasi_kkni,
    'persyaratan_masuk' => $request->persyaratan_masuk,
    'bahasa_pengantar' => $request->bahasa_pengantar,
    'lama_studi_reguler' => $request->lama_studi_reguler,
    'sistem_penilaian' => $request->sistem_penilaian,
    'skala_ipk_lulusan' => $request->skala_ipk_lulusan,
    'pendidikan_lanjutan' => $request->pendidikan_lanjutan,
    'status' => 'verified',
]);
        
        return redirect()->back()->with('success', 'Prestasi berhasil ditambahkan!');
        
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
    }
}
}