@extends('layouts.app')

@section('title', 'Galeri — SMK Alhidayah')

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
            <span class="text-accent">Galeri</span>
        </div>
        <h1 class="font-heading text-4xl font-bold text-white">Galeri Foto</h1>
        <p class="mx-auto mt-3 max-w-xl text-white/75">Dokumentasi kegiatan dan momen berharga di SMK Alhidayah</p>
    </div>
</section>

<section class="section-padding">
    <div class="container-page">
        {{-- Filter --}}
        @if($kategoris->count() > 1)
        <div class="mb-10 flex flex-wrap justify-center gap-3" id="galeri-filter">
            <button class="filter-btn active" data-filter="all">Semua</button>
            @foreach($kategoris as $k)
            <button class="filter-btn" data-filter="{{ $k }}">{{ ucfirst($k) }}</button>
            @endforeach
        </div>
        @endif

        @if($galeris->count() > 0)
        {{-- Masonry Grid --}}
        <div class="columns-1 gap-4 sm:columns-2 lg:columns-3 xl:columns-4" id="galeri-grid">
            @foreach($galeris as $g)
            <div class="galeri-item mb-4 break-inside-avoid" data-kategori="{{ $g->kategori }}">
                <a href="{{ asset('storage/' . $g->file_path) }}" class="group relative block overflow-hidden rounded-lg" data-lightbox="galeri" data-title="{{ $g->judul }}">
                    <img src="{{ asset('storage/' . $g->file_path) }}" alt="{{ $g->judul }}" class="w-full object-cover transition-all duration-500 group-hover:scale-105 min-h-[200px]" loading="lazy">
                    <div class="absolute inset-0 flex items-end bg-gradient-to-t from-primary/80 via-transparent to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                        <div class="p-4">
                            <h3 class="font-heading font-semibold text-white">{{ $g->judul }}</h3>
                            <span class="mt-1 inline-block rounded-full bg-white/20 px-2 py-0.5 text-xs text-white backdrop-blur-sm">
                                {{ ucfirst($g->kategori) }}
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-16 text-text-body/60">
            <p class="text-6xl mb-4">📸</p>
            <p>Belum ada foto galeri.</p>
        </div>
        @endif
    </div>
</section>

@push('scripts')
<script>
    // Filter galeri
    document.getElementById('galeri-filter')?.addEventListener('click', function(e) {
        const btn = e.target.closest('.filter-btn');
        if (!btn) return;
        
        document.querySelectorAll('#galeri-filter .filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        
        const filter = btn.dataset.filter;
        document.querySelectorAll('.galeri-item').forEach(item => {
            item.style.display = filter === 'all' || item.dataset.kategori === filter ? 'block' : 'none';
        });
    });
</script>
@endpush
@endsection
