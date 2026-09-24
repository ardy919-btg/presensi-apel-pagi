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
        Schema::create('drive_settings', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Kredensial OAuth Google Drive
            |--------------------------------------------------------------------------
            |
            | refresh_token dienkripsi (cast 'encrypted') karena setara kata
            | sandi -- siapa pun yang memegangnya bisa upload/hapus file di
            | akun Google Drive yang dihubungkan.
            |
            */

            $table->text('refresh_token')->nullable();
            $table->string('folder_id')->nullable();
            $table->string('connected_email')->nullable();
            $table->timestamp('connected_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drive_settings');
    }
};
