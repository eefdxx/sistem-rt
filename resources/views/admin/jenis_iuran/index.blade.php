<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Jenis Iuran</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="max-w-7xl mx-auto p-6">
        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold">Data Jenis Iuran</h1>
                    <p class="text-gray-500">Daftar master kategori iuran warga</p>
                </div>
                <a href="{{ route('admin.jenis-iuran.create') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Tambah Jenis
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
                            <th class="border px-4 py-2 text-left">Nama Iuran</th>
                            <th class="border px-4 py-2 text-left">Nominal Default</th>
                            <th class="border px-4 py-2 text-left">Periode</th>
                            <th class="border px-4 py-2 text-center">Status</th>
                            <th class="border px-4 py-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jenis_iuran as $item)
                            <tr>
                                <td class="border px-4 py-2">
                                    <div class="font-bold">{{ $item->nama_iuran }}</div>
                                    <div class="text-xs text-gray-500">{{ \Illuminate\Support\Str::limit($item->deskripsi, 50) }}</div>
                                </td>
                                <td class="border px-4 py-2">Rp {{ number_format($item->nominal_default, 0, ',', '.') }}</td>
                                <td class="border px-4 py-2 capitalize">{{ $item->periode }}</td>
                                <td class="border px-4 py-2 text-center">
                                    @if($item->is_active)
                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Aktif</span>
                                    @else
                                        <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded text-xs">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="border px-4 py-2 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('admin.jenis-iuran.edit', $item->id) }}"
                                           class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.jenis-iuran.destroy', $item->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Hapus jenis iuran ini? Catatan: data tagihan yang terhubung bisa bermasalah.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="border px-4 py-4 text-center text-gray-500">
                                    Belum ada data jenis iuran.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $jenis_iuran->links() }}
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
