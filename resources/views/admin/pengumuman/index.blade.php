<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengumuman</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="max-w-7xl mx-auto p-6">
        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold">Data Pengumuman</h1>
                    <p class="text-gray-500">Daftar pengumuman RT</p>
                </div>
                <a href="{{ route('admin.pengumuman.create') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Tambah Pengumuman
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 rounded-lg bg-green-100 text-green-800 px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="w-full border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2 text-left">No</th>
                            <th class="border px-4 py-2 text-left">Judul</th>
                            <th class="border px-4 py-2 text-left">Kategori</th>
                            <th class="border px-4 py-2 text-left">Status</th>
                            <th class="border px-4 py-2 text-left">Tgl Publish</th>
                            <th class="border px-4 py-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengumuman as $index => $item)
                            <tr>
                                <td class="border px-4 py-2">
                                    {{ $pengumuman->firstItem() + $index }}
                                </td>
                                <td class="border px-4 py-2">{{ $item->judul }}</td>
                                <td class="border px-4 py-2">{{ $item->kategori ?? '-' }}</td>
                                <td class="border px-4 py-2">
                                    @if($item->status == 'publish')
                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">Publish</span>
                                    @else
                                        <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-sm">Draft</span>
                                    @endif
                                </td>
                                <td class="border px-4 py-2">
                                    {{ $item->tanggal_publish ? $item->tanggal_publish->format('d/m/Y H:i') : '-' }}
                                </td>
                                <td class="border px-4 py-2 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('admin.pengumuman.show', $item->id) }}"
                                           class="bg-indigo-500 text-white px-3 py-1 rounded hover:bg-indigo-600">
                                            Detail
                                        </a>
                                        <a href="{{ route('admin.pengumuman.edit', $item->id) }}"
                                           class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.pengumuman.destroy', $item->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="border px-4 py-4 text-center text-gray-500">
                                    Belum ada data pengumuman.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $pengumuman->links() }}
            </div>

            <div class="mt-6">
                <a href="{{ route('admin.dashboard') }}"
                   class="text-blue-600 hover:underline">
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</body>
</html>
