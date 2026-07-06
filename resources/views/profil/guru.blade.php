@extends('layouts.app')

@section('title', 'Guru & Tenaga Pengajar — SMK Alhidayah')

@php $settings = \App\Models\SchoolSetting::getSettings(); @endphp

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
            <span class="text-accent">Profil</span>
        </div>
        <h1 class="font-heading text-4xl font-bold text-white md:text-5xl">Guru & Tenaga Pengajar</h1>
        <p class="mx-auto mt-3 max-w-xl text-white/75">Tenaga pendidik profesional yang berdedikasi tinggi</p>
    </div>
</section>

<section class="section-padding">
    <div class="container-page">
        {{-- Filter Jurusan --}}
        @if($jurusans->count() > 0)
        <div class="mb-12 flex flex-wrap justify-center gap-2" id="guru-filter">
            <button class="filter-pill active" data-filter="all">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"/>
                </svg>
                Semua
            </button>
            @foreach($jurusans as $j)
            <button class="filter-pill" data-filter="{{ $j->slug }}">
                {{ $j->nama }}
            </button>
            @endforeach
        </div>
        @endif

        {{-- Stats bar --}}
        @if($gurus->count() > 0)
        <div class="mb-10 flex flex-wrap items-center justify-center gap-6 text-center">
            <div class="rounded-xl bg-primary/5 px-6 py-3">
                <p class="text-2xl font-bold text-primary">{{ $gurus->count() }}</p>
                <p class="text-xs text-text-body/60">Total Guru</p>
            </div>
            @if($jurusans->count() > 0)
            <div class="rounded-xl bg-primary/5 px-6 py-3">
                <p class="text-2xl font-bold text-primary">{{ $jurusans->count() }}</p>
                <p class="text-xs text-text-body/60">Jurusan</p>
            </div>
            @endif
            <div class="rounded-xl bg-accent/10 px-6 py-3">
                <p class="text-2xl font-bold text-amber-600">{{ $gurus->where('jabatan', 'like', 'Kepala')->count() + $gurus->where('jabatan', 'like', 'Waka')->count() }}</p>
                <p class="text-xs text-text-body/60">Pimpinan</p>
            </div>
        </div>
        @endif

        {{-- Grid Guru --}}
        <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4" id="guru-grid">
            @forelse($gurus as $g)
            <div class="guru-card group relative overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 transition-all duration-500 hover:shadow-xl hover:-translate-y-1 hover:ring-primary/20" data-jurusan="{{ $g->jurusan?->slug ?? 'none' }}">
                {{-- Decorative top bar --}}
                <div class="absolute left-0 right-0 top-0 h-1 bg-gradient-to-r from-primary via-accent to-primary opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>

                {{-- Photo --}}
                <div class="px-6 pt-8 pb-4 text-center">
                    <div class="relative mx-auto mb-5">
                        <div class="absolute -inset-1 rounded-full bg-gradient-to-br from-primary/20 via-accent/20 to-primary/20 opacity-0 transition-all duration-500 group-hover:opacity-100 group-hover:scale-105"></div>
                        <div class="relative mx-auto h-36 w-36 overflow-hidden rounded-full bg-gradient-to-br from-primary to-primary-light shadow-md transition-all duration-500 group-hover:shadow-lg">
                            @if($g->foto)
                            <img src="{{ asset('storage/' . $g->foto) }}" alt="{{ $g->nama }}" class="h-full w-full object-cover transition-all duration-500 group-hover:scale-110" loading="lazy">
                            @else
                            <div class="flex h-full items-center justify-center text-4xl font-bold text-white">
                                {{ substr($g->nama, 0, 1) }}
                            </div>
                            @endif
                        </div>
                    </div>

                    <h3 class="font-heading text-lg font-semibold text-text-heading transition-colors duration-300 group-hover:text-primary">{{ $g->nama }}</h3>

                    @if($g->jabatan)
                    <div class="mt-1.5 inline-flex items-center gap-1.5 rounded-full bg-primary/5 px-3 py-1">
                        <svg class="h-3 w-3 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span class="text-xs font-medium text-primary">{{ $g->jabatan }}</span>
                    </div>
                    @endif

                    @if($g->jurusan)
                    <div class="mt-3">
                        <span class="inline-block rounded-full bg-accent/10 px-3 py-0.5 text-xs font-medium text-amber-700">{{ $g->jurusan->nama }}</span>
                    </div>
                    @endif
                </div>

                {{-- Bottom info --}}
                <div class="border-t border-gray-50 px-6 py-3">
                    <div class="flex items-center justify-between text-xs text-text-body/50">
                        @if($g->nip)
                        <span>NIP: {{ $g->nip }}</span>
                        @else
                        <span></span>
                        @endif
                        <svg class="h-4 w-4 text-primary/30 transition-all duration-300 group-hover:text-primary/60" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>

                {{-- Bio tooltip on hover --}}
                @if($g->bio)
                <div class="absolute inset-x-0 bottom-0 translate-y-full rounded-b-2xl bg-gradient-to-t from-primary/95 to-primary-dark/95 p-5 text-center text-xs text-white/90 backdrop-blur-sm transition-all duration-300 group-hover:translate-y-0">
                    <p class="line-clamp-4 leading-relaxed">{{ $g->bio }}</p>
                </div>
                @endif
            </div>
            @empty
            <div class="col-span-full">
                <div class="flex flex-col items-center justify-center py-20 text-center">
                    <div class="mb-6 flex h-24 w-24 items-center justify-center rounded-full bg-primary/5">
                        <svg class="h-12 w-12 text-primary/30" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-heading text-xl font-bold text-text-heading">Belum Ada Data Guru</h3>
                    <p class="mt-2 max-w-sm text-sm text-text-body/60">Silakan tambahkan data guru melalui panel admin untuk menampilkan informasi tenaga pendidik.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

@push('styles')
<style>
    .filter-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        border-radius: 9999px;
        border: 1px solid #e5e7eb;
        background-color: #fff;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: rgba(85, 85, 85, 0.7);
        transition: all 0.3s ease;
        cursor: pointer;
    }
    .filter-pill:hover {
        border-color: rgba(37, 70, 54, 0.3);
        color: #254636;
    }
    .filter-pill.active {
        border-color: #254636;
        background-color: #254636;
        color: #fff;
        box-shadow: 0 4px 6px -1px rgba(37, 70, 54, 0.2);
    }
    .filter-pill.active:hover {
        box-shadow: 0 10px 15px -3px rgba(37, 70, 54, 0.3);
    }
    .guru-card {
        animation: fade-scale-in 0.5s ease-out both;
    }
    @keyframes fade-scale-in {
        from { opacity: 0; transform: scale(0.92) translateY(12px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Stagger animation
        document.querySelectorAll('.guru-card').forEach((card, i) => {
            card.style.animationDelay = (i * 0.05) + 's';
        });

        // Filter
        const filterContainer = document.getElementById('guru-filter');
        if (filterContainer) {
            filterContainer.addEventListener('click', function(e) {
                const btn = e.target.closest('.filter-pill');
                if (!btn) return;

                filterContainer.querySelectorAll('.filter-pill').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                const filter = btn.dataset.filter;
                let delay = 0;
                document.querySelectorAll('.guru-card').forEach(card => {
                    const match = filter === 'all' || card.dataset.jurusan === filter;
                    if (match) {
                        card.style.display = 'block';
                        card.style.animation = 'none';
                        card.offsetHeight; // reflow
                        card.style.animation = `fade-scale-in 0.4s ease-out ${delay}s both`;
                        delay += 0.05;
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        }
    });
</script>
@endpush
@endsection
