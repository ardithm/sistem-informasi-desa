<?php

namespace Tests\Feature;

use App\Models\Layanan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class PengantarKkFlowTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function test_pengantar_kk_page_can_be_accessed(): void
    {
        Layanan::create([
            'kode' => 'SKKK',
            'nama_layanan' => 'Surat Pengantar KK',
            'deskripsi' => 'Test',
            'aktif' => true,
        ]);

        $response = $this->get('/layanan/pengantar-kk');

        $response->assertStatus(200)
            ->assertSee('Surat Pengantar KK');
    }
}
