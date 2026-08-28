<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PendudukController;
use App\Http\Controllers\Admin\LayananController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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
    });


require __DIR__ . '/auth.php';
