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
            | Penanda Data Simulasi
            |--------------------------------------------------------------------------
            |
            | Diisi otomatis true kalau absensi ini dibuat saat mode Simulasi
            | Apel Pagi aktif -- supaya admin bisa membersihkan data uji coba
            | tanpa ikut menghapus data absensi Senin sungguhan.
            |
            */

            $table->boolean('is_simulasi')->default(false)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('absensis', function (Blueprint $table) {
            $table->dropColumn('is_simulasi');
        });
    }
};
