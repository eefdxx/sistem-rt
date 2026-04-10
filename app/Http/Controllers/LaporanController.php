<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Models\Warga;
use App\Models\Pengumuman;
use App\Models\Kegiatan;
use App\Models\TagihanIuran;
use App\Models\PembayaranIuran;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // 1. Populasi
        $total_keluarga = Keluarga::count();
        $total_warga = Warga::count();
        $warga_laki = Warga::where('jenis_kelamin', 'Laki-laki')->count();
        $warga_perempuan = Warga::where('jenis_kelamin', 'Perempuan')->count();

        // 2. Publikasi & Informasi
        $total_pengumuman = Pengumuman::count();
        $pengumuman_publish = Pengumuman::where('status', 'publish')->count();
        
        $total_kegiatan = Kegiatan::count();
        $kegiatan_mendatang = Kegiatan::where('status', 'mendatang')->count();

        // 3. Iuran & Keuangan (Lifetime)
        $total_tagihan = TagihanIuran::sum('nominal');
        $tagihan_lunas_count = TagihanIuran::where('status', 'lunas')->count();
        $tagihan_belum_bayar_count = TagihanIuran::where('status', 'belum_dibayar')->count();
        
        $uang_masuk_terverifikasi = PembayaranIuran::where('status_verifikasi', 'terverifikasi')->sum('jumlah_bayar');

        // 4. Statistik Bulan Bertajuk (Bulan Ini)
        $bulan_ini = Carbon::now()->format('F');
        $tahun_ini = Carbon::now()->format('Y');

        $tagihan_bulan_ini = TagihanIuran::where('periode_bulan', $bulan_ini)
            ->where('periode_tahun', $tahun_ini)
            ->sum('nominal');

        return view('admin.laporan.index', compact(
            'total_keluarga', 'total_warga', 'warga_laki', 'warga_perempuan',
            'total_pengumuman', 'pengumuman_publish',
            'total_kegiatan', 'kegiatan_mendatang',
            'total_tagihan', 'tagihan_lunas_count', 'tagihan_belum_bayar_count',
            'uang_masuk_terverifikasi',
            'bulan_ini', 'tahun_ini', 'tagihan_bulan_ini'
        ));
    }
}
