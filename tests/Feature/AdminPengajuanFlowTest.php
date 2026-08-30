<?php

namespace Tests\Feature;

use App\Models\Dokumen;
use App\Models\Layanan;
use App\Models\Penduduk;
use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminPengajuanFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_process_and_issue_surat_for_pengajuan(): void
    {
        Storage::fake('public');

        $admin = User::create([
            'name' => 'Admin Desa',
            'username' => 'admin',
            'password' => 'password123',
            'role' => 'admin',
            'is_active' => true,
        ]);

        $layanan = Layanan::create([
            'kode' => 'SKTP',
            'nama_layanan' => 'Surat Pengantar KTP',
            'deskripsi' => 'Test',
            'aktif' => true,
        ]);

        $penduduk = Penduduk::create([
            'nik' => '3201010101010003',
            'nama_lengkap' => 'Rudi Hermawan',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1988-02-17',
            'jenis_kelamin' => 'L',
            'status_perkawinan' => 'kawin',
            'pekerjaan' => 'Pegawai',
            'alamat' => 'Jl. Admin No. 3',
            'rt' => '03',
            'rw' => '04',
            'status_penduduk' => 'aktif',
        ]);

        $pengajuan = Pengajuan::create([
            'nomor_pengajuan' => 'SKTP-TEST-001',
            'penduduk_id' => $penduduk->id,
            'layanan_id' => $layanan->id,
            'no_hp' => '081234567890',
            'status' => 'diverifikasi',
        ]);

        $pengajuan->detailPengantarKtp()->create([
            'keperluan_ktp' => 'perubahan_data',
        ]);

        $pengajuan->dokumens()->createMany([
            [
                'jenis_dokumen' => 'KTP',
                'nama_file' => 'ktp.jpg',
                'path_file' => 'pengajuan/ktp.jpg',
                'mime_type' => 'image/jpeg',
                'ukuran_file' => 200,
                'status_verifikasi' => 'valid',
            ],
            [
                'jenis_dokumen' => 'KK',
                'nama_file' => 'kk.jpg',
                'path_file' => 'pengajuan/kk.jpg',
                'mime_type' => 'image/jpeg',
                'ukuran_file' => 200,
                'status_verifikasi' => 'valid',
            ],
        ]);

        $this->actingAs($admin)
            ->patch('/admin/pengajuan/' . $pengajuan->id . '/proses')
            ->assertRedirect();

        $response = $this->actingAs($admin)
            ->patch('/admin/pengajuan/' . $pengajuan->id . '/terbitkan-surat');

        $response->assertRedirect();
        $this->assertDatabaseHas('surats', [
            'pengajuan_id' => $pengajuan->id,
        ]);
    }
}
