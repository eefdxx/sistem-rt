<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Tagihan - Sistem RT</title>
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
                    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Tagihan & Pembayaran</h1>
                    <p class="text-slate-500 font-medium mt-1">Pantau status pembayaran iuran warga dan verifikasi bukti bayar.</p>
                </div>
                <button onclick="alert('Fitur generate tagihan masal sedang disiapkan.')" class="px-6 py-3 rounded-2xl bg-indigo-600 text-white font-bold hover:bg-indigo-700 transition-all text-sm shadow-xl shadow-indigo-600/20 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    Generate Tagihan Bulanan
                </button>
            </div>

            <div class="bg-white rounded-[2rem] border border-slate-200/60 shadow-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100">
                                <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest text-center">Periode</th>
                                <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Warga / Wajib Bayar</th>
                                <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Jenis Iuran</th>
                                <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Nominal</th>
                                <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Status</th>
                                <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($tagihans as $t)
                            <tr class="hover:bg-slate-50 transition-colors group">
                                <td class="px-6 py-5 text-center">
                                    <span class="text-sm font-black text-slate-900">{{ $t->bulan }}</span>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">{{ $t->tahun }}</p>
                                </td>
                                <td class="px-6 py-5">
                                    <p class="font-bold text-slate-800 tracking-tight leading-none mb-1">{{ $t->warga->nama_lengkap }}</p>
                                    <p class="text-[11px] text-slate-400 font-bold uppercase tracking-tighter">KK: {{ $t->warga->keluarga->no_kk ?? '-' }}</p>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="text-sm font-medium text-slate-600">{{ $t->jenisIuran->nama_iuran }}</span>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="text-sm font-black text-indigo-600 font-mono">Rp{{ number_format($t->nominal, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest 
                                        {{ $t->status === 'lunas' ? 'bg-emerald-100 text-emerald-700' : ($t->status === 'proses' ? 'bg-amber-100 text-amber-700' : 'bg-rose-100 text-rose-700') }}">
                                        {{ $t->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <a href="{{ route('admin.tagihan-iuran.show', $t->id) }}" class="px-4 py-2 rounded-xl bg-slate-50 text-slate-600 font-bold text-xs hover:bg-slate-900 hover:text-white transition-all">Verifikasi</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-20 text-center">
                                    <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">Belum Ada Riwayat Tagihan</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-10">
                {{ $tagihans->links() }}
            </div>
        </main>
    </div>
</body>
</html>
