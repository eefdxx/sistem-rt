<?php

use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->role && $user->role->nama_role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role && $user->role->nama_role === 'warga') {
            return redirect()->route('warga.dashboard');
        }

        abort(403, 'Role tidak dikenali');
    })->name('dashboard');

    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            $total_keluarga = \App\Models\Keluarga::count();
            $total_warga = \App\Models\Warga::count();
            $laporan_aktif = \App\Models\Pengumuman::where('status', 'publish')->count() + \App\Models\Kegiatan::where('status', 'mendatang')->count();
            return view('admin.dashboard', compact('total_keluarga', 'total_warga', 'laporan_aktif'));
        })->name('dashboard');

        Route::resource('keluarga', KeluargaController::class);
        Route::resource('warga', WargaController::class);
        Route::resource('pengumuman', \App\Http\Controllers\PengumumanController::class);
        Route::resource('kegiatan', \App\Http\Controllers\KegiatanController::class);
        Route::resource('jenis-iuran', \App\Http\Controllers\JenisIuranController::class)->except(['show']);
        Route::resource('tagihan-iuran', \App\Http\Controllers\TagihanIuranController::class)->except(['edit', 'update', 'destroy', 'show']);
        Route::post('tagihan-iuran/{tagihan}/konfirmasi', [\App\Http\Controllers\TagihanIuranController::class, 'confirmPayment'])->name('tagihan-iuran.konfirmasi');
        Route::get('laporan', [\App\Http\Controllers\LaporanController::class, 'index'])->name('laporan.index');
    });

    Route::middleware(['role:warga'])->prefix('warga')->name('warga.')->group(function () {
        Route::get('/dashboard', function () {
            $pengumuman_terbaru = \App\Models\Pengumuman::where('status', 'publish')->latest()->take(3)->get();
            $kegiatan_mendatang = \App\Models\Kegiatan::where('status', 'mendatang')->latest()->take(3)->get();
            return view('warga.dashboard', compact('pengumuman_terbaru', 'kegiatan_mendatang'));
        })->name('dashboard');
        
        Route::get('pengumuman', [\App\Http\Controllers\WargaPengumumanController::class, 'index'])->name('pengumuman.index');
        Route::get('pengumuman/{pengumuman}', [\App\Http\Controllers\WargaPengumumanController::class, 'show'])->name('pengumuman.show');
        
        Route::get('kegiatan', [\App\Http\Controllers\WargaKegiatanController::class, 'index'])->name('kegiatan.index');
        Route::get('kegiatan/{kegiatan}', [\App\Http\Controllers\WargaKegiatanController::class, 'show'])->name('kegiatan.show');

        // Iuran
        Route::get('iuran', [\App\Http\Controllers\WargaIuranController::class, 'index'])->name('iuran.index');
    });
});

require __DIR__.'/auth.php';