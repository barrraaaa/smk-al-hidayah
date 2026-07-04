<?php

namespace App\Filament\Resources\Pendaftars\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PendaftarsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomor_pendaftaran')
                    ->label('No. Daftar')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Nomor pendaftaran disalin!'),
                TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('jurusan.nama')
                    ->label('Jurusan')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'menunggu_pembayaran' => 'warning',
                        'menunggu_verifikasi' => 'info',
                        'terverifikasi' => 'success',
                        'diterima' => 'success',
                        'ditolak' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'menunggu_pembayaran' => '⏳ Menunggu Bayar',
                        'menunggu_verifikasi' => '🔄 Menunggu Verifikasi',
                        'terverifikasi' => '✅ Terverifikasi',
                        'diterima' => '🎉 DITERIMA',
                        'ditolak' => '❌ Ditolak',
                        default => $state,
                    })
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Daftar')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                TextColumn::make('verified_at')
                    ->label('Verifikasi')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'menunggu_pembayaran' => 'Menunggu Pembayaran',
                        'menunggu_verifikasi' => 'Menunggu Verifikasi',
                        'terverifikasi' => 'Terverifikasi',
                        'diterima' => 'Diterima',
                        'ditolak' => 'Ditolak',
                    ]),
                SelectFilter::make('jurusan_id')
                    ->label('Jurusan')
                    ->relationship('jurusan', 'nama')
                    ->searchable()
                    ->preload(),
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('Lihat'),
                Action::make('verifikasi')
                    ->label('Verifikasi')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => in_array($record->status, ['menunggu_verifikasi', 'terverifikasi']))
                    ->requiresConfirmation()
                    ->modalHeading('Verifikasi Pendaftar')
                    ->modalDescription('Apakah Anda yakin ingin memverifikasi pendaftar ini? Status akan berubah menjadi "Terverifikasi".')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'terverifikasi',
                            'verified_at' => now(),
                        ]);
                        Notification::make()
                            ->title('Pendaftar terverifikasi')
                            ->success()
                            ->send();
                    }),
                Action::make('terima')
                    ->label('Terima')
                    ->icon('heroicon-o-hand-thumb-up')
                    ->color('success')
                    ->visible(fn ($record) => in_array($record->status, ['terverifikasi', 'menunggu_verifikasi']))
                    ->requiresConfirmation()
                    ->modalHeading('Terima Pendaftar')
                    ->modalDescription('Pendaftar ini akan diterima di SMK Alhidayah. Lanjutkan?')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'diterima',
                            'verified_at' => now(),
                        ]);
                        Notification::make()
                            ->title('Pendaftar diterima! 🎉')
                            ->success()
                            ->send();
                    }),
                Action::make('tolak')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn ($record) => !in_array($record->status, ['diterima', 'ditolak']))
                    ->form([
                        \Filament\Forms\Components\Textarea::make('alasan_ditolak')
                            ->label('Alasan Penolakan')
                            ->required()
                            ->placeholder('Jelaskan alasan mengapa pendaftar ini ditolak...'),
                    ])
                    ->action(function (array $data, $record) {
                        $record->update([
                            'status' => 'ditolak',
                            'alasan_ditolak' => $data['alasan_ditolak'],
                            'verified_at' => now(),
                        ]);
                        Notification::make()
                            ->title('Pendaftar ditolak')
                            ->warning()
                            ->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
