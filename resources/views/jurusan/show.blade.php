@extends('layouts.app')

@section('title', $jurusan->nama . ' — SMK Alhidayah')
@section('meta_description', $jurusan->deskripsi ? strip_tags($jurusan->deskripsi) : 'Pelajari program keahlian ' . $jurusan->nama . ' di SMK Alhidayah — prospek kerja, kurikulum, dan informasi lengkap.')

@section('content')
{{-- Hero --}}
<section class="bg-primary-dark relative overflow-hidden pt-32">
    <div class="absolute inset-0 bg-gradient-to-r from-primary/95 via-primary/90 to-primary-dark/95"></div>
    <div class="container-page relative py-20">
        {{-- Breadcrumb --}}
        <nav class="mb-6 flex items-center gap-2 text-sm text-white/60">
            <a href="{{ url('/') }}" class="hover:text-white transition-colors">Beranda</a>
            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-white">Jurusan</span>
            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-white">{{ $jurusan->nama }}</span>
        </nav>

        <div class="text-center">
            <div class="section-title-tag justify-center mb-4">
                <span class="text-accent">Jurusan</span>
            </div>
            <h1 class="font-heading text-4xl font-bold text-white md:text-5xl">{{ $jurusan->nama }}</h1>
            @if($jurusan->deskripsi)
            <p class="mx-auto mt-4 max-w-2xl text-white/75">{{ $jurusan->deskripsi }}</p>
            @endif
        </div>
    </div>
</section>

<div class="container-page py-16">
    <div class="grid gap-10 lg:grid-cols-[1fr_300px]">
        {{-- Main Content --}}
        <div>
            {{-- Profil Jurusan --}}
            <section class="card">
                <h2 class="font-heading text-2xl font-bold text-text-heading mb-4">Profil {{ $jurusan->nama }}</h2>
                <p class="leading-relaxed text-text-body/80">{{ $jurusan->deskripsi }}</p>
            </section>

            {{-- Kepala Jurusan --}}
            @if($jurusan->kepalaJurusan)
            <section class="card mt-6">
                <h2 class="font-heading text-2xl font-bold text-text-heading mb-6">Kepala Jurusan</h2>
                <div class="flex items-center gap-6">
                    <div class="h-24 w-24 shrink-0 overflow-hidden rounded-full bg-gradient-to-br from-primary to-primary-light">
                        @if($jurusan->kepalaJurusan->foto)
                        <img src="{{ asset('storage/' . $jurusan->kepalaJurusan->foto) }}" alt="{{ $jurusan->kepalaJurusan->nama }}" class="h-full w-full object-cover">
                        @else
                        <div class="flex h-full items-center justify-center text-3xl font-bold text-white">
                            {{ substr($jurusan->kepalaJurusan->nama, 0, 1) }}
                        </div>
                        @endif
                    </div>
                    <div>
                        <h3 class="font-heading text-xl font-semibold text-text-heading">{{ $jurusan->kepalaJurusan->nama }}</h3>
                        <p class="text-sm text-text-body/60">{{ $jurusan->kepalaJurusan->jabatan ?? 'Kepala Jurusan' }}</p>
                        @if($jurusan->kepalaJurusan->bio)
                        <p class="mt-2 text-sm text-text-body/70">{{ $jurusan->kepalaJurusan->bio }}</p>
                        @endif
                    </div>
                </div>
            </section>
            @endif

            {{-- Prospek Kerja --}}
            @if($jurusan->prospek_kerja)
            <section class="card mt-6">
                <h2 class="font-heading text-2xl font-bold text-text-heading mb-4">Prospek Kerja</h2>
                <ul class="space-y-3">
                    @foreach(explode("\n", $jurusan->prospek_kerja) as $prospek)
                    @if(trim($prospek))
                    <li class="flex items-start gap-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-text-body/80">{{ trim($prospek) }}</span>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </section>
            @endif

            {{-- Prestasi Jurusan --}}
            @if($jurusan->prestasis->count() > 0)
            <section class="card mt-6">
                <h2 class="font-heading text-2xl font-bold text-text-heading mb-4">Prestasi {{ $jurusan->nama }}</h2>
                <div class="grid gap-4 sm:grid-cols-2">
                    @foreach($jurusan->prestasis as $p)
                    <div class="flex items-start gap-3 p-3 rounded-lg bg-surface-alt">
                        <div class="text-2xl">🏆</div>
                        <div>
                            <h4 class="font-semibold text-text-heading text-sm">{{ $p->judul }}</h4>
                            <p class="text-xs text-text-body/60">{{ $p->tanggal?->format('d M Y') }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

            {{-- CTA --}}
            <div class="mt-10 rounded-md cta-gradient p-8 text-center">
                <h3 class="font-heading text-2xl font-bold text-white">Tertarik dengan {{ $jurusan->nama }}?</h3>
                <p class="mt-2 text-white/85">Daftar sekarang dan jadilah bagian dari jurusan ini</p>
                <a href="{{ url('/ppdb/daftar') }}" class="theme-btn mt-6 inline-flex bg-white text-primary hover:bg-primary hover:text-white">
                    Daftar PPDB {{ $jurusan->nama }}
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Sidebar --}}
        <aside class="space-y-6">
            <div class="card">
                <h3 class="font-heading text-lg font-semibold text-text-heading mb-4">Jurusan Lainnya</h3>
                <div class="space-y-2">
                    @foreach($allJurusans as $j)
                    <a href="{{ url('/jurusan/' . $j->slug) }}" class="flex items-center gap-3 rounded-md p-3 transition-colors hover:bg-surface-alt {{ request()->is('jurusan/' . $j->slug) ? 'bg-surface-alt text-primary' : '' }}">
                        <span class="flex h-10 w-10 items-center justify-center rounded-full bg-primary/10 text-sm font-bold text-primary">
                            {{ substr($j->nama, 0, 1) }}
                        </span>
                        <div>
                            <div class="text-sm font-semibold text-text-heading">{{ $j->nama }}</div>
                            <div class="text-xs text-text-body/60">{{ $j->kepalaJurusan?->nama ?? '—' }}</div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>

            <div class="card">
                <h3 class="font-heading text-lg font-semibold text-text-heading mb-4">Info PPDB</h3>
                <p class="text-sm text-text-body/70 mb-4">Pendaftaran PPDB {{ date('Y') }} sudah dibuka!</p>
                <a href="{{ url('/ppdb') }}" class="theme-btn w-full justify-center text-sm">
                    Info PPDB
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </aside>
    </div>
</div>
@endsection
