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
            'name' => 'Ramadhani, S.Kom.,M.T.',
            'username' => 'dosen',
            'nidn' => '1317048801',
            'role' => 'dosen',
            'email' => 'dosen@univ.ac.id',
            'password' => Hash::make('123'),
        ]);
    }
}