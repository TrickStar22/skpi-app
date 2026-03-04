<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id',
    'praktek_program_industri',
    'judul_proyek_akhir',
    'nilai_tofel_prediksi',
    'jumlah_sks',
    'nilai_nkk',
    'ipk',
    'jenis_pendidikan',
    'nama_perguruan_tinggi',
    'sk_pendirian_perguruan_tinggi',
    'akreditasi_perguruan_tinggi',
    'jenjang_pendidikan',
    'prodi',
    'sk_pendirian_program_studi',
    'akreditasi_program_studi',
    'jenjang_kualifikasi_kkni',
    'persyaratan_masuk',
    'bahasa_pengantar',
    'lama_study_reguler',
    'sistem_penilaian',
    'skala_ipk_lulusan',
    'pendidikan_lanjutan',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}