@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')

@section('content')
<div class="form-container">
    <h3 class="form-title"> Input Prestasi Baru</h3>
    <form action="{{ route('prestasi.store') }}" method="POST">
        @csrf
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label>Kegiatan</label>
                <input type="text" name="kegiatan" required>
            </div>
            <div class="form-group">
                <label>Tingkat</label>
                <select name="tingkat" required>
                    <option value="Lokal">Lokal</option>
                    <option value="Regional">Regional</option>
                    <option value="Nasional">Nasional</option>
                    <option value="Internasional">Internasional</option>
                </select>
            </div>
            <div class="form-group">
                <label>Pencapaian</label>
                <input type="text" name="pencapaian" required>
            </div>
            <div class="form-group">
                <label>Tahun</label>
                <input type="number" name="tahun" value="2024" required>
            </div>
            <div class="form-group">
                <label>Penyelenggara</label>
                <input type="text" name="penyelenggara" required>
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" rows="3"></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Prestasi</button>
    </form>
</div>

<div class="table-container">
    <h3 class="form-title">📋 Prestasi Saya</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kegiatan</th>
                <th>Tingkat</th>
                <th>Pencapaian</th>
                <th>Tahun</th>
                <th>Penyelenggara</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prestasis as $index => $p)
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $p->kegiatan }}</td>
                <td>{{ $p->tingkat }}</td>
                <td>{{ $p->pencapaian }}</td>
                <td>{{ $p->tahun }}</td>
                <td>{{ $p->penyelenggara }}</td>
                <td>
                    <span class="status-badge {{ $p->status == 'verified' ? 'status-verified' : 'status-pending' }}">
                        {{ $p->status == 'verified' ? '✓ Terverifikasi' : '⏳ Pending' }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection   