<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>YouRead</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

    <!-- Tailwind & Alpine -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Prevent horizontal scroll -->
    <style>
        body {
            overflow-x: hidden;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen font-sans">

    <!-- Header -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-6 py-6 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center space-x-5">
                <h1 class="text-4xl font-extrabold text-blue-600 select-none cursor-default">You<span class="text-yellow-500">Read</span></h1>
                <p class="text-lg text-gray-600 hidden md:block">Stay Informed. Stay Ahead.</p>
            </div>

            <form action="{{ route('search') }}" method="GET" class="flex w-full max-w-xl items-center bg-gray-100 rounded-md overflow-hidden shadow-sm">
                <input type="text" name="q" placeholder="Cari berita..." class="w-full px-4 py-3 bg-transparent text-gray-800 focus:outline-none" />
                <button type="submit" class="bg-yellow-500 px-5 py-3 hover:bg-yellow-400 text-white transition-colors">
                    <i class="fas fa-search text-lg"></i>
                </button>
            </form>

            <!-- Dropdown Profil -->
            <div x-data="{ open: false }" class="relative z-50">
                <button @click="open = !open" class="text-blue-600 hover:text-yellow-500 focus:outline-none">
                    <i class="fas fa-user-circle text-4xl"></i>
                </button>

                <div x-show="open" @click.away="open = false" x-transition
                     class="absolute right-0 mt-4 w-60 bg-white rounded-xl shadow-xl ring-1 ring-black/10 border text-sm font-medium text-gray-700"
                     x-cloak>
                    <a href="/profile" class="flex items-center gap-3 px-5 py-4 hover:bg-gray-100 transition">
                        <i class="fas fa-user text-lg text-gray-500"></i>
                        Profil Saya
                    </a>

                    <div class="border-t"></div>

                    <form action="{{ route('logout') }}" method="POST" class="px-5 py-4">
                        @csrf
                        <button type="submit" class="flex items-center gap-3 text-red-600 hover:text-red-400 w-full text-left font-medium">
                            <i class="fas fa-sign-out-alt text-lg"></i>
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    
<!-- Navbar Kategori -->
<nav class="bg-black border-t border-b border-gray-700 sticky top-0 z-40 w-full">
    <div class="container mx-auto px-6 py-4">
        <div class="flex justify-between items-center text-[1.125rem] font-semibold text-white tracking-wide space-x-24">
            <a href="{{ route('dashboard') }}" class="hover:text-yellow-400 transition">Beranda</a>
            <a href="{{ route('news.category', ['category' => 'technology']) }}" class="hover:text-yellow-400 transition">Teknologi</a>
            <a href="{{ route('news.category', ['category' => 'sports']) }}" class="hover:text-yellow-400 transition">Olahraga</a>
            <a href="{{ route('news.category', ['category' => 'entertainment']) }}" class="hover:text-yellow-400 transition">Hiburan</a>
            <a href="{{ route('news.category', ['category' => 'business']) }}" class="hover:text-yellow-400 transition">Ekonomi</a>
            <a href="{{ route('news.category', ['category' => 'politics']) }}" class="hover:text-yellow-400 transition">Politik</a>
            <a href="{{ route('news.category', ['category' => 'general']) }}" class="hover:text-yellow-400 transition">Internasional</a>
            <a href="{{ route('news.category', ['category' => 'health']) }}" class="hover:text-yellow-400 transition">Kesehatan</a>
        </div>
    </div>
</nav>




    <!-- Konten -->
    <main class="container mx-auto px-6 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-blue-900 via-gray-900 to-black text-gray-300 mt-16">
        <div class="container mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h2 class="text-3xl font-extrabold text-yellow-400 mb-3">YouRead</h2>
                <p class="text-gray-400 leading-relaxed">Tetap update dengan berita terbaru dan terpercaya dari seluruh dunia.</p>
                <p class="mt-6 text-sm">&copy; 2025 YouRead. All rights reserved.</p>
            </div>
            <div>
                <h3 class="font-semibold text-yellow-400 mb-4">Navigasi Cepat</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('dashboard') }}" class="hover:text-yellow-400 transition">Beranda</a></li>
                    <li><a href="{{ route('news.category', ['category' => 'technology']) }}" class="hover:text-yellow-400 transition">Teknologi</a></li>
                    <li><a href="{{ route('news.category', ['category' => 'sports']) }}" class="hover:text-yellow-400 transition">Olahraga</a></li>
                    <li><a href="{{ route('news.category', ['category' => 'business']) }}" class="hover:text-yellow-400 transition">Ekonomi</a></li>
                    <li><a href="{{ route('news.category', ['category' => 'health']) }}" class="hover:text-yellow-400 transition">Kesehatan</a></li>
                </ul>
            </div>
            <div class="md:col-span-2">
                <h3 class="font-semibold text-yellow-400 mb-4">Berlangganan YouRead</h3>
                <p class="mb-4 text-gray-400">Dapatkan ringkasan berita terbaru langsung ke email kamu.</p>
                <form action="#" method="POST" class="flex flex-col sm:flex-row gap-3">
                    <input type="email" name="email" placeholder="Masukkan email kamu" required class="flex-grow px-4 py-3 rounded-md text-gray-900 focus:outline-none" />
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-400 text-white font-semibold px-6 py-3 rounded-md transition">Langganan</button>
                </form>
                <div class="mt-6 flex space-x-6 text-3xl text-yellow-400">
                    <a href="#" aria-label="Facebook" class="hover:text-yellow-300 transition"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Twitter" class="hover:text-yellow-300 transition"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="Instagram" class="hover:text-yellow-300 transition"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="LinkedIn" class="hover:text-yellow-300 transition"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
