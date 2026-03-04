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
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('name')->nullable();
            $table->enum('Jenis Kelamin', ['laki-laki', 'perempuan']);
            $table->string('Ninomor ljazah Nasional')->nullable();
            $table->string('Gelar')->nullable();
            $table->string('tempat_lahir')->nullable()->after('prodi');
            $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            $table->date('Tahun masuk')->nullable()->after('tempat_lahir');
            $table->date('Tahun lulus')->nullable()->after('Tahun masuk');
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