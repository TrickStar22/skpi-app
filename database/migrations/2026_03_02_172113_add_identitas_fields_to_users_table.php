<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('tempat_lahir')->nullable()->after('prodi');
            $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            $table->string('fakultas')->nullable()->after('tanggal_lahir');
            $table->string('ipk')->nullable()->after('fakultas');
            $table->string('masa_studi')->nullable()->after('ipk');
            $table->date('tanggal_lulus')->nullable()->after('masa_studi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'tempat_lahir', 
                'tanggal_lahir', 
                'fakultas', 
                'ipk', 
                'masa_studi', 
                'tanggal_lulus'
            ]);
        });
    }
};