<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kegiatan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto p-6">
        <div class="bg-white rounded-xl shadow overflow-hidden">
            <div class="bg-indigo-600 px-6 py-8 text-white relative">
                <div class="absolute top-4 right-4">
                    @switch($kegiatan->status)
                        @case('mendatang')
                            <span class="bg-white text-indigo-800 px-3 py-1 rounded-full text-sm font-bold shadow">Mendatang</span>
                            @break
                        @case('berlangsung')
                            <span class="bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-sm font-bold shadow">Sedang Berlangsung</span>
                            @break
                        @case('selesai')
                            <span class="bg-green-400 text-green-900 px-3 py-1 rounded-full text-sm font-bold shadow">Selesai</span>
                            @break
                        @case('batal')
                            <span class="bg-red-400 text-red-900 px-3 py-1 rounded-full text-sm font-bold shadow">Batal</span>
                            @break
                    @endswitch
                </div>
                <h1 class="text-3xl font-bold mb-2 pr-24">{{ $kegiatan->nama_kegiatan }}</h1>
                <p class="text-indigo-100 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    {{ $kegiatan->kategori ?? 'Umum' }}
                </p>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2 space-y-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2 border-b pb-2">Deskripsi Kegiatan</h3>
                            <div class="prose max-w-none text-gray-700 whitespace-pre-wrap">{{ $kegiatan->deskripsi }}</div>
                        </div>
                    </div>
                    
                    <div class="space-y-6">
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                            <h3 class="font-semibold text-gray-800 mb-3">Informasi Pelaksanaan</h3>
                            
                            <div class="space-y-3 text-sm">
                                <div>
                                    <span class="block text-gray-500">Mulai</span>
                                    <span class="font-medium text-gray-900">{{ $kegiatan->tanggal_mulai->format('d M Y, H:i') }}</span>
                                </div>
                                
                                @if($kegiatan->tanggal_selesai)
                                <div>
                                    <span class="block text-gray-500">Selesai</span>
                                    <span class="font-medium text-gray-900">{{ $kegiatan->tanggal_selesai->format('d M Y, H:i') }}</span>
                                </div>
                                @endif
                                
                                <div>
                                    <span class="block text-gray-500">Lokasi</span>
                                    <span class="font-medium text-gray-900">{{ $kegiatan->lokasi }}</span>
                                </div>
                                
                                <div>
                                    <span class="block text-gray-500">Kuota Peserta</span>
                                    <span class="font-medium text-gray-900">
                                        {{ $kegiatan->kuota ? $kegiatan->kuota . ' Orang' : 'Tidak Terbatas' }}
                                    </span>
                                </div>
                                
                                <div class="pt-2 border-t border-gray-200">
                                    <span class="block text-gray-500">Dibuat oleh</span>
                                    <span class="font-medium text-gray-900">{{ $kegiatan->pembuat->name ?? 'Admin' }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-blue-50 p-4 rounded-xl border border-blue-200">
                            <div class="text-center">
                                <span class="block text-sm text-blue-800 mb-1">Peserta Terdaftar</span>
                                <span class="text-3xl font-bold text-blue-900">{{ $kegiatan->peserta_count ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-4 border-t flex justify-end gap-3">
                    <a href="{{ route('admin.kegiatan.index') }}"
                       class="px-5 py-2.5 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200">
                        Kembali Ke Daftar
                    </a>
                    <a href="{{ route('admin.kegiatan.edit', $kegiatan->id) }}"
                       class="px-5 py-2.5 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700">
                        Edit Kegiatan
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
