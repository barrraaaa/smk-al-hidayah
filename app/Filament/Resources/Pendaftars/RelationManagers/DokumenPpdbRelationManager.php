<?php

namespace App\Filament\Resources\Pendaftars\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DokumenPpdbRelationManager extends RelationManager
{
    protected static string $relationship = 'dokumenPpdb';

    protected static ?string $title = 'Dokumen Pendaftaran';

    public function form(Schema $schema): Schema
    {
        return $schema;
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('jenis')
            ->columns([
                TextColumn::make('jenis')
                    ->label('Jenis Dokumen')
                    ->badge()
                    ->color('info')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'ijazah' => '📄 Ijazah',
                        'kk' => '📄 Kartu Keluarga',
                        'pas_foto' => '📸 Pas Foto',
                        'akta' => '📄 Akta Kelahiran',
                        default => $state,
                    }),
                TextColumn::make('file_path')
                    ->label('File')
                    ->formatStateUsing(fn ($state) => basename($state))
                    ->extraAttributes(['class' => 'text-xs']),
                IconColumn::make('file_path')
                    ->label('Ada')
                    ->boolean()
                    ->trueIcon('heroicon-o-document-check')
                    ->falseIcon('heroicon-o-x-circle'),
                TextColumn::make('created_at')
                    ->label('Diupload')
                    ->dateTime('d M Y H:i'),
            ])
            ->filters([
                //
            ])
            ->headerActions([])
            ->recordActions([
                Action::make('preview')
                    ->label('Lihat/Download')
                    ->icon('heroicon-o-eye')
                    ->url(fn ($record) => asset('storage/' . $record->file_path))
                    ->openUrlInNewTab(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
