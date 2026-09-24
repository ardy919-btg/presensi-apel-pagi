<?php

namespace App\Console\Commands;

use App\Models\Absensi;
use App\Services\GoogleDriveService;
use Illuminate\Console\Command;

class CabutAksesPublikFotoDrive extends Command
{
    protected $signature = 'drive:privatkan-foto';

    protected $description = 'Cabut izin "siapa saja dengan link" dari foto selfie lama di Google Drive';

    public function handle(GoogleDriveService $drive): int
    {
        if (! $drive->configured()) {
            $this->error('Google Drive belum terhubung.');

            return self::FAILURE;
        }

        $berhasil = 0;
        $gagal = 0;

        Absensi::where('foto_masuk_storage', 'drive')
            ->whereNotNull('foto_masuk')
            ->each(function ($absensi) use ($drive, &$berhasil, &$gagal) {

                $drive->cabutAksesPublik($absensi->foto_masuk)
                    ? $berhasil++
                    : $gagal++;
            });

        $this->info("Selesai: {$berhasil} foto dikunci, {$gagal} gagal.");

        return $gagal === 0 ? self::SUCCESS : self::FAILURE;
    }
}
