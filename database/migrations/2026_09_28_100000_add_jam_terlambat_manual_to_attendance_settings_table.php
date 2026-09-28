<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /*
    |--------------------------------------------------------------------------
    | Batas Terlambat Bisa Diatur Admin (Di Luar Mode Simulasi)
    |--------------------------------------------------------------------------
    |
    | Setara dengan jam_tutup_manual: memungkinkan admin melonggarkan batas
    | Hadir/Terlambat untuk hari yang sedang berjalan lewat Dashboard, tanpa
    | perlu ubah data satu-satu di database saat ada gangguan seperti
    | kejadian 2026-09-28.
    |
    */

    public function up(): void
    {
        Schema::table('attendance_settings', function (Blueprint $table) {
            $table->string('jam_terlambat_manual', 5)
                ->nullable()
                ->after('jam_tutup_manual');
        });
    }

    public function down(): void
    {
        Schema::table('attendance_settings', function (Blueprint $table) {
            $table->dropColumn('jam_terlambat_manual');
        });
    }
};
