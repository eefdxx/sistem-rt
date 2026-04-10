<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengumuman</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="max-w-3xl mx-auto p-6">
        <div class="bg-white rounded-xl shadow p-6">
            <div class="mb-6 border-b pb-4">
                <h1 class="text-3xl font-bold text-gray-800">{{ $pengumuman->judul }}</h1>
                <div class="flex items-center gap-4 mt-2 text-sm text-gray-500">
                    <span>Oleh: {{ $pengumuman->pembuat->name ?? 'Admin' }}</span>
                    <span>Kategori: {{ $pengumuman->kategori ?? '-' }}</span>
                    <span>
                        @if($pengumuman->status == 'publish')
                            <span class="bg-green-100 text-green-800 px-2 py-0.5 rounded text-xs">Publish</span>
                        @else
                            <span class="bg-yellow-100 text-yellow-800 px-2 py-0.5 rounded text-xs">Draft</span>
                        @endif
                    </span>
                    <span>Tanggal: {{ $pengumuman->tanggal_publish ? $pengumuman->tanggal_publish->format('d/m/Y H:i') : '-' }}</span>
                </div>
            </div>

            <div class="prose max-w-none text-gray-700 whitespace-pre-wrap">
{{ $pengumuman->isi }}
            </div>

            @if($pengumuman->tanggal_berakhir)
                <div class="mt-6 p-4 bg-orange-50 border border-orange-200 rounded-lg text-sm text-orange-800">
                    <strong>Penting:</strong> Pengumuman ini berlaku hingga {{ $pengumuman->tanggal_berakhir->format('d/m/Y') }}.
                </div>
            @endif

            <div class="mt-8 flex justify-end gap-3 border-t pt-4">
                <a href="{{ route('admin.pengumuman.index') }}"
                   class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                    Kembali
                </a>
                <a href="{{ route('admin.pengumuman.edit', $pengumuman->id) }}"
                   class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                    Edit
                </a>
            </div>
        </div>
    </div>
</body>
</html>
