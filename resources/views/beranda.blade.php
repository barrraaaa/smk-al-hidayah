@extends('layouts.app')

@section('title', 'SMK Alhidayah — Sekolah Kejuruan Islam Modern')

@section('content')

{{-- ============================================ --}}
{{-- HERO SECTION (Slider One style) --}}
{{-- ============================================ --}}
<section class="relative overflow-hidden bg-primary-dark">
    {{-- Background overlay --}}
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-r from-primary/95 via-primary/90 to-primary-dark/95"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTUwIDB2MTAwTTAgNTBoMTAwIiBzdHJva2U9InJnYmEoMjU1LDI1NSwyNTUsMC4wMykiIHN0cm9rZS13aWR0aD0iMSIvPjwvc3ZnPg==')] opacity-40"></div>
    </div>

    {{-- Decorative circles --}}
    <div class="absolute -top-20 -right-20 h-80 w-80 rounded-full bg-accent/5 blur-3xl"></div>
    <div class="absolute -bottom-20 -left-20 h-96 w-96 rounded-full bg-white/[0.03] blur-3xl"></div>

    <div class="container-page relative py-44 md:py-52">
        <div class="mx-auto max-w-4xl text-center">
            {{-- Section tag --}}
            <div class="section-title-tag justify-center mb-4">
                <span class="text-accent">SMK Alhidayah</span>
            </div>

            {{-- Heading --}}
            <h1 class="font-heading text-5xl font-bold leading-tight text-white md:text-6xl lg:text-7xl lg:leading-[1.1]">
                Cetak Masa Depanmu di
                <span class="text-accent">SMK Alhidayah</span>
            </h1>

            {{-- Subtext --}}
            <p class="mx-auto mt-6 max-w-2xl text-lg text-white/75 md:text-xl">
                Sekolah Menengah Kejuruan Islam modern dengan 4 jurusan unggulan.
                Membentuk generasi berakhlak mulia, kompeten, dan siap bersaing di dunia kerja.
            </p>

            {{-- Buttons --}}
            <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row">
                <a href="{{ url('/ppdb') }}" class="theme-btn min-w-[180px] px-8 py-4 text-base">
                    Daftar PPDB
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                <a href="{{ url('/jurusan/akl') }}" class="btn-outline-white min-w-[180px] px-8 py-4 text-base">
                    Lihat Jurusan
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- FEATURED COUNTERS (Featured One style) --}}
{{-- ============================================ --}}
<section class="overlap-section">
    <div class="container-page">
        <div class="rounded-md bg-[#2F443A] px-8 py-10 md:px-16 md:py-12">
            <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
                @php
                    $counters = [
                        ['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'value' => '500+', 'label' => 'Siswa Aktif'],
                        ['icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', 'value' => '4', 'label' => 'Jurusan Unggulan'],
                        ['icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'value' => '98%', 'label' => 'Lulusan Terserap'],
                        ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'value' => '15+', 'label' => 'Tahun Berkiprah'],
                    ];
                @endphp
                @foreach($counters as $c)
                <div class="text-center">
                    <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-accent text-text-heading transition-all duration-500 hover:rotate-y-180">
                        <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $c['icon'] }}"/>
                        </svg>
                    </div>
                    <div class="font-heading text-4xl font-bold text-white">{{ $c['value'] }}</div>
                    <div class="mt-1 text-sm text-white/80">{{ $c['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- WELCOME SECTION (Welcome One style) --}}
{{-- ============================================ --}}
<section class="section-padding">
    <div class="container-page">
        <div class="grid items-center gap-10 md:grid-cols-2">
            <div>
                <div class="section-title-tag mb-4">
                    <span class="h-2 w-2 rounded-full bg-accent"></span>
                    Selamat Datang
                </div>
                <h2 class="font-heading text-3xl font-bold text-text-heading md:text-4xl">Online Islamic School<br>At Home</h2>
                <p class="mt-5 leading-relaxed text-text-body/80">
                    Kami menyambut siswa-siswi untuk bergabung dengan SMK Alhidayah, 
                    sekolah kejuruan Islam modern yang menawarkan pendidikan berkualitas 
                    dengan kurikulum berbasis industri dan pembentukan karakter Islami.
                </p>
                <div class="mt-8 space-y-5">
                    <div class="flex items-start gap-4">
                        <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-primary/10">
                            <svg class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-heading text-lg font-semibold text-text-heading">Belajar Online di Rumah</h4>
                            <p class="mt-1 text-sm text-text-body/70">Fleksibel, aman, dan nyaman dengan sistem pembelajaran hybrid</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-accent/10">
                            <svg class="h-8 w-8 text-accent-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-heading text-lg font-semibold text-text-heading">Filosofi Islam & Al-Quran</h4>
                            <p class="mt-1 text-sm text-text-body/70">Pendidikan karakter berbasis nilai-nilai Islam yang terintegrasi</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-primary/10">
                            <svg class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-heading text-lg font-semibold text-text-heading">Pembelajaran Damai & Humanis</h4>
                            <p class="mt-1 text-sm text-text-body/70">Lingkungan belajar yang mendukung perdamaian dan kemanusiaan</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Image side --}}
            <div class="relative">
                <div class="relative overflow-hidden rounded-md bg-gradient-to-br from-primary/20 to-accent/20 p-8">
                    <div class="flex h-80 items-center justify-center">
                        <div class="text-center">
                            <div class="mx-auto mb-4 flex h-24 w-24 items-center justify-center rounded-full bg-primary/20">
                                <svg class="h-12 w-12 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <p class="text-sm text-text-body/60">Gambar Sekolah</p>
                        </div>
                    </div>
                </div>
                {{-- Years badge --}}
                <div class="absolute -bottom-4 -left-4 rounded-md bg-gradient-to-r from-primary-medium to-accent px-6 py-4 text-white shadow-lg">
                    <div class="font-heading text-2xl font-bold">15+</div>
                    <div class="text-xs text-white/80">Tahun Berkiprah</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- POPULAR COURSES / JURUSAN (Courses One style) --}}
{{-- ============================================ --}}
<section class="section-padding bg-surface-alt">
    <div class="container-page">
        <div class="section-title">
            <div class="section-title-tag justify-center">
                <span class="h-2 w-2 rounded-full bg-accent"></span>
                Program Keahlian
            </div>
            <h2 class="section-title-heading">Pilih Jurusan Favoritmu</h2>
            <p class="section-title-text">Empat jurusan unggulan dengan kurikulum berbasis industri dan tenaga pengajar profesional</p>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            @php
                $jurusan = [
                    [
                        'slug' => 'akl',
                        'name' => 'AKL',
                        'full' => 'Akuntansi & Keuangan Lembaga',
                        'lessons' => '24',
                        'weeks' => '96',
                        'enroll' => '120',
                        'teacher' => 'Bu Dewi Sartika',
                        'role' => 'Kepala Jurusan AKL',
                        'price' => 'Gratis',
                        'icon' => 'M9 7h6m0 10v-3m-3 3h.01M9 17h.01',
                    ],
                    [
                        'slug' => 'pemasaran',
                        'name' => 'Pemasaran',
                        'full' => 'Pemasaran & Bisnis Digital',
                        'lessons' => '24',
                        'weeks' => '96',
                        'enroll' => '95',
                        'teacher' => 'Pak Agus Wijaya',
                        'role' => 'Kepala Jurusan Pemasaran',
                        'price' => 'Gratis',
                        'icon' => 'M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z',
                    ],
                    [
                        'slug' => 'mplb',
                        'name' => 'MPLB',
                        'full' => 'Manajemen Perkantoran',
                        'lessons' => '24',
                        'weeks' => '96',
                        'enroll' => '88',
                        'teacher' => 'Bu Sari Indah',
                        'role' => 'Kepala Jurusan MPLB',
                        'price' => 'Gratis',
                        'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16',
                    ],
                    [
                        'slug' => 'tjkt',
                        'name' => 'TJKT',
                        'full' => 'Teknik Jaringan Komputer & Telekomunikasi',
                        'lessons' => '24',
                        'weeks' => '96',
                        'enroll' => '76',
                        'teacher' => 'Pak Rudi Hartono',
                        'role' => 'Kepala Jurusan TJKT',
                        'price' => 'Gratis',
                        'icon' => 'M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01',
                    ],
                ];
            @endphp
            @foreach($jurusan as $j)
            <a href="{{ url('/jurusan/' . $j['slug']) }}" class="group block">
                <div class="card-hover overflow-hidden">
                    {{-- Image area --}}
                    <div class="relative overflow-hidden bg-primary">
                        <div class="flex h-44 items-center justify-center transition-all duration-500 group-hover:scale-105 group-hover:opacity-70">
                            <svg class="h-16 w-16 text-white/40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="{{ $j['icon'] }}"/>
                            </svg>
                        </div>
                        {{-- Icon overlay --}}
                        <div class="absolute left-5 -bottom-7 flex h-14 w-14 items-center justify-center rounded-full bg-white shadow-md transition-all duration-500 group-hover:animate-icon-bounce">
                            <svg class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $j['icon'] }}"/>
                            </svg>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="px-5 pb-6 pt-10">
                        <h3 class="font-heading text-lg font-semibold text-text-heading group-hover:text-primary transition-colors">{{ $j['full'] }}</h3>

                        <ul class="course-meta-list">
                            <li>
                                {{ $j['lessons'] }}
                                <span>Pelajaran</span>
                            </li>
                            <li>
                                {{ $j['weeks'] }}
                                <span>Minggu</span>
                            </li>
                            <li>
                                {{ $j['enroll'] }}
                                <span>Siswa</span>
                            </li>
                        </ul>

                        <div class="flex items-center gap-3 border-b border-border pb-4">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-primary/10 text-xs font-bold text-primary">
                                {{ substr($j['teacher'], 4, 1) }}
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-text-heading">{{ $j['teacher'] }}</div>
                                <div class="text-xs text-text-body/60">{{ $j['role'] }}</div>
                            </div>
                        </div>

                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-sm font-semibold text-primary">SPP: {{ $j['price'] }}</span>
                            <span class="theme-btn-sm text-xs">
                                Lihat Detail
                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- CTA SECTION (Cta One style — green to gold gradient) --}}
{{-- ============================================ --}}
<section class="relative z-10">
    <div class="container-page">
        <div class="relative overflow-hidden rounded-md cta-gradient px-8 py-12 md:px-16 md:py-14">
            {{-- Decorative pattern --}}
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNMjAgMHYyME0wIDIwaDIwIiBzdHJva2U9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiIHN0cm9rZS13aWR0aD0iMSIvPjwvc3ZnPg==')] opacity-50"></div>
            <div class="relative flex flex-col items-center justify-between gap-6 md:flex-row">
                <div>
                    <h2 class="font-heading text-3xl font-bold text-white md:text-4xl">Siap Bergabung dengan Kami?</h2>
                    <p class="mt-2 text-white/85">Daftar sekarang dan jadilah bagian dari generasi unggul SMK Alhidayah</p>
                </div>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ url('/ppdb/daftar') }}" class="theme-btn min-w-[160px] justify-center bg-white text-primary hover:bg-primary hover:text-white">
                        Daftar Sekarang
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    <a href="{{ url('/ppdb') }}" class="btn-outline-white min-w-[140px] justify-center">
                        Info PPDB
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- WHAT WE OFFER (Institute / Service One style) --}}
{{-- ============================================ --}}
<section class="section-padding pt-32">
    <div class="container-sm">
        <div class="section-title">
            <div class="section-title-tag justify-center">
                <span class="h-2 w-2 rounded-full bg-accent"></span>
                Apa Yang Kami Tawarkan
            </div>
            <h2 class="section-title-heading">Layanan Efektif<br>Al-Quran & Bahasa Arab</h2>
            <p class="section-title-text">Layanan terbaik kami untuk mendukung pembelajaran siswa</p>
        </div>

        <div class="grid gap-6 md:grid-cols-3">
            @php
                $offers = [
                    ['icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => 'Kelas Quran Online', 'desc' => 'Pembelajaran Al-Quran dengan metode interaktif dan pengajar bersertifikasi internasional.'],
                    ['icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', 'title' => 'Kursus Tafseer', 'desc' => 'Pendalaman makna Al-Quran melalui kajian tafsir yang mudah dipahami dan relevan dengan kehidupan.'],
                    ['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'title' => 'Kami Hargai Siswa', 'desc' => 'Setiap siswa mendapatkan perhatian personal dan bimbingan khusus untuk mencapai potensi terbaik mereka.'],
                ];
            @endphp
            @foreach($offers as $o)
            <div class="card-hover group relative overflow-hidden text-center">
                {{-- Bismillah decorative --}}
                <div class="absolute left-0 right-0 top-5 text-center text-3xl opacity-0 transition-all duration-500 group-hover:opacity-100">﷽</div>

                {{-- Hover gradient overlay --}}
                <div class="absolute inset-0 rounded-lg bg-gradient-to-b from-primary-light to-primary opacity-0 transition-all duration-500 group-hover:opacity-100 pointer-events-none"></div>

                <div class="relative z-10">
                    <div class="mx-auto mb-5 flex h-24 w-24 items-center justify-center rounded-full bg-accent text-text-heading border-2 border-text-heading transition-all duration-500 group-hover:rotate-y-180 group-hover:bg-white">
                        <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $o['icon'] }}"/>
                        </svg>
                    </div>
                    <h3 class="mb-3 font-heading text-lg font-semibold text-text-heading transition-colors group-hover:text-white">{{ $o['title'] }}</h3>
                    <p class="text-sm leading-relaxed text-text-body/70 transition-colors group-hover:text-white/90">{{ $o['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- WHY CHOOSE US (style: list with icons) --}}
{{-- ============================================ --}}
<section class="section-padding">
    <div class="container-page">
        <div class="grid items-center gap-10 md:grid-cols-2">
            <div>
                <div class="section-title-tag mb-4">
                    <span class="h-2 w-2 rounded-full bg-accent"></span>
                    Kenapa Pilih Kami
                </div>
                <h2 class="font-heading text-3xl font-bold text-text-heading md:text-4xl">Kenapa Pilih<br>SMK Alhidayah?</h2>

                <div class="mt-8 space-y-6">
                    @php
                        $whyus = [
                            ['icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', 'title' => 'Kurikulum Berbasis Industri', 'desc' => 'Kurikulum kami dirancang bersama mitra industri, memastikan lulusan siap kerja.'],
                            ['icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z', 'title' => 'Guru Profesional & Bersertifikasi', 'desc' => 'Tenaga pengajar berpengalaman dan bersertifikasi dalam bidangnya masing-masing.'],
                            ['icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z', 'title' => 'Lokasi Strategis', 'desc' => 'Berada di pusat kota dengan akses transportasi yang mudah dan lingkungan yang nyaman.'],
                            ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => 'Jam Fleksibel', 'desc' => 'Sistem pembelajaran yang fleksibel dengan jadwal yang mendukung kegiatan ekstrakurikuler.'],
                        ];
                    @endphp
                    @foreach($whyus as $w)
                    <div class="flex items-start gap-4">
                        <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-primary text-white transition-all duration-500 hover:rotate-y-180">
                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $w['icon'] }}"/>
                            </svg>
                        </div>
                        <div class="pt-2">
                            <h4 class="font-heading text-base font-semibold text-text-heading">{{ $w['title'] }}</h4>
                            <p class="mt-1 text-sm text-text-body/70">{{ $w['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Image placeholder --}}
            <div class="relative overflow-hidden rounded-md bg-gradient-to-br from-primary/15 to-accent/15 p-8">
                <div class="flex h-96 items-center justify-center">
                    <div class="text-center">
                        <div class="mx-auto mb-4 flex h-24 w-24 items-center justify-center rounded-full bg-primary/20">
                            <svg class="h-12 w-12 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <p class="text-sm text-text-body/60">Gambar Sekolah / Kegiatan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- TESTIMONIALS --}}
{{-- ============================================ --}}
<section class="section-padding bg-surface-alt">
    <div class="container-page">
        <div class="section-title">
            <div class="section-title-tag justify-center">
                <span class="h-2 w-2 rounded-full bg-accent"></span>
                Testimoni
            </div>
            <h2 class="section-title-heading">Dipercaya Ribuan Siswa<br>dan Wali Murid</h2>
        </div>

        <div class="grid gap-6 md:grid-cols-3">
            @php
                $testimonials = [
                    ['name' => 'Hafiz bin Usif', 'role' => 'Wali Murid', 'text' => 'Platform terbaik untuk belajar Al-Quran dan bahasa Arab untuk anak-anak. Cara mengajarnya sangat baik dan anak-anak merasa nyaman. Terima kasih SMK Alhidayah!', 'rating' => 5],
                    ['name' => 'Ibrahim klip', 'role' => 'Alumni', 'text' => 'Pengalaman belajar di SMK Alhidayah sangat berkesan. Guru-gurunya profesional dan fasilitasnya lengkap. Sangat merekomendasikan!', 'rating' => 5],
                    ['name' => 'Siti Aisyah', 'role' => 'Wali Murid', 'text' => 'Anak saya sangat senang bersekolah di sini. Pembelajaran agama dan umum berjalan seimbang. Prestasi akademiknya pun meningkat.', 'rating' => 5],
                ];
            @endphp
            @foreach($testimonials as $t)
            <div class="card relative">
                {{-- Rating --}}
                <div class="mb-4 inline-flex gap-1 rounded-md bg-accent/10 px-3 py-1.5">
                    @for($i = 0; $i < 5; $i++)
                    <svg class="h-4 w-4 text-accent" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    @endfor
                </div>

                {{-- Quote --}}
                <p class="mb-5 text-sm leading-relaxed text-text-body/80 italic">"{{ $t['text'] }}"</p>

                {{-- Author --}}
                <div class="flex items-center gap-3 border-t border-border pt-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-primary text-sm font-bold text-white">
                        {{ substr($t['name'], 0, 1) }}
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-text-heading">{{ $t['name'] }}</div>
                        <div class="text-xs text-text-body/60">{{ $t['role'] }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- OUR SCHOLARS / GURU (style: profile cards) --}}
{{-- ============================================ --}}
<section class="section-padding">
    <div class="container-sm">
        <div class="section-title">
            <div class="section-title-tag justify-center">
                <span class="h-2 w-2 rounded-full bg-accent"></span>
                Tenaga Pengajar
            </div>
            <h2 class="section-title-heading">Guru Profesional Kami</h2>
            <p class="section-title-text">Lulusan terbaik dari universitas ternama, siap membimbing siswa</p>
        </div>

        <div class="grid gap-6 md:grid-cols-4">
            @php
                $teachers = [
                    ['name' => 'Osama Gamal', 'role' => 'Guru Akuntansi', 'initial' => 'OG', 'color' => 'from-primary to-primary-light'],
                    ['name' => 'Ahmed Hany', 'role' => 'Guru Pemasaran', 'initial' => 'AH', 'color' => 'from-accent-dark to-accent'],
                    ['name' => 'Yusuf Samir', 'role' => 'Guru Perkantoran', 'initial' => 'YS', 'color' => 'from-primary-light to-primary-medium'],
                    ['name' => 'Aisyah Nur', 'role' => 'Guru Jaringan', 'initial' => 'AN', 'color' => 'from-primary-dark to-primary'],
                ];
            @endphp
            @foreach($teachers as $t)
            <div class="group card-hover overflow-hidden text-center">
                {{-- Image --}}
                <div class="relative mx-auto mb-4 h-32 w-32 overflow-hidden rounded-full bg-gradient-to-br {{ $t['color'] }}">
                    <div class="flex h-full items-center justify-center text-3xl font-bold text-white transition-all duration-500 group-hover:scale-110">
                        {{ $t['initial'] }}
                    </div>
                </div>

                <h3 class="font-heading font-semibold text-text-heading transition-colors group-hover:text-primary">{{ $t['name'] }}</h3>
                <p class="mt-1 text-xs text-text-body/60">{{ $t['role'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- BLOG / ARTIKEL (News One style) --}}
{{-- ============================================ --}}
<section class="section-padding bg-surface-alt">
    <div class="container-page">
        <div class="section-title">
            <div class="section-title-tag justify-center">
                <span class="h-2 w-2 rounded-full bg-accent"></span>
                Berita Terbaru
            </div>
            <h2 class="section-title-heading">Artikel & Informasi<br>Dari Blog Kami</h2>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            @php
                $artikel = [
                    ['title' => 'Kegiatan MPLS Tahun Ajaran 2026/2027 Berjalan Lancar', 'category' => 'Islam', 'date' => '15 Juli 2026', 'author' => 'Amir Khan'],
                    ['title' => 'Workshop Digital Marketing bersama Gojek Indonesia', 'category' => 'Islam', 'date' => '10 Juli 2026', 'author' => 'Amir Khan'],
                    ['title' => 'Pengumuman Hasil Seleksi PPDB Gelombang 1', 'category' => 'Islam', 'date' => '5 Juli 2026', 'author' => 'Amir Khan'],
                    ['title' => 'Kunjungan Industri Siswa TJKT ke Telkom Indonesia', 'category' => 'Islam', 'date' => '28 Juni 2026', 'author' => 'Amir Khan'],
                ];
            @endphp
            @foreach($artikel as $a)
            <article class="group overflow-hidden rounded-lg bg-white shadow-sm transition-all duration-300 hover:shadow-md">
                {{-- Image --}}
                <div class="relative overflow-hidden bg-gradient-to-br from-primary/20 to-accent/20">
                    <div class="flex h-48 items-center justify-center transition-all duration-500 group-hover:scale-105 group-hover:opacity-70">
                        <svg class="h-16 w-16 text-primary/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                </div>

                {{-- Content --}}
                <div class="p-5">
                    <ul class="mb-2 flex gap-4 text-xs text-text-body/60">
                        <li class="flex items-center gap-1">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            {{ $a['category'] }}
                        </li>
                        <li class="flex items-center gap-1">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $a['date'] }}
                        </li>
                    </ul>

                    <h3 class="font-heading font-semibold text-text-heading transition-colors group-hover:text-primary line-clamp-2">
                        {{ $a['title'] }}
                    </h3>

                    <div class="mt-4 flex items-center justify-between border-t border-border pt-4">
                        <div class="flex items-center gap-2">
                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-primary/10 text-xs font-bold text-primary">
                                {{ substr($a['author'], 0, 1) }}
                            </div>
                            <span class="text-xs text-text-body/70">{{ $a['author'] }}</span>
                        </div>
                        <span class="theme-btn-sm text-xs">
                            Baca
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </span>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <div class="mt-10 text-center">
            <a href="{{ url('/artikel') }}" class="theme-btn">
                Lihat Semua Artikel
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- GALLERY SECTION --}}
{{-- ============================================ --}}
<section class="section-padding">
    <div class="container-page">
        <div class="section-title">
            <div class="section-title-tag justify-center">
                <span class="h-2 w-2 rounded-full bg-accent"></span>
                Galeri
            </div>
            <h2 class="section-title-heading">Galeri Kegiatan<br>Sekolah Kami</h2>
        </div>

        <div class="grid gap-4 md:grid-cols-4">
            @for($i = 1; $i <= 4; $i++)
            <div class="group relative overflow-hidden rounded-md bg-gradient-to-br from-primary/10 to-accent/10">
                <div class="flex h-52 items-center justify-center transition-all duration-500 group-hover:scale-105">
                    <svg class="h-12 w-12 text-primary/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                {{-- Overlay on hover --}}
                <div class="absolute inset-0 flex items-center justify-center bg-primary/70 opacity-0 transition-all duration-300 group-hover:opacity-100">
                    <span class="text-white font-heading font-semibold">Lihat Foto</span>
                </div>
            </div>
            @endfor
        </div>

        <div class="mt-10 text-center">
            <a href="{{ url('/galeri') }}" class="theme-btn">
                Lihat Galeri
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- CONTACT SECTION --}}
{{-- ============================================ --}}
<section class="section-padding bg-surface-alt">
    <div class="container-page">
        <div class="grid items-center gap-10 md:grid-cols-2">
            <div>
                <div class="section-title-tag mb-4">
                    <span class="h-2 w-2 rounded-full bg-accent"></span>
                    Kontak
                </div>
                <h2 class="mb-4 font-heading text-3xl font-bold text-text-heading">Hubungi Kami</h2>
                <p class="mb-6 leading-relaxed text-text-body/80">
                    Punya pertanyaan tentang PPDB, jurusan, atau informasi lainnya?
                    Silakan hubungi kami melalui kontak di bawah ini.
                </p>

                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-md bg-primary text-white">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <span class="text-sm text-text-body">Jl. Raya Contoh No. 123, Jakarta Selatan</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-md bg-accent text-text-heading">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <span class="text-sm text-text-body">(021) 1234-5678</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-md bg-primary text-white">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <a href="mailto:info@smkalhidayah.sch.id" class="text-sm text-primary hover:underline">info@smkalhidayah.sch.id</a>
                    </div>
                </div>
            </div>

            {{-- Contact form --}}
            <div class="card">
                <h3 class="mb-5 font-heading text-xl font-semibold text-text-heading">Kirim Pesan</h3>
                <form class="space-y-4">
                    <div class="grid gap-4 sm:grid-cols-2">
                        <input type="text" placeholder="Nama" class="input-field" required>
                        <input type="email" placeholder="Email" class="input-field" required>
                    </div>
                    <input type="text" placeholder="Subjek" class="input-field" required>
                    <textarea rows="4" placeholder="Pesan" class="input-field" required></textarea>
                    <button type="submit" class="theme-btn w-full justify-center">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
