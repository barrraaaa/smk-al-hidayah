<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Csv\Writer;
use SplTempFileObject;

class ExportPendaftarController extends Controller
{
    public function csv(Request $request)
    {
        $query = Pendaftar::with('jurusan:id,nama');

        // Optional filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Optional filter by jurusan
        if ($request->filled('jurusan_id')) {
            $query->where('jurusan_id', $request->jurusan_id);
        }

        // Optional date range
        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        $pendaftar = $query->latest()->get();

        $csv = Writer::createFromFileObject(new SplTempFileObject());
        $csv->setOutputBOM(Writer::BOM_UTF8);

        // Header
        $csv->insertOne([
            'No. Pendaftaran',
            'Nama Lengkap',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Alamat',
            'No. Telepon',
            'Nama Orang Tua',
            'No. Telepon Orang Tua',
            'Asal Sekolah',
            'Jurusan',
            'Status',
            'Tanggal Daftar',
        ]);

        $statusLabels = [
            'menunggu_pembayaran' => 'Menunggu Pembayaran',
            'menunggu_verifikasi' => 'Menunggu Verifikasi',
            'terverifikasi' => 'Terverifikasi',
            'diterima' => 'Diterima',
            'ditolak' => 'Ditolak',
        ];

        foreach ($pendaftar as $p) {
            $csv->insertOne([
                $p->nomor_pendaftaran,
                $p->nama,
                $p->tempat_lahir,
                $p->tanggal_lahir?->format('d/m/Y'),
                $p->alamat,
                $p->no_telepon,
                $p->nama_ortu,
                $p->no_telepon_ortu,
                $p->asal_sekolah,
                $p->jurusan?->nama,
                $statusLabels[$p->status] ?? $p->status,
                $p->created_at->format('d/m/Y H:i'),
            ]);
        }

        $filename = 'ppdb-pendaftar-' . now()->format('Y-m-d-His') . '.csv';

        $csvString = $csv->toString();

        return response($csvString, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    public function count()
    {
        return response()->json([
            'total' => Pendaftar::count(),
            'per_status' => [
                'menunggu_pembayaran' => Pendaftar::where('status', 'menunggu_pembayaran')->count(),
                'menunggu_verifikasi' => Pendaftar::where('status', 'menunggu_verifikasi')->count(),
                'terverifikasi' => Pendaftar::where('status', 'terverifikasi')->count(),
                'diterima' => Pendaftar::where('status', 'diterima')->count(),
                'ditolak' => Pendaftar::where('status', 'ditolak')->count(),
            ],
        ]);
    }
}
