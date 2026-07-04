<?php

namespace App\Filament\Resources\Kategoris;

use App\Filament\Resources\Kategoris\Schemas\KategoriForm;
use App\Filament\Resources\Kategoris\Tables\KategorisTable;
use App\Models\Kategori;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class KategoriResource extends Resource
{
    protected static ?string $model = Kategori::class;

    protected static ?string $navigationLabel = 'Kategori Artikel';
    protected static ?string $pluralLabel = 'Kategori Artikel';
    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedTag;
    protected static ?string $recordTitleAttribute = 'nama';
    protected static ?int $navigationSort = 3;

    public static function getNavigationGroup(): ?string
    {
        return 'Master Data';
    }

    public static function form(Schema $schema): Schema
    {
        return KategoriForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KategorisTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\Kategoris\Pages\ListKategoris::route('/'),
            'create' => \App\Filament\Resources\Kategoris\Pages\CreateKategori::route('/create'),
            'edit' => \App\Filament\Resources\Kategoris\Pages\EditKategori::route('/{record}/edit'),
        ];
    }
}
