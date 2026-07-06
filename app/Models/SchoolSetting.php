<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SchoolSetting extends Model
{
    protected $fillable = [
        'school_name',
        'logo',
        'address',
        'phone',
        'email',
        'ppdb_email',
        'description',
        'welcome_heading',
        'welcome_text',
        'welcome_image',
        'welcome_advantages',
        'sambutan_text',
        'sambutan_image',
        'vision',
        'mission',
        'history',
        'sejarah_image1',
        'sejarah_image2',
        'structure_image',
        'ppdb_fee',
        'ppdb_schedule',
        'ppdb_requirements',
        'facebook_url',
        'instagram_url',
        'youtube_url',
        'tiktok_url',
        'maps_embed_url',
        'hero_image',
    ];

    protected function casts(): array
    {
        return [
            'welcome_advantages' => 'array',
        ];
    }

    public function getLogoUrlAttribute(): ?string
    {
        if ($this->logo) {
            return Storage::url($this->logo);
        }
        return null;
    }

    public function getStructureImageUrlAttribute(): ?string
    {
        if ($this->structure_image) {
            return Storage::url($this->structure_image);
        }
        return null;
    }

    public static function getSettings(): self
    {
        return self::firstOrCreate([]);
    }
}
