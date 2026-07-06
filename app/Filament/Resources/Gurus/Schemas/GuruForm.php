<?php

namespace App\Filament\Resources\Gurus\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class GuruForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('nama')
                    ->required(),
                TextInput::make('nip')
                    ->label('NIP')
                    ->unique(ignoreRecord: true)
                    ->helperText('Nomor Induk Pegawai'),
                TextInput::make('jabatan'),
                FileUpload::make('foto')
                    ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->directory('guru')
                    ->columnSpanFull(),
                Textarea::make('bio')
                    ->columnSpanFull()
                    ->rows(4),
                Select::make('jurusan_id')
                    ->relationship('jurusan', 'nama')
                    ->searchable()
                    ->preload()
                    ->placeholder('Pilih Jurusan'),
            ]);
    }
}
