<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Warga</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="max-w-7xl mx-auto p-6">
        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold">Data Warga</h1>
                    <p class="text-gray-500">Daftar data warga</p>
                </div>
                <a href="{{ route('admin.warga.create') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Tambah Warga
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
                            <th class="border px-4 py-2 text-left">NIK</th>
                            <th class="border px-4 py-2 text-left">Nama</th>
                            <th class="border px-4 py-2 text-left">JK</th>
                            <th class="border px-4 py-2 text-left">Keluarga</th>
                            <th class="border px-4 py-2 text-left">Status Keluarga</th>
                            <th class="border px-4 py-2 text-left">Status Warga</th>
                            <th class="border px-4 py-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($wargas as $index => $warga)
                            <tr>
                                <td class="border px-4 py-2">{{ $wargas->firstItem() + $index }}</td>
                                <td class="border px-4 py-2">{{ $warga->nik }}</td>
                                <td class="border px-4 py-2">{{ $warga->nama_lengkap }}</td>
                                <td class="border px-4 py-2">{{ $warga->jenis_kelamin }}</td>
                                <td class="border px-4 py-2">{{ $warga->keluarga->no_kk ?? '-' }}</td>
                                <td class="border px-4 py-2">{{ $warga->status_keluarga }}</td>
                                <td class="border px-4 py-2">{{ $warga->status_warga }}</td>
                                <td class="border px-4 py-2 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('admin.warga.show', $warga->id) }}"
                                           class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                            Detail
                                        </a>
                                        <a href="{{ route('admin.warga.edit', $warga->id) }}"
                                           class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.warga.destroy', $warga->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
                                <td colspan="8" class="border px-4 py-4 text-center text-gray-500">
                                    Belum ada data warga.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $wargas->links() }}
            </div>

            <div class="mt-6 flex gap-4">
                <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline">
                    Kembali ke Dashboard
                </a>
                <a href="{{ route('admin.keluarga.index') }}" class="text-blue-600 hover:underline">
                    Kelola Keluarga
                </a>
            </div>
        </div>
    </div>
</body>
</html>