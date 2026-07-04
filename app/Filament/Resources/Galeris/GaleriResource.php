<?php

namespace App\Filament\Resources\Galeris;

use App\Filament\Resources\Galeris\Schemas\GaleriForm;
use App\Filament\Resources\Galeris\Tables\GalerisTable;
use App\Models\Galeri;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GaleriResource extends Resource
{
    protected static ?string $model = Galeri::class;

    protected static ?string $navigationLabel = 'Galeri Foto';
    protected static ?string $pluralLabel = 'Galeri Foto';
    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedPhoto;
    protected static ?string $recordTitleAttribute = 'judul';
    protected static ?int $navigationSort = 6;

    public static function getNavigationGroup(): ?string
    {
        return 'Master Data';
    }

    public static function form(Schema $schema): Schema
    {
        return GaleriForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GalerisTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\Galeris\Pages\ListGaleris::route('/'),
            'create' => \App\Filament\Resources\Galeris\Pages\CreateGaleri::route('/create'),
            'edit' => \App\Filament\Resources\Galeris\Pages\EditGaleri::route('/{record}/edit'),
        ];
    }
}
