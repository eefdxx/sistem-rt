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
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('keluarga', KeluargaController::class);
        Route::resource('warga', WargaController::class);
    });

    Route::middleware(['role:warga'])->prefix('warga')->name('warga.')->group(function () {
        Route::get('/dashboard', function () {
            return view('warga.dashboard');
        })->name('dashboard');
    });
});

require __DIR__.'/auth.php';