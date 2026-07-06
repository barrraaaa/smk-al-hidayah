<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('beranda');

Route::prefix('profil')->group(function () {
    Route::get('/', [ProfilController::class, 'index'])->name('profil');
    Route::get('/sejarah', [ProfilController::class, 'sejarah'])->name('profil.sejarah');
    Route::get('/struktur-organisasi', [ProfilController::class, 'struktur'])->name('profil.struktur');
    Route::get('/guru', [ProfilController::class, 'guru'])->name('profil.guru');
});

Route::get('/jurusan/{slug}', [JurusanController::class, 'show'])->name('jurusan.show');

Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi');
Route::get('/ekstrakurikuler', [EkstrakurikulerController::class, 'index'])->name('ekstrakurikuler');
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');

Route::prefix('ppdb')->group(function () {
    Route::get('/', [\App\Http\Controllers\PPDBController::class, 'index'])->name('ppdb');
    Route::get('/daftar', [\App\Http\Controllers\PPDBController::class, 'daftar'])->name('ppdb.daftar');
    Route::post('/daftar', [\App\Http\Controllers\PPDBController::class, 'store'])->name('ppdb.store');
    Route::get('/status', [\App\Http\Controllers\PPDBController::class, 'status'])->name('ppdb.status');
    Route::post('/status', [\App\Http\Controllers\PPDBController::class, 'status'])->name('ppdb.status.cari');
    Route::post('/bukti-bayar', [\App\Http\Controllers\PPDBController::class, 'uploadBukti'])->name('ppdb.bukti');
    Route::get('/cetak/{nomor}', [\App\Http\Controllers\PPDBController::class, 'cetak'])->name('ppdb.cetak');
});

Route::prefix('artikel')->group(function () {
    Route::get('/', [ArtikelController::class, 'index'])->name('artikel');
    Route::get('/{slug}', [ArtikelController::class, 'show'])->name('artikel.show');
});

Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');

// SEO
Route::get('/sitemap.xml', function () {
    return response()->view('sitemap')->header('Content-Type', 'text/xml');
})->name('sitemap');

Route::get('/robots.txt', function () {
    $disallowAdmin = url('/admin');
    $sitemapUrl = url('/sitemap.xml');
    $content = "User-agent: *\nAllow: /\nDisallow: {$disallowAdmin}/\nDisallow: /storage/\nSitemap: {$sitemapUrl}\n";
    return response($content, 200)->header('Content-Type', 'text/plain');
})->name('robots');

Route::get('/pengumuman-kelulusan', [\App\Http\Controllers\KelulusanController::class, 'index'])->name('kelulusan');
Route::post('/pengumuman-kelulusan', [\App\Http\Controllers\KelulusanController::class, 'cari'])->name('kelulusan.cari');

// Kelulusan CSV Template
Route::get('/admin/kelulusan/template', function () {
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="template-import-kelulusan.csv"',
    ];

    $callback = function () {
        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['nomor_ujian', 'nama', 'hasil', 'jurusan']);
        fputcsv($handle, ['2026-00001', 'Ahmad Fauzi', 'lulus', 'Akuntansi dan Keuangan Lembaga']);
        fputcsv($handle, ['2026-00002', 'Siti Nurhaliza', 'lulus', 'Pemasaran']);
        fputcsv($handle, ['2026-00003', 'Budi Santoso', 'tidak_lulus', 'Manajemen Perkantoran dan Layanan Bisnis']);
        fputcsv($handle, ['2026-00004', 'Dewi Sartika', 'lulus', 'Teknik Jaringan Komputer dan Telekomunikasi']);
        fclose($handle);
    };

    return response()->stream($callback, 200, $headers);
})->name('kelulusan.template');

// Admin Export Routes
Route::middleware(['auth'])->prefix('admin/export')->group(function () {
    Route::get('/ppdb/csv', [\App\Http\Controllers\Admin\ExportPendaftarController::class, 'csv'])->name('admin.export.ppdb.csv');
    Route::get('/ppdb/count', [\App\Http\Controllers\Admin\ExportPendaftarController::class, 'count'])->name('admin.export.ppdb.count');
});
