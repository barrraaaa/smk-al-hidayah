<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        $jurusan = [
            [
                'nama' => 'Akuntansi dan Keuangan Lembaga',
                'slug' => 'akl',
                'deskripsi' => 'Jurusan AKL (Akuntansi dan Keuangan Lembaga) mempelajari siklus akuntansi, pengelolaan keuangan, perpajakan, dan penyusunan laporan keuangan perusahaan. Siswa dibekali keterampilan mengoperasikan software akuntansi dan administrasi perkantoran modern.',
                'prospek_kerja' => "• Staf Akuntansi\n• Staf Keuangan\n• Staf Pajak\n• Admin Finance\n• Kasir\n• Auditor Junior",
                'ikon' => null,
                'aktif' => true,
            ],
            [
                'nama' => 'Pemasaran dan Bisnis Digital',
                'slug' => 'pemasaran',
                'deskripsi' => 'Jurusan Pemasaran mempelajari strategi pemasaran, branding, e-commerce, digital marketing, dan customer relationship management. Siswa dilatih menjadi tenaga pemasaran profesional yang siap bersaing di era digital.',
                'prospek_kerja' => "• Staf Marketing\n• Digital Marketing Specialist\n• Social Media Officer\n• Brand Ambassador\n• Sales Executive\n• Entrepreneur",
                'ikon' => null,
                'aktif' => true,
            ],
            [
                'nama' => 'Manajemen Perkantoran dan Layanan Bisnis',
                'slug' => 'mplb',
                'deskripsi' => 'Jurusan MPLB (Manajemen Perkantoran dan Layanan Bisnis) mempelajari administrasi perkantoran, manajemen dokumen, layanan profesional, komunikasi bisnis, dan pengelolaan kantor secara efektif dan efisien.',
                'prospek_kerja' => "• Admin Kantor\n• Sekretaris\n• Staf HRD\n• Customer Service\n• Office Manager\n• Front Office Staff",
                'ikon' => null,
                'aktif' => true,
            ],
            [
                'nama' => 'Teknik Jaringan Komputer dan Telekomunikasi',
                'slug' => 'tjkt',
                'deskripsi' => 'Jurusan TJKT (Teknik Jaringan Komputer dan Telekomunikasi) mempelajari jaringan komputer, administrasi server, keamanan siber, dan teknologi telekomunikasi modern. Siswa siap menjadi teknisi jaringan profesional.',
                'prospek_kerja' => "• Teknisi Jaringan\n• Network Administrator\n• IT Support\n• Teknisi Fiber Optik\n• Network Engineer\n• Cyber Security Analyst",
                'ikon' => null,
                'aktif' => true,
            ],
        ];

        foreach ($jurusan as $data) {
            Jurusan::create($data);
        }
    }
}
