<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('attendance_settings', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Lokasi & Radius Kantor
            |--------------------------------------------------------------------------
            |
            | Sebelumnya cuma bisa diatur lewat OFFICE_LATITUDE/OFFICE_LONGITUDE/
            | OFFICE_RADIUS di .env -- sekarang bisa diatur admin lewat UI. Kolom
            | .env tetap jadi nilai default/fallback kalau kolom ini kosong.
            |
            */

            $table->decimal('office_latitude', 10, 7)->nullable();
            $table->decimal('office_longitude', 10, 7)->nullable();
            $table->unsignedInteger('office_radius')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Retensi Data Absensi
            |--------------------------------------------------------------------------
            |
            | Jumlah riwayat Apel Pagi (hari Senin sungguhan) terakhir yang
            | disimpan per pegawai -- data & foto selfie yang lebih lama dari
            | ini otomatis dihapus (termasuk dari Google Drive kalau aktif).
            | NULL/0 berarti retensi dimatikan (simpan semua).
            |
            */

            $table->unsignedInteger('retensi_jumlah_absen')->nullable()->default(10);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendance_settings', function (Blueprint $table) {
            $table->dropColumn([
                'office_latitude',
                'office_longitude',
                'office_radius',
                'retensi_jumlah_absen',
            ]);
        });
    }
};
