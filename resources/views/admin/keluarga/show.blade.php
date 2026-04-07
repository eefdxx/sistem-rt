<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Keluarga</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="max-w-3xl mx-auto p-6">
        <div class="bg-white rounded-xl shadow p-6">
            <h1 class="text-2xl font-bold mb-6">Detail Keluarga</h1>

            <div class="space-y-3">
                <p><strong>No KK:</strong> {{ $keluarga->no_kk }}</p>
                <p><strong>Alamat:</strong> {{ $keluarga->alamat }}</p>
                <p><strong>RT:</strong> {{ $keluarga->rt ?? '-' }}</p>
                <p><strong>RW:</strong> {{ $keluarga->rw ?? '-' }}</p>
                <p><strong>Kode Pos:</strong> {{ $keluarga->kode_pos ?? '-' }}</p>
                <p><strong>Kepala Keluarga:</strong> {{ $keluarga->kepalaKeluarga->nama_lengkap ?? '-' }}</p>
            </div>

            <div class="mt-6">
                <a href="{{ route('admin.keluarga.index') }}"
                   class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</body>
</html>