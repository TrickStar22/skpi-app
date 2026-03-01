@extends('layouts.app')

@section('title', 'Login')

@section('content')
<style>
    .login-container {
        max-width: 450px;
        margin: 50px auto;
        background: white;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    }
    
    .login-header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .login-header h2 {
        color: #261CC1;
        font-size: 28px;
        margin-bottom: 10px;
    }
    
    .tab-buttons {
        display: flex;
        gap: 10px;
        margin-bottom: 30px;
        background: #f5f5f5;
        padding: 5px;
        border-radius: 50px;
    }
    
    .tab-btn {
        flex: 1;
        padding: 12px;
        border: none;
        border-radius: 50px;
        background: transparent;
        color: #666;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .tab-btn.active {
        background: #261CC1;
        color: white;
        box-shadow: 0 4px 10px rgba(74, 44, 130, 0.3);
    }
    
    .login-form {
        display: none;
    }
    
    .login-form.active {
        display: block;
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
        border-color: #261CC1;
        outline: none;
    }
    
    .btn-login {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, #0992C2 0%, #261CC1 100%);
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
    }
    
    .register-link {
        text-align: center;
        margin-top: 20px;
    }
    
    .register-link a {
        color: #261CC1;
        text-decoration: none;
        font-weight: 600;
    }
</style>

<div class="login-container">
    <div class="login-header">
        <h2>🔐 Login SKPI</h2>
        <p>Silakan pilih jenis login</p>
    </div>
    
    <div class="tab-buttons">
        <button class="tab-btn active" onclick="showTab('mahasiswa')">👨‍🎓 Mahasiswa</button>
        <button class="tab-btn" onclick="showTab('dosen')">👨‍🏫 Dosen</button>
    </div>
    
    
{{-- TAMBAHKAN INI --}}
<div class="text-right" style="text-align: right; margin-top: 10px;">
    <a href="{{ route('password.lupa') }}" style="color: #4a2c82; font-size: 14px;">Lupa Password?</a>
</div>
        <form action="{{ route('login.mahasiswa') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>NIM / Email</label>
                <input type="text" name="login" class="form-control" placeholder="Masukkan NIM atau Email" required>
            </div>
            <div class="form-group">
                <label>Program Studi</label>
                <select name="prodi" class="form-control" required>
                <option value="Akuntansi " {{ old('prodi') == 'Akuntansi' ? 'selected' : '' }}>Akuntansi</option>
                <option value="Akuntansi Sektor Public" {{ old('prodi') == 'SAkuntansi Sektor Public' ? 'selected' : '' }}>Akuntansi Sektor Public</option>
                <option value="Teknologi Informasi" {{ old('prodi') == 'Teknologi Informasi' ? 'selected' : '' }}>Teknologi Informasi</option>
                <option value="Mekatronika" {{ old('prodi') == 'Mekatronika' ? 'selected' : '' }}>Mekatronika</option>
                <option value="Electronika" {{ old('prodi') == 'Electronika' ? 'selected' : '' }}>Electronika</option>
                </select>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn-login">Login sebagai Mahasiswa</button>
        </form>
    </div>
    

{{-- TAMBAHKAN INI --}}
<div class="text-right" style="text-align: right; margin-top: 10px;">
    <a href="{{ route('password.lupa') }}" style="color: #4a2c82; font-size: 14px;">Lupa Password?</a>
</div>
        <form action="{{ route('login.dosen') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn-login">Login sebagai Dosen</button>
        </form>
    </div>
    
    <div class="register-link">
        <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
    </div>
</div>

<script>
function showTab(role) {
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    
    document.querySelectorAll('.login-form').forEach(form => {
        form.classList.remove('active');
    });
    
    event.target.classList.add('active');
    
    if (role == 'mahasiswa') {
        document.getElementById('form-mahasiswa').classList.add('active');
    } else {
        document.getElementById('form-dosen').classList.add('active');
    }
}
</script>
@endsection