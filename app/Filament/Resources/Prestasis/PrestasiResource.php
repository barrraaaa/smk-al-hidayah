<?php

namespace App\Filament\Resources\Prestasis;

use App\Filament\Resources\Prestasis\Schemas\PrestasiForm;
use App\Filament\Resources\Prestasis\Tables\PrestasisTable;
use App\Models\Prestasi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PrestasiResource extends Resource
{
    protected static ?string $model = Prestasi::class;

    protected static ?string $navigationLabel = 'Prestasi';
    protected static ?string $pluralLabel = 'Prestasi';
    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedTrophy;
    protected static ?string $recordTitleAttribute = 'judul';
    protected static ?int $navigationSort = 5;

    public static function getNavigationGroup(): ?string
    {
        return 'Master Data';
    }

    public static function form(Schema $schema): Schema
    {
        return PrestasiForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PrestasisTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\Prestasis\Pages\ListPrestasis::route('/'),
            'create' => \App\Filament\Resources\Prestasis\Pages\CreatePrestasi::route('/create'),
            'edit' => \App\Filament\Resources\Prestasis\Pages\EditPrestasi::route('/{record}/edit'),
        ];
    }
}
