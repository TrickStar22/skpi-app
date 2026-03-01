<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>SKPI - {{ $user->name }}</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
            line-height: 1.5;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .header h1 {
            font-size: 18px;
            font-weight: bold;
            margin: 5px 0;
            text-transform: uppercase;
        }
        .header h2 {
            font-size: 16px;
            font-weight: bold;
            margin: 5px 0;
        }
        .header p {
            font-size: 12px;
            margin: 2px 0;
        }
        .judul {
            text-align: center;
            margin: 20px 0;
        }
        .judul h3 {
            font-size: 16px;
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
        }
        .info-mahasiswa {
            margin: 20px 0;
            padding: 10px;
            border: 1px solid #000;
        }
        .info-mahasiswa h4 {
            text-align: center;
            margin: 0 0 10px 0;
            font-size: 14px;
            font-weight: bold;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 120px 10px 1fr;
            gap: 5px;
        }
        .table-prestasi {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .table-prestasi th {
            background: #1a3e6f;
            color: white;
            font-weight: bold;
            padding: 8px;
            border: 1px solid #000;
            text-align: center;
        }
        .table-prestasi td {
            padding: 6px;
            border: 1px solid #000;
            vertical-align: top;
        }
        .keterangan {
            margin: 20px 0;
        }
        .keterangan h4 {
            text-align: center;
            margin-bottom: 10px;
        }
        .prestasi-item {
            margin-bottom: 10px;
            padding: 8px;
            border-left: 3px solid #1a3e6f;
        }
        .ttd {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }
        .ttd-box {
            width: 45%;
        }
        .ttd-box p {
            margin: 2px 0;
        }
        .ttd-box .jabatan {
            font-weight: bold;
            margin-bottom: 50px;
        }
        .ttd-box .nama {
            font-weight: bold;
            text-decoration: underline;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
            border-top: 1px solid #999;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    {{-- KOP SURAT --}}
    <div class="header">
        <h1>KEMENTERIAN PENDIDIKAN TINGGI</h1>
        <h2>UNIVERSITAS CONTOH NEGERI</h2>
        <p>Jl. Pendidikan Nasional No. 1, Jakarta Pusat 12345</p>
        <p>Telp. (021) 1234567 | Email: info@univ.ac.id</p>
    </div>

    {{-- NOMOR SKPI --}}
    <div style="text-align: center; margin: 10px 0; font-weight: bold;">
        NOMOR: SKPI/UNIV/{{ date('Y') }}/{{ $user->nim }}
    </div>

    {{-- JUDUL --}}
    <div class="judul">
        <h3>SURAT KETERANGAN PENDAMPING IJAZAH</h3>
        <p>(DIPLOMA SUPPLEMENT)</p>
    </div>

    {{-- I. IDENTITAS MAHASISWA --}}
    <div class="info-mahasiswa">
        <h4>I. IDENTITAS MAHASISWA</h4>
        <div class="info-grid">
            <div>Nama Lengkap</div><div>:</div><div>{{ $user->name }}</div>
            <div>Tempat, Tgl Lahir</div><div>:</div><div>Jakarta, 15 Mei 2003</div>
            <div>NIM</div><div>:</div><div>{{ $user->nim }}</div>
            <div>Program Studi</div><div>:</div><div>{{ $user->prodi }}</div>
            <div>Fakultas</div><div>:</div><div>Ilmu Komputer</div>
            <div>IPK</div><div>:</div><div>3.75 (Memuaskan)</div>
            <div>Masa Studi</div><div>:</div><div>4 Tahun 2 Bulan</div>
            <div>Tanggal Lulus</div><div>:</div><div>15 Februari 2026</div>
        </div>
    </div>

    {{-- II. PRESTASI YANG DICAPAI --}}
    <div class="info-mahasiswa">
        <h4>II. PRESTASI YANG DICAPAI</h4>
        
        <table class="table-prestasi">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kegiatan</th>
                    <th>Tingkat</th>
                    <th>Pencapaian</th>
                    <th>Tahun</th>
                    <th>Penyelenggara</th>
                </tr>
            </thead>
            <tbody>
                @forelse($prestasis as $index => $p)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>{{ $p->nama_kegiatan }}</td>
                    <td style="text-align: center;">{{ $p->tingkat }}</td>
                    <td style="text-align: center;">{{ $p->pencapaian }}</td>
                    <td style="text-align: center;">{{ $p->tahun }}</td>
                    <td>{{ $p->penyelenggara }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Belum ada prestasi terverifikasi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- III. DESKRIPSI PRESTASI --}}
    <div class="info-mahasiswa">
        <h4>III. DESKRIPSI PRESTASI</h4>
        @forelse($prestasis as $index => $p)
        <div class="prestasi-item">
            <strong>{{ $index + 1 }}. {{ $p->nama_kegiatan }} ({{ $p->tahun }})</strong><br>
            Pencapaian: {{ $p->pencapaian }} - Tingkat {{ $p->tingkat }}<br>
            Deskripsi: {{ $p->deskripsi ?? 'Tidak ada deskripsi' }}
        </div>
        @empty
        <p style="text-align: center;">Belum ada prestasi terverifikasi</p>
        @endforelse
    </div>

    {{-- IV. INFORMASI KUALIFIKASI DAN HASIL YANG DICAPAI --}}
    <div class="info-mahasiswa">
        <h4>IV. INFORMASI KUALIFIKASI DAN HASIL YANG DICAPAI</h4>
        <p style="text-align: center; font-style: italic;">(Dikosongkan, akan diisi oleh dosen)</p>
    </div>

    {{-- TANDA TANGAN --}}
    <div class="ttd">
        <div class="ttd-box">
            <p>Mahasiswa,</p>
            <p class="jabatan">&nbsp;</p>
            <br><br><br>
            <p class="nama">{{ $user->name }}</p>
            <p>NIM. {{ $user->nim }}</p>
        </div>
        <div class="ttd-box" style="text-align: right;">
            <p>Jakarta, {{ $tanggal }}</p>
            <p class="jabatan">a.n. Rektor<br>Dekan Fakultas Ilmu Komputer</p>
            <br><br><br>
            <p class="nama">Prof. Dr. H. Ahmad Fauzi, M.Pd.</p>
            <p>NIP. 197001011998031001</p>
        </div>
    </div>

    {{-- STEMPEL --}}
    <div style="margin-top: 20px; text-align: right;">
        <div style="display: inline-block; width: 80px; height: 80px; border: 2px solid #333; border-radius: 50%; text-align: center; line-height: 80px; font-size: 12px; opacity: 0.7;">
            STEMPEL
        </div>
    </div>

    {{-- FOOTER --}}
    <div class="footer">
        <p>Dokumen ini diterbitkan oleh Sistem Informasi SKPI Universitas Contoh</p>
        <p>Dicetak pada: {{ $tanggal }} | Jumlah Prestasi: {{ $prestasis->count() }}</p>
    </div>
</body>
</html>