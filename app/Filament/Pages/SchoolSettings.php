<?php

namespace App\Filament\Pages;

use App\Models\SchoolSetting;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;
use Filament\Support\Icons\Heroicon;

class SchoolSettings extends Page implements HasForms
{
    use InteractsWithForms;
    protected string $view = 'filament.pages.school-settings';

    protected static ?string $navigationLabel = 'Pengaturan Sekolah';
    protected static ?string $title = 'Pengaturan Sekolah';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?int $navigationSort = 2;

    public ?array $data = [];

    public function mount(): void
    {
        $settings = SchoolSetting::getSettings();
        $this->form->fill($settings->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Informasi Umum')
                    ->description('Data dasar sekolah')
                    ->icon('heroicon-o-building-office')
                    ->schema([
                        TextInput::make('school_name')
                            ->label('Nama Sekolah')
                            ->required()
                            ->maxLength(255),

                        Textarea::make('description')
                            ->label('Deskripsi Singkat')
                            ->rows(3)
                            ->helperText('Digunakan untuk meta description dan hero section'),

                        TextInput::make('address')
                            ->label('Alamat')
                            ->maxLength(500),

                        TextInput::make('phone')
                            ->label('No. Telepon')
                            ->maxLength(50)
                            ->tel(),

                        TextInput::make('email')
                            ->label('Email Utama')
                            ->email()
                            ->maxLength(255),

                        TextInput::make('ppdb_email')
                            ->label('Email PPDB')
                            ->email()
                            ->maxLength(255)
                            ->helperText('Email khusus untuk pendaftaran PPDB'),
                    ])
                    ->columns(2),

                Section::make('Visi, Misi & Sejarah')
                    ->description('Profil sekolah')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        RichEditor::make('vision')
                            ->label('Visi')
                            ->toolbarButtons(['bold', 'italic', 'underline', 'orderedList', 'bulletList'])
                            ->columnSpanFull(),

                        RichEditor::make('mission')
                            ->label('Misi')
                            ->toolbarButtons(['bold', 'italic', 'underline', 'orderedList', 'bulletList'])
                            ->columnSpanFull(),

                        RichEditor::make('history')
                            ->label('Sejarah Sekolah')
                            ->toolbarButtons(['bold', 'italic', 'underline', 'orderedList', 'bulletList', 'link'])
                            ->columnSpanFull(),
                    ]),

                Section::make('Struktur Organisasi')
                    ->description('Upload bagan struktur organisasi')
                    ->icon('heroicon-o-rectangle-group')
                    ->schema([
                        FileUpload::make('structure_image')
                            ->label('Bagan Struktur')
                            ->image()
                            ->imageEditor()
                            ->directory('settings/struktur')
                            ->maxSize(2048)
                            ->helperText('Upload gambar bagan struktur organisasi (max 2MB)'),
                    ]),

                Section::make('Media Sosial')
                    ->description('Link akun media sosial resmi')
                    ->icon('heroicon-o-share')
                    ->schema([
                        TextInput::make('facebook_url')
                            ->label('Facebook')
                            ->url()
                            ->maxLength(255)
                            ->prefix('fb.com/'),

                        TextInput::make('instagram_url')
                            ->label('Instagram')
                            ->url()
                            ->maxLength(255)
                            ->prefix('instagram.com/'),

                        TextInput::make('youtube_url')
                            ->label('YouTube')
                            ->url()
                            ->maxLength(255)
                            ->prefix('youtube.com/'),

                        TextInput::make('tiktok_url')
                            ->label('TikTok')
                            ->url()
                            ->maxLength(255)
                            ->prefix('tiktok.com/'),
                    ])
                    ->columns(2),

                Section::make('Info PPDB')
                    ->description('Informasi pendaftaran siswa baru')
                    ->icon('heroicon-o-academic-cap')
                    ->schema([
                        TextInput::make('ppdb_fee')
                            ->label('Biaya Pendaftaran')
                            ->maxLength(255)
                            ->placeholder('Contoh: Rp 500.000'),

                        RichEditor::make('ppdb_schedule')
                            ->label('Jadwal PPDB')
                            ->toolbarButtons(['bold', 'italic', 'underline', 'orderedList', 'bulletList'])
                            ->columnSpanFull(),

                        RichEditor::make('ppdb_requirements')
                            ->label('Persyaratan')
                            ->toolbarButtons(['bold', 'italic', 'underline', 'orderedList', 'bulletList'])
                            ->columnSpanFull(),
                    ]),

                Section::make('Lokasi')
                    ->description('Google Maps embed untuk halaman kontak')
                    ->icon('heroicon-o-map')
                    ->schema([
                        Textarea::make('maps_embed_url')
                            ->label('Google Maps Embed URL')
                            ->rows(3)
                            ->helperText('Masukkan URL embed dari Google Maps (src=\"...\")')
                            ->columnSpanFull(),
                    ]),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Pengaturan')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();

            $settings = SchoolSetting::getSettings();
            $settings->update($data);

            Notification::make()
                ->title('Pengaturan berhasil disimpan')
                ->success()
                ->send();
        } catch (Halt $e) {
            Notification::make()
                ->title('Gagal menyimpan pengaturan')
                ->danger()
                ->send();
        }
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Pengaturan';
    }
}
