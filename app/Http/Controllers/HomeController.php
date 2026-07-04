<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Prestasi;

class HomeController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::where('aktif', true)
            ->with('kepalaJurusan')
            ->withCount('gurus')
            ->get();
        $artikel = Artikel::where('status', 'published')
            ->with('kategori')
            ->orderBy('published_at', 'desc')
            ->take(4)
            ->get();
        $prestasi = Prestasi::with('jurusan')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
        $gurus = Guru::with('jurusan')->take(4)->get();

        return view('beranda', compact('jurusans', 'artikel', 'prestasi', 'gurus'));
    }
}
