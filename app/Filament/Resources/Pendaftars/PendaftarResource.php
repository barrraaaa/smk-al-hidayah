<?php

namespace App\Filament\Resources\Pendaftars;

use App\Filament\Resources\Pendaftars\Pages\CreatePendaftar;
use App\Filament\Resources\Pendaftars\Pages\EditPendaftar;
use App\Filament\Resources\Pendaftars\Pages\ListPendaftars;
use App\Filament\Resources\Pendaftars\Schemas\PendaftarForm;
use App\Filament\Resources\Pendaftars\Tables\PendaftarsTable;
use App\Models\Pendaftar;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PendaftarResource extends Resource
{
    protected static ?string $model = Pendaftar::class;

    protected static ?string $navigationLabel = 'Pendaftar PPDB';
    protected static ?string $pluralLabel = 'Pendaftar PPDB';
    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;
    protected static ?string $recordTitleAttribute = 'nama';
    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return 'PPDB';
    }

    public static function form(Schema $schema): Schema
    {
        return PendaftarForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PendaftarsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            \App\Filament\Resources\Pendaftars\RelationManagers\DokumenPpdbRelationManager::class,
            \App\Filament\Resources\Pendaftars\RelationManagers\BuktiBayarRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPendaftars::route('/'),
            'create' => CreatePendaftar::route('/create'),
            'edit' => EditPendaftar::route('/{record}/edit'),
        ];
    }
}
