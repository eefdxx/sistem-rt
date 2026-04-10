<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Warga - {{ $warga->nama_lengkap }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 antialiased text-slate-800 selection:bg-indigo-500 selection:text-white">
    <div class="min-h-screen">
        <!-- Navbar -->
        <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-200/60 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                            <div class="bg-gradient-to-br from-indigo-600 to-violet-600 text-white p-2.5 rounded-xl shadow-lg shadow-indigo-600/20 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                            <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-slate-900 to-slate-700 tracking-tight">Sistem RT</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <a href="{{ route('admin.warga.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-indigo-600 transition-colors uppercase tracking-widest mb-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali ke Daftar
                    </a>
                    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Profil Detail Penduduk</h1>
                    <p class="text-slate-500 font-medium mt-1">Informasi komprehensif mengenai data kependudukan perorangan.</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.warga.edit', $warga->id) }}" class="px-6 py-3 rounded-2xl bg-amber-50 text-amber-600 font-bold hover:bg-amber-100 transition-all text-sm border border-amber-100 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        Ubah Data
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column: Avatar & Quick Info -->
                <div class="lg:col-span-1 space-y-8">
                    <div class="bg-white rounded-[2.5rem] border border-slate-200/60 shadow-xl shadow-slate-200/40 p-10 flex flex-col items-center text-center">
                        <div class="relative mb-6">
                            <div class="w-32 h-32 rounded-[2.5rem] bg-gradient-to-br from-indigo-500 to-violet-600 p-1 shadow-2xl shadow-indigo-200">
                                <div class="w-full h-full rounded-[2.3rem] bg-white flex items-center justify-center overflow-hidden">
                                     <span class="text-4xl font-black text-indigo-600">{{ strtoupper(substr($warga->nama_lengkap, 0, 1)) }}</span>
                                </div>
                            </div>
                            <div class="absolute -bottom-2 -right-2 px-4 py-1.5 rounded-full bg-white border border-slate-100 shadow-md text-[10px] font-black uppercase tracking-widest text-indigo-600">
                                {{ str_replace('_', ' ', $warga->status_keluarga) }}
                            </div>
                        </div>
                        <h2 class="text-2xl font-black text-slate-900 leading-tight mb-1">{{ $warga->nama_lengkap }}</h2>
                        <p class="text-sm font-bold text-slate-400 tracking-widest uppercase mb-6">{{ $warga->nik }}</p>
                        
                        <div class="w-full space-y-3">
                            <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 border border-slate-100">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Domisili</span>
                                <span class="text-sm font-bold text-indigo-600 uppercase tracking-wide">{{ str_replace('_', ' ', $warga->status_warga) }}</span>
                            </div>
                            <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 border border-slate-100">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">JK</span>
                                <span class="text-sm font-bold text-slate-700">{{ $warga->jenis_kelamin }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-slate-900 to-indigo-950 rounded-[2.5rem] p-8 text-white shadow-2xl">
                        <h3 class="text-xs font-black text-indigo-300 uppercase tracking-[0.2em] mb-4">Informasi Akun</h3>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center border border-white/10">
                                <svg class="w-6 h-6 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <div class="overflow-hidden">
                                <p class="text-xs font-bold text-indigo-200/50 uppercase tracking-widest leading-none mb-1">Email Terhubung</p>
                                <p class="font-bold truncate">{{ $warga->user->email ?? 'Tidak terhubung' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Full Details -->
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white rounded-[2.5rem] border border-slate-200/60 shadow-xl shadow-slate-200/40 p-10">
                        <div class="flex items-center gap-3 mb-8">
                            <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0v1m-4 0a2 2 0 014 0v1m-4 0a2 2 0 014 0v1"></path></svg>
                            </div>
                            <h2 class="text-xl font-black text-slate-900">Data Demografis</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-10">
                            <div>
                                <p class="text-xs font-black text-slate-300 uppercase tracking-widest leading-none mb-2">Tempat, Tanggal Lahir</p>
                                <p class="font-bold text-slate-700">{{ $warga->tempat_lahir ?? 'N/A' }}, {{ $warga->tanggal_lahir?->format('d F Y') ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-black text-slate-300 uppercase tracking-widest leading-none mb-2">Pekerjaan Utama</p>
                                <p class="font-bold text-slate-700">{{ $warga->pekerjaan ?? 'Tidak diisi' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-black text-slate-300 uppercase tracking-widest leading-none mb-2">Keyakinan (Agama)</p>
                                <p class="font-bold text-slate-700">{{ $warga->agama ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-black text-slate-300 uppercase tracking-widest leading-none mb-2">Status Pernikahan</p>
                                <p class="font-bold text-slate-700">{{ $warga->status_perkawinan ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-black text-slate-300 uppercase tracking-widest leading-none mb-2">No. Telepon / WA</p>
                                <p class="font-bold text-slate-700">{{ $warga->no_hp ?? 'Tidak tersedia' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-black text-slate-300 uppercase tracking-widest leading-none mb-2">Email Pribadi</p>
                                <p class="font-bold text-slate-700 lowercase">{{ $warga->email_pribadi ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="mt-12 pt-10 border-t border-slate-50">
                             <div class="flex items-center gap-3 mb-8">
                                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                </div>
                                <h2 class="text-xl font-black text-slate-900">Afiliasi Keluarga</h2>
                            </div>
                            <div class="bg-slate-50 rounded-3xl p-8 border border-slate-100 flex items-center justify-between">
                                <div>
                                    <p class="text-xs font-black text-slate-400 uppercase tracking-widest leading-none mb-2">Nomor Kartu Keluarga</p>
                                    <p class="text-2xl font-black text-indigo-600 tracking-tight">{{ $warga->keluarga->no_kk ?? 'BELUM TERIKAT' }}</p>
                                </div>
                                @if($warga->keluarga)
                                    <a href="{{ route('admin.keluarga.index') }}" class="px-6 py-3 rounded-2xl bg-white border border-slate-200 text-slate-600 font-bold hover:bg-white hover:text-indigo-600 transition-all text-xs shadow-sm">
                                        Lihat KK &rarr;
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-12 text-center">
                 <p class="text-xs font-bold text-slate-400 uppercase tracking-widest leading-none">&copy; {{ date('Y') }} Sistem Operasional Rukun Tetangga.</p>
            </div>
        </main>
    </div>
</body>
</html>