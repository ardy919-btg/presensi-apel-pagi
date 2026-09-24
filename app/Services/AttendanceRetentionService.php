<?php

namespace App\Services;

use App\Models\Absensi;
use App\Models\AttendanceSetting;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AttendanceRetentionService
{
    public function __construct(
        private GoogleDriveService $drive
    ) {
    }

    /**
     * Simpan hanya N riwayat Apel Pagi Senin sungguhan terakhir milik satu
     * pegawai (sesuai pengaturan admin) -- data & foto selfie yang lebih
     * lama dari itu dihapus permanen (termasuk dari Google Drive kalau
     * foto disimpan di sana).
     *
     * Data hasil simulasi TIDAK ikut dihitung/dihapus di sini -- itu
     * dikelola terpisah lewat tombol "Hapus Data Simulasi".
     */
    public function terapkan(User $user): void
    {
        $batas = AttendanceSetting::current()->retensi_jumlah_absen;

        if (! $batas) {
            return;
        }

        $semuaId = Absensi::where('user_id', $user->id)
            ->where('is_simulasi', false)
            ->whereRaw('DAYOFWEEK(tanggal) = 2')
            ->orderByDesc('tanggal')
            ->orderByDesc('jam_masuk')
            ->pluck('id');

        if ($semuaId->count() <= $batas) {
            return;
        }

        $idDihapus = $semuaId->slice($batas);

        $absensiDihapus = Absensi::whereIn('id', $idDihapus)->get();

        foreach ($absensiDihapus as $absensi) {

            if ($absensi->foto_masuk_storage === 'drive') {
                $this->drive->delete($absensi->foto_masuk);
            } elseif ($absensi->foto_masuk) {
                Storage::disk('public')->delete($absensi->foto_masuk);
            }

            $absensi->delete();
        }
    }
}
