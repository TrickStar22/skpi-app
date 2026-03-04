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
        // Data pribadi
        $table->enum('jenis_kelamin', ['laki-laki', 'perempuan'])->nullable();
        $table->string('nomor_ijazah_nasional')->nullable();
        $table->string('gelar')->nullable();
        
        // Data akademik
        $table->decimal('ipk', 4, 2)->nullable();
        $table->integer('nilai_tofel_prediksi')->nullable();
        $table->integer('jumlah_sks')->nullable();
        $table->decimal('nilai_nkk', 5, 2)->nullable();
        $table->string('praktek_program_industri')->nullable();
        $table->string('judul_proyek_akhir')->nullable();
        
        // Data pendidikan
        $table->string('jenis_pendidikan')->nullable();
        $table->string('nama_perguruan_tinggi')->nullable();
        $table->string('sk_pendirian_pt')->nullable();
        $table->string('akreditasi_pt')->nullable();
        $table->string('jenjang_pendidikan')->nullable();
        $table->string('sk_pendirian_prodi')->nullable();
        $table->string('akreditasi_prodi')->nullable();
        $table->string('jenjang_kualifikasi_kkni')->nullable();
        $table->string('persyaratan_masuk')->nullable();
        $table->string('bahasa_pengantar')->nullable();
        $table->integer('lama_studi_reguler')->nullable();
        $table->string('sistem_penilaian')->nullable();
        $table->string('skala_ipk_lulusan')->nullable();
        $table->string('pendidikan_lanjutan')->nullable();
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn([
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
        ]);
    });
}
};
