<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('must_change_password')
                ->default(false)
                ->after('password');
        });

        /*
        |--------------------------------------------------------------------------
        | Tandai Akun Yang Masih Memakai Password Default
        |--------------------------------------------------------------------------
        |
        | Hanya pegawai yang passwordnya masih sama dengan DEFAULT_PASSWORD
        | yang diwajibkan menggantinya saat login berikutnya.
        |
        */

        $default = config('attendance.default_password');

        if (! $default) {
            return;
        }

        DB::table('users')
            ->where('role', 'pegawai')
            ->select('id', 'password')
            ->orderBy('id')
            ->each(function ($user) use ($default) {

                if (Hash::check($default, $user->password)) {

                    DB::table('users')
                        ->where('id', $user->id)
                        ->update(['must_change_password' => true]);
                }
            });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('must_change_password');
        });
    }
};
