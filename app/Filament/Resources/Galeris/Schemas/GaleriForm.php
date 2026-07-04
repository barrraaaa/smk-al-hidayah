<?php

namespace App\Filament\Resources\Galeris\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GaleriForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('judul'),
                Select::make('kategori')
                    ->options([
                        'kegiatan' => 'Kegiatan',
                        'jurusan' => 'Jurusan',
                        'sekolah' => 'Sekolah',
                    ])
                    ->default('sekolah')
                    ->required(),
                FileUpload::make('file_path')
                    ->label('Foto')
                    ->image()
                    ->imageEditor()
                    ->directory('galeri')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
