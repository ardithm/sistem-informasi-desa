<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Penduduk - RT {{ $rt ?: 'Semua' }}</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 15mm 12mm 15mm 12mm;
        }
        * {
            box-sizing: border-box;
            font-family: 'Times New Roman', Times, serif;
        }
        body {
            background-color: #f1f5f9;
            margin: 0;
            padding: 20px;
            color: #000;
        }
        .page {
            background-color: #fff;
            max-width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            padding: 20mm 15mm;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        /* Top Navigation Bar (Not Printed) */
        .no-print-bar {
            max-width: 210mm;
            margin: 0 auto 15px auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #1e293b;
            color: #fff;
            padding: 12px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
        .no-print-bar .title {
            font-size: 14px;
            font-weight: 600;
        }
        .no-print-bar .actions {
            display: flex;
            gap: 10px;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            border: none;
            transition: background 0.15s;
        }
        .btn-print {
            background-color: #1d72fe;
            color: #fff;
        }
        .btn-print:hover {
            background-color: #155cd4;
        }
        .btn-back {
            background-color: #334155;
            color: #f1f5f9;
        }
        .btn-back:hover {
            background-color: #475569;
        }

        /* Kop Surat */
        .kop-header {
            text-align: center;
            position: relative;
            margin-bottom: 8px;
        }
        .kop-header h3 {
            margin: 0;
            font-size: 14pt;
            font-weight: bold;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        .kop-header h2 {
            margin: 2px 0;
            font-size: 17pt;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .kop-header p {
            margin: 2px 0 0 0;
            font-size: 9.5pt;
            font-style: italic;
        }
        .garis-kop {
            border-top: 3px solid #000;
            border-bottom: 1px solid #000;
            height: 2px;
            margin: 10px 0 18px 0;
        }

        /* Judul Laporan */
        .judul-laporan {
            text-align: center;
            margin-bottom: 20px;
        }
        .judul-laporan h4 {
            margin: 0;
            font-size: 13pt;
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
        }
        .judul-laporan .keterangan {
            margin-top: 5px;
            font-size: 10.5pt;
        }

        /* Tabel Data */
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9pt;
            margin-bottom: 20px;
        }
        table.data-table th, table.data-table td {
            border: 1px solid #000;
            padding: 5px 6px;
            vertical-align: middle;
        }
        table.data-table th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
            font-size: 8.5pt;
        }
        table.data-table td.text-center {
            text-align: center;
        }
        table.data-table td.text-right {
            text-align: right;
        }

        /* Ringkasan */
        .rekap-box {
            display: inline-block;
            border: 1px solid #000;
            padding: 8px 14px;
            font-size: 9.5pt;
            margin-bottom: 25px;
            line-height: 1.5;
        }
        .rekap-box strong {
            font-weight: bold;
        }

        /* Tanda Tangan */
        .ttd-container {
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
            font-size: 10.5pt;
            page-break-inside: avoid;
        }
        .ttd-kolom {
            width: 230px;
            text-align: center;
        }
        .ttd-space {
            height: 65px;
        }
        .ttd-nama {
            font-weight: bold;
            text-decoration: underline;
        }

        @media print {
            body {
                background: #fff;
                padding: 0;
            }
            .page {
                box-shadow: none;
                margin: 0;
                padding: 0;
                max-width: 100%;
                min-height: auto;
            }
            .no-print, .no-print-bar {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    {{-- Floating / Top Action Bar (Hidden on Print) --}}
    <div class="no-print-bar">
        <div class="title">
            Pratinjau Cetak: Laporan Data Penduduk ({{ $totalJiwa }} Data)
        </div>
        <div class="actions">
            <a href="{{ route('admin.laporan.index', ['rt' => $rt]) }}" class="btn btn-back">
                &larr; Kembali ke Panel
            </a>
            <button onclick="window.print()" class="btn btn-print">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                Cetak Dokumen (Print / PDF)
            </button>
        </div>
    </div>

    <div class="page">
        {{-- KOP SURAT --}}
        <div class="kop-header">
            <h3>PEMERINTAH KABUPATEN BOGOR</h3>
            <h3>KECAMATAN CIOMAS</h3>
            <h2>PEMERINTAH DESA KITA</h2>
            <p>Alamat: Jl. Raya Desa Kita No. 01, Kec. Ciomas, Kab. Bogor 16610 - Jawa Barat</p>
        </div>
        <div class="garis-kop"></div>

        {{-- JUDUL LAPORAN --}}
        <div class="judul-laporan">
            <h4>LAPORAN DATA KEPENDUDUKAN</h4>
            <div class="keterangan">
                <span>Wilayah: <strong>RT {{ $rt ?: 'Semua' }}</strong></span>
                &bull;
                <span>Dicetak pada: <strong>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</strong></span>
            </div>
        </div>

        {{-- TABEL DATA --}}
        <table class="data-table">
            <thead>
                <tr>
                    <th width="30">No</th>
                    <th width="125">NIK</th>
                    <th>Nama Lengkap</th>
                    <th width="35">L/P</th>
                    <th>Tempat, Tgl Lahir</th>
                    <th width="40">Usia</th>
                    <th>Pekerjaan</th>
                    <th>Alamat</th>
                    <th width="50">RT/RW</th>
                    <th width="55">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($penduduks as $index => $p)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ $p->nik }}</td>
                    <td><strong>{{ $p->nama_lengkap }}</strong></td>
                    <td class="text-center">{{ $p->jenis_kelamin }}</td>
                    <td>{{ $p->tempat_lahir }}, {{ $p->tanggal_lahir ? \Carbon\Carbon::parse($p->tanggal_lahir)->translatedFormat('d-m-Y') : '-' }}</td>
                    <td class="text-center">{{ $p->tanggal_lahir ? \Carbon\Carbon::parse($p->tanggal_lahir)->age . ' th' : '-' }}</td>
                    <td>{{ $p->pekerjaan ?? '-' }}</td>
                    <td>{{ $p->alamat }}</td>
                    <td class="text-center">{{ $p->rt }}/{{ $p->rw }}</td>
                    <td class="text-center">{{ ucfirst($p->status_penduduk) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center" style="padding: 20px;">
                        Tidak ada data penduduk untuk kriteria RT {{ $rt ?: 'Semua' }}.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- REKAPITULASI --}}
        <div class="rekap-box">
            <strong>Rekapitulasi Data:</strong><br>
            - Total Penduduk: <strong>{{ $totalJiwa }} Jiwa</strong><br>
            - Laki-laki: <strong>{{ $totalL }} Orang</strong> &bull; Perempuan: <strong>{{ $totalP }} Orang</strong><br>
            - Status Aktif: <strong>{{ $totalAktif }} Orang</strong>
        </div>

        {{-- TANDA TANGAN --}}
        <div class="ttd-container">
            <div class="ttd-kolom">
                Mengetahui,<br>
                Sekretaris Desa Kita
                <div class="ttd-space"></div>
                <div class="ttd-nama">( ............................................ )</div>
            </div>
            <div class="ttd-kolom">
                Desa Kita, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>
                Kepala Desa Kita
                <div class="ttd-space"></div>
                <div class="ttd-nama">( ............................................ )</div>
            </div>
        </div>
    </div>

</body>
</html>
