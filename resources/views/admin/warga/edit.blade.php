<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Warga</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="max-w-5xl mx-auto p-6">
        <div class="bg-white rounded-xl shadow p-6">
            <h1 class="text-2xl font-bold mb-6">Edit Data Warga</h1>

            <form action="{{ route('admin.warga.update', $warga->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1 font-medium">User Akun</label>
                        <select name="user_id" class="w-full border rounded-lg px-3 py-2">
                            <option value="">-- Pilih User (opsional) --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ old('user_id', $warga->user_id) == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} - {{ $user->email }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Keluarga</label>
                        <select name="keluarga_id" class="w-full border rounded-lg px-3 py-2">
                            <option value="">-- Pilih Keluarga --</option>
                            @foreach($keluargas as $keluarga)
                                <option value="{{ $keluarga->id }}"
                                    {{ old('keluarga_id', $warga->keluarga_id) == $keluarga->id ? 'selected' : '' }}>
                                    {{ $keluarga->no_kk }} - {{ $keluarga->alamat }}
                                </option>
                            @endforeach
                        </select>
                        @error('keluarga_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1 font-medium">NIK</label>
                        <input type="text" name="nik" value="{{ old('nik', $warga->nik) }}" class="w-full border rounded-lg px-3 py-2">
                        @error('nik')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $warga->nama_lengkap) }}" class="w-full border rounded-lg px-3 py-2">
                        @error('nama_lengkap')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block mb-1 font-medium">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="w-full border rounded-lg px-3 py-2">
                            <option value="">-- Pilih --</option>
                            <option value="L" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $warga->tempat_lahir) }}" class="w-full border rounded-lg px-3 py-2">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $warga->tanggal_lahir?->format('Y-m-d')) }}" class="w-full border rounded-lg px-3 py-2">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block mb-1 font-medium">Agama</label>
                        <input type="text" name="agama" value="{{ old('agama', $warga->agama) }}" class="w-full border rounded-lg px-3 py-2">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Status Perkawinan</label>
                        <input type="text" name="status_perkawinan" value="{{ old('status_perkawinan', $warga->status_perkawinan) }}" class="w-full border rounded-lg px-3 py-2">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Pekerjaan</label>
                        <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $warga->pekerjaan) }}" class="w-full border rounded-lg px-3 py-2">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block mb-1 font-medium">No HP</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp', $warga->no_hp) }}" class="w-full border rounded-lg px-3 py-2">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Email Pribadi</label>
                        <input type="email" name="email_pribadi" value="{{ old('email_pribadi', $warga->email_pribadi) }}" class="w-full border rounded-lg px-3 py-2">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk', $warga->tanggal_masuk?->format('Y-m-d')) }}" class="w-full border rounded-lg px-3 py-2">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1 font-medium">Status Keluarga</label>
                        <select name="status_keluarga" class="w-full border rounded-lg px-3 py-2">
                            <option value="">-- Pilih --</option>
                            <option value="kepala_keluarga" {{ old('status_keluarga', $warga->status_keluarga) == 'kepala_keluarga' ? 'selected' : '' }}>Kepala Keluarga</option>
                            <option value="istri" {{ old('status_keluarga', $warga->status_keluarga) == 'istri' ? 'selected' : '' }}>Istri</option>
                            <option value="anak" {{ old('status_keluarga', $warga->status_keluarga) == 'anak' ? 'selected' : '' }}>Anak</option>
                            <option value="anggota_lain" {{ old('status_keluarga', $warga->status_keluarga) == 'anggota_lain' ? 'selected' : '' }}>Anggota Lain</option>
                        </select>
                        @error('status_keluarga')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Status Warga</label>
                        <select name="status_warga" class="w-full border rounded-lg px-3 py-2">
                            <option value="">-- Pilih --</option>
                            <option value="tetap" {{ old('status_warga', $warga->status_warga) == 'tetap' ? 'selected' : '' }}>Tetap</option>
                            <option value="kontrak" {{ old('status_warga', $warga->status_warga) == 'kontrak' ? 'selected' : '' }}>Kontrak</option>
                            <option value="pindah" {{ old('status_warga', $warga->status_warga) == 'pindah' ? 'selected' : '' }}>Pindah</option>
                            <option value="tidak_aktif" {{ old('status_warga', $warga->status_warga) == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status_warga')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block mb-1 font-medium">Foto (path)</label>
                    <input type="text" name="foto" value="{{ old('foto', $warga->foto) }}" class="w-full border rounded-lg px-3 py-2">
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600">
                        Update
                    </button>
                    <a href="{{ route('admin.warga.index') }}"
                       class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>