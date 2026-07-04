<?php

namespace App\Http\Controllers;

use App\Models\Kelulusan;
use Illuminate\Http\Request;

class KelulusanController extends Controller
{
    public function index()
    {
        return view('kelulusan', [
            'result' => null,
            'searched' => false,
        ]);
    }

    public function cari(Request $request)
    {
        $request->validate([
            'nomor_ujian' => 'required|string|max:50',
        ]);

        $nomor = $request->input('nomor_ujian');
        $result = Kelulusan::with('jurusan')
            ->where('nomor_ujian', $nomor)
            ->first();

        return view('kelulusan', [
            'result' => $result,
            'nomor_ujian' => $nomor,
            'searched' => true,
        ]);
    }
}
