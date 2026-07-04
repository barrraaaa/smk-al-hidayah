<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('beranda');
})->name('beranda');

Route::prefix('profil')->group(function () {
    Route::get('/', function () {
        return view('profil.index');
    })->name('profil');
    Route::get('/sejarah', function () {
        return view('profil.sejarah');
    })->name('profil.sejarah');
    Route::get('/struktur-organisasi', function () {
        return view('profil.struktur');
    })->name('profil.struktur');
    Route::get('/guru', function () {
        return view('profil.guru');
    })->name('profil.guru');
});

Route::prefix('jurusan')->group(function () {
    Route::get('/akl', function () {
        return view('jurusan.akl');
    })->name('jurusan.akl');
    Route::get('/pemasaran', function () {
        return view('jurusan.pemasaran');
    })->name('jurusan.pemasaran');
    Route::get('/mplb', function () {
        return view('jurusan.mplb');
    })->name('jurusan.mplb');
    Route::get('/tjkt', function () {
        return view('jurusan.tjkt');
    })->name('jurusan.tjkt');
});

Route::view('/prestasi', 'prestasi')->name('prestasi');
Route::view('/ekstrakurikuler', 'ekstrakurikuler')->name('ekstrakurikuler');
Route::view('/galeri', 'galeri')->name('galeri');

Route::prefix('ppdb')->group(function () {
    Route::get('/', function () {
        return view('ppdb.index');
    })->name('ppdb');
    Route::get('/daftar', function () {
        return view('ppdb.daftar');
    })->name('ppdb.daftar');
    Route::get('/status', function () {
        return view('ppdb.status');
    })->name('ppdb.status');
});

Route::prefix('artikel')->group(function () {
    Route::get('/', function () {
        return view('artikel.index');
    })->name('artikel');
    Route::get('/{slug}', function ($slug) {
        return view('artikel.show', ['slug' => $slug]);
    })->name('artikel.show');
});

Route::view('/pengumuman-kelulusan', 'kelulusan')->name('kelulusan');
Route::view('/kontak', 'kontak')->name('kontak');
