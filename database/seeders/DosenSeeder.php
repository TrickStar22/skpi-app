<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DosenSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Dr. Budi Santoso, M.Kom',
            'username' => 'dosen',
            'nidn' => '197001011998031001',
            'role' => 'dosen',
            'email' => 'dosen@univ.ac.id',
            'password' => Hash::make('123'),
        ]);
    }
}