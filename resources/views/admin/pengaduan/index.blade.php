<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengaduan - Sistem RT</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 antialiased text-slate-800">
<div class="min-h-screen">

    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-200/60 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-indigo-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Dashboard Admin
                </a>
                <span class="text-sm font-bold text-slate-400">Admin Panel</span>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- Flash --}}
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl font-semibold text-sm mb-6">✅ {{ session('success') }}</div>
        @endif

        <div class="flex items-start justify-between mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Pengaduan Warga</h1>
                <p class="text-slate-500 text-sm mt-1">Kelola laporan masalah lingkungan yang dikirim oleh warga.</p>
            </div>
        </div>

        {{-- Statistik Ringkas --}}
        <div class="grid grid-cols-3 gap-4 mb-8">
            <div class="bg-amber-50 border border-amber-100 rounded-2xl p-5">
                <p class="text-xs font-black uppercase tracking-widest text-amber-600 mb-1">Menunggu</p>
                <p class="text-3xl font-extrabold text-amber-700">{{ $totalMenunggu }}</p>
            </div>
            <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5">
                <p class="text-xs font-black uppercase tracking-widest text-blue-600 mb-1">Diproses</p>
                <p class="text-3xl font-extrabold text-blue-700">{{ $totalDiproses }}</p>
            </div>
            <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-5">
                <p class="text-xs font-black uppercase tracking-widest text-emerald-600 mb-1">Selesai</p>
                <p class="text-3xl font-extrabold text-emerald-700">{{ $totalSelesai }}</p>
            </div>
        </div>

        {{-- Filter --}}
        <form method="GET" action="{{ route('admin.pengaduan.index') }}" class="flex gap-3 mb-6">
            <select name="status" class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="">Semua Status</option>
                <option value="menunggu" {{ request('status') === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="diproses" {{ request('status') === 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="ditolak" {{ request('status') === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
            <select name="prioritas" class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="">Semua Prioritas</option>
                <option value="tinggi" {{ request('prioritas') === 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                <option value="sedang" {{ request('prioritas') === 'sedang' ? 'selected' : '' }}>Sedang</option>
                <option value="rendah" {{ request('prioritas') === 'rendah' ? 'selected' : '' }}>Rendah</option>
            </select>
            <button type="submit" class="px-5 py-2 rounded-xl bg-indigo-600 text-white font-bold text-sm hover:bg-indigo-700 transition-all">Filter</button>
            @if(request()->hasAny(['status', 'prioritas']))
            <a href="{{ route('admin.pengaduan.index') }}" class="px-5 py-2 rounded-xl bg-slate-100 text-slate-600 font-bold text-sm hover:bg-slate-200 transition-all">Reset</a>
            @endif
        </form>

        {{-- Daftar Laporan --}}
        <div class="bg-white rounded-[2rem] border border-slate-200/60 shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Warga</th>
                            <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Laporan</th>
                            <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Prioritas</th>
                            <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Status</th>
                            <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Tanggal</th>
                            <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($laporans as $lap)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-5">
                                <p class="font-bold text-slate-800 text-sm">{{ $lap->warga->nama_lengkap }}</p>
                                <p class="text-xs text-slate-400">{{ $lap->kategori->nama_kategori ?? '-' }}</p>
                            </td>
                            <td class="px-6 py-5 max-w-xs">
                                <p class="font-semibold text-slate-800 text-sm truncate">{{ $lap->judul }}</p>
                                <p class="text-xs text-slate-400 truncate mt-0.5">{{ Str::limit($lap->deskripsi, 60) }}</p>
                            </td>
                            <td class="px-6 py-5">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest
                                    {{ $lap->prioritas === 'tinggi' ? 'bg-rose-100 text-rose-700' :
                                       ($lap->prioritas === 'sedang' ? 'bg-amber-100 text-amber-700' : 'bg-slate-100 text-slate-500') }}">
                                    {{ $lap->prioritas }}
                                </span>
                            </td>
                            <td class="px-6 py-5">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest
                                    {{ $lap->status === 'selesai' ? 'bg-emerald-100 text-emerald-700' :
                                       ($lap->status === 'diproses' ? 'bg-blue-100 text-blue-700' :
                                       ($lap->status === 'ditolak' ? 'bg-rose-100 text-rose-700' : 'bg-amber-100 text-amber-700')) }}">
                                    {{ $lap->status }}
                                </span>
                            </td>
                            <td class="px-6 py-5">
                                <p class="text-xs text-slate-500">{{ $lap->tanggal_laporan->format('d M Y') }}</p>
                            </td>
                            <td class="px-6 py-5 text-right">
                                <a href="{{ route('admin.pengaduan.show', $lap->id) }}"
                                   class="px-4 py-2 rounded-xl bg-slate-50 text-slate-600 font-bold text-xs hover:bg-indigo-600 hover:text-white transition-all">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-20 text-center">
                                <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">Belum ada laporan masuk</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8">{{ $laporans->links() }}</div>
    </main>
</div>
</body>
</html>
