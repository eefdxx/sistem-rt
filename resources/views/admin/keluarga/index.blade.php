<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Keluarga - Sistem RT</title>
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
                    
                    <div class="flex items-center gap-4">
                        <a href="{{ route('admin.dashboard') }}" class="text-sm font-semibold text-slate-500 hover:text-indigo-600 transition-colors">Dashboard</a>
                        <div class="h-6 w-px bg-slate-200"></div>
                        <span class="text-sm font-bold text-slate-900">{{ auth()->user()->name }}</span>
                    </div>
                </div>
            </div>
        </nav>

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
                <div>
                    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Buku Master Keluarga</h1>
                    <p class="text-slate-500 font-medium mt-1">Manajemen basis data Kartu Keluarga (KK) dan data alamat warga.</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.warga.index') }}" class="px-5 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-600 font-bold hover:bg-slate-50 transition-all text-sm shadow-sm">
                        Data Warga
                    </a>
                    <a href="{{ route('admin.keluarga.create') }}" class="px-5 py-2.5 rounded-xl bg-indigo-600 text-white font-bold hover:bg-indigo-700 transition-all text-sm shadow-lg shadow-indigo-600/20 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah KK Baru
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-8 p-4 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center gap-3 text-emerald-700 animate-fade-in shadow-sm">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-bold text-sm">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Data Table Card -->
            <div class="bg-white rounded-[2rem] border border-slate-200/60 shadow-xl shadow-slate-200/40 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100">
                                <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest text-center">No</th>
                                <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Detail Kartu Keluarga</th>
                                <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Alamat & Lokasi</th>
                                <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest text-center">Kepala Keluarga</th>
                                <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($keluargas as $index => $keluarga)
                                <tr class="hover:bg-slate-50/80 transition-colors group">
                                    <td class="px-6 py-5 text-sm font-bold text-slate-400 text-center">
                                        {{ $keluargas->firstItem() + $index }}
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600 border border-indigo-100">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                            </div>
                                            <div>
                                                <p class="font-extrabold text-slate-900 leading-none mb-1">{{ $keluarga->no_kk }}</p>
                                                <p class="text-xs text-slate-500 font-medium tracking-tight">Terdaftar: {{ $keluarga->created_at->format('d M Y') }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold text-slate-700 leading-snug">{{ $keluarga->alamat }}</span>
                                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wide mt-1">RT {{ $keluarga->rt }} / RW {{ $keluarga->rw }} • {{ $keluarga->kode_pos }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        @if($keluarga->kepalaKeluarga)
                                            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-100 text-slate-700 border border-slate-200">
                                                <div class="w-5 h-5 rounded-full bg-indigo-600 flex items-center justify-center text-[10px] text-white font-bold">
                                                    {{ strtoupper(substr($keluarga->kepalaKeluarga->nama_lengkap, 0, 1)) }}
                                                </div>
                                                <span class="text-xs font-bold">{{ $keluarga->kepalaKeluarga->nama_lengkap }}</span>
                                            </div>
                                        @else
                                            <span class="text-xs font-bold text-slate-300 italic">Belum ditentukan</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5 text-right">
                                        <div class="flex justify-end items-center gap-2">
                                            <a href="{{ route('admin.keluarga.edit', $keluarga->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-50 text-amber-600 rounded-xl font-bold text-xs hover:bg-amber-100 transition-all border border-amber-100">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.keluarga.destroy', $keluarga->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data keluarga ini? Semua data warga yang terikat akan kehilangan relasi KK mereka.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-20 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-16 h-16 bg-slate-50 text-slate-200 rounded-2xl flex items-center justify-center mb-4">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                            </div>
                                            <p class="text-slate-500 font-bold">Belum Ada Data Keluarga</p>
                                            <p class="text-slate-400 text-sm mt-1">Silakan tambahkan Kartu Keluarga baru untuk pengorganisasian warga.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($keluargas->hasPages())
                    <div class="px-6 py-6 bg-slate-50/50 border-t border-slate-100">
                        {{ $keluargas->links() }}
                    </div>
                @endif
            </div>

            <div class="mt-8 flex justify-center">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest leading-none">&copy; {{ date('Y') }} Sistem Operasional Rukun Tetangga. Teknologi oleh Tim Antigravity.</p>
            </div>
        </main>
    </div>
</body>
</html>