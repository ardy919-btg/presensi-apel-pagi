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
     * URL untuk menampilkan thumbnail/preview foto selfie, apa pun lokasi
     * penyimpanannya (lokal atau Google Drive).
     */
    public function getFotoMasukUrlAttribute(): ?string
    {
        if (! $this->foto_masuk) {
            return null;
        }

        if ($this->foto_masuk_storage === 'drive') {
            return 'https://drive.google.com/thumbnail?sz=w1000&id=' . $this->foto_masuk;
        }

        return asset('storage/' . $this->foto_masuk);
    }

    /**
     * URL untuk membuka foto selfie ukuran penuh di tab baru.
     */
    public function getFotoMasukViewUrlAttribute(): ?string
    {
        if (! $this->foto_masuk) {
            return null;
        }

        if ($this->foto_masuk_storage === 'drive') {
            return 'https://drive.google.com/file/d/' . $this->foto_masuk . '/view';
        }

        return asset('storage/' . $this->foto_masuk);
    }
}