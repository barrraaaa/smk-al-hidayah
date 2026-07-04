<?php

namespace App\Filament\Widgets;

use App\Models\Pendaftar;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class PPDBStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = [
        'md' => 6,
        'xl' => 12,
    ];

    protected function getStats(): array
    {
        $total = Pendaftar::count();
        $menungguPembayaran = Pendaftar::where('status', 'menunggu_pembayaran')->count();
        $menungguVerifikasi = Pendaftar::where('status', 'menunggu_verifikasi')->count();
        $terverifikasi = Pendaftar::where('status', 'terverifikasi')->count();
        $diterima = Pendaftar::where('status', 'diterima')->count();
        $ditolak = Pendaftar::where('status', 'ditolak')->count();

        $hariIni = Pendaftar::whereDate('created_at', today())->count();
        $mingguIni = Pendaftar::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();

        $totalBiaya = Pendaftar::where('status', 'diterima')
            ->orWhere('status', 'terverifikasi')
            ->count() * 500000;

        return [
            Stat::make('Total Pendaftar', number_format($total))
                ->description('Seluruh pendaftar PPDB')
                ->descriptionIcon('heroicon-o-users')
                ->color('gray'),

            Stat::make('Menunggu Pembayaran', number_format($menungguPembayaran))
                ->description('Belum upload bukti bayar')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),

            Stat::make('Menunggu Verifikasi', number_format($menungguVerifikasi))
                ->description('Upload bukti — perlu dicek')
                ->descriptionIcon('heroicon-o-magnifying-glass')
                ->color('info'),

            Stat::make('Diterima', number_format($diterima))
                ->description(number_format($totalBiaya > 0 ? $totalBiaya : 0, 0, ',', '.') . ' estimasi penerimaan')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('Ditolak', number_format($ditolak))
                ->description('Pendaftar ditolak')
                ->descriptionIcon('heroicon-o-x-circle')
                ->color('danger'),

            Stat::make('Minggu Ini', number_format($mingguIni))
                ->description("{$hariIni} registrasi baru hari ini")
                ->descriptionIcon('heroicon-o-calendar-days')
                ->color('primary'),
        ];
    }
}
