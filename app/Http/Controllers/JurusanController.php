<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;

class JurusanController extends Controller
{
    public function show($slug)
    {
        $jurusan = Jurusan::where('slug', $slug)
            ->with(['kepalaJurusan', 'prestasis', 'gurus'])
            ->firstOrFail();

        $allJurusans = Jurusan::where('aktif', true)->where('id', '!=', $jurusan->id)->get();

        return view('jurusan.show', compact('jurusan', 'allJurusans'));
    }
}
