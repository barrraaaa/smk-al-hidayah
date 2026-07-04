<?php

namespace Database\Seeders;

use App\Models\Kelulusan;
use App\Models\Jurusan;
use Illuminate\Database\Seeder;

class KelulusanSeeder extends Seeder
{
    public function run(): void
    {
        $jurusans = Jurusan::pluck('id', 'nama');

        $data = [
            [
                'nomor_ujian' => '2026-00001',
                'nama' => 'Ahmad Fauzi',
                'hasil' => 'lulus',
                'jurusan_id' => $jurusans->get('Akuntansi dan Keuangan Lembaga', 1),
            ],
            [
                'nomor_ujian' => '2026-00002',
                'nama' => 'Siti Nurhaliza',
                'hasil' => 'lulus',
                'jurusan_id' => $jurusans->get('Pemasaran', 2),
            ],
            [
                'nomor_ujian' => '2026-00003',
                'nama' => 'Budi Santoso',
                'hasil' => 'lulus',
                'jurusan_id' => $jurusans->get('Manajemen Perkantoran dan Layanan Bisnis', 3),
            ],
            [
                'nomor_ujian' => '2026-00004',
                'nama' => 'Dewi Lestari',
                'hasil' => 'tidak_lulus',
                'jurusan_id' => $jurusans->get('Teknik Jaringan Komputer dan Telekomunikasi', 4),
            ],
            [
                'nomor_ujian' => '2026-00005',
                'nama' => 'Rizky Pratama',
                'hasil' => 'lulus',
                'jurusan_id' => $jurusans->get('Akuntansi dan Keuangan Lembaga', 1),
            ],
            [
                'nomor_ujian' => '2026-00006',
                'nama' => 'Fitri Handayani',
                'hasil' => 'lulus',
                'jurusan_id' => $jurusans->get('Pemasaran', 2),
            ],
            [
                'nomor_ujian' => '2026-00007',
                'nama' => 'Doni Kurniawan',
                'hasil' => 'tidak_lulus',
                'jurusan_id' => $jurusans->get('Manajemen Perkantoran dan Layanan Bisnis', 3),
            ],
            [
                'nomor_ujian' => '2026-00008',
                'nama' => 'Rina Marlina',
                'hasil' => 'lulus',
                'jurusan_id' => $jurusans->get('Teknik Jaringan Komputer dan Telekomunikasi', 4),
            ],
        ];

        foreach ($data as $item) {
            Kelulusan::create($item);
        }

        $this->command->info('✅ ' . count($data) . ' data kelulusan berhasil dibuat');
    }
}
