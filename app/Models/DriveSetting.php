<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DriveSetting extends Model
{
    protected $fillable = [
        'refresh_token',
        'folder_id',
        'connected_email',
        'connected_at',
    ];

    protected function casts(): array
    {
        return [
            'refresh_token' => 'encrypted',
            'connected_at' => 'datetime',
        ];
    }

    /**
     * Baris pengaturan tunggal (single-row settings).
     */
    public static function current(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }

    public function terhubung(): bool
    {
        return ! empty($this->refresh_token) && ! empty($this->folder_id);
    }
}
