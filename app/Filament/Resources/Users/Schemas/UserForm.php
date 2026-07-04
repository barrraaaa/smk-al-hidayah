<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rules\Password;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required(fn (string $operation): bool => $operation === 'create')
                    ->rule(Password::default())
                    ->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).*$/')
                    ->dehydrated(fn ($state): bool => filled($state))
                    ->helperText('Min. 8 karakter, kombinasi huruf besar, kecil, dan angka'),

                Select::make('roles')
                    ->label('Role')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->native(false)
                    ->helperText('Pilih role untuk pengguna ini'),
            ]);
    }
}
