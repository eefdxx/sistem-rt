<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\KategoriLaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WargaLaporanController extends Controller
{
    /**
     * Daftar semua laporan yang pernah dikirim oleh warga yang sedang login.
     */
    public function index()
    {
        $warga = Auth::user()->warga;

        if (!$warga) {
            return redirect()->route('dashboard')
                ->with('error', 'Profil warga tidak ditemukan. Hubungi Admin.');
        }

        $laporans = Laporan::with('kategori')
            ->where('warga_id', $warga->id)
            ->latest()
            ->paginate(10);

        return view('warga.laporan.index', compact('laporans'));
    }

    /**
     * Form pembuatan laporan baru.
     */
    public function create()
    {
        $kategoris = KategoriLaporan::orderBy('nama_kategori')->get();
        return view('warga.laporan.create', compact('kategoris'));
    }

    /**
     * Simpan laporan baru dari warga.
     */
    public function store(Request $request)
    {
        $warga = Auth::user()->warga;

        if (!$warga) {
            return redirect()->route('dashboard')
                ->with('error', 'Profil warga tidak ditemukan. Hubungi Admin.');
        }

        $validated = $request->validate([
            'kategori_laporan_id' => 'required|exists:kategori_laporan,id',
            'judul'               => 'required|string|max:200',
            'deskripsi'           => 'required|string|max:3000',
            'lokasi'              => 'nullable|string|max:255',
            'prioritas'           => 'required|in:rendah,sedang,tinggi',
            'lampiran'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $validated['warga_id']        = $warga->id;
        $validated['tanggal_laporan'] = now();
        $validated['status']          = 'menunggu';

        if ($request->hasFile('lampiran')) {
            $validated['lampiran'] = $request->file('lampiran')->store('laporan', 'public');
        }

        Laporan::create($validated);

        return redirect()->route('warga.laporan.index')
            ->with('success', 'Laporan berhasil dikirim. Pengurus RT akan segera menindaklanjuti.');
    }

    /**
     * Detail laporan + riwayat tanggapan dari admin.
     */
    public function show(Laporan $laporan)
    {
        $warga = Auth::user()->warga;

        if (!$warga || $laporan->warga_id !== $warga->id) {
            abort(403, 'Akses ditolak.');
        }

        $laporan->load(['kategori', 'tanggapan.user', 'peninjau']);

        return view('warga.laporan.show', compact('laporan'));
    }
}
