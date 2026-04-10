<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Warga</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen p-6">
        <div class="max-w-5xl mx-auto">
            <div class="bg-white shadow rounded-xl p-6">
                <h1 class="text-2xl font-bold mb-2">Dashboard Warga</h1>
                <p class="text-gray-600 mb-6">
                    Selamat datang, {{ auth()->user()->name }}
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-indigo-100 p-4 rounded-lg">
                        <h2 class="font-semibold text-indigo-800">Pengumuman Terbaru</h2>
                        <p class="text-sm mt-2 text-indigo-900">
                            Masuk untuk melihat pengumuman RT.
                        </p>
                    </div>

                    <div class="bg-green-100 p-4 rounded-lg">
                        <h2 class="font-semibold text-green-800">Kegiatan Mendatang</h2>
                        <p class="text-sm mt-2 text-green-900">
                            Fitur dalam pengembangan.
                        </p>
                    </div>
                </div>

                <div class="mt-6 flex gap-3 flex-wrap">
                    <a href="{{ route('warga.pengumuman.index') }}"
                       class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                        Lihat Pengumuman
                    </a>

                    <a href="{{ route('kegiatan.index') }}"
                       class="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700">
                        Lihat Kegiatan
                    </a>

                    <a href="{{ route('iuran.index') }}"
                       class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700">
                        Iuran Saya
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
