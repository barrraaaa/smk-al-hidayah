<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Kategori;

class ArtikelController extends Controller
{
    public function index()
    {
        $query = Artikel::where('status', 'published')->with('kategori');

        if ($slug = request('kategori')) {
            $kategori = Kategori::where('slug', $slug)->first();
            if ($kategori) {
                $query->where('kategori_id', $kategori->id);
            }
        }

        $artikels = $query->orderBy('published_at', 'desc')->paginate(9);

        $kategoris = Kategori::all();

        return view('artikel.index', compact('artikels', 'kategoris'));
    }

    public function show($slug)
    {
        $artikel = Artikel::where('slug', $slug)
            ->where('status', 'published')
            ->with('kategori')
            ->firstOrFail();

        $artikelTerkait = Artikel::where('status', 'published')
            ->where('id', '!=', $artikel->id)
            ->where(function ($q) use ($artikel) {
                if ($artikel->kategori_id) {
                    $q->where('kategori_id', $artikel->kategori_id);
                }
            })
            ->take(3)
            ->get();

        return view('artikel.show', compact('artikel', 'artikelTerkait'));
    }
}
