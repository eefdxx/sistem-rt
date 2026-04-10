<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pemerintahan RT - Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 antialiased text-slate-800 selection:bg-indigo-500 selection:text-white">
    <div class="min-h-screen">
        
        <!-- Premium Navbar Layer -->
        <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-200/60 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    <div class="flex items-center gap-3">
                        <div class="bg-gradient-to-br from-indigo-600 to-violet-600 text-white p-2.5 rounded-xl shadow-lg shadow-indigo-600/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-slate-900 to-slate-700 tracking-tight">Sistem RT</span>
                    </div>
                    
                    <div class="flex items-center gap-6">
                        <div class="hidden sm:block text-right">
                            <p class="text-sm font-semibold text-slate-900 leading-tight">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-slate-500 font-medium">Administrator</p>
                        </div>
                        <div class="h-10 w-10 bg-slate-100 rounded-full border-2 border-white shadow-sm overflow-hidden object-cover relative">
                            <div class="absolute inset-0 bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-slate-400 hover:text-red-500 transition-colors p-2 rounded-full hover:bg-red-50" title="Logout">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            
            <!-- Hero Welcome Card -->
            <div class="relative overflow-hidden rounded-3xl bg-indigo-900 shadow-2xl mb-12">
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
                <!-- Decorative Gradients -->
                <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-gradient-to-b from-indigo-400 to-violet-600 opacity-20 blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 rounded-full bg-gradient-to-t from-fuchsia-500 to-indigo-500 opacity-20 blur-3xl"></div>

                <div class="relative z-10 px-8 py-12 md:p-14 flex flex-col md:flex-row items-center justify-between gap-8 text-center md:text-left">
                    <div class="flex-1 space-y-4">
                        <h2 class="text-sm font-bold tracking-widest text-indigo-300 uppercase">Panel Eksekutif</h2>
                        <h1 class="text-3xl md:text-5xl font-extrabold text-white tracking-tight">Kendalikan Ekosistem Warga Sekejap Mata.</h1>
                        <p class="text-indigo-100 text-lg md:text-xl max-w-2xl leading-relaxed">
                            Akses manajerial lengkap untuk populasi, pergerakan iuran, dan diseminasi info krusial rukun tetangga.
                        </p>
                    </div>

                    <!-- Highlight Meta -->
                    <div class="flex gap-4 p-4 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 whitespace-nowrap">
                        <div class="px-4 py-2 border-r border-white/10">
                            <p class="text-xs text-indigo-200 uppercase font-semibold">Total Kepala</p>
                            <p class="text-2xl font-bold text-white">{{ number_format($total_keluarga ?? 0) }}</p>
                        </div>
                        <div class="px-4 py-2 border-r border-white/10">
                            <p class="text-xs text-indigo-200 uppercase font-semibold">Total Jiwa</p>
                            <p class="text-2xl font-bold text-white">{{ number_format($total_warga ?? 0) }}</p>
                        </div>
                        <div class="px-4 py-2">
                            <p class="text-xs text-indigo-200 uppercase font-semibold">Info Aktif</p>
                            <p class="text-2xl font-bold text-white">{{ number_format($laporan_aktif ?? 0) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Grid Overview -->
            <div class="mb-6 flex items-center justify-between">
                <h3 class="text-xl font-bold text-slate-800">Modul Operasional Utama</h3>
                <div class="h-1 flex-1 mx-6 bg-gradient-to-r from-slate-200 to-transparent rounded-full opacity-50"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Modul Kependudukan -->
                <a href="{{ route('admin.warga.index') }}" class="group relative bg-white p-7 rounded-3xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-1 hover:border-indigo-100 transition-all duration-300">
                    <div class="absolute top-0 right-0 p-6 opacity-0 group-hover:opacity-10 transition-opacity">
                        <svg class="w-24 h-24 text-indigo-600 transform group-hover:rotate-12 transition-transform duration-500 delay-75" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path></svg>
                    </div>
                    
                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-600 mb-6 group-hover:scale-110 group-hover:bg-indigo-600 group-hover:text-white transition-all shadow-sm">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-2">Buku Warga</h3>
                        <p class="text-slate-500 font-medium leading-relaxed">Pendaftaran warga, input anggota keluarga (KK), detail kontak, mutasi profil demografis warga.</p>
                        
                        <div class="mt-6 flex gap-3 text-sm font-bold text-indigo-600 group-hover:text-indigo-700">
                            Kelola Warga &rarr;
                        </div>
                    </div>
                </a>

                <!-- Modul Keluarga -->
                <a href="{{ route('admin.keluarga.index') }}" class="group relative bg-white p-7 rounded-3xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-1 hover:border-emerald-100 transition-all duration-300">
                    <div class="absolute top-0 right-0 p-6 opacity-0 group-hover:opacity-10 transition-opacity">
                        <svg class="w-24 h-24 text-emerald-600 transform group-hover:-rotate-12 transition-transform duration-500 delay-75" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                    </div>
                    
                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 mb-6 group-hover:scale-110 group-hover:bg-emerald-600 group-hover:text-white transition-all shadow-sm">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-2">Buku Keluarga</h3>
                        <p class="text-slate-500 font-medium leading-relaxed">Pengarsipan master Kartu Keluarga, penetapan alamat & Kepala Keluarga dengan sistem terstruktur.</p>
                        
                        <div class="mt-6 flex gap-3 text-sm font-bold text-emerald-600 group-hover:text-emerald-700">
                            Kelola KK &rarr;
                        </div>
                    </div>
                </a>

                <!-- Modul Publikasi Kehumasan -->
                <a href="{{ route('admin.pengumuman.index') }}" class="group relative bg-white p-7 rounded-3xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-1 hover:border-amber-100 transition-all duration-300">
                    <div class="absolute top-0 right-0 p-6 opacity-0 group-hover:opacity-10 transition-opacity">
                        <svg class="w-24 h-24 text-amber-600 transform group-hover:rotate-12 transition-transform duration-500 delay-75" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 3a1 1 0 00-1.447-.894L8.763 6H5a3 3 0 000 6h.28l1.771 5.316A1 1 0 008 18h1a1 1 0 001-1v-4.382l6.553 3.276A1 1 0 0018 15V3z" clip-rule="evenodd"></path></svg>
                    </div>
                    
                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 mb-6 group-hover:scale-110 group-hover:bg-amber-600 group-hover:text-white transition-all shadow-sm">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-2">Papan Pengumuman</h3>
                        <p class="text-slate-500 font-medium leading-relaxed">Broadcast kebijakan, instruksi, edaran, atau notifikasi masal. Fitur Draft tersedia sebelum rilis resmi.</p>
                        
                        <div class="mt-6 flex gap-3 text-sm font-bold text-amber-600 group-hover:text-amber-700">
                            Kelola Informasi &rarr;
                        </div>
                    </div>
                </a>

                <!-- Modul Agenda -->
                <a href="{{ route('admin.kegiatan.index') }}" class="group relative bg-white p-7 rounded-3xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-1 hover:border-violet-100 transition-all duration-300">
                    <div class="absolute top-0 right-0 p-6 opacity-0 group-hover:opacity-10 transition-opacity">
                        <svg class="w-24 h-24 text-violet-600 transform group-hover:-rotate-12 transition-transform duration-500 delay-75" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                    </div>
                    
                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-violet-50 text-violet-600 mb-6 group-hover:scale-110 group-hover:bg-violet-600 group-hover:text-white transition-all shadow-sm">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-2">Agenda RT</h3>
                        <p class="text-slate-500 font-medium leading-relaxed">Pengaturan kalender aktivitas kemasyarakatan, penjadwalan gotong royong, dan tracking peserta.</p>
                        
                        <div class="mt-6 flex gap-3 text-sm font-bold text-violet-600 group-hover:text-violet-700">
                            Atur Agenda Khusus &rarr;
                        </div>
                    </div>
                </a>

                <!-- Modul Master Iuran -->
                <a href="{{ route('admin.jenis-iuran.index') }}" class="group relative bg-white p-7 rounded-3xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-1 hover:border-teal-100 transition-all duration-300">
                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-teal-50 text-teal-600 mb-6 group-hover:scale-110 group-hover:bg-teal-600 group-hover:text-white transition-all shadow-sm">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-2">Master Jenis Iuran</h3>
                        <p class="text-slate-500 font-medium leading-relaxed">Pencatatan fondasi kategori iuran warga. Penetapan nominal biaya dasar rutin atau insidental.</p>
                        
                        <div class="mt-6 flex gap-3 text-sm font-bold text-teal-600 group-hover:text-teal-700">
                            Kelola Master &rarr;
                        </div>
                    </div>
                </a>

                <!-- Modul Penagihan -->
                <a href="{{ route('admin.tagihan-iuran.index') }}" class="group relative bg-white p-7 rounded-3xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-1 hover:border-cyan-100 transition-all duration-300">
                    <div class="absolute top-0 right-0 p-6 opacity-0 group-hover:opacity-10 transition-opacity">
                        <svg class="w-24 h-24 text-cyan-600 transform group-hover:rotate-12 transition-transform duration-500 delay-75" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                    </div>

                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-cyan-50 text-cyan-600 mb-6 group-hover:scale-110 group-hover:bg-cyan-600 group-hover:text-white transition-all shadow-sm">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-2">Penagihan & Keuangan</h3>
                        <p class="text-slate-500 font-medium leading-relaxed">Buat rincian tagihan per warga. Modul verifikasi pembayaran instan khusus operator.</p>
                        
                        <div class="mt-6 flex gap-3 text-sm font-bold text-cyan-600 group-hover:text-cyan-700">
                            Lihat Mutasi Tagihan &rarr;
                        </div>
                    </div>
                </a>

                <!-- Modul Laporan Data -->
                <a href="{{ route('admin.laporan.index') }}" class="group md:col-span-2 lg:col-span-3 relative bg-gradient-to-r from-slate-900 to-indigo-900 justify-between p-8 rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 flex flex-col md:flex-row items-center cursor-pointer">
                    <div class="absolute right-0 top-0 h-full w-1/2 bg-gradient-to-l from-white/10 to-transparent pointer-events-none"></div>

                    <div class="relative z-10 flex-1 md:pr-10 text-center md:text-left">
                        <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-white/10 text-white mb-4 backdrop-blur-sm border border-white/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">Audit & Statistik Global</h3>
                        <p class="text-indigo-200 font-medium">Buka visualisasi data agregrat untuk mengevaluasi total populasi, rasio konversi pembayaran, dan status tagihan yang macet se-RT.</p>
                    </div>
                    <div class="relative z-10 mt-6 md:mt-0 flex-shrink-0">
                        <span class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-white text-indigo-900 font-bold hover:bg-slate-50 transition-colors">
                            Buka Laporan
                            <svg class="w-4 h-4 shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </span>
                    </div>
                </a>

            </div>
            
            <div class="mt-12 text-center text-sm font-medium text-slate-400">
                &copy; {{ date('Y') }} Sistem Operasional Rukun Tetangga. Teknologi oleh Tim Antigravity.
            </div>
        </main>
    </div>
</body>
</html>