@extends('layouts.app')

@section('title', 'Ekstrakurikuler — SMK Alhidayah')

@section('content')
{{-- Hero --}}
<section class="bg-primary-dark relative overflow-hidden pt-32">
    <div class="absolute inset-0 bg-gradient-to-r from-primary/95 via-primary/90 to-primary-dark/95"></div>
    <div class="container-page relative py-20 text-center">
        <div class="section-title-tag justify-center mb-4">
            <span class="text-accent">Ekstrakurikuler</span>
        </div>
        <h1 class="font-heading text-4xl font-bold text-white">Ekstrakurikuler</h1>
        <p class="mx-auto mt-3 max-w-xl text-white/75">Kegiatan pengembangan bakat dan minat siswa SMK Alhidayah</p>
    </div>
</section>

<section class="section-padding">
    <div class="container-page">
        @if($ekstrakurikulers->count() > 0)
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($ekstrakurikulers as $e)
            <div class="card-hover group">
                {{-- Foto --}}
                <div class="relative overflow-hidden rounded-t-lg bg-gradient-to-br from-primary/10 to-accent/10">
                    @if($e->foto)
                    <img src="{{ asset('storage/' . $e->foto) }}" alt="{{ $e->nama }}" class="h-48 w-full object-cover transition-all duration-500 group-hover:scale-105" loading="lazy">
                    @else
                    <div class="flex h-48 items-center justify-center">
                        <span class="text-5xl">🎯</span>
                    </div>
                    @endif
                </div>

                {{-- Content --}}
                <div class="p-5">
                    <h3 class="font-heading text-xl font-semibold text-text-heading group-hover:text-primary transition-colors">
                        {{ $e->nama }}
                    </h3>
                    @if($e->pembina)
                    <p class="mt-1 text-sm text-text-body/60">Pembina: {{ $e->pembina }}</p>
                    @endif
                    @if($e->deskripsi)
                    <p class="mt-3 text-sm text-text-body/70">{{ $e->deskripsi }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-16 text-text-body/60">
            <p class="text-6xl mb-4">🎯</p>
            <p>Belum ada data ekstrakurikuler.</p>
        </div>
        @endif
    </div>
</section>
@endsection
