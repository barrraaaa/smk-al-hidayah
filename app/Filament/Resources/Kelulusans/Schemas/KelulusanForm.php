<?php

namespace App\Filament\Resources\Kelulusans\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class KelulusanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Data Peserta')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('nomor_ujian')
                                    ->label('Nomor Ujian')
                                    ->required()
                                    ->maxLength(50)
                                    ->unique(ignoreRecord: true)
                                    ->placeholder('Contoh: 2026-00001'),

                                TextInput::make('nama')
                                    ->label('Nama Lengkap')
                                    ->required()
                                    ->maxLength(255),

                                Select::make('jurusan_id')
                                    ->label('Jurusan')
                                    ->relationship('jurusan', 'nama')
                                    ->searchable()
                                    ->preload()
                                    ->native(false),

                                Select::make('hasil')
                                    ->label('Hasil Kelulusan')
                                    ->options([
                                        'lulus' => '✅ LULUS',
                                        'tidak_lulus' => '❌ TIDAK LULUS',
                                    ])
                                    ->required()
                                    ->native(false),
                            ]),
                    ]),
            ]);
    }
}
