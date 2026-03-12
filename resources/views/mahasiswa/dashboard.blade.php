@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')

@section('content')
<style>
    .dashboard-container {
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 30px;
        overflow: hidden;
    }
    
    .card-header {
        background: linear-gradient(135deg, #0992C2 0%, #261CC1 100%);
        color: white;
        padding: 15px 20px;
    }
    
    .card-header h3 {
        margin: 0;
        font-size: 18px;
    }
    
    .card-body {
        padding: 20px;
    }
    
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    
    .form-group {
        margin-bottom: 15px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
        color: #333;
    }
    
    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
    }
    
    .form-control:focus {
        border-color: #261CC1;
        outline: none;
    }
    
    .btn {
        padding: 12px 30px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #0992C2 0%, #261CC1 100%);
        color: white;
    }
    
    .btn-success {
        background: #28a745;
        color: white;
    }
    
    .section-title {
        font-size: 16px;
        font-weight: bold;
        margin: 20px 0 15px 0;
        padding-bottom: 5px;
        border-bottom: 2px solid #261CC1;
    }
    
    .section-title:first-of-type {
        margin-top: 0;
    }
    
    .action-buttons {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
        margin-bottom: 20px;
    }
    
    .table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .table th {
        background: #f8f9fa;
        padding: 12px;
        text-align: left;
        font-weight: 600;
        color: #333;
    }
    
    .table td {
        padding: 12px;
        border-bottom: 1px solid #dee2e6;
    }
    
    .badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .badge-verified {
        background: #d4edda;
        color: #155724;
    }
</style>

<div class="dashboard-container">
    {{-- Action Buttons --}}
    <div class="action-buttons">
        <a href="{{ route('print.skpi') }}" class="btn btn-success" target="_blank">
            🖨️ Cetak SKPI
        </a>
    </div>
    
    {{-- FORM GABUNGAN IDENTITAS + PRESTASI --}}
    <div class="card">
        <div class="card-header">
            <h3>📋 Identitas & Prestasi Mahasiswa</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('mahasiswa.update-identitas-lengkap') }}" method="POST">
                @csrf
                
                {{-- SECTION 1: IDENTITAS MAHASISWA --}}
                <div class="section-title">I. Identitas Mahasiswa</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <p><em>Full Name</em></p>
                        <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
                    </div>

                   <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <p><em>Gender</em></p>
                        <select name="Jenis Kelamin" class="form-control" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Lokal">Laki-laki</option>
                            <option value="Regional">Perempuan</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Nomor Induk Mahasiswa</label>
                        <p><em>Student Number</em></p>
                        <input type="text" name="Nomor_Induk_Mahasiswa" class="form-control" value="{{ Auth::user()->nim }}" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>Nomor ljazah Nasional</label>
                        <p><em>National Diploma Number</em></p>
                        <input type="text" name="Ninomor_ljazah_Nasional" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Gelar</label>
                        <p><em>Name of Diploma</em><p>
                        <input type="text" name="Gelar" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <p><em>place of birth</em><p>
                        <input type="text" name="tempat_lahir" class="form-control" value="{{ Auth::user()->tempat_lahir ?? '' }}" placeholder="Contoh: Jakarta" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <p><em>place of birth</em><p>
                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ Auth::user()->tanggal_lahir ?? '' }}" required>
                    </div>
                                            
                    <div class="form-group">
                        <label>Tahun Masuk</label>
                        <p><em>year of entry</em><p>
                        <input type="number" name="tahun_masuk" class="form-control" value="{{ date('Y') }}" min="2000" max="2100" required>
                    </div>

                    <div class="form-group">
                        <label>Tahun Lulus</label>
                        <p><em>year of graduation</em><p>
                        <input type="number" name="tahun_lulus" class="form-control" value="{{ date('Y') }}" min="2000" max="2100" required>
                    </div>
                </div>
                
                {{-- SECTION 2: PRESTASI BARU --}}
               
                
                <button type="submit" class="btn btn-primary" style="margin-top: 20px;">
                    Simpan Identitas & Prestasi
                </button>
            </form>
        </div>
    </div>
    
    {{-- DAFTAR PRESTASI --}}
    <div class="card">
        <div class="card-header">
            <h3>📋 Daftar Prestasi Saya</h3>
        </div>
        <div class="card-body">
            @if($prestasis->isEmpty())
                <p style="text-align: center; color: #666; padding: 20px;">
                    Belum ada prestasi yang ditambahkan.
                </p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kegiatan</th>
                            <th>Tingkat</th>
                            <th>Pencapaian</th>
                            <th>Tahun</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prestasis as $index => $p)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $p->nama_kegiatan }}</td>
                            <td>{{ $p->tingkat }}</td>
                            <td>{{ $p->pencapaian }}</td>
                            <td>{{ $p->tahun }}</td>
                            <td>
                                <span class="badge badge-verified">✓ Terverifikasi</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection