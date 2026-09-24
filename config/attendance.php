<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Lokasi Kantor
    |--------------------------------------------------------------------------
    */

    'latitude' => env('OFFICE_LATITUDE', 0),

    'longitude' => env('OFFICE_LONGITUDE', 0),

    'radius' => env('OFFICE_RADIUS', 150),


    /*
    |--------------------------------------------------------------------------
    | Waktu Absensi Apel Pagi
    |--------------------------------------------------------------------------
    */

    'start_time' => env('ATTENDANCE_START_TIME', '07:30'),

    'end_time' => env('ATTENDANCE_END_TIME', '07:45'),

    /*
    | Toleransi keterlambatan (menit) di atas start_time. Hanya memengaruhi
    | penentuan status di backend; jam yang ditampilkan tetap start_time.
    */

    'late_tolerance_minutes' => env('ATTENDANCE_LATE_TOLERANCE_MINUTES', 1),


    /*
    |--------------------------------------------------------------------------
    | Waktu Absensi Online Mulai Bisa Diisi
    |--------------------------------------------------------------------------
    |
    | Murni informasi untuk pegawai ("absensi online sudah bisa diisi mulai
    | jam segini"). Tidak memengaruhi penentuan status Hadir/Terlambat, yang
    | tetap memakai 'start_time' di atas.
    |
    */

    'online_start_time' => env('ATTENDANCE_ONLINE_START_TIME', '07:00'),


    /*
    |--------------------------------------------------------------------------
    | Password Default Pegawai
    |--------------------------------------------------------------------------
    |
    | Dipakai untuk akun hasil import dan reset password oleh admin.
    | Sengaja tanpa nilai bawaan di kode -- isi lewat DEFAULT_PASSWORD di .env.
    |
    */

    'default_password' => env('DEFAULT_PASSWORD'),


    /*
    |--------------------------------------------------------------------------
    | Mode Simulasi / Testing
    |--------------------------------------------------------------------------
    |
    | Digunakan hanya saat pengembangan untuk mensimulasikan hari Senin
    | dan waktu absensi tanpa mengubah tanggal/jam komputer.
    |
    | Pastikan ATTENDANCE_TEST_MODE=false saat aplikasi digunakan
    | secara normal.
    |
    */

    'test_mode' => env('ATTENDANCE_TEST_MODE', false),

    'test_date' => env('ATTENDANCE_TEST_DATE', null),

    'test_time' => env('ATTENDANCE_TEST_TIME', null),

];