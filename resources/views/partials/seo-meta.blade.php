@php
    $title = $title ?? ($settings->school_name ?? 'SMK Alhidayah');
    $description = $description ?? ($settings->description ?? 'SMK Alhidayah Jakarta — Sekolah Menengah Kejuruan unggulan dengan jurusan AKL, Pemasaran, MPLB, dan TJKT.');
    $url = $url ?? url()->current();
    $image = $image ?? asset('og-image.jpg');
    $type = $type ?? 'website';
@endphp

{{-- Canonical --}}
<link rel="canonical" href="{{ $url }}">

{{-- Open Graph --}}
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:url" content="{{ $url }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:type" content="{{ $type }}">
<meta property="og:site_name" content="{{ $settings->school_name ?? 'SMK Alhidayah' }}">
<meta property="og:locale" content="id_ID">

{{-- Twitter Card --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $image }}">

{{-- Additional SEO --}}
<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow">
<meta name="author" content="{{ $settings->school_name ?? 'SMK Alhidayah' }}">
<link rel="alternate" type="application/rss+xml" title="{{ $settings->school_name ?? 'SMK Alhidayah' }}" href="{{ url('/sitemap.xml') }}">
