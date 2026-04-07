<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Warga</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto p-6">
        <div class="bg-white rounded-xl shadow p-6">
            <h1 class="text-2xl font-bold mb-6">Detail Warga</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <p><strong>NIK:</strong> {{ $warga->nik }}</p>
                <p><strong>Nama:</strong> {{ $warga->nama_lengkap }}</p>
                <p><strong>Jenis Kelamin:</strong> {{ $warga->jenis_kelamin }}</p>
                <p><strong>Tempat Lahir:</strong> {{ $warga->tempat_lahir ?? '-' }}</p>
                <p><strong>Tanggal Lahir:</strong> {{ $warga->tanggal_lahir?->format('d-m-Y') ?? '-' }}</p>
                <p><strong>Agama:</strong> {{ $warga->agama ?? '-' }}</p>
                <p><strong>Status Perkawinan:</strong> {{ $warga->status_perkawinan ?? '-' }}</p>
                <p><strong>Pekerjaan:</strong> {{ $warga->pekerjaan ?? '-' }}</p>
                <p><strong>No HP:</strong> {{ $warga->no_hp ?? '-' }}</p>
                <p><strong>Email Pribadi:</strong> {{ $warga->email_pribadi ?? '-' }}</p>
                <p><strong>Status Keluarga:</strong> {{ $warga->status_keluarga }}</p>
                <p><strong>Status Warga:</strong> {{ $warga->status_warga }}</p>
                <p><strong>Tanggal Masuk:</strong> {{ $warga->tanggal_masuk?->format('d-m-Y') ?? '-' }}</p>
                <p><strong>No KK:</strong> {{ $warga->keluarga->no_kk ?? '-' }}</p>
                <p><strong>User Akun:</strong> {{ $warga->user->email ?? '-' }}</p>
            </div>

            <div class="mt-6">
                <a href="{{ route('admin.warga.index') }}"
                   class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</body>
</html>