<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail {{ $kegiatan->nama_kegiatan }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="max-w-3xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="mb-6">
            <a href="{{ route('kegiatan.index') }}"
               class="text-orange-600 hover:text-orange-700 font-medium inline-flex items-center gap-2 bg-white px-4 py-2 rounded-full shadow-sm">
                <span>&larr;</span> Kembali ke Daftar
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Header section -->
            <div class="bg-orange-600 px-6 py-10 text-white relative overflow-hidden">
                <div class="absolute -right-10 -top-10 opacity-10">
                    <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24"><path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2z"/></svg>
                </div>
                
                <div class="relative z-10">
                    <span class="inline-block bg-orange-500 text-orange-50 px-3 py-1 rounded-full text-xs font-semibold tracking-wide uppercase mb-4">
                        {{ $kegiatan->kategori ?? 'Umum' }}
                    </span>
                    <h1 class="text-3xl md:text-4xl font-extrabold mb-4">{{ $kegiatan->nama_kegiatan }}</h1>
                    
                    <div class="flex flex-wrap gap-4 text-orange-50 text-sm">
                        <div class="flex items-center gap-1.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span>{{ $kegiatan->tanggal_mulai->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>{{ $kegiatan->tanggal_mulai->format('H:i') }} WIB</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content section -->
            <div class="p-6 md:p-8">
                <!-- Info Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 border-b border-gray-100 pb-8">
                    <div class="flex gap-4 items-start">
                        <div class="bg-gray-50 p-3 rounded-xl">
                            <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-1">Lokasi Pelaksanaan</h3>
                            <p class="text-gray-900 font-medium">{{ $kegiatan->lokasi }}</p>
                        </div>
                    </div>
                    
                    <div class="flex gap-4 items-start">
                        <div class="bg-gray-50 p-3 rounded-xl">
                            <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-1">Kuota Terbatas</h3>
                            <p class="text-gray-900 font-medium">{{ $kegiatan->kuota ? $kegiatan->kuota . ' Warga' : 'Leluasa (Tanpa Batas)' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Informasi Lengkap</h3>
                    <div class="prose max-w-none text-gray-700 leading-relaxed whitespace-pre-wrap">
{{ $kegiatan->deskripsi }}
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-sm text-gray-500">
                    Sistem Informasi RT
                </p>
            </div>
        </div>
    </div>
</body>
</html>
