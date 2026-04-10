<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Papan Informasi Warga - Sistem RT</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased selection:bg-orange-500 selection:text-white">
    <div class="min-h-screen">
        <!-- Navbar -->
        <nav class="bg-white sticky top-0 z-50 border-b border-slate-100 shadow-sm">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('warga.dashboard') }}" class="flex items-center gap-3">
                            <div class="bg-orange-500 text-white p-2.5 rounded-2xl shadow-lg shadow-orange-500/20 rotate-3 transition-transform hover:rotate-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                            <span class="text-2xl font-black bg-clip-text text-transparent bg-gradient-to-r from-orange-600 to-rose-600 tracking-tight">Portal Warga</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="mb-10">
                <a href="{{ route('warga.dashboard') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-orange-600 transition-colors uppercase tracking-widest mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali
                </a>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">Papan Pengumuman</h1>
                <p class="text-slate-500 font-medium mt-1">Informasi dan maklumat resmi dari pengurus RT untuk seluruh warga.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($pengumumans as $p)
                <a href="{{ route('warga.pengumuman.show', $p->id) }}" class="group bg-white rounded-[2.5rem] border border-slate-100 p-8 shadow-sm hover:shadow-xl hover:shadow-orange-500/5 transition-all hover:border-orange-100 flex flex-col">
                    <div class="flex items-center justify-between mb-6">
                        <span class="px-4 py-1.5 rounded-full bg-orange-50 text-orange-600 text-[10px] font-black uppercase tracking-widest border border-orange-100/50">
                            {{ $p->kategori }}
                        </span>
                        <span class="text-xs font-bold text-slate-400">
                            {{ $p->created_at->translatedFormat('d F Y') }}
                        </span>
                    </div>
                    
                    <h2 class="text-2xl font-black text-slate-900 leading-tight mb-4 group-hover:text-orange-600 transition-colors">{{ $p->judul }}</h2>
                    <p class="text-slate-500 leading-relaxed line-clamp-3 mb-8 flex-1">
                        {{ strip_tags($p->isi) }}
                    </p>
                    
                    <div class="flex items-center gap-2 text-orange-600 font-bold text-sm">
                        Baca Selengkapnya
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </div>
                </a>
                @empty
                <div class="md:col-span-2 py-20 bg-white rounded-[2.5rem] border border-dashed border-slate-200 flex flex-col items-center">
                    <p class="text-slate-400 font-bold tracking-widest uppercase text-xs">Belum Ada Pengumuman Terbaru</p>
                </div>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $pengumumans->links() }}
            </div>
        </main>
    </div>
</body>
</html>
