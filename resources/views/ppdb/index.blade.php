@extends('layouts.app')

@php $settings = \App\Models\SchoolSetting::getSettings(); @endphp

@section('title', 'PPDB — Info Pendaftaran — ' . $settings->school_name)

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
                <span class="text-accent">PPDB {{ date('Y') }}/{{ date('Y') + 1 }}</span>
            </div>
            <h1 class="font-heading text-5xl font-bold leading-tight text-white md:text-6xl lg:text-7xl lg:leading-[1.1]">
                Penerimaan Peserta<br>
                <span class="text-accent">Didik Baru</span>
            </h1>
            <p class="mx-auto mt-6 max-w-2xl text-lg text-white/75 md:text-xl">
                Bergabunglah bersama SMK Alhidayah. Daftarkan diri Anda sekarang juga melalui 
                sistem PPDB online kami yang cepat, mudah, dan transparan.
            </p>
            <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row">
                <a href="{{ route('ppdb.daftar') }}" class="theme-btn min-w-[200px] px-8 py-4 text-base">
                    Daftar Sekarang
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                <a href="{{ route('ppdb.status') }}" class="btn-outline-white min-w-[200px] px-8 py-4 text-base">
                    Cek Status Pendaftaran
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- INFO JADWAL --}}
{{-- ============================================ --}}
@if($settings->ppdb_schedule)
<section class="section-padding">
    <div class="container-page">
        <div class="section-title">
            <div class="section-title-tag justify-center">
                <span class="h-2 w-2 rounded-full bg-accent"></span>
                Jadwal PPDB
            </div>
            <h2 class="section-title-heading">Jadwal Pendaftaran<br>{{ date('Y') }}/{{ date('Y') + 1 }}</h2>
        </div>

        <div class="mx-auto max-w-4xl prose prose-sm prose-headings:text-text-heading prose-p:text-text-body/70 max-w-none">
            {!! $settings->ppdb_schedule !!}
        </div>
    </div>
</section>
@endif

