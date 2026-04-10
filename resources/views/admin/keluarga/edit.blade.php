<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifikasi KK - {{ $keluarga->no_kk }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 antialiased text-slate-800 selection:bg-indigo-500 selection:text-white">
    <div class="min-h-screen">
        <!-- Navbar -->
        <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-200/60 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                            <div class="bg-gradient-to-br from-indigo-600 to-violet-600 text-white p-2.5 rounded-xl shadow-lg shadow-indigo-600/20 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                            <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-slate-900 to-slate-700 tracking-tight">Sistem RT</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="mb-8">
                <a href="{{ route('admin.keluarga.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-indigo-600 transition-colors uppercase tracking-widest mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Daftar
                </a>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Modifikasi Kartu Keluarga</h1>
                <p class="text-slate-500 font-medium mt-1">Perbarui data administrasi untuk keluarga dengan nomor <span class="text-indigo-600 font-bold">{{ $keluarga->no_kk }}</span>.</p>
            </div>

            <form action="{{ route('admin.keluarga.update', $keluarga->id) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Section: Informasi Utama KK -->
                <div class="bg-white rounded-[2rem] border border-slate-200/60 shadow-xl shadow-slate-200/40 p-10 transition-all hover:shadow-2xl">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold">1</div>
                        <h2 class="text-xl font-bold text-slate-900">Data Administrasi KK</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2 md:col-span-2">
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Nomor Kartu Keluarga</label>
                            <input type="text" name="no_kk" value="{{ old('no_kk', $keluarga->no_kk) }}" required
                                   class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-indigo-500 transition-all font-bold text-lg tracking-tight">
                            @error('no_kk') <p class="text-rose-500 text-xs font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-2 md:col-span-2">
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Alamat Lengkap</label>
                            <textarea name="alamat" rows="3" required
                                      class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-indigo-500 transition-all font-medium">{{ old('alamat', $keluarga->alamat) }}</textarea>
                            @error('alamat') <p class="text-rose-500 text-xs font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">RT / RW</label>
                            <div class="flex items-center gap-3">
                                <input type="text" name="rt" value="{{ old('rt', $keluarga->rt) }}" required placeholder="RT"
                                       class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-indigo-500 transition-all font-bold text-center">
                                <span class="text-slate-300">/</span>
                                <input type="text" name="rw" value="{{ old('rw', $keluarga->rw) }}" required placeholder="RW"
                                       class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-indigo-500 transition-all font-bold text-center">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Kode Pos</label>
                            <input type="text" name="kode_pos" value="{{ old('kode_pos', $keluarga->kode_pos) }}" required
                                   class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-indigo-500 transition-all font-bold">
                        </div>
                    </div>
                </div>

                <!-- Section: Kepala Keluarga -->
                <div class="bg-white rounded-[2rem] border border-slate-200/60 shadow-xl shadow-slate-200/40 p-10 transition-all hover:shadow-2xl">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold">2</div>
                        <h2 class="text-xl font-bold text-slate-900">Penentuan Kepala Keluarga</h2>
                    </div>

                    <div class="space-y-4">
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Pilih Kepala Keluarga</label>
                        <select name="kepala_keluarga_id" class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-indigo-500 transition-all font-bold appearance-none">
                            <option value="">-- Tidak ditentukan --</option>
                            @foreach($wargas as $warga)
                                <option value="{{ $warga->id }}" {{ old('kepala_keluarga_id', $keluarga->kepala_keluarga_id) == $warga->id ? 'selected' : '' }}>
                                    {{ $warga->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-[11px] text-slate-400 font-medium ml-1">
                             <svg class="w-3.5 h-3.5 inline mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                             Anda dapat mengubah Kepala Keluarga kapan saja menyesuaikan mutasi anggota.
                        </p>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="flex items-center justify-end gap-4 pb-12">
                    <a href="{{ route('admin.keluarga.index') }}" class="px-8 py-4 rounded-2xl bg-white border border-slate-200 text-slate-600 font-bold hover:bg-slate-50 transition-all shadow-sm">
                        Batalkan
                    </a>
                    <button type="submit" class="px-10 py-4 rounded-2xl bg-amber-500 text-white font-extrabold hover:bg-amber-600 transition-all shadow-xl shadow-amber-500/20">
                        Perbarui Data Keluarga
                    </button>
                </div>
            </form>
        </main>
    </div>
</body>
</html>