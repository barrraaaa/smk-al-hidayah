@extends('layouts.app')

@php $settings = \App\Models\SchoolSetting::getSettings(); @endphp

@section('title', 'SMK Alhidayah — Sekolah Kejuruan Islam Modern')
@section('meta_description', 'SMK Alhidayah Jakarta — Sekolah Menengah Kejuruan Islam modern dengan 4 jurusan unggulan: AKL, Pemasaran, MPLB, dan TJKT. Daftar PPDB sekarang!')

@section('content')

{{-- ============================================ --}}
{{-- HERO SECTION --}}
{{-- ============================================ --}}
<section class="relative overflow-hidden bg-primary-dark">
    @if($settings->hero_image)
    <img src="{{ Storage::url($settings->hero_image) }}" alt="" class="absolute inset-0 h-full w-full object-cover">
    @endif
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-r {{ $settings->hero_image ? 'from-primary/65 via-primary/55 to-primary-dark/65' : 'from-primary/95 via-primary/90 to-primary-dark/95' }}"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTUwIDB2MTAwTTAgNTBoMTAwIiBzdHJva2U9InJnYmEoMjU1LDI1NSwyNTUsMC4wMykiIHN0cm9rZS13aWR0aD0iMSIvPjwvc3ZnPg==')] opacity-40"></div>
    </div>

    <div class="absolute -top-20 -right-20 h-80 w-80 rounded-full bg-accent/5 blur-3xl"></div>
    <div class="absolute -bottom-20 -left-20 h-96 w-96 rounded-full bg-white/[0.03] blur-3xl"></div>

    <div class="container-page relative py-36 md:py-52">
        <div class="mx-auto max-w-4xl text-center">
            <div class="section-title-tag justify-center mb-4">
                <span class="text-accent">SMK Al Hidayah 1 Jakarta</span>
            </div>

            <h1 class="font-heading text-5xl font-bold leading-tight text-white md:text-6xl lg:text-7xl lg:leading-[1.1]">
                Cetak Masa Depanmu di<br>
                <span class="text-accent">SMK Al Hidayah 1 Jakarta</span>
            </h1>

            <p class="mx-auto mt-6 max-w-2xl text-lg text-white/75 md:text-xl">
                Sekolah Menengah Kejuruan Islam modern dengan 4 jurusan unggulan.
                Membentuk generasi berakhlak mulia, kompeten, dan siap bersaing di dunia kerja.
            </p>

            <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row">
                <a href="{{ url('/ppdb') }}" class="theme-btn min-w-[180px] px-8 py-4 text-base bg-accent hover:bg-accent-dark">
                    Daftar PPDB
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                <a href="{{ url('/jurusan/' . ($jurusans->first()->slug ?? 'akl')) }}" class="btn-outline-white min-w-[180px] px-8 py-4 text-base">
                    Lihat Jurusan
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- FEATURED COUNTERS --}}
{{-- ============================================ --}}
<section class="overlap-section">
    <div class="container-page">
        <div class="rounded-md bg-[#2F443A] px-8 py-10 md:px-16 md:py-12">
            <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
                @php
                    $counters = [
                        ['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'value' => number_format($jurusans->sum('gurus_count') * 10 + 200), 'label' => 'Siswa Aktif'],
                        ['icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', 'value' => $jurusans->count(), 'label' => 'Jurusan Unggulan'],
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
{{-- WELCOME SECTION (dynamic from admin) --}}
{{-- ============================================ --}}
<section class="section-padding">
    <div class="container-page">
        <div class="grid items-center gap-10 md:grid-cols-2">
            <div>
                <div class="section-title-tag mb-4">
                    <span class="h-2 w-2 rounded-full bg-accent"></span>
                    @include('partials.ornaments', ['type' => 'heading-accent', 'color' => 'accent'])
                    Selamat Datang
                </div>
                <h2 class="font-heading text-3xl font-bold text-text-heading md:text-4xl">
                    {!! $settings->welcome_heading ?: 'Mengenal Lebih Dekat<br>SMK Al Hidayah 1 Jakarta' !!}
                </h2>
                <div class="mt-5 leading-relaxed text-text-body/80">
                    {!! $settings->welcome_text ?: '<p>SMK Al Hidayah 1 Jakarta adalah sebuah sekolah yang berada di bawah naungan Yayasan Islam YasMar Al Hidayah yang berlokasi di Jalan Bhakti No.25, RT 3 RW 7, Kelurahan Cilandak Timur, Kecamatan Pasar Minggu, Jakarta Selatan, 12560.</p>' !!}
                </div>

                @if($settings->welcome_advantages && count($settings->welcome_advantages) > 0)
                <div class="mt-8 space-y-5">
                    <div class="flex items-start gap-4">
                        <div>
                            <ol class="space-y-5">
                                @foreach($settings->welcome_advantages as $adv)
                                <li class="flex items-start gap-4">
                                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-primary/10">
                                        <svg class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-heading text-lg font-semibold text-text-heading">{{ $adv['title'] }}</h4>
                                        <p class="mt-1 text-sm text-text-body/70">{{ $adv['description'] }}</p>
                                    </div>
                                </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div class="relative">
                @if($settings->welcome_image)
                <img src="{{ Storage::url($settings->welcome_image) }}" alt="SMK Alhidayah" class="mx-auto w-full rounded-xl shadow-lg ring-1 ring-gray-100">
                @else
                <div class="flex aspect-[4/3] w-full items-center justify-center rounded-xl bg-gradient-to-br from-primary/10 to-accent/10 shadow-lg ring-1 ring-gray-100">
                    <div class="text-center">
                        <div class="mx-auto mb-4 flex h-24 w-24 items-center justify-center rounded-full bg-primary/20">
                            <svg class="h-12 w-12 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <p class="text-sm text-text-body/60">Gedung SMK Alhidayah</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- JURUSAN SECTION (dynamic from DB) --}}
{{-- ============================================ --}}
<section class="section-padding bg-surface-alt">
    <div class="container-page">
        <div class="section-title">
            <div class="section-title-tag justify-center">
                <span class="h-2 w-2 rounded-full bg-accent"></span>
                @include('partials.ornaments', ['type' => 'heading-accent', 'color' => 'accent'])
                Program Keahlian
            </div>
            <h2 class="section-title-heading">Pilih Jurusan Favoritmu</h2>
            <p class="section-title-text">Empat jurusan unggulan dengan kurikulum berbasis industri dan tenaga pengajar profesional</p>
        </div>

        <div class="grid min-w-0 gap-6 md:grid-cols-2 lg:grid-cols-4">
            @forelse($jurusans as $j)
            <a href="{{ url('/jurusan/' . $j->slug) }}" class="group block min-w-0">
                <div class="card-hover overflow-hidden">
                    <div class="relative overflow-hidden bg-primary">
                        <div class="flex h-44 items-center justify-center transition-all duration-500 group-hover:scale-105 group-hover:opacity-70">
                            <span class="font-heading text-5xl font-bold text-white/20 truncate px-4 max-w-full">{{ $j->nama }}</span>
                        </div>
                        <div class="absolute left-5 -bottom-7 flex h-14 w-14 items-center justify-center rounded-full bg-white shadow-md">
                            <span class="text-xl font-bold text-primary">{{ substr($j->nama, 0, 1) }}</span>
                        </div>
                    </div>

                    <div class="px-5 pb-6 pt-10">
                        <h3 class="font-heading text-lg font-semibold text-text-heading group-hover:text-primary transition-colors">{{ $j->nama }}</h3>
                        <p class="mt-2 text-sm text-text-body/70 line-clamp-2">{{ $j->deskripsi }}</p>

                        @if($j->kepalaJurusan)
                        <div class="mt-4 flex items-center gap-3 border-b border-border pb-4 min-w-0">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-primary/10 text-xs font-bold text-primary">
                                {{ substr($j->kepalaJurusan->nama, 0, 1) }}
                            </div>
                            <div class="min-w-0">
                                <div class="text-sm font-semibold text-text-heading truncate">{{ $j->kepalaJurusan->nama }}</div>
                                <div class="text-xs text-text-body/60">Kepala Jurusan</div>
                            </div>
                        </div>
                        @endif

                        <div class="mt-4 flex items-center justify-between gap-2">
                            <span class="text-sm font-semibold text-primary shrink-0">SPP: Gratis</span>
                            <span class="theme-btn-sm text-xs shrink-0">
                                Lihat Detail
                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full text-center py-10 text-text-body/60">
                Belum ada jurusan yang tersedia.
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- CTA SECTION --}}
{{-- ============================================ --}}
<section class="relative z-10">
    <div class="container-page">
        <div class="relative overflow-hidden rounded-md cta-gradient px-8 py-12 md:px-16 md:py-14">
            @include('partials.ornaments', ['type' => 'cta', 'color' => 'white'])
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
{{-- PARTNER SECTION (dynamic from DB) --}}
{{-- ============================================ --}}
@if($partners->count() > 0)
<section class="section-padding bg-surface-alt">
    <div class="container-page">
        <div class="section-title">
            <div class="section-title-tag justify-center">
                <span class="h-2 w-2 rounded-full bg-accent"></span>
                @include('partials.ornaments', ['type' => 'heading-accent', 'color' => 'accent'])
                Mitra & Rekanan
            </div>
            <h2 class="section-title-heading">Yang Telah Mempercayai Kami</h2>
            <p class="section-title-text">Bermitra dengan berbagai institusi, perusahaan, dan organisasi terkemuka</p>
        </div>

        <div class="partner-grid mx-auto grid max-w-5xl grid-cols-2 items-center justify-items-center gap-8 sm:grid-cols-3 md:grid-cols-4 lg:gap-12">
            @foreach($partners as $p)
            <a href="{{ $p->url ?: '#' }}" target="{{ $p->url ? '_blank' : '_self' }}" rel="{{ $p->url ? 'noopener noreferrer' : '' }}" class="partner-logo group flex h-24 w-full max-w-[160px] items-center justify-center transition-all duration-500 hover:scale-105" title="{{ $p->nama }}">
                <img src="{{ Storage::url($p->logo) }}" alt="{{ $p->nama }}" class="partner-logo-img max-h-full max-w-full object-contain transition-all duration-500" loading="lazy">
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ============================================ --}}
{{-- PRESTASI SECTION (dynamic from DB) --}}
{{-- ============================================ --}}
@if($prestasi->count() > 0)
<section class="section-padding pt-32">
    <div class="container-sm">
        <div class="section-title">
            <div class="section-title-tag justify-center">
                <span class="h-2 w-2 rounded-full bg-accent"></span>
                @include('partials.ornaments', ['type' => 'heading-accent', 'color' => 'accent'])
                Prestasi Terbaru
            </div>
            <h2 class="section-title-heading">Prestasi Siswa<br>SMK Alhidayah</h2>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3">
            @foreach($prestasi as $p)
            <div class="card-hover group overflow-hidden text-center">
                <div class="relative mx-auto mb-4 h-32 w-32 overflow-hidden rounded-full bg-gradient-to-br from-primary to-primary-light">
                    @if($p->foto)
                    <img src="{{ asset('storage/' . $p->foto) }}" alt="{{ $p->judul }}" class="h-full w-full object-cover">
                    @else
                    <div class="flex h-full items-center justify-center text-3xl font-bold text-white">
                        🏆
                    </div>
                    @endif
                </div>
                <h3 class="font-heading font-semibold text-text-heading group-hover:text-primary">{{ $p->judul }}</h3>
                <p class="mt-2 text-xs text-text-body/60">{{ $p->jurusan?->nama }} • {{ $p->tanggal?->format('d M Y') }}</p>
                <p class="mt-2 text-sm text-text-body/70 line-clamp-2">{{ $p->deskripsi }}</p>
            </div>
            @endforeach
        </div>

        @if($prestasi->count() >= 3)
        <div class="mt-10 text-center">
            <a href="{{ url('/prestasi') }}" class="theme-btn">
                Lihat Semua Prestasi
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
        @endif
    </div>
