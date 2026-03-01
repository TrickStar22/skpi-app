<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\VerifikasiMahasiswaController; // TAMBAHKAN INI (baris baru)
use App\Http\Controllers\PasswordController; 

// Halaman utama (login)
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

// Route register (TAMBAHKAN INI)
Route::get('/register', function() {
    return view('auth.register');
})->name('register');
Route::post('/register', [AuthController::class, 'registerMahasiswa'])->name('register.mahasiswa');

// Proses login
Route::post('/login/mahasiswa', [AuthController::class, 'loginMahasiswa'])->name('login.mahasiswa');
Route::post('/login/dosen', [AuthController::class, 'loginDosen'])->name('login.dosen');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman yang butuh login
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [PrestasiController::class, 'index'])->name('dashboard');
    
    // Prestasi
    Route::post('/prestasi', [PrestasiController::class, 'store'])->name('prestasi.store');
    Route::post('/prestasi/{id}/verify', [PrestasiController::class, 'verify'])->name('prestasi.verify');
    Route::delete('/prestasi/{id}', [PrestasiController::class, 'destroy'])->name('prestasi.destroy');
    
    // Detail mahasiswa (untuk dosen)
    Route::get('/dosen/prestasi/{nim}', [PrestasiController::class, 'detailMahasiswa'])->name('dosen.prestasi');
    
    // ========== TAMBAHKAN INI ==========
    // Route verifikasi (khusus dosen)
    Route::get('/dosen/verifikasi', [VerifikasiMahasiswaController::class, 'index'])->name('dosen.verifikasi');
    Route::post('/dosen/setujui/{id}', [VerifikasiMahasiswaController::class, 'setujui'])->name('dosen.setujui');
    Route::post('/dosen/tolak/{id}', [VerifikasiMahasiswaController::class, 'tolak'])->name('dosen.tolak');
    // ========== SAMPAI SINI ==========
    // Route untuk lupa password (tidak perlu login)
Route::prefix('password')->name('password.')->group(function () {
    Route::get('/lupa', [PasswordController::class, 'showLupaPasswordForm'])->name('lupa');
    Route::post('/cek-akun', [PasswordController::class, 'cekAkun'])->name('cek');
    Route::get('/reset', [PasswordController::class, 'showResetPasswordForm'])->name('reset');
    Route::post('/update', [PasswordController::class, 'updatePassword'])->name('update');
});
});