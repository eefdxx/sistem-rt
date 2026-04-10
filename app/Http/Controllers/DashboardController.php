<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Models\Warga;
use App\Models\Pengumuman;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Centralized dashboard router
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user->role) {
            abort(403, 'Role tidak didefinisikan untuk akun ini.');
        }

        if ($user->role->nama_role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role->nama_role === 'warga') {
            return redirect()->route('warga.dashboard');
        }

        abort(403, 'Akses ditolak.');
    }

    /**
     * Admin specific dashboard
     */
    public function admin()
    {
        $total_keluarga = Keluarga::count();
        $total_warga = Warga::count();
        $laporan_aktif = Pengumuman::where('status', 'publish')->count() + Kegiatan::where('status', 'mendatang')->count();

        return view('admin.dashboard', compact('total_keluarga', 'total_warga', 'laporan_aktif'));
    }

    /**
     * Warga specific dashboard
     */
    public function warga()
    {
        // Eager load everything needed for the widgets to be fast
        $pengumuman_terbaru = Pengumuman::where('status', 'publish')
            ->latest()
            ->take(3)
            ->get();

        $kegiatan_mendatang = Kegiatan::where('status', 'mendatang')
            ->latest()
            ->take(3)
            ->get();

        return view('warga.dashboard', compact('pengumuman_terbaru', 'kegiatan_mendatang'));
    }
}
