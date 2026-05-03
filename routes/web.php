<?php

/**
 * Main Web Routes
 */

use App\Http\Controllers\AdminPengaduanController;
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
use App\Http\Controllers\WargaLaporanController;
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

    // =========================================================
    // ADMIN ROUTES
    // =========================================================
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');

        // Data Kependudukan
        Route::resource('keluarga', KeluargaController::class);
        Route::resource('warga', WargaController::class);

        // Informasi RT
        Route::resource('pengumuman', PengumumanController::class);
        Route::resource('kegiatan', KegiatanController::class);

        // Keuangan & Iuran
        Route::resource('jenis-iuran', JenisIuranController::class)->except(['show']);
        Route::resource('tagihan-iuran', TagihanIuranController::class)->only(['index', 'create', 'store', 'show']);
        Route::post('tagihan-iuran/generate', [TagihanIuranController::class, 'generateMasal'])->name('tagihan-iuran.generate');
        Route::post('tagihan-iuran/{tagihan}/konfirmasi', [TagihanIuranController::class, 'confirmPayment'])
            ->name('tagihan-iuran.konfirmasi');
        Route::post('pembayaran/{pembayaran}/verifikasi', [TagihanIuranController::class, 'verifyPayment'])
            ->name('pembayaran.verifikasi');

        // Pengaduan & Laporan Masalah (Sprint 6)
        Route::get('pengaduan', [AdminPengaduanController::class, 'index'])->name('pengaduan.index');
        Route::get('pengaduan/{laporan}', [AdminPengaduanController::class, 'show'])->name('pengaduan.show');
        Route::post('pengaduan/{laporan}/status', [AdminPengaduanController::class, 'updateStatus'])->name('pengaduan.status');
        Route::post('pengaduan/{laporan}/tanggapi', [AdminPengaduanController::class, 'tanggapi'])->name('pengaduan.tanggapi');

        // Rekap/Statistik (LaporanController yang sudah ada)
        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    });

    // =========================================================
    // WARGA ROUTES
    // =========================================================
    Route::middleware(['role:warga'])->prefix('warga')->name('warga.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'warga'])->name('dashboard');

        // Informasi RT (read-only)
        Route::get('pengumuman', [WargaPengumumanController::class, 'index'])->name('pengumuman.index');
        Route::get('pengumuman/{pengumuman}', [WargaPengumumanController::class, 'show'])->name('pengumuman.show');

        Route::get('kegiatan', [WargaKegiatanController::class, 'index'])->name('kegiatan.index');
        Route::get('kegiatan/{kegiatan}', [WargaKegiatanController::class, 'show'])->name('kegiatan.show');

        // Iuran (Sprint 5)
        Route::get('iuran', [WargaIuranController::class, 'index'])->name('iuran.index');
        Route::get('iuran/{tagihan}', [WargaIuranController::class, 'show'])->name('iuran.show');
        Route::post('iuran/{tagihan}/bayar', [WargaIuranController::class, 'pay'])->name('iuran.pay');

        // Laporan Masalah Lingkungan (Sprint 6)
        Route::get('laporan', [WargaLaporanController::class, 'index'])->name('laporan.index');
        Route::get('laporan/buat', [WargaLaporanController::class, 'create'])->name('laporan.create');
        Route::post('laporan', [WargaLaporanController::class, 'store'])->name('laporan.store');
        Route::get('laporan/{laporan}', [WargaLaporanController::class, 'show'])->name('laporan.show');
    });
});

require __DIR__.'/auth.php';