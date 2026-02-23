<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['mahasiswa', 'dosen'])->default('mahasiswa');
            $table->string('nim')->nullable()->unique();
            $table->string('nidn')->nullable()->unique();
            $table->string('prodi')->nullable();
            $table->string('username')->nullable()->unique();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'nim', 'nidn', 'prodi', 'username']);
        });
    }
};