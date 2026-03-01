<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('prestasis', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('nama_kegiatan');
    $table->enum('tingkat', ['Lokal', 'Regional', 'Nasional', 'Internasional']);
    $table->string('pencapaian'); // Juara 1, Juara 2, dll
    $table->year('tahun');
    $table->string('penyelenggara');
    $table->text('deskripsi')->nullable();
    $table->enum('status', ['pending', 'verified'])->default('pending');
    $table->timestamps();
});
    }

    public function down()
    {
        Schema::dropIfExists('prestasis');
    }
};