<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;


/*
|--------------------------------------------------------------------------
| Command Bawaan Laravel
|--------------------------------------------------------------------------
*/

Artisan::command('inspire', function () {

    $this->comment(
        Inspiring::quote()
    );

})->purpose(
    'Display an inspiring quote'
);


/*
|--------------------------------------------------------------------------
| Alpha Otomatis Apel Pagi
|--------------------------------------------------------------------------
|
| Jalan tiap menit di hari Senin -- command itu sendiri yang menentukan
| apakah sudah lewat jam tutup (lihat GenerateAlphaApel::handle()), supaya
| perpanjangan batas absen dari Dashboard Admin ikut terbaca. Jangan pakai
| ->at() dengan jam tetap di sini karena tidak akan mengikuti perpanjangan
| itu.
|
*/

Schedule::command(
    'apel:generate-alpha'
)
    ->everyMinute()
    ->mondays()
    ->timezone(
        'Asia/Makassar'
    )
    ->name(
        'apel-pagi-alpha-otomatis'
    )
    ->withoutOverlapping();