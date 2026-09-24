<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Tambahkan Status Cuti
        |--------------------------------------------------------------------------
        */

        DB::statement("
            ALTER TABLE absensis
            MODIFY status ENUM(
                'hadir',
                'terlambat',
                'izin',
                'sakit',
                'dinas_luar',
                'cuti',
                'lainnya',
                'alpha'
            ) DEFAULT 'hadir'
        ");
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Kembalikan Status Sebelum Cuti
        |--------------------------------------------------------------------------
        */

        DB::statement("
            ALTER TABLE absensis
            MODIFY status ENUM(
                'hadir',
                'terlambat',
                'izin',
                'sakit',
                'dinas_luar',
                'lainnya',
                'alpha'
            ) DEFAULT 'hadir'
        ");
    }
};
