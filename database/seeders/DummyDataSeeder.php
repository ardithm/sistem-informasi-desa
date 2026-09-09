<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Layanan;
use App\Models\Penduduk;
use App\Models\Berita;
use App\Models\Pengajuan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();
        if (!$admin) {
            $this->call(DatabaseSeeder::class);
            $admin = User::first();
        }

        // ==========================================
        // 1. DATA PENDUDUK (15 Penduduk untuk Uji Pagination & Filter)
        // ==========================================
        $pendudukList = [
            [
                'nik' => '3201010101900001',
                'nama_lengkap' => 'Ahmad Fauzi',
                'tempat_lahir' => 'Bogor',
                'tanggal_lahir' => '1990-01-01',
                'jenis_kelamin' => 'L',
                'status_perkawinan' => 'kawin',
                'pekerjaan' => 'Wiraswasta',
                'alamat' => 'Jl. Mawar No. 12',
                'rt' => '01',
                'rw' => '02',
                'status_penduduk' => 'aktif',
            ],
            [
                'nik' => '3201010202920002',
                'nama_lengkap' => 'Budi Santoso',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '1992-02-02',
                'jenis_kelamin' => 'L',
                'status_perkawinan' => 'kawin',
                'pekerjaan' => 'Karyawan Swasta',
                'alamat' => 'Jl. Melati No. 5',
                'rt' => '02',
                'rw' => '02',
                'status_penduduk' => 'aktif',
            ],
            [
                'nik' => '3201010303950003',
                'nama_lengkap' => 'Citra Dewi Lestari',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1995-03-15',
                'jenis_kelamin' => 'P',
                'status_perkawinan' => 'belum_kawin',
                'pekerjaan' => 'Guru',
                'alamat' => 'Jl. Kenanga No. 8',
                'rt' => '01',
                'rw' => '01',
                'status_penduduk' => 'aktif',
            ],
            [
                'nik' => '3201010404880004',
                'nama_lengkap' => 'Dedi Kurniawan',
                'tempat_lahir' => 'Sukabumi',
                'tanggal_lahir' => '1988-04-20',
                'jenis_kelamin' => 'L',
                'status_perkawinan' => 'kawin',
                'pekerjaan' => 'PNS',
                'alamat' => 'Jl. Cempaka No. 21',
                'rt' => '03',
                'rw' => '01',
                'status_penduduk' => 'aktif',
            ],
            [
                'nik' => '3201010505930005',
                'nama_lengkap' => 'Eka Rahmawati',
                'tempat_lahir' => 'Cianjur',
                'tanggal_lahir' => '1993-05-12',
                'jenis_kelamin' => 'P',
                'status_perkawinan' => 'kawin',
                'pekerjaan' => 'Ibu Rumah Tangga',
                'alamat' => 'Jl. Anggrek No. 14',
                'rt' => '02',
                'rw' => '03',
                'status_penduduk' => 'aktif',
            ],
            [
                'nik' => '3201010606850006',
                'nama_lengkap' => 'Fajar Nugraha',
                'tempat_lahir' => 'Bogor',
                'tanggal_lahir' => '1985-06-18',
                'jenis_kelamin' => 'L',
                'status_perkawinan' => 'cerai_hidup',
                'pekerjaan' => 'Petani',
                'alamat' => 'Kampung Babakan No. 3',
                'rt' => '04',
                'rw' => '02',
                'status_penduduk' => 'aktif',
            ],
            [
                'nik' => '3201010707990007',
                'nama_lengkap' => 'Gita Permata',
                'tempat_lahir' => 'Depok',
                'tanggal_lahir' => '1999-07-25',
                'jenis_kelamin' => 'P',
                'status_perkawinan' => 'belum_kawin',
                'pekerjaan' => 'Mahasiswa',
                'alamat' => 'Jl. Flamboyan No. 9',
                'rt' => '01',
                'rw' => '03',
                'status_penduduk' => 'aktif',
            ],
            [
                'nik' => '3201010808800008',
                'nama_lengkap' => 'Hadi Sucipto',
                'tempat_lahir' => 'Solo',
                'tanggal_lahir' => '1980-08-10',
                'jenis_kelamin' => 'L',
                'status_perkawinan' => 'kawin',
                'pekerjaan' => 'Pedagang',
                'alamat' => 'Jl. Pasar Baru No. 1',
                'rt' => '02',
                'rw' => '01',
                'status_penduduk' => 'aktif',
            ],
            [
                'nik' => '3201010909940009',
                'nama_lengkap' => 'Indah Kusuma Wardani',
                'tempat_lahir' => 'Semarang',
                'tanggal_lahir' => '1994-09-09',
                'jenis_kelamin' => 'P',
                'status_perkawinan' => 'kawin',
                'pekerjaan' => 'Bidan',
                'alamat' => 'Jl. Kesehatan No. 4',
                'rt' => '03',
                'rw' => '02',
                'status_penduduk' => 'aktif',
            ],
            [
                'nik' => '3201011010910010',
                'nama_lengkap' => 'Joko Triyono',
                'tempat_lahir' => 'Yogyakarta',
                'tanggal_lahir' => '1991-10-10',
                'jenis_kelamin' => 'L',
                'status_perkawinan' => 'kawin',
                'pekerjaan' => 'Buruh',
                'alamat' => 'Jl. Gotong Royong No. 17',
                'rt' => '04',
                'rw' => '03',
                'status_penduduk' => 'aktif',
            ],
            [
                'nik' => '3201011111970011',
                'nama_lengkap' => 'Kartika Sari',
                'tempat_lahir' => 'Malang',
                'tanggal_lahir' => '1997-11-11',
                'jenis_kelamin' => 'P',
                'status_perkawinan' => 'belum_kawin',
                'pekerjaan' => 'Desainer Grafis',
                'alamat' => 'Jl. Teratai No. 2',
                'rt' => '01',
                'rw' => '02',
                'status_penduduk' => 'aktif',
            ],
            [
                'nik' => '3201011212870012',
                'nama_lengkap' => 'Lukman Hakim',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '1987-12-12',
                'jenis_kelamin' => 'L',
                'status_perkawinan' => 'kawin',
                'pekerjaan' => 'Mekanik',
                'alamat' => 'Jl. Dahlia No. 11',
                'rt' => '02',
                'rw' => '02',
                'status_penduduk' => 'tidak_aktif',
            ],
            [
                'nik' => '3201011301960013',
                'nama_lengkap' => 'Mega Utami',
                'tempat_lahir' => 'Bogor',
                'tanggal_lahir' => '1996-01-22',
                'jenis_kelamin' => 'P',
                'status_perkawinan' => 'belum_kawin',
                'pekerjaan' => 'Staf Administrasi',
                'alamat' => 'Jl. Kemuning No. 7',
                'rt' => '03',
                'rw' => '01',
                'status_penduduk' => 'aktif',
            ],
            [
                'nik' => '3201011402890014',
                'nama_lengkap' => 'Nurdin Hidayat',
                'tempat_lahir' => 'Tasikmalaya',
                'tanggal_lahir' => '1989-02-14',
                'jenis_kelamin' => 'L',
                'status_perkawinan' => 'kawin',
                'pekerjaan' => 'Supir',
                'alamat' => 'Kampung Sawah No. 6',
                'rt' => '04',
                'rw' => '01',
                'status_penduduk' => 'tidak_aktif',
            ],
            [
                'nik' => '3201011503930015',
                'nama_lengkap' => 'Olivia Putri',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '1993-03-30',
                'jenis_kelamin' => 'P',
                'status_perkawinan' => 'kawin',
                'pekerjaan' => 'Apoteker',
                'alamat' => 'Jl. Sejahtera No. 19',
                'rt' => '02',
                'rw' => '03',
                'status_penduduk' => 'aktif',
            ],
        ];

        $createdPenduduks = [];
        foreach ($pendudukList as $p) {
            $createdPenduduks[] = Penduduk::updateOrCreate(['nik' => $p['nik']], $p);
        }

        // ==========================================
        // 2. DATA BERITA (12 Berita untuk Uji Pagination & Filter)
        // ==========================================
        $beritaList = [
            [
                'judul' => 'Penyaluran Bantuan Langsung Tunai (BLT) Tahap 3 Berjalan Lancar',
                'isi' => 'Pemerintah desa menyalurkan BLT kepada keluarga penerima manfaat di balai desa dengan tertib dan lancar.',
                'status' => 'published',
                'published_at' => now()->subDays(1),
            ],
            [
                'judul' => 'Kerja Bakti Warga Bersihkan Saluran Irigasi Jelang Musim Hujan',
                'isi' => 'Warga secara serentak bergotong royong membersihkan saluran air dan drainase desa demi mencegah genangan air.',
                'status' => 'published',
                'published_at' => now()->subDays(3),
            ],
            [
                'judul' => 'Sosialisasi Program Pembuatan KTP dan KIA Gratis',
                'isi' => 'Dinas Kependudukan bekerja sama dengan kantor desa memberikan layanan jemput bola rekam KTP dan cetak KIA.',
                'status' => 'published',
                'published_at' => now()->subDays(5),
            ],
            [
                'judul' => 'Pelatihan Kewirausahaan dan UMKM Digital untuk Pemuda Desa',
                'isi' => 'Puluhan pemuda desa antusias mengikuti workshop pemanfaatan media sosial untuk pemasaran produk lokal.',
                'status' => 'published',
                'published_at' => now()->subDays(7),
            ],
            [
                'judul' => 'Jadwal Imunisasi Balita dan Posyandu Bulan Ini',
                'isi' => 'Posyandu Mawar mengumumkan jadwal pemeriksaan kesehatan balita dan lansia secara berkala.',
                'status' => 'published',
                'published_at' => now()->subDays(9),
            ],
            [
                'judul' => 'Rencana Pembangunan Jembatan Penghubung Antar Dusun',
                'isi' => 'Musyawarah desa menyepakati anggaran perbaikan jembatan utama yang menghubungkan Dusun 1 dan Dusun 2.',
                'status' => 'published',
                'published_at' => now()->subDays(12),
            ],
            [
                'judul' => 'Turnamen Sepak Bola Antar RW Memperingati Hari Kemerdekaan',
                'isi' => 'Kompetisi olahraga antar RW resmi dibuka dengan antusiasme tinggi dari masyarakat desa.',
                'status' => 'published',
                'published_at' => now()->subDays(15),
            ],
            [
                'judul' => 'Panen Raya Padi Organik Kelompok Tani Makmur',
                'isi' => 'Hasil panen padi musim ini meningkat 20% berkat penerapan pupuk organik binaan penyuluh pertanian.',
                'status' => 'published',
                'published_at' => now()->subDays(18),
            ],
            [
                'judul' => 'Peringatan Maulid Nabi Muhammad SAW di Masjid Jami',
                'isi' => 'Warga desa menghadiri pengajian akbar dan doa bersama di masjid utama desa.',
                'status' => 'published',
                'published_at' => now()->subDays(20),
            ],
            [
                'judul' => 'Pembaruan Data DTKS Warga Kurang Mampu',
                'isi' => 'Petugas desa melakukan verifikasi lapangan guna memastikan bantuan sosial tepat sasaran.',
                'status' => 'published',
                'published_at' => now()->subDays(22),
            ],
            [
                'judul' => 'Draft Rencana Anggaran Pendapatan dan Belanja Desa (RAPBDes) 2027',
                'isi' => 'Dokumen pembahasan anggaran pendapatan dan belanja desa untuk tahun anggaran berikutnya.',
                'status' => 'draft',
                'published_at' => null,
            ],
            [
                'judul' => 'Draft Petunjuk Teknis Lomba Kebersihan Lingkungan RW',
                'isi' => 'Panduan dan kriteria penilaian lomba kebersihan tingkat rukun warga tahun ini.',
                'status' => 'draft',
                'published_at' => null,
            ],
        ];

        foreach ($beritaList as $b) {
            Berita::updateOrCreate(
                ['slug' => Str::slug($b['judul'])],
                [
                    'user_id' => $admin->id,
                    'judul' => $b['judul'],
                    'slug' => Str::slug($b['judul']),
                    'isi' => $b['isi'],
                    'status' => $b['status'],
                    'published_at' => $b['published_at'],
                ]
            );
        }

        // ==========================================
        // 3. DATA PENGAJUAN (15 Pengajuan untuk Uji Pagination & Filter)
        // ==========================================
        $layanans = Layanan::all();
        if ($layanans->isNotEmpty() && count($createdPenduduks) > 0) {
            $statuses = ['menunggu', 'diverifikasi', 'diproses', 'selesai', 'perlu_perbaikan', 'ditolak'];
            
            for ($i = 1; $i <= 15; $i++) {
                $p = $createdPenduduks[($i - 1) % count($createdPenduduks)];
                $l = $layanans[($i - 1) % $layanans->count()];
                $status = $statuses[($i - 1) % count($statuses)];

                Pengajuan::updateOrCreate(
                    ['nomor_pengajuan' => 'REG-' . date('Ymd') . '-' . str_pad($i, 4, '0', STR_PAD_LEFT)],
                    [
                        'penduduk_id' => $p->id,
                        'layanan_id' => $l->id,
                        'no_hp' => '0812' . rand(10000000, 99999999),
                        'status' => $status,
                        'catatan_admin' => $status === 'selesai' ? 'Dokumen telah selesai diproses dan siap diambil.' : null,
                        'diproses_oleh' => in_array($status, ['diproses', 'selesai', 'ditolak']) ? $admin->id : null,
                        'tanggal_diproses' => in_array($status, ['diproses', 'selesai', 'ditolak']) ? now()->subDays(rand(1, 5)) : null,
                        'tanggal_selesai' => $status === 'selesai' ? now()->subHours(rand(1, 24)) : null,
                    ]
                );
            }
        }
    }
}
