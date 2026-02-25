@extends('layouts.app')

@section('title', 'Login - SKPI')

@section('content')
<style>
    .login-container {
        background: white; border-radius: 15px; padding: 40px;
        max-width: 400px; margin: 50px auto; box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    }
    .login-title {
        text-align: center; color: #764ba2; margin-bottom: 30px; font-size: 2em;
    }
    .login-tabs {
        display: flex; margin-bottom: 30px; border-bottom: 2px solid #e0e0e0;
    }
    .login-tab {
        flex: 1; text-align: center; padding: 10px; cursor: pointer;
        font-weight: 600; color: #666;
    }
    .login-tab.active {
        color: #764ba2; border-bottom: 3px solid #764ba2;
    }
    .login-form { display: none; }
    .login-form.active { display: block; }
    .btn-login {
        width: 100%; padding: 12px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white; border: none; border-radius: 5px; font-size: 1.1em;
        cursor: pointer;
    }
</style>

<div class="login-container">
    <h2 class="login-title">🔐 Login SKPI</h2>
    
    <div class="login-tabs">
        <div class="login-tab active" onclick="switchTab('mahasiswa')">Mahasiswa</div>
        <div class="login-tab" onclick="switchTab('dosen')">Dosen</div>
    </div>

    <div id="loginMahasiswa" class="login-form active">
        <form action="{{ route('login.mahasiswa') }}" method="POST">
            @csrf
            <div class="form-group">
    <label>NIM / Email</label>
    <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM atau Email" required>
</div>
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Program Studi</label>
                <select name="prodi" required>
                    <option value="">Pilih</option>
                    <option value="Teknik Informatika">Teknik Informatika</option>
                    <option value="Sistem Informasi">Sistem Informasi</option>
                    <option value="Manajemen">Manajemen</option>
                </select>
            </div>
            {{-- Tambahkan setelah form --}}
<div style="text-align: center; margin-top: 20px;">
    <p>Belum punya akun? <a href="{{ route('register') }}" style="color: #4a2c82; font-weight: 600;">Daftar di sini</a></p>
</div>
            <button type="submit" class="btn-login">Login</button>
        </form>
    </div>

    <div id="loginDosen" class="login-form">
        <form action="{{ route('login.dosen') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn-login">Login</button>
            <p style="text-align: center; margin-top: 10px;">Demo: dosen / 123</p>
        </form>
    </div>
</div>

<script>
function switchTab(role) {
    document.querySelectorAll('.login-tab').forEach(tab => tab.classList.remove('active'));
    document.querySelectorAll('.login-form').forEach(form => form.classList.remove('active'));
    
    event.target.classList.add('active');
    document.getElementById(`login${role.charAt(0).toUpperCase() + role.slice(1)}`).classList.add('active');
}
</script>
@endsection