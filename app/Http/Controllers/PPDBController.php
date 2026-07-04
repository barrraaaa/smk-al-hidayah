<?php

namespace App\Http\Controllers;

use App\Models\BuktiBayar;
use App\Models\DokumenPPDB;
use App\Models\Jurusan;
use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PPDBController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::where('aktif', true)->get();
        return view('ppdb.index', compact('jurusans'));
    }

    public function daftar()
    {
        $jurusans = Jurusan::where('aktif', true)->get();
        return view('ppdb.daftar', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Step 1: Data Pribadi
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:20',
            'nama_ortu' => 'required|string|max:255',
            'no_telepon_ortu' => 'required|string|max:20',
            'asal_sekolah' => 'required|string|max:255',
            // Step 2: Jurusan
            'jurusan_id' => 'required|exists:jurusans,id',
            // Step 3: Dokumen (optional on submit)
            'dokumen_ijazah' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'dokumen_kk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'dokumen_pas_foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'dokumen_akta' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Generate nomor pendaftaran: 2026-XXXXX
        $tahun = date('Y');
        $lastPendaftar = Pendaftar::whereYear('created_at', $tahun)
            ->orderBy('id', 'desc')
            ->first();
        $nextNumber = $lastPendaftar ? ((int) substr($lastPendaftar->nomor_pendaftaran, -5)) + 1 : 1;
        $nomorPendaftaran = $tahun . '-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

        // Create Pendaftar record
        $pendaftar = Pendaftar::create([
            'nama' => $validated['nama'],
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'alamat' => $validated['alamat'],
            'no_telepon' => $validated['no_telepon'],
            'nama_ortu' => $validated['nama_ortu'],
            'no_telepon_ortu' => $validated['no_telepon_ortu'],
            'asal_sekolah' => $validated['asal_sekolah'],
            'jurusan_id' => $validated['jurusan_id'],
            'status' => 'menunggu_pembayaran',
            'nomor_pendaftaran' => $nomorPendaftaran,
        ]);

        // Upload dokumen
        $dokumenMapping = [
            'dokumen_ijazah' => 'ijazah',
            'dokumen_kk' => 'kk',
            'dokumen_pas_foto' => 'pas_foto',
            'dokumen_akta' => 'akta',
        ];

        foreach ($dokumenMapping as $field => $jenis) {
            if ($request->hasFile($field)) {
                $path = $request->file($field)->store('ppdb/' . $pendaftar->id, 'public');
                DokumenPPDB::create([
                    'pendaftar_id' => $pendaftar->id,
                    'jenis' => $jenis,
                    'file_path' => $path,
                ]);
            }
        }

        return redirect()->route('ppdb.status', ['nomor' => $nomorPendaftaran])
            ->with('success', 'Pendaftaran berhasil! Nomor pendaftaran Anda: ' . $nomorPendaftaran);
    }

    public function status(Request $request)
    {
        $nomor = $request->input('nomor');
        $pendaftar = null;

        if ($nomor) {
            $pendaftar = Pendaftar::with(['jurusan', 'dokumenPpdb', 'buktiBayars'])
                ->where('nomor_pendaftaran', $nomor)
                ->first();
        }

        return view('ppdb.status', compact('pendaftar', 'nomor'));
    }

    public function uploadBukti(Request $request)
    {
        $validated = $request->validate([
            'pendaftar_id' => 'required|exists:pendaftars,id',
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $pendaftar = Pendaftar::findOrFail($validated['pendaftar_id']);

        $path = $request->file('file')->store('ppdb/bukti-bayar/' . $pendaftar->id, 'public');

        BuktiBayar::create([
            'pendaftar_id' => $pendaftar->id,
            'file_path' => $path,
            'keterangan' => $validated['keterangan'] ?? null,
            'status' => 'menunggu',
        ]);

        $pendaftar->update(['status' => 'menunggu_verifikasi']);

        return redirect()->route('ppdb.status', ['nomor' => $pendaftar->nomor_pendaftaran])
            ->with('success', 'Bukti bayar berhasil diupload! Menunggu verifikasi admin.');
    }

    public function cetak($nomor)
    {
        $pendaftar = Pendaftar::with('jurusan')
            ->where('nomor_pendaftaran', $nomor)
            ->firstOrFail();

        return view('ppdb.cetak', compact('pendaftar'));
    }
}
