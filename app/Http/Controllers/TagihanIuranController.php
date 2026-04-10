<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagihanIuranRequest;
use App\Models\PembayaranIuran;
use App\Models\TagihanIuran;
use App\Models\Warga;
use App\Models\JenisIuran;
use Illuminate\Http\Request;

class TagihanIuranController extends Controller
{
    public function index()
    {
        $tagihan = TagihanIuran::with('warga', 'jenisIuran')
            ->latest()
            ->paginate(15);

        return view('admin.tagihan_iuran.index', compact('tagihan'));
    }

    public function create()
    {
        $warga = Warga::orderBy('nama_lengkap')->get();
        $jenis_iuran = JenisIuran::where('is_active', true)->get();

        return view('admin.tagihan_iuran.create', compact('warga', 'jenis_iuran'));
    }

    public function store(StoreTagihanIuranRequest $request)
    {
        $validated = $request->validated();
        $validated['dibuat_oleh'] = auth()->id();
        $validated['status'] = 'belum_dibayar';

        TagihanIuran::create($validated);

        return redirect()
            ->route('admin.tagihan-iuran.index')
            ->with('success', 'Tagihan Iuran berhasil ditambahkan.');
    }

    public function confirmPayment(TagihanIuran $tagihan)
    {
        // Simple MVP confirmation straight to paid
        if ($tagihan->status === 'lunas') {
            return back()->with('error', 'Tagihan sudah lunas.');
        }

        // Create the payment record
        PembayaranIuran::create([
            'tagihan_iuran_id' => $tagihan->id,
            'warga_id' => $tagihan->warga_id,
            'tanggal_bayar' => now(),
            'jumlah_bayar' => $tagihan->nominal,
            'metode_pembayaran' => 'Manual / Tunai',
            'status_verifikasi' => 'terverifikasi',
            'diverifikasi_oleh' => auth()->id(),
            'tanggal_verifikasi' => now(),
            'catatan' => 'Dikonfirmasi manual oleh admin'
        ]);

        // Update tagihan status
        $tagihan->update(['status' => 'lunas']);

        return back()->with('success', 'Pembayaran berhasil dikonfirmasi sebagai Lunas.');
    }
}
