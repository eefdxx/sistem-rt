<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kewajiban Iuran - Portal Warga</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased selection:bg-rose-500 selection:text-white">
    <div class="min-h-screen">
        <nav class="bg-white sticky top-0 z-50 border-b border-slate-100 shadow-sm">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('warga.dashboard') }}" class="flex items-center gap-3">
                            <div class="bg-rose-500 text-white p-2.5 rounded-2xl shadow-lg shadow-rose-500/20 rotate-3 transition-transform hover:rotate-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                            <span class="text-2xl font-black bg-clip-text text-transparent bg-gradient-to-r from-rose-600 to-pink-600 tracking-tight">Portal Warga</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="mb-10">
                <a href="{{ route('warga.dashboard') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-rose-600 transition-colors uppercase tracking-widest mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali
                </a>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">Kewajiban Iuran</h1>
                <p class="text-slate-500 font-medium mt-1">Daftar tagihan iuran bulanan dan histori pembayaran Anda.</p>
            </div>

            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/40 overflow-hidden mb-12">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100">
                                <th class="px-8 py-6 text-xs font-black text-slate-400 uppercase tracking-widest text-center">Periode</th>
                                <th class="px-8 py-6 text-xs font-black text-slate-400 uppercase tracking-widest">Jenis Iuran</th>
                                <th class="px-8 py-6 text-xs font-black text-slate-400 uppercase tracking-widest">Nominal</th>
                                <th class="px-8 py-6 text-xs font-black text-slate-400 uppercase tracking-widest">Status</th>
                                <th class="px-8 py-6 text-xs font-black text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($tagihans as $t)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-8 py-6 text-center">
                                    <span class="text-lg font-black text-slate-900">{{ $t->bulan }}</span>
                                    <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest">{{ $t->tahun }}</p>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="font-bold text-slate-700">{{ $t->jenisIuran->nama_iuran }}</span>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="text-lg font-black text-rose-600">Rp{{ number_format($t->nominal, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest 
                                        {{ $t->status === 'lunas' ? 'bg-emerald-100 text-emerald-700' : ($t->status === 'proses' ? 'bg-amber-100 text-amber-700' : 'bg-rose-100 text-rose-700') }}">
                                        {{ $t->status }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    @if($t->status === 'belum_bayar')
                                        <button onclick="alert('Form upload bukti bayar sedangan disiapkan.')" class="px-6 py-2.5 rounded-xl bg-slate-900 text-white font-bold text-xs hover:bg-rose-600 transition-all shadow-lg hover:shadow-rose-600/20">Bayar Sekarang</button>
                                    @else
                                        <span class="text-xs font-bold text-slate-400 italic">Terverifikasi</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <p class="text-slate-400 font-bold tracking-widest uppercase text-xs">Tidak Ada Tagihan Terdata</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-8">
                {{ $tagihans->links() }}
            </div>
        </main>
    </div>
</body>
</html>
