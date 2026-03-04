<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('prestasis', function (Blueprint $table) {
    $table->string('Praktek Program Industri');        // ← Nama kegiatan
    $table->string('Judul Proyek Akhir'); 
    $table->string('Nilai TOFEL Prediksi');  
    $table->string('Jumlah SKS');  
    $table->string('Nilai NKK');   
    $table->string('IPK');   
    $table->string('Jenis Pendidikan');  
    $table->string('Nama Perguruan Tinggi');  
    $table->string('SK Pendirian Perguruan Tinggi');  
    $table->string('Akreditasi Perguruan Tinggi');  
    $table->string('Jenjang Pendidikan');  
    $table->enum('prodi', ['Akuntansi', 'Akuntansi Sektor Publik', 'Teknologi Informasi', 'Mekatronika', 'Electronika']);
    $table->string('SK Pendirian Program Studi'); 
    $table->string('Akreditasi Program Studi'); 
    $table->string('Jenjang Kualifikasi KKNI'); 
    $table->string('Persyaratan Masuk'); 
    $table->string('Bahasa Pengantar'); 
    $table->string('Lama Study Reguler');
    $table->string('Sistem Penilaian');
    $table->string('Skala IPK Lulusan');
    $table->string('Pendidikan Lanjutan');
});
    }

    public function down()
    {
        Schema::dropIfExists('prestasis');
    }
};