</section>
@endif

{{-- ============================================ --}}
{{-- GURU SECTION (dynamic from DB) --}}
{{-- ============================================ --}}
<section class="section-padding {{ $prestasi->count() > 0 ? '' : 'pt-32' }}">
    <div class="container-sm">
        <div class="section-title">
            <div class="section-title-tag justify-center">
                <span class="h-2 w-2 rounded-full bg-accent"></span>
                @include('partials.ornaments', ['type' => 'heading-accent', 'color' => 'accent'])
                Tenaga Pengajar
            </div>
            <h2 class="section-title-heading">Guru Profesional Kami</h2>
            <p class="section-title-text">Tenaga pendidik kompeten siap membimbing siswa</p>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @forelse($gurus as $g)
            <div class="group card-hover overflow-hidden text-center">
                <div class="relative mx-auto mb-4 h-32 w-32 overflow-hidden rounded-full bg-gradient-to-br from-primary to-primary-light">
                    @if($g->foto)
                    <img src="{{ asset('storage/' . $g->foto) }}" alt="{{ $g->nama }}" class="h-full w-full object-cover transition-all duration-500 group-hover:scale-110">
                    @else
                    <div class="flex h-full items-center justify-center text-3xl font-bold text-white transition-all duration-500 group-hover:scale-110">
                        {{ substr($g->nama, 0, 1) }}
                    </div>
                    @endif
                </div>
                <h3 class="font-heading font-semibold text-text-heading transition-colors group-hover:text-primary">{{ $g->nama }}</h3>
                <p class="mt-1 text-xs text-text-body/60">{{ $g->jabatan ?? $g->jurusan?->nama }}</p>
            </div>
            @empty
            <div class="col-span-full text-center py-10 text-text-body/60">
                Data guru belum tersedia.
            </div>
            @endforelse
        </div>

        <div class="mt-10 text-center">
            <a href="{{ url('/profil/guru') }}" class="theme-btn">
                Lihat Semua Guru
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- ARTIKEL SECTION (dynamic from DB) --}}
{{-- ============================================ --}}
@if($artikel->count() > 0)
<section class="section-padding bg-surface-alt">
    <div class="container-page">
        <div class="section-title">
            <div class="section-title-tag justify-center">
                <span class="h-2 w-2 rounded-full bg-accent"></span>
                @include('partials.ornaments', ['type' => 'heading-accent', 'color' => 'accent'])
                Berita Terbaru
            </div>
            <h2 class="section-title-heading">Artikel & Informasi<br>Dari Blog Kami</h2>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            @foreach($artikel as $a)
            <article class="group flex flex-col overflow-hidden rounded-xl bg-white shadow-sm transition-all duration-300 hover:shadow-md">
                {{-- Thumbnail --}}
                <a href="{{ url('/artikel/' . $a->slug) }}" class="relative block overflow-hidden">
                    @if($a->thumbnail)
                    <img src="{{ asset('storage/' . $a->thumbnail) }}" alt="{{ $a->judul }}" class="aspect-[16/10] w-full object-cover transition-all duration-500 group-hover:scale-105">
                    @else
                    <div class="flex aspect-[16/10] w-full items-center justify-center bg-gradient-to-br from-primary/20 to-accent/20 transition-all duration-500 group-hover:scale-105">
                        <svg class="h-16 w-16 text-primary/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                    @endif
                </a>

                {{-- Content --}}
                <div class="flex flex-1 flex-col px-5 pb-5 pt-4">
                    {{-- Kategori & Tanggal --}}
                    <div class="mb-3 flex items-center gap-3">
                        @if($a->kategori)
                        <span class="inline-block rounded bg-accent px-3 py-1 text-[11px] font-semibold uppercase tracking-wider text-text-heading">
                            {{ $a->kategori->nama }}
                        </span>
                        @endif
                        <span class="text-[11px] text-text-body/60">
                            {{ $a->published_at?->format('d M Y') ?? $a->created_at->format('d M Y') }}
                        </span>
                    </div>

                    {{-- Judul --}}
                    <h3 class="mb-4 font-heading text-base font-bold leading-snug text-text-heading transition-colors group-hover:text-primary line-clamp-2">
                        <a href="{{ url('/artikel/' . $a->slug) }}">{{ $a->judul }}</a>
                    </h3>

                    {{-- Contributor & Read More --}}
                    <div class="mt-auto flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="flex h-8 w-8 shrink-0 items-center justify-center overflow-hidden rounded-full bg-primary/10 text-xs font-bold text-primary">
                                @if($a->penulis_avatar)
                                <img src="{{ asset('storage/' . $a->penulis_avatar) }}" alt="{{ $a->penulis ?? 'Penulis' }}" class="h-full w-full object-cover">
                                @else
                                {{ substr($a->penulis ?? 'Admin', 0, 1) }}
                                @endif
                            </div>
                            <span class="text-sm font-medium text-text-body">{{ $a->penulis ?? 'Admin' }}</span>
                        </div>

                        <a href="{{ url('/artikel/' . $a->slug) }}" class="inline-flex items-center rounded-lg bg-black px-4 py-2 text-xs font-semibold text-white transition-all duration-300 hover:bg-gray-800">
                            Baca
                            <svg class="ml-1.5 h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
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
@endif

