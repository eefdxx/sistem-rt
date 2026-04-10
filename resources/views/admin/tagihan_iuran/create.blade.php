<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Tagihan Baru</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="max-w-3xl mx-auto p-6">
        <div class="bg-white rounded-xl shadow p-6">
            <h1 class="text-2xl font-bold mb-6">Buat Tagihan Iuran Tunggal</h1>
            <p class="text-sm text-gray-500 mb-6">Penagihan manual untuk satu warga tertentu.</p>

            @if($errors->any())
                <div class="mb-4 rounded-lg bg-red-100 text-red-800 px-4 py-3">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.tagihan-iuran.store') }}" method="POST" x-data="{ nominal: 0 }">
                @csrf

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Warga *</label>
                        <select name="warga_id" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">-- Pilih Warga --</option>
                            @foreach($warga as $wId)
                                <option value="{{ $wId->id }}" {{ old('warga_id') == $wId->id ? 'selected' : '' }}>
                                    {{ $wId->nama_lengkap }} ({{ $wId->nik }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Iuran *</label>
                        <select name="jenis_iuran_id" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                onchange="
                                    // Sederhana script set nilai (Bisa pakai alpine tapi kita JS murni sederhana buat MVP)
                                    let option = this.options[this.selectedIndex];
                                    let nom = option.getAttribute('data-nominal') || 0;
                                    document.getElementById('nominal').value = parseInt(nom);
                                ">
                            <option value="">-- Pilih Jenis --</option>
                            @foreach($jenis_iuran as $jIuran)
                                <option value="{{ $jIuran->id }}" data-nominal="{{ intval($jIuran->nominal_default) }}" {{ old('jenis_iuran_id') == $jIuran->id ? 'selected' : '' }}>
                                    {{ $jIuran->nama_iuran }} (Rp {{ number_format($jIuran->nominal_default, 0, ',', '.') }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nominal Akhir (Rp) *</label>
                        <input type="number" name="nominal" id="nominal" value="{{ old('nominal', 0) }}" min="0" required
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="Bisa dimodifikasi dari default">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Bulan *</label>
                            <select name="periode_bulan" required
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @foreach(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bulan)
                                    <option value="{{ $bulan }}" {{ old('periode_bulan', date('F') == date('F', strtotime($bulan)) ? $bulan : '') == $bulan ? 'selected' : '' }}>
                                        {{ $bulan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tahun *</label>
                            <input type="number" name="periode_tahun" value="{{ old('periode_tahun', date('Y')) }}" required
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jatuh Tempo</label>
                        <input type="date" name="jatuh_tempo" value="{{ old('jatuh_tempo') }}"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan Opsional</label>
                        <textarea name="keterangan" rows="2"
                                  class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('keterangan') }}</textarea>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <a href="{{ route('admin.tagihan-iuran.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan Tagihan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
