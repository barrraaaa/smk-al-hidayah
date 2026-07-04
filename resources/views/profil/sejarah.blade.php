@extends('layouts.app')

@section('title', 'Sejarah & Visi Misi — SMK Alhidayah')
@section('meta_description', 'Pelajari perjalanan SMK Alhidayah sejak 2010, visi menjadi lembaga pendidikan mencetak SDM berakhlakul karimah, dan misi untuk mencetak generasi unggul.')

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
                <span class="text-accent">Profil</span>
            </div>

            <h1 class="font-heading text-5xl font-bold leading-tight text-white md:text-6xl lg:text-7xl lg:leading-[1.1]">
                Sejarah &<br>
                <span class="text-accent">Visi Misi</span>
            </h1>

            <p class="mx-auto mt-6 max-w-2xl text-lg text-white/75 md:text-xl">
                Perjalanan panjang SMK Alhidayah dalam mencetak generasi unggul dan berakhlak mulia sejak awal berdiri.
            </p>
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- SEJARAH SECTION --}}
{{-- ============================================ --}}
<section class="section-padding">
    <div class="container-page">
        <div class="grid items-center gap-10 lg:grid-cols-2">
            <div>
                <div class="section-title-tag mb-4">
                    <span class="h-2 w-2 rounded-full bg-accent"></span>
                    Perjalanan Kami
                </div>
                <h2 class="font-heading text-3xl font-bold text-text-heading md:text-4xl">
                    Sejarah Berdirinya<br>
                    <span class="text-primary">SMK Alhidayah</span>
                </h2>

                <div class="mt-6 space-y-4 text-text-body/80 leading-relaxed">
                    <p>
                        SMK Alhidayah didirikan pada tahun 2010 di bawah naungan Yayasan Alhidayah. 
                        Berawal dari keprihatinan terhadap minimnya akses pendidikan menengah kejuruan 
                        yang berkualitas dan berbasis nilai-nilai Islam di wilayah Jakarta Selatan.
                    </p>
                    <p>
                        Dengan modal tekad yang kuat dan dukungan penuh dari masyarakat, sekolah ini 
                        memulai perjalanannya dengan 3 ruang kelas, 12 tenaga pengajar, dan 45 siswa 
                        perdana. Jurusan yang pertama kali dibuka adalah Akuntansi (kini AKL) dan 
                        Administrasi Perkantoran (kini MPLB).
                    </p>
                    <p>
                        Seiring berjalannya waktu, SMK Alhidayah terus berkembang. Pada tahun 2014, 
                        kami membuka jurusan Pemasaran untuk menjawab kebutuhan industri perdagangan 
                        dan bisnis digital. Dua tahun kemudian, tepatnya tahun 2016, jurusan Teknik 
                        Jaringan Komputer dan Telekomunikasi (TJKT) resmi dibuka.
                    </p>
                    <p>
                        Kini, SMK Alhidayah telah menjadi salah satu SMK swasta terdepan di wilayah 
                        Jakarta Selatan dengan lebih dari 500 siswa aktif, 40+ tenaga pendidik dan 
                        kependidikan, serta berbagai prestasi di tingkat kota, provinsi, hingga nasional.
                    </p>
                </div>
            </div>

            {{-- Timeline visual --}}
            <div class="space-y-6">
                @php
                    $timeline = [
                        ['year' => '2010', 'title' => 'Berdiri', 'desc' => 'Didirikan dengan 2 jurusan, 45 siswa, dan 12 guru', 'color' => 'bg-primary'],
                        ['year' => '2012', 'title' => 'Akreditasi A', 'desc' => 'Meraih akreditasi A untuk pertama kalinya', 'color' => 'bg-accent'],
                        ['year' => '2014', 'title' => 'Jurusan Baru', 'desc' => 'Membuka jurusan Pemasaran', 'color' => 'bg-primary'],
                        ['year' => '2016', 'title' => 'TJKT Hadir', 'desc' => 'Jurusan TJKT resmi dibuka', 'color' => 'bg-accent'],
                        ['year' => '2020', 'title' => 'Digitalisasi', 'desc' => 'Transformasi digital pembelajaran & administrasi', 'color' => 'bg-primary'],
                        ['year' => '2024', 'title' => '500+ Siswa', 'desc' => 'Mencapai lebih dari 500 siswa aktif', 'color' => 'bg-accent'],
                    ];
                @endphp
                @foreach($timeline as $t)
                <div class="group relative flex items-start gap-6">
                    {{-- Line connector --}}
                    <div class="flex flex-col items-center">
                        <div class="relative z-10 flex h-12 w-12 shrink-0 items-center justify-center rounded-full {{ $t['color'] }} text-sm font-bold text-white shadow-md transition-all duration-300 group-hover:scale-110">
                            {{ $t['year'] }}
                        </div>
                        @if(!$loop->last)
                        <div class="h-full w-0.5 bg-gradient-to-b from-primary/30 to-accent/30"></div>
                        @endif
                    </div>
                    {{-- Content --}}
                    <div class="pb-6 pt-1">
                        <h3 class="font-heading text-lg font-bold text-text-heading group-hover:text-primary transition-colors">{{ $t['title'] }}</h3>
                        <p class="mt-1 text-sm text-text-body/60">{{ $t['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- VISI & MISI --}}
{{-- ============================================ --}}
<section class="section-padding bg-surface-alt">
    <div class="container-page">
        <div class="section-title">
            <div class="section-title-tag justify-center">
                <span class="h-2 w-2 rounded-full bg-accent"></span>
                Visi & Misi
            </div>
            <h2 class="section-title-heading">Landasan & Arah<br>Pendidikan Kami</h2>
            <p class="section-title-text">Visi dan misi yang menjadi pedoman dalam setiap langkah pendidikan di SMK Alhidayah</p>
        </div>

        {{-- VISI --}}
        <div class="mx-auto max-w-4xl">
            <div class="card-hover relative overflow-hidden border-l-4 border-accent">
                <div class="absolute -top-16 -right-16 h-40 w-40 rounded-full bg-accent/5"></div>
                <div class="relative z-10">
                    <div class="mb-4 flex items-center gap-3">
                        <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br from-accent-dark to-accent shadow-lg">
                            <svg class="h-7 w-7 text-text-heading" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="text-xs font-semibold uppercase tracking-wider text-accent">Visi</span>
                            <h3 class="font-heading text-xl font-bold text-text-heading">Visi SMK Alhidayah</h3>
                        </div>
                    </div>
                    <p class="text-lg font-semibold leading-relaxed text-text-body/90 italic">
                        "Terwujudnya SMK Alhidayah Sebagai Lembaga Pendidikan dan Pelatihan yang Mencetak 
                        Sumber Daya Manusia yang Berakhlakul Karimah, Cerdas, Kompeten, dan Berwawasan Global 
                        Berlandaskan Iman dan Taqwa"
                    </p>
                </div>
            </div>

            {{-- MISI --}}
            <div class="mt-12">
                <div class="mb-8 flex items-center gap-3">
                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br from-primary to-primary-light shadow-lg">
                        <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-xs font-semibold uppercase tracking-wider text-primary">Misi</span>
                        <h3 class="font-heading text-xl font-bold text-text-heading">Misi SMK Alhidayah</h3>
                    </div>
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    @php
                        $misi = [
                            'Menyelenggarakan pendidikan dan pelatihan yang berbasis IMTAQ, IPTEK, dan lingkungan hidup.',
                            'Membentuk peserta didik yang berkarakter, religius, disiplin, jujur, dan bertanggung jawab.',
                            'Mengembangkan potensi peserta didik secara optimal melalui pembelajaran aktif, kreatif, efektif, dan menyenangkan.',
                            'Meningkatkan kompetensi tenaga pendidik dan kependidikan yang profesional dan berdaya saing global.',
                            'Menjalin kerjasama dengan DU/DI serta perguruan tinggi dalam rangka implementasi kurikulum dan penempatan lulusan.',
                            'Mengembangkan sarana prasarana dan sistem manajemen berbasis teknologi informasi yang modern.',
                        ];
                    @endphp
                    @foreach($misi as $i => $m)
                    <div class="group flex items-start gap-4 rounded-lg bg-white p-5 shadow-sm transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-primary to-primary-light text-sm font-bold text-white shadow-sm">
                            {{ $i + 1 }}
                        </div>
                        <p class="text-sm leading-relaxed text-text-body/80 pt-1">{{ $m }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- CTA SECTION --}}
{{-- ============================================ --}}
<section class="relative z-10 pb-20">
    <div class="container-page">
        <div class="relative overflow-hidden rounded-md cta-gradient px-8 py-12 md:px-16 md:py-14">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNMjAgMHYyME0wIDIwaDIwIiBzdHJva2U9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiIHN0cm9rZS13aWR0aD0iMSIvPjwvc3ZnPg==')] opacity-50"></div>
            <div class="relative flex flex-col items-center justify-between gap-6 md:flex-row">
                <div>
                    <h2 class="font-heading text-3xl font-bold text-white md:text-4xl">Ingin Tahu Lebih Banyak?</h2>
                    <p class="mt-2 text-white/85">Kunjungi halaman profil lainnya atau hubungi kami langsung</p>
                </div>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ url('/profil/struktur-organisasi') }}" class="theme-btn min-w-[160px] justify-center bg-white text-primary hover:bg-primary hover:text-white">
                        Struktur Organisasi
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    <a href="{{ url('/profil/guru') }}" class="btn-outline-white min-w-[140px] justify-center">
                        Lihat Guru
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