{{-- ============================================ --}}
{{-- CONTACT SECTION --}}
{{-- ============================================ --}}
<section class="section-padding {{ $artikel->count() > 0 ? '' : 'bg-surface-alt' }}">
    <div class="container-page">
        <div class="grid items-center gap-10 md:grid-cols-2">
            <div>
                <div class="section-title-tag mb-4">
                    <span class="h-2 w-2 rounded-full bg-accent"></span>
                    @include('partials.ornaments', ['type' => 'heading-accent', 'color' => 'accent'])
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
                        <span class="text-sm text-text-body">{{ $settings->address ?: 'Jl. Raya Contoh No. 123, Jakarta Selatan' }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-md bg-accent text-text-heading">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <span class="text-sm text-text-body">{{ $settings->phone ?: '(021) 1234-5678' }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-md bg-primary text-white">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <a href="mailto:{{ $settings->email }}" class="text-sm text-primary hover:underline">{{ $settings->email ?: 'info@smkalhidayah.sch.id' }}</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <h3 class="mb-5 font-heading text-xl font-semibold text-text-heading">Kirim Pesan</h3>
                <form action="{{ url('/kontak') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2">
                        <input type="text" name="nama" placeholder="Nama" class="input-field" required>
                        <input type="email" name="email" placeholder="Email" class="input-field" required>
                    </div>
                    <input type="text" name="no_telepon" placeholder="No. Telepon" class="input-field">
                    <textarea name="pesan" rows="4" placeholder="Pesan" class="input-field" required></textarea>
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
