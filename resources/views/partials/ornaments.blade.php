@props([
    'type' => 'corner-top-right', // corner-top-right, corner-top-left, corner-bottom-right, corner-bottom-left, divider, dots, arabesque
    'color' => 'accent', // accent, primary, white, primary-light
])

@php
    $colorMap = [
        'accent' => '#F3B815',
        'primary' => '#254636',
        'white' => '#ffffff',
        'primary-light' => '#50bc84',
        'accent-light' => '#F2CD64',
        'primary-dark' => '#1a3328',
    ];
    $c = $colorMap[$color] ?? $colorMap['accent'];
@endphp

{{-- ============================================ --}}
{{-- DECORATIVE CORNER TOP-RIGHT (Hero sections) --}}
{{-- ============================================ --}}
@if($type === 'corner-top-right')
<div {{ $attributes->merge(['class' => 'pointer-events-none absolute -top-10 -right-10 opacity-[0.07]']) }}>
    <svg width="260" height="260" viewBox="0 0 260 260" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 260V0H260" stroke="{{ $c }}" stroke-width="2"/>
        <path d="M30 260V30H260" stroke="{{ $c }}" stroke-width="1.5" opacity="0.7"/>
        <path d="M60 260V60H260" stroke="{{ $c }}" stroke-width="1" opacity="0.5"/>
        <path d="M100 260V100H260" stroke="{{ $c }}" stroke-width="0.7" opacity="0.3"/>
        {{-- Diamond accents --}}
        <rect x="180" y="10" width="16" height="16" rx="3" transform="rotate(45 180 10)" stroke="{{ $c }}" stroke-width="1.5" fill="none"/>
        <rect x="220" y="40" width="10" height="10" rx="2" transform="rotate(45 220 40)" stroke="{{ $c }}" stroke-width="1" fill="none"/>
        <circle cx="130" cy="130" r="40" stroke="{{ $c }}" stroke-width="1" fill="none" opacity="0.4"/>
        <circle cx="170" cy="90" r="25" stroke="{{ $c }}" stroke-width="0.7" fill="none" opacity="0.3"/>
    </svg>
</div>
@endif

{{-- ============================================ --}}
{{-- DECORATIVE CORNER BOTTOM-LEFT (Hero sections) --}}
{{-- ============================================ --}}
@if($type === 'corner-bottom-left')
<div {{ $attributes->merge(['class' => 'pointer-events-none absolute -bottom-10 -left-10 opacity-[0.07]']) }}>
    <svg width="220" height="220" viewBox="0 0 220 220" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M220 0V220H0" stroke="{{ $c }}" stroke-width="2"/>
        <path d="M190 0V190H0" stroke="{{ $c }}" stroke-width="1.5" opacity="0.7"/>
        <path d="M160 0V160H0" stroke="{{ $c }}" stroke-width="1" opacity="0.5"/>
        <path d="M120 0V120H0" stroke="{{ $c }}" stroke-width="0.7" opacity="0.3"/>
        <rect x="10" y="160" width="16" height="16" rx="3" transform="rotate(45 10 160)" stroke="{{ $c }}" stroke-width="1.5" fill="none"/>
        <circle cx="100" cy="100" r="35" stroke="{{ $c }}" stroke-width="1" fill="none" opacity="0.4"/>
    </svg>
</div>
@endif

