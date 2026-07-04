@extends('layouts.app')

@section('title', 'Cek Status Pendaftaran — SMK Alhidayah')

@section('content')
{{-- Hero --}}
<section class="bg-primary-dark relative overflow-hidden pt-32">
    <div class="absolute inset-0 bg-gradient-to-r from-primary/95 via-primary/90 to-primary-dark/95"></div>
    <div class="container-page relative py-20 text-center">
        <div class="section-title-tag justify-center mb-4">
            <span class="text-accent">PPDB {{ date('Y') }}</span>
        </div>
        <h1 class="font-heading text-4xl font-bold text-white">Cek Status Pendaftaran</h1>
        <p class="mx-auto mt-3 max-w-xl text-white/75">Masukkan nomor pendaftaran untuk melihat status terkini</p>
    </div>
</section>

<section class="section-padding">
    <div class="container-page">
        <div class="mx-auto max-w-2xl">
            {{-- Form Cari --}}
            <div class="card mb-8">
                <form action="{{ route('ppdb.status.cari') }}" method="POST" class="flex gap-4">
                    @csrf
                    <div class="flex-1">
                        <input type="text" name="nomor" value="{{ old('nomor', $nomor ?? '') }}" 
                               class="input-field w-full" placeholder="Masukkan nomor pendaftaran (contoh: {{ date('Y') }}-00001)" required>
                    </div>
                    <button type="submit" class="theme-btn whitespace-nowrap">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Cari
                    </button>
                </form>
            </div>

            {{-- Hasil --}}
            @if($pendaftar)
            <div class="space-y-6">
                @if(session('success'))
                <div class="rounded-md bg-success/10 px-5 py-4 text-sm text-success font-medium">
                    {{ session('success') }}
                </div>
                @endif

                {{-- Card Status --}}
                <div class="card overflow-hidden">
                    @php
                    $statusConfig = [
                        'menunggu_pembayaran' => ['label' => 'Menunggu Pembayaran', 'color' => 'bg-warning/10 text-yellow-700 border-warning', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                        'menunggu_verifikasi' => ['label' => 'Menunggu Verifikasi', 'color' => 'bg-info/10 text-blue-700 border-info', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                        'terverifikasi' => ['label' => 'Terverifikasi', 'color' => 'bg-success/10 text-green-700 border-success', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                        'diterima' => ['label' => 'DITERIMA 🎉', 'color' => 'bg-success/10 text-green-700 border-success', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                        'ditolak' => ['label' => 'Ditolak', 'color' => 'bg-danger/10 text-red-700 border-danger', 'icon' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ];
                    $status = $statusConfig[$pendaftar->status] ?? $statusConfig['menunggu_pembayaran'];
                    @endphp

                    <div class="flex items-center gap-4 border-b border-border pb-5">
                        <div class="flex h-20 w-20 items-center justify-center rounded-full bg-gradient-to-br from-primary to-primary-light shadow-lg">
                            @if($pendaftar->status === 'diterima')
                            <span class="text-4xl">🎉</span>
                            @else
                            <svg class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            @endif
                        </div>
                        <div>
                            <h2 class="font-heading text-2xl font-bold text-text-heading">{{ $pendaftar->nama }}</h2>
                            <p class="text-sm text-text-body/60">Nomor: <strong class="text-primary">{{ $pendaftar->nomor_pendaftaran }}</strong></p>
                        </div>
                    </div>

                    <div class="mt-5 flex items-center gap-3 rounded-lg {{ $status['color'] }} border px-5 py-4">
                        <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $status['icon'] }}"/>
                        </svg>
                        <div>
                            <p class="font-semibold">{{ $status['label'] }}</p>
                            @if($pendaftar->alasan_ditolak)
                            <p class="mt-1 text-sm opacity-80">Alasan: {{ $pendaftar->alasan_ditolak }}</p>
                            @endif
                            @if($pendaftar->verified_at)
                            <p class="mt-1 text-xs opacity-70">Diverifikasi: {{ $pendaftar->verified_at->format('d M Y H:i') }}</p>
                            @endif
                        </div>
                    </div>

                    {{-- Data Pendaftar --}}
                    <div class="mt-6 grid gap-4 sm:grid-cols-2">
                        <div><span class="text-xs text-text-body/50 uppercase tracking-wider">Tempat/Tgl Lahir</span><p class="text-sm font-medium text-text-heading">{{ $pendaftar->tempat_lahir }}, {{ $pendaftar->tanggal_lahir?->format('d M Y') }}</p></div>
                        <div><span class="text-xs text-text-body/50 uppercase tracking-wider">Jurusan</span><p class="text-sm font-medium text-text-heading">{{ $pendaftar->jurusan?->nama ?? '—' }}</p></div>
                        <div><span class="text-xs text-text-body/50 uppercase tracking-wider">Asal Sekolah</span><p class="text-sm font-medium text-text-heading">{{ $pendaftar->asal_sekolah }}</p></div>
                        <div><span class="text-xs text-text-body/50 uppercase tracking-wider">No. Telepon</span><p class="text-sm font-medium text-text-heading">{{ $pendaftar->no_telepon }}</p></div>
                    </div>

                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="{{ route('ppdb.cetak', $pendaftar->nomor_pendaftaran) }}" target="_blank" class="theme-btn-outline text-sm">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                            </svg>
                            Cetak Bukti
                        </a>
                    </div>
                </div>

                {{-- Upload Bukti Bayar (hanya jika menunggu_pembayaran) --}}
                @if($pendaftar->status === 'menunggu_pembayaran')
                <div class="card">
                    <h3 class="font-heading text-xl font-bold text-text-heading mb-4">Upload Bukti Pembayaran</h3>
                    <div class="mb-5 rounded-lg bg-primary/5 px-5 py-4 text-sm text-text-body/80">
                        <p class="font-semibold text-primary mb-2">Informasi Pembayaran:</p>
                        <p>Transfer ke rekening berikut:</p>
                        <p class="mt-2 font-bold text-text-heading">Bank Syariah Indonesia (BSI)<br>1234.5678.90 a.n. Yayasan Alhidayah</p>
                        <p class="mt-2 text-xs">Nominal: <strong>Hubungi admin</strong></p>
                    </div>

                    <form action="{{ route('ppdb.bukti') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <input type="hidden" name="pendaftar_id" value="{{ $pendaftar->id }}">
                        <div>
                            <label class="form-label">Upload Bukti Transfer (PDF/JPG/PNG, maks. 2MB)</label>
                            <input type="file" name="file" accept=".jpg,.jpeg,.png,.pdf" class="input-field" required>
                        </div>
                        <div>
                            <label class="form-label">Keterangan (opsional)</label>
                            <input type="text" name="keterangan" class="input-field" placeholder="Contoh: Transfer dari BCA a.n. Orang Tua">
                        </div>
                        <button type="submit" class="theme-btn">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            Upload Bukti Bayar
                        </button>
                    </form>
                </div>
                @endif

                {{-- Status diterima --}}
                @if($pendaftar->status === 'diterima')
                <div class="card text-center">
                    <span class="text-6xl block mb-4">🎉</span>
                    <h3 class="font-heading text-2xl font-bold text-text-heading">Selamat!</h3>
                    <p class="mt-2 text-text-body/70">Anda telah diterima di SMK Alhidayah jurusan <strong>{{ $pendaftar->jurusan?->nama }}</strong>.</p>
                    <p class="mt-4 text-sm text-text-body/60">Silakan cetak bukti pendaftaran untuk informasi lebih lanjut.</p>
                    <a href="{{ route('ppdb.cetak', $pendaftar->nomor_pendaftaran) }}" target="_blank" class="theme-btn mt-6 inline-flex">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                        </svg>
                        Cetak Bukti Pendaftaran
                    </a>
                </div>
                @endif

                {{-- Ditolak --}}
                @if($pendaftar->status === 'ditolak')
                <div class="card text-center border-danger/30">
                    <span class="text-6xl block mb-4">😔</span>
                    <h3 class="font-heading text-2xl font-bold text-danger">Maaf</h3>
                    <p class="mt-2 text-text-body/70">Pendaftaran Anda belum dapat kami terima.</p>
                    @if($pendaftar->alasan_ditolak)
                    <p class="mt-2 text-sm text-text-body/60">Alasan: {{ $pendaftar->alasan_ditolak }}</p>
                    @endif
                </div>
                @endif
            </div>
            @elseif($nomor)
            <div class="card text-center py-10">
                <span class="text-6xl block mb-4">🔍</span>
                <h3 class="font-heading text-xl font-bold text-text-heading">Data Tidak Ditemukan</h3>
                <p class="mt-2 text-text-body/70">Nomor pendaftaran <strong>"{{ $nomor }}"</strong> tidak ditemukan. Silakan periksa kembali nomor Anda.</p>
            </div>
            @endif
        </div>
    </div>
</section>

@push('head')
<style>
    .form-label { display: block; font-size: 0.875rem; font-weight: 500; color: #1f2937; margin-bottom: 0.375rem; }
    .theme-btn-outline { display: inline-flex; align-items: center; gap: 0.5rem; border-radius: 0.5rem; border: 2px solid #254636; padding: 0.75rem 1.5rem; font-weight: 600; color: #254636; transition: all 0.2s; }
    .theme-btn-outline:hover { background: #254636; color: white; }
</style>
@endpush
@endsection
