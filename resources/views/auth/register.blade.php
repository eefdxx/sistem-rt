<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Warga Baru - Sistem RT</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .bg-illustration {
            background-image: url("/assets/images/neighborhood_register_bg_1775788806154.png");
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-slate-50 antialiased overflow-hidden">
    <div class="h-screen flex flex-col md:flex-row">
        
        <!-- Left Section: Community Illustration -->
        <div class="hidden md:flex md:w-3/5 lg:w-4/6 relative bg-gradient-to-br from-indigo-700 via-indigo-900 to-slate-900 overflow-hidden">
            <!-- Background Image overlay -->
            <div class="absolute inset-0 bg-illustration opacity-50 mix-blend-overlay scale-110 hover:scale-100 transition-transform duration-[12s] ease-in-out"></div>
            
            <!-- Floating Elements / Glows -->
            <div class="absolute top-[20%] right-[-5%] w-80 h-80 bg-blue-500 rounded-full blur-[100px] opacity-20"></div>
            <div class="absolute bottom-[10%] left-[10%] w-[400px] h-[400px] bg-indigo-500 rounded-full blur-[130px] opacity-20 animate-pulse"></div>

            <div class="relative z-10 p-20 flex flex-col justify-between h-full w-full">
                <div class="flex items-center gap-4">
                    <a href="/" class="flex items-center gap-4 group">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-xl rounded-2xl flex items-center justify-center border border-white/30 shadow-2xl transition-transform group-hover:scale-110">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        </div>
                        <span class="text-2xl font-black text-white tracking-widest uppercase">SISTEM RT.</span>
                    </a>
                </div>

                <div class="max-w-2xl">
                    <h2 class="text-6xl font-black text-white leading-[1.1] mb-8 tracking-tighter">Mari Menjadi Bagian Dari <span class="text-indigo-400">Komunitas Kami.</span></h2>
                    <p class="text-xl text-slate-200 font-medium leading-relaxed opacity-90 max-w-lg italic border-l-4 border-indigo-500 pl-6">"Gotong royong adalah jati diri kita. Mari berkolaborasi untuk lingkungan yang lebih aman dan nyaman bagi semua."</p>
                </div>

                <div class="flex items-center gap-6">
                    <div class="px-6 py-4 bg-white/10 backdrop-blur-lg border border-white/10 rounded-3xl">
                        <p class="text-white font-bold text-sm">Pendaftaran gratis & terintegrasi otomatis.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Section: Register Form -->
        <div class="flex-1 bg-white flex flex-col justify-center px-10 sm:px-20 lg:px-24 xl:px-32 relative overflow-y-auto pt-20 pb-10">
            
            <div class="md:hidden absolute top-10 left-10 flex items-center gap-3">
                 <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center">
                     <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                 </div>
                 <span class="text-xl font-black text-slate-900 tracking-tighter uppercase font-outfit">SISTEM RT.</span>
            </div>

            <div class="max-w-md w-full mx-auto">
                <div class="mb-10 text-center md:text-left">
                    <h1 class="text-4xl font-black text-slate-900 tracking-tighter mb-2">Daftar Akun Baru.</h1>
                    <p class="text-slate-500 font-bold">Bergabunglah dengan ekosistem warga digital kami.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Nama Lengkap (Sesuai KTP)</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Contoh: Budi Santoso" 
                               class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl ring-2 ring-slate-100 focus:ring-4 focus:ring-indigo-600/20 focus:bg-white transition-all font-bold text-slate-900 placeholder-slate-300">
                        @error('name') <p class="text-rose-500 text-xs font-bold mt-2 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Alamat Email Aktif</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="nama@email.com" 
                               class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl ring-2 ring-slate-100 focus:ring-4 focus:ring-indigo-600/20 focus:bg-white transition-all font-bold text-slate-900 placeholder-slate-300">
                        @error('email') <p class="text-rose-500 text-xs font-bold mt-2 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Password Group -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="password" class="block text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Kata Sandi</label>
                            <input id="password" type="password" name="password" required placeholder="••••••••" 
                                   class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl ring-2 ring-slate-100 focus:ring-4 focus:ring-indigo-600/20 focus:bg-white transition-all font-bold text-slate-900">
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Konfirmasi</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="••••••••" 
                                   class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl ring-2 ring-slate-100 focus:ring-4 focus:ring-indigo-600/20 focus:bg-white transition-all font-bold text-slate-900">
                        </div>
                    </div>
                    @error('password') <p class="text-rose-500 text-xs font-bold -mt-2 ml-1">{{ $message }}</p> @enderror

                    <!-- Privacy Policy -->
                    <div class="flex items-start px-1 pt-2">
                        <div class="flex items-center h-5">
                            <input id="terms" type="checkbox" required class="w-5 h-5 rounded-lg border-slate-200 text-indigo-600 focus:ring-indigo-600 cursor-pointer transition-all">
                        </div>
                        <label for="terms" class="ml-3 text-[11px] font-bold text-slate-400 leading-normal">Saya menyetujui <a href="#" class="text-indigo-600 hover:underline">Syarat & Ketentuan</a> dan <a href="#" class="text-indigo-600 hover:underline">Kebijakan Privasi</a> lingkungan RT kami.</label>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="w-full py-5 bg-indigo-600 text-white rounded-[2rem] font-black text-lg shadow-2xl shadow-indigo-600/40 hover:bg-slate-900 hover:shadow-slate-900/30 transition-all duration-300 transform active:scale-[0.98] mt-4">
                        Buat Akun Sekarang &rarr;
                    </button>
                    
                    <div class="text-center pt-8">
                        <p class="text-sm font-bold text-slate-400 tracking-tight">Sudah terdaftar sebelumnya? <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800 transition-colors underline decoration-2 underline-offset-4">Masuk ke Akun Anda</a></p>
                    </div>
                </form>
            </div>
            
            <!-- Footer -->
            <div class="mt-12 text-center pb-8 border-t border-slate-50 pt-8">
                <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.3em]">&copy; 2026 Platform Ekosistem Warga Modern.</p>
            </div>
        </div>
    </div>
</body>
</html>
