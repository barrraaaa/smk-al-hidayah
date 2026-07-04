<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class EditProfile extends Page implements HasForms
{
    use InteractsWithForms;
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationLabel = 'Profil Saya';

    protected static ?string $title = 'Profil Saya';

    protected static ?int $navigationSort = -1;

    protected string $view = 'filament.pages.edit-profile';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(auth()->user()->only(['name', 'email']));
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->rule(Rule::unique('users', 'email')->ignore(auth()->id())),

                TextInput::make('current_password')
                    ->label('Password Saat Ini')
                    ->password()
                    ->requiredWith('new_password')
                    ->rule(fn () => function (string $attribute, $value, $fail) {
                        if (! Hash::check($value, auth()->user()->password)) {
                            $fail('Password saat ini tidak cocok.');
                        }
                    }),

                TextInput::make('new_password')
                    ->label('Password Baru')
                    ->password()
                    ->rule(Password::default())
                    ->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).*$/')
                    ->different('current_password')
                    ->dehydrated(fn ($state): bool => filled($state))
                    ->helperText('Kosongkan jika tidak ingin mengganti password'),

                TextInput::make('new_password_confirmation')
                    ->label('Konfirmasi Password Baru')
                    ->password()
                    ->same('new_password')
                    ->dehydrated(false),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Perubahan')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();

            $user = auth()->user();
            $user->name = $data['name'];
            $user->email = $data['email'];

            if (filled($data['new_password'])) {
                $user->password = Hash::make($data['new_password']);
            }

            $user->save();

            Notification::make()
                ->title('Profil berhasil diperbarui')
                ->success()
                ->send();
        } catch (Halt $e) {
            Notification::make()
                ->title('Gagal menyimpan profil')
                ->danger()
                ->send();
        }
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Pengaturan';
    }
}
