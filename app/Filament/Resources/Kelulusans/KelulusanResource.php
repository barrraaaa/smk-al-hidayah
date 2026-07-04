<?php

namespace App\Filament\Resources\Kelulusans;

use App\Filament\Resources\Kelulusans\Pages\CreateKelulusan;
use App\Filament\Resources\Kelulusans\Pages\EditKelulusan;
use App\Filament\Resources\Kelulusans\Pages\ListKelulusans;
use App\Filament\Resources\Kelulusans\Schemas\KelulusanForm;
use App\Filament\Resources\Kelulusans\Tables\KelulusansTable;
use App\Models\Kelulusan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class KelulusanResource extends Resource
{
    protected static ?string $model = Kelulusan::class;

    protected static ?string $navigationLabel = 'Kelulusan';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return KelulusanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KelulusansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListKelulusans::route('/'),
            'create' => CreateKelulusan::route('/create'),
            'edit' => EditKelulusan::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'PPDB';
    }
}
