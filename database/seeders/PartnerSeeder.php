<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        $partners = [
            [
                'nama' => 'PT Bank Mandiri (Persero) Tbk',
                'logo' => 'partners/bank-mandiri.png',
                'url' => 'https://www.bankmandiri.co.id',
                'sort_order' => 1,
                'aktif' => true,
            ],
            [
                'nama' => 'PT Telkom Indonesia Tbk',
                'logo' => 'partners/telkom-indonesia.png',
                'url' => 'https://www.telkom.co.id',
                'sort_order' => 2,
                'aktif' => true,
            ],
            [
                'nama' => 'PT Bank Central Asia Tbk',
                'logo' => 'partners/bca.png',
                'url' => 'https://www.bca.co.id',
                'sort_order' => 3,
                'aktif' => true,
            ],
            [
                'nama' => 'PT Pertamina (Persero)',
                'logo' => 'partners/pertamina.png',
                'url' => 'https://www.pertamina.com',
                'sort_order' => 4,
                'aktif' => true,
            ],
            [
                'nama' => 'PT Unilever Indonesia Tbk',
                'logo' => 'partners/unilever.png',
                'url' => 'https://www.unilever.co.id',
                'sort_order' => 5,
                'aktif' => true,
            ],
            [
                'nama' => 'PT Astra International Tbk',
                'logo' => 'partners/astra.png',
                'url' => 'https://www.astra.co.id',
                'sort_order' => 6,
                'aktif' => true,
            ],
            [
                'nama' => 'PT Gojek Indonesia',
                'logo' => 'partners/gojek.png',
                'url' => 'https://www.gojek.com',
                'sort_order' => 7,
                'aktif' => true,
            ],
            [
                'nama' => 'PT Gramedia Asri Media',
                'logo' => 'partners/gramedia.png',
                'url' => 'https://www.gramedia.com',
                'sort_order' => 8,
                'aktif' => true,
            ],
        ];

        foreach ($partners as $data) {
            Partner::create($data);
        }
    }
}
