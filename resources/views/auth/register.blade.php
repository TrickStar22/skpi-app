@extends('layouts.app')

@section('title', 'Register Mahasiswa')

@section('content')
<style>
    .register-container {
        max-width: 500px;
        margin: 30px auto;
        background: white;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    }
    
    .register-header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .register-header h2 {
        color: #4a2c82;
        font-size: 28px;
        margin-bottom: 10px;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: 500;
    }
    
    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 14px;
    }
    
    .form-control:focus {
        border-color: #4a2c82;
        outline: none;
    }
    
    .btn-register {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, #667eea 0%, #4a2c82 100%);
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
    }
    
    .login-link {
        text-align: center;
        margin-top: 20px;
    }
    
    .login-link a {
        color: #4a2c82;
        text-decoration: none;
        font-weight: 600;
    }
    
    .password-hint {
        font-size: 12px;
        color: #6c757d;
        margin-top: 5px;
    }
</style>

<div class="register-container">
    <div class="register-header">
        <h2>📝 Registrasi Mahasiswa</h2>
        <p>Isi data dengan benar untuk mendaftar</p>
    </div>
    
    <form action="{{ route('register.mahasiswa') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label>NIM</label>
            <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM" required>
        </div>
        
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap" required>
        </div>
        
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
        </div>
        
        {{-- TAMBAHKAN FIELD PASSWORD --}}
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            <div class="password-hint">Minimal 6 karakter</div>
        </div>
        
        {{-- TAMBAHKAN FIELD KONFIRMASI PASSWORD --}}
        <div class="form-group">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Masukkan ulang password" required>
        </div>
        
        <div class="form-group">
            <label>Program Studi</label>
            <select name="prodi" class="form-control" required>
                <option value="">Pilih Program Studi</option>
                <option value="Teknologi Informasi">Teknologi Informasi</option>
                <option value="Teknik Electronika">Teknik Electronika</option>
                <option value="Akuntansi Sektor Public">Akuntansi Sektor Public</option>
                <option value="Akuntansi">Akuntansi</option>
            </select>
        </div>
        
        <button type="submit" class="btn-register">Daftar</button>
    </form>
    
    <div class="login-link">
        <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
    </div>
</div>
@endsection