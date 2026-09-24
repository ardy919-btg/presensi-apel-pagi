<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal',
        'jam_masuk',
        'foto_masuk',
        'foto_masuk_storage',
        'latitude_masuk',
        'longitude_masuk',
        'status',
        'alasan_tidak_hadir',
        'keterangan',
        'is_simulasi',
    ];

    protected function casts(): array
    {
        return [
            'is_simulasi' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * URL foto selfie, apa pun lokasi penyimpanannya (lokal atau Google
     * Drive). Selalu lewat route yang mewajibkan login, tidak pernah
     * langsung ke Drive/storage publik.
     */
    public function getFotoMasukUrlAttribute(): ?string
    {
        return $this->foto_masuk
            ? route('absensi.foto', $this->id)
            : null;
    }

    /**
     * URL untuk membuka foto selfie ukuran penuh di tab baru.
     */
    public function getFotoMasukViewUrlAttribute(): ?string
    {
        return $this->foto_masuk_url;
    }
}