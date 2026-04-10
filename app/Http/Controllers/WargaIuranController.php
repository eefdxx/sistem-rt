<?php

namespace App\Http\Controllers;

use App\Models\TagihanIuran;
use Illuminate\Http\Request;

class WargaIuranController extends Controller
{
    public function index()
    {
        // Mendapatkan warga berdasarkan user id yang login
        // Assuming warga is matched by user_id
        $warga = auth()->user()->warga;

        if (!$warga) {
            return redirect()->route('warga.dashboard')->with('error', 'Profil Warga tidak ditemukan, hubungi admin.');
        }

        $tagihan = TagihanIuran::with('jenisIuran', 'pembayaran')
            ->where('warga_id', $warga->id)
            ->latest()
            ->paginate(10);

        return view('warga.iuran.index', compact('tagihan'));
    }
}
