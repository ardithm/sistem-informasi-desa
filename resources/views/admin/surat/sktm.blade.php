<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>Surat Keterangan Tidak Mampu</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            line-height: 1.6;
        }

        .kop {
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }

        .kop h1,
        .kop h2,
        .kop p {
            margin: 0;
        }

        .kop h1 {
            font-size: 16pt;
        }

        .kop h2 {
            font-size: 14pt;
        }

        .judul {
            text-align: center;
            margin-bottom: 25px;
        }

        .judul h3 {
            margin: 0;
            text-decoration: underline;
        }

        .data {
            margin-left: 30px;
        }

        .data td {
            vertical-align: top;
            padding: 3px 0;
        }

        .isi {
            text-align: justify;
        }

        .ttd {
            width: 250px;
            margin-left: auto;
            margin-top: 40px;
            text-align: center;
        }
    </style>
</head>

<body>

    {{-- KOP SURAT --}}
    <div class="kop">

        <h1>PEMERINTAH DESA</h1>
        <h2>DESA [NAMA DESA]</h2>
        <p>KECAMATAN [NAMA KECAMATAN]</p>
        <p>KABUPATEN [NAMA KABUPATEN]</p>
        <p>Alamat: [ALAMAT KANTOR DESA]</p>

    </div>


    {{-- JUDUL --}}
    <div class="judul">

        <h3>SURAT KETERANGAN TIDAK MAMPU</h3>

        <p>
            Nomor: {{ $surat->nomor_surat }}
        </p>

    </div>


    {{-- PEMBUKA --}}
    <p class="isi">
        Yang bertanda tangan di bawah ini menerangkan bahwa:
    </p>


    {{-- DATA PENDUDUK --}}
    <table class="data">

        <tr>
            <td width="150">NIK</td>
            <td width="20">:</td>
            <td>{{ $pengajuan->penduduk->nik }}</td>
        </tr>

        <tr>
            <td>Nama Lengkap</td>
            <td>:</td>
            <td>{{ $pengajuan->penduduk->nama_lengkap }}</td>
        </tr>

        <tr>
            <td>Tempat, Tanggal Lahir</td>
            <td>:</td>
            <td>
                {{ $pengajuan->penduduk->tempat_lahir }},
                {{ \Carbon\Carbon::parse($pengajuan->penduduk->tanggal_lahir)->translatedFormat('d F Y') }}
            </td>
        </tr>

        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>
                {{ $pengajuan->penduduk->jenis_kelamin === 'L'
                    ? 'Laki-laki'
                    : 'Perempuan'
                }}
            </td>
        </tr>

        <tr>
            <td>Pekerjaan</td>
            <td>:</td>
            <td>{{ $pengajuan->penduduk->pekerjaan }}</td>
        </tr>

        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $pengajuan->penduduk->alamat }}</td>
        </tr>

    </table>


    {{-- ISI SURAT --}}
    <p class="isi">

        Berdasarkan data yang ada pada administrasi Pemerintah Desa,
        yang bersangkutan benar merupakan penduduk Desa [NAMA DESA]
        dan berdasarkan data administrasi yang ada termasuk dalam
        keluarga yang membutuhkan bantuan atau keterangan tidak mampu.

    </p>


    {{-- DETAIL SKTM --}}
    <p class="isi">

        Adapun data yang berkaitan dengan keterangan tersebut adalah:

    </p>

    <table class="data">

        <tr>
            <td width="200">Jumlah Anggota Keluarga</td>
            <td width="20">:</td>
            <td>
                {{ $pengajuan->detailSktm->jumlah_anggota_keluarga }}
                orang
            </td>
        </tr>

        <tr>
            <td>Penghasilan Per Bulan</td>
            <td>:</td>
            <td>
                Rp
                {{ number_format(
                    $pengajuan->detailSktm->penghasilan_per_bulan,
                    0,
                    ',',
                    '.'
                ) }}
            </td>
        </tr>

    </table>


    <p class="isi">

        Surat keterangan ini dibuat untuk keperluan:

    </p>

    <p class="isi">
        <strong>
            {{ $pengajuan->detailSktm->keperluan }}
        </strong>
    </p>


    <p class="isi">

        Demikian surat keterangan ini dibuat dengan sebenarnya
        untuk dapat dipergunakan sebagaimana mestinya.

    </p>


    {{-- TANDA TANGAN --}}
    <div class="ttd">

        <p>
            [NAMA DESA],
            {{ $surat->tanggal_terbit->translatedFormat('d F Y') }}
        </p>

        <p>
            Kepala Desa [NAMA DESA]
        </p>

        <br><br><br>

        <strong>
            [NAMA KEPALA DESA]
        </strong>

    </div>

</body>

</html>