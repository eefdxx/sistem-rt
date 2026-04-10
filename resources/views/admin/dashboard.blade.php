<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen p-6">
        <div class="max-w-5xl mx-auto">
            <div class="bg-white shadow rounded-xl p-6">
                <h1 class="text-2xl font-bold mb-2">Dashboard Admin</h1>
                <p class="text-gray-600 mb-6">
                    Selamat datang, {{ auth()->user()->name }}
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-blue-100 p-4 rounded-lg">
                        <h2 class="font-semibold text-blue-800">Total Warga</h2>
                        <p class="text-2xl font-bold mt-2">0</p>
                    </div>

                    <div class="bg-green-100 p-4 rounded-lg">
                        <h2 class="font-semibold text-green-800">Total Keluarga</h2>
                        <p class="text-2xl font-bold mt-2">0</p>
                    </div>

                    <div class="bg-red-100 p-4 rounded-lg">
                        <h2 class="font-semibold text-red-800">Laporan Aktif</h2>
                        <p class="text-2xl font-bold mt-2">0</p>
                    </div>
                </div>

                <div class="mt-6 flex gap-3 flex-wrap">
                    <a href="{{ route('admin.keluarga.index') }}"
                       class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Kelola Keluarga
                    </a>

                    <a href="{{ route('admin.warga.index') }}"
                       class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Kelola Warga
                    </a>
                    
                    <a href="{{ route('admin.pengumuman.index') }}"
                       class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                        Kelola Pengumuman
                    </a>

                    <a href="{{ route('admin.kegiatan.index') }}"
                       class="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700">
                        Kelola Kegiatan
                    </a>

                    <a href="{{ route('admin.jenis-iuran.index') }}"
                       class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700">
                        Master Iuran
                    </a>

                    <a href="{{ route('admin.tagihan-iuran.index') }}"
                       class="px-4 py-2 bg-cyan-600 text-white rounded-lg hover:bg-cyan-700">
                        Kelola Tagihan
                    </a>

                    <a href="{{ route('admin.laporan.index') }}"
                       class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 font-bold shadow-md">
                        Statistik Laporan
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>