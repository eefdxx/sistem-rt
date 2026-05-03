<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Jenis Iuran - Sistem RT</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 antialiased text-slate-800">
    <div class="min-h-screen">
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

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
                <div>
                    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Master Iuran</h1>
                    <p class="text-slate-500 font-medium mt-1">Definisikan jenis-jenis iuran rutin maupun insidental untuk warga.</p>
                </div>
                <!-- Button to trigger modal potentially, or just a new page -->
                <a href="{{ route('admin.jenis-iuran.create') }}" class="px-6 py-3 rounded-2xl bg-indigo-600 text-white font-bold hover:bg-indigo-700 transition-all text-sm shadow-xl shadow-indigo-600/20 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Tambah Jenis Iuran
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($jenisIurans as $j)
                <div class="bg-white rounded-[2rem] border border-slate-200/60 shadow-xl shadow-slate-200/40 p-8 flex flex-col group hover:border-indigo-200 transition-all">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h2 class="text-lg font-bold text-slate-900 leading-tight mb-1">{{ $j->nama_iuran }}</h2>
                    <p class="text-sm text-slate-400 font-bold uppercase tracking-widest mb-4 italic">{{ $j->frekuensi }}</p>
                    
                    <div class="mt-auto">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Nominal Tetap</p>
                        <p class="text-2xl font-black text-slate-900 tracking-tight mb-6">Rp {{ number_format($j->nominal_default, 0, ',', '.') }}</p>
                        
                        <div class="flex gap-2">
                             <a href="{{ route('admin.jenis-iuran.edit', $j->id) }}" class="flex-1 py-3 text-center rounded-xl bg-slate-50 text-slate-600 font-bold text-xs hover:bg-indigo-50 hover:text-indigo-600 transition-all">Edit</a>
                             <form action="{{ route('admin.jenis-iuran.destroy', $j->id) }}" method="POST" onsubmit="return confirm('Hapus jenis iuran ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-3 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                             </form>
                        </div>
                    </div>
                </div>
                @empty
                 <div class="md:col-span-3 py-20 bg-white rounded-[2rem] border border-slate-200/60 shadow-xl flex flex-col items-center">
                    <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">Belum Ada Definisi Iuran</p>
                </div>
                @endforelse
            </div>
        </main>
    </div>
</body>
</html>
