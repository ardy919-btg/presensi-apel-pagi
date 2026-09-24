<?php

namespace App\Helpers;

use App\Models\AttendanceSetting;
use Carbon\Carbon;

class AttendanceTime
{
    /**
     * Ambil pengaturan simulasi jika sedang berlaku (aktif dan, kalau
     * jadwalnya diisi, tanggal hari ini berada dalam rentang jadwal itu).
     */
    public static function pengaturanSimulasi(): ?AttendanceSetting
    {
        $pengaturan = AttendanceSetting::current();

        if (! $pengaturan->simulasi_aktif) {
            return null;
        }

        $hariIni = self::today();

        if (
            $pengaturan->simulasi_tanggal_mulai &&
            $hariIni->lt($pengaturan->simulasi_tanggal_mulai)
        ) {
            return null;
        }

        if (
            $pengaturan->simulasi_tanggal_selesai &&
            $hariIni->gt($pengaturan->simulasi_tanggal_selesai)
        ) {
            return null;
        }

        return $pengaturan;
    }

    /**
     * Apakah mode simulasi Apel Pagi sedang berlaku.
     */
    public static function simulasiAktif(): bool
    {
        return self::pengaturanSimulasi() !== null;
    }

    /**
     * Apakah Apel Pagi boleh diisi hari ini -- hari Senin sungguhan,
     * atau hari apa pun selama mode simulasi sedang berlaku.
     */
    public static function apelDiizinkanHariIni(): bool
    {
        return self::today()->isMonday() || self::simulasiAktif();
    }

    public static function now(): Carbon
    {
        /*
        |--------------------------------------------------------------------------
        | Mode Testing Lama (.env) -- Tetap Didukung Untuk Development
        |--------------------------------------------------------------------------
        */

        if (
            config('attendance.test_mode') &&
            config('attendance.test_date') &&
            config('attendance.test_time')
        ) {
            return Carbon::createFromFormat(
                'Y-m-d H:i',
                config('attendance.test_date')
                . ' '
                . config('attendance.test_time'),
                config('app.timezone')
            );
        }

        return Carbon::now();
    }

    public static function today(): Carbon
    {
        return self::now()->copy()->startOfDay();
    }

    /**
     * Jam mulai Apel Pagi -- pakai jam simulasi jika diisi admin,
     * kalau tidak pakai konfigurasi default (.env).
     */
    public static function jamMulai(): string
    {
        $simulasi = self::pengaturanSimulasi();

        if ($simulasi && $simulasi->simulasi_jam_mulai) {
            return substr($simulasi->simulasi_jam_mulai, 0, 5);
        }

        return config('attendance.start_time', '07:30');
    }

    /**
     * Jam tutup Apel Pagi -- pakai jam simulasi jika diisi admin,
     * kalau tidak pakai konfigurasi default (.env).
     */
    public static function jamSelesai(): string
    {
        $simulasi = self::pengaturanSimulasi();

        if ($simulasi && $simulasi->simulasi_jam_selesai) {
            return substr($simulasi->simulasi_jam_selesai, 0, 5);
        }

        return config('attendance.end_time', '07:45');
    }

    /**
     * Jam mulai absensi online bisa diisi -- murni informasi untuk
     * pegawai, tidak memengaruhi status Hadir/Terlambat (lihat jamMulai()).
     */
    public static function jamMulaiOnline(): string
    {
        return config('attendance.online_start_time', '07:00');
    }

    /**
     * Latitude kantor -- pakai pengaturan admin (database) jika sudah
     * diisi, kalau tidak pakai konfigurasi default (.env).
     */
    public static function officeLatitude(): float
    {
        $pengaturan = AttendanceSetting::current();

        return (float) ($pengaturan->office_latitude ?? config('attendance.latitude', 0));
    }

    /**
     * Longitude kantor -- pakai pengaturan admin (database) jika sudah
     * diisi, kalau tidak pakai konfigurasi default (.env).
     */
    public static function officeLongitude(): float
    {
        $pengaturan = AttendanceSetting::current();

        return (float) ($pengaturan->office_longitude ?? config('attendance.longitude', 0));
    }

    /**
     * Radius toleransi lokasi kantor (meter) -- pakai pengaturan admin
     * (database) jika sudah diisi, kalau tidak pakai konfigurasi default
     * (.env).
     */
    public static function officeRadius(): float
    {
        $pengaturan = AttendanceSetting::current();

        return (float) ($pengaturan->office_radius ?? config('attendance.radius', 150));
    }
}
