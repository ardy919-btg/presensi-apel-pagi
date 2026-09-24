<?php

namespace App\Http\Controllers\Pegawai;

use App\Helpers\AttendanceTime;
use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Gunakan Tanggal Aplikasi / Simulasi
        |--------------------------------------------------------------------------
        |
        | Jika ATTENDANCE_TEST_MODE=true, tanggal mengikuti
        | ATTENDANCE_TEST_DATE.
        |
        */

        $today = AttendanceTime::today();


        /*
        |--------------------------------------------------------------------------
        | Cek Hari Apel
        |--------------------------------------------------------------------------
        |
        | Apel Pagi normalnya hanya dilaksanakan setiap hari Senin, kecuali
        | saat mode simulasi sedang berlaku (bisa hari apa saja).
        |
        */

        $isSenin = AttendanceTime::apelDiizinkanHariIni();


        /*
        |--------------------------------------------------------------------------
        | Absensi Apel Hari Ini
        |--------------------------------------------------------------------------
        |
        | Hanya mencari absensi hari ini apabila hari Senin.
        |
        */

        $absensiHariIni = null;

        if ($isSenin) {
            $absensiHariIni = Absensi::where(
                'user_id',
                $user->id
            )
                ->whereDate(
                    'tanggal',
                    $today
                )
                ->first();
        }


        /*
        |--------------------------------------------------------------------------
        | Tampilkan Dashboard Pegawai
        |--------------------------------------------------------------------------
        |
        | Rekap seluruh pegawai dan riwayat apel pegawai dipindahkan ke
        | halaman Riwayat Apel supaya dashboard tidak terlalu penuh.
        |
        */

        return view(
            'pegawai.dashboard',
            compact(
                'absensiHariIni',
                'isSenin'
            )
        );
    }
}