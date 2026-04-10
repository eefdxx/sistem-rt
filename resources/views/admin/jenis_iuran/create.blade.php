<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jenis Iuran</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="max-w-2xl mx-auto p-6">
        <div class="bg-white rounded-xl shadow p-6">
            <h1 class="text-2xl font-bold mb-6">Tambah Jenis Iuran</h1>

            @if($errors->any())
                <div class="mb-4 rounded-lg bg-red-100 text-red-800 px-4 py-3">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.jenis-iuran.store') }}" method="POST">
                @csrf

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Iuran *</label>
                        <input type="text" name="nama_iuran" value="{{ old('nama_iuran') }}" required
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="Contoh: Uang Kas, Uang Kebersihan">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="deskripsi" rows="3"
                                  class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('deskripsi') }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nominal Default (Rp) *</label>
                            <input type="number" name="nominal_default" value="{{ old('nominal_default', 0) }}" min="0" required
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Periode *</label>
                            <select name="periode" required
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="bulanan" {{ old('periode') == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                                <option value="tahunan" {{ old('periode') == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                                <option value="insidental" {{ old('periode') == 'insidental' ? 'selected' : '' }}>Insidental / Sekali Bayar</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 mt-4">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                        <label for="is_active" class="text-sm text-gray-700">Aktif (Tersedia untuk ditagihkan)</label>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <a href="{{ route('admin.jenis-iuran.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
