<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $settings = \App\Models\SchoolSetting::getSettings();
        $jurusans = \App\Models\Jurusan::where('aktif', true)->get();
    @endphp

    <title>@yield('title', $settings->school_name)</title>
    <meta name="description" content="@yield('meta_description', $settings->description ?: 'SMK Alhidayah Jakarta — Sekolah Menengah Kejuruan unggulan di Jakarta')">

    {{-- SEO Meta (OG, Twitter, Canonical) --}}
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:title" content="{{ $__env->yieldContent('title', $settings->school_name) }}">
    <meta property="og:description" content="{{ $__env->yieldContent('meta_description', $settings->description ?: 'SMK Alhidayah Jakarta — Sekolah Menengah Kejuruan unggulan di Jakarta') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $__env->yieldContent('og_image', asset('og-image.jpg')) }}">
    <meta property="og:type" content="{{ $__env->yieldContent('og_type', 'website') }}">
    <meta property="og:site_name" content="{{ $settings->school_name }}">
    <meta property="og:locale" content="id_ID">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="robots" content="index, follow">

    {{-- JSON-LD Structured Data --}}
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "School",
        "name": "{{ $settings->school_name }}",
        "description": "{{ $settings->description }}",
        "url": "{{ url('/') }}",
        "address": {
            "@@type": "PostalAddress",
            "streetAddress": "{{ $settings->address }}",
            "addressCountry": "ID"
        },
        @if($settings->phone)"telephone": "{{ $settings->phone }}",@endif
        @if($settings->email)"email": "{{ $settings->email }}",@endif
        "foundingDate": "2010",
        "parentOrganization": {
            "@@type": "Organization",
            "name": "Yayasan Alhidayah"
        }
    }
    </script>

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
    @stack('styles')
