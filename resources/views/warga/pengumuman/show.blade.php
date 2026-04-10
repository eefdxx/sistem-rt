<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pengumuman->judul }} - Pengumuman RT</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="max-w-3xl mx-auto p-6">
        <div class="mb-4">
            <a href="{{ route('warga.pengumuman.index') }}"
               class="text-indigo-600 hover:underline flex items-center gap-1">
                &larr; Kembali ke Daftar Pengumuman
            </a>
        </div>

        <div class="bg-white rounded-xl shadow p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $pengumuman->judul }}</h1>
            
            <div class="flex items-center gap-4 text-sm text-gray-500 mb-8 pb-4 border-b">
                <span>Diterbitkan: {{ $pengumuman->tanggal_publish ? $pengumuman->tanggal_publish->format('d M Y, H:i') : '' }}</span>
                <span>Kategori: {{ $pengumuman->kategori ?? 'Umum' }}</span>
            </div>

            <div class="prose max-w-none text-gray-800 leading-relaxed whitespace-pre-wrap">
{{ $pengumuman->isi }}
            </div>
            
            @if($pengumuman->tanggal_berakhir)
                <div class="mt-8 p-4 bg-yellow-50 border border-yellow-200 rounded-lg text-sm text-yellow-800">
                    <strong>Catatan:</strong> Informasi ini berlaku hingga {{ $pengumuman->tanggal_berakhir->format('d F Y') }}.
                </div>
            @endif
        </div>
    </div>
</body>
</html>
