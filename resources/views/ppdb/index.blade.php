@extends('layouts.app')

@php $settings = \App\Models\SchoolSetting::getSettings(); @endphp

@section('title', 'PPDB — Info Pendaftaran — ' . $settings->school_name)

@section('content')
{{-- ============================================ --}}
{{-- HERO SECTION --}}
{{-- ============================================ --}}
<section class="relative overflow-hidden bg-primary-dark">
    @if(!empty($settings->hero_image))
    <img src="{{ Storage::url($settings->hero_image) }}" alt="" class="absolute inset-0 h-full w-full object-cover">
    @endif
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-r {{ !empty($settings->hero_image) ? 'from-primary/65 via-primary/55 to-primary-dark/65' : 'from-primary/95 via-primary/90 to-primary-dark/95' }}"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTUwIDB2MTAwTTAgNTBoMTAwIiBzdHJva2U9InJnYmEoMjU1LDI1NSwyNTUsMC4wMykiIHN0cm9rZS13aWR0aD0iMSIvPjwvc3ZnPg==')] opacity-40"></div>
    </div>
    <div class="absolute -top-20 -right-20 h-80 w-80 rounded-full bg-accent/5 blur-3xl"></div>
    <div class="absolute -bottom-20 -left-20 h-96 w-96 rounded-full bg-white/[0.03] blur-3xl"></div>

    <div class="container-page relative py-28 md:py-44">
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
                @include('partials.ornaments', ['type' => 'heading-accent', 'color' => 'accent'])
                Jadwal PPDB
            </div>
            <h2 class="section-title-heading">Jadwal Pendaftaran<br>{{ date('Y') }}/{{ date('Y') + 1 }}</h2>
        </div>

        <div class="relative mx-auto max-w-4xl">
            {{-- Decorative header --}}
            <div class="mb-8 flex items-center justify-center gap-3">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-primary to-primary-light text-white shadow-lg">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-text-body/60">Tahun Ajaran</p>
                    <p class="font-heading text-xl font-bold text-text-heading">{{ date('Y') }}/{{ date('Y') + 1 }}</p>
                </div>
            </div>

            {{-- Timeline wrapper --}}
            <div class="relative">
                {{-- Vertical line --}}
                <div class="absolute left-[23px] top-0 h-full w-0.5 bg-gradient-to-b from-primary via-accent to-primary/20"></div>

                <div class="space-y-6">
                    @php
                        // Split RichEditor HTML by paragraph/line boundaries for timeline display
                        $jadwalRaw = strip_tags($settings->ppdb_schedule, '<p><br><br/><strong><em><b><i><u>');
                        $jadwalParts = preg_split('/<\/p>\s*/', $jadwalRaw);
                        $jadwalItems = array_values(array_filter(array_map('trim', $jadwalParts)));
                        if(count($jadwalItems) <= 1) {
                            // Fallback: try splitting by line break
                            $jadwalItems = array_values(array_filter(array_map('trim', explode("\n", strip_tags(str_replace(['<br>', '<br />', '</p>'], "\n", $settings->ppdb_schedule))))));
                        }
                        $jadwalColors = ['from-primary to-primary-light', 'from-accent to-amber-500', 'from-primary to-primary-light', 'from-accent to-amber-500', 'from-primary to-primary-light'];
                        $jadwalIcons = [
                            'M9 5l7 7-7 7',
                            'M9 12l2 2 4-4',
                            'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                            'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                            'M5 13l4 4L19 7',
                        ];
                    @endphp

                    @forelse($jadwalItems as $index => $item)
                        @php $trimmed = trim($item); @endphp
                        @if(!empty($trimmed))
                        <div class="relative flex items-start gap-5 group">
                            {{-- Timeline dot --}}
                            <div class="relative z-10 flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br {{ $jadwalColors[$index % count($jadwalColors)] }} text-white shadow-md transition-all duration-300 group-hover:scale-110 group-hover:shadow-lg">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $jadwalIcons[$index % count($jadwalIcons)] }}"/>
                                </svg>
                            </div>

                            {{-- Content card --}}
                            <div class="min-w-0 flex-1 rounded-xl border border-gray-100 bg-white p-5 shadow-sm transition-all duration-300 group-hover:border-primary/20 group-hover:shadow-md">
                                <div class="prose prose-sm prose-headings:text-text-heading prose-p:text-text-body/70 prose-li:text-text-body/80 prose-strong:text-primary prose-table:w-full prose-td:border prose-td:border-gray-100 prose-td:p-2 prose-th:bg-primary/5 prose-th:p-2 prose-th:text-left prose-th:text-xs prose-th:font-semibold prose-th:text-text-heading max-w-none">
                                    {!! $trimmed !!}
                                </div>
                            </div>
                        </div>
                        @endif
                    @empty
                        <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                            <div class="prose prose-sm max-w-none">
                                {!! $settings->ppdb_schedule !!}
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
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
                @include('partials.ornaments', ['type' => 'heading-accent', 'color' => 'accent'])
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
            {{-- Persyaratan --}}
            <div>
                <div class="mb-6 flex items-start gap-5">
                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-primary to-primary-light text-white shadow-lg">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="section-title-tag mb-1">
                            <span class="h-2 w-2 rounded-full bg-accent"></span>
                            @include('partials.ornaments', ['type' => 'heading-accent', 'color' => 'accent'])
                            Persyaratan
                        </div>
                        <h2 class="font-heading text-3xl font-bold text-text-heading md:text-4xl">Syarat<br>Pendaftaran</h2>
                    </div>
                </div>

                @if($settings->ppdb_requirements)
                <div class="rounded-2xl border border-green-100 bg-gradient-to-br from-green-50 to-emerald-50/50 p-6 shadow-sm">
                    @php
                        // Split RichEditor HTML by paragraph boundaries for checklist display
                        $reqRaw = strip_tags($settings->ppdb_requirements, '<p><br><br/><strong><em><b><i><u>');
                        $reqParts = preg_split('/<\/p>\s*/', $reqRaw);
                        $reqItems = array_values(array_filter(array_map('trim', $reqParts)));
                        if(count($reqItems) <= 1) {
                            $reqItems = array_values(array_filter(array_map('trim', explode("\n", strip_tags(str_replace(['<br>', '<br />', '</p>'], "\n", $settings->ppdb_requirements))))));
                        }
                    @endphp
                    <ul class="space-y-3">
                        @forelse($reqItems as $item)
                            @php $trimmed = trim($item); @endphp
                            @if(!empty($trimmed))
                            <li class="flex items-start gap-3">
                                <span class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-green-500 text-white">
                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </span>
                                <span class="text-sm text-text-body/80">
                                    @php
                                        $display = preg_replace('/^<p>\s*/', '', $trimmed);
                                    @endphp
                                    {!! $display !!}
                                </span>
                            </li>
                            @endif
                        @empty
                            <div class="prose prose-sm prose-headings:text-text-heading prose-p:text-text-body/70 prose-li:text-text-body/80 prose-strong:text-primary max-w-none">
                                {!! $settings->ppdb_requirements !!}
                            </div>
                        @endforelse
                    </ul>
                </div>
                @else
                <div class="rounded-2xl border border-gray-100 bg-gray-50 p-8 text-center">
                    <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-gray-200 text-gray-400">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <p class="text-sm text-text-body/70">Informasi persyaratan belum tersedia.</p>
                </div>
                @endif
            </div>

            {{-- Alur --}}
            <div>
                <div class="mb-6 flex items-start gap-5">
                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-accent to-amber-500 text-text-heading shadow-lg">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="section-title-tag mb-1">
                            <span class="h-2 w-2 rounded-full bg-accent"></span>
                            @include('partials.ornaments', ['type' => 'heading-accent', 'color' => 'accent'])
                            Alur PPDB
                        </div>
                        <h2 class="font-heading text-3xl font-bold text-text-heading md:text-4xl">Cara Daftar<br>Online</h2>
                    </div>
                </div>

                <div class="relative">
                    {{-- Vertical connection line --}}
                    <div class="absolute left-[27px] top-2 h-[calc(100%-16px)] w-0.5 bg-gradient-to-b from-primary via-accent to-primary/20"></div>

                    <div class="space-y-8">
                        @php $alur = [
                            ['num' => '1', 'title' => 'Daftar Online', 'desc' => 'Isi formulir pendaftaran online dengan data diri lengkap dan pilih jurusan.', 'gradient' => 'from-primary to-primary-light', 'icon' => 'M15.042 21.672L13.684 16.6m0 0l-2.51 2.225.569-9.47 5.227 7.917-3.286-.672zM12 2.25V4.5'],
                            ['num' => '2', 'title' => 'Upload Dokumen', 'desc' => 'Unggah dokumen persyaratan (ijazah, KK, pas foto, akta) dalam format PDF/JPG.', 'gradient' => 'from-accent to-amber-500', 'icon' => 'M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l-3 3m0 0l-3-3m3 3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z'],
                            ['num' => '3', 'title' => 'Pembayaran', 'desc' => 'Lakukan pembayaran biaya pendaftaran ke rekening yang telah ditentukan.', 'gradient' => 'from-primary to-primary-light', 'icon' => 'M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                            ['num' => '4', 'title' => 'Verifikasi', 'desc' => 'Tim PPDB akan memverifikasi berkas dan pembayaran Anda.', 'gradient' => 'from-accent to-amber-500', 'icon' => 'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                            ['num' => '5', 'title' => 'Pengumuman', 'desc' => 'Hasil seleksi akan diumumkan melalui website dan di sekolah.', 'gradient' => 'from-primary to-primary-light', 'icon' => 'M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38a.482.482 0 01-.629-.119 13.474 13.474 0 01-2.674-4.654m0-9.18a13.319 13.319 0 012.674-4.655.482.482 0 01.629-.118l.657.38c.523.3.71.96.463 1.51a13.36 13.36 0 00-.985 2.784'],
                        ]; @endphp
                        @foreach($alur as $a)
                        <div class="relative flex items-start gap-5 group">
                            {{-- Number circle --}}
                            <div class="relative z-10 flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br {{ $a['gradient'] }} text-white shadow-md transition-all duration-300 group-hover:scale-110 group-hover:shadow-lg">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $a['icon'] }}"/>
                                </svg>
                            </div>

                            {{-- Content --}}
                            <div class="min-w-0 flex-1 pt-2">
                                <div class="flex items-center gap-2">
                                    <h3 class="font-heading text-base font-bold text-text-heading">{{ $a['title'] }}</h3>
                                    <span class="flex h-5 w-5 items-center justify-center rounded-full bg-primary/10 text-[10px] font-bold text-primary">{{ $a['num'] }}</span>
                                </div>
                                <p class="mt-1.5 text-sm leading-relaxed text-text-body/70">{{ $a['desc'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- BIAYA --}}
{{-- ============================================ --}}
@if($settings->ppdb_fee)
<section class="section-padding bg-surface-alt relative overflow-hidden">
    {{-- Decorative background --}}
    <div class="absolute -top-40 right-0 h-80 w-80 rounded-full bg-primary/[0.03] blur-3xl"></div>
    <div class="absolute -bottom-40 left-0 h-80 w-80 rounded-full bg-accent/[0.03] blur-3xl"></div>

    <div class="container-page relative">
        <div class="section-title">
            <div class="section-title-tag justify-center">
                <span class="h-2 w-2 rounded-full bg-accent"></span>
                @include('partials.ornaments', ['type' => 'heading-accent', 'color' => 'accent'])
                Informasi Biaya
            </div>
            <h2 class="section-title-heading">Biaya<br>Pendaftaran</h2>
            <p class="section-title-text">Biaya pendaftaran PPDB tahun ini</p>
        </div>

        <div class="mx-auto max-w-md">
            <div class="group relative">
                {{-- Glow effect --}}
                <div class="absolute -inset-1 rounded-3xl bg-gradient-to-r from-primary via-accent to-primary opacity-20 blur transition-all duration-500 group-hover:opacity-40"></div>

                {{-- Card --}}
                <div class="relative overflow-hidden rounded-2xl bg-white p-8 shadow-lg ring-1 ring-gray-100">
                    {{-- Top decorative bar --}}
                    <div class="absolute left-0 right-0 top-0 h-1.5 bg-gradient-to-r from-primary via-accent to-primary"></div>

                    {{-- Corner decorative --}}
                    <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-primary/[0.03]"></div>
                    <div class="absolute -bottom-6 -left-6 h-20 w-20 rounded-full bg-accent/[0.03]"></div>

                    <div class="relative text-center">
                        {{-- Icon --}}
                        <div class="mx-auto mb-5 flex h-20 w-20 items-center justify-center rounded-2xl bg-gradient-to-br from-primary to-primary-light text-white shadow-lg transition-all duration-500 group-hover:scale-110 group-hover:rotate-3">
                            <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>

                        {{-- Label --}}
                        <p class="mb-1 text-sm font-medium uppercase tracking-widest text-text-body/50">Biaya Pendaftaran</p>

                        {{-- Price --}}
                        <p class="text-4xl font-extrabold text-primary md:text-5xl">{{ $settings->ppdb_fee }}</p>

                        {{-- Divider --}}
                        <div class="mx-auto my-5 h-px w-16 bg-gradient-to-r from-transparent via-primary/30 to-transparent"></div>

                        {{-- Info --}}
                        <p class="text-xs text-text-body/50">Pembayaran dapat dilakukan melalui transfer bank atau langsung ke sekolah</p>
                    </div>
                </div>
            </div>

            {{-- CTA --}}
            <div class="mt-8 text-center">
                <a href="{{ route('ppdb.daftar') }}" class="theme-btn min-w-[220px] justify-center">
                    Daftar Sekarang
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
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
            @include('partials.ornaments', ['type' => 'cta', 'color' => 'white'])
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
