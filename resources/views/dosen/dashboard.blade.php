@extends('layouts.app')

@section('title', 'Dashboard Dosen')

@section('content')
<style>
    .mahasiswa-card {
        background: white; border-radius: 10px; padding: 15px;
        margin-bottom: 15px; border-left: 4px solid #764ba2;
    }
    .modal {
        display: none; position: fixed; top: 0; left: 0;
        width: 100%; height: 100%; background: rgba(0,0,0,0.5);
        z-index: 1000;
    }
    .modal-content {
        background: white; margin: 5% auto; padding: 20px;
        width: 80%; max-width: 800px; border-radius: 10px;
    }
    .close { float: right; font-size: 28px; cursor: pointer; }
</style>

<div class="form-container">
    <h3 class="form-title">🔍 Filter Mahasiswa</h3>
    <div style="display: grid; grid-template-columns: 1fr 1fr auto; gap: 10px;">
        <input type="text" id="search" placeholder="Cari nama/NIM..." onkeyup="filterMahasiswa()">
        <select id="prodi" onchange="filterMahasiswa()">
            <option value="all">Semua Prodi</option>
            <option value="Teknik Informatika">Teknik Informatika</option>
            <option value="Sistem Informasi">Sistem Informasi</option>
            <option value="Manajemen">Manajemen</option>
        </select>
        <button class="btn btn-primary" onclick="resetFilter()">Reset</button>
    </div>
</div>

<div class="table-container">
    <h3 class="form-title">👥 Daftar Mahasiswa</h3>
    <div id="mahasiswaList">
        @foreach($mahasiswas as $m)
        <div class="mahasiswa-card" data-nim="{{ $m->nim }}" data-nama="{{ strtolower($m->name) }}" data-prodi="{{ $m->prodi }}">
            <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                <div>
                    <strong>{{ $m->name }}</strong> ({{ $m->nim }})
                </div>
                <span class="status-badge" style="background: #764ba2; color: white;">
                    {{ $m->prestasis->count() }} Prestasi
                </span>
            </div>
            <div style="margin-bottom: 10px;">{{ $m->prodi }}</div>
            <div style="margin-bottom: 15px;">
                <span class="status-badge status-verified">✓ {{ $m->prestasis->where('status', 'verified')->count() }} Terverifikasi</span>
                <span class="status-badge status-pending">⏳ {{ $m->prestasis->where('status', 'pending')->count() }} Pending</span>
            </div>
            <button class="btn btn-primary" onclick="openModal('{{ $m->nim }}')">Lihat & Kelola</button>
        </div>
        @endforeach
    </div>
</div>

<div id="detailModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h3 style="color: #764ba2; margin-bottom: 20px;">Detail Prestasi Mahasiswa</h3>
        <div id="modalInfo" style="margin-bottom: 20px;"></div>
        <table style="width: 100%;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kegiatan</th>
                    <th>Tingkat</th>
                    <th>Pencapaian</th>
                    <th>Tahun</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="modalBody"></tbody>
        </table>
    </div>
</div>

@push('scripts')
<script>
let currentNim = '';

function filterMahasiswa() {
    const search = document.getElementById('search').value.toLowerCase();
    const prodi = document.getElementById('prodi').value;
    
    document.querySelectorAll('.mahasiswa-card').forEach(card => {
        const nama = card.dataset.nama;
        const nim = card.dataset.nim;
        const prodiCard = card.dataset.prodi;
        
        let show = true;
        if (search && !nama.includes(search) && !nim.includes(search)) show = false;
        if (prodi !== 'all' && prodiCard !== prodi) show = false;
        
        card.style.display = show ? 'block' : 'none';
    });
}

function resetFilter() {
    document.getElementById('search').value = '';
    document.getElementById('prodi').value = 'all';
    filterMahasiswa();
}

function openModal(nim) {
    currentNim = nim;
    
    fetch(`/api/mahasiswa/${nim}/prestasi`)
        .then(res => res.json())
        .then(data => {
            document.getElementById('modalInfo').innerHTML = `
                <p><strong>Nama:</strong> ${data.name}</p>
                <p><strong>NIM:</strong> ${data.nim}</p>
                <p><strong>Prodi:</strong> ${data.prodi}</p>
            `;
            
            let html = '';
            data.prestasis.forEach((p, i) => {
                html += `<tr>
                    <td>${i+1}</td>
                    <td>${p.kegiatan}</td>
                    <td>${p.tingkat}</td>
                    <td>${p.pencapaian}</td>
                    <td>${p.tahun}</td>
                    <td><span class="status-badge ${p.status === 'verified' ? 'status-verified' : 'status-pending'}">
                        ${p.status === 'verified' ? 'Terverifikasi' : 'Pending'}
                    </span></td>
                    <td>
                        <button class="btn btn-success" onclick="verify(${p.id})">✓ Verifikasi</button>
                        <button class="btn" style="background:#dc3545; color:white;" onclick="hapus(${p.id})">🗑 Hapus</button>
                    </td>
                </tr>`;
            });
            document.getElementById('modalBody').innerHTML = html;
            
            document.getElementById('detailModal').style.display = 'block';
        });
}

function closeModal() {
    document.getElementById('detailModal').style.display = 'none';
}

function verify(id) {
    if (confirm('Verifikasi prestasi ini?')) {
        fetch(`/prestasi/${id}/verify`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
        }).then(() => {
            closeModal();
            openModal(currentNim);
        });
    }
}

function hapus(id) {
    if (confirm('Hapus prestasi ini?')) {
        fetch(`/prestasi/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
        }).then(() => {
            closeModal();
            openModal(currentNim);
        });
    }
}
</script>
@endpush
@endsection