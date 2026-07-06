@extends('layouts.app')

@section('title', 'Ekstrakurikuler — SMK Alhidayah')

@php $settings = \App\Models\SchoolSetting::getSettings(); @endphp

@php
    $ekstraIcons = [
        'pramuka' => 'M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
        'paskibra' => 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z',
        'futsal' => 'M13 10V3L4 14h7v7l9-11h-7z',
        'basket' => 'M13 10V3L4 14h7v7l9-11h-7z',
        'voli' => 'M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
        'silat' => 'M13 10V3L4 14h7v7l9-11h-7z',
        'musik' => 'M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3',
        'tari' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z',
        'default' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10',
    ];

    function getEkstraIcon($nama) {
        global $ekstraIcons;
        $lower = strtolower($nama);
        foreach ($ekstraIcons as $key => $icon) {
            if (str_contains($lower, $key)) {
                return $icon;
            }
        }
        return $ekstraIcons['default'];
    }

    $ekstraColors = [
        'from-primary to-primary-light',
        'from-accent to-amber-500',
        'from-emerald-500 to-green-600',
        'from-violet-500 to-purple-600',
        'from-rose-500 to-pink-600',
        'from-sky-500 to-blue-600',
        'from-orange-500 to-red-500',
        'from-teal-500 to-cyan-600',
    ];
@endphp

@section('content')
{{-- Hero --}}
<section class="relative overflow-hidden bg-primary-dark pt-32">
    @if(!empty($settings->hero_image))
    <img src="{{ Storage::url($settings->hero_image) }}" alt="" class="absolute inset-0 h-full w-full object-cover">
    @endif
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-r {{ !empty($settings->hero_image) ? 'from-primary/65 via-primary/55 to-primary-dark/65' : 'from-primary/95 via-primary/90 to-primary-dark/95' }}"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTUwIDB2MTAwTTAgNTBoMTAwIiBzdHJva2U9InJnYmEoMjU1LDI1NSwyNTUsMC4wMykiIHN0cm9rZS13aWR0aD0iMSIvPjwvc3ZnPg==')] opacity-40"></div>
    </div>
    <div class="absolute -top-20 -right-20 h-80 w-80 rounded-full bg-accent/5 blur-3xl"></div>
    <div class="absolute -bottom-20 -left-20 h-96 w-96 rounded-full bg-white/[0.03] blur-3xl"></div>

    <div class="container-page relative py-16 md:py-20 text-center">
        <div class="section-title-tag justify-center mb-4">
            <span class="text-accent">Ekstrakurikuler</span>
        </div>
        <h1 class="font-heading text-4xl font-bold text-white md:text-5xl">Ekstrakurikuler</h1>
        <p class="mx-auto mt-3 max-w-xl text-white/75">Kembangkan bakat dan minatmu di luar kelas</p>
    </div>
</section>

<section class="section-padding">
    <div class="container-page">
        @if($ekstrakurikulers->count() > 0)
        {{-- Stats --}}
        <div class="mb-12 text-center">
            <div class="inline-flex items-center gap-2 rounded-full bg-primary/5 px-6 py-2">
                <span class="text-2xl font-bold text-primary">{{ $ekstrakurikulers->count() }}</span>
                <span class="text-sm text-text-body/60">Ekstrakurikuler Aktif</span>
            </div>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($ekstrakurikulers as $index => $e)
            @php $gradient = $ekstraColors[$index % count($ekstraColors)]; @endphp
            <div class="group relative overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 transition-all duration-500 hover:shadow-xl hover:-translate-y-1">
                {{-- Foto with gradient overlay --}}
                <div class="relative overflow-hidden">
                    @if($e->foto)
                    <img src="{{ asset('storage/' . $e->foto) }}" alt="{{ $e->nama }}" class="h-52 w-full object-cover transition-all duration-700 group-hover:scale-110" loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-60 transition-opacity duration-300 group-hover:opacity-80"></div>
                    @else
                    <div class="flex h-52 items-center justify-center bg-gradient-to-br {{ $gradient }}">
                        <svg class="h-20 w-20 text-white/30" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ getEkstraIcon($e->nama) }}"/>
                        </svg>
                    </div>
                    @endif

                    {{-- Icon badge --}}
                    <div class="absolute bottom-4 left-4 flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br {{ $gradient }} text-white shadow-lg transition-all duration-500 group-hover:scale-110 group-hover:rotate-6">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ getEkstraIcon($e->nama) }}"/>
                        </svg>
                    </div>
                </div>

                {{-- Content --}}
                <div class="p-5">
                    <h3 class="font-heading text-xl font-bold text-text-heading transition-colors duration-300 group-hover:text-primary">
                        {{ $e->nama }}
                    </h3>

                    @if($e->pembina)
                    <div class="mt-2 flex items-center gap-1.5 text-sm text-text-body/60">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Pembina: <span class="font-medium text-text-body">{{ $e->pembina }}</span>
                    </div>
                    @endif

                    @if($e->deskripsi)
                    <p class="mt-3 text-sm leading-relaxed text-text-body/70 line-clamp-3">{{ $e->deskripsi }}</p>
                    @endif

                    {{-- Hover reveal --}}
                    <div class="mt-4 flex items-center gap-2 text-xs font-medium text-primary opacity-0 transition-all duration-300 group-hover:opacity-100">
                        <span>Lihat detail</span>
                        <svg class="h-3.5 w-3.5 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>

                {{-- Top accent bar --}}
                <div class="absolute left-0 right-0 top-0 h-1 bg-gradient-to-r {{ $gradient }} opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
            </div>
            @endforeach
        </div>
        @else
        <div class="flex flex-col items-center justify-center py-20 text-center">
            <div class="mb-6 flex h-24 w-24 items-center justify-center rounded-full bg-primary/5">
                <svg class="h-12 w-12 text-primary/30" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
            <h3 class="font-heading text-xl font-bold text-text-heading">Belum Ada Ekstrakurikuler</h3>
            <p class="mt-2 max-w-sm text-sm text-text-body/60">Silakan tambahkan data ekstrakurikuler melalui panel admin.</p>
        </div>
        @endif
    </div>
</section>

@push('styles')
<style>
    .ekstra-card {
        animation: fade-up 0.5s ease-out both;
    }
    @keyframes fade-up {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush
