<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = [
        'nama',
        'logo',
        'url',
        'sort_order',
        'aktif',
    ];

    protected function casts(): array
    {
        return [
            'aktif' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function scopeAktif($query)
    {
        return $query->where('aktif', true)->orderBy('sort_order');
    }
}
