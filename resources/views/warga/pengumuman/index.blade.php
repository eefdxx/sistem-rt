<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman RT</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold">Pengumuman RT</h1>
                <p class="text-gray-500">Informasi terbaru untuk warga</p>
            </div>
            <a href="{{ route('warga.dashboard') }}"
               class="bg-white border text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50">
                Kembali ke Dashboard
            </a>
        </div>

        <div class="space-y-4">
            @forelse($pengumuman as $item)
                <div class="bg-white rounded-xl shadow p-6 hover:shadow-md transition">
                    <div class="flex justify-between items-start mb-2">
                        <h2 class="text-xl font-bold text-gray-800">
                            <a href="{{ route('warga.pengumuman.show', $item->id) }}" class="hover:text-indigo-600">
                                {{ $item->judul }}
                            </a>
                        </h2>
                        <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">
                            {{ $item->tanggal_publish ? $item->tanggal_publish->diffForHumans() : '' }}
                        </span>
                    </div>
                    
                    <p class="text-gray-600 line-clamp-3 mb-4">
                        {{ \Illuminate\Support\Str::limit($item->isi, 150) }}
                    </p>
                    
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500">Kategori: {{ $item->kategori ?? 'Umum' }}</span>
                        <a href="{{ route('warga.pengumuman.show', $item->id) }}" class="text-indigo-600 hover:underline font-medium">
                            Baca selengkapnya &rarr;
                        </a>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-xl shadow p-8 text-center text-gray-500">
                    Belum ada pengumuman saat ini.
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $pengumuman->links() }}
        </div>
    </div>
</body>
</html>
