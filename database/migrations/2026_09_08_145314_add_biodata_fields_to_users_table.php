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
        Schema::table('users', function (Blueprint $table) {
            $table->string('pangkat_golongan')->nullable()->after('bidang');
            $table->date('tanggal_lahir')->nullable()->after('pangkat_golongan');

            $table->enum('jenis_kelamin', [
                'Laki-Laki',
                'Perempuan',
            ])->nullable()->after('tanggal_lahir');

            $table->string('pendidikan')->nullable()->after('jenis_kelamin');
            $table->string('pendidikan_detail')->nullable()->after('pendidikan');

            $table->enum('golongan_darah', [
                'A',
                'B',
                'AB',
                'O',
            ])->nullable()->after('pendidikan_detail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'pangkat_golongan',
                'tanggal_lahir',
                'jenis_kelamin',
                'pendidikan',
                'pendidikan_detail',
                'golongan_darah',
            ]);
        });
    }
};
