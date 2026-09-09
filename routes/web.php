<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PendudukController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\AdminPengajuanController;
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

Route::get('/kontak', [
    PublicController::class,
    'kontak'
])->name('kontak');

Route::get('/layanan', [
    PublicController::class,
    'layanan'
])->name('layanan');

Route::get('/layanan/domisili', [
    PublicController::class,
    'domisili'
])->name('layanan.domisili');

Route::post('/layanan/domisili/verifikasi', [
    PublicController::class,
    'verifikasiDomisili'
])->name('layanan.domisili.verifikasi');

Route::get('/layanan/domisili/form', [
    PublicController::class,
    'formDomisili'
])->name('layanan.domisili.form');

Route::post('/layanan/domisili/store', [
    PublicController::class,
    'storeDomisili'
])->name('layanan.domisili.store');

Route::get('/layanan/domisili/berhasil/{pengajuan}', [
    PublicController::class,
    'domisiliBerhasil'
])->name('layanan.domisili.berhasil');

Route::get('/layanan/pengantar-kk', [
    PublicController::class,
    'pengantarKk'
])->name('layanan.pengantar-kk');

Route::post('/layanan/pengantar-kk/verifikasi', [
    PublicController::class,
    'verifikasiPengantarKk'
])->name('layanan.pengantar-kk.verifikasi');

Route::get('/layanan/pengantar-kk/form', [
    PublicController::class,
    'formPengantarKk'
])->name('layanan.pengantar-kk.form');

Route::post('/layanan/pengantar-kk/store', [
    PublicController::class,
    'storePengantarKk'
])->name('layanan.pengantar-kk.store');

Route::get('/layanan/pengantar-kk/berhasil/{pengajuan}', [
    PublicController::class,
    'pengantarKkBerhasil'
])->name('layanan.pengantar-kk.berhasil');

Route::get('/layanan/pengantar-ktp', [
    PublicController::class,
    'pengantarKtp'
])->name('layanan.pengantar-ktp');

Route::post('/layanan/pengantar-ktp/verifikasi', [
    PublicController::class,
    'verifikasiPengantarKtp'
])->name('layanan.pengantar-ktp.verifikasi');

Route::get('/layanan/pengantar-ktp/form', [
    PublicController::class,
    'formPengantarKtp'
])->name('layanan.pengantar-ktp.form');

Route::post('/layanan/pengantar-ktp/store', [
    PublicController::class,
    'storePengantarKtp'
])->name('layanan.pengantar-ktp.store');

Route::get('/layanan/pengantar-ktp/berhasil/{pengajuan}', [
    PublicController::class,
    'pengantarKtpBerhasil'
])->name('layanan.pengantar-ktp.berhasil');

Route::get('/layanan/sktm', [
    PublicController::class,
    'sktm'
])->name('layanan.sktm');

Route::post('/layanan/sktm/verifikasi', [
    PublicController::class,
    'verifikasiSktm'
])->name('layanan.sktm.verifikasi');

Route::get('/layanan/sktm/form', [
    PublicController::class,
    'formSktm'
])->name('layanan.sktm.form');

Route::post('/layanan/sktm/store', [
    PublicController::class,
    'storeSktm'
])->name('layanan.sktm.store');

Route::get('/layanan/sktm/berhasil/{pengajuan}', [
    PublicController::class,
    'sktmBerhasil'
])->name('layanan.sktm.berhasil');

Route::get('/status-pengajuan', [
    PublicController::class,
    'status'
])->name('status');

Route::post('/status-pengajuan/cek', [
    PublicController::class,
    'cekStatus'
])->name('status.cek');

Route::get('/status-pengajuan/{pengajuan}/hasil', [
    PublicController::class,
    'hasilStatus'
])->name('status.hasil');

Route::get(
    '/status-pengajuan/{pengajuan}/revisi/{dokumen}',
    [PublicController::class, 'formRevisiDokumen']
)->name('status.revisi');

Route::post(
    '/status-pengajuan/{pengajuan}/revisi/{dokumen}',
    [PublicController::class, 'revisiDokumen']
)->name('status.revisi.store');

Route::get('/status-pengajuan/{pengajuan}/surat', [
    PublicController::class,
    'lihatSurat'
])->name('status.surat');

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

        Route::get(
            '/pengajuan',
            [AdminPengajuanController::class, 'index']
        )->name('pengajuan.index');

        Route::get(
            '/pengajuan/{pengajuan}',
            [AdminPengajuanController::class, 'show']
        )->name('pengajuan.show');

        Route::patch(
            '/pengajuan/dokumen/{dokumen}/verifikasi',
            [AdminPengajuanController::class, 'verifikasiDokumen']
        )->name('pengajuan.dokumen.verifikasi');

        Route::patch(
            '/pengajuan/{pengajuan}/proses',
            [AdminPengajuanController::class, 'proses']
        )->name('pengajuan.proses');

        Route::patch(
            '/pengajuan/{pengajuan}/selesai',
            [AdminPengajuanController::class, 'selesai']
        )->name('pengajuan.selesai');

        Route::patch(
            '/pengajuan/{pengajuan}/terbitkan-surat',
            [AdminPengajuanController::class, 'terbitkanSurat']
        )->name('pengajuan.terbitkan-surat');

        Route::get(
            '/pengajuan/{pengajuan}/surat',
            [AdminPengajuanController::class, 'lihatSurat']
        )->name('pengajuan.surat');

        Route::get(
            '/laporan',
            [\App\Http\Controllers\Admin\LaporanController::class, 'index']
        )->name('laporan.index');

        Route::get(
            '/laporan/cetak-penduduk',
            [\App\Http\Controllers\Admin\LaporanController::class, 'cetakPenduduk']
        )->name('laporan.cetak-penduduk');

        Route::get(
            '/laporan/cetak-surat',
            [\App\Http\Controllers\Admin\LaporanController::class, 'cetakSuratKeluar']
        )->name('laporan.cetak-surat');

        /*
        |--------------------------------------------------------------------------
        | Super Admin User Management
        |--------------------------------------------------------------------------
        */
        Route::middleware('super_admin')->group(function () {
            Route::get('/users', [\App\Http\Controllers\Admin\AdminUserController::class, 'index'])->name('users.index');
            Route::get('/users/create', [\App\Http\Controllers\Admin\AdminUserController::class, 'create'])->name('users.create');
            Route::post('/users', [\App\Http\Controllers\Admin\AdminUserController::class, 'store'])->name('users.store');
            Route::get('/users/{user}/edit', [\App\Http\Controllers\Admin\AdminUserController::class, 'edit'])->name('users.edit');
            Route::put('/users/{user}', [\App\Http\Controllers\Admin\AdminUserController::class, 'update'])->name('users.update');
            Route::patch('/users/{user}/toggle-active', [\App\Http\Controllers\Admin\AdminUserController::class, 'toggleActive'])->name('users.toggle-active');
            Route::delete('/users/{user}', [\App\Http\Controllers\Admin\AdminUserController::class, 'destroy'])->name('users.destroy');
        });
    });


require __DIR__ . '/auth.php';
