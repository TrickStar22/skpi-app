<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PrestasiController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login/mahasiswa', [AuthController::class, 'loginMahasiswa'])->name('login.mahasiswa');
Route::post('/login/dosen', [AuthController::class, 'loginDosen'])->name('login.dosen');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [PrestasiController::class, 'index'])->name('dashboard');
    Route::post('/prestasi', [PrestasiController::class, 'store'])->name('prestasi.store');
    Route::post('/prestasi/{id}/verify', [PrestasiController::class, 'verify']);
    Route::delete('/prestasi/{id}', [PrestasiController::class, 'destroy']);
    Route::get('/api/mahasiswa/{nim}/prestasi', [PrestasiController::class, 'getMahasiswaPrestasi']);
});