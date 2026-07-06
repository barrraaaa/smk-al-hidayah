@php
    $pages = [
        ['loc' => url('/'), 'priority' => '1.0', 'changefreq' => 'weekly'],
        ['loc' => url('/profil'), 'priority' => '0.8', 'changefreq' => 'monthly'],
        ['loc' => url('/profil/sejarah'), 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['loc' => url('/profil/struktur-organisasi'), 'priority' => '0.6', 'changefreq' => 'monthly'],
        ['loc' => url('/profil/guru'), 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['loc' => url('/prestasi'), 'priority' => '0.6', 'changefreq' => 'weekly'],
        ['loc' => url('/ekstrakurikuler'), 'priority' => '0.6', 'changefreq' => 'monthly'],
        ['loc' => url('/galeri'), 'priority' => '0.5', 'changefreq' => 'weekly'],
        ['loc' => url('/artikel'), 'priority' => '0.8', 'changefreq' => 'daily'],
        ['loc' => url('/ppdb'), 'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => url('/ppdb/daftar'), 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['loc' => url('/ppdb/status'), 'priority' => '0.6', 'changefreq' => 'monthly'],
        ['loc' => url('/kontak'), 'priority' => '0.5', 'changefreq' => 'monthly'],
        ['loc' => url('/pengumuman-kelulusan'), 'priority' => '0.6', 'changefreq' => 'monthly'],
    ];

    // Add jurusan pages (dynamic from DB)
    $jurusans = \App\Models\Jurusan::where('aktif', true)->get();
    foreach ($jurusans as $j) {
        $pages[] = ['loc' => url('/jurusan/' . $j->slug), 'priority' => '0.8', 'changefreq' => 'monthly'];
    }
@endphp
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($pages as $page)
    <url>
        <loc>{{ $page['loc'] }}</loc>
        <lastmod>{{ date('Y-m-d') }}</lastmod>
        <changefreq>{{ $page['changefreq'] }}</changefreq>
        <priority>{{ $page['priority'] }}</priority>
    </url>
    @endforeach
</urlset>
