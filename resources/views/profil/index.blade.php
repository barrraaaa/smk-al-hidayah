@extends('layouts.app')

@section('title', 'Profil Sekolah — SMK Alhidayah')

@section('content')
<section class="section-padding pt-32">
    <div class="container-page">
        <div class="section-title">
            <span class="badge-green mb-4">Profil</span>
            <h2>Profil SMK Alhidayah</h2>
            <p>Informasi lengkap tentang sekolah kami</p>
        </div>
        <div class="mx-auto max-w-3xl space-y-6 text-center">
            <div class="card">
                <p class="leading-relaxed text-text-body/80">
                    SMK Alhidayah adalah Sekolah Menengah Kejuruan swasta di bawah naungan Yayasan Alhidayah.
                    Berdiri sejak tahun 2010, kami berkomitmen mencetak lulusan yang kompeten, berakhlak mulia, dan siap kerja.
                </p>
            </div>
            <div class="grid gap-4 md:grid-cols-3">
                <a href="{{ url('/profil/sejarah') }}" class="card-hover text-center">
                    <div class="text-2xl mb-2">📜</div>
                    <h3 class="font-heading font-semibold">Sejarah & Visi Misi</h3>
                </a>
                <a href="{{ url('/profil/struktur-organisasi') }}" class="card-hover text-center">
                    <div class="text-2xl mb-2">🏛️</div>
                    <h3 class="font-heading font-semibold">Struktur Organisasi</h3>
                </a>
                <a href="{{ url('/profil/guru') }}" class="card-hover text-center">
                    <div class="text-2xl mb-2">👨‍🏫</div>
                    <h3 class="font-heading font-semibold">Guru & Tenaga Pengajar</h3>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
