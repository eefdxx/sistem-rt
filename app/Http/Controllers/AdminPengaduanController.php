<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\TanggapanLaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPengaduanController extends Controller
{
    /**
     * Daftar semua laporan masalah dari seluruh warga.
     */
    public function index(Request $request)
    {
        $query = Laporan::with(['warga', 'kategori'])->latest();

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan prioritas
        if ($request->filled('prioritas')) {
            $query->where('prioritas', $request->prioritas);
        }

        $laporans = $query->paginate(15)->withQueryString();

        $totalMenunggu  = Laporan::where('status', 'menunggu')->count();
        $totalDiproses  = Laporan::where('status', 'diproses')->count();
        $totalSelesai   = Laporan::where('status', 'selesai')->count();

        return view('admin.pengaduan.index', compact(
            'laporans', 'totalMenunggu', 'totalDiproses', 'totalSelesai'
        ));
    }

    /**
     * Detail laporan + form ubah status & kirim tanggapan.
     */
    public function show(Laporan $laporan)
    {
        $laporan->load(['warga.keluarga', 'kategori', 'tanggapan.user', 'peninjau']);
        return view('admin.pengaduan.show', compact('laporan'));
    }

    /**
     * Ubah status laporan (diproses / selesai / ditolak).
     */
    public function updateStatus(Request $request, Laporan $laporan)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai,ditolak',
        ]);

        $data = ['status' => $request->status];

        // Catat siapa yang meninjau dan kapan
        if (in_array($request->status, ['diproses', 'selesai', 'ditolak'])) {
            $data['ditinjau_oleh']    = Auth::id();
            $data['tanggal_ditinjau'] = now();
        }

        $laporan->update($data);

        return redirect()->back()
            ->with('success', 'Status laporan berhasil diperbarui menjadi: ' . ucfirst($request->status) . '.');
    }

    /**
     * Kirim tanggapan/komentar admin ke laporan warga.
     */
    public function tanggapi(Request $request, Laporan $laporan)
    {
        $request->validate([
            'isi_tanggapan' => 'required|string|max:2000',
        ]);

        TanggapanLaporan::create([
            'laporan_id'    => $laporan->id,
            'user_id'       => Auth::id(),
            'isi_tanggapan' => $request->isi_tanggapan,
        ]);

        // Otomatis ubah status ke 'diproses' jika masih 'menunggu'
        if ($laporan->status === 'menunggu') {
            $laporan->update([
                'status'           => 'diproses',
                'ditinjau_oleh'    => Auth::id(),
                'tanggal_ditinjau' => now(),
            ]);
        }

        return redirect()->back()
            ->with('success', 'Tanggapan berhasil dikirim.');
    }
}
