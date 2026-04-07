<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Keluarga</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="max-w-3xl mx-auto p-6">
        <div class="bg-white rounded-xl shadow p-6">
            <h1 class="text-2xl font-bold mb-6">Tambah Data Keluarga</h1>

            <form action="{{ route('admin.keluarga.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block mb-1 font-medium">No KK</label>
                    <input type="number" name="no_kk" value="{{ old('no_kk') }}"
                           class="w-full border rounded-lg px-3 py-2">
                    @error('no_kk')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-medium">Alamat</label>
                    <textarea name="alamat" rows="4"
                              class="w-full border rounded-lg px-3 py-2">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block mb-1 font-medium">RT</label>
                        <input type="number" name="rt" value="{{ old('rt') }}"
                               class="w-full border rounded-lg px-3 py-2">
                        @error('rt')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">RW</label>
                        <input type="number" name="rw" value="{{ old('rw') }}"
                               class="w-full border rounded-lg px-3 py-2">
                        @error('rw')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Kode Pos</label>
                        <input type="number" name="kode_pos" value="{{ old('kode_pos') }}"
                               class="w-full border rounded-lg px-3 py-2">
                        @error('kode_pos')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block mb-1 font-medium">Kepala Keluarga</label>
                    <select name="kepala_keluarga_id" class="w-full border rounded-lg px-3 py-2">
                        <option value="">-- Pilih Kepala Keluarga --</option>
                        @foreach($wargas as $warga)
                            <option value="{{ $warga->id }}"
                                {{ old('kepala_keluarga_id') == $warga->id ? 'selected' : '' }}>
                                {{ $warga->nama_lengkap }}
                            </option>
                        @endforeach
                    </select>
                    @error('kepala_keluarga_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        Simpan
                    </button>
                    <a href="{{ route('admin.keluarga.index') }}"
                       class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
