<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('prestasis', function (Blueprint $table) {
            $table->id();  // ← WAJIB: Primary Key
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // ← WAJIB: Relasi ke users
            
            // Field-field yang Anda inginkan
            $table->string('praktek_program_industri')->nullable();
            $table->string('judul_proyek_akhir')->nullable();
            $table->string('nilai_tofel_prediksi')->nullable();
            $table->string('jumlah_sks')->nullable();
            $table->string('nilai_nkk')->nullable();
            $table->string('ipk')->nullable();
            $table->string('jenis_pendidikan')->nullable();
            $table->string('nama_perguruan_tinggi')->nullable();
            $table->string('sk_pendirian_perguruan_tinggi')->nullable();
            $table->string('akreditasi_perguruan_tinggi')->nullable();
            $table->string('jenjang_pendidikan')->nullable();
            $table->enum('prodi', ['Akuntansi', 'Akuntansi Sektor Publik', 'Teknologi Informasi', 'Mekatronika', 'Electronika'])->nullable();
            $table->string('sk_pendirian_program_studi')->nullable();
            $table->string('akreditasi_program_studi')->nullable();
            $table->string('jenjang_kualifikasi_kkni')->nullable();
            $table->string('persyaratan_masuk')->nullable();
            $table->string('bahasa_pengantar')->nullable();
            $table->string('lama_study_reguler')->nullable();
            $table->string('sistem_penilaian')->nullable();
            $table->string('skala_ipk_lulusan')->nullable();
            $table->string('pendidikan_lanjutan')->nullable();
            
            $table->timestamps();  // ← WAJIB: created_at & updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('prestasis');
    }
};