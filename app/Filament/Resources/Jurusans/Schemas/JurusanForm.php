<?php

namespace App\Filament\Resources\Jurusans\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Schemas\Schema;

class JurusanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('nama')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('ikon')
                    ->columnSpanFull()
                    ->helperText('Nama icon Heroicons atau FontAwesome'),
                Textarea::make('deskripsi')
                    ->columnSpanFull()
                    ->rows(4),
                Textarea::make('prospek_kerja')
                    ->columnSpanFull()
                    ->rows(4)
                    ->helperText('Pisahkan dengan baris baru untuk setiap item'),
                Select::make('kepala_jurusan_id')
                    ->relationship('kepalaJurusan', 'nama')
                    ->searchable()
                    ->preload()
                    ->placeholder('Pilih Kepala Jurusan'),
                Toggle::make('aktif')
                    ->default(true)
                    ->inline(false),
            ]);
    }
}
