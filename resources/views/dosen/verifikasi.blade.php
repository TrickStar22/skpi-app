@extends('layouts.app')

@section('title', 'Verifikasi Mahasiswa')

@section('content')
<style>
    .verifikasi-container {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }
    
    .table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .table th {
        background: #4a2c82;
        color: white;
        padding: 12px;
        text-align: left;
    }
    
    .table td {
        padding: 12px;
        border-bottom: 1px solid #e0e0e0;
    }
    
    .btn-setujui {
        background: #28a745;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
        margin-right: 5px;
    }
    
    .btn-tolak {
        background: #dc3545;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
    }
    
    .badge {
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 12px;
    }
    
    .badge-pending {
        background: #fff3cd;
        color: #856404;
    }
</style>

<div class="verifikasi-container">
    <h2 style="color: #4a2c82; margin-bottom: 20px;">👥 Verifikasi Akun Mahasiswa</h2>
    
    @if($mahasiswas->isEmpty())
        <p style="text-align: center; color: #666; padding: 40px;">Tidak ada mahasiswa yang menunggu verifikasi</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Prodi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mahasiswas as $index => $m)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $m->nim }}</td>
                    <td>{{ $m->name }}</td>
                    <td>{{ $m->email }}</td>
                    <td>{{ $m->prodi }}</td>
                    <td>
                        <span class="badge badge-pending">Menunggu</span>
                    </td>
                    <td>
                        <form action="{{ route('dosen.setujui', $m->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn-setujui" onclick="return confirm('Setujui akun ini?')">✓ Setujui</button>
                        </form>
                        
                        <form action="{{ route('dosen.tolak', $m->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn-tolak" onclick="return confirm('Tolak akun ini?')">✗ Tolak</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection