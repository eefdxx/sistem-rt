<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan - Portal Warga</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>body { font-family: 'Outfit', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">
<div class="min-h-screen">

    <nav class="bg-white sticky top-0 z-50 border-b border-slate-100 shadow-sm">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('warga.laporan.index') }}" class="flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-orange-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Semua Laporan
                </a>
                <span class="text-sm font-bold text-slate-400">Portal Warga</span>
            </div>
        </div>
    </nav>

    <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-6">

        {{-- Detail Laporan --}}
        <div class="bg-white rounded-3xl border border-slate-100 shadow-xl p-8">
            <div class="flex items-start justify-between gap-4 mb-6">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-widest text-slate-400">{{ $laporan->kategori->nama_kategori ?? '-' }}</span>
                        <span class="text-slate-300">•</span>
                        <span class="text-xs font-black uppercase tracking-widest
                            {{ $laporan->prioritas === 'tinggi' ? 'text-rose-600' : ($laporan->prioritas === 'sedang' ? 'text-amber-600' : 'text-slate-400') }}">
                            Prioritas {{ $laporan->prioritas }}
                        </span>
                    </div>
                    <h1 class="text-2xl font-black text-slate-900 leading-tight">{{ $laporan->judul }}</h1>
                    <p class="text-xs text-slate-400 mt-2">{{ $laporan->tanggal_laporan->format('d M Y, H:i') }}</p>
                </div>
                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest flex-shrink-0
                    {{ $laporan->status === 'selesai' ? 'bg-emerald-100 text-emerald-700' :
                       ($laporan->status === 'diproses' ? 'bg-blue-100 text-blue-700' :
                       ($laporan->status === 'ditolak' ? 'bg-rose-100 text-rose-700' : 'bg-amber-100 text-amber-700')) }}">
                    {{ $laporan->status }}
                </span>
            </div>

            @if($laporan->lokasi)
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-4">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span class="font-semibold">{{ $laporan->lokasi }}</span>
            </div>
            @endif

            <div class="bg-slate-50 rounded-2xl p-5 mb-5">
                <p class="text-sm text-slate-700 leading-relaxed whitespace-pre-line">{{ $laporan->deskripsi }}</p>
            </div>

            @if($laporan->lampiran)
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Foto Lampiran</p>
                <a href="{{ Storage::url($laporan->lampiran) }}" target="_blank">
                    <img src="{{ Storage::url($laporan->lampiran) }}" alt="Lampiran Laporan"
                         class="rounded-2xl max-h-64 object-cover border border-slate-200 hover:opacity-90 transition-opacity">
                </a>
            </div>
            @endif

            @if($laporan->peninjau)
            <div class="mt-4 pt-4 border-t border-slate-100">
                <p class="text-xs text-slate-400">
                    Ditinjau oleh <strong>{{ $laporan->peninjau->name }}</strong>
                    pada {{ $laporan->tanggal_ditinjau->format('d M Y, H:i') }}
                </p>
            </div>
            @endif
        </div>

        {{-- Tanggapan dari Admin --}}
        <div class="bg-white rounded-3xl border border-slate-100 shadow-xl p-8">
            <h2 class="text-base font-black text-slate-900 mb-5">Tanggapan Pengurus RT</h2>

            @forelse($laporan->tanggapan as $tangkap)
            <div class="flex items-start gap-3 mb-4 last:mb-0">
                <div class="w-9 h-9 bg-indigo-100 rounded-full flex items-center justify-center flex-shrink-0 text-indigo-700 font-black text-sm">
                    {{ strtoupper(substr($tangkap->user->name, 0, 1)) }}
                </div>
                <div class="flex-1 bg-indigo-50 rounded-2xl rounded-tl-none p-4">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-xs font-black text-indigo-700">{{ $tangkap->user->name }}</span>
                        <span class="text-xs text-slate-400">{{ $tangkap->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-sm text-slate-700">{{ $tangkap->isi_tanggapan }}</p>
                </div>
            </div>
            @empty
            <div class="text-center py-6">
                <p class="text-slate-400 text-sm">Belum ada tanggapan dari pengurus RT. Mohon tunggu.</p>
            </div>
            @endforelse
        </div>

    </main>
</div>
</body>
</html>
