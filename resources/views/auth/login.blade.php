<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Manajemen RT</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .glass-effect {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .bg-illustration {
            background-image: url("/assets/images/neighborhood_login_bg_1775788619028.png");
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-slate-50 antialiased overflow-hidden">
    <div class="h-screen flex flex-col md:flex-row">
        
        <!-- Left Section: Aesthetic Illustration -->
        <div class="hidden md:flex md:w-3/5 lg:w-4/6 relative bg-gradient-to-br from-indigo-700 via-violet-800 to-fuchsia-900 overflow-hidden">
            <!-- Background Image overlay -->
            <div class="absolute inset-0 bg-illustration opacity-40 mix-blend-overlay scale-110 hover:scale-100 transition-transform duration-[10s] ease-in-out"></div>
            
            <!-- Floating Elements / Blur -->
            <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-indigo-500 rounded-full blur-[120px] opacity-30 animate-pulse"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[500px] h-[500px] bg-fuchsia-500 rounded-full blur-[150px] opacity-20 animate-pulse" style="animation-delay: 2s;"></div>

            <div class="relative z-10 p-20 flex flex-col justify-between h-full w-full">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-xl rounded-2xl flex items-center justify-center border border-white/30 shadow-2xl">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </div>
                    <span class="text-2xl font-black text-white tracking-widest uppercase">SISTEM RT.</span>
                </div>

                <div class="max-w-2xl">
                    <h2 class="text-6xl font-black text-white leading-[1.1] mb-8 tracking-tighter">Kelola Lingkunganmu <span class="text-fuchsia-400">Lebih Cerdas.</span></h2>
                    <p class="text-xl text-indigo-100 font-medium leading-relaxed opacity-90 max-w-lg">Sistem manajemen Rukun Tetangga modern yang dirancang untuk transparansi, efisiensi, dan kenyamanan warga dalam satu platform terpadu.</p>
                </div>

                <div class="flex items-center gap-8">
                    <div class="flex -space-x-4">
                        <div class="w-12 h-12 rounded-full border-4 border-indigo-900 bg-slate-200"></div>
                        <div class="w-12 h-12 rounded-full border-4 border-indigo-900 bg-slate-300"></div>
                        <div class="w-12 h-12 rounded-full border-4 border-indigo-900 bg-slate-400"></div>
                    </div>
                    <p class="text-indigo-200 text-sm font-bold tracking-wide">+150 Warga telah terintegrasi.</p>
                </div>
            </div>
        </div>

        <!-- Right Section: Login Form -->
        <div class="flex-1 bg-white flex flex-col justify-center px-10 sm:px-20 lg:px-32 relative">
            
            <!-- Mobile Logo -->
            <div class="md:hidden absolute top-10 left-10 flex items-center gap-3">
                 <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-xl shadow-indigo-600/30">
                     <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                 </div>
                 <span class="text-xl font-black text-slate-900 tracking-tighter uppercase">SISTEM RT.</span>
            </div>

            <div class="max-w-md w-full mx-auto">
                <div class="mb-12">
                    <h1 class="text-4xl font-black text-slate-900 tracking-tighter mb-2">Selamat Datang.</h1>
                    <p class="text-slate-500 font-bold">Silakan masuk untuk mengakses panel Anda.</p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-6 px-4 py-3 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-700 text-sm font-bold flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Email Kependudukan</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path></svg>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@email.com" 
                                   class="w-full pl-14 pr-5 py-4 bg-slate-50 border-none rounded-2xl ring-2 ring-slate-100 focus:ring-4 focus:ring-indigo-600/20 focus:bg-white transition-all font-bold text-slate-900 placeholder-slate-300">
                        </div>
                        @error('email') <p class="text-rose-500 text-xs font-bold mt-2 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex justify-between items-center mb-2 ml-1">
                            <label for="password" class="block text-xs font-black text-slate-400 uppercase tracking-[0.2em]">Kata Sandi</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition-colors">Lupa sandi?</a>
                            @endif
                        </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <input id="password" type="password" name="password" required placeholder="••••••••" 
                                   class="w-full pl-14 pr-5 py-4 bg-slate-50 border-none rounded-2xl ring-2 ring-slate-100 focus:ring-4 focus:ring-indigo-600/20 focus:bg-white transition-all font-bold text-slate-900 placeholder-slate-300">
                        </div>
                        @error('password') <p class="text-rose-500 text-xs font-bold mt-2 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center px-1">
                        <input id="remember_me" type="checkbox" name="remember" class="w-5 h-5 rounded-lg border-slate-200 text-indigo-600 focus:ring-indigo-600 transition-all cursor-pointer">
                        <label for="remember_me" class="ml-3 text-sm font-bold text-slate-500 cursor-pointer select-none">Biarkan saya tetap masuk</label>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="w-full py-5 bg-indigo-600 text-white rounded-[2rem] font-black text-lg shadow-2xl shadow-indigo-600/40 hover:bg-slate-900 hover:shadow-slate-900/30 transition-all duration-300 transform active:scale-[0.98]">
                        Masuk ke Dasbor &rarr;
                    </button>
                    
                    <div class="text-center pt-8">
                        <p class="text-sm font-bold text-slate-400 tracking-tight">Belum terdaftar sebagai warga? <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 transition-colors underline decoration-2 underline-offset-4">Daftar Akun Baru</a></p>
                    </div>
                </form>
            </div>
            
            <!-- Footer -->
            <div class="absolute bottom-10 left-0 w-full text-center px-10">
                <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.3em]">&copy; 2026 Sistem Manajemen Lingkungan Modern.</p>
            </div>
        </div>
    </div>
</body>
</html>
