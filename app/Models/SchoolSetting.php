<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SchoolSetting extends Model
{
    protected $fillable = [
        'school_name',
        'address',
        'phone',
        'email',
        'ppdb_email',
        'description',
        'vision',
        'mission',
        'history',
        'structure_image',
        'ppdb_fee',
        'ppdb_schedule',
        'ppdb_requirements',
        'facebook_url',
        'instagram_url',
        'youtube_url',
        'tiktok_url',
        'maps_embed_url',
    ];

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