{{-- ============================================ --}}
{{-- JURUSAN TERSEDIA --}}
{{-- ============================================ --}}
<section class="section-padding bg-surface-alt">
    <div class="container-page">
        <div class="section-title">
            <div class="section-title-tag justify-center">
                <span class="h-2 w-2 rounded-full bg-accent"></span>
                Pilihan Jurusan
            </div>
            <h2 class="section-title-heading">Pilih Jurusan Impianmu</h2>
            <p class="section-title-text">Empat jurusan unggulan yang bisa kamu pilih</p>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            @foreach($jurusans as $j)
            <div class="card-hover group text-center">
                <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-gradient-to-br from-primary to-primary-light shadow-lg transition-all duration-500 group-hover:scale-110 group-hover:rotate-6">
                    <span class="text-2xl font-bold text-white">{{ substr($j->nama, 0, 1) }}</span>
                </div>
                <h3 class="font-heading text-lg font-bold text-text-heading">{{ $j->nama }}</h3>
                <p class="mt-1 text-sm text-text-body/70 line-clamp-2">{{ $j->deskripsi }}</p>
                <a href="{{ url('/jurusan/' . $j->slug) }}" class="mt-4 inline-flex items-center gap-1 text-sm font-semibold text-primary hover:underline">
                    Lihat Detail
                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- SYARAT & ALUR --}}
{{-- ============================================ --}}
<section class="section-padding">
    <div class="container-page">
        <div class="grid gap-10 lg:grid-cols-2">
            {{-- Syarat --}}
            <div>
                <div class="section-title-tag mb-4">
                    <span class="h-2 w-2 rounded-full bg-accent"></span>
                    Persyaratan
                </div>
                <h2 class="font-heading text-3xl font-bold text-text-heading md:text-4xl">Syarat<br>Pendaftaran</h2>
                @if($settings->ppdb_requirements)
                <div class="mt-6 prose prose-sm prose-headings:text-text-heading prose-p:text-text-body/70 prose-li:text-text-body/80 max-w-none">
                    {!! $settings->ppdb_requirements !!}
                </div>
                @else
                <p class="mt-6 text-text-body/70">Informasi persyaratan belum tersedia.</p>
                @endif
            </div>

            {{-- Alur --}}
            <div>
                <div class="section-title-tag mb-4">
                    <span class="h-2 w-2 rounded-full bg-accent"></span>
                    Alur PPDB
                </div>
                <h2 class="font-heading text-3xl font-bold text-text-heading md:text-4xl">Cara Daftar<br>Online</h2>
                <div class="mt-6 space-y-6">
                    @php $alur = [
                        ['num' => '1', 'title' => 'Daftar Online', 'desc' => 'Isi formulir pendaftaran online dengan data diri lengkap dan pilih jurusan.', 'color' => 'bg-primary text-white'],
                        ['num' => '2', 'title' => 'Upload Dokumen', 'desc' => 'Unggah dokumen persyaratan (ijazah, KK, pas foto, akta) dalam format PDF/JPG.', 'color' => 'bg-accent text-text-heading'],
                        ['num' => '3', 'title' => 'Pembayaran', 'desc' => 'Lakukan pembayaran biaya pendaftaran ke rekening yang telah ditentukan.', 'color' => 'bg-primary text-white'],
                        ['num' => '4', 'title' => 'Verifikasi', 'desc' => 'Tim PPDB akan memverifikasi berkas dan pembayaran Anda.', 'color' => 'bg-accent text-text-heading'],
                        ['num' => '5', 'title' => 'Pengumuman', 'desc' => 'Hasil seleksi akan diumumkan melalui website dan di sekolah.', 'color' => 'bg-primary text-white'],
                    ]; @endphp
                    @foreach($alur as $a)
                    <div class="flex items-start gap-5">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full {{ $a['color'] }} shadow-sm font-heading text-lg font-bold">
                            {{ $a['num'] }}
                        </div>
                        <div>
                            <h3 class="font-heading font-semibold text-text-heading">{{ $a['title'] }}</h3>
                            <p class="mt-1 text-sm text-text-body/70">{{ $a['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- BIAYA --}}
{{-- ============================================ --}}
@if($settings->ppdb_fee)
<section class="section-padding bg-surface-alt">
    <div class="container-page">
        <div class="section-title">
            <div class="section-title-tag justify-center">
                <span class="h-2 w-2 rounded-full bg-accent"></span>
                Informasi Biaya
            </div>
            <h2 class="section-title-heading">Biaya<br>Pendaftaran</h2>
            <p class="section-title-text">Biaya pendaftaran PPDB tahun ini</p>
        </div>

        <div class="mx-auto max-w-sm">
            <div class="card-hover text-center">
                <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-primary/10 text-primary">
                    <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                    </svg>
                </div>
                <h3 class="font-heading font-semibold text-text-heading">Biaya Pendaftaran</h3>
                <p class="mt-2 text-3xl font-bold text-primary">{{ $settings->ppdb_fee }}</p>
            </div>
        </div>
    </div>
</section>
@endif

{{-- ============================================ --}}
{{-- CTA --}}
{{-- ============================================ --}}
<section class="relative z-10 pb-20">
    <div class="container-page">
        <div class="relative overflow-hidden rounded-md cta-gradient px-8 py-12 md:px-16 md:py-14">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNMjAgMHYyME0wIDIwaDIwIiBzdHJva2U9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiIHN0cm9rZS13aWR0aD0iMSIvPjwvc3ZnPg==')] opacity-50"></div>
            <div class="relative flex flex-col items-center justify-between gap-6 md:flex-row">
                <div>
                    <h2 class="font-heading text-3xl font-bold text-white md:text-4xl">Siap Daftar?</h2>
                    <p class="mt-2 text-white/85">Jangan lewatkan kesempatan bergabung dengan SMK Alhidayah</p>
                </div>
                <a href="{{ route('ppdb.daftar') }}" class="theme-btn min-w-[200px] justify-center bg-white text-primary hover:bg-primary hover:text-white">
                    Daftar Sekarang
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
