@extends('layouts.app')

@section('title', 'Struktur Organisasi — SMK Alhidayah')

@section('content')
{{-- ============================================ --}}
{{-- HERO SECTION --}}
{{-- ============================================ --}}
<section class="relative overflow-hidden bg-primary-dark">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-r from-primary/95 via-primary/90 to-primary-dark/95"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTUwIDB2MTAwTTAgNTBoMTAwIiBzdHJva2U9InJnYmEoMjU1LDI1NSwyNTUsMC4wMykiIHN0cm9rZS13aWR0aD0iMSIvPjwvc3ZnPg==')] opacity-40"></div>
    </div>

    <div class="absolute -top-20 -right-20 h-80 w-80 rounded-full bg-accent/5 blur-3xl"></div>
    <div class="absolute -bottom-20 -left-20 h-96 w-96 rounded-full bg-white/[0.03] blur-3xl"></div>

    <div class="container-page relative py-36 md:py-44">
        <div class="mx-auto max-w-4xl text-center">
            <div class="section-title-tag justify-center mb-4">
                <span class="text-accent">Profil</span>
            </div>

            <h1 class="font-heading text-5xl font-bold leading-tight text-white md:text-6xl lg:text-7xl lg:leading-[1.1]">
                Struktur<br>
                <span class="text-accent">Organisasi</span>
            </h1>

            <p class="mx-auto mt-6 max-w-2xl text-lg text-white/75 md:text-xl">
                Struktur kepengurusan SMK Alhidayah yang solid dan profesional dalam mengelola pendidikan.
            </p>
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- STRUKTUR CHART --}}
{{-- ============================================ --}}
<section class="section-padding">
    <div class="container-page">
        <div class="section-title">
            <div class="section-title-tag justify-center">
                <span class="h-2 w-2 rounded-full bg-accent"></span>
                @include('partials.ornaments', ['type' => 'heading-accent', 'color' => 'accent'])
                Bagan Organisasi
            </div>
            <h2 class="section-title-heading">Struktur Kepengurusan<br>SMK Alhidayah</h2>
            <p class="section-title-text">Berikut adalah struktur organisasi SMK Alhidayah tahun ajaran {{ date('Y') }}/{{ date('Y') + 1 }}</p>
        </div>

        {{-- Kepala Sekolah --}}
        <div class="flex justify-center mb-12">
            <div class="card-hover text-center w-72">
                <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-gradient-to-br from-primary to-primary-light shadow-lg">
                    <svg class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <h3 class="font-heading text-lg font-bold text-text-heading">Kepala Sekolah</h3>
                <p class="text-sm text-text-body/60 mt-1">Drs. H. Ahmad Fauzi, M.Pd.</p>
                <div class="mt-3 h-1 w-16 mx-auto rounded-full bg-gradient-to-r from-primary to-accent"></div>
            </div>
        </div>

        {{-- Connector line --}}
        <div class="mx-auto mb-12 flex justify-center">
            <div class="h-10 w-0.5 bg-gradient-to-b from-primary/40 to-accent/40"></div>
        </div>

        {{-- Wakil --}}
        <div class="grid gap-6 md:grid-cols-3 mb-12">
            @php
                $wakil = [
                    ['icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', 'title' => 'Wakil Kepala Sekolah', 'name' => 'Hj. Siti Nurjanah, S.Pd.', 'color' => 'from-primary to-primary-light'],
                    ['icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => 'Kepala Tata Usaha', 'name' => 'Dedi Supriyadi, S.Kom.', 'color' => 'from-accent-dark to-accent'],
                    ['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'title' => 'Bendahara', 'name' => 'Dewi Sartika, S.E.', 'color' => 'from-primary-medium to-primary'],
                ];
            @endphp
            @foreach($wakil as $w)
            <div class="card-hover text-center">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br {{ $w['color'] }} shadow-md">
                    <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $w['icon'] }}"/>
                    </svg>
                </div>
                <h3 class="font-heading font-bold text-text-heading">{{ $w['title'] }}</h3>
                <p class="mt-1 text-sm text-text-body/60">{{ $w['name'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- Connector --}}
        <div class="mx-auto mb-12 flex justify-center">
            <div class="h-10 w-0.5 bg-gradient-to-b from-accent/40 to-primary/40"></div>
        </div>

        {{-- Kepala Jurusan --}}
        <div class="section-title mb-8">
            <div class="section-title-tag justify-center">
                <span class="h-2 w-2 rounded-full bg-accent"></span>
                @include('partials.ornaments', ['type' => 'heading-accent', 'color' => 'accent'])
                Unit Jurusan
            </div>
            <h3 class="font-heading text-2xl font-bold text-text-heading">Kepala Program Keahlian</h3>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-12">
            @php
                $kajur = [
                    ['title' => 'AKL', 'subtitle' => 'Akuntansi & Keuangan Lembaga', 'name' => 'Rina Marlina, S.Pd.', 'color' => 'bg-primary'],
                    ['title' => 'Pemasaran', 'subtitle' => 'Pemasaran & Bisnis Digital', 'name' => 'Agus Wijaya, S.E.', 'color' => 'bg-accent'],
                    ['title' => 'MPLB', 'subtitle' => 'Manajemen Perkantoran', 'name' => 'Sari Indah, S.Pd.', 'color' => 'bg-primary'],
                    ['title' => 'TJKT', 'subtitle' => 'Teknik Jaringan & Telekomunikasi', 'name' => 'Rudi Hartono, S.T.', 'color' => 'bg-accent'],
                ];
            @endphp
            @foreach($kajur as $k)
            <div class="card-hover overflow-hidden">
                <div class="{{ $k['color'] }} px-5 py-4 text-center">
                    <h4 class="font-heading text-lg font-bold text-white">{{ $k['title'] }}</h4>
                </div>
                <div class="p-5 text-center">
                    <p class="text-xs text-text-body/60">{{ $k['subtitle'] }}</p>
                    <p class="mt-2 text-sm font-semibold text-text-heading">{{ $k['name'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Guru --}}
        <div class="section-title mb-8">
            <div class="section-title-tag justify-center">
                <span class="h-2 w-2 rounded-full bg-accent"></span>
                @include('partials.ornaments', ['type' => 'heading-accent', 'color' => 'accent'])
                Pelaksana
            </div>
            <h3 class="font-heading text-2xl font-bold text-text-heading">Dewan Guru & Tenaga Pendidik</h3>
        </div>

        <div class="card-hover text-center max-w-xl mx-auto">
            <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-gradient-to-br from-primary to-primary-light shadow-lg">
                <svg class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <h3 class="font-heading text-lg font-bold text-text-heading">Seluruh Dewan Guru</h3>
            <p class="mt-2 text-sm text-text-body/60">40+ tenaga pendidik profesional dan berdedikasi</p>
            <p class="mt-2 text-sm text-text-body/70 leading-relaxed">
                Didukung oleh tenaga pengajar yang kompeten dan bersertifikasi di bidangnya masing-masing. 
                Lihat daftar lengkap guru di halaman <a href="{{ url('/profil/guru') }}" class="text-primary hover:underline font-semibold">Guru & Tenaga Pengajar</a>.
            </p>
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- CTA SECTION --}}
{{-- ============================================ --}}
<section class="relative z-10 pb-20">
    <div class="container-page">
        <div class="relative overflow-hidden rounded-md cta-gradient px-8 py-12 md:px-16 md:py-14">
            @include('partials.ornaments', ['type' => 'cta', 'color' => 'white'])
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNMjAgMHYyME0wIDIwaDIwIiBzdHJva2U9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiIHN0cm9rZS13aWR0aD0iMSIvPjwvc3ZnPg==')] opacity-50"></div>
            <div class="relative flex flex-col items-center justify-between gap-6 md:flex-row">
                <div>
                    <h2 class="font-heading text-3xl font-bold text-white md:text-4xl">Kenali Para Pendidik Kami</h2>
                    <p class="mt-2 text-white/85">Lihat profil lengkap guru dan tenaga pengajar SMK Alhidayah</p>
                </div>
                <a href="{{ url('/profil/guru') }}" class="theme-btn min-w-[160px] justify-center bg-white text-primary hover:bg-primary hover:text-white">
                    Lihat Guru
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
