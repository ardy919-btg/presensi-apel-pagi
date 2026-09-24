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
        Schema::table('absensis', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Lokasi Penyimpanan Foto Selfie
            |--------------------------------------------------------------------------
            |
            | 'local'  -> foto_masuk berisi path di storage lokal (perilaku lama).
            | 'drive'  -> foto_masuk berisi file ID Google Drive.
            |
            | Disimpan per baris (bukan cuma baca config saat ini) supaya foto
            | lama tetap bisa ditampilkan dengan benar walau pengaturan Drive
            | diaktifkan/dimatikan belakangan.
            |
            */

            $table->string('foto_masuk_storage')->default('local')->after('foto_masuk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('absensis', function (Blueprint $table) {
            $table->dropColumn('foto_masuk_storage');
        });
    }
};
