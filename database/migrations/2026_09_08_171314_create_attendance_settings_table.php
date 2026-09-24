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
        Schema::create('attendance_settings', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Mode Simulasi
            |--------------------------------------------------------------------------
            |
            | Selama aktif (dan berada dalam jadwal di bawah, jika diisi),
            | Apel Pagi dapat diisi pada hari apa pun -- bukan cuma Senin.
            | Dipakai supaya pegawai bisa uji coba aplikasi sebelum hari
            | Senin sesungguhnya.
            |
            */

            $table->boolean('simulasi_aktif')->default(false);

            /*
            |--------------------------------------------------------------------------
            | Jadwal/Tahap Simulasi (Opsional)
            |--------------------------------------------------------------------------
            |
            | Kalau diisi, simulasi hanya berlaku selama periode ini walau
            | simulasi_aktif = true. Kalau dikosongkan, simulasi berlaku
            | terus selama simulasi_aktif = true (harus dimatikan manual).
            |
            */

            $table->date('simulasi_tanggal_mulai')->nullable();
            $table->date('simulasi_tanggal_selesai')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Jam Apel Selama Simulasi (Opsional)
            |--------------------------------------------------------------------------
            |
            | Kalau dikosongkan, memakai jam Apel Pagi normal (.env).
            | Diisi kalau admin ingin pegawai bisa uji coba di luar jam
            | tersebut (mis. siang hari).
            |
            */

            $table->time('simulasi_jam_mulai')->nullable();
            $table->time('simulasi_jam_selesai')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_settings');
    }
};
