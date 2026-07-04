<?php

namespace App\Filament\Resources\Pendaftars\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PendaftarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('nomor_pendaftaran')
                    ->label('No. Pendaftaran')
                    ->required()
                    ->disabled()
                    ->dehydrated(),
                TextInput::make('nama')
                    ->required()
                    ->disabled()
                    ->dehydrated(),
                TextInput::make('tempat_lahir')
                    ->label('Tempat Lahir')
                    ->disabled()
                    ->dehydrated(),
                DatePicker::make('tanggal_lahir')
                    ->label('Tanggal Lahir')
                    ->disabled()
                    ->dehydrated(),
                Textarea::make('alamat')
                    ->columnSpanFull()
                    ->disabled()
                    ->dehydrated(),
                TextInput::make('no_telepon')
                    ->label('No. Telepon')
                    ->tel()
                    ->disabled()
                    ->dehydrated(),
                TextInput::make('nama_ortu')
                    ->label('Nama Orang Tua')
                    ->disabled()
                    ->dehydrated(),
                TextInput::make('no_telepon_ortu')
                    ->label('No. Telepon Orang Tua')
                    ->tel()
                    ->disabled()
                    ->dehydrated(),
                TextInput::make('asal_sekolah')
                    ->label('Asal Sekolah')
                    ->disabled()
                    ->dehydrated(),
                Select::make('jurusan_id')
                    ->label('Jurusan')
                    ->relationship('jurusan', 'nama')
                    ->searchable()
                    ->preload()
                    ->disabled()
                    ->dehydrated(),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'menunggu_pembayaran' => 'Menunggu Pembayaran',
                        'menunggu_verifikasi' => 'Menunggu Verifikasi',
                        'terverifikasi' => 'Terverifikasi',
                        'diterima' => 'DITERIMA',
                        'ditolak' => 'Ditolak',
                    ])
                    ->default('menunggu_pembayaran')
                    ->required()
                    ->native(false),
                Textarea::make('alasan_ditolak')
                    ->label('Alasan Ditolak')
                    ->columnSpanFull()
                    ->visible(fn ($get) => $get('status') === 'ditolak'),
                DateTimePicker::make('verified_at')
                    ->label('Tgl. Verifikasi')
                    ->disabled()
                    ->dehydrated(),
            ]);
    }
}
