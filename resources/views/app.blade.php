<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Seni Multikalter')</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            background-color: #3b1c08 !important;
        }
        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease-out;
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body class="text-white font-sans min-h-screen flex flex-col justify-between">

    <!-- Navbar -->
    <header class="bg-white text-black px-8 py-4 flex justify-between items-center shadow-sm relative" x-data="{ open: false }">
        <a href="{{ url('/') }}" class="flex items-center space-x-3">
            <div class="w-11 h-11 bg-emerald-900 rounded-full flex items-center justify-center text-white font-bold text-xs border-2 border-emerald-600 shadow">
                SM
            </div>
        </a>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex space-x-6 text-sm font-serif">
            <a href="{{ url('/') }}" class="hover:text-emerald-700">Beranda</a>
            <a href="{{ url('/profile') }}" class="hover:text-emerald-700">Profile</a>
            <a href="{{ url('/organigram') }}" class="hover:text-emerald-700">Organigram</a>
            <a href="{{ url('/galeri') }}" class="text-emerald-700 font-bold">Galeri</a>
            <a href="{{ url('/berita') }}" class="hover:text-emerald-700">Berita</a>
            <a href="{{ url('/prestasi') }}" class="hover:text-emerald-700">Prestasi</a>
            <a href="{{ url('/agenda') }}" class="hover:text-emerald-700">Agenda</a>
            <a href="{{ url('/anggota') }}" class="hover:text-emerald-700">Anggota</a>
        </nav>

        <!-- Mobile Toggle -->
        <button @click="open = !open" class="md:hidden text-black focus:outline-none">
            <i class="fas fa-bars text-xl"></i>
        </button>

        <!-- Mobile Navigation -->
        <div x-show="open" @click.away="open = false" class="absolute top-full left-0 w-full bg-white text-black flex flex-col space-y-3 p-4 shadow-lg md:hidden z-50">
            <a href="{{ url('/') }}" class="hover:text-emerald-700">Beranda</a>
            <a href="{{ url('/profile') }}" class="hover:text-emerald-700">Profile</a>
            <a href="{{ url('/organigram') }}" class="hover:text-emerald-700">Organigram</a>
            <a href="{{ url('/galeri') }}" class="text-emerald-700 font-bold">Galeri</a>
            <a href="{{ url('/berita') }}" class="hover:text-emerald-700">Berita</a>
            <a href="{{ url('/prestasi') }}" class="hover:text-emerald-700">Prestasi</a>
            <a href="{{ url('/agenda') }}" class="hover:text-emerald-700">Agenda</a>
            <a href="{{ url('/anggota') }}" class="hover:text-emerald-700">Anggota</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8 flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white text-black py-6 px-8 border-t border-gray-200">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 text-center md:text-left text-xs">
            <div class="flex items-center justify-center md:justify-start space-x-3">
                <div class="w-10 h-10 bg-emerald-900 rounded-full flex items-center justify-center text-white font-bold border-2 border-emerald-600">
                    SM
                </div>
                <div>
                    <h3 class="font-bold text-sm">SMKN 2 PURWAKARTA</h3>
                    <p class="text-gray-600">Wadahna Para Seniman</p>
                </div>
            </div>

            <div>
                <h4 class="font-bold mb-1">Alamat</h4>
                <p class="text-gray-600">Jln. Jend. Ahmad Yani No. 98 Nagri Tengah</p>
                <p class="text-gray-600">Kab. Purwakarta 41114</p>
            </div>

            <div class="flex flex-col items-center md:items-end">
                <h4 class="font-bold mb-2">Media Sosial</h4>
                <div class="flex space-x-4 text-xl text-black">
                    <a href="#" class="hover:text-emerald-700"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="hover:text-emerald-700"><i class="fab fa-tiktok"></i></a>
                    <a href="#" class="hover:text-emerald-700"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- JS Animation -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const reveals = document.querySelectorAll(".reveal");
            function revealOnScroll() {
                const windowHeight = window.innerHeight;
                reveals.forEach((element) => {
                    const elementTop = element.getBoundingClientRect().top;
                    if (elementTop < windowHeight - 50) {
                        element.classList.add("active");
                    }
                });
            }
            revealOnScroll();
            window.addEventListener("scroll", revealOnScroll);
        });
    </script>
</body>
</html>