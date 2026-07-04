@extends('layouts.app')

@section('title', 'Prestasi — SMK Alhidayah')

@section('content')
{{-- Hero --}}
<section class="bg-primary-dark relative overflow-hidden pt-32">
    <div class="absolute inset-0 bg-gradient-to-r from-primary/95 via-primary/90 to-primary-dark/95"></div>
    <div class="container-page relative py-20 text-center">
        <div class="section-title-tag justify-center mb-4">
            <span class="text-accent">Prestasi</span>
        </div>
        <h1 class="font-heading text-4xl font-bold text-white">Prestasi SMK Alhidayah</h1>
        <p class="mx-auto mt-3 max-w-xl text-white/75">Berbagai pencapaian membanggakan dari siswa dan sekolah kami</p>
    </div>
</section>

<section class="section-padding">
    <div class="container-page">
        {{-- Filter --}}
        @if($jurusans->count() > 1)
        <div class="mb-10 flex flex-wrap justify-center gap-3">
            <a href="{{ url('/prestasi') }}" class="filter-btn {{ !request('jurusan') ? 'active' : '' }}">Semua</a>
            @foreach($jurusans as $j)
            <a href="{{ url('/prestasi?jurusan=' . $j->slug) }}" class="filter-btn {{ request('jurusan') == $j->slug ? 'active' : '' }}">{{ $j->nama }}</a>
            @endforeach
        </div>
        @endif

        {{-- Grid --}}
        @if($prestasis->count() > 0)
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($prestasis as $p)
            <div class="card-hover group overflow-hidden">
                {{-- Foto --}}
                <div class="relative overflow-hidden bg-gradient-to-br from-primary/10 to-accent/10">
                    @if($p->foto)
                    <img src="{{ asset('storage/' . $p->foto) }}" alt="{{ $p->judul }}" class="h-52 w-full object-cover transition-all duration-500 group-hover:scale-105" loading="lazy">
                    @else
                    <div class="flex h-52 items-center justify-center">
                        <span class="text-6xl">🏆</span>
                    </div>
                    @endif
                    {{-- Badge jurusan --}}
                    @if($p->jurusan)
                    <span class="absolute top-4 right-4 rounded-full bg-primary/90 px-3 py-1 text-xs text-white backdrop-blur-sm">
                        {{ $p->jurusan->nama }}
                    </span>
                    @endif
                </div>

                {{-- Content --}}
                <div class="p-5">
                    <div class="text-xs text-text-body/60 mb-2">
                        {{ $p->tanggal?->format('d F Y') ?? $p->created_at->format('d F Y') }}
                    </div>
                    <h3 class="font-heading text-lg font-semibold text-text-heading group-hover:text-primary transition-colors">
                        {{ $p->judul }}
                    </h3>
                    @if($p->deskripsi)
                    <p class="mt-2 text-sm text-text-body/70 line-clamp-3">{{ $p->deskripsi }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-10">
            {{ $prestasis->appends(request()->query())->links() }}
        </div>
        @else
        <div class="text-center py-16 text-text-body/60">
            <p class="text-6xl mb-4">🏆</p>
            <p>Belum ada data prestasi.</p>
        </div>
        @endif
    </div>
</section>
@endsection
