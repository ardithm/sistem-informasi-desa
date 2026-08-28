<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PendudukController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\PublicController;
use App\Models\Berita;
use Illuminate\Support\Facades\Route;

Route::get('/', [
    PublicController::class,
    'home'
])->name('home');

Route::get('/profil', [
    PublicController::class,
    'profil'
])->name('profil');

Route::get('/sejarah', [
    PublicController::class,
    'sejarah'
])->name('sejarah');

Route::get('/visi-misi', [
    PublicController::class,
    'visiMisi'
])->name('visi-misi');

Route::get('/berita', [
    PublicController::class,
    'berita'
])->name('berita');

Route::get('/berita/{berita:slug}', [
    PublicController::class,
    'beritaShow'
])->name('berita.show');

Route::get('/layanan', [
    PublicController::class,
    'layanan'
])->name('layanan');

Route::get('/kontak', [
    PublicController::class,
    'kontak'
])->name('kontak');

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::patch(
            '/penduduks/{penduduk}/deactivate',
            [PendudukController::class, 'deactivate']
        )->name('penduduks.deactivate');

        Route::resource(
            'penduduks',
            PendudukController::class
        );

        Route::patch(
            '/layanans/{layanan}/deactivate',
            [LayananController::class, 'deactivate']
        )->name('layanans.deactivate');

        Route::resource(
            'layanans',
            LayananController::class
        );

        Route::resource(
            'beritas',
            BeritaController::class
        );
    });


require __DIR__ . '/auth.php';
