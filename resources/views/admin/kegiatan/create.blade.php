<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwalkan Kegiatan - Sistem RT</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 antialiased text-slate-800">
    <div class="min-h-screen">
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
                <a href="{{ route('admin.kegiatan.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-indigo-600 transition-colors uppercase tracking-widest mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Daftar
                </a>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Jadwalkan Kegiatan Baru</h1>
                <p class="text-slate-500 font-medium mt-1">Atur jadwal kegiatan warga agar terorganisir dengan baik.</p>
            </div>

            <form action="{{ route('admin.kegiatan.store') }}" method="POST" class="space-y-8">
                @csrf

                <div class="bg-white rounded-[2rem] border border-slate-200/60 shadow-xl shadow-slate-200/40 p-10">
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Nama Kegiatan</label>
                            <input type="text" name="nama_kegiatan" value="{{ old('nama_kegiatan') }}" required
                                   class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-indigo-500 transition-all font-bold text-lg tracking-tight"
                                   placeholder="Contoh: Rapat Rutin Bulanan RT 01">
                            @error('nama_kegiatan') <p class="text-rose-500 text-xs font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Lokasi Kegiatan</label>
                            <input type="text" name="lokasi" value="{{ old('lokasi') }}" required
                                   class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-indigo-500 transition-all font-medium"
                                   placeholder="Contoh: Balai Warga / Rumah Pak RT">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Tanggal Pelaksanaan</label>
                                <input type="date" name="tanggal_kegiatan" value="{{ old('tanggal_kegiatan') }}" required
                                       class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-indigo-500 transition-all font-medium">
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Jam Mulai</label>
                                <input type="time" name="jam_mulai" value="{{ old('jam_mulai') }}" required
                                       class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-indigo-500 transition-all font-medium">
                            </div>
                        </div>

                        <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Status Kegiatan</label>
                                <select name="status" required class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-indigo-500 transition-all font-bold appearance-none">
                                    <option value="mendatang">Mendatang</option>
                                    <option value="berjalan">Sedang Berjalan</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="batal">Dibatalkan</option>
                                </select>
                            </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Deskripsi & Agenda</label>
                            <textarea name="deskripsi" rows="6" required
                                      class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-indigo-500 transition-all font-medium"
                                      placeholder="Jelaskan poin-poin agenda kegiatan di sini...">{{ old('deskripsi') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 pb-12">
                    <a href="{{ route('admin.kegiatan.index') }}" class="px-8 py-4 rounded-2xl bg-white border border-slate-200 text-slate-600 font-bold hover:bg-slate-50 transition-all shadow-sm">
                        Batalkan
                    </a>
                    <button type="submit" class="px-10 py-4 rounded-2xl bg-indigo-600 text-white font-extrabold hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-600/20">
                        Jadwalkan Sekarang
                    </button>
                </div>
            </form>
        </main>
    </div>
</body>
</html>
