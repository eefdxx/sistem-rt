<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Tagihan - Sistem RT</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 antialiased text-slate-800">
<div class="min-h-screen">

    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-200/60 shadow-sm">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('admin.tagihan-iuran.index') }}" class="flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-indigo-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Daftar Tagihan
                </a>
                <span class="text-sm font-bold text-slate-400">Admin Panel</span>
            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-6">

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl font-semibold text-sm">✅ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-rose-50 border border-rose-200 text-rose-800 px-5 py-4 rounded-2xl font-semibold text-sm">❌ {{ session('error') }}</div>
        @endif

        {{-- Info Tagihan --}}
        <div class="bg-white rounded-3xl border border-slate-200/60 shadow-xl p-8">
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-extrabold text-slate-900">Detail Tagihan Iuran</h1>
                    <p class="text-slate-500 text-sm mt-1">ID #{{ $tagihanIuran->id }}</p>
                </div>
                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest
                    {{ $tagihanIuran->status_pembayaran === 'lunas' ? 'bg-emerald-100 text-emerald-700' :
                       ($tagihanIuran->status_pembayaran === 'proses_verifikasi' ? 'bg-amber-100 text-amber-700' : 'bg-rose-100 text-rose-700') }}">
                    {{ str_replace('_', ' ', $tagihanIuran->status_pembayaran) }}
                </span>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-slate-50 rounded-2xl p-4">
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Warga</p>
                    <p class="text-sm font-black text-slate-900">{{ $tagihanIuran->warga->nama_lengkap }}</p>
                    <p class="text-xs text-slate-500">KK: {{ $tagihanIuran->warga->keluarga->no_kk ?? '-' }}</p>
                </div>
                <div class="bg-slate-50 rounded-2xl p-4">
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Jenis Iuran</p>
                    <p class="text-sm font-black text-slate-900">{{ $tagihanIuran->jenisIuran->nama_iuran }}</p>
                </div>
                <div class="bg-slate-50 rounded-2xl p-4">
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Periode</p>
                    <p class="text-sm font-black text-slate-900">{{ $tagihanIuran->bulan }} {{ $tagihanIuran->tahun }}</p>
                </div>
                <div class="bg-slate-50 rounded-2xl p-4">
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Nominal</p>
                    <p class="text-sm font-black text-indigo-600">Rp{{ number_format($tagihanIuran->nominal_tagihan, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        {{-- Daftar Pembayaran Masuk --}}
        <div class="bg-white rounded-3xl border border-slate-200/60 shadow-xl p-8">
            <h2 class="text-lg font-extrabold text-slate-900 mb-5">Pembayaran Masuk dari Warga</h2>

            @forelse($tagihanIuran->pembayaran as $bayar)
            <div class="border border-slate-100 rounded-2xl p-5 mb-4 last:mb-0">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-start gap-4">
                        @if($bayar->bukti_pembayaran)
                        <a href="{{ Storage::url($bayar->bukti_pembayaran) }}" target="_blank"
                           class="w-20 h-20 rounded-xl overflow-hidden border-2 border-slate-200 flex-shrink-0 hover:opacity-80 transition-opacity">
                            <img src="{{ Storage::url($bayar->bukti_pembayaran) }}" alt="Bukti Bayar" class="w-full h-full object-cover">
                        </a>
                        @endif
                        <div>
                            <p class="text-sm font-black text-slate-900">{{ $bayar->tanggal_bayar->format('d M Y, H:i') }}</p>
                            <p class="text-xs text-slate-500 capitalize mt-0.5">via {{ $bayar->metode_pembayaran }}</p>
                            <p class="text-base font-black text-indigo-600 mt-1">Rp{{ number_format($bayar->jumlah_bayar, 0, ',', '.') }}</p>
                            @if($bayar->catatan)
                            <p class="text-xs text-slate-400 italic mt-1">{{ $bayar->catatan }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="text-right flex-shrink-0">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black uppercase tracking-widest
                            {{ $bayar->status_verifikasi === 'disetujui' ? 'bg-emerald-100 text-emerald-700' :
                               ($bayar->status_verifikasi === 'ditolak' ? 'bg-rose-100 text-rose-700' : 'bg-amber-100 text-amber-700') }}">
                            {{ $bayar->status_verifikasi }}
                        </span>
                    </div>
                </div>

                {{-- Form Verifikasi (hanya tampil jika status masih menunggu) --}}
                @if($bayar->status_verifikasi === 'menunggu')
                <div class="mt-4 pt-4 border-t border-slate-100">
                    <form action="{{ route('admin.pembayaran.verifikasi', $bayar->id) }}" method="POST" class="space-y-3">
                        @csrf
                        <textarea name="catatan" rows="2" placeholder="Catatan verifikasi (opsional)..."
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                        <div class="flex gap-3">
                            <button type="submit" name="aksi" value="disetujui"
                                class="flex-1 py-2.5 rounded-xl bg-emerald-600 text-white font-bold text-xs hover:bg-emerald-700 transition-all">
                                ✓ Setujui & Tandai Lunas
                            </button>
                            <button type="submit" name="aksi" value="ditolak"
                                class="flex-1 py-2.5 rounded-xl bg-rose-600 text-white font-bold text-xs hover:bg-rose-700 transition-all">
                                ✕ Tolak
                            </button>
                        </div>
                    </form>
                </div>
                @endif
            </div>
            @empty
            <div class="text-center py-10">
                <p class="text-slate-400 text-sm font-bold uppercase tracking-widest">Belum ada pembayaran masuk</p>
            </div>
            @endforelse
        </div>

        {{-- Konfirmasi Pembayaran Tunai Manual --}}
        @if($tagihanIuran->status_pembayaran !== 'lunas')
        <div class="bg-indigo-50 border border-indigo-100 rounded-3xl p-8">
            <h2 class="text-base font-extrabold text-indigo-900 mb-1">Konfirmasi Tunai Manual</h2>
            <p class="text-indigo-700 text-sm mb-4">Jika warga membayar langsung secara tunai kepada pengurus, tandai tagihan ini sebagai lunas tanpa perlu mengunggah bukti.</p>
            <form action="{{ route('admin.tagihan-iuran.konfirmasi', $tagihanIuran->id) }}" method="POST">
                @csrf
                <button type="submit" onclick="return confirm('Konfirmasi bahwa warga {{ $tagihanIuran->warga->nama_lengkap }} telah membayar tunai sebesar Rp{{ number_format($tagihanIuran->nominal_tagihan, 0, ',', '.') }}?')"
                    class="px-6 py-3 rounded-2xl bg-indigo-600 text-white font-bold text-sm hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-600/20">
                    Konfirmasi Bayar Tunai
                </button>
            </form>
        </div>
        @endif

    </main>
</div>
</body>
</html>
