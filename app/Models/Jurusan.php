<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jurusan extends Model
{
    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'prospek_kerja',
        'ikon',
        'kepala_jurusan_id',
        'aktif',
    ];

    protected function casts(): array
    {
        return [
            'aktif' => 'boolean',
        ];
    }

    public function kepalaJurusan(): BelongsTo
    {
        return $this->belongsTo(Guru::class, 'kepala_jurusan_id');
    }

    public function gurus(): HasMany
    {
        return $this->hasMany(Guru::class);
    }

    public function pendaftars(): HasMany
    {
        return $this->hasMany(Pendaftar::class);
    }

    public function prestasis(): HasMany
    {
        return $this->hasMany(Prestasi::class);
    }

    public function kelulusans(): HasMany
    {
        return $this->hasMany(Kelulusan::class);
    }
}
