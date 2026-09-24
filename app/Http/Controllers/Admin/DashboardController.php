<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AttendanceTime;
use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Waktu Hari Ini
        |--------------------------------------------------------------------------
        |
        | Menggunakan AttendanceTime agar mendukung mode simulasi.
        |
        */

        $today = AttendanceTime::today();

        /*
        |--------------------------------------------------------------------------
        | Apakah Apel Pagi Aktif Hari Ini
        |--------------------------------------------------------------------------
        |
        | Hari Senin sungguhan, ATAU hari apa pun selama mode simulasi
        | sedang berlaku. Nama variabel dipertahankan ($isSenin) supaya
        | tidak perlu mengubah seluruh view yang memakainya.
        |
        */

        $isSenin = AttendanceTime::apelDiizinkanHariIni();


        /*
        |--------------------------------------------------------------------------
        | Total Pegawai Aktif
        |--------------------------------------------------------------------------
        */

        $totalPegawai = User::where(
            'role',
            'pegawai'
        )
            ->where(
                'status',
                'aktif'
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Statistik Apel Hari Ini
        |--------------------------------------------------------------------------
        |
        | Statistik hanya dihitung pada hari Senin.
        |
        */

        if ($isSenin) {

            /*
            |--------------------------------------------------------------------------
            | Jumlah Pegawai Yang Sudah Tercatat
            |--------------------------------------------------------------------------
            */

            $sudahTercatatHariIni = Absensi::whereDate(
                'tanggal',
                $today
            )
                ->distinct(
                    'user_id'
                )
                ->count(
                    'user_id'
                );


            /*
            |--------------------------------------------------------------------------
            | Hadir
            |--------------------------------------------------------------------------
            */

            $hadirHariIni = Absensi::whereDate(
                'tanggal',
                $today
            )
                ->where(
                    'status',
                    'hadir'
                )
                ->count();


            /*
            |--------------------------------------------------------------------------
            | Terlambat
            |--------------------------------------------------------------------------
            */

            $terlambatHariIni = Absensi::whereDate(
                'tanggal',
                $today
            )
                ->where(
                    'status',
                    'terlambat'
                )
                ->count();


            /*
            |--------------------------------------------------------------------------
            | Izin
            |--------------------------------------------------------------------------
            */

            $izinHariIni = Absensi::whereDate(
                'tanggal',
                $today
            )
                ->where(
                    'status',
                    'izin'
                )
                ->count();


            /*
            |--------------------------------------------------------------------------
            | Sakit
            |--------------------------------------------------------------------------
            */

            $sakitHariIni = Absensi::whereDate(
                'tanggal',
                $today
            )
                ->where(
                    'status',
                    'sakit'
                )
                ->count();


            /*
            |--------------------------------------------------------------------------
            | Dinas Luar
            |--------------------------------------------------------------------------
            */

            $dinasLuarHariIni = Absensi::whereDate(
                'tanggal',
                $today
            )
                ->where(
                    'status',
                    'dinas_luar'
                )
                ->count();


            /*
            |--------------------------------------------------------------------------
            | Cuti
            |--------------------------------------------------------------------------
            */

            $cutiHariIni = Absensi::whereDate(
                'tanggal',
                $today
            )
                ->where(
                    'status',
                    'cuti'
                )
                ->count();


            /*
            |--------------------------------------------------------------------------
            | Lainnya
            |--------------------------------------------------------------------------
            */

            $lainnyaHariIni = Absensi::whereDate(
                'tanggal',
                $today
            )
                ->where(
                    'status',
                    'lainnya'
                )
                ->count();


            /*
            |--------------------------------------------------------------------------
            | Alpha
            |--------------------------------------------------------------------------
            */

            $alphaHariIni = Absensi::whereDate(
                'tanggal',
                $today
            )
                ->where(
                    'status',
                    'alpha'
                )
                ->count();


            /*
            |--------------------------------------------------------------------------
            | Belum Mengisi
            |--------------------------------------------------------------------------
            |
            | Sebelum batas pukul 07:45, pegawai yang belum mengirim
            | absensi masih dihitung sebagai "Belum Mengisi".
            |
            | Setelah proses Alpha otomatis berjalan, pegawai tersebut
            | akan tercatat sebagai Alpha.
            |
            */

            $belumAbsen = max(
                $totalPegawai - $sudahTercatatHariIni,
                0
            );

        } else {

            /*
            |--------------------------------------------------------------------------
            | Hari Selain Senin
            |--------------------------------------------------------------------------
            */

            $hadirHariIni = 0;

            $terlambatHariIni = 0;

            $izinHariIni = 0;

            $sakitHariIni = 0;

            $dinasLuarHariIni = 0;

            $cutiHariIni = 0;

            $lainnyaHariIni = 0;

            $alphaHariIni = 0;

            $belumAbsen = 0;
        }


        /*
        |--------------------------------------------------------------------------
        | Riwayat Apel Terbaru
        |--------------------------------------------------------------------------
        |
        | Hanya mengambil data absensi yang tanggalnya hari Senin.
        |
        | DAYOFWEEK MySQL:
        |
        | 1 = Minggu
        | 2 = Senin
        |
        */

        $absensiTerbaru = Absensi::with(
            'user'
        )
            ->where(function ($query) {

                $query->whereRaw('DAYOFWEEK(tanggal) = 2')
                    ->orWhere('is_simulasi', true);
            })
            ->orderByDesc(
                'tanggal'
            )
            ->orderByDesc(
                'jam_masuk'
            )
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Tampilkan Dashboard
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.dashboard',
            compact(
                'totalPegawai',
                'hadirHariIni',
                'terlambatHariIni',
                'izinHariIni',
                'sakitHariIni',
                'dinasLuarHariIni',
                'cutiHariIni',
                'lainnyaHariIni',
                'alphaHariIni',
                'belumAbsen',
                'absensiTerbaru',
                'isSenin'
            )
        );
    }
}