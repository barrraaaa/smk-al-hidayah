<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'SMK Alhidayah'))</title>
    <meta name="description" content="@yield('meta_description', 'SMK Alhidayah — Sekolah Menengah Kejuruan Islam Modern dengan 4 jurusan unggulan: AKL, Pemasaran, MPLB, dan TJKT.')">

    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="min-h-screen bg-surface text-text-body font-sans antialiased">

    {{-- Skip to content --}}
    <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-[100] focus:rounded-lg focus:bg-primary focus:px-4 focus:py-2 focus:text-white">
        Lompat ke konten utama
    </a>

    {{-- Navbar --}}
    <header id="navbar" class="navbar-transparent fixed top-0 left-0 right-0 z-50 transition-all duration-300">
        <div class="container-page">
            <div class="flex h-16 items-center justify-between md:h-[72px]">
                {{-- Logo --}}
                <a href="{{ url('/') }}" class="flex items-center gap-2 text-lg font-bold text-white md:text-xl">
                    <svg class="h-8 w-8" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="32" height="32" rx="8" fill="currentColor"/>
                        <text x="16" y="22" text-anchor="middle" font-size="18" font-weight="bold" fill="white">S</text>
                    </svg>
                    <span class="font-heading">SMK Alhidayah</span>
                </a>

                {{-- Desktop Nav --}}
                <nav class="hidden items-center gap-1 md:flex" aria-label="Navigasi utama">
                    <a href="{{ url('/') }}" class="rounded-lg px-4 py-2 text-sm font-medium text-white/90 transition-colors hover:bg-white/10 hover:text-white">Beranda</a>
                    <a href="{{ url('/profil') }}" class="rounded-lg px-4 py-2 text-sm font-medium text-white/90 transition-colors hover:bg-white/10 hover:text-white">Profil</a>
                    <div class="relative group">
                        <button class="rounded-lg px-4 py-2 text-sm font-medium text-white/90 transition-colors hover:bg-white/10 hover:text-white flex items-center gap-1">
                            Jurusan
                            <svg class="h-4 w-4 transition-transform group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="invisible absolute top-full left-0 mt-1 w-56 rounded-xl border border-border bg-white p-2 shadow-lg opacity-0 transition-all group-hover:visible group-hover:opacity-100">
                            <a href="{{ url('/jurusan/akl') }}" class="block rounded-lg px-4 py-2.5 text-sm text-text-body transition-colors hover:bg-primary/5 hover:text-primary">AKL — Akuntansi</a>
                            <a href="{{ url('/jurusan/pemasaran') }}" class="block rounded-lg px-4 py-2.5 text-sm text-text-body transition-colors hover:bg-primary/5 hover:text-primary">Pemasaran</a>
                            <a href="{{ url('/jurusan/mplb') }}" class="block rounded-lg px-4 py-2.5 text-sm text-text-body transition-colors hover:bg-primary/5 hover:text-primary">MPLB — Manajemen Perkantoran</a>
                            <a href="{{ url('/jurusan/tjkt') }}" class="block rounded-lg px-4 py-2.5 text-sm text-text-body transition-colors hover:bg-primary/5 hover:text-primary">TJKT — Teknik Jaringan</a>
                        </div>
                    </div>
                    <a href="{{ url('/artikel') }}" class="rounded-lg px-4 py-2 text-sm font-medium text-white/90 transition-colors hover:bg-white/10 hover:text-white">Artikel</a>
                    <a href="{{ url('/galeri') }}" class="rounded-lg px-4 py-2 text-sm font-medium text-white/90 transition-colors hover:bg-white/10 hover:text-white">Galeri</a>
                    <a href="{{ url('/kontak') }}" class="rounded-lg px-4 py-2 text-sm font-medium text-white/90 transition-colors hover:bg-white/10 hover:text-white">Kontak</a>
                    <a href="{{ url('/ppdb') }}" class="btn-accent ml-2 px-5 py-2 text-sm">Daftar PPDB</a>
                </nav>

                {{-- Mobile hamburger --}}
                <button id="nav-toggle" class="flex items-center justify-center rounded-lg p-2 text-white md:hidden" aria-label="Toggle navigation" aria-expanded="false">
                    <svg id="nav-icon-open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg id="nav-icon-close" class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="nav-mobile" class="hidden border-t border-white/10 bg-primary md:hidden">
            <div class="container-page space-y-1 pb-4 pt-2">
                <a href="{{ url('/') }}" class="block rounded-lg px-4 py-2.5 text-sm font-medium text-white/90 hover:bg-white/10">Beranda</a>
                <a href="{{ url('/profil') }}" class="block rounded-lg px-4 py-2.5 text-sm font-medium text-white/90 hover:bg-white/10">Profil</a>
                <div class="px-4 py-2 text-sm font-medium text-white/70">Jurusan</div>
                <a href="{{ url('/jurusan/akl') }}" class="block rounded-lg px-8 py-2 text-sm text-white/80 hover:bg-white/10">AKL — Akuntansi</a>
                <a href="{{ url('/jurusan/pemasaran') }}" class="block rounded-lg px-8 py-2 text-sm text-white/80 hover:bg-white/10">Pemasaran</a>
                <a href="{{ url('/jurusan/mplb') }}" class="block rounded-lg px-8 py-2 text-sm text-white/80 hover:bg-white/10">MPLB — Manajemen Perkantoran</a>
                <a href="{{ url('/jurusan/tjkt') }}" class="block rounded-lg px-8 py-2 text-sm text-white/80 hover:bg-white/10">TJKT — Teknik Jaringan</a>
                <div class="pt-2">
                    <a href="{{ url('/artikel') }}" class="block rounded-lg px-4 py-2.5 text-sm font-medium text-white/90 hover:bg-white/10">Artikel</a>
                    <a href="{{ url('/galeri') }}" class="block rounded-lg px-4 py-2.5 text-sm font-medium text-white/90 hover:bg-white/10">Galeri</a>
                    <a href="{{ url('/prestasi') }}" class="block rounded-lg px-4 py-2.5 text-sm font-medium text-white/90 hover:bg-white/10">Prestasi</a>
                    <a href="{{ url('/ekstrakurikuler') }}" class="block rounded-lg px-4 py-2.5 text-sm font-medium text-white/90 hover:bg-white/10">Ekstrakurikuler</a>
                    <a href="{{ url('/pengumuman-kelulusan') }}" class="block rounded-lg px-4 py-2.5 text-sm font-medium text-white/90 hover:bg-white/10">Cek Kelulusan</a>
                    <a href="{{ url('/kontak') }}" class="block rounded-lg px-4 py-2.5 text-sm font-medium text-white/90 hover:bg-white/10">Kontak</a>
                </div>
                <div class="pt-4 px-4">
                    <a href="{{ url('/ppdb') }}" class="btn-accent w-full text-center">Daftar PPDB</a>
                </div>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main id="main-content">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-primary-dark text-white">
        <div class="container-page py-16">
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                {{-- Logo & Description --}}
                <div class="space-y-4">
                    <div class="flex items-center gap-2 text-lg font-bold">
                        <svg class="h-8 w-8" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="32" height="32" rx="8" fill="white"/>
                            <text x="16" y="22" text-anchor="middle" font-size="18" font-weight="bold" fill="#0D7C3F">S</text>
                        </svg>
                        <span class="font-heading">SMK Alhidayah</span>
                    </div>
                    <p class="text-sm leading-relaxed text-white/70">
                        Sekolah Menengah Kejuruan Islam modern dengan 4 jurusan unggulan. Mencetak generasi berakhlak mulia, kompeten, dan siap kerja.
                    </p>
                </div>

                {{-- Navigasi --}}
                <div>
                    <h3 class="mb-4 font-heading font-semibold text-white">Navigasi</h3>
                    <ul class="space-y-2 text-sm text-white/70">
                        <li><a href="{{ url('/') }}" class="transition-colors hover:text-white">Beranda</a></li>
                        <li><a href="{{ url('/profil') }}" class="transition-colors hover:text-white">Profil Sekolah</a></li>
                        <li><a href="{{ url('/jurusan/akl') }}" class="transition-colors hover:text-white">Jurusan</a></li>
                        <li><a href="{{ url('/ppdb') }}" class="transition-colors hover:text-white">PPDB</a></li>
                        <li><a href="{{ url('/artikel') }}" class="transition-colors hover:text-white">Artikel</a></li>
                        <li><a href="{{ url('/galeri') }}" class="transition-colors hover:text-white">Galeri</a></li>
                    </ul>
                </div>

                {{-- Jurusan --}}
                <div>
                    <h3 class="mb-4 font-heading font-semibold text-white">Jurusan</h3>
                    <ul class="space-y-2 text-sm text-white/70">
                        <li><a href="{{ url('/jurusan/akl') }}" class="transition-colors hover:text-white">AKL — Akuntansi</a></li>
                        <li><a href="{{ url('/jurusan/pemasaran') }}" class="transition-colors hover:text-white">Pemasaran</a></li>
                        <li><a href="{{ url('/jurusan/mplb') }}" class="transition-colors hover:text-white">MPLB — Manajemen Perkantoran</a></li>
                        <li><a href="{{ url('/jurusan/tjkt') }}" class="transition-colors hover:text-white">TJKT — Teknik Jaringan</a></li>
                    </ul>
                </div>

                {{-- Kontak --}}
                <div>
                    <h3 class="mb-4 font-heading font-semibold text-white">Kontak</h3>
                    <ul class="space-y-3 text-sm text-white/70">
                        <li class="flex items-start gap-2">
                            <svg class="mt-0.5 h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>Jl. Contoh No. 123, Jakarta</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span>(021) 1234-5678</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <a href="mailto:info@smkalhidayah.sch.id" class="transition-colors hover:text-white">info@smkalhidayah.sch.id</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Copyright --}}
        <div class="border-t border-white/10">
            <div class="container-page flex flex-col items-center justify-between gap-2 py-6 text-sm text-white/60 md:flex-row">
                <p>&copy; {{ date('Y') }} SMK Alhidayah. All rights reserved.</p>
                <p>Dibangun dengan <span class="text-accent">❤</span> untuk pendidikan Indonesia</p>
            </div>
        </div>
    </footer>

    {{-- Scroll to top button --}}
    <button id="scroll-top" class="fixed bottom-6 right-6 z-40 flex h-12 w-12 items-center justify-center rounded-full bg-primary text-white shadow-lg opacity-0 transition-all duration-300 hover:bg-primary-light focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
            aria-label="Kembali ke atas"
            onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </button>

    {{-- Navbar scroll & mobile toggle --}}
    @push('scripts')
    <script>
        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        let lastScroll = 0;

        window.addEventListener('scroll', () => {
            const scrollY = window.scrollY;

            if (scrollY > 80) {
                navbar.classList.remove('navbar-transparent');
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
                navbar.classList.add('navbar-transparent');
            }

            // Scroll to top button
            const scrollTop = document.getElementById('scroll-top');
            if (scrollY > 400) {
                scrollTop.classList.remove('opacity-0', 'pointer-events-none');
                scrollTop.classList.add('opacity-100');
            } else {
                scrollTop.classList.remove('opacity-100');
                scrollTop.classList.add('opacity-0', 'pointer-events-none');
            }

            lastScroll = scrollY;
        });

        // Mobile menu toggle
        const navToggle = document.getElementById('nav-toggle');
        const navMobile = document.getElementById('nav-mobile');
        const navIconOpen = document.getElementById('nav-icon-open');
        const navIconClose = document.getElementById('nav-icon-close');

        navToggle.addEventListener('click', () => {
            const isOpen = navMobile.classList.contains('hidden');
            navMobile.classList.toggle('hidden', !isOpen);
            navIconOpen.classList.toggle('hidden', isOpen);
            navIconClose.classList.toggle('hidden', !isOpen);
            navToggle.setAttribute('aria-expanded', isOpen);
        });

        // Close mobile menu on link click
        navMobile.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                navMobile.classList.add('hidden');
                navIconOpen.classList.remove('hidden');
                navIconClose.classList.add('hidden');
                navToggle.setAttribute('aria-expanded', 'false');
            });
        });
    </script>
    @endpush

    @stack('scripts')
</body>
</html>
