<?php

namespace App\Http\Controllers;

use App\Models\TagihanIuran;
use App\Models\PembayaranIuran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WargaIuranController extends Controller
{
    public function index()
    {
        $warga = Auth::user()->warga;

        if (!$warga) {
            return redirect()->route('dashboard')->with('error', 'Profil warga tidak ditemukan. Hubungi Admin.');
        }

        $tagihans = TagihanIuran::with('jenisIuran')
            ->where('warga_id', $warga->id)
            ->latest()
            ->paginate(10);

        return view('warga.iuran.index', compact('tagihans'));
    }

    public function pay(Request $request, TagihanIuran $tagihan)
    {
        // Fitur pembayaran mandiri oleh warga (simulasi upload bukti)
        $validated = $request->validate([
            'bukti_pembayaran' => 'required|image|max:2048',
            'metode_pembayaran' => 'required|string',
        ]);

        $path = $request->file('bukti_pembayaran')->store('pembayaran', 'public');

        PembayaranIuran::create([
            'tagihan_iuran_id' => $tagihan->id,
            'warga_id' => Auth::user()->warga->id,
            'tanggal_bayar' => now(),
            'jumlah_bayar' => $tagihan->nominal,
            'metode_pembayaran' => $request->metode_pembayaran,
            'bukti_pembayaran' => $path,
            'status_verifikasi' => 'menunggu',
        ]);

        $tagihan->update(['status' => 'proses']);

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu verifikasi Admin.');
    }
}
