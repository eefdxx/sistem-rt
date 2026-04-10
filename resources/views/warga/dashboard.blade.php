<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warga Portal - Sistem RT</title>
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
                        <div class="bg-orange-500 text-white p-2.5 rounded-2xl shadow-lg shadow-orange-500/20 rotate-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        </div>
                        <span class="text-2xl font-black bg-clip-text text-transparent bg-gradient-to-r from-orange-600 to-rose-600 tracking-tight">Portal Warga</span>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <div class="hidden sm:block text-right mr-2">
                            <p class="text-sm font-bold text-slate-900 leading-tight">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-slate-500 font-medium">Buku Tamu RT</p>
                        </div>
                        <div class="relative">
                            <div class="h-11 w-11 bg-orange-100 rounded-full border-2 border-white shadow-md overflow-hidden object-cover flex flex-col items-center justify-center text-orange-600 font-bold text-lg">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <!-- Status Indicator -->
                            <div class="absolute bottom-0 right-0 h-3 w-3 rounded-full bg-green-500 border-2 border-white"></div>
                        </div>
                        <div class="h-8 w-px bg-slate-200 mx-2"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-red-500 hover:bg-red-50 px-3 py-2 rounded-xl transition" title="Keluar">
                                Logout 
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            
            <!-- Welcome Banner Card -->
            <div class="relative overflow-hidden rounded-[2.5rem] bg-gradient-to-br from-orange-500 via-rose-500 to-pink-500 shadow-xl shadow-orange-500/10 mb-10">
                <div class="absolute top-0 left-0 w-full h-full bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-20"></div>
                
                <div class="relative z-10 px-8 py-14 flex flex-col items-center text-center max-w-4xl mx-auto">
                    <span class="px-4 py-1.5 rounded-full bg-white/20 text-white text-xs font-bold uppercase tracking-wider mb-6 backdrop-blur-md border border-white/30">Layanan Ekosistem Modern</span>
                    <h1 class="text-4xl md:text-5xl font-black text-white leading-tight mb-4 drop-shadow-sm">Hallo, {{ explode(' ', auth()->user()->name)[0] }}!</h1>
                    <p class="text-orange-50 text-lg md:text-xl font-medium max-w-2xl opacity-90 mb-10">Akses jadwal kegiatan gotong royong, temukan pengumuman terbaru, dan penuhi obligasi kewarganegaraan dengan lancar melalui sentral dasbor ini.</p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 w-full justify-center">
                        <a href="{{ route('warga.iuran.index') }}" class="group flex items-center justify-center gap-3 px-8 py-4 rounded-2xl bg-white text-rose-600 font-bold hover:bg-orange-50 transition-all shadow-lg hover:shadow-orange-900/20 active:scale-95">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                            Bayar Tanggungan Iuran
                            <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                        </a>
                        <a href="{{ route('warga.pengumuman.index') }}" class="flex items-center justify-center gap-3 px-8 py-4 rounded-2xl bg-rose-600/30 text-white font-bold backdrop-blur-sm border border-white/20 hover:bg-rose-600/50 transition-all active:scale-95">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                            Baca Papan Pengumuman
                        </a>
                    </div>
                </div>
            </div>

            <!-- Dashboard Split Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <!-- Kiri: Pengumuman Terkini Grid -->
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-black text-slate-800 flex items-center gap-3">
                            <span class="p-2 bg-blue-100 text-blue-600 rounded-xl"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg></span>
                            Berita Terbaru
                        </h2>
                        <a href="{{ route('warga.pengumuman.index') }}" class="text-sm font-bold text-blue-600 hover:text-blue-800">Lihat Semua &rarr;</a>
                    </div>

                    <div class="space-y-4">
                        @forelse($pengumuman_terbaru ?? [] as $pengumuman)
                            <a href="{{ route('warga.pengumuman.show', $pengumuman->id) }}" class="block bg-white p-5 rounded-2xl border border-slate-100 hover:border-blue-200 hover:shadow-lg transition-all group">
                                <span class="text-xs font-bold text-blue-500 uppercase tracking-widest">{{ $pengumuman->created_at->diffForHumans() }}</span>
                                <h3 class="text-lg font-bold text-slate-800 mt-1 mb-2 group-hover:text-blue-600 transition-colors">{{ $pengumuman->judul }}</h3>
                                <p class="text-slate-500 text-sm line-clamp-2 leading-relaxed">{{ Str::limit(strip_tags($pengumuman->isi), 80) }}</p>
                            </a>
                        @empty
                            <div class="bg-white p-10 rounded-2xl border border-slate-100 text-center flex flex-col items-center">
                                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-300 mb-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                </div>
                                <h3 class="text-slate-800 font-bold mb-1">Papan Bersih</h3>
                                <p class="text-slate-500 text-sm">Tidak ada maklumat terbaru saat ini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Kanan: Kegiatan Mendatang Grid -->
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-black text-slate-800 flex items-center gap-3">
                            <span class="p-2 bg-emerald-100 text-emerald-600 rounded-xl"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></span>
                            Agenda Segera
                        </h2>
                        <a href="{{ route('warga.kegiatan.index') }}" class="text-sm font-bold text-emerald-600 hover:text-emerald-800">Semua Jadwal &rarr;</a>
                    </div>
                    
                    <div class="space-y-4">
                        @forelse($kegiatan_mendatang ?? [] as $kegiatan)
                            <a href="{{ route('warga.kegiatan.show', $kegiatan->id) }}" class="block bg-white p-5 rounded-2xl border border-slate-100 hover:border-emerald-200 hover:shadow-lg transition-all group flex gap-5 items-start">
                                <!-- Calendar Date Tear-off UI -->
                                <div class="bg-emerald-50 rounded-xl flex flex-col items-center justify-center w-16 px-1 py-2 flex-shrink-0 text-center border shadow-sm border-emerald-100/50">
                                    <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest mb-1">{{ $kegiatan->tanggal_mulai->format('M') }}</span>
                                    <span class="text-2xl font-black text-slate-800 leading-none">{{ $kegiatan->tanggal_mulai->format('d') }}</span>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-800 group-hover:text-emerald-600 transition-colors">{{ $kegiatan->nama_kegiatan }}</h3>
                                    <div class="flex items-center gap-2 mt-2 text-sm font-medium text-slate-500">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ $kegiatan->tanggal_mulai->format('H:i') }} WIB
                                    </div>
                                    <div class="flex items-center gap-2 mt-1 text-sm font-medium text-slate-500 truncate">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        {{ Str::limit($kegiatan->lokasi, 25) }}
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="bg-white p-10 rounded-2xl border border-slate-100 text-center flex flex-col items-center">
                                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-300 mb-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                                </div>
                                <h3 class="text-slate-800 font-bold mb-1">Belum Ada Agenda</h3>
                                <p class="text-slate-500 text-sm">Organisasi warga sedang beristirahat lapang.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="mt-16 text-center">
                <p class="text-slate-400 font-medium text-sm">&copy; {{ date('Y') }} Platform Modern Ekosistem Warga.</p>
            </div>
        </main>
    </div>
</body>
</html>
