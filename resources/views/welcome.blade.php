<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cool Animated Landing Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</head>
<body class="bg-slate-900 flex items-center justify-center min-h-screen overflow-hidden">

    <div class="absolute top-0 -left-4 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
    <div class="absolute top-0 -right-4 w-72 h-72 bg-yellow-500 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-500 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>

    <main class="relative z-10 w-full max-w-4xl px-6">
        <nav class="flex justify-between items-center mb-16 animate-fade-in">
            <div class="text-white font-bold text-2xl tracking-tighter">
                NEXA<span class="text-purple-400">GEN</span>
            </div>
            <div class="space-x-8 text-gray-400 font-medium hidden md:flex">
                <a href="#" class="hover:text-white transition">Works</a>
                <a href="#" class="hover:text-white transition">Services</a>
                <a href="#" class="hover:text-white transition">About</a>
            </div>
            <button class="bg-white/10 border border-white/20 text-white px-6 py-2 rounded-full backdrop-blur-md hover:bg-white hover:text-black transition-all duration-300">
                Contact
            </button>
        </nav>

        <section class="text-center">
            <h1 class="text-5xl md:text-7xl font-extrabold text-white leading-tight mb-6">
                Masa Depan <br> 
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-purple-400 to-pink-600">
                    Digital Anda
                </span>
            </h1>
            <p class="text-gray-400 text-lg md:text-xl max-w-2xl mx-auto mb-10 leading-relaxed">
                Kami membangun pengalaman digital yang tidak hanya terlihat cantik, tapi juga bekerja dengan sempurna. Berani beda, berani berinovasi.
            </p>

            <div class="flex flex-col md:flex-row gap-4 justify-center items-center">
                <button class="w-full md:w-auto px-8 py-4 bg-purple-600 text-white rounded-xl font-bold shadow-lg shadow-purple-500/30 hover:bg-purple-700 hover:-translate-y-1 transition-all duration-300">
                    Mulai Proyek
                </button>
                <button class="w-full md:w-auto px-8 py-4 bg-white/5 border border-white/10 text-white rounded-xl font-bold backdrop-blur-sm hover:bg-white/10 transition-all duration-300">
                    Lihat Portfolio
                </button>
            </div>
        </section>

        <div class="mt-20 grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="p-6 bg-white/5 border border-white/10 rounded-2xl backdrop-blur-md text-center hover:border-purple-500/50 transition">
                <div class="text-3xl font-bold text-white mb-1">150+</div>
                <div class="text-gray-500 text-sm">Clients</div>
            </div>
            <div class="p-6 bg-white/5 border border-white/10 rounded-2xl backdrop-blur-md text-center hover:border-purple-500/50 transition">
                <div class="text-3xl font-bold text-white mb-1">300+</div>
                <div class="text-gray-500 text-sm">Projects</div>
            </div>
            <div class="p-6 bg-white/5 border border-white/10 rounded-2xl backdrop-blur-md text-center hover:border-purple-500/50 transition">
                <div class="text-3xl font-bold text-white mb-1">12</div>
                <div class="text-gray-500 text-sm">Awards</div>
            </div>
            <div class="p-6 bg-white/5 border border-white/10 rounded-2xl backdrop-blur-md text-center hover:border-purple-500/50 transition">
                <div class="text-3xl font-bold text-white mb-1">99%</div>
                <div class="text-gray-500 text-sm">Happy</div>
            </div>
        </div>
    </main>

</body>
</html>