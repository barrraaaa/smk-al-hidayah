<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Prestasi;

class PrestasiController extends Controller
{
    public function index()
    {
        $query = Prestasi::with('jurusan');

        if ($slug = request('jurusan')) {
            $jurusan = Jurusan::where('slug', $slug)->first();
            if ($jurusan) {
                $query->where('jurusan_id', $jurusan->id);
            }
        }

        $prestasis = $query->orderBy('created_at', 'desc')->paginate(12);

        $jurusans = Jurusan::where('aktif', true)->get();

        return view('prestasi', compact('prestasis', 'jurusans'));
    }
}
