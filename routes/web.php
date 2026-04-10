<?php

use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'admin'])->name('dashboard');

        Route::resource('keluarga', KeluargaController::class);
        Route::resource('warga', WargaController::class);
        Route::resource('pengumuman', \App\Http\Controllers\PengumumanController::class);
        Route::resource('kegiatan', \App\Http\Controllers\KegiatanController::class);
        Route::resource('jenis-iuran', \App\Http\Controllers\JenisIuranController::class)->except(['show']);
        Route::resource('tagihan-iuran', \App\Http\Controllers\TagihanIuranController::class)->except(['edit', 'update', 'destroy', 'show']);
        Route::get('laporan', [\App\Http\Controllers\LaporanController::class, 'index'])->name('laporan.index');
        Route::post('tagihan-iuran/{tagihan}/konfirmasi', [\App\Http\Controllers\TagihanIuranController::class, 'confirmPayment'])->name('tagihan-iuran.konfirmasi');
    });

    Route::middleware(['role:warga'])->prefix('warga')->name('warga.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'warga'])->name('dashboard');
        
        Route::get('pengumuman', [\App\Http\Controllers\WargaPengumumanController::class, 'index'])->name('pengumuman.index');
        Route::get('pengumuman/{pengumuman}', [\App\Http\Controllers\WargaPengumumanController::class, 'show'])->name('pengumuman.show');
        
        Route::get('kegiatan', [\App\Http\Controllers\WargaKegiatanController::class, 'index'])->name('kegiatan.index');
        Route::get('kegiatan/{kegiatan}', [\App\Http\Controllers\WargaKegiatanController::class, 'show'])->name('kegiatan.show');

        // Iuran
        Route::get('iuran', [\App\Http\Controllers\WargaIuranController::class, 'index'])->name('iuran.index');
    });
});

require __DIR__.'/auth.php';