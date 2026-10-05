<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /*
    |--------------------------------------------------------------------------
    | Login Pegawai Tanpa Password Khusus Hari Senin
    |--------------------------------------------------------------------------
    |
    | true (default)  = pegawai tetap wajib password setiap hari.
    | false           = khusus hari Senin, pegawai aktif cukup NIP/nama;
    |                   password tidak dicek. Admin selalu wajib password.
    |
    */

    public function up(): void
    {
        Schema::table('attendance_settings', function (Blueprint $table) {
            $table->boolean('senin_wajib_password')
                ->default(true)
                ->after('jam_terlambat_manual');
        });
    }

    public function down(): void
    {
        Schema::table('attendance_settings', function (Blueprint $table) {
            $table->dropColumn('senin_wajib_password');
        });
    }
};
