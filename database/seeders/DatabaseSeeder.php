<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Layanan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Admin Desa
        |--------------------------------------------------------------------------
        */

        User::updateOrCreate(
            [
                'username' => 'admin',
            ],
            [
                'name' => 'Administrator Desa',
                'password' => Hash::make('admin12345'),
                'role' => 'admin',
                'is_active' => true,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Data Layanan
        |--------------------------------------------------------------------------
        */

        $layanans = [
            [
                'kode' => 'SKD',
                'nama_layanan' => 'Surat Keterangan Domisili',
                'deskripsi' => 'Layanan pembuatan Surat Keterangan Domisili.',
                'aktif' => true,
            ],
            [
                'kode' => 'SKTP',
                'nama_layanan' => 'Surat Pengantar KTP',
                'deskripsi' => 'Layanan pembuatan Surat Pengantar KTP.',
                'aktif' => true,
            ],
            [
                'kode' => 'SKKK',
                'nama_layanan' => 'Surat Pengantar KK',
                'deskripsi' => 'Layanan pembuatan Surat Pengantar KK.',
                'aktif' => true,
            ],
            [
                'kode' => 'SKTM',
                'nama_layanan' => 'Surat Keterangan Tidak Mampu',
                'deskripsi' => 'Layanan pembuatan Surat Keterangan Tidak Mampu (SKTM).',
                'aktif' => true,
            ],
        ];

        foreach ($layanans as $layanan) {
            Layanan::firstOrCreate(
                [
                    'kode' => $layanan['kode'],
                ],
                $layanan
            );
        }
    }
}
