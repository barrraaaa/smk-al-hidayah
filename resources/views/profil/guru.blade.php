@extends('layouts.app')

@section('title', 'Guru & Tenaga Pengajar — SMK Alhidayah')

@section('content')
{{-- Hero kecil --}}
<section class="bg-primary-dark relative overflow-hidden pt-32">
    <div class="absolute inset-0 bg-gradient-to-r from-primary/95 via-primary/90 to-primary-dark/95"></div>
    <div class="container-page relative py-16">
        <div class="text-center">
            <div class="section-title-tag justify-center mb-4">
                <span class="text-accent">Profil</span>
            </div>
            <h1 class="font-heading text-4xl font-bold text-white">Guru & Tenaga Pengajar</h1>
            <p class="mt-3 text-white/75">Tenaga pendidik profesional SMK Alhidayah</p>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container-page">
        {{-- Filter Jurusan --}}
        @if($jurusans->count() > 0)
        <div class="mb-10 flex flex-wrap justify-center gap-3">
            <button class="filter-btn active" data-filter="all">Semua</button>
            @foreach($jurusans as $j)
            <button class="filter-btn" data-filter="{{ $j->slug }}">{{ $j->nama }}</button>
            @endforeach
        </div>
        @endif

        {{-- Grid Guru --}}
        <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4" id="guru-grid">
            @forelse($gurus as $g)
            <div class="guru-card card-hover text-center" data-jurusan="{{ $g->jurusan?->slug ?? 'none' }}">
                <div class="relative mx-auto mb-4 h-40 w-40 overflow-hidden rounded-full bg-gradient-to-br from-primary to-primary-light">
                    @if($g->foto)
                    <img src="{{ asset('storage/' . $g->foto) }}" alt="{{ $g->nama }}" class="h-full w-full object-cover">
                    @else
                    <div class="flex h-full items-center justify-center text-4xl font-bold text-white">
                        {{ substr($g->nama, 0, 1) }}
                    </div>
                    @endif
                </div>
                <h3 class="font-heading text-lg font-semibold text-text-heading">{{ $g->nama }}</h3>
                <p class="mt-1 text-sm text-text-body/60">{{ $g->jabatan ?? 'Guru' }}</p>
                @if($g->jurusan)
                <span class="mt-2 inline-block rounded-full bg-primary/10 px-3 py-1 text-xs text-primary">{{ $g->jurusan->nama }}</span>
                @endif
                @if($g->nip)
                <p class="mt-2 text-xs text-text-body/40">NIP: {{ $g->nip }}</p>
                @endif
                @if($g->bio)
                <p class="mt-3 text-sm text-text-body/70 line-clamp-3">{{ $g->bio }}</p>
                @endif
            </div>
            @empty
            <div class="col-span-full text-center py-16 text-text-body/60">
                <p class="text-4xl mb-4">👨‍🏫</p>
                <p>Data guru belum tersedia. Silakan tambahkan melalui panel admin.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

@push('scripts')
<script>
    // Filter guru by jurusan
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            const filter = this.dataset.filter;
            document.querySelectorAll('.guru-card').forEach(card => {
                if (filter === 'all' || card.dataset.jurusan === filter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
</script>
@endpush
@endsection
