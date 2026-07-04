<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Pendaftars\PendaftarResource;
use App\Models\Pendaftar;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseTableWidget;

class PPDBLatestPendaftarTable extends BaseTableWidget
{
    protected static ?int $sort = 5;

    protected int | string | array $columnSpan = [
        'md' => 6,
        'xl' => 12,
    ];

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Pendaftar::query()
                    ->with('jurusan:id,nama')
                    ->latest()
                    ->limit(8)
            )
            ->columns([
                TextColumn::make('nomor_pendaftaran')
                    ->label('No. Daftar')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Nomor pendaftaran disalin')
                    ->color('primary')
                    ->weight('semibold')
                    ->url(fn ($record) => PendaftarResource::getUrl('edit', ['record' => $record])),

                TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->weight('semibold'),

                TextColumn::make('jurusan.nama')
                    ->label('Jurusan')
                    ->badge()
                    ->color('primary'),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'menunggu_pembayaran' => 'warning',
                        'menunggu_verifikasi' => 'info',
                        'terverifikasi' => 'primary',
                        'diterima' => 'success',
                        'ditolak' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'menunggu_pembayaran' => '🕐 Menunggu Bayar',
                        'menunggu_verifikasi' => '🔍 Verifikasi',
                        'terverifikasi' => '✅ Terverifikasi',
                        'diterima' => '🎉 Diterima',
                        'ditolak' => '❌ Ditolak',
                        default => $state,
                    }),

                TextColumn::make('created_at')
                    ->label('Daftar')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->color('gray'),
            ])
            ->paginated(false)
            ->defaultSort('created_at', 'desc')
            ->striped();
    }
}
