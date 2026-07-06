<?php

namespace App\Filament\Resources\Pendaftars\RelationManagers;

use Carbon\Carbon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BuktiBayarsRelationManager extends RelationManager
{
    protected static string $relationship = 'buktiBayars';

    protected static ?string $title = 'Bukti Pembayaran';

    public function form(Schema $schema): Schema
    {
        return $schema;
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('keterangan')
            ->columns([
                TextColumn::make('file_path')
                    ->label('File')
                    ->formatStateUsing(fn ($state) => basename($state)),
                TextColumn::make('keterangan')
                    ->label('Keterangan'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'menunggu' => 'warning',
                        'terverifikasi' => 'success',
                        'ditolak' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'menunggu' => '⏳ Menunggu',
                        'terverifikasi' => '✅ Terverifikasi',
                        'ditolak' => '❌ Ditolak',
                        default => $state,
                    }),
                TextColumn::make('verified_at')
                    ->label('Diverifikasi')
                    ->dateTime('d M Y H:i'),
                TextColumn::make('created_at')
                    ->label('Diupload')
                    ->dateTime('d M Y H:i'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([])
            ->headerActions([])
            ->recordActions([
                Action::make('preview')
                    ->label('Lihat/Download')
                    ->icon('heroicon-o-eye')
                    ->url(fn ($record) => asset('storage/' . $record->file_path))
                    ->openUrlInNewTab(),
                Action::make('verifikasi_bukti')
                    ->label('Verifikasi')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => $record->status === 'menunggu')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'terverifikasi',
                            'verified_at' => now(),
                        ]);
                        Notification::make()
                            ->title('Bukti bayar terverifikasi')
                            ->success()
                            ->send();
                    }),
                Action::make('tolak_bukti')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn ($record) => $record->status === 'menunggu')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'ditolak',
                            'verified_at' => now(),
                        ]);
                        Notification::make()
                            ->title('Bukti bayar ditolak')
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
