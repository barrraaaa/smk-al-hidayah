@extends('layouts.app')

@section('title', 'Profil Sekolah — SMK Alhidayah')
@section('meta_description', 'Kenali lebih dekat SMK Alhidayah — pelajari sejarah, visi-misi, struktur organisasi, dan tenaga pendidik profesional sekolah kejuruan unggulan di Jakarta.')

@section('content')
{{-- ============================================ --}}
{{-- HERO SECTION --}}
{{-- ============================================ --}}
<section class="relative overflow-hidden bg-primary-dark">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-r from-primary/95 via-primary/90 to-primary-dark/95"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTUwIDB2MTAwTTAgNTBoMTAwIiBzdHJva2U9InJnYmEoMjU1LDI1NSwyNTUsMC4wMykiIHN0cm9rZS13aWR0aD0iMSIvPjwvc3ZnPg==')] opacity-40"></div>
    </div>

    <div class="absolute -top-20 -right-20 h-80 w-80 rounded-full bg-accent/5 blur-3xl"></div>
    <div class="absolute -bottom-20 -left-20 h-96 w-96 rounded-full bg-white/[0.03] blur-3xl"></div>

    <div class="container-page relative py-36 md:py-44">
        <div class="mx-auto max-w-4xl text-center">
            <div class="section-title-tag justify-center mb-4">
                <span class="text-accent">Profil Sekolah</span>
            </div>

            <h1 class="font-heading text-5xl font-bold leading-tight text-white md:text-6xl lg:text-7xl lg:leading-[1.1]">
                Kenali Lebih Dekat<br>
                <span class="text-accent">SMK Alhidayah</span>
            </h1>

            <p class="mx-auto mt-6 max-w-2xl text-lg text-white/75 md:text-xl">
                Pelajari sejarah, visi-misi, struktur organisasi, dan kenali para pendidik profesional yang siap membimbing siswa menuju masa depan gemilang.
            </p>
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- WELCOME SECTION --}}
{{-- ============================================ --}}
<section class="section-padding">
    <div class="container-page">
        <div class="grid items-center gap-10 lg:grid-cols-2">
            <div>
                <div class="section-title-tag mb-4">
                    <span class="h-2 w-2 rounded-full bg-accent"></span>
                    Selamat Datang
                </div>
                <h2 class="font-heading text-3xl font-bold text-text-heading md:text-4xl">
                    Sambutan<br>
                    <span class="text-primary">Kepala Sekolah</span>
                </h2>
                <div class="mt-6 space-y-4 text-text-body/80 leading-relaxed">
                    <p>
                        Assalamu'alaikum Warahmatullahi Wabarakatuh,
                    </p>
                    <p>
                        Puji syukur ke hadirat Allah SWT yang telah melimpahkan rahmat dan hidayah-Nya 
                        sehingga kita dapat terus berkhidmat di dunia pendidikan. SMK Alhidayah hadir 
                        sebagai lembaga pendidikan menengah kejuruan yang berkomitmen mencetak generasi 
                        yang tidak hanya kompeten dalam bidangnya, tetapi juga berakhlak mulia.
                    </p>
                    <p>
                        Dengan 4 jurusan unggulan — AKL, Pemasaran, MPLB, dan TJKT — kami siap 
                        membekali siswa dengan keterampilan abad 21 yang relevan dengan kebutuhan industri.
                    </p>
                    <p>
                        Wassalamu'alaikum Warahmatullahi Wabarakatuh.
                    </p>
                </div>
            </div>

            <div class="relative">
                <div class="relative overflow-hidden rounded-lg bg-gradient-to-br from-primary/10 to-accent/10 p-6">
                    <div class="flex h-96 items-center justify-center">
                        <div class="text-center">
                            <div class="mx-auto mb-6 flex h-32 w-32 items-center justify-center rounded-full bg-gradient-to-br from-primary to-primary-light shadow-lg">
                                <svg class="h-16 w-16 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <p class="font-heading text-xl font-bold text-text-heading">SMK Alhidayah</p>
                            <p class="mt-1 text-sm text-text-body/60">Mencetak Generasi Unggul & Berakhlak Mulia</p>
                            <div class="mt-6 flex justify-center gap-2">
                                <span class="inline-block h-2 w-8 rounded-full bg-accent"></span>
                                <span class="inline-block h-2 w-8 rounded-full bg-primary"></span>
                                <span class="inline-block h-2 w-8 rounded-full bg-accent"></span>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Decorative --}}
                <div class="absolute -bottom-3 -right-3 h-32 w-32 rounded-full bg-accent/10 blur-2xl"></div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- SEKILAS INFO (counters) --}}
{{-- ============================================ --}}
<section class="section-padding bg-surface-alt">
    <div class="container-page">
        <div class="section-title">
            <div class="section-title-tag justify-center">
                <span class="h-2 w-2 rounded-full bg-accent"></span>
                Sekilas Info
            </div>
            <h2 class="section-title-heading">SMK Alhidayah dalam Angka</h2>
            <p class="section-title-text">Capai prestasi bersama kami</p>
        </div>

        <div class="grid grid-cols-2 gap-6 md:grid-cols-4">
            @php
                $stats = [
                    ['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'value' => '500+', 'label' => 'Siswa Aktif', 'color' => 'bg-primary text-white'],
                    ['icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', 'value' => '4', 'label' => 'Jurusan Unggulan', 'color' => 'bg-accent text-text-heading'],
                    ['icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'value' => '98%', 'label' => 'Lulusan Terserap', 'color' => 'bg-primary text-white'],
                    ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'value' => '15+', 'label' => 'Tahun Berkiprah', 'color' => 'bg-accent text-text-heading'],
                ];
            @endphp
            @foreach($stats as $s)
            <div class="card-hover group text-center">
                <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full {{ $s['color'] }} transition-all duration-500 group-hover:rotate-y-180 group-hover:scale-110 shadow-md">
                    <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $s['icon'] }}"/>
                    </svg>
                </div>
                <div class="font-heading text-4xl font-bold text-text-heading">{{ $s['value'] }}</div>
                <div class="mt-1 text-sm text-text-body/60">{{ $s['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- CARDS NAVIGASI SUB-PAGE --}}
{{-- ============================================ --}}
<section class="section-padding">
    <div class="container-page">
        <div class="section-title">
            <div class="section-title-tag justify-center">
                <span class="h-2 w-2 rounded-full bg-accent"></span>
                Jelajahi Profil
            </div>
            <h2 class="section-title-heading">Informasi Lengkap<br>SMK Alhidayah</h2>
            <p class="section-title-text">Temukan berbagai informasi tentang sekolah kami</p>
        </div>

        <div class="grid gap-8 md:grid-cols-3">
            {{-- Sejarah & Visi Misi --}}
            <a href="{{ url('/profil/sejarah') }}" class="group block">
                <div class="card-hover relative overflow-hidden">
                    <div class="relative z-10">
                        <div class="mb-6 flex h-20 w-20 items-center justify-center rounded-xl bg-gradient-to-br from-primary to-primary-light shadow-lg transition-all duration-500 group-hover:scale-110 group-hover:rotate-3">
                            <span class="text-3xl">📜</span>
                        </div>
                        <h3 class="font-heading text-xl font-bold text-text-heading group-hover:text-primary transition-colors">Sejarah & Visi Misi</h3>
                        <p class="mt-3 text-sm text-text-body/70 leading-relaxed">
                            Pelajari perjalanan SMK Alhidayah sejak berdiri, visi besar, dan misi yang menjadi pedoman kami dalam mencetak generasi unggul.
                        </p>
                        <span class="theme-btn-sm mt-6 inline-flex">
                            Selengkapnya
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </span>
                    </div>
                    {{-- Decorative --}}
                    <div class="absolute -bottom-8 -right-8 h-40 w-40 rounded-full bg-primary/5 transition-all duration-500 group-hover:scale-150"></div>
                </div>
            </a>

            {{-- Struktur Organisasi --}}
            <a href="{{ url('/profil/struktur-organisasi') }}" class="group block">
                <div class="card-hover relative overflow-hidden">
                    <div class="relative z-10">
                        <div class="mb-6 flex h-20 w-20 items-center justify-center rounded-xl bg-gradient-to-br from-accent-dark to-accent shadow-lg transition-all duration-500 group-hover:scale-110 group-hover:rotate-3">
                            <span class="text-3xl">🏛️</span>
                        </div>
                        <h3 class="font-heading text-xl font-bold text-text-heading group-hover:text-primary transition-colors">Struktur Organisasi</h3>
                        <p class="mt-3 text-sm text-text-body/70 leading-relaxed">
                            Lihat struktur kepengurusan SMK Alhidayah, dari kepala sekolah, wakil kepala, ketua jurusan, hingga tenaga pendidik.
                        </p>
                        <span class="theme-btn-sm mt-6 inline-flex">
                            Selengkapnya
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </span>
                    </div>
                    <div class="absolute -bottom-8 -right-8 h-40 w-40 rounded-full bg-accent/5 transition-all duration-500 group-hover:scale-150"></div>
                </div>
            </a>

            {{-- Guru & Tenaga Pengajar --}}
            <a href="{{ url('/profil/guru') }}" class="group block">
                <div class="card-hover relative overflow-hidden">
                    <div class="relative z-10">
                        <div class="mb-6 flex h-20 w-20 items-center justify-center rounded-xl bg-gradient-to-br from-primary-medium to-primary shadow-lg transition-all duration-500 group-hover:scale-110 group-hover:rotate-3">
                            <span class="text-3xl">👨‍🏫</span>
                        </div>
                        <h3 class="font-heading text-xl font-bold text-text-heading group-hover:text-primary transition-colors">Guru & Tenaga Pengajar</h3>
                        <p class="mt-3 text-sm text-text-body/70 leading-relaxed">
                            Kenali para pendidik profesional SMK Alhidayah yang berdedikasi tinggi dalam membimbing dan menginspirasi siswa.
                        </p>
                        <span class="theme-btn-sm mt-6 inline-flex">
                            Selengkapnya
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </span>
                    </div>
                    <div class="absolute -bottom-8 -right-8 h-40 w-40 rounded-full bg-primary/5 transition-all duration-500 group-hover:scale-150"></div>
                </div>
            </a>
        </div>
    </div>
</section>
@endsection
