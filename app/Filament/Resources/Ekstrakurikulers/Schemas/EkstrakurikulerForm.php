<?php

namespace App\Filament\Resources\Ekstrakurikulers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class EkstrakurikulerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('nama')
                    ->required(),
                TextInput::make('pembina'),
                FileUpload::make('foto')
                    ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->directory('ekstrakurikuler')
                    ->columnSpanFull(),
                Textarea::make('deskripsi')
                    ->columnSpanFull()
                    ->rows(4),
            ]);
    }
}
