<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan - Sistem RT</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 antialiased text-slate-800">
<div class="min-h-screen">

    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-200/60 shadow-sm">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('admin.pengaduan.index') }}" class="flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-indigo-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Semua Pengaduan
                </a>
                <span class="text-sm font-bold text-slate-400">Admin Panel</span>
            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-6">

        {{-- Flash --}}
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl font-semibold text-sm">✅ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-rose-50 border border-rose-200 text-rose-800 px-5 py-4 rounded-2xl font-semibold text-sm">❌ {{ session('error') }}</div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Kolom Kiri: Detail Laporan --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-3xl border border-slate-200/60 shadow-xl p-8">
                    <div class="flex items-start justify-between gap-4 mb-5">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1.5">
                                <span class="text-xs font-black uppercase tracking-widest text-slate-400">{{ $laporan->kategori->nama_kategori ?? '-' }}</span>
                            </div>
                            <h1 class="text-xl font-extrabold text-slate-900">{{ $laporan->judul }}</h1>
                            <p class="text-xs text-slate-400 mt-1">
                                Dilaporkan oleh <strong>{{ $laporan->warga->nama_lengkap }}</strong>
                                · {{ $laporan->tanggal_laporan->format('d M Y, H:i') }}
                            </p>
                        </div>
                        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest flex-shrink-0
                            {{ $laporan->status === 'selesai' ? 'bg-emerald-100 text-emerald-700' :
                               ($laporan->status === 'diproses' ? 'bg-blue-100 text-blue-700' :
                               ($laporan->status === 'ditolak' ? 'bg-rose-100 text-rose-700' : 'bg-amber-100 text-amber-700')) }}">
                            {{ $laporan->status }}
                        </span>
                    </div>

                    @if($laporan->lokasi)
                    <div class="flex items-center gap-2 text-sm text-slate-500 mb-4 bg-slate-50 rounded-xl px-4 py-2">
                        <svg class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span class="font-semibold">{{ $laporan->lokasi }}</span>
                    </div>
                    @endif

                    <div class="bg-slate-50 rounded-2xl p-5 mb-5">
                        <p class="text-sm text-slate-700 leading-relaxed whitespace-pre-line">{{ $laporan->deskripsi }}</p>
                    </div>

                    @if($laporan->lampiran)
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Foto Lampiran</p>
                        <a href="{{ Storage::url($laporan->lampiran) }}" target="_blank">
                            <img src="{{ Storage::url($laporan->lampiran) }}" alt="Lampiran" class="rounded-2xl max-h-72 object-cover border border-slate-200 hover:opacity-90 transition-opacity">
                        </a>
                    </div>
                    @endif
                </div>

                {{-- Riwayat Tanggapan --}}
                <div class="bg-white rounded-3xl border border-slate-200/60 shadow-xl p-8">
                    <h2 class="text-base font-extrabold text-slate-900 mb-5">Riwayat Tanggapan</h2>

                    @forelse($laporan->tanggapan as $tang)
                    <div class="flex items-start gap-3 mb-4 last:mb-0">
                        <div class="w-9 h-9 bg-indigo-100 rounded-full flex items-center justify-center flex-shrink-0 text-indigo-700 font-black text-sm">
                            {{ strtoupper(substr($tang->user->name, 0, 1)) }}
                        </div>
                        <div class="flex-1 bg-indigo-50 rounded-2xl rounded-tl-none p-4">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-xs font-black text-indigo-700">{{ $tang->user->name }}</span>
                                <span class="text-xs text-slate-400">{{ $tang->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm text-slate-700">{{ $tang->isi_tanggapan }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-slate-400 text-sm text-center py-4">Belum ada tanggapan.</p>
                    @endforelse

                    {{-- Form Tanggapi --}}
                    <div class="mt-5 pt-5 border-t border-slate-100">
                        <form action="{{ route('admin.pengaduan.tanggapi', $laporan->id) }}" method="POST" class="space-y-3">
                            @csrf
                            <textarea name="isi_tanggapan" rows="3" required
                                placeholder="Tulis tanggapan atau tindak lanjut untuk warga..."
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-none @error('isi_tanggapan') border-rose-400 @enderror"></textarea>
                            @error('isi_tanggapan')<p class="text-rose-500 text-xs font-bold">{{ $message }}</p>@enderror
                            <button type="submit" class="px-6 py-2.5 rounded-xl bg-indigo-600 text-white font-bold text-sm hover:bg-indigo-700 transition-all">
                                Kirim Tanggapan
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Info Warga + Update Status --}}
            <div class="space-y-5">
                {{-- Info Warga --}}
                <div class="bg-white rounded-3xl border border-slate-200/60 shadow-xl p-6">
                    <h2 class="text-sm font-extrabold text-slate-900 mb-4">Informasi Pelapor</h2>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-slate-400 font-medium">Nama</span>
                            <span class="font-bold text-slate-800">{{ $laporan->warga->nama_lengkap }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400 font-medium">No. HP</span>
                            <span class="font-bold text-slate-800">{{ $laporan->warga->no_hp ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400 font-medium">No. KK</span>
                            <span class="font-bold text-slate-800 font-mono text-xs">{{ $laporan->warga->keluarga->no_kk ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                {{-- Update Status --}}
                <div class="bg-white rounded-3xl border border-slate-200/60 shadow-xl p-6">
                    <h2 class="text-sm font-extrabold text-slate-900 mb-4">Perbarui Status</h2>
                    <form action="{{ route('admin.pengaduan.status', $laporan->id) }}" method="POST" class="space-y-3">
                        @csrf
                        <select name="status" required
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="menunggu" {{ $laporan->status === 'menunggu' ? 'selected' : '' }}>🟡 Menunggu</option>
                            <option value="diproses" {{ $laporan->status === 'diproses' ? 'selected' : '' }}>🔵 Diproses</option>
                            <option value="selesai" {{ $laporan->status === 'selesai' ? 'selected' : '' }}>🟢 Selesai</option>
                            <option value="ditolak" {{ $laporan->status === 'ditolak' ? 'selected' : '' }}>🔴 Ditolak</option>
                        </select>
                        <button type="submit" class="w-full py-2.5 rounded-xl bg-indigo-600 text-white font-bold text-sm hover:bg-indigo-700 transition-all">
                            Update Status
                        </button>
                    </form>
                </div>

                {{-- Meta Laporan --}}
                <div class="bg-slate-50 rounded-3xl border border-slate-100 p-6 text-sm space-y-2">
                    <div class="flex justify-between">
                        <span class="text-slate-400">Prioritas</span>
                        <span class="font-bold capitalize
                            {{ $laporan->prioritas === 'tinggi' ? 'text-rose-600' : ($laporan->prioritas === 'sedang' ? 'text-amber-600' : 'text-slate-600') }}">
                            {{ $laporan->prioritas }}
                        </span>
                    </div>
                    @if($laporan->peninjau)
                    <div class="flex justify-between">
                        <span class="text-slate-400">Peninjau</span>
                        <span class="font-bold text-slate-800 text-xs">{{ $laporan->peninjau->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Ditinjau</span>
                        <span class="font-bold text-slate-800 text-xs">{{ $laporan->tanggal_ditinjau->format('d M Y') }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

    </main>
</div>
</body>
</html>
