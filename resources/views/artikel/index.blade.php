@extends('layouts.app')

@section('title', 'Artikel & Berita — SMK Alhidayah')

@php $settings = \App\Models\SchoolSetting::getSettings(); @endphp

@section('content')
{{-- Hero --}}
<section class="bg-primary-dark relative overflow-hidden pt-32">
    @if(!empty($settings->hero_image))
    <img src="{{ Storage::url($settings->hero_image) }}" alt="" class="absolute inset-0 h-full w-full object-cover">
    @endif
    <div class="absolute inset-0 bg-gradient-to-r {{ !empty($settings->hero_image) ? 'from-primary/65 via-primary/55 to-primary-dark/65' : 'from-primary/95 via-primary/90 to-primary-dark/95' }}"></div>
    <div class="container-page relative py-16 md:py-20 text-center">
        <div class="section-title-tag justify-center mb-4">
            <span class="text-accent">Artikel</span>
        </div>
        <h1 class="font-heading text-4xl font-bold text-white">Artikel & Berita</h1>
        <p class="mx-auto mt-3 max-w-xl text-white/75">Informasi terbaru dan kegiatan menarik dari SMK Alhidayah</p>
    </div>
</section>

<section class="section-padding">
    <div class="container-page">
        <div class="grid gap-10 lg:grid-cols-[1fr_300px]">
            {{-- Main Content --}}
            <div>
                @if($artikels->count() > 0)
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($artikels as $a)
                    <article class="group overflow-hidden rounded-lg bg-white shadow-sm transition-all duration-300 hover:shadow-md">
                        <a href="{{ url('/artikel/' . $a->slug) }}">
                            <div class="relative overflow-hidden bg-gradient-to-br from-primary/10 to-accent/10">
                                @if($a->thumbnail)
                                <img src="{{ asset('storage/' . $a->thumbnail) }}" alt="{{ $a->judul }}" class="h-48 w-full object-cover transition-all duration-500 group-hover:scale-105" loading="lazy">
                                @else
                                <div class="flex h-48 items-center justify-center">
                                    <svg class="h-16 w-16 text-primary/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                    </svg>
                                </div>
                                @endif
                                @if($a->kategori)
                                <span class="absolute top-4 left-4 rounded-full bg-primary/90 px-3 py-1 text-xs text-white backdrop-blur-sm">
                                    {{ $a->kategori->nama }}
                                </span>
                                @endif
                            </div>
                        </a>
                        <div class="p-5">
                            <div class="flex items-center gap-3 text-xs text-text-body/60 mb-2">
                                <span>{{ $a->published_at?->format('d M Y') ?? $a->created_at->format('d M Y') }}</span>
                                @if($a->tags)
                                <span class="text-primary">•</span>
                                <span>{{ explode(',', $a->tags)[0] }}</span>
                                @endif
                            </div>
                            <h3 class="font-heading font-semibold text-text-heading transition-colors group-hover:text-primary">
                                <a href="{{ url('/artikel/' . $a->slug) }}">{{ $a->judul }}</a>
                            </h3>
                            <p class="mt-2 text-sm text-text-body/70 line-clamp-2">{{ Str::limit(strip_tags($a->konten), 120) }}</p>
                            <a href="{{ url('/artikel/' . $a->slug) }}" class="mt-4 inline-flex items-center gap-1 text-sm font-semibold text-primary hover:underline">
                                Baca Selengkapnya
                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </article>
                    @endforeach
                </div>

                <div class="mt-10">
                    {{ $artikels->links() }}
                </div>
                @else
                <div class="text-center py-16 text-text-body/60">
                    <p class="text-6xl mb-4">📝</p>
                    <p>Belum ada artikel yang dipublikasikan.</p>
                </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <aside class="space-y-6">
                @if($kategoris->count() > 0)
                <div class="card">
                    <h3 class="font-heading text-lg font-semibold text-text-heading mb-4">Kategori</h3>
                    <div class="space-y-2">
                        <a href="{{ url('/artikel') }}" class="flex items-center justify-between rounded-md p-2 transition-colors hover:bg-surface-alt {{ !request('kategori') ? 'text-primary font-semibold' : 'text-text-body/70' }}">
                            <span>Semua</span>
                            <span class="text-xs">({{ $artikels->total() }})</span>
                        </a>
                        @foreach($kategoris as $k)
                        <a href="{{ url('/artikel?kategori=' . $k->slug) }}" class="flex items-center justify-between rounded-md p-2 transition-colors hover:bg-surface-alt {{ request('kategori') == $k->slug ? 'text-primary font-semibold' : 'text-text-body/70' }}">
                            <span>{{ $k->nama }}</span>
                            <span class="text-xs">({{ $k->artikels()->where('status', 'published')->count() }})</span>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="card cta-gradient !p-6 text-center">
                    <h3 class="font-heading text-xl font-bold text-white mb-2">Ikuti Kami</h3>
                    <p class="text-sm text-white/80">Dapatkan update terbaru dari SMK Alhidayah</p>
                    <div class="mt-4 flex justify-center gap-3">
                        <a href="#" class="flex h-10 w-10 items-center justify-center rounded-full bg-white/20 text-white hover:bg-white/30 transition-colors">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="flex h-10 w-10 items-center justify-center rounded-full bg-white/20 text-white hover:bg-white/30 transition-colors">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                        <a href="#" class="flex h-10 w-10 items-center justify-center rounded-full bg-white/20 text-white hover:bg-white/30 transition-colors">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection
