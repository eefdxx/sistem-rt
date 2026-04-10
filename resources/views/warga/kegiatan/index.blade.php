<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda & Kegiatan - Sistem RT</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased selection:bg-emerald-500 selection:text-white">
    <div class="min-h-screen">
        <nav class="bg-white sticky top-0 z-50 border-b border-slate-100 shadow-sm">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('warga.dashboard') }}" class="flex items-center gap-3">
                            <div class="bg-emerald-500 text-white p-2.5 rounded-2xl shadow-lg shadow-emerald-500/20 rotate-3 transition-transform hover:rotate-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                            <span class="text-2xl font-black bg-clip-text text-transparent bg-gradient-to-r from-emerald-600 to-teal-600 tracking-tight">Portal Warga</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="mb-10">
                <a href="{{ route('warga.dashboard') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-emerald-600 transition-colors uppercase tracking-widest mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali
                </a>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">Agenda Lingkungan</h1>
                <p class="text-slate-500 font-medium mt-1">Daftar kegiatan, kerja bakti, dan pertemuan warga yang akan datang.</p>
            </div>

            <div class="space-y-6">
                @forelse($kegiatans as $k)
                <a href="{{ route('warga.kegiatan.show', $k->id) }}" class="group bg-white rounded-[2.5rem] border border-slate-100 p-8 shadow-sm hover:shadow-xl hover:shadow-emerald-500/5 transition-all hover:border-emerald-100 flex flex-col md:flex-row gap-8 items-start md:items-center">
                    <div class="bg-emerald-50 rounded-3xl flex flex-col items-center justify-center w-24 h-24 flex-shrink-0 text-center border shadow-sm border-emerald-100/50">
                        <span class="text-sm font-black text-emerald-600 uppercase tracking-widest mb-1">{{ $k->tanggal_mulai->translatedFormat('M') }}</span>
                        <span class="text-4xl font-black text-slate-800 leading-none">{{ $k->tanggal_mulai->format('d') }}</span>
                    </div>

                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="px-3 py-1 bg-slate-50 text-slate-500 text-[10px] font-black uppercase tracking-widest rounded-full border border-slate-100">
                                {{ strtoupper($k->status) }}
                            </span>
                            <span class="text-sm font-bold text-slate-400">{{ $k->tanggal_mulai->format('H:i') }} WIB</span>
                        </div>
                        <h2 class="text-2xl font-black text-slate-900 leading-tight mb-2 group-hover:text-emerald-600 transition-colors">{{ $k->nama_kegiatan }}</h2>
                        <div class="flex items-center gap-2 text-slate-500 font-medium">
                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ $k->lokasi }}
                        </div>
                    </div>

                    <div class="w-full md:w-auto mt-4 md:mt-0">
                         <div class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-emerald-600 text-white font-bold text-sm shadow-lg shadow-emerald-600/20 group-hover:scale-105 transition-transform">
                            Lihat Detail
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </div>
                    </div>
                </a>
                @empty
                <div class="py-20 bg-white rounded-[2.5rem] border border-dashed border-slate-200 flex flex-col items-center">
                    <p class="text-slate-400 font-bold tracking-widest uppercase text-xs">Belum Ada Agenda Terdekat</p>
                </div>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $kegiatans->links() }}
            </div>
        </main>
    </div>
</body>
</html>
