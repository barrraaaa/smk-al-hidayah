<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pendaftar extends Model
{
    protected $fillable = [
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_telepon',
        'nama_ortu',
        'no_telepon_ortu',
        'asal_sekolah',
        'jurusan_id',
        'status',
        'nomor_pendaftaran',
        'alasan_ditolak',
        'verified_at',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
            'verified_at' => 'datetime',
        ];
    }

    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function dokumenPpdb(): HasMany
    {
        return $this->hasMany(DokumenPPDB::class);
    }

    public function buktiBayars(): HasMany
    {
        return $this->hasMany(BuktiBayar::class);
    }
}
