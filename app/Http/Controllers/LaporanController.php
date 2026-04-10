<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Keluarga;
use App\Models\PembayaranIuran;
use App\Models\Pengumuman;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        // Statistik Kependudukan
        $stats['warga_total'] = Warga::count();
        $stats['warga_laki'] = Warga::where('jenis_kelamin', 'Laki-laki')->count();
        $stats['warga_perempuan'] = Warga::where('jenis_kelamin', 'Perempuan')->count();
        $stats['keluarga_total'] = Keluarga::count();

        // Statistik Keuangan
        $stats['total_kas_masuk'] = PembayaranIuran::where('status_verifikasi', 'disetujui')->sum('jumlah_bayar');
        
        // Data untuk Chart/Laporan
        $stats['pengumuman_count'] = Pengumuman::count();
        $stats['kegiatan_count'] = Kegiatan::count();

        return view('admin.laporan.index', compact('stats'));
    }
}
