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
            <form action="{{ route('prestasi.store') }}" method="POST">
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
                        <input type="text" name="Nomor Induk Mahasiswa" class="form-control" value="{{ Auth::user()->nim }}" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>Nomor ljazah Nasional</label>
                        <p><em>National Diploma Number</em></p>
                        <input type="text" name="IPK" class="form-control" required>
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
                        <input type="number" name="tahun" class="form-control" value="{{ date('Y') }}" min="2000" max="2100" required>
                    </div>

                    <div class="form-group">
                        <label>Tahun Lulus</label>
                        <p><em>year of graduation</em><p>
                        <input type="number" name="tahun" class="form-control" value="{{ date('Y') }}" min="2000" max="2100" required>
                    </div>
                </div>
                
                {{-- SECTION 2: PRESTASI BARU --}}
                <div class="section-title">II. Tambah Prestasi Baru</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Nama Kegiatan</label>
                        <input type="text" name="nama_kegiatan" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Tingkat</label>
                        <select name="tingkat" class="form-control" required>
                            <option value="">Pilih Tingkat</option>
                            <option value="Lokal">Lokal</option>
                            <option value="Regional">Regional</option>
                            <option value="Nasional">Nasional</option>
                            <option value="Internasional">Internasional</option>

                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Pencapaian</label>
                        <input type="text" name="pencapaian" class="form-control" placeholder="Juara 1, Juara 2, dll" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Tahun</label>
                        <input type="number" name="tahun" class="form-control" value="{{ date('Y') }}" min="2000" max="2100" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Penyelenggara</label>
                        <input type="text" name="penyelenggara" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Program Studi</label>
                        <p><em>Study Stream</em></p>
                        <select name="prodi" class="form-control" required>
                            <option value="Akuntansi" {{ Auth::user()->prodi == 'Akuntansi' ? 'selected' : '' }}>Akuntansi</option>
                            <option value="Akuntansi Sektor Publik" {{ Auth::user()->prodi == 'Akuntansi Sektor Publik' ? 'selected' : '' }}>Akuntansi Sektor Publik</option>
                            <option value="Teknologi Informasi" {{ Auth::user()->prodi == 'Teknologi Informasi' ? 'selected' : '' }}>Teknologi Informasi</option>
                            <option value="Mekatronika" {{ Auth::user()->prodi == 'Mekatronika' ? 'selected' : '' }}>Mekatronika</option>
                            <option value="Electronika" {{ Auth::user()->prodi == 'Electronika' ? 'selected' : '' }}>Electronika</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Nilai TOEFL Prediksi</label>
                        <p><em>Prediction TOEFL Score</em></p>
                        <input type="text" name="Nilai TOFEL Prediksi" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>IPK</label>
                        <p><em>GPA</em></p>
                        <input type="text" name="IPK" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Nilai NKK</label>
                        <p><em>Student Behavioral Score</em></p>
                        <input type="text" name="Nilai NKK" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Program Praktik Industri</label>
                        <p><em>Industrial Practice Program</em></p>
                        <input type="text" name="Praktek Program Industri" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Judul Proyek Akhir</label>
                        <p><em>Final Project Title</em></p>
                        <input type="text" name="Judul Proyek Akhir" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Jumlah SKS</label>
                        <p><em>Credits Cumulative</em></p>
                        <input type="text" name="Jumlah SKS" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Jenis Pendidikan</label>
                        <p><em>Type of Education</em></p>
                        <input type="text" name="Jenis Pendidikan" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Nama Perguruan Tinggi</label>
                        <p><em>College Name</em></p>
                        <input type="text" name="Nama Perguruan Tinggi" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>SK Pendirian Perguruan Tinggi</label>
                        <p><em>College Licence</em></p>
                        <input type="text" name="SK Pendirian Perguruan Tinggi" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Akreditasi Perguruan Tinggi</label>
                        <p><em>College Accreditation</em></p>
                        <input type="text" name="Akreditasi Perguruan Tinggi" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Jenjang Pendidikan</label>
                        <p><em>Level of Study</em></p>
                        <input type="text" name="Jenjang Pendidikan" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>SK Pendirian Program Studi</label>
                        <p><em>Study Stream Licence</em></p>
                        <input type="text" name="SK Pendirian Program Studi" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Akreditasi Program Studi</label>
                        <p><em>Study Program Accreditation</em></p>
                        <input type="text" name="Akreditasi Program Studi" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Jenjang Kualifikasi KKNI</label>
                        <p><em>INQF Qualification Level</em></p>
                        <input type="text" name="Jenjang Kualifikasi KKNI" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Persyaratan Masuk</label>
                        <p><em>Entry Requirement</em></p>
                        <input type="text" name="Persyaratan Masuk" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Bahasa Pengantar</label>
                        <p><em>Language of Instruction</em></p>
                        <input type="text" name="Bahasa Pengantar" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Lama Study Reguler</label>
                        <p><em>Length of Reguler Study</em></p>
                        <input type="text" name="Lama Study Reguler" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Sistem Penilaian</label>
                        <p><em>Grading System</em></p>
                        <input type="text" name="Sistem Penilaian" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Skala IPK Lulusan</label>
                        <p><em>GPA Scale for Graduate</em></p>
                        <input type="text" name="Skala IPK Lulusan" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Pendidikan Lanjutan</label>
                        <p><em>Further Study</em></p>
                        <input type="text" name="Pendidikan Lanjutan" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
=======
                        <label>Deskripsi Prestasi</label>
                        <textarea name="deskripsi" class="form-control" rows="3" placeholder="Jelaskan detail prestasi..."></textarea>
                    </div>
                </div>
                
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