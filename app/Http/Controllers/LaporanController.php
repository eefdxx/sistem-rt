<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Keluarga;
use App\Models\PembayaranIuran;
use App\Models\TagihanIuran;
use App\Models\Pengumuman;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        // 1. Kependudukan
        $total_keluarga = Keluarga::count();
        $total_warga = Warga::count();
        $warga_laki = Warga::where('jenis_kelamin', 'Laki-laki')->count();
        $warga_perempuan = Warga::where('jenis_kelamin', 'Perempuan')->count();

        // 2. Pengumuman & Kegiatan
        $total_pengumuman = Pengumuman::count();
        $pengumuman_publish = Pengumuman::where('status', 'publish')->count();
        $total_kegiatan = Kegiatan::count();
        $kegiatan_mendatang = Kegiatan::where('tanggal_mulai', '>=', now())->count();

        // 3. Keuangan
        $uang_masuk_terverifikasi = PembayaranIuran::where('status_verifikasi', 'disetujui')->sum('jumlah_bayar');
        
        // Asumsi TagihanIuran memiliki field nominal_tagihan dan status_pembayaran
        // Jika skema berbeda, kita sesuaikan dengan ketersediaan data
        $total_tagihan = TagihanIuran::sum('nominal_tagihan') ?? 0;
        $tagihan_lunas_count = TagihanIuran::where('status_pembayaran', 'lunas')->count();
        $tagihan_belum_bayar_count = TagihanIuran::where('status_pembayaran', 'belum_bayar')->count();
        
        $tagihan_bulan_ini = TagihanIuran::whereMonth('created_at', now()->month)
                                        ->whereYear('created_at', now()->year)
                                        ->sum('nominal_tagihan') ?? 0;

        $bulan_ini = now()->translatedFormat('F');
        $tahun_ini = now()->year;

        return view('admin.laporan.index', compact(
            'total_keluarga', 'total_warga', 'warga_laki', 'warga_perempuan',
            'total_pengumuman', 'pengumuman_publish', 'total_kegiatan', 'kegiatan_mendatang',
            'uang_masuk_terverifikasi', 'total_tagihan', 'tagihan_lunas_count', 'tagihan_belum_bayar_count',
            'tagihan_bulan_ini', 'bulan_ini', 'tahun_ini'
        ));
    }
}
