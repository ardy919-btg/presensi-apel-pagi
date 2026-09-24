<?php

namespace App\Console\Commands;

use App\Helpers\AttendanceTime;
use App\Models\Absensi;
use App\Models\User;
use App\Services\AttendanceRetentionService;
use Illuminate\Console\Command;

class GenerateAlphaApel extends Command
{
    protected $signature = 'apel:generate-alpha';

    protected $description = 'Membuat status Alpha otomatis untuk pegawai yang belum mengisi absensi Apel Pagi';

    public function handle(): int
    {
        $today = AttendanceTime::today();

        /*
        |--------------------------------------------------------------------------
        | Pastikan Hari Senin (Atau Sedang Simulasi)
        |--------------------------------------------------------------------------
        |
        | Jadwal cron (routes/console.php) tetap hanya berjalan hari Senin,
        | tapi pengecekan ini juga dilonggarkan supaya command bisa dites
        | manual lewat CLI selama mode simulasi berlaku.
        |
        */

        if (! AttendanceTime::apelDiizinkanHariIni()) {
            $this->error(
                'Proses Alpha hanya dapat dilakukan untuk hari Senin.'
            );

            return self::FAILURE;
        }


        /*
        |--------------------------------------------------------------------------
        | Cari Pegawai Aktif Yang Belum Memiliki Absensi
        |--------------------------------------------------------------------------
        */

        $pegawaiBelumAbsen = User::where('role', 'pegawai')
            ->where('status', 'aktif')
            ->whereDoesntHave('absensis', function ($query) use ($today) {
                $query->whereDate(
                    'tanggal',
                    $today->toDateString()
                );
            })
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Tidak Ada Pegawai Yang Perlu Dijadikan Alpha
        |--------------------------------------------------------------------------
        */

        if ($pegawaiBelumAbsen->isEmpty()) {
            $this->info(
                'Tidak ada pegawai yang perlu ditetapkan sebagai Alpha.'
            );

            return self::SUCCESS;
        }


        /*
        |--------------------------------------------------------------------------
        | Buat Data Alpha
        |--------------------------------------------------------------------------
        */

        $jumlahAlpha = 0;

        foreach ($pegawaiBelumAbsen as $pegawai) {

            $absensi = Absensi::firstOrCreate(
                [
                    'user_id' => $pegawai->id,
                    'tanggal' => $today->toDateString(),
                ],
                [
                    'jam_masuk' => null,
                    'foto_masuk' => null,
                    'latitude_masuk' => null,
                    'longitude_masuk' => null,
                    'status' => 'alpha',
                    'alasan_tidak_hadir' => null,
                    'keterangan' => null,
                    'is_simulasi' => AttendanceTime::simulasiAktif(),
                ]
            );

            if ($absensi->wasRecentlyCreated) {
                $jumlahAlpha++;

                app(AttendanceRetentionService::class)->terapkan($pegawai);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Informasi Hasil
        |--------------------------------------------------------------------------
        */

        $this->info(
            $jumlahAlpha .
            ' pegawai berhasil ditetapkan sebagai Alpha.'
        );

        return self::SUCCESS;
    }
}