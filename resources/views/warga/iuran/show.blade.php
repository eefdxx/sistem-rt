<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Tagihan Iuran - Portal Warga</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>body { font-family: 'Outfit', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">
<div class="min-h-screen">

    {{-- Navbar --}}
    <nav class="bg-white sticky top-0 z-50 border-b border-slate-100 shadow-sm">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('warga.iuran.index') }}" class="flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-rose-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Daftar Iuran
                </a>
                <span class="text-sm font-bold text-slate-400">Portal Warga</span>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-6">

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl font-semibold text-sm">
                ✅ {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-rose-50 border border-rose-200 text-rose-800 px-5 py-4 rounded-2xl font-semibold text-sm">
                ❌ {{ session('error') }}
            </div>
        @endif

        {{-- Detail Tagihan --}}
        <div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/40 p-8">
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-black text-slate-900 tracking-tight">Detail Tagihan Iuran</h1>
                    <p class="text-slate-500 text-sm mt-1">{{ $tagihan->jenisIuran->nama_iuran ?? '-' }}</p>
                </div>
                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest
                    {{ $tagihan->status === 'lunas' ? 'bg-emerald-100 text-emerald-700' :
                       ($tagihan->status === 'proses_verifikasi' ? 'bg-amber-100 text-amber-700' : 'bg-rose-100 text-rose-700') }}">
                    {{ $tagihan->status === 'belum_bayar' ? 'Belum Bayar' : ($tagihan->status === 'proses_verifikasi' ? 'Menunggu Verifikasi' : 'Lunas') }}
                </span>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-slate-50 rounded-2xl p-4">
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Periode</p>
                    <p class="text-lg font-black text-slate-900">{{ $tagihan->bulan }} {{ $tagihan->tahun }}</p>
                </div>
                <div class="bg-slate-50 rounded-2xl p-4">
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Nominal</p>
                    <p class="text-lg font-black text-rose-600">Rp{{ number_format($tagihan->nominal_tagihan, 0, ',', '.') }}</p>
                </div>
                <div class="bg-slate-50 rounded-2xl p-4">
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Jatuh Tempo</p>
                    <p class="text-lg font-black text-slate-900">{{ $tagihan->jatuh_tempo ? $tagihan->jatuh_tempo->format('d M Y') : '-' }}</p>
                </div>
                <div class="bg-slate-50 rounded-2xl p-4">
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Keterangan</p>
                    <p class="text-sm font-semibold text-slate-700">{{ $tagihan->keterangan ?? '-' }}</p>
                </div>
            </div>
        </div>

        {{-- Riwayat Pembayaran --}}
        @if($tagihan->pembayaran->count() > 0)
        <div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/40 p-8">
            <h2 class="text-lg font-black text-slate-900 mb-5">Riwayat Pembayaran</h2>
            <div class="space-y-3">
                @foreach($tagihan->pembayaran as $bayar)
                <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <div class="flex items-center gap-4">
                        @if($bayar->bukti_pembayaran)
                        <a href="{{ Storage::url($bayar->bukti_pembayaran) }}" target="_blank"
                           class="w-12 h-12 rounded-xl overflow-hidden border-2 border-slate-200 flex-shrink-0">
                            <img src="{{ Storage::url($bayar->bukti_pembayaran) }}" alt="Bukti" class="w-full h-full object-cover">
                        </a>
                        @endif
                        <div>
                            <p class="text-sm font-bold text-slate-800">{{ $bayar->tanggal_bayar->format('d M Y, H:i') }}</p>
                            <p class="text-xs text-slate-400 capitalize">{{ $bayar->metode_pembayaran }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-black text-slate-900">Rp{{ number_format($bayar->jumlah_bayar, 0, ',', '.') }}</p>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-black uppercase
                            {{ $bayar->status_verifikasi === 'disetujui' ? 'bg-emerald-100 text-emerald-700' :
                               ($bayar->status_verifikasi === 'ditolak' ? 'bg-rose-100 text-rose-700' : 'bg-amber-100 text-amber-700') }}">
                            {{ $bayar->status_verifikasi }}
                        </span>
                        @if($bayar->catatan)
                        <p class="text-xs text-slate-400 mt-1">{{ $bayar->catatan }}</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Form Upload Bukti Bayar --}}
        @if($tagihan->status_pembayaran === 'belum_bayar')
        <div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/40 p-8">
            <h2 class="text-lg font-black text-slate-900 mb-2">Upload Bukti Pembayaran</h2>
            <p class="text-slate-500 text-sm mb-6">Upload foto/screenshot bukti transfer atau bukti pembayaran Anda. Admin akan memverifikasi dalam 1x24 jam.</p>

            <form action="{{ route('warga.iuran.pay', $tagihan->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Metode Pembayaran <span class="text-rose-500">*</span></label>
                    <select name="metode_pembayaran" required
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent">
                        <option value="">— Pilih Metode —</option>
                        <option value="transfer">Transfer Bank</option>
                        <option value="qris">QRIS</option>
                        <option value="tunai">Tunai (titip ke pengurus)</option>
                    </select>
                    @error('metode_pembayaran')<p class="text-rose-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Bukti Pembayaran <span class="text-rose-500">*</span></label>
                    <input type="file" name="bukti_pembayaran" accept="image/*" required
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-800 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-rose-50 file:text-rose-700 hover:file:bg-rose-100">
                    <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG, WEBP. Maksimal 2MB.</p>
                    @error('bukti_pembayaran')<p class="text-rose-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
                </div>

                <button type="submit"
                    class="w-full py-3.5 rounded-2xl bg-rose-600 text-white font-black text-sm hover:bg-rose-700 transition-all shadow-lg shadow-rose-600/20">
                    Kirim Bukti Pembayaran
                </button>
            </form>
        </div>
        @elseif($tagihan->status_pembayaran === 'proses_verifikasi')
        <div class="bg-amber-50 border border-amber-200 rounded-3xl p-8 text-center">
            <p class="text-amber-700 font-black text-lg">⏳ Menunggu Verifikasi Admin</p>
            <p class="text-amber-600 text-sm mt-1">Bukti pembayaran Anda sudah diterima dan sedang diverifikasi oleh pengurus RT.</p>
        </div>
        @elseif($tagihan->status_pembayaran === 'lunas')
        <div class="bg-emerald-50 border border-emerald-200 rounded-3xl p-8 text-center">
            <p class="text-emerald-700 font-black text-lg">✅ Tagihan Lunas</p>
            <p class="text-emerald-600 text-sm mt-1">Terima kasih! Pembayaran Anda telah terverifikasi oleh pengurus RT.</p>
        </div>
        @endif

    </main>
</div>
</body>
</html>
