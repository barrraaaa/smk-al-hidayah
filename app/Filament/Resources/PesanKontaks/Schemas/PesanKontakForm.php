<?php

namespace App\Filament\Resources\PesanKontaks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PesanKontakForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('no_telepon')
                    ->label('No. Telepon')
                    ->tel()
                    ->maxLength(20),
                Toggle::make('dibaca')
                    ->label('Sudah Dibaca')
                    ->inline(false)
                    ->default(false),
                Textarea::make('pesan')
                    ->required()
                    ->columnSpanFull()
                    ->rows(5),
            ]);
    }
}
