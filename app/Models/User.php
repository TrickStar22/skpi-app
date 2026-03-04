<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
    'name',
    'email',
    'password',
    'role',
    'nim',
    'nidn',
    'prodi',
    'username',
    'status_verifikasi',
    'jenis_kelamin',
    'nomor_ijazah_nasional',
    'gelar',
    'ipk',
    'nilai_tofel_prediksi',
    'jumlah_sks',
    'nilai_nkk',
    'praktek_program_industri',
    'judul_proyek_akhir',
    'jenis_pendidikan',
    'nama_perguruan_tinggi',
    'sk_pendirian_pt',
    'akreditasi_pt',
    'jenjang_pendidikan',
    'sk_pendirian_prodi',
    'akreditasi_prodi',
    'jenjang_kualifikasi_kkni',
    'persyaratan_masuk',
    'bahasa_pengantar',
    'lama_studi_reguler',
    'sistem_penilaian',
    'skala_ipk_lulusan',
    'pendidikan_lanjutan',
    'tahun_masuk',
    'tahun_lulus',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function prestasis()
    {
        return $this->hasMany(Prestasi::class);
    }

    public function isDosen()
    {
        return $this->role === 'dosen';
    }

    public function isMahasiswa()
    {
        return $this->role === 'mahasiswa';
    }
    public function isVerified()
    {
    return $this->status_verifikasi === 'verified';
    }

    public function isPending()
    {
    return $this->status_verifikasi === 'pending';
    }
}