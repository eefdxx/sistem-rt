<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tagihan Iuran Saya</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">
    <!-- Navbar Minimalis -->
    <nav class="bg-white sticky top-0 z-50 border-b border-slate-100 shadow-sm">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-3">
                    <a href="{{ route('warga.dashboard') }}" class="group flex items-center justify-center w-10 h-10 rounded-full bg-slate-50 border border-slate-200 hover:bg-slate-100 hover:border-slate-300 transition-all">
                        <svg class="w-5 h-5 text-slate-500 group-hover:text-slate-700 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                    </a>
                    <span class="text-xl font-bold text-slate-800">Kembali ke Dasbor</span>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1 class="text-4xl font-black text-slate-800 tracking-tight">Tagihan & Iuran Saya</h1>
                <p class="text-slate-500 font-medium mt-2 text-lg">Kelola kewajiban iuran untuk fasilitas lingkungan RT bersama.</p>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/40 border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto p-2">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-2 border-slate-100">
                            <th class="py-5 px-6 font-bold text-slate-400 uppercase tracking-wider text-xs">Detail Tagihan</th>
                            <th class="py-5 px-6 font-bold text-slate-400 uppercase tracking-wider text-xs">Periode</th>
                            <th class="py-5 px-6 font-bold text-slate-400 uppercase tracking-wider text-xs">Jatuh Tempo</th>
                            <th class="py-5 px-6 font-bold text-slate-400 uppercase tracking-wider text-xs">Nominal</th>
                            <th class="py-5 px-6 font-bold text-slate-400 uppercase tracking-wider text-xs text-right">Status Evaluasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($tagihan as $item)
                        <tr class="hover:bg-slate-50/80 transition-colors group">
                            <td class="py-5 px-6">
                                <div class="font-bold text-slate-800 text-lg sm:text-base group-hover:text-rose-600 transition-colors">{{ $item->jenisIuran->nama_iuran ?? 'Iuran' }}</div>
                                @if($item->keterangan)
                                <div class="text-sm font-medium text-slate-500 mt-0.5 line-clamp-1">{{ $item->keterangan }}</div>
                                @endif
                            </td>
                            <td class="py-5 px-6 text-sm font-semibold text-slate-600">
                                <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-100 rounded-lg">
                                    {{ $item->periode_bulan }} {{ $item->periode_tahun }}
                                </div>
                            </td>
                            <td class="py-5 px-6 text-sm font-medium">
                                @if($item->jatuh_tempo)
                                    @if($item->jatuh_tempo->isPast() && $item->status == 'belum_dibayar')
                                        <span class="text-red-500 font-bold drop-shadow-sm flex items-center gap-1.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            {{ $item->jatuh_tempo->format('d/m/Y') }}
                                        </span>
                                    @else
                                        <span class="text-slate-600">{{ $item->jatuh_tempo->format('d/m/Y') }}</span>
                                    @endif
                                @else
                                    <span class="text-slate-300 font-bold">-</span>
                                @endif
                            </td>
                            <td class="py-5 px-6 font-mono font-bold text-lg text-slate-900 tracking-tight">
                                Rp {{ number_format($item->nominal, 0, ',', '.') }}
                            </td>
                            <td class="py-5 px-6 text-right">
                                @switch($item->status)
                                    @case('belum_dibayar')
                                        <span class="inline-flex border-2 border-red-100 bg-red-50 text-red-600 px-4 py-1.5 rounded-xl text-sm font-bold shadow-sm flex-col items-center justify-center">
                                            Menunggak
                                        </span>
                                        @break
                                    @case('lunas')
                                        <div class="inline-flex flex-col items-end">
                                            <span class="inline-flex border-2 border-emerald-100 bg-emerald-50 text-emerald-600 px-4 py-1.5 rounded-xl text-sm font-bold shadow-sm">
                                                Lunas
                                            </span>
                                            <div class="text-[11px] font-bold text-emerald-600/60 mt-1 uppercase tracking-wider">Tuntas: {{ $item->pembayaran->first() ? $item->pembayaran->first()->tanggal_bayar->format('d/m/y') : '-' }}</div>
                                        </div>
                                        @break
                                    @case('proses_verifikasi')
                                        <span class="inline-flex border-2 border-amber-100 bg-amber-50 text-amber-600 px-4 py-1.5 rounded-xl text-sm font-bold shadow-sm">
                                            Verifikasi
                                        </span>
                                        @break
                                @endswitch
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-16 text-center">
                                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-50 text-slate-300 mb-4">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <h3 class="text-xl font-bold text-slate-800">Catatan Bersih</h3>
                                <p class="text-slate-500 font-medium">Buku tagihan Anda masih kosong.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="border-t border-slate-100 p-6 bg-slate-50/50">
                {{ $tagihan->links() }}
            </div>
        </div>
        
        <div class="mt-8 bg-gradient-to-r from-emerald-500 to-teal-500 text-white p-6 sm:p-8 rounded-3xl shadow-xl shadow-emerald-500/20 flex flex-col sm:flex-row gap-6 items-center">
            <div class="bg-white/20 p-4 rounded-2xl backdrop-blur-md shrink-0">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <h4 class="text-xl font-black mb-1">Tata Cara Pelunasan Praktis</h4>
                <p class="text-emerald-50 font-medium text-lg leading-relaxed">
                    Sistem saat ini menyederhanakan pelunasan. Serahkan dana tunai Anda kepada <span class="font-bold text-white bg-white/20 px-2 py-0.5 rounded">Bendahara RT</span> saat perkumpulan, dan status di aplikasi ini akan otomatis menyala hijau.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
