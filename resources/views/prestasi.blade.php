@extends('layouts.app')

@section('title', 'Prestasi — SMK Alhidayah')

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
            <span class="text-accent">Prestasi</span>
        </div>
        <h1 class="font-heading text-4xl font-bold text-white md:text-5xl">Prestasi SMK Alhidayah</h1>
        <p class="mx-auto mt-3 max-w-xl text-white/75">Berbagai pencapaian membanggakan dari siswa dan sekolah kami</p>
    </div>
</section>

<section class="section-padding">
    <div class="container-page">
        {{-- Stats --}}
        @if($prestasis->count() > 0)
        <div class="mb-10 grid gap-4 sm:grid-cols-3">
            <div class="rounded-2xl bg-gradient-to-br from-amber-50 to-orange-50 p-5 text-center ring-1 ring-amber-100">
                <div class="mx-auto mb-2 flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-amber-400 to-orange-500 text-white shadow-md">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M18.75 4.236c.982.143 1.954.317 2.916.52A6.003 6.003 0 0016.27 9.728M18.75 4.236V4.5c0 2.108-.966 3.99-2.48 5.228m0 0a6.023 6.023 0 01-2.77.896m0 0a6.023 6.023 0 01-2.77-.896"/>
                    </svg>
                </div>
                <p class="text-2xl font-bold text-amber-700">{{ $prestasis->count() }}</p>
                <p class="text-xs text-amber-600/70">Total Prestasi</p>
            </div>

            @php
                $byJurusan = $prestasis->groupBy(fn($p) => $p->jurusan?->nama ?? 'Umum');
                $terbanyak = $byJurusan->sortByDesc(fn($items) => $items->count())->keys()->first();
                $tahunIni = $prestasis->where('tanggal', '>=', now()->startOfYear())->count();
            @endphp

            <div class="rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-50 p-5 text-center ring-1 ring-blue-100">
                <div class="mx-auto mb-2 flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-blue-400 to-indigo-500 text-white shadow-md">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                    </svg>
                </div>
                <p class="text-2xl font-bold text-blue-700">{{ $tahunIni }}</p>
                <p class="text-xs text-blue-600/70">Tahun {{ date('Y') }}</p>
            </div>

            <div class="rounded-2xl bg-gradient-to-br from-emerald-50 to-green-50 p-5 text-center ring-1 ring-emerald-100">
                <div class="mx-auto mb-2 flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-emerald-400 to-green-500 text-white shadow-md">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.627 48.627 0 0 1 12 20.904a48.627 48.627 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.57 50.57 0 0 0-2.658-.813A59.905 59.905 0 0 1 12 3.493a59.902 59.902 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342"/>
                    </svg>
                </div>
                <p class="text-2xl font-bold text-emerald-700">{{ $terbanyak }}</p>
                <p class="text-xs text-emerald-600/70">Jurusan Teraktif</p>
            </div>
        </div>
        @endif

        {{-- Filter --}}
        @if($jurusans->count() > 1)
        <div class="mb-10 flex flex-wrap justify-center gap-2" id="prestasi-filter">
            <a href="{{ url('/prestasi') }}"
               class="filter-pill {{ !request('jurusan') ? 'active' : '' }}">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"/>
                </svg>
                Semua
            </a>
            @foreach($jurusans as $j)
            <a href="{{ url('/prestasi?jurusan=' . $j->slug) }}"
               class="filter-pill {{ request('jurusan') == $j->slug ? 'active' : '' }}">
                {{ $j->nama }}
            </a>
            @endforeach
        </div>
        @endif

        {{-- Grid --}}
        @if($prestasis->count() > 0)
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3" id="prestasi-grid">
            @foreach($prestasis as $index => $p)
            @php
                $trophyGradient = match(rand(0, 2)) {
                    0 => 'from-amber-400 to-yellow-500',
                    1 => 'from-gray-300 to-slate-400',
                    2 => 'from-amber-700 to-amber-800',
                };

                // Detect achievement level from title
                $isJuara = preg_match('/juara\s*(1|i|2|ii|3|iii|satu|dua|tiga)/i', $p->judul, $m);
                $juaraBadge = null;
                if ($isJuara) {
                    $pos = strtolower($m[1] ?? '');
                    $juaraBadge = match(true) {
                        in_array($pos, ['1', 'i', 'satu']) => ['text' => 'Juara 1', 'color' => 'bg-amber-100 text-amber-700 border-amber-200'],
                        in_array($pos, ['2', 'ii', 'dua']) => ['text' => 'Juara 2', 'color' => 'bg-gray-100 text-gray-600 border-gray-200'],
                        in_array($pos, ['3', 'iii', 'tiga']) => ['text' => 'Juara 3', 'color' => 'bg-orange-100 text-orange-700 border-orange-200'],
                        default => null,
                    };
                }
            @endphp
            <div class="prestasi-card group relative overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 transition-all duration-500 hover:shadow-xl hover:-translate-y-1">
                {{-- Trophy decoration --}}
                <div class="absolute -right-6 -top-6 h-20 w-20 rounded-full bg-gradient-to-br {{ $trophyGradient }} opacity-10 transition-all duration-500 group-hover:scale-150 group-hover:opacity-20"></div>

                {{-- Image --}}
                <div class="relative overflow-hidden">
                    @if($p->foto)
                    <img src="{{ asset('storage/' . $p->foto) }}" alt="{{ $p->judul }}" class="h-52 w-full object-cover transition-all duration-700 group-hover:scale-110" loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                    @else
                    <div class="flex h-52 items-center justify-center bg-gradient-to-br from-primary/5 to-accent/5">
                        <div class="flex h-20 w-20 items-center justify-center rounded-2xl bg-gradient-to-br from-amber-300 to-amber-500 text-white shadow-lg">
                            <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M18.75 4.236c.982.143 1.954.317 2.916.52A6.003 6.003 0 0016.27 9.728M18.75 4.236V4.5c0 2.108-.966 3.99-2.48 5.228m0 0a6.023 6.023 0 01-2.77.896m0 0a6.023 6.023 0 01-2.77-.896"/>
                            </svg>
                        </div>
                    </div>
                    @endif

                    {{-- Badges overlay --}}
                    <div class="absolute left-4 top-4 flex flex-wrap gap-2">
                        @if($juaraBadge)
                        <span class="inline-flex items-center gap-1 rounded-full border {{ $juaraBadge['color'] }} bg-white/90 px-3 py-1 text-xs font-bold shadow-sm backdrop-blur-sm">
                            <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z"/>
                            </svg>
                            {{ $juaraBadge['text'] }}
                        </span>
                        @endif
                        @if($p->jurusan)
                        <span class="inline-flex items-center rounded-full bg-primary/90 px-2.5 py-1 text-xs font-medium text-white backdrop-blur-sm">
                            {{ $p->jurusan->nama }}
                        </span>
                        @endif
                    </div>

                    {{-- Date --}}
                    <div class="absolute bottom-3 right-3 flex items-center gap-1.5 rounded-full bg-black/40 px-3 py-1 text-xs text-white backdrop-blur-sm">
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ $p->tanggal?->isoFormat('D MMM Y') ?? $p->created_at->isoFormat('D MMM Y') }}
                    </div>
                </div>

                {{-- Content --}}
                <div class="p-5">
                    <h3 class="font-heading text-lg font-bold text-text-heading transition-colors duration-300 group-hover:text-primary">
                        {{ $p->judul }}
                    </h3>
                    @if($p->deskripsi)
                    <p class="mt-2 text-sm leading-relaxed text-text-body/70 line-clamp-3">{{ $p->deskripsi }}</p>
                    @endif
                </div>

                {{-- Top accent --}}
                <div class="absolute left-0 right-0 top-0 h-1 bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600 opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-12">
            {{ $prestasis->appends(request()->query())->links() }}
        </div>
        @else
        <div class="flex flex-col items-center justify-center py-20 text-center">
            <div class="mb-6 flex h-24 w-24 items-center justify-center rounded-full bg-amber-50">
                <svg class="h-12 w-12 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M18.75 4.236c.982.143 1.954.317 2.916.52A6.003 6.003 0 0016.27 9.728M18.75 4.236V4.5c0 2.108-.966 3.99-2.48 5.228m0 0a6.023 6.023 0 01-2.77.896m0 0a6.023 6.023 0 01-2.77-.896"/>
                </svg>
            </div>
            <h3 class="font-heading text-xl font-bold text-text-heading">Belum Ada Prestasi</h3>
            <p class="mt-2 max-w-sm text-sm text-text-body/60">Silakan tambahkan data prestasi melalui panel admin untuk menampilkan pencapaian sekolah.</p>
        </div>
        @endif
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
    .prestasi-card:nth-child(1) { animation-delay: 0s; }
    .prestasi-card:nth-child(2) { animation-delay: 0.05s; }
    .prestasi-card:nth-child(3) { animation-delay: 0.1s; }
    .prestasi-card:nth-child(4) { animation-delay: 0.15s; }
    .prestasi-card:nth-child(5) { animation-delay: 0.2s; }
    .prestasi-card:nth-child(6) { animation-delay: 0.25s; }
    .prestasi-card:nth-child(7) { animation-delay: 0.3s; }
    .prestasi-card:nth-child(8) { animation-delay: 0.35s; }
    .prestasi-card:nth-child(9) { animation-delay: 0.4s; }
    .prestasi-card:nth-child(10) { animation-delay: 0.45s; }
</style>
@endpush
@endsection
