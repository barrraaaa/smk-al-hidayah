<?php

namespace App\Filament\Widgets;

use App\Models\Pendaftar;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PPDBTrendChart extends ChartWidget
{
    protected static ?int $sort = 3;

    protected ?string $heading = 'Tren Pendaftar (30 Hari Terakhir)';

    protected ?string $description = 'Jumlah pendaftar per hari dan total kumulatif';

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $raw = Pendaftar::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->where('created_at', '>=', now()->subDays(30)->startOfDay())
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        $dates = collect();
        $dailyValues = [];
        $cumulativeValues = [];
        $runningTotal = 0;

        for ($i = 30; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $dayLabel = now()->subDays($i)->format('d M');
            $count = (int) ($raw->get($date)?->total ?? 0);
            $runningTotal += $count;

            $dates->push($dayLabel);
            $dailyValues[] = $count;
            $cumulativeValues[] = $runningTotal;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pendaftar Baru',
                    'data' => $dailyValues,
                    'borderColor' => '#50bc84',
                    'backgroundColor' => 'rgba(80, 188, 132, 0.1)',
                    'fill' => true,
                    'tension' => 0.3,
                    'pointRadius' => 3,
                    'pointHoverRadius' => 6,
                    'pointBackgroundColor' => '#50bc84',
                    'borderWidth' => 2,
                ],
                [
                    'label' => 'Total Kumulatif',
                    'data' => $cumulativeValues,
                    'borderColor' => '#254636',
                    'backgroundColor' => 'rgba(37, 70, 54, 0.05)',
                    'fill' => false,
                    'tension' => 0.3,
                    'pointRadius' => 2,
                    'pointHoverRadius' => 5,
                    'pointBackgroundColor' => '#254636',
                    'borderWidth' => 2,
                    'borderDash' => [5, 3],
                ],
            ],
            'labels' => $dates->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
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
                    'grid' => [
                        'color' => 'rgba(0, 0, 0, 0.05)',
                    ],
                ],
                'x' => [
                    'grid' => [
                        'display' => false,
                    ],
                    'ticks' => [
                        'maxTicksLimit' => 10,
                        'maxRotation' => 45,
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                    'labels' => [
                        'usePointStyle' => true,
                        'padding' => 20,
                    ],
                ],
                'tooltip' => [
                    'mode' => 'index',
                    'intersect' => false,
                ],
            ],
            'interaction' => [
                'mode' => 'index',
                'intersect' => false,
            ],
        ];
    }
}
