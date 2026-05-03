<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jenis Iuran - Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 antialiased text-slate-800">
<div class="min-h-screen">

    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-200/60 shadow-sm">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('admin.jenis-iuran.index') }}" class="flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-indigo-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali
                </a>
                <span class="text-sm font-bold text-slate-400">Admin Panel</span>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Tambah Jenis Iuran</h1>
            <p class="text-slate-500 text-sm mt-1">Buat kategori/jenis iuran baru untuk diterapkan ke tagihan warga.</p>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200/60 shadow-xl p-8">
            <form action="{{ route('admin.jenis-iuran.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Nama Iuran --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Iuran <span class="text-rose-500">*</span></label>
                        <input type="text" name="nama_iuran" value="{{ old('nama_iuran') }}" required
                            placeholder="Contoh: Iuran Keamanan Bulanan"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('nama_iuran') border-rose-400 @enderror">
                        @error('nama_iuran')<p class="text-rose-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Nominal Default --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nominal Default (Rp) <span class="text-rose-500">*</span></label>
                        <input type="number" name="nominal_default" value="{{ old('nominal_default') }}" required min="0" step="1000"
                            placeholder="Contoh: 50000"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('nominal_default') border-rose-400 @enderror">
                        @error('nominal_default')<p class="text-rose-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Periode --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Periode Tagihan <span class="text-rose-500">*</span></label>
                        <select name="periode" required
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('periode') border-rose-400 @enderror">
                            <option value="bulanan" {{ old('periode') === 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                            <option value="tahunan" {{ old('periode') === 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                            <option value="insidental" {{ old('periode') === 'insidental' ? 'selected' : '' }}>Insidental (Sewaktu-waktu)</option>
                        </select>
                        @error('periode')<p class="text-rose-500 text-xs font-bold mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi (Opsional)</label>
                        <textarea name="deskripsi" rows="3"
                            placeholder="Keterangan mengenai jenis iuran ini..."
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-none">{{ old('deskripsi') }}</textarea>
                    </div>

                    {{-- Status Aktif --}}
                    <div class="md:col-span-2 flex items-center gap-3 bg-slate-50 border border-slate-200 rounded-2xl p-4">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" id="is_active" checked
                            class="w-5 h-5 text-indigo-600 rounded-md border-slate-300 focus:ring-indigo-500">
                        <label for="is_active" class="text-sm font-bold text-slate-700 cursor-pointer">Aktifkan Iuran Ini</label>
                    </div>
                </div>

                <div class="pt-6 flex gap-3">
                    <a href="{{ route('admin.jenis-iuran.index') }}" class="flex-1 text-center py-3.5 rounded-2xl bg-slate-100 text-slate-600 font-bold text-sm hover:bg-slate-200 transition-all">Batal</a>
                    <button type="submit" class="flex-1 py-3.5 rounded-2xl bg-indigo-600 text-white font-black text-sm hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-600/20">Simpan Jenis Iuran</button>
                </div>
            </form>
        </div>
    </main>
</div>
</body>
</html>
