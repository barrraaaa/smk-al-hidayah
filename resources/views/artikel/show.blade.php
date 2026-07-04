@extends('layouts.app')

@section('title', $artikel->judul . ' — SMK Alhidayah')
@section('meta_description', Str::limit(strip_tags($artikel->konten), 160))

@section('content')
{{-- Breadcrumb --}}
<section class="bg-primary-dark relative overflow-hidden pt-32">
    <div class="absolute inset-0 bg-gradient-to-r from-primary/95 via-primary/90 to-primary-dark/95"></div>
    <div class="container-page relative py-16">
        <nav class="flex items-center gap-2 text-sm text-white/60 mb-6">
            <a href="{{ url('/') }}" class="hover:text-white transition-colors">Beranda</a>
            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="{{ url('/artikel') }}" class="hover:text-white transition-colors">Artikel</a>
            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-white">{{ $artikel->judul }}</span>
        </nav>
    </div>
</section>

<article class="section-padding">
    <div class="container-page">
        <div class="mx-auto max-w-3xl">
            {{-- Header --}}
            <div class="mb-8">
                <div class="flex flex-wrap items-center gap-3 mb-4">
                    @if($artikel->kategori)
                    <span class="rounded-full bg-primary/10 px-4 py-1.5 text-sm text-primary font-medium">
                        {{ $artikel->kategori->nama }}
                    </span>
                    @endif
                    @if($artikel->tags)
                        @foreach(explode(',', $artikel->tags) as $tag)
                        @if(trim($tag))
                        <span class="rounded-full bg-surface-alt px-3 py-1 text-xs text-text-body/60">
                            #{{ trim($tag) }}
                        </span>
                        @endif
                        @endforeach
                    @endif
                </div>

                <h1 class="font-heading text-3xl font-bold text-text-heading md:text-4xl">{{ $artikel->judul }}</h1>

                <div class="mt-4 flex flex-wrap items-center gap-4 text-sm text-text-body/60">
                    <span class="flex items-center gap-1">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ $artikel->published_at?->format('d F Y') ?? $artikel->created_at->format('d F Y') }}
                    </span>
                    <span class="flex items-center gap-1">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $artikel->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>

            {{-- Thumbnail --}}
            @if($artikel->thumbnail)
            <div class="mb-8 overflow-hidden rounded-lg">
                <img src="{{ asset('storage/' . $artikel->thumbnail) }}" alt="{{ $artikel->judul }}" class="w-full object-cover" loading="lazy">
            </div>
            @endif

            {{-- Content --}}
            <div class="prose prose-lg max-w-none prose-headings:font-heading prose-headings:text-text-heading prose-p:text-text-body/80 prose-a:text-primary prose-img:rounded-lg">
                {!! $artikel->konten !!}
            </div>

            {{-- Share --}}
            <div class="mt-10 flex items-center gap-4 border-t border-border pt-6">
                <span class="text-sm font-semibold text-text-heading">Bagikan:</span>
                <button onclick="copyShareLink()" class="flex items-center gap-2 rounded-md bg-surface-alt px-4 py-2 text-sm text-text-body/70 transition-colors hover:bg-primary hover:text-white">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/>
                    </svg>
                    Salin Link
                </button>
            </div>

            {{-- Artikel Terkait --}}
            @if($artikelTerkait->count() > 0)
            <section class="mt-16">
                <h2 class="font-heading text-2xl font-bold text-text-heading mb-6">Artikel Terkait</h2>
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($artikelTerkait as $rel)
                    <a href="{{ url('/artikel/' . $rel->slug) }}" class="group">
                        <div class="overflow-hidden rounded-lg bg-white shadow-sm transition-all duration-300 hover:shadow-md">
                            <div class="relative overflow-hidden bg-gradient-to-br from-primary/10 to-accent/10">
                                @if($rel->thumbnail)
                                <img src="{{ asset('storage/' . $rel->thumbnail) }}" alt="{{ $rel->judul }}" class="h-40 w-full object-cover transition-all duration-500 group-hover:scale-105" loading="lazy">
                                @else
                                <div class="flex h-40 items-center justify-center">
                                    <svg class="h-12 w-12 text-primary/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                    </svg>
                                </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="font-heading font-semibold text-text-heading text-sm group-hover:text-primary">{{ $rel->judul }}</h3>
                                <p class="mt-1 text-xs text-text-body/60">{{ $rel->published_at?->format('d M Y') }}</p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </section>
            @endif
        </div>
    </div>
</article>

@push('scripts')
<script>
    function copyShareLink() {
        navigator.clipboard.writeText(window.location.href).then(() => {
            const btn = event.currentTarget;
            const original = btn.innerHTML;
            btn.innerHTML = '<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Tersalin!';
            setTimeout(() => btn.innerHTML = original, 2000);
        });
    }
</script>
@endpush
@endsection
