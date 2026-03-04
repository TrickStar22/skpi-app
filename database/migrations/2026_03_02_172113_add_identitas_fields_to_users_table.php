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
            // Tambahkan kolom baru (jangan buat id baru)
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan'])->nullable()->after('name');
            $table->string('nomor_ijazah_nasional')->nullable()->after('jenis_kelamin');
            $table->string('gelar')->nullable()->after('nomor_ijazah_nasional');
            $table->string('tempat_lahir')->nullable()->after('gelar');
            $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            $table->year('tahun_masuk')->nullable()->after('tanggal_lahir');  // pakai year untuk tahun
            $table->year('tahun_lulus')->nullable()->after('tahun_masuk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'jenis_kelamin',
                'nomor_ijazah_nasional',
                'gelar',
                'tempat_lahir',
                'tanggal_lahir',
                'tahun_masuk',
                'tahun_lulus',
            ]);
        });
    }
};