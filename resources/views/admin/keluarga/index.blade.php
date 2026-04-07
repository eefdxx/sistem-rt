<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Keluarga</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="max-w-7xl mx-auto p-6">
        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold">Data Keluarga</h1>
                    <p class="text-gray-500">Daftar data keluarga</p>
                </div>
                <a href="{{ route('admin.keluarga.create') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Tambah Keluarga
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
                            <th class="border px-4 py-2 text-left">No KK</th>
                            <th class="border px-4 py-2 text-left">Alamat</th>
                            <th class="border px-4 py-2 text-left">RT</th>
                            <th class="border px-4 py-2 text-left">RW</th>
                            <th class="border px-4 py-2 text-left">Kode Pos</th>
                            <th class="border px-4 py-2 text-left">Kepala Keluarga</th>
                            <th class="border px-4 py-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($keluargas as $index => $keluarga)
                            <tr>
                                <td class="border px-4 py-2">
                                    {{ $keluargas->firstItem() + $index }}
                                </td>
                                <td class="border px-4 py-2">{{ $keluarga->no_kk }}</td>
                                <td class="border px-4 py-2">{{ $keluarga->alamat }}</td>
                                <td class="border px-4 py-2">{{ $keluarga->rt }}</td>
                                <td class="border px-4 py-2">{{ $keluarga->rw }}</td>
                                <td class="border px-4 py-2">{{ $keluarga->kode_pos }}</td>
                                <td class="border px-4 py-2">
                                    {{ $keluarga->kepalaKeluarga->nama_lengkap ?? '-' }}
                                </td>
                                <td class="border px-4 py-2 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('admin.keluarga.edit', $keluarga->id) }}"
                                           class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.keluarga.destroy', $keluarga->id) }}"
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
                                    Belum ada data keluarga.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $keluargas->links() }}
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