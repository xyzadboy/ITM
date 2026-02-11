<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Area Akses Premium</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob { animation: blob 7s infinite; }
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }
    </style>
</head>
<body class="bg-slate-950 h-screen flex items-center justify-center overflow-hidden relative font-sans">

    <div class="absolute top-0 -left-4 w-96 h-96 bg-purple-600 rounded-full mix-blend-screen filter blur-[100px] opacity-30 animate-blob"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-600 rounded-full mix-blend-screen filter blur-[100px] opacity-30 animate-blob animation-delay-2000"></div>

    <div class="relative z-10 w-full max-w-md p-1">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-purple-600 rounded-3xl blur opacity-20 group-hover:opacity-40 transition duration-1000"></div>
        
        <div class="relative bg-slate-900/80 backdrop-blur-2xl border border-white/10 rounded-3xl p-10 shadow-2xl">
            
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-tr from-blue-600 to-purple-600 rounded-2xl mb-4 shadow-lg shadow-blue-500/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-extrabold text-white tracking-tight">Selamat Datang</h1>
                <p class="text-slate-400 mt-2 text-sm">Masuk untuk mengelola dashboard Anda</p>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-widest mb-2 ml-1">
                        Username / Email
                    </label>
                    <div class="relative group">
                        <input
                            type="text"
                            name="login"
                            value="{{ old('login') }}"
                            required
                            autofocus
                            class="w-full bg-slate-800/50 border border-slate-700 text-white px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 placeholder-slate-500"
                            placeholder="nama@email.com"
                        />
                    </div>
                    @error('login')
                        <p class="text-red-400 text-xs mt-2 ml-1 animate-pulse">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex justify-between mb-2 ml-1">
                        <label for="password" class="text-xs font-semibold text-slate-400 uppercase tracking-widest">Password</label>
                        <a href="#" class="text-xs text-blue-400 hover:text-blue-300 transition">Lupa?</a>
                    </div>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        required 
                        class="w-full bg-slate-800/50 border border-slate-700 text-white px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 placeholder-slate-500"
                        placeholder="••••••••"
                    >
                    @error('password')
                        <p class="text-red-400 text-xs mt-2 ml-1 animate-pulse">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center ml-1">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded border-slate-700 bg-slate-800 text-blue-600 focus:ring-blue-500">
                    <label for="remember" class="ml-2 text-sm text-slate-400">Ingat saya</label>
                </div>

                <button 
                    type="submit" 
                    class="w-full bg-purple-700 hover:bg-purple-600 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-purple-900/20 transition duration-300 ease-in-out transform hover:-translate-y-1 active:scale-95"
                >
                    Masuk ke Sistem
                </button>
            </form>

            <div class="mt-8 text-center text-sm text-slate-500">
                Belum punya akun? <a href="#" class="text-blue-400 font-semibold hover:underline">Daftar sekarang</a>
            </div>
        </div>
    </div>

</body>
</html>