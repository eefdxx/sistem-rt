<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Laporan RT</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="max-w-7xl mx-auto p-6 space-y-6">
        
        <!-- Header -->
        <div class="flex items-center justify-between mb-2">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Statistik & Laporan Sistem RT</h1>
                <p class="text-gray-500 mt-1">Ringkasan demografi, aktivitas, dan keuangan warga.</p>
            </div>
            <a href="{{ route('admin.dashboard') }}"
               class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 shadow-sm transition">
                &larr; Kembali
            </a>
        </div>

        <!-- Section 1: Kependudukan -->
        <h2 class="text-xl font-bold border-b pb-2 text-gray-800">1. Kependudukan</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-xl shadow-sm p-6 border-t-4 border-blue-500">
                <p class="text-sm text-gray-500 font-medium tracking-wide">Total Kartu Keluarga</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($total_keluarga) }} <span class="text-sm font-normal text-gray-500">KK</span></p>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6 border-t-4 border-blue-600">
                <p class="text-sm text-gray-500 font-medium tracking-wide">Total Warga Terdaftar</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($total_warga) }} <span class="text-sm font-normal text-gray-500">Jiwa</span></p>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6 border-t-4 border-indigo-400">
                <p class="text-sm text-gray-500 font-medium tracking-wide">Laki-laki</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($warga_laki) }} <span class="text-sm font-normal text-gray-500">Jiwa</span></p>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6 border-t-4 border-pink-400">
                <p class="text-sm text-gray-500 font-medium tracking-wide">Perempuan</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($warga_perempuan) }} <span class="text-sm font-normal text-gray-500">Jiwa</span></p>
            </div>
        </div>

        <!-- Section 2: Publikasi & Informasi -->
        <h2 class="text-xl font-bold border-b pb-2 text-gray-800 mt-8">2. Pengumuman & Kegiatan</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500 font-medium tracking-wide">Total Pengumuman</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($total_pengumuman) }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-green-600 font-bold bg-green-50 px-2 py-1 rounded">Publish: {{ number_format($pengumuman_publish) }}</p>
                        <p class="text-sm text-yellow-600 font-bold bg-yellow-50 px-2 py-1 rounded mt-1">Draft: {{ number_format($total_pengumuman - $pengumuman_publish) }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500 font-medium tracking-wide">Total Kegiatan RT</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($total_kegiatan) }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-blue-600 font-bold bg-blue-50 px-2 py-1 rounded">Akan Datang: {{ number_format($kegiatan_mendatang) }}</p>
                        <p class="text-sm text-gray-600 font-bold bg-gray-50 px-2 py-1 rounded mt-1">Selesai/Lainnya: {{ number_format($total_kegiatan - $kegiatan_mendatang) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 3: Keuangan -->
        <h2 class="text-xl font-bold border-b pb-2 text-gray-800 mt-8">3. Ringkasan Kas & Iuran</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="md:col-span-1 bg-gradient-to-br from-green-500 to-green-600 text-white rounded-xl shadow-sm p-6">
                <p class="text-green-100 font-medium tracking-wide text-sm">Total Dana Masuk (Lunas & Terverifikasi)</p>
                <p class="text-4xl font-extrabold mt-2">Rp {{ number_format($uang_masuk_terverifikasi, 0, ',', '.') }}</p>
                <p class="mt-4 text-xs text-green-200">Berdasarkan data histori riwayat pembayaran seluruh waktu.</p>
            </div>
            
            <div class="md:col-span-2 grid grid-cols-2 gap-4">
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <p class="text-sm text-gray-500 font-medium tracking-wide">Total Estimasi Asset (Ditagihkan)</p>
                    <p class="text-2xl font-bold text-gray-900 mt-2">Rp {{ number_format($total_tagihan, 0, ',', '.') }}</p>
                    <p class="text-xs text-gray-400 mt-1">Termasuk yang belum lunas</p>
                </div>
                
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <p class="text-sm text-gray-500 font-medium tracking-wide">Tagihan Lunas vs Menunggak</p>
                    <div class="flex items-center gap-4 mt-2">
                        <div>
                            <span class="block text-xl font-bold text-green-600">{{ number_format($tagihan_lunas_count) }}</span>
                            <span class="text-xs text-gray-400">Lunas</span>
                        </div>
                        <div class="h-8 w-px bg-gray-200"></div>
                        <div>
                            <span class="block text-xl font-bold text-red-500">{{ number_format($tagihan_belum_bayar_count) }}</span>
                            <span class="text-xs text-gray-400">Menunggak</span>
                        </div>
                    </div>
                </div>

                <div class="col-span-2 bg-indigo-50 border border-indigo-100 rounded-xl p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-indigo-800 font-medium tracking-wide">Tagihan Khusus Periode Ini</p>
                            <p class="text-2xl font-bold text-indigo-900 mt-1">Rp {{ number_format($tagihan_bulan_ini, 0, ',', '.') }}</p>
                        </div>
                        <div class="text-right">
                            <span class="bg-white text-indigo-800 font-bold px-4 py-2 rounded-lg shadow-sm">
                                {{ $bulan_ini }} {{ $tahun_ini }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</body>
</html>
