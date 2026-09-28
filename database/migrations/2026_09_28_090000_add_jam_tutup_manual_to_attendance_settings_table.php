<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /*
    |--------------------------------------------------------------------------
    | Batas Absen Bisa Diatur Admin (Di Luar Mode Simulasi)
    |--------------------------------------------------------------------------
    |
    | Sebelumnya jam tutup absensi cuma bisa diubah lewat .env (butuh akses
    | server) atau lewat mode simulasi. Kolom ini memungkinkan admin
    | mengubah/memperpanjang jam tutup langsung dari Dashboard, termasuk
    | untuk hari yang sedang berjalan.
    |
    */

    public function up(): void
    {
        Schema::table('attendance_settings', function (Blueprint $table) {
            $table->string('jam_tutup_manual', 5)
                ->nullable()
                ->after('office_radius');
        });
    }

    public function down(): void
    {
        Schema::table('attendance_settings', function (Blueprint $table) {
            $table->dropColumn('jam_tutup_manual');
        });
    }
};
