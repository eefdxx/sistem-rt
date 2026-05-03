<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Laporan Masalah - Portal Warga</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>body { font-family: 'Outfit', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">
<div class="min-h-screen">

    <nav class="bg-white sticky top-0 z-50 border-b border-slate-100 shadow-sm">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('warga.laporan.index') }}" class="flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-orange-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali
                </a>
                <span class="text-sm font-bold text-slate-400">Portal Warga</span>
            </div>
        </div>
    </nav>

    <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <div class="mb-8">
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Buat Laporan Masalah</h1>
            <p class="text-slate-500 text-sm mt-1">Sampaikan masalah atau keluhan di lingkungan RT Anda kepada pengurus.</p>
        </div>

        <div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/40 p-8">
            <form action="{{ route('warga.laporan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    {{-- Kategori --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Kategori Masalah <span class="text-rose-500">*</span></label>
                        <select name="kategori_laporan_id" required
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('kategori_laporan_id') border-rose-400 @enderror">
                            <option value="">— Pilih Kategori —</option>
                            @foreach($kategoris as $kat)
                            <option value="{{ $kat->id }}" {{ old('kategori_laporan_id') == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama_kategori }}
                            </option>
                            @endforeach
                        </select>
                        @error('kategori_laporan_id')<p class="text-rose-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Prioritas --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Tingkat Prioritas <span class="text-rose-500">*</span></label>
                        <select name="prioritas" required
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('prioritas') border-rose-400 @enderror">
                            <option value="">— Pilih Prioritas —</option>
                            <option value="rendah" {{ old('prioritas') === 'rendah' ? 'selected' : '' }}>🟢 Rendah — Tidak mendesak</option>
                            <option value="sedang" {{ old('prioritas') === 'sedang' ? 'selected' : '' }}>🟡 Sedang — Perlu ditangani</option>
                            <option value="tinggi" {{ old('prioritas') === 'tinggi' ? 'selected' : '' }}>🔴 Tinggi — Mendesak / Darurat</option>
                        </select>
                        @error('prioritas')<p class="text-rose-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- Judul --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Judul Laporan <span class="text-rose-500">*</span></label>
                    <input type="text" name="judul" value="{{ old('judul') }}" required
                        placeholder="Contoh: Lampu jalan RT 03 mati sudah 3 hari"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('judul') border-rose-400 @enderror">
                    @error('judul')<p class="text-rose-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Lokasi --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Lokasi Kejadian</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi') }}"
                        placeholder="Contoh: Depan Gang No. 5, RT 03"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi Lengkap <span class="text-rose-500">*</span></label>
                    <textarea name="deskripsi" rows="5" required
                        placeholder="Jelaskan masalah secara detail: kapan terjadi, dampaknya, dan harapan Anda..."
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent resize-none @error('deskripsi') border-rose-400 @enderror">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')<p class="text-rose-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Lampiran Foto --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Foto Lampiran <span class="text-slate-400 font-medium">(opsional)</span></label>
                    <input type="file" name="lampiran" accept="image/*"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-800 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                    <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG, WEBP. Maks. 3MB. Upload foto yang relevan untuk mempercepat penanganan.</p>
                    @error('lampiran')<p class="text-rose-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="pt-2 flex gap-3">
                    <a href="{{ route('warga.laporan.index') }}"
                       class="flex-1 text-center py-3.5 rounded-2xl bg-slate-100 text-slate-600 font-bold text-sm hover:bg-slate-200 transition-all">
                        Batal
                    </a>
                    <button type="submit"
                        class="flex-1 py-3.5 rounded-2xl bg-orange-500 text-white font-black text-sm hover:bg-orange-600 transition-all shadow-lg shadow-orange-500/20">
                        Kirim Laporan
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>
</body>
</html>
