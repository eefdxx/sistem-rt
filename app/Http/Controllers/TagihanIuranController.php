<?php

namespace App\Http\Controllers;

use App\Models\TagihanIuran;
use App\Models\PembayaranIuran;
use App\Models\Warga;
use App\Models\JenisIuran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagihanIuranController extends Controller
{
    public function index()
    {
        $tagihans = TagihanIuran::with(['warga', 'jenisIuran'])->latest()->paginate(10);
        return view('admin.tagihan-iuran.index', compact('tagihans'));
    }

    public function create()
    {
        $wargas = Warga::select('id', 'nama_lengkap', 'nik')->orderBy('nama_lengkap')->get();
        $jenis_iurans = JenisIuran::where('is_active', true)->get();
        return view('admin.tagihan-iuran.create', compact('wargas', 'jenis_iurans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'warga_id' => 'required|exists:warga,id',
            'jenis_iuran_id' => 'required|exists:jenis_iuran,id',
            'periode_bulan' => 'nullable|integer|min:1|max:12',
            'periode_tahun' => 'required|integer|min:2020|max:2100',
            'nominal' => 'required|numeric|min:0',
            'jatuh_tempo' => 'nullable|date',
            'keterangan' => 'nullable|string',
        ]);

        $validated['dibuat_oleh'] = Auth::id();
        $validated['status'] = 'belum_bayar';

        TagihanIuran::create($validated);

        return redirect()->route('admin.tagihan-iuran.index')->with('success', 'Tagihan iuran berhasil diterbitkan.');
    }

    public function confirmPayment(Request $request, TagihanIuran $tagihan)
    {
        // Logika konfirmasi pembayaran manual oleh admin
        $pembayaran = PembayaranIuran::create([
            'tagihan_iuran_id' => $tagihan->id,
            'warga_id' => $tagihan->warga_id,
            'tanggal_bayar' => now(),
            'jumlah_bayar' => $tagihan->nominal,
            'metode_pembayaran' => 'tunai',
            'status_verifikasi' => 'disetujui',
            'diverifikasi_oleh' => Auth::id(),
            'tanggal_verifikasi' => now(),
            'catatan' => 'Dikonfirmasi manual oleh Admin',
        ]);

        $tagihan->update(['status' => 'lunas']);

        return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }
}
