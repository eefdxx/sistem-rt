<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Warga - Sistem RT</title>
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
                <a href="{{ route('admin.warga.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-indigo-600 transition-colors uppercase tracking-widest mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Daftar
                </a>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Registrasi Warga Baru</h1>
                <p class="text-slate-500 font-medium mt-1">Lengkapi formulir di bawah untuk menambahkan warga baru ke dalam sistem.</p>
            </div>

            <form action="{{ route('admin.warga.store') }}" method="POST" class="space-y-8">
                @csrf

                <!-- Section: Informasi Identitas -->
                <div class="bg-white rounded-[2rem] border border-slate-200/60 shadow-xl shadow-slate-200/40 p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold">1</div>
                        <h2 class="text-xl font-bold text-slate-900">Informasi Identitas</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">NIK (Nomor Induk Kependudukan)</label>
                            <input type="text" name="nik" value="{{ old('nik') }}" required
                                   class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-indigo-500 transition-all font-medium"
                                   placeholder="Contoh: 327501XXXXXXXXXX">
                            @error('nik') <p class="text-rose-500 text-xs font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required
                                   class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-indigo-500 transition-all font-medium"
                                   placeholder="Nama sesuai KTP">
                            @error('nama_lengkap') <p class="text-rose-500 text-xs font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Jenis Kelamin</label>
                            <div class="grid grid-cols-2 gap-3">
                                <label class="relative flex items-center justify-center p-3.5 rounded-2xl bg-slate-50 ring-1 ring-slate-200 cursor-pointer hover:bg-white transition-all group">
                                    <input type="radio" name="jenis_kelamin" value="Laki-laki" class="sr-only" {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }}>
                                    <span class="text-sm font-bold text-slate-400 group-hover:text-indigo-600">Laki-laki</span>
                                </label>
                                <label class="relative flex items-center justify-center p-3.5 rounded-2xl bg-slate-50 ring-1 ring-slate-200 cursor-pointer hover:bg-white transition-all group">
                                    <input type="radio" name="jenis_kelamin" value="Perempuan" class="sr-only" {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }}>
                                    <span class="text-sm font-bold text-slate-400 group-hover:text-pink-600">Perempuan</span>
                                </label>
                            </div>
                            @error('jenis_kelamin') <p class="text-rose-500 text-xs font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Agama</label>
                            <select name="agama" class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-indigo-500 transition-all font-medium appearance-none">
                                <option value="">Pilih Agama</option>
                                @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Khonghucu'] as $agama)
                                    <option value="{{ $agama }}" {{ old('agama') == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Section: Afiliasi Keluarga -->
                <div class="bg-white rounded-[2rem] border border-slate-200/60 shadow-xl shadow-slate-200/40 p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">2</div>
                        <h2 class="text-xl font-bold text-slate-900">Afiliasi Keluarga</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2 md:col-span-2">
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Pilih Kartu Keluarga (KK)</label>
                            <select name="keluarga_id" required class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-indigo-500 transition-all font-medium appearance-none">
                                <option value="">Pilih No KK</option>
                                @foreach($keluargas as $keluarga)
                                    <option value="{{ $keluarga->id }}" {{ old('keluarga_id') == $keluarga->id ? 'selected' : '' }}>
                                        {{ $keluarga->no_kk }}
                                    </option>
                                @endforeach
                            </select>
                            @error('keluarga_id') <p class="text-rose-500 text-xs font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Status Hubungan</label>
                            <select name="status_keluarga" required class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-indigo-500 transition-all font-medium appearance-none">
                                <option value="">Pilih Status</option>
                                <option value="kepala_keluarga" {{ old('status_keluarga') == 'kepala_keluarga' ? 'selected' : '' }}>Kepala Keluarga</option>
                                <option value="istri" {{ old('status_keluarga') == 'istri' ? 'selected' : '' }}>Istri</option>
                                <option value="anak" {{ old('status_keluarga') == 'anak' ? 'selected' : '' }}>Anak</option>
                                <option value="anggota_lain" {{ old('status_keluarga') == 'anggota_lain' ? 'selected' : '' }}>Anggota Lain</option>
                            </select>
                            @error('status_keluarga') <p class="text-rose-500 text-xs font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Status Domisili</label>
                            <select name="status_warga" required class="w-full px-5 py-3.5 rounded-2xl bg-slate-50 border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-indigo-500 transition-all font-medium appearance-none">
                                <option value="warga_tetap" {{ old('status_warga') == 'warga_tetap' ? 'selected' : '' }}>Warga Tetap</option>
                                <option value="kontrak" {{ old('status_warga') == 'kontrak' ? 'selected' : '' }}>Kontrak / Kos</option>
                                <option value="pindah" {{ old('status_warga') == 'pindah' ? 'selected' : '' }}>Pindah</option>
                            </select>
                            @error('status_warga') <p class="text-rose-500 text-xs font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="flex items-center justify-end gap-4 pb-10">
                    <a href="{{ route('admin.warga.index') }}" class="px-8 py-4 rounded-2xl bg-white border border-slate-200 text-slate-600 font-bold hover:bg-slate-50 transition-all shadow-sm">
                        Batalkan
                    </a>
                    <button type="submit" class="px-10 py-4 rounded-2xl bg-indigo-600 text-white font-extrabold hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-600/20">
                        Simpan Data Warga
                    </button>
                </div>
            </form>
        </main>
    </div>

    <script>
        // Simple Radio UI Enhancement
        document.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelectorAll('input[name="'+this.name+'"]').forEach(r => {
                    r.parentElement.classList.remove('ring-indigo-600', 'bg-indigo-50', 'ring-2');
                    r.parentElement.querySelector('span').classList.remove('text-indigo-600', 'text-pink-600');
                });
                if(this.checked) {
                    this.parentElement.classList.add('ring-2', 'bg-white');
                    const colorClass = this.value === 'Perempuan' ? 'text-pink-600' : 'text-indigo-600';
                    const ringClass = this.value === 'Perempuan' ? 'ring-pink-500' : 'ring-indigo-500';
                    this.parentElement.classList.add(ringClass);
                    this.parentElement.querySelector('span').classList.add(colorClass);
                }
            });
        });
    </script>
</body>
</html>