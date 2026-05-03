<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Masalah - Portal Warga</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>body { font-family: 'Outfit', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">
<div class="min-h-screen">

    <nav class="bg-white sticky top-0 z-50 border-b border-slate-100 shadow-sm">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('warga.dashboard') }}" class="flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-orange-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Dashboard
                </a>
                <span class="text-sm font-bold text-slate-400">Portal Warga</span>
            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- Flash --}}
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl font-semibold text-sm mb-6">✅ {{ session('success') }}</div>
        @endif

        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">Laporan Masalah</h1>
                <p class="text-slate-500 text-sm mt-1">Riwayat laporan & pengaduan yang pernah Anda kirimkan.</p>
            </div>
            <a href="{{ route('warga.laporan.create') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl bg-orange-500 text-white font-bold text-sm hover:bg-orange-600 transition-all shadow-lg shadow-orange-500/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Buat Laporan
            </a>
        </div>

        @forelse($laporans as $laporan)
        <a href="{{ route('warga.laporan.show', $laporan->id) }}"
           class="block bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:border-orange-200 transition-all p-6 mb-4">
            <div class="flex items-start justify-between gap-4">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-widest bg-slate-100 text-slate-600">
                            {{ $laporan->kategori->nama_kategori ?? 'Umum' }}
                        </span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-widest
                            {{ $laporan->prioritas === 'tinggi' ? 'bg-rose-100 text-rose-700' :
                               ($laporan->prioritas === 'sedang' ? 'bg-amber-100 text-amber-700' : 'bg-slate-100 text-slate-500') }}">
                            {{ $laporan->prioritas }}
                        </span>
                    </div>
                    <h3 class="font-black text-slate-900 text-base truncate">{{ $laporan->judul }}</h3>
                    <p class="text-slate-500 text-sm mt-1 line-clamp-2">{{ $laporan->deskripsi }}</p>
                    <p class="text-xs text-slate-400 mt-2">{{ $laporan->tanggal_laporan->format('d M Y, H:i') }}</p>
                </div>
                <div class="flex-shrink-0">
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-black uppercase tracking-widest
                        {{ $laporan->status === 'selesai' ? 'bg-emerald-100 text-emerald-700' :
                           ($laporan->status === 'diproses' ? 'bg-blue-100 text-blue-700' :
                           ($laporan->status === 'ditolak' ? 'bg-rose-100 text-rose-700' : 'bg-amber-100 text-amber-700')) }}">
                        {{ $laporan->status }}
                    </span>
                </div>
            </div>
        </a>
        @empty
        <div class="bg-white rounded-3xl border border-slate-100 shadow-xl p-16 text-center">
            <div class="w-16 h-16 bg-orange-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
            </div>
            <p class="text-slate-500 font-bold">Belum ada laporan yang dikirim.</p>
            <p class="text-slate-400 text-sm mt-1">Gunakan tombol "Buat Laporan" untuk melaporkan masalah di lingkungan RT.</p>
        </div>
        @endforelse

        <div class="mt-6">{{ $laporans->links() }}</div>
    </main>
</div>
</body>
</html>
