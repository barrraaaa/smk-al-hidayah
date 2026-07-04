<?php

namespace App\Filament\Resources\Prestasis\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PrestasiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('judul')
                    ->required(),
                Select::make('jurusan_id')
                    ->relationship('jurusan', 'nama')
                    ->searchable()
                    ->preload()
                    ->placeholder('Semua Jurusan'),
                DatePicker::make('tanggal')
                    ->native(false)
                    ->displayFormat('d M Y'),
                FileUpload::make('foto')
                    ->image()
                    ->imageEditor()
                    ->directory('prestasi')
                    ->columnSpanFull(),
                Textarea::make('deskripsi')
                    ->columnSpanFull()
                    ->rows(4),
            ]);
    }
}