{{-- ============================================ --}}
{{-- SECTION DIVIDER (Floral/Islamic pattern) --}}
{{-- ============================================ --}}
@if($type === 'divider')
<div {{ $attributes->merge(['class' => 'flex items-center justify-center gap-4 my-8']) }}>
    <div class="h-px flex-1 bg-gradient-to-r from-transparent via-{{ $color }}/20 to-transparent"></div>
    <svg width="40" height="20" viewBox="0 0 40 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="opacity-40">
        <circle cx="20" cy="10" r="3" fill="{{ $c }}"/>
        <path d="M20 10L28 2" stroke="{{ $c }}" stroke-width="1.5" opacity="0.6"/>
        <path d="M20 10L12 2" stroke="{{ $c }}" stroke-width="1.5" opacity="0.6"/>
        <path d="M20 10L28 18" stroke="{{ $c }}" stroke-width="1.5" opacity="0.6"/>
        <path d="M20 10L12 18" stroke="{{ $c }}" stroke-width="1.5" opacity="0.6"/>
        <circle cx="28" cy="2" r="1.5" fill="{{ $c }}" opacity="0.4"/>
        <circle cx="12" cy="2" r="1.5" fill="{{ $c }}" opacity="0.4"/>
        <circle cx="28" cy="18" r="1.5" fill="{{ $c }}" opacity="0.4"/>
        <circle cx="12" cy="18" r="1.5" fill="{{ $c }}" opacity="0.4"/>
    </svg>
    <div class="h-px flex-1 bg-gradient-to-r from-transparent via-{{ $color }}/20 to-transparent"></div>
</div>
@endif

{{-- ============================================ --}}
{{-- ARABESQUE / FLORAL MOTIF (Background decor) --}}
{{-- ============================================ --}}
@if($type === 'arabesque')
<div {{ $attributes->merge(['class' => 'pointer-events-none absolute opacity-[0.04]']) }}>
    <svg width="180" height="180" viewBox="0 0 180 180" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M90 10C90 10 100 40 90 60C80 40 90 10 90 10Z" fill="{{ $c }}"/>
        <path d="M90 170C90 170 80 140 90 120C100 140 90 170 90 170Z" fill="{{ $c }}"/>
        <path d="M10 90C10 90 40 80 60 90C40 100 10 90 10 90Z" fill="{{ $c }}"/>
        <path d="M170 90C170 90 140 100 120 90C140 80 170 90 170 90Z" fill="{{ $c }}"/>
        <circle cx="90" cy="90" r="20" stroke="{{ $c }}" stroke-width="1" fill="none"/>
        <circle cx="90" cy="90" r="35" stroke="{{ $c }}" stroke-width="0.7" fill="none" opacity="0.7"/>
        <circle cx="90" cy="90" r="55" stroke="{{ $c }}" stroke-width="0.5" fill="none" opacity="0.4"/>
        {{-- Petal shapes --}}
        <ellipse cx="90" cy="45" rx="6" ry="15" fill="{{ $c }}" opacity="0.6" transform="rotate(0 90 45)"/>
        <ellipse cx="90" cy="135" rx="6" ry="15" fill="{{ $c }}" opacity="0.6" transform="rotate(0 90 135)"/>
        <ellipse cx="45" cy="90" rx="6" ry="15" fill="{{ $c }}" opacity="0.6" transform="rotate(-90 45 90)"/>
        <ellipse cx="135" cy="90" rx="6" ry="15" fill="{{ $c }}" opacity="0.6" transform="rotate(-90 135 90)"/>
    </svg>
</div>
@endif

{{-- ============================================ --}}
{{-- LIGHT DOTS PATTERN (Section background) --}}
{{-- ============================================ --}}
@if($type === 'dots')
<div {{ $attributes->merge(['class' => 'pointer-events-none absolute inset-0 opacity-[0.03]']) }}>
    <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <pattern id="dots-{{ $color }}" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                <circle cx="20" cy="20" r="1.5" fill="{{ $c }}"/>
            </pattern>
        </defs>
        <rect width="100%" height="100%" fill="url(#dots-{{ $color }})"/>
    </svg>
</div>
@endif

