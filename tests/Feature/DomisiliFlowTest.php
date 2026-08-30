<?php

namespace Tests\Feature;

use App\Models\Layanan;
use App\Models\Penduduk;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DomisiliFlowTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function test_domisili_page_can_be_accessed(): void
    {
        Layanan::create([
            'kode' => 'SKD',
            'nama_layanan' => 'Surat Keterangan Domisili',
            'deskripsi' => 'Test',
            'aktif' => true,
        ]);

        $response = $this->get('/layanan/domisili');

        $response->assertStatus(200)
            ->assertSee('Surat Keterangan Domisili');
    }

    public function test_domisili_submission_redirects_to_success_page(): void
    {
        Storage::fake('public');

        Layanan::create([
            'kode' => 'SKD',
            'nama_layanan' => 'Surat Keterangan Domisili',
            'deskripsi' => 'Test',
            'aktif' => true,
        ]);

        $penduduk = Penduduk::create([
            'nik' => '3201010101010002',
            'nama_lengkap' => 'Budi Santoso',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1990-01-15',
            'jenis_kelamin' => 'L',
            'status_perkawinan' => 'kawin',
            'pekerjaan' => 'Karyawan',
            'alamat' => 'Jl. Contoh No. 1',
            'rt' => '01',
            'rw' => '02',
            'status_penduduk' => 'aktif',
        ]);

        $response = $this->withSession([
            'domisili.penduduk_id' => $penduduk->id,
            'domisili.layanan_id' => Layanan::first()->id,
            'domisili.no_hp' => '081234567890',
        ])->post('/layanan/domisili/store', [
            'penduduk_id' => $penduduk->id,
            'layanan_id' => Layanan::first()->id,
            'no_hp' => '081234567890',
            'alamat_domisili' => 'Jl. Merdeka No. 10',
            'keperluan' => 'Keperluan administrasi kerja',
            'ktp' => UploadedFile::fake()->create('ktp.jpg', 200, 'image/jpeg'),
            'kk' => UploadedFile::fake()->create('kk.jpg', 200, 'image/jpeg'),
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Pengajuan Surat Keterangan Domisili berhasil dikirim.');
        $this->assertDatabaseHas('pengajuans', [
            'penduduk_id' => $penduduk->id,
            'no_hp' => '081234567890',
        ]);
    }
}
