<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iuran Warga</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto p-6">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Tagihan Iuran Saya</h1>
                <p class="text-gray-600 mt-1">Daftar tagihan warga atas nama {{ auth()->user()->warga->nama_lengkap ?? auth()->user()->name }}</p>
            </div>
            <a href="{{ route('warga.dashboard') }}"
               class="bg-white border text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 flex items-center gap-2 shadow-sm">
                <span>&larr;</span> Dashboard
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100">
                            <th class="py-3 px-4 font-semibold text-gray-700 text-sm">Jenis Tagihan</th>
                            <th class="py-3 px-4 font-semibold text-gray-700 text-sm">Periode</th>
                            <th class="py-3 px-4 font-semibold text-gray-700 text-sm">Jatuh Tempo</th>
                            <th class="py-3 px-4 font-semibold text-gray-700 text-sm">Nominal</th>
                            <th class="py-3 px-4 font-semibold text-gray-700 text-sm text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($tagihan as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-4 px-4">
                                <div class="font-bold text-gray-800">{{ $item->jenisIuran->nama_iuran ?? 'Iuran' }}</div>
                                @if($item->keterangan)
                                <div class="text-xs text-gray-500 mt-1">{{ $item->keterangan }}</div>
                                @endif
                            </td>
                            <td class="py-4 px-4 text-sm text-gray-600">
                                {{ $item->periode_bulan }} {{ $item->periode_tahun }}
                            </td>
                            <td class="py-4 px-4 text-sm">
                                @if($item->jatuh_tempo)
                                    @if($item->jatuh_tempo->isPast() && $item->status == 'belum_dibayar')
                                        <span class="text-red-600 font-medium">{{ $item->jatuh_tempo->format('d/m/Y') }} (Terlewat)</span>
                                    @else
                                        <span class="text-gray-600">{{ $item->jatuh_tempo->format('d/m/Y') }}</span>
                                    @endif
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="py-4 px-4 font-mono font-medium text-gray-900">
                                Rp {{ number_format($item->nominal, 0, ',', '.') }}
                            </td>
                            <td class="py-4 px-4 text-center">
                                @switch($item->status)
                                    @case('belum_dibayar')
                                        <span class="inline-flex bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-bold shadow-sm">Belum Dibayar</span>
                                        @break
                                    @case('lunas')
                                        <span class="inline-flex bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-bold shadow-sm">Lunas</span>
                                        <div class="text-xs text-gray-500 mt-1">Pada {{ $item->pembayaran->first() ? $item->pembayaran->first()->tanggal_bayar->format('d/m/Y') : '-' }}</div>
                                        @break
                                    @case('proses_verifikasi')
                                        <span class="inline-flex bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-bold shadow-sm">Dalam Verifikasi</span>
                                        @break
                                @endswitch
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-gray-500">
                                Belum ada riwayat tagihan atau iuran untuk akun Anda.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6 border-t pt-4">
                {{ $tagihan->links() }}
            </div>
            
            <div class="mt-6 bg-teal-50 border border-teal-100 p-4 rounded-xl flex gap-4">
                <div class="text-teal-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h4 class="font-bold text-teal-800 text-sm">Informasi Pembayaran</h4>
                    <p class="text-teal-700 text-sm mt-1">
                        Saat ini pembayaran tagihan dapat dilakukan secara langsung (tunai) kepada Bendahara RT. Status tagihan Anda akan otomatis diperbarui setelah diserahkan.
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
