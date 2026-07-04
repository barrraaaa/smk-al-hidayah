<?php

namespace App\Filament\Resources\Kelulusans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class KelulusansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomor_ujian')
                    ->label('No. Ujian')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold'),

                TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('hasil')
                    ->label('Hasil')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'lulus' => 'success',
                        'tidak_lulus' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'lulus' => '✅ LULUS',
                        'tidak_lulus' => '❌ TIDAK LULUS',
                        default => $state,
                    }),

                TextColumn::make('jurusan.nama')
                    ->label('Jurusan')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),

                TextColumn::make('created_at')
                    ->label('Ditambahkan')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Edit'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
