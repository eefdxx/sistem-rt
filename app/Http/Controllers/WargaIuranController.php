<?php

namespace App\Http\Controllers;

use App\Models\TagihanIuran;
use App\Models\PembayaranIuran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WargaIuranController extends Controller
{
    /**
     * Daftar semua tagihan milik warga yang login.
     */
    public function index()
    {
        $warga = Auth::user()->warga;

        if (!$warga) {
            return redirect()->route('dashboard')
                ->with('error', 'Profil warga tidak ditemukan. Hubungi Admin.');
        }

        $tagihans = TagihanIuran::with('jenisIuran')
            ->where('warga_id', $warga->id)
            ->latest()
            ->paginate(10);

        return view('warga.iuran.index', compact('tagihans'));
    }

    /**
     * Detail tagihan + form upload bukti bayar.
     */
    public function show(TagihanIuran $tagihan)
    {
        $warga = Auth::user()->warga;

        // Pastikan tagihan ini memang milik warga yang login
        if (!$warga || $tagihan->warga_id !== $warga->id) {
            abort(403, 'Akses ditolak.');
        }

        $tagihan->load(['jenisIuran', 'pembayaran']);

        return view('warga.iuran.show', compact('tagihan'));
    }

    /**
     * Proses upload bukti pembayaran oleh warga.
     */
    public function pay(Request $request, TagihanIuran $tagihan)
    {
        $warga = Auth::user()->warga;

        if (!$warga || $tagihan->warga_id !== $warga->id) {
            abort(403, 'Akses ditolak.');
        }

        // Jangan izinkan bayar ulang jika sudah proses atau lunas
        if (in_array($tagihan->status_pembayaran, ['proses_verifikasi', 'lunas'])) {
            return redirect()->back()
                ->with('error', 'Tagihan ini sedang dalam proses verifikasi atau sudah lunas.');
        }

        $validated = $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'metode_pembayaran'=> 'required|string|in:transfer,tunai,qris',
        ]);

        $path = $request->file('bukti_pembayaran')->store('pembayaran', 'public');

        PembayaranIuran::create([
            'tagihan_iuran_id'  => $tagihan->id,
            'warga_id'          => $warga->id,
            'tanggal_bayar'     => now(),
            'jumlah_bayar'      => $tagihan->nominal_tagihan,
            'metode_pembayaran' => $request->metode_pembayaran,
            'bukti_pembayaran'  => $path,
            'status_verifikasi' => 'menunggu',
        ]);

        // Ubah status tagihan menjadi 'proses' (menunggu verifikasi admin)
        $tagihan->update(['status_pembayaran' => 'proses_verifikasi']);

        return redirect()->route('warga.iuran.index')
            ->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu verifikasi Admin.');
    }
}
