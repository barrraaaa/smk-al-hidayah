<?php

namespace App\Filament\Widgets;

use App\Models\Pendaftar;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PPDBStatusPieChart extends ChartWidget
{
    protected static ?int $sort = 4;

    protected ?string $heading = 'Distribusi Status Pendaftar';

    protected ?string $description = 'Proporsi pendaftar berdasarkan status saat ini';

    protected int | string | array $columnSpan = [
        'md' => 6,
        'xl' => 4,
    ];

    protected function getData(): array
    {
        $data = Pendaftar::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $labels = [
            'menunggu_pembayaran' => 'Menunggu Pembayaran',
            'menunggu_verifikasi' => 'Menunggu Verifikasi',
            'terverifikasi' => 'Terverifikasi',
            'diterima' => 'Diterima',
            'ditolak' => 'Ditolak',
        ];

        $colors = [
            'menunggu_pembayaran' => '#F3B815',
            'menunggu_verifikasi' => '#3498db',
            'terverifikasi' => '#50bc84',
            'diterima' => '#254636',
            'ditolak' => '#e74c3c',
        ];

        $chartLabels = [];
        $chartValues = [];
        $chartColors = [];
        $chartBorder = [];

        foreach ($labels as $key => $label) {
            $count = (int) ($data->get($key, 0));
            if ($count > 0) {
                $chartLabels[] = $label;
                $chartValues[] = $count;
                $chartColors[] = $colors[$key];
                $chartBorder[] = '#ffffff';
            }
        }

        // If no data at all, show a single "Belum ada data" slice
        if (empty($chartValues)) {
            $chartLabels[] = 'Belum ada data';
            $chartValues[] = 1;
            $chartColors[] = '#e2e8f0';
            $chartBorder[] = '#ffffff';
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pendaftar',
                    'data' => $chartValues,
                    'backgroundColor' => $chartColors,
                    'borderColor' => $chartBorder,
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $chartLabels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'cutout' => '55%',
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                    'labels' => [
                        'usePointStyle' => true,
                        'padding' => 16,
                        'boxWidth' => 12,
                    ],
                ],
                'tooltip' => [
                    'enabled' => true,
                ],
            ],
        ];
    }
}
