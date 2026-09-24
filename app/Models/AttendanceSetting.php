<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceSetting extends Model
{
    protected $fillable = [
        'simulasi_aktif',
        'simulasi_tanggal_mulai',
        'simulasi_tanggal_selesai',
        'simulasi_jam_mulai',
        'simulasi_jam_selesai',
        'office_latitude',
        'office_longitude',
        'office_radius',
        'retensi_jumlah_absen',
    ];

    protected function casts(): array
    {
        return [
            'simulasi_aktif' => 'boolean',
            'simulasi_tanggal_mulai' => 'date',
            'simulasi_tanggal_selesai' => 'date',
        ];
    }

    /**
     * Baris pengaturan tunggal (single-row settings).
     */
    public static function current(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