{{-- ============================================ --}}
{{-- STAR / TWINKLE MOTIF --}}
{{-- ============================================ --}}
@if($type === 'stars')
<div {{ $attributes->merge(['class' => 'pointer-events-none absolute inset-0 overflow-hidden opacity-[0.05]']) }}>
    <svg width="100%" height="100%" viewBox="0 0 400 400" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M50 50 L53 40 L56 50 L66 53 L56 56 L53 66 L50 56 L40 53 Z" fill="{{ $c }}"/>
        <path d="M150 120 L152 114 L154 120 L160 122 L154 124 L152 130 L150 124 L144 122 Z" fill="{{ $c }}"/>
        <path d="M300 80 L302 74 L304 80 L310 82 L304 84 L302 90 L300 84 L294 82 Z" fill="{{ $c }}"/>
        <path d="M80 200 L82 194 L84 200 L90 202 L84 204 L82 210 L80 204 L74 202 Z" fill="{{ $c }}"/>
        <path d="M350 250 L352 244 L354 250 L360 252 L354 254 L352 260 L350 254 L344 252 Z" fill="{{ $c }}"/>
        <path d="M200 350 L202 344 L204 350 L210 352 L204 354 L202 360 L200 354 L194 352 Z" fill="{{ $c }}"/>
        <path d="M120 320 L121 317 L122 320 L125 321 L122 322 L121 325 L120 322 L117 321 Z" fill="{{ $c }}"/>
        <path d="M280 180 L281 177 L282 180 L285 181 L282 182 L281 185 L280 182 L277 181 Z" fill="{{ $c }}"/>
    </svg>
</div>
@endif

{{-- ============================================ --}}
{{-- SECTION TITLE DECORATION (Right side of headings) --}}
{{-- ============================================ --}}
@if($type === 'heading-accent')
<div {{ $attributes->merge(['class' => 'inline-flex items-center gap-1']) }}>
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="12" cy="12" r="2" fill="{{ $c }}"/>
        <path d="M12 12L16 6" stroke="{{ $c }}" stroke-width="1.5" opacity="0.6"/>
        <path d="M12 12L8 6" stroke="{{ $c }}" stroke-width="1.5" opacity="0.6"/>
        <path d="M12 12L16 18" stroke="{{ $c }}" stroke-width="1.5" opacity="0.6"/>
        <path d="M12 12L8 18" stroke="{{ $c }}" stroke-width="1.5" opacity="0.6"/>
        <circle cx="16" cy="6" r="1" fill="{{ $c }}" opacity="0.4"/>
        <circle cx="8" cy="6" r="1" fill="{{ $c }}" opacity="0.4"/>
        <circle cx="16" cy="18" r="1" fill="{{ $c }}" opacity="0.4"/>
        <circle cx="8" cy="18" r="1" fill="{{ $c }}" opacity="0.4"/>
    </svg>
</div>
@endif

{{-- ============================================ --}}
{{-- CTA CORNER DECORATION --}}
{{-- ============================================ --}}
@if($type === 'cta')
<div {{ $attributes->merge(['class' => 'pointer-events-none absolute inset-0 overflow-hidden']) }}>
    <svg width="100%" height="100%" viewBox="0 0 400 200" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
        {{-- Top left motif --}}
        <circle cx="0" cy="0" r="120" stroke="{{ $c }}" stroke-width="1" fill="none" opacity="0.08"/>
        <circle cx="0" cy="0" r="80" stroke="{{ $c }}" stroke-width="0.7" fill="none" opacity="0.06"/>
        {{-- Bottom right motif --}}
        <circle cx="420" cy="220" r="100" stroke="{{ $c }}" stroke-width="1" fill="none" opacity="0.08"/>
        <circle cx="420" cy="220" r="60" stroke="{{ $c }}" stroke-width="0.7" fill="none" opacity="0.06"/>
        {{-- Small diamonds --}}
        <rect x="30" y="20" width="10" height="10" rx="2" transform="rotate(45 30 20)" stroke="{{ $c }}" stroke-width="1" fill="none" opacity="0.1"/>
        <rect x="340" y="150" width="8" height="8" rx="2" transform="rotate(45 340 150)" stroke="{{ $c }}" stroke-width="1" fill="none" opacity="0.1"/>
    </svg>
</div>
@endif
