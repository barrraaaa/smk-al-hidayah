<?php

namespace App\Filament\Pages;

use App\Models\SchoolSetting;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;

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

                        FileUpload::make('logo')
                            ->label('Logo Sekolah')
                            ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg', 'image/svg+xml', 'image/webp'])
                            ->disk('public')
                            ->directory('settings/logo')
                            ->maxSize(1024)
                            ->helperText('Upload logo sekolah (PNG, SVG, JPG — max 1MB). Akan tampil di navbar & footer.')
                            ->columnSpanFull(),

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

                Section::make('Beranda — Selamat Datang')
                    ->description('Konten section welcome di halaman depan')
                    ->icon('heroicon-o-home')
                    ->schema([
                        TextInput::make('welcome_heading')
                            ->label('Judul Welcome')
                            ->placeholder('Mengenal Lebih Dekat SMK Al Hidayah 1 Jakarta')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        RichEditor::make('welcome_text')
                            ->label('Teks Welcome')
                            ->toolbarButtons(['bold', 'italic', 'underline', 'orderedList', 'bulletList'])
                            ->columnSpanFull(),

                        FileUpload::make('welcome_image')
                            ->label('Foto Welcome')
                            ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg', 'image/webp', 'image/gif'])
                            ->disk('public')
                            ->directory('settings/welcome')
                            ->maxSize(2048)
                            ->helperText('Foto gedung atau kegiatan sekolah (max 2MB)'),

                        Repeater::make('welcome_advantages')
                            ->label('Kelebihan SMK')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Judul Kelebihan')
                                    ->required()
                                    ->maxLength(255),
                                Textarea::make('description')
                                    ->label('Deskripsi')
                                    ->required()
                                    ->rows(2),
                            ])
                            ->columnSpanFull()
                            ->defaultItems(3)
                            ->addActionLabel('Tambah Kelebihan')
                            ->reorderable()
                            ->collapsible()
                    ]),

                Section::make('Profil — Sambutan Kepala Sekolah')
                    ->description('Konten sambutan di halaman profil')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->schema([
                        RichEditor::make('sambutan_text')
                            ->label('Teks Sambutan')
                            ->toolbarButtons(['bold', 'italic', 'underline', 'orderedList', 'bulletList'])
                            ->columnSpanFull(),

                        FileUpload::make('sambutan_image')
                            ->label('Foto Kepala Sekolah')
                            ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg', 'image/webp', 'image/gif'])
                            ->disk('public')
                            ->directory('settings/sambutan')
                            ->maxSize(2048)
                            ->helperText('Foto resmi kepala sekolah (max 2MB)'),
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

                        FileUpload::make('sejarah_image1')
                            ->label('Foto Sejarah 1')
                            ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg', 'image/webp', 'image/gif'])
                            ->disk('public')
                            ->directory('settings/sejarah')
                            ->maxSize(2048),

                        FileUpload::make('sejarah_image2')
                            ->label('Foto Sejarah 2')
                            ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg', 'image/webp', 'image/gif'])
                            ->disk('public')
                            ->directory('settings/sejarah')
                            ->maxSize(2048),
                    ])
                    ->columns(2),

                Section::make('Struktur Organisasi')
                    ->description('Upload bagan struktur organisasi')
                    ->icon('heroicon-o-rectangle-group')
                    ->schema([
                        FileUpload::make('structure_image')
                            ->label('Bagan Struktur')
                            ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg', 'image/webp', 'image/gif'])
                            ->disk('public')
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

                Section::make('Lokasi & Tampilan')
                    ->description('Google Maps embed & background hero section')
                    ->icon('heroicon-o-map')
                    ->schema([
                        FileUpload::make('hero_image')
                            ->label('Background Hero')
                            ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg', 'image/webp', 'image/gif'])
                            ->disk('public')
                            ->directory('settings/hero')
                            ->maxSize(2048)
                            ->helperText('Upload gambar background untuk hero section (muncul dengan efek transparan, max 2MB)'),

                        Textarea::make('maps_embed_url')
                            ->label('Google Maps Embed URL')
                            ->rows(3)
                            ->helperText('Masukkan URL embed dari Google Maps (src=\"...\")')
                            ->columnSpanFull(),
                    ]),

                Actions::make([
                    Action::make('save')
                        ->label('Simpan Pengaturan')
                        ->action('save')
                        ->color('primary')
                        ->icon('heroicon-o-check'),
                ])
                ->alignEnd()
                ->columnSpanFull(),
            ])
            ->statePath('data');
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
