<?php

namespace App\Filament\Resources\Ekstrakurikulers;

use App\Filament\Resources\Ekstrakurikulers\Schemas\EkstrakurikulerForm;
use App\Filament\Resources\Ekstrakurikulers\Tables\EkstrakurikulersTable;
use App\Models\Ekstrakurikuler;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EkstrakurikulerResource extends Resource
{
    protected static ?string $model = Ekstrakurikuler::class;

    protected static ?string $navigationLabel = 'Ekstrakurikuler';
    protected static ?string $pluralLabel = 'Ekstrakurikuler';
    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedSparkles;
    protected static ?string $recordTitleAttribute = 'nama';
    protected static ?int $navigationSort = 4;

    public static function getNavigationGroup(): ?string
    {
        return 'Master Data';
    }

    public static function form(Schema $schema): Schema
    {
        return EkstrakurikulerForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EkstrakurikulersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\Ekstrakurikulers\Pages\ListEkstrakurikulers::route('/'),
            'create' => \App\Filament\Resources\Ekstrakurikulers\Pages\CreateEkstrakurikuler::route('/create'),
            'edit' => \App\Filament\Resources\Ekstrakurikulers\Pages\EditEkstrakurikuler::route('/{record}/edit'),
        ];
    }
}
