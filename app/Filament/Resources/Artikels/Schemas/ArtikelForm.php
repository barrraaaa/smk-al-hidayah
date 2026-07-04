<?php

namespace App\Filament\Resources\Artikels\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Schemas\Schema;

class ArtikelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('judul')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                RichEditor::make('konten')
                    ->required()
                    ->columnSpanFull()
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('artikel'),
                FileUpload::make('thumbnail')
                    ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->directory('artikel/thumbnail')
                    ->columnSpanFull(),
                Select::make('kategori_id')
                    ->relationship('kategori', 'nama')
                    ->searchable()
                    ->preload()
                    ->placeholder('Pilih Kategori'),
                TextInput::make('tags')
                    ->helperText('Pisahkan dengan koma, contoh: pendidikan, prestasi, kegiatan'),
                Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ])
                    ->default('draft')
                    ->required()
                    ->native(false),
                DateTimePicker::make('published_at')
                    ->label('Tanggal Publikasi')
                    ->nullable(),
            ]);
    }
}
