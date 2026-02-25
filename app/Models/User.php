<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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