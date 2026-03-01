@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<style>
    .password-container {
        max-width: 450px;
        margin: 50px auto;
        background: white;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    }
    
    .password-header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .password-header h2 {
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
    
    .btn-submit {
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
    
    .back-link {
        text-align: center;
        margin-top: 20px;
    }
    
    .back-link a {
        color: #666;
        text-decoration: none;
    }
    
    .info-text {
        background: #f0f7ff;
        border-left: 4px solid #4a2c82;
        padding: 12px 15px;
        margin-bottom: 25px;
        border-radius: 5px;
        color: #333;
        font-size: 14px;
    }
    
    .password-hint {
        font-size: 12px;
        color: #6c757d;
        margin-top: 5px;
    }
</style>

<div class="password-container">
    <div class="password-header">
        <h2>🔐 Reset Password</h2>
        <p>Buat password baru untuk akun: <strong>{{ $login }}</strong></p>
    </div>
    
    <div class="info-text">
        <strong>📝 Petunjuk:</strong> Password minimal 6 karakter.
    </div>
    
    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label>Password Baru</label>
            <input type="password" name="password" class="form-control" 
                   placeholder="Masukkan password baru" required>
            <div class="password-hint">Minimal 6 karakter</div>
        </div>
        
        <div class="form-group">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" 
                   placeholder="Masukkan ulang password baru" required>
        </div>
        
        <button type="submit" class="btn-submit">Ubah Password</button>
    </form>
    
    <div class="back-link">
        <p><a href="{{ route('login') }}">← Kembali ke Login</a></p>
    </div>
</div>
@endsection