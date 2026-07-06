@extends('layouts.app')

@section('title', 'Pengumuman Kelulusan — SMK Alhidayah')

@section('content')
<section class="min-h-screen pt-28 md:pt-32 pb-16 md:pb-20 bg-primary-dark">
    <div class="container-page">
        {{-- Header --}}
        <div class="section-title">
            <span class="badge-accent mb-4 text-white">Kelulusan</span>
            <h1 class="font-heading text-5xl font-bold leading-tight md:text-6xl lg:text-7xl lg:leading-[1.1]">
                <span class="text-accent">Pengumuman Kelulusan</span>
            </h1>
            <p class="text-white">Masukkan nomor ujian untuk melihat hasil kelulusan</p>
        </div>

        {{-- Search Form --}}
        <div class="mx-auto mb-16 max-w-xl">
            <form action="{{ route('kelulusan.cari') }}" method="POST" class="rounded-2xl bg-white p-6 shadow-lg ring-1 ring-gray-100">
                @csrf
                <div class="flex flex-col gap-4 sm:flex-row sm:items-end">
                    <div class="flex-1">
                        <label for="nomor_ujian" class="mb-1.5 block text-sm font-semibold text-text-heading">Nomor Ujian / NISN</label>
                        <input type="text" name="nomor_ujian" id="nomor_ujian" value="{{ old('nomor_ujian', $nomor_ujian ?? '') }}"
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-text-body outline-none transition-all duration-200 focus:border-primary focus:bg-white focus:ring-2 focus:ring-primary/20"
                            placeholder="Masukkan nomor ujian Anda..."
                            required>
                        @error('nomor_ujian')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit"
                        class="flex items-center gap-2 rounded-xl bg-primary px-8 py-3 font-semibold text-white transition-all duration-200 hover:bg-primary-700 hover:shadow-lg active:scale-[0.98]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Lihat Hasil
                    </button>
                </div>
            </form>
        </div>

        {{-- Result Section --}}
        @if ($searched)
            <div class="mx-auto max-w-xl animate-fade-in-up">
                @if ($result)
                    {{-- Found --}}
                    <div class="overflow-hidden rounded-2xl bg-white shadow-xl ring-1 ring-gray-100">
                        {{-- Status Banner --}}
                        @php $isLulus = $result->hasil === 'lulus'; @endphp
                        <div class="{{ $isLulus ? 'bg-gradient-to-r from-green-500 to-emerald-500' : 'bg-gradient-to-r from-red-500 to-rose-500' }} animate-slide-down px-8 py-8 text-center">
                            <div class="mx-auto mb-3 flex h-20 w-20 items-center justify-center rounded-full bg-white/20 backdrop-blur-sm">
                                @if ($isLulus)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                @endif
                            </div>
                            <h3 class="text-3xl font-black tracking-wide text-white drop-shadow-sm">
                                {{ $isLulus ? '🎉  L U L U S  🎉' : 'TIDAK LULUS' }}
                            </h3>
                        </div>

                        {{-- Detail --}}
                        <div class="space-y-4 p-8">
                            <div class="animate-fade-in-up" style="animation-delay: 0.2s">
                                <p class="text-sm font-medium text-gray-400">Nama</p>
                                <p class="text-lg font-semibold text-text-heading">{{ $result->nama }}</p>
                            </div>
                            <div class="animate-fade-in-up" style="animation-delay: 0.3s">
                                <p class="text-sm font-medium text-gray-400">Nomor Ujian</p>
                                <p class="text-lg font-semibold text-text-heading">{{ $result->nomor_ujian }}</p>
                            </div>
                            <div class="animate-fade-in-up" style="animation-delay: 0.4s">
                                <p class="text-sm font-medium text-gray-400">Jurusan</p>
                                <p class="text-lg font-semibold text-text-heading">{{ $result->jurusan->nama ?? '-' }}</p>
                            </div>
                            <div class="animate-fade-in-up" style="animation-delay: 0.5s">
                                <p class="text-sm font-medium text-gray-400">Hasil</p>
                                <span class="{{ $isLulus ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} inline-block rounded-lg px-4 py-1.5 text-sm font-bold">
                                    {{ $isLulus ? '✅ Dinyatakan LULUS' : '❌ Dinyatakan TIDAK LULUS' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- CTA --}}
                    <div class="mt-6 animate-fade-in-up text-center" style="animation-delay: 0.6s">
                        <a href="{{ route('beranda') }}" class="text-sm font-medium text-primary transition-colors hover:text-primary-600 hover:underline">
                            &larr; Kembali ke Beranda
                        </a>
                    </div>

                @else
                    {{-- Not Found --}}
                    <div class="animate-fade-in-up rounded-2xl bg-white p-8 text-center shadow-xl ring-1 ring-gray-100">
                        <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-amber-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="mb-2 text-xl font-bold text-text-heading">Data Tidak Ditemukan</h3>
                        <p class="mb-6 text-gray-500">
                            Nomor ujian <strong class="font-semibold text-text-heading">&ldquo;{{ $nomor_ujian ?? '' }}&rdquo;</strong> tidak ditemukan. 
                            Silakan periksa kembali nomor ujian Anda atau hubungi pihak sekolah.
                        </p>
                        <a href="{{ route('kelulusan') }}" class="inline-flex items-center gap-2 rounded-xl bg-primary px-6 py-2.5 font-semibold text-white transition-all duration-200 hover:bg-primary-700 hover:shadow-lg">
                            Coba Lagi
                        </a>
                    </div>
                @endif
            </div>
        @endif
    </div>
</section>
@endsection

@push('styles')
<style>
    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes slide-down {
        from { opacity: 0; transform: translateY(-10px) scaleY(0.95); }
        to   { opacity: 1; transform: translateY(0) scaleY(1); }
    }
    .animate-fade-in-up {
        animation: fade-in-up 0.5s ease-out both;
    }
    .animate-slide-down {
        animation: slide-down 0.4s ease-out both;
    }
</style>
@endpush
