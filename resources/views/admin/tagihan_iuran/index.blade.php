<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Tagihan Iuran</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="max-w-7xl mx-auto p-6">
        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold">Data Tagihan Iuran</h1>
                    <p class="text-gray-500">Daftar tagihan iuran per warga</p>
                </div>
                <a href="{{ route('admin.tagihan-iuran.create') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Buat Tagihan Baru
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 rounded-lg bg-green-100 text-green-800 px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 rounded-lg bg-red-100 text-red-800 px-4 py-3">
                    {{ session('error') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="w-full border border-gray-200 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2 text-left">Warga</th>
                            <th class="border px-4 py-2 text-left">Jenis & Periode</th>
                            <th class="border px-4 py-2 text-left">Nominal</th>
                            <th class="border px-4 py-2 text-left">Jatuh Tempo</th>
                            <th class="border px-4 py-2 text-center">Status</th>
                            <th class="border px-4 py-2 text-center">Aksi (Konfirmasi)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tagihan as $item)
                            <tr>
                                <td class="border px-4 py-2">
                                    <div class="font-bold">{{ $item->warga->nama_lengkap ?? '-' }}</div>
                                    <div class="text-xs text-gray-500 text-nowrap">NIK: {{ $item->warga->nik ?? '-' }}</div>
                                </td>
                                <td class="border px-4 py-2">
                                    <div class="font-bold">{{ $item->jenisIuran->nama_iuran ?? '-' }}</div>
                                    <div class="text-xs text-gray-500">{{ $item->periode_bulan }} {{ $item->periode_tahun }}</div>
                                </td>
                                <td class="border px-4 py-2 font-mono">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                <td class="border px-4 py-2">{{ $item->jatuh_tempo ? $item->jatuh_tempo->format('d/m/Y') : '-' }}</td>
                                <td class="border px-4 py-2 text-center">
                                    @switch($item->status)
                                        @case('belum_dibayar')
                                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">Belum Dibayar</span>
                                            @break
                                        @case('lunas')
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Lunas</span>
                                            @break
                                        @case('proses_verifikasi')
                                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs">Menunggu Verifikasi</span>
                                            @break
                                    @endswitch
                                </td>
                                <td class="border px-4 py-2 text-center">
                                    @if($item->status !== 'lunas')
                                        <form action="{{ route('admin.tagihan-iuran.konfirmasi', $item->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Konfirmasi tagihan ini sebagai Lunas (Pembayaran Manual/Tunai)?')">
                                            @csrf
                                            <button type="submit"
                                                    class="bg-teal-600 text-white px-3 py-1 rounded hover:bg-teal-700 text-xs shadow-sm">
                                                Tandai Lunas
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-xs text-gray-400">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="border px-4 py-4 text-center text-gray-500">
                                    Belum ada data tagihan iuran.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $tagihan->links() }}
            </div>

            <div class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline">
                    &larr; Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</body>
</html>
