<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Kegiatan RT</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto p-6">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Kegiatan RT</h1>
                <p class="text-gray-600 mt-1">Daftar agenda dan kegiatan kemasyarakatan</p>
            </div>
            <a href="{{ route('warga.dashboard') }}"
               class="bg-white border text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 flex items-center gap-2 shadow-sm">
                <span>&larr;</span> Dashboard
            </a>
        </div>

        <div class="grid gap-6 md:grid-cols-2">
            @forelse($kegiatan as $item)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition duration-200">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                {{ $item->kategori ?? 'Umum' }}
                            </span>
                            
                            @if($item->status == 'berlangsung')
                                <span class="flex h-3 w-3 relative">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500" title="Berlangsung Sekarang"></span>
                                </span>
                            @endif
                        </div>
                        
                        <h2 class="text-xl font-bold text-gray-900 mb-2 line-clamp-1">
                            {{ $item->nama_kegiatan }}
                        </h2>
                        
                        <p class="text-gray-600 text-sm mb-6 line-clamp-2">
                            {{ \Illuminate\Support\Str::limit($item->deskripsi, 100) }}
                        </p>
                        
                        <div class="space-y-2 mb-6">
                            <div class="flex items-center text-sm text-gray-500 gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $item->tanggal_mulai->format('d M Y') }}
                                <span class="text-gray-300">&bull;</span>
                                {{ $item->tanggal_mulai->format('H:i') }} WIB
                            </div>
                            <div class="flex items-center text-sm text-gray-500 gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span class="line-clamp-1">{{ $item->lokasi }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 border-t border-gray-100 p-4">
                        <a href="{{ route('kegiatan.show', $item->id) }}" class="block w-full text-center text-orange-600 hover:text-orange-700 font-medium text-sm">
                            Lihat Detail Kegiatan &rarr;
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white rounded-2xl shadow-sm p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <h3 class="text-lg font-medium text-gray-900">Belum Ada Kegiatan Mendatang</h3>
                    <p class="mt-1 text-gray-500 text-sm">Jadwal kegiatan kemasyarakatan akan muncul di sini.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $kegiatan->links() }}
        </div>
    </div>
</body>
</html>
