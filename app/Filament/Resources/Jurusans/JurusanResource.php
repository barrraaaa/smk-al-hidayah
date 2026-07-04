<?php

namespace App\Filament\Resources\Jurusans;

use App\Filament\Resources\Jurusans\Schemas\JurusanForm;
use App\Filament\Resources\Jurusans\Tables\JurusansTable;
use App\Models\Jurusan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class JurusanResource extends Resource
{
    protected static ?string $model = Jurusan::class;

    protected static ?string $navigationLabel = 'Jurusan';
    protected static ?string $pluralLabel = 'Jurusan';
    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedAcademicCap;
    protected static ?string $recordTitleAttribute = 'nama';
    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return 'Master Data';
    }

    public static function form(Schema $schema): Schema
    {
        return JurusanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JurusansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\Jurusans\Pages\ListJurusans::route('/'),
            'create' => \App\Filament\Resources\Jurusans\Pages\CreateJurusan::route('/create'),
            'edit' => \App\Filament\Resources\Jurusans\Pages\EditJurusan::route('/{record}/edit'),
        ];
    }
}
