<?php

namespace Tests\Feature;

use App\Models\Layanan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PengantarKtpFlowTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function test_pengantar_ktp_page_can_be_accessed(): void
    {
        Layanan::create([
            'kode' => 'SKTP',
            'nama_layanan' => 'Surat Pengantar KTP',
            'deskripsi' => 'Test',
            'aktif' => true,
        ]);

        $response = $this->get('/layanan/pengantar-ktp');

        $response->assertStatus(200)
            ->assertSee('Surat Pengantar KTP');
    }

    public function test_pengantar_ktp_submission_redirects_to_success_page(): void
    {
        Storage::fake('public');

        Layanan::create([
            'kode' => 'SKTP',
            'nama_layanan' => 'Surat Pengantar KTP',
            'deskripsi' => 'Test',
            'aktif' => true,
        ]);

        $penduduk = \App\Models\Penduduk::create([
            'nik' => '3201010101010002',
            'nama_lengkap' => 'Siti Nurhayati',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1992-05-10',
            'jenis_kelamin' => 'P',
            'status_perkawinan' => 'belum_kawin',
            'pekerjaan' => 'Guru',
            'alamat' => 'Jl. Contoh No. 5',
            'rt' => '01',
            'rw' => '02',
            'status_penduduk' => 'aktif',
        ]);

        $response = $this->withSession([
            'pengantar_ktp.penduduk_id' => $penduduk->id,
            'pengantar_ktp.layanan_id' => Layanan::first()->id,
            'pengantar_ktp.no_hp' => '081234567890',
        ])->post('/layanan/pengantar-ktp/store', [
            'nik' => $penduduk->nik,
            'penduduk_id' => $penduduk->id,
            'layanan_id' => Layanan::first()->id,
            'no_hp' => '081234567890',
            'keperluan_ktp' => 'perubahan_data',
            'ktp' => UploadedFile::fake()->create('ktp.jpg', 200, 'image/jpeg'),
            'kk' => UploadedFile::fake()->create('kk.jpg', 200, 'image/jpeg'),
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Pengajuan Surat Pengantar KTP berhasil dibuat.');
        $this->assertDatabaseHas('pengajuans', [
            'penduduk_id' => $penduduk->id,
            'no_hp' => '081234567890',
        ]);
    }
}
