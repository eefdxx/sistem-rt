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
        $tagihans = TagihanIuran::with(['warga.keluarga', 'jenisIuran'])->latest()->paginate(15);
        return view('admin.tagihan-iuran.index', compact('tagihans'));
    }

    public function create()
    {
        $wargas       = Warga::select('id', 'nama_lengkap', 'nik')->orderBy('nama_lengkap')->get();
        $jenis_iurans = JenisIuran::where('is_active', true)->get();
        return view('admin.tagihan-iuran.create', compact('wargas', 'jenis_iurans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'warga_id'       => 'required|exists:warga,id',
            'jenis_iuran_id' => 'required|exists:jenis_iuran,id',
            'periode_bulan'  => 'nullable|integer|min:1|max:12',
            'periode_tahun'  => 'required|integer|min:2020|max:2100',
            'nominal_tagihan'=> 'required|numeric|min:0',
            'jatuh_tempo'    => 'nullable|date',
            'keterangan'     => 'nullable|string',
        ]);

        $validated['dibuat_oleh']    = Auth::id();
        $validated['status_pembayaran'] = 'belum_bayar';

        TagihanIuran::create($validated);

        return redirect()->route('admin.tagihan-iuran.index')
            ->with('success', 'Tagihan iuran berhasil diterbitkan.');
    }

    /**
     * Tampilkan detail tagihan + daftar pembayaran yang masuk dari warga.
     */
    public function show(TagihanIuran $tagihanIuran)
    {
        $tagihanIuran->load(['warga.keluarga', 'jenisIuran', 'pembayaran.verifikator']);
        return view('admin.tagihan-iuran.show', compact('tagihanIuran'));
    }

    /**
     * Konfirmasi pembayaran manual (tunai) oleh Admin — langsung lunas.
     */
    public function confirmPayment(Request $request, TagihanIuran $tagihan)
    {
        // Cegah double-konfirmasi
        if ($tagihan->status_pembayaran === 'lunas') {
            return redirect()->back()->with('error', 'Tagihan ini sudah lunas.');
        }

        PembayaranIuran::create([
            'tagihan_iuran_id'  => $tagihan->id,
            'warga_id'          => $tagihan->warga_id,
            'tanggal_bayar'     => now(),
            'jumlah_bayar'      => $tagihan->nominal_tagihan,
            'metode_pembayaran' => 'tunai',
            'status_verifikasi' => 'disetujui',
            'diverifikasi_oleh' => Auth::id(),
            'tanggal_verifikasi'=> now(),
            'catatan'           => 'Dikonfirmasi pembayaran tunai oleh Admin.',
        ]);

        $tagihan->update(['status_pembayaran' => 'lunas']);

        return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi. Status tagihan menjadi Lunas.');
    }

    /**
     * Verifikasi bukti bayar yang diunggah warga (Setujui/Tolak).
     */
    public function verifyPayment(Request $request, PembayaranIuran $pembayaran)
    {
        $request->validate([
            'aksi'   => 'required|in:disetujui,ditolak',
            'catatan'=> 'nullable|string|max:500',
        ]);

        $pembayaran->update([
            'status_verifikasi' => $request->aksi,
            'diverifikasi_oleh' => Auth::id(),
            'tanggal_verifikasi'=> now(),
            'catatan'           => $request->catatan,
        ]);

        if ($request->aksi === 'disetujui') {
            $pembayaran->tagihanIuran->update(['status_pembayaran' => 'lunas']);
            return redirect()->back()->with('success', 'Bukti bayar disetujui. Tagihan kini berstatus Lunas.');
        }

        // Jika ditolak, kembalikan tagihan ke belum_bayar agar warga bisa submit ulang
        $pembayaran->tagihanIuran->update(['status_pembayaran' => 'belum_bayar']);
        return redirect()->back()->with('error', 'Bukti bayar ditolak. Tagihan dikembalikan ke status Belum Bayar.');
    }

    /**
     * Generate tagihan masal otomatis untuk bulan ini berdasarkan jenis iuran bulanan yang aktif
     */
    public function generateMasal(Request $request)
    {
        $bulan = now()->month;
        $tahun = now()->year;
        
        $jenisIuranBulanan = JenisIuran::where('is_active', true)->where('periode', 'bulanan')->get();
        if ($jenisIuranBulanan->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada jenis iuran bulanan yang aktif.');
        }

        $wargaAktif = Warga::all(); // idealnya filter by status_warga = 'aktif' jika ada
        $terbuat = 0;

        foreach ($wargaAktif as $warga) {
            foreach ($jenisIuranBulanan as $jenis) {
                // Cek apakah tagihan sudah ada bulan ini untuk warga ini
                $exists = TagihanIuran::where('warga_id', $warga->id)
                    ->where('jenis_iuran_id', $jenis->id)
                    ->where('periode_bulan', $bulan)
                    ->where('periode_tahun', $tahun)
                    ->exists();

                if (!$exists) {
                    TagihanIuran::create([
                        'warga_id' => $warga->id,
                        'jenis_iuran_id' => $jenis->id,
                        'periode_bulan' => $bulan,
                        'periode_tahun' => $tahun,
                        'nominal_tagihan' => $jenis->nominal_default,
                        'jatuh_tempo' => now()->endOfMonth(),
                        'status_pembayaran' => 'belum_bayar',
                        'keterangan' => 'Tagihan Otomatis Bulanan',
                        'dibuat_oleh' => Auth::id()
                    ]);
                    $terbuat++;
                }
            }
        }

        return redirect()->back()->with('success', "Generate tagihan masal selesai. {$terbuat} tagihan baru berhasil diterbitkan untuk bulan ini.");
    }
}
