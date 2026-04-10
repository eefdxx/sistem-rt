<?php

/**
 * Main Web Routes
 */

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisIuranController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\TagihanIuranController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\WargaIuranController;
use App\Http\Controllers\WargaKegiatanController;
use App\Http\Controllers\WargaPengumumanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');

        Route::resource('keluarga', KeluargaController::class);
        Route::resource('warga', WargaController::class);
        Route::resource('pengumuman', PengumumanController::class);
        Route::resource('kegiatan', KegiatanController::class);
        Route::resource('jenis-iuran', JenisIuranController::class)->except(['show']);
        Route::resource('tagihan-iuran', TagihanIuranController::class)->except(['edit', 'update', 'destroy', 'show']);
        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::post('tagihan-iuran/{tagihan}/konfirmasi', [TagihanIuranController::class, 'confirmPayment'])->name('tagihan-iuran.konfirmasi');
    });

    Route::middleware(['role:warga'])->prefix('warga')->name('warga.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'warga'])->name('dashboard');
        
        Route::get('pengumuman', [WargaPengumumanController::class, 'index'])->name('pengumuman.index');
        Route::get('pengumuman/{pengumuman}', [WargaPengumumanController::class, 'show'])->name('pengumuman.show');
        
        Route::get('kegiatan', [WargaKegiatanController::class, 'index'])->name('kegiatan.index');
        Route::get('kegiatan/{kegiatan}', [WargaKegiatanController::class, 'show'])->name('kegiatan.show');

        // Iuran
        Route::get('iuran', [WargaIuranController::class, 'index'])->name('iuran.index');
    });
});

require __DIR__.'/auth.php';