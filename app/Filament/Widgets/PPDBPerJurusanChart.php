<?php

namespace App\Filament\Widgets;

use App\Models\Pendaftar;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PPDBPerJurusanChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected ?string $heading = 'Pendaftar per Jurusan';

    protected ?string $description = 'Distribusi pendaftar berdasarkan jurusan pilihan';

    protected int | string | array $columnSpan = [
        'md' => 6,
        'xl' => 8,
    ];

    protected function getData(): array
    {
        $data = Pendaftar::select('jurusan_id', DB::raw('count(*) as total'))
            ->with('jurusan:id,nama')
            ->groupBy('jurusan_id')
            ->get()
            ->sortByDesc('total');

        $labels = $data->pluck('jurusan.nama')->toArray();
        $values = $data->pluck('total')->toArray();

        $colors = [
            '#254636', '#50bc84', '#F3B815', '#e74c3c',
            '#3498db', '#9b59b6', '#1abc9c', '#f39c12',
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Pendaftar',
                    'data' => $values,
                    'backgroundColor' => array_slice($colors, 0, count($values)),
                    'borderRadius' => 4,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 1,
                        'precision' => 0,
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
        ];
    }
}