</head>
<body class="min-h-screen bg-surface text-text-body font-sans antialiased">

    {{-- Skip to content --}}
    <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-[100] focus:rounded-md focus:bg-primary focus:px-4 focus:py-2 focus:text-white">
        Lompat ke konten utama
    </a>

    {{-- Navbar --}}
    <header id="navbar" class="navbar-transparent fixed top-0 left-0 right-0 z-50 transition-all duration-300">
        <div class="container-page">
            <div class="flex h-[90px] items-center justify-between md:h-[111px]">
                {{-- Logo --}}
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    @if($settings->logo_url)
                        <img src="{{ $settings->logo_url }}" alt="{{ $settings->school_name }}" class="h-10 w-auto md:h-12">
                    @endif
                    <span class="font-heading text-xl font-bold text-white md:text-2xl">{{ $settings->school_name }}</span>
                </a>

                {{-- Desktop Nav --}}
                <nav class="hidden items-center gap-0 md:flex" aria-label="Navigasi utama">
                    <a href="{{ url('/') }}" class="nav-link rounded-md px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-white/10">Beranda</a>

                    {{-- Profil dropdown --}}
                    <div class="relative group">
                        <button class="rounded-md px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-white/10 flex items-center gap-1">
                            Profil
                            <svg class="h-3 w-3 transition-transform group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="nav-dropdown absolute top-full left-0 mt-1 w-64 rounded-lg border border-gray-100 bg-white p-2 shadow-lg">
                            <div class="nav-dropdown-item"><a href="{{ url('/profil') }}" class="nav-dropdown-link rounded-md px-4 py-2.5 text-sm text-text-body hover:text-primary">Sekilas Profil</a></div>
                            <div class="nav-dropdown-item"><a href="{{ url('/profil/sejarah') }}" class="nav-dropdown-link rounded-md px-4 py-2.5 text-sm text-text-body hover:text-primary">Sejarah &amp; Visi Misi</a></div>
                            <div class="nav-dropdown-item"><a href="{{ url('/profil/struktur-organisasi') }}" class="nav-dropdown-link rounded-md px-4 py-2.5 text-sm text-text-body hover:text-primary">Struktur Organisasi</a></div>
                            <div class="nav-dropdown-item"><a href="{{ url('/profil/guru') }}" class="nav-dropdown-link rounded-md px-4 py-2.5 text-sm text-text-body hover:text-primary">Guru &amp; Tenaga Pengajar</a></div>
                        </div>
                    </div>

                    {{-- Jurusan dropdown (dynamic from DB) --}}
                    <div class="relative group">
                        <button class="rounded-md px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-white/10 flex items-center gap-1">
                            Jurusan
                            <svg class="h-3 w-3 transition-transform group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="nav-dropdown absolute top-full left-0 mt-1 w-64 rounded-lg border border-gray-100 bg-white p-2 shadow-lg">
                            @foreach($jurusans as $j)
                            <div class="nav-dropdown-item"><a href="{{ url('/jurusan/' . $j->slug) }}" class="nav-dropdown-link rounded-md px-4 py-2.5 text-sm text-text-body hover:text-primary">{{ $j->nama }}</a></div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Kegiatan dropdown --}}
                    <div class="relative group">
                        <button class="rounded-md px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-white/10 flex items-center gap-1">
                            Kegiatan
                            <svg class="h-3 w-3 transition-transform group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="nav-dropdown absolute top-full left-0 mt-1 w-56 rounded-lg border border-gray-100 bg-white p-2 shadow-lg">
                            <div class="nav-dropdown-item"><a href="{{ url('/prestasi') }}" class="nav-dropdown-link rounded-md px-4 py-2.5 text-sm text-text-body hover:text-primary">Prestasi</a></div>
                            <div class="nav-dropdown-item"><a href="{{ url('/ekstrakurikuler') }}" class="nav-dropdown-link rounded-md px-4 py-2.5 text-sm text-text-body hover:text-primary">Ekstrakurikuler</a></div>
                            <div class="nav-dropdown-item"><a href="{{ url('/galeri') }}" class="nav-dropdown-link rounded-md px-4 py-2.5 text-sm text-text-body hover:text-primary">Galeri</a></div>
                        </div>
                    </div>

                    {{-- PPDB dropdown --}}
                    <div class="relative group">
                        <button class="rounded-md px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-white/10 flex items-center gap-1">
                            PPDB
                            <svg class="h-3 w-3 transition-transform group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="nav-dropdown absolute top-full left-0 mt-1 w-56 rounded-lg border border-gray-100 bg-white p-2 shadow-lg">
                            <div class="nav-dropdown-item"><a href="{{ url('/ppdb') }}" class="nav-dropdown-link rounded-md px-4 py-2.5 text-sm text-text-body hover:text-primary">Info &amp; Jadwal</a></div>
                            <div class="nav-dropdown-item"><a href="{{ url('/ppdb/daftar') }}" class="nav-dropdown-link rounded-md px-4 py-2.5 text-sm text-text-body hover:text-primary">Form Pendaftaran</a></div>
                            <div class="nav-dropdown-item"><a href="{{ url('/ppdb/status') }}" class="nav-dropdown-link rounded-md px-4 py-2.5 text-sm text-text-body hover:text-primary">Cek Status</a></div>
                        </div>
                    </div>

                    {{-- Info dropdown --}}
                    <div class="relative group">
                        <button class="rounded-md px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-white/10 flex items-center gap-1">
                            Info
                            <svg class="h-3 w-3 transition-transform group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="nav-dropdown absolute top-full left-0 mt-1 w-56 rounded-lg border border-gray-100 bg-white p-2 shadow-lg">
                            <div class="nav-dropdown-item"><a href="{{ url('/artikel') }}" class="nav-dropdown-link rounded-md px-4 py-2.5 text-sm text-text-body hover:text-primary">Artikel</a></div>
                            <div class="nav-dropdown-item"><a href="{{ url('/pengumuman-kelulusan') }}" class="nav-dropdown-link rounded-md px-4 py-2.5 text-sm text-text-body hover:text-primary">Cek Kelulusan</a></div>
                            <div class="nav-dropdown-item"><a href="{{ url('/kontak') }}" class="nav-dropdown-link rounded-md px-4 py-2.5 text-sm text-text-body hover:text-primary">Kontak</a></div>
                        </div>
                    </div>

                    <a href="{{ url('/ppdb/daftar') }}" class="ml-4 inline-flex items-center gap-2 rounded-md bg-accent px-5 py-2 text-sm font-heading font-semibold text-text-heading transition-all duration-500 hover:bg-accent-light hover:shadow-lg active:scale-[0.97]">
                        Daftar PPDB
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </nav>

                {{-- Mobile hamburger --}}
                <button id="nav-toggle" class="flex items-center justify-center rounded-md p-2 text-white md:hidden" aria-label="Toggle navigation" aria-expanded="false">
                    <svg id="nav-icon-open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg id="nav-icon-close" class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu Overlay --}}
        <div id="nav-mobile-overlay" class="nav-mobile-overlay" onclick="closeMobileMenu()"></div>

        {{-- Mobile Menu Slide-in Panel --}}
        <div id="nav-mobile-panel" class="nav-mobile-panel">
            <div class="flex items-center justify-between px-6 pt-5 pb-2">
                <span class="font-heading text-lg font-bold text-white">Menu</span>
                <button class="nav-mobile-close" onclick="closeMobileMenu()" aria-label="Tutup menu">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="mt-4 space-y-1 px-4">
                <a href="{{ url('/') }}" class="block rounded-md px-4 py-3 text-sm font-medium text-white/90 transition-colors hover:bg-white/10" onclick="closeMobileMenu()">Beranda</a>

                {{-- Profil mobile --}}
                <div class="nav-mobile-section">
                    <div class="nav-mobile-section-header" onclick="toggleMobileSection(this)">
                        Profil Sekolah
                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                    <div class="hidden space-y-1 pb-2">
                        <a href="{{ url('/profil') }}" class="block rounded-md px-8 py-2 text-sm text-white/70 transition-colors hover:bg-white/10 hover:text-white" onclick="closeMobileMenu()">Sekilas Profil</a>
                        <a href="{{ url('/profil/sejarah') }}" class="block rounded-md px-8 py-2 text-sm text-white/70 transition-colors hover:bg-white/10 hover:text-white" onclick="closeMobileMenu()">Sejarah &amp; Visi Misi</a>
                        <a href="{{ url('/profil/struktur-organisasi') }}" class="block rounded-md px-8 py-2 text-sm text-white/70 transition-colors hover:bg-white/10 hover:text-white" onclick="closeMobileMenu()">Struktur Organisasi</a>
                        <a href="{{ url('/profil/guru') }}" class="block rounded-md px-8 py-2 text-sm text-white/70 transition-colors hover:bg-white/10 hover:text-white" onclick="closeMobileMenu()">Guru &amp; Tenaga Pengajar</a>
                    </div>
                </div>

                {{-- Jurusan mobile --}}
                <div class="nav-mobile-section">
                    <div class="nav-mobile-section-header" onclick="toggleMobileSection(this)">
                        Jurusan
                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                    <div class="hidden space-y-1 pb-2">
                        @foreach($jurusans as $j)
                        <a href="{{ url('/jurusan/' . $j->slug) }}" class="block rounded-md px-8 py-2 text-sm text-white/70 transition-colors hover:bg-white/10 hover:text-white" onclick="closeMobileMenu()">{{ $j->nama }}</a>
                        @endforeach
                    </div>
                </div>

                {{-- Kegiatan mobile --}}
                <div class="nav-mobile-section">
                    <div class="nav-mobile-section-header" onclick="toggleMobileSection(this)">
                        Kegiatan
                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                    <div class="hidden space-y-1 pb-2">
                        <a href="{{ url('/prestasi') }}" class="block rounded-md px-8 py-2 text-sm text-white/70 transition-colors hover:bg-white/10 hover:text-white" onclick="closeMobileMenu()">Prestasi</a>
                        <a href="{{ url('/ekstrakurikuler') }}" class="block rounded-md px-8 py-2 text-sm text-white/70 transition-colors hover:bg-white/10 hover:text-white" onclick="closeMobileMenu()">Ekstrakurikuler</a>
                        <a href="{{ url('/galeri') }}" class="block rounded-md px-8 py-2 text-sm text-white/70 transition-colors hover:bg-white/10 hover:text-white" onclick="closeMobileMenu()">Galeri</a>
                    </div>
                </div>

                {{-- PPDB mobile --}}
                <div class="nav-mobile-section">
                    <div class="nav-mobile-section-header" onclick="toggleMobileSection(this)">
                        PPDB
                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                    <div class="hidden space-y-1 pb-2">
                        <a href="{{ url('/ppdb') }}" class="block rounded-md px-8 py-2 text-sm text-white/70 transition-colors hover:bg-white/10 hover:text-white" onclick="closeMobileMenu()">Info &amp; Jadwal</a>
                        <a href="{{ url('/ppdb/daftar') }}" class="block rounded-md px-8 py-2 text-sm text-white/70 transition-colors hover:bg-white/10 hover:text-white" onclick="closeMobileMenu()">Form Pendaftaran</a>
                        <a href="{{ url('/ppdb/status') }}" class="block rounded-md px-8 py-2 text-sm text-white/70 transition-colors hover:bg-white/10 hover:text-white" onclick="closeMobileMenu()">Cek Status</a>
                    </div>
                </div>

                {{-- Info mobile --}}
                <div class="nav-mobile-section">
                    <div class="nav-mobile-section-header" onclick="toggleMobileSection(this)">
                        Info
                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                    <div class="hidden space-y-1 pb-2">
                        <a href="{{ url('/artikel') }}" class="block rounded-md px-8 py-2 text-sm text-white/70 transition-colors hover:bg-white/10 hover:text-white" onclick="closeMobileMenu()">Artikel</a>
                        <a href="{{ url('/pengumuman-kelulusan') }}" class="block rounded-md px-8 py-2 text-sm text-white/70 transition-colors hover:bg-white/10 hover:text-white" onclick="closeMobileMenu()">Cek Kelulusan</a>
                        <a href="{{ url('/kontak') }}" class="block rounded-md px-8 py-2 text-sm text-white/70 transition-colors hover:bg-white/10 hover:text-white" onclick="closeMobileMenu()">Kontak</a>
                    </div>
                </div>

                <div class="pt-4 pb-8 px-4">
                    <a href="{{ url('/ppdb/daftar') }}" class="flex w-full items-center justify-center gap-2 rounded-md bg-accent px-5 py-3 font-heading font-semibold text-text-heading transition-all duration-500 hover:bg-accent-light hover:shadow-lg" onclick="closeMobileMenu()">
                        Daftar PPDB
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main id="main-content">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-primary text-white">
        <div class="container-page py-16">
            <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-4">
                {{-- Logo & Description --}}
                <div class="space-y-5">
                    <h3 class="font-heading text-2xl font-semibold text-white">
                        @if($settings->logo_url)
                            <img src="{{ $settings->logo_url }}" alt="{{ $settings->school_name }}" class="mb-3 h-12 w-auto">
                        @endif
                        {{ $settings->school_name }}
                    </h3>
                    <p class="text-sm leading-relaxed text-white/70">{{ $settings->description }}</p>
                    <div class="flex gap-3">
                        @if($settings->facebook_url)
                        <a href="{{ $settings->facebook_url }}" target="_blank" rel="noopener" class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-white transition-colors hover:bg-accent hover:text-primary">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                        </a>
                        @endif
                        @if($settings->instagram_url)
                        <a href="{{ $settings->instagram_url }}" target="_blank" rel="noopener" class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-white transition-colors hover:bg-accent hover:text-primary">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                        @endif
                        @if($settings->youtube_url)
                        <a href="{{ $settings->youtube_url }}" target="_blank" rel="noopener" class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-white transition-colors hover:bg-accent hover:text-primary">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        @endif
                    </div>
                </div>

                {{-- Navigasi --}}
                <div>
                    <h3 class="mb-6 font-heading text-2xl font-semibold text-white">Navigasi</h3>
                    <ul class="space-y-3 text-sm text-white/70">
                        <li><a href="{{ url('/') }}" class="transition-colors hover:text-white">Beranda</a></li>
                        <li><a href="{{ url('/profil') }}" class="transition-colors hover:text-white">Profil Sekolah</a></li>
                        <li><a href="{{ url('/ppdb') }}" class="transition-colors hover:text-white">PPDB</a></li>
                        <li><a href="{{ url('/artikel') }}" class="transition-colors hover:text-white">Artikel</a></li>
                        <li><a href="{{ url('/galeri') }}" class="transition-colors hover:text-white">Galeri</a></li>
                        <li><a href="{{ url('/prestasi') }}" class="transition-colors hover:text-white">Prestasi</a></li>
                        <li><a href="{{ url('/pengumuman-kelulusan') }}" class="transition-colors hover:text-white">Cek Kelulusan</a></li>
                    </ul>
                </div>

                {{-- Jurusan --}}
                <div>
                    <h3 class="mb-6 font-heading text-2xl font-semibold text-white">Jurusan</h3>
                    <ul class="space-y-3 text-sm text-white/70">
                        @foreach($jurusans as $j)
                        <li><a href="{{ url('/jurusan/' . $j->slug) }}" class="transition-colors hover:text-white">{{ $j->nama }}</a></li>
                        @endforeach
                    </ul>
                </div>

                {{-- Kontak --}}
                <div>
                    <h3 class="mb-6 font-heading text-2xl font-semibold text-white">Kontak</h3>
                    <ul class="space-y-4 text-sm text-white/70">
                        <li class="flex items-start gap-3">
                            <svg class="mt-0.5 h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>{{ $settings->address }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span>{{ $settings->phone }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <a href="mailto:{{ $settings->email }}" class="transition-colors hover:text-white">{{ $settings->email }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Copyright --}}
        <div class="bg-primary-dark">
            <div class="container-page flex flex-col items-center justify-between gap-2 py-5 text-sm text-white/60 md:flex-row">
                <p>&copy; {{ date('Y') }} {{ $settings->school_name }}. All rights reserved.</p>
                <p>Dibangun dengan <span class="text-accent">❤</span> oleh Tim SMK Al Hidayah 1 Jakarta</p>
            </div>
        </div>
    </footer>

    {{-- Scroll to top button --}}
    <button id="scroll-top" class="pointer-events-none fixed bottom-6 right-6 z-40 flex h-12 w-12 items-center justify-center rounded-md bg-primary text-white shadow-lg opacity-0 transition-all duration-300 hover:bg-primary-light focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
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
        let ticking = false;

        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    const scrollY = window.scrollY;

                    if (scrollY > 100) {
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

                    ticking = false;
                });
                ticking = true;
            }
        });

        // Mobile menu slide-in
        const navToggle = document.getElementById('nav-toggle');
        const navOverlay = document.getElementById('nav-mobile-overlay');
        const navPanel = document.getElementById('nav-mobile-panel');
        const navIconOpen = document.getElementById('nav-icon-open');
        const navIconClose = document.getElementById('nav-icon-close');

        function openMobileMenu() {
            navOverlay.classList.add('open');
            navPanel.classList.add('open');
            navIconOpen.classList.add('hidden');
            navIconClose.classList.remove('hidden');
            navToggle.setAttribute('aria-expanded', 'true');
            document.body.style.overflow = 'hidden';
        }

        function closeMobileMenu() {
            navOverlay.classList.remove('open');
            navPanel.classList.remove('open');
            navIconOpen.classList.remove('hidden');
            navIconClose.classList.add('hidden');
            navToggle.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
        }

        navToggle.addEventListener('click', () => {
            const isOpen = navPanel.classList.contains('open');
            if (isOpen) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && navPanel.classList.contains('open')) {
                closeMobileMenu();
            }
        });

        // Mobile section accordion
        function toggleMobileSection(header) {
            const content = header.nextElementSibling;
            const isOpen = !content.classList.contains('hidden');
            content.classList.toggle('hidden', isOpen);
            header.classList.toggle('active', !isOpen);
        }
    </script>
    @endpush

    @stack('scripts')
</body>
</html>
