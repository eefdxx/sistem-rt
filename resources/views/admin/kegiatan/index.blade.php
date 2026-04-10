<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kegiatan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="max-w-7xl mx-auto p-6">
        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold">Data Kegiatan</h1>
                    <p class="text-gray-500">Daftar agenda kegiatan RT</p>
                </div>
                <a href="{{ route('admin.kegiatan.create') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Tambah Kegiatan
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 rounded-lg bg-green-100 text-green-800 px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="w-full border border-gray-200 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2 text-left">No</th>
                            <th class="border px-4 py-2 text-left">Nama Kegiatan</th>
                            <th class="border px-4 py-2 text-left">Waktu Mulai</th>
                            <th class="border px-4 py-2 text-left">Lokasi</th>
                            <th class="border px-4 py-2 text-center">Status</th>
                            <th class="border px-4 py-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kegiatan as $index => $item)
                            <tr>
                                <td class="border px-4 py-2 text-center">
                                    {{ $kegiatan->firstItem() + $index }}
                                </td>
                                <td class="border px-4 py-2">
                                    {{ $item->nama_kegiatan }}
                                    @if($item->kategori)
                                        <div class="text-xs text-gray-500">{{ $item->kategori }}</div>
                                    @endif
                                </td>
                                <td class="border px-4 py-2">{{ $item->tanggal_mulai->format('d/m/Y H:i') }}</td>
                                <td class="border px-4 py-2">{{ $item->lokasi }}</td>
                                <td class="border px-4 py-2 text-center">
                                    @switch($item->status)
                                        @case('mendatang')
                                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">Mendatang</span>
                                            @break
                                        @case('berlangsung')
                                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs">Berlangsung</span>
                                            @break
                                        @case('selesai')
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Selesai</span>
                                            @break
                                        @case('batal')
                                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">Batal</span>
                                            @break
                                    @endswitch
                                </td>
                                <td class="border px-4 py-2 text-center">
                                    <div class="flex justify-center gap-1">
                                        <a href="{{ route('admin.kegiatan.show', $item->id) }}"
                                           class="bg-indigo-500 text-white px-2 py-1 rounded hover:bg-indigo-600">
                                            Detail
                                        </a>
                                        <a href="{{ route('admin.kegiatan.edit', $item->id) }}"
                                           class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.kegiatan.destroy', $item->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin hapus kegiatan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="border px-4 py-4 text-center text-gray-500">
                                    Belum ada data kegiatan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $kegiatan->links() }}
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
