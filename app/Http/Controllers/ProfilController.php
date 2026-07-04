<?php

namespace App\Http\Controllers;

use App\Models\Guru;

class ProfilController extends Controller
{
    public function index()
    {
        return view('profil.index');
    }

    public function sejarah()
    {
        return view('profil.sejarah');
    }

    public function struktur()
    {
        return view('profil.struktur');
    }

    public function guru()
    {
        $gurus = Guru::with('jurusan')->orderBy('nama')->get();
        $jurusans = \App\Models\Jurusan::where('aktif', true)->get();

        return view('profil.guru', compact('gurus', 'jurusans'));
    }
}
