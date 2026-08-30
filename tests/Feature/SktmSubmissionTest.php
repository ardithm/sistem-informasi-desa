<?php

namespace Tests\Feature;

use App\Models\Layanan;
use App\Models\Penduduk;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SktmSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_sktm_submission_redirects_to_success_page(): void
    {
        Storage::fake('local');

        Layanan::create([
            'kode' => 'SKTM',
            'nama_layanan' => 'Surat Keterangan Tidak Mampu',
            'deskripsi' => 'Test',
            'aktif' => true,
        ]);

        $penduduk = Penduduk::create([
            'nik' => '3201010101010001',
            'nama_lengkap' => 'Budi Santoso',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1990-01-01',
            'jenis_kelamin' => 'L',
            'status_perkawinan' => 'kawin',
            'pekerjaan' => 'Wiraswasta',
            'alamat' => 'Jl. Contoh No. 1',
            'rt' => '01',
            'rw' => '02',
            'status_penduduk' => 'aktif',
        ]);

        $response = $this->withSession([
            'sktm.penduduk_id' => $penduduk->id,
            'sktm.no_hp' => '081234567890',
        ])->post('/layanan/sktm/store', [
            'nik' => $penduduk->nik,
            'penduduk_id' => $penduduk->id,
            'no_hp' => '081234567890',
            'jumlah_anggota_keluarga' => 4,
            'penghasilan_per_bulan' => 2000000,
            'keperluan' => 'Untuk keperluan bantuan sosial.',
            'ktp' => UploadedFile::fake()->create('ktp.jpg', 200, 'image/jpeg'),
            'kk' => UploadedFile::fake()->create('kk.jpg', 200, 'image/jpeg'),
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Pengajuan SKTM berhasil dibuat.');
        $this->assertDatabaseHas('pengajuans', [
            'penduduk_id' => $penduduk->id,
            'no_hp' => '081234567890',
        ]);
    }
}
