<?php

namespace App\Filament\Resources\Partners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PartnerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                Section::make('Informasi Partner')
                    ->columnSpan(1)
                    ->columns(1)
                    ->schema([
                        TextInput::make('nama')
                            ->label('Nama Partner')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('url')
                            ->label('Website URL')
                            ->url()
                            ->placeholder('https://contoh.com'),
                        TextInput::make('sort_order')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0)
                            ->helperText('Semakin kecil angka, semakin depan posisinya'),
                        Toggle::make('aktif')
                            ->label('Aktif')
                            ->default(true),
                    ]),
                Section::make('Logo')
                    ->columnSpan(1)
                    ->schema([
                        FileUpload::make('logo')
                            ->label('Logo Partner')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('partners')
                            ->required()
                            ->helperText('Format: PNG/JPG. Ukuran ideal: 200x80px'),
                    ]),
            ]);
    }
}
