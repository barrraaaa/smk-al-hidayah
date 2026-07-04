<?php

namespace Database\Seeders;

use App\Models\SchoolSetting;
use Illuminate\Database\Seeder;

class SchoolSettingSeeder extends Seeder
{
    public function run(): void
    {
        SchoolSetting::create([
            'school_name' => 'SMK Alhidayah',
            'description' => 'SMK Alhidayah — Sekolah Menengah Kejuruan Islam Modern dengan 4 jurusan unggulan: AKL, Pemasaran, MPLB, dan TJKT.',
            'address' => 'Jl. Contoh No. 123, Kelurahan, Kecamatan, Kota, Provinsi',
            'phone' => '(021) 1234-5678',
            'email' => 'info@smkalhidayah.sch.id',
            'ppdb_email' => 'ppdb@smkalhidayah.sch.id',
            'vision' => '<p>Terwujudnya SMK Alhidayah Sebagai Lembaga Pendidikan dan Pelatihan yang Mencetak Sumber Daya Manusia Profesional, Beriman, Bertaqwa, serta Mampu Bersaing di Era Global.</p>',
            'mission' => '<ol><li>Menyelenggarakan pendidikan dan pelatihan yang berkualitas sesuai dengan kebutuhan dunia usaha dan industri.</li><li>Membentuk karakter peserta didik yang berakhlak mulia, disiplin, dan bertanggung jawab.</li><li>Mengembangkan potensi peserta didik secara optimal melalui kegiatan akademik dan non-akademik.</li><li>Menjalin kerjasama yang harmonis dengan dunia usaha, industri, dan masyarakat.</li><li>Meningkatkan profesionalisme tenaga pendidik dan kependidikan secara berkelanjutan.</li></ol>',
            'history' => '<p>SMK Alhidayah didirikan pada tahun 2010 di bawah naungan Yayasan Alhidayah. Berawal dari keprihatinan akan minimnya sekolah kejuruan berbasis Islam di wilayah tersebut, yayasan kemudian mendirikan SMK Alhidayah sebagai solusi pendidikan menengah yang memadukan ilmu pengetahuan dan teknologi dengan nilai-nilai keislaman.</p><p>Awalnya hanya memiliki 2 jurusan dan puluhan siswa, kini SMK Alhidayah telah berkembang menjadi salah satu SMK swasta terdepan dengan 4 jurusan unggulan dan ratusan siswa.</p>',
            'ppdb_fee' => 'Rp 500.000',
            'ppdb_schedule' => '<ul><li>Gelombang 1: November - Desember</li><li>Gelombang 2: Januari - Februari</li><li>Gelombang 3: Maret - April</li><li>Gelombang 4: Mei - Juni</li></ul>',
            'ppdb_requirements' => '<ul><li>Ijazah/SKL SMP/MTs sederajat</li><li>Kartu Keluarga (KK)</li><li>Pas Foto 3x4 (2 lembar)</li><li>Akta Kelahiran</li></ul>',
            'facebook_url' => 'https://facebook.com/smkalhidayah',
            'instagram_url' => 'https://instagram.com/smkalhidayah',
            'youtube_url' => 'https://youtube.com/@smkalhidayah',
            'tiktok_url' => 'https://tiktok.com/@smkalhidayah',
        ]);

        $this->command->info('✅ Default school settings created.');
    }
}
