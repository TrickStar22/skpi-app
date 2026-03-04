<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // CEK DULU SEBELUM NAMBAH KOLOM
            if (!Schema::hasColumn('users', 'jenis_kelamin')) {
                $table->enum('jenis_kelamin', ['laki-laki', 'perempuan'])->nullable();
            }
            
            if (!Schema::hasColumn('users', 'nomor_ijazah_nasional')) {
                $table->string('nomor_ijazah_nasional')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'gelar')) {
                $table->string('gelar')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'nilai_tofel_prediksi')) {
                $table->integer('nilai_tofel_prediksi')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'jumlah_sks')) {
                $table->integer('jumlah_sks')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'nilai_nkk')) {
                $table->decimal('nilai_nkk', 5, 2)->nullable();
            }
            
            if (!Schema::hasColumn('users', 'praktek_program_industri')) {
                $table->string('praktek_program_industri')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'judul_proyek_akhir')) {
                $table->string('judul_proyek_akhir')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'jenis_pendidikan')) {
                $table->string('jenis_pendidikan')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'nama_perguruan_tinggi')) {
                $table->string('nama_perguruan_tinggi')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'sk_pendirian_pt')) {
                $table->string('sk_pendirian_pt')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'akreditasi_pt')) {
                $table->string('akreditasi_pt')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'jenjang_pendidikan')) {
                $table->string('jenjang_pendidikan')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'sk_pendirian_prodi')) {
                $table->string('sk_pendirian_prodi')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'akreditasi_prodi')) {
                $table->string('akreditasi_prodi')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'jenjang_kualifikasi_kkni')) {
                $table->string('jenjang_kualifikasi_kkni')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'persyaratan_masuk')) {
                $table->string('persyaratan_masuk')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'bahasa_pengantar')) {
                $table->string('bahasa_pengantar')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'lama_studi_reguler')) {
                $table->integer('lama_studi_reguler')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'sistem_penilaian')) {
                $table->string('sistem_penilaian')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'skala_ipk_lulusan')) {
                $table->string('skala_ipk_lulusan')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'pendidikan_lanjutan')) {
                $table->string('pendidikan_lanjutan')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'jenis_kelamin',
                'nomor_ijazah_nasional',
                'gelar',
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