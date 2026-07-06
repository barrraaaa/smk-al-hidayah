@extends('layouts.app')

@php $settings = \App\Models\SchoolSetting::getSettings(); @endphp

@section('title', 'Hubungi Kami — ' . $settings->school_name)

@section('content')
{{-- Hero --}}
<section class="bg-primary-dark relative overflow-hidden pt-32">
    @if(!empty($settings->hero_image))
    <img src="{{ Storage::url($settings->hero_image) }}" alt="" class="absolute inset-0 h-full w-full object-cover">
    @endif
    <div class="absolute inset-0 bg-gradient-to-r {{ !empty($settings->hero_image) ? 'from-primary/65 via-primary/55 to-primary-dark/65' : 'from-primary/95 via-primary/90 to-primary-dark/95' }}"></div>
    <div class="container-page relative py-16 md:py-20 text-center">
        <div class="section-title-tag justify-center mb-4">
            <span class="text-accent">Kontak</span>
        </div>
        <h1 class="font-heading text-4xl font-bold text-white">Hubungi Kami</h1>
        <p class="mx-auto mt-3 max-w-xl text-white/75">Punya pertanyaan atau ingin tahu lebih lanjut? Silakan hubungi kami</p>
    </div>
</section>

<section class="section-padding">
    <div class="container-page">
        <div class="grid gap-10 lg:grid-cols-2">
            {{-- Info Kontak --}}
            <div>
                <h2 class="font-heading text-2xl font-bold text-text-heading mb-6">Informasi Kontak</h2>
                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-md bg-primary text-white">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-heading font-semibold text-text-heading">Alamat</h3>
                            <p class="mt-1 text-sm text-text-body/70">{{ $settings->address ?: 'Belum diatur' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-md bg-accent text-text-heading">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-heading font-semibold text-text-heading">Telepon</h3>
                            <p class="mt-1 text-sm text-text-body/70">{{ $settings->phone ?: 'Belum diatur' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-md bg-primary text-white">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-heading font-semibold text-text-heading">Email</h3>
                            <p class="mt-1 text-sm text-text-body/70">
                                @if($settings->email)
                                <a href="mailto:{{ $settings->email }}" class="text-primary hover:underline">{{ $settings->email }}</a><br>
                                @endif
                                @if($settings->ppdb_email)
                                <a href="mailto:{{ $settings->ppdb_email }}" class="text-primary hover:underline">{{ $settings->ppdb_email }} (PPDB)</a>
                                @endif
                                @if(!$settings->email && !$settings->ppdb_email)
                                <span class="text-text-body/50">Belum diatur</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-md bg-accent text-text-heading">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-heading font-semibold text-text-heading">Jam Operasional</h3>
                            <p class="mt-1 text-sm text-text-body/70">Senin - Jumat: 07.00 - 16.00 WIB<br>Sabtu: 07.00 - 12.00 WIB</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Form --}}
            <div class="card">
                <h2 class="font-heading text-2xl font-bold text-text-heading mb-6">Kirim Pesan</h2>

                @if(session('success'))
                <div class="mb-6 flex items-center gap-3 rounded-xl bg-green-50 px-5 py-4 text-sm text-green-700 ring-1 ring-green-200">
                    <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('kontak.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="nama" class="mb-1.5 block text-sm font-medium text-text-heading">Nama <span class="text-red-500">*</span></label>
                            <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                                class="input-field @error('nama') ring-2 ring-red-300 border-red-300 @enderror"
                                placeholder="Masukkan nama Anda" required>
                            @error('nama')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="mb-1.5 block text-sm font-medium text-text-heading">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                class="input-field @error('email') ring-2 ring-red-300 border-red-300 @enderror"
                                placeholder="contoh@email.com" required>
                            @error('email')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="no_telepon" class="mb-1.5 block text-sm font-medium text-text-heading">No. Telepon <span class="text-gray-400 text-xs">(opsional)</span></label>
                        <input type="tel" name="no_telepon" id="no_telepon" value="{{ old('no_telepon') }}"
                            class="input-field @error('no_telepon') ring-2 ring-red-300 border-red-300 @enderror"
                            placeholder="08xx-xxxx-xxxx">
                        @error('no_telepon')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="pesan" class="mb-1.5 block text-sm font-medium text-text-heading">Pesan <span class="text-red-500">*</span></label>
                        <textarea name="pesan" id="pesan" rows="5"
                            class="input-field @error('pesan') ring-2 ring-red-300 border-red-300 @enderror"
                            placeholder="Tulis pesan Anda di sini..." required>{{ old('pesan') }}</textarea>
                        @error('pesan')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="theme-btn w-full justify-center">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>

        {{-- Maps Embed --}}
        @if($settings->maps_embed_url)
        <div class="mt-16">
            <h2 class="font-heading text-2xl font-bold text-text-heading mb-6 text-center">Lokasi Kami</h2>
            <div class="overflow-hidden rounded-2xl shadow-lg ring-1 ring-gray-100">
                <iframe
                    src="{{ $settings->maps_embed_url }}"
                    width="100%"
                    height="300"
                    style="border:0; display: block;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Lokasi {{ $settings->school_name }}"
                    class="hover:opacity-95 transition-opacity md:h-[400px]">
                </iframe>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
