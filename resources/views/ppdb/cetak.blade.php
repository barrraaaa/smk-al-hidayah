@extends('layouts.app')

@section('title', 'Bukti Pendaftaran PPDB — SMK Alhidayah')

@section('content')
<section class="section-padding pt-32">
    <div class="container-page">
        <div class="mx-auto max-w-2xl">
            <div class="card">
                {{-- Header --}}
                <div class="text-center border-b border-border pb-6 mb-6">
                    <h1 class="font-heading text-2xl font-bold text-text-heading">SMK Alhidayah</h1>
                    <p class="text-sm text-text-body/60">Bukti Pendaftaran PPDB {{ date('Y') }}/{{ date('Y') + 1 }}</p>
                </div>

                {{-- Info --}}
                <div class="space-y-4">
                    <div class="flex justify-between py-2 border-b border-border/50">
                        <span class="text-sm text-text-body/60">Nomor Pendaftaran</span>
                        <span class="text-sm font-bold text-primary">{{ $pendaftar->nomor_pendaftaran }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-border/50">
                        <span class="text-sm text-text-body/60">Nama Lengkap</span>
                        <span class="text-sm font-semibold text-text-heading">{{ $pendaftar->nama }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-border/50">
                        <span class="text-sm text-text-body/60">Tempat/Tanggal Lahir</span>
                        <span class="text-sm text-text-heading">{{ $pendaftar->tempat_lahir }}, {{ $pendaftar->tanggal_lahir?->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-border/50">
                        <span class="text-sm text-text-body/60">Alamat</span>
                        <span class="text-sm text-text-heading text-right max-w-[250px]">{{ $pendaftar->alamat }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-border/50">
                        <span class="text-sm text-text-body/60">Asal Sekolah</span>
                        <span class="text-sm text-text-heading">{{ $pendaftar->asal_sekolah }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-border/50">
                        <span class="text-sm text-text-body/60">Jurusan Dipilih</span>
                        <span class="text-sm font-semibold text-text-heading">{{ $pendaftar->jurusan?->nama ?? '—' }}</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-sm text-text-body/60">Status</span>
                        <span class="text-sm font-bold {{ $pendaftar->status === 'diterima' ? 'text-success' : ($pendaftar->status === 'ditolak' ? 'text-danger' : 'text-warning') }}">
                            {{ match($pendaftar->status) {
                                'menunggu_pembayaran' => 'Menunggu Pembayaran',
                                'menunggu_verifikasi' => 'Menunggu Verifikasi',
                                'terverifikasi' => 'Terverifikasi',
                                'diterima' => 'DITERIMA',
                                'ditolak' => 'Ditolak',
                                default => $pendaftar->status
                            } }}
                        </span>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="mt-8 pt-6 border-t border-border text-center text-xs text-text-body/50 space-y-1">
                    <p>Dicetak pada: {{ now()->format('d M Y H:i') }}</p>
                    <p>Dokumen ini adalah bukti pendaftaran resmi dari SMK Alhidayah</p>
                </div>
            </div>

            <div class="mt-6 flex justify-center gap-4">
                <button onclick="window.print()" class="theme-btn">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Cetak / Print
                </button>
                <a href="{{ route('ppdb.status', ['nomor' => $pendaftar->nomor_pendaftaran]) }}" class="theme-btn-outline">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</section>

@push('head')
<style>
    @media print {
        header, footer, .theme-btn, .theme-btn-outline { display: none !important; }
        .card { box-shadow: none !important; border: 1px solid #e5e7eb; }
        body { background: white; }
        .section-padding { padding: 0; }
    }
    .theme-btn-outline { display: inline-flex; align-items: center; gap: 0.5rem; border-radius: 0.5rem; border: 2px solid #254636; padding: 0.75rem 1.5rem; font-weight: 600; color: #254636; transition: all 0.2s; }
    .theme-btn-outline:hover { background: #254636; color: white; }
</style>
@endpush
@endsection
