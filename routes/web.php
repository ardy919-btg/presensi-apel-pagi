<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\Admin\QrCodeController;
use App\Http\Controllers\Admin\AbsensiController as AdminAbsensiController;
use App\Http\Controllers\Admin\SimulasiController;
use App\Http\Controllers\Admin\GoogleDriveController;

use App\Http\Controllers\PegawaiImportController;

use App\Http\Controllers\Pegawai\AbsensiController;
use App\Http\Controllers\Pegawai\DashboardController as PegawaiDashboardController;


/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (! Auth::check()) {
        return redirect()->route('login');
    }

    return Auth::user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('pegawai.absensi.index');
});


/*
|--------------------------------------------------------------------------
| Dashboard Default Breeze
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware([
        'auth',
        'verified',
    ])
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');


    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');


    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'admin',
])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard Admin
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [DashboardController::class, 'index']
        )->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Data Pegawai
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/pegawai/import',
            [PegawaiImportController::class, 'import']
        )->name('pegawai.import');


        Route::resource(
            'pegawai',
            PegawaiController::class
        )->except([
            'show',
        ]);


        Route::put(
            '/pegawai/{pegawai}/reset-password',
            [PegawaiController::class, 'resetPassword']
        )->name('pegawai.reset-password');


        /*
        |--------------------------------------------------------------------------
        | Riwayat Absensi Apel Pagi
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/absensi',
            [AdminAbsensiController::class, 'index']
        )->name('absensi.index');


        /*
        |--------------------------------------------------------------------------
        | Laporan Absensi Apel Pagi
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/laporan',
            [AdminAbsensiController::class, 'laporan']
        )->name('laporan.index');


        Route::get(
            '/laporan/pdf',
            [AdminAbsensiController::class, 'exportPdf']
        )->name('laporan.pdf');


        Route::get(
            '/laporan/excel',
            [AdminAbsensiController::class, 'exportExcel']
        )->name('laporan.excel');


        /*
        |--------------------------------------------------------------------------
        | Detail Absensi Apel Pagi
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/absensi/{absensi}',
            [AdminAbsensiController::class, 'show']
        )->name('absensi.show');


        /*
        |--------------------------------------------------------------------------
        | Simulasi Apel Pagi (Uji Coba Di Luar Hari Senin)
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/simulasi',
            [SimulasiController::class, 'edit']
        )->name('simulasi.edit');

        Route::put(
            '/simulasi',
            [SimulasiController::class, 'update']
        )->name('simulasi.update');

        Route::post(
            '/simulasi/nonaktifkan',
            [SimulasiController::class, 'nonaktifkan']
        )->name('simulasi.nonaktifkan');

        Route::delete(
            '/simulasi/data',
            [SimulasiController::class, 'hapusData']
        )->name('simulasi.hapus-data');


        Route::put(
            '/pengaturan/lokasi',
            [SimulasiController::class, 'updateLokasi']
        )->name('pengaturan.lokasi.update');

        Route::put(
            '/pengaturan/retensi',
            [SimulasiController::class, 'updateRetensi']
        )->name('pengaturan.retensi.update');


        /*
        |--------------------------------------------------------------------------
        | Penyimpanan Foto Google Drive
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/drive/connect',
            [GoogleDriveController::class, 'connect']
        )->name('drive.connect');

        Route::get(
            '/drive/callback',
            [GoogleDriveController::class, 'callback']
        )->name('drive.callback');

        Route::post(
            '/drive/disconnect',
            [GoogleDriveController::class, 'disconnect']
        )->name('drive.disconnect');


        /*
        |--------------------------------------------------------------------------
        | QR Code Apel Pagi
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/qrcode',
            [QrCodeController::class, 'index']
        )->name('qrcode.index');


        Route::post(
            '/qrcode/generate-permanent',
            [QrCodeController::class, 'generatePermanent']
        )->name('qrcode.generatePermanent');
    });


/*
|--------------------------------------------------------------------------
| Pegawai
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'pegawai',
])
    ->prefix('pegawai')
    ->name('pegawai.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard Pegawai
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [PegawaiDashboardController::class, 'index']
        )->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Absensi Apel Pagi
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/absensi',
            [AbsensiController::class, 'index']
        )->name('absensi.index');


        /*
        |--------------------------------------------------------------------------
        | Riwayat Absensi Apel Pagi
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/riwayat',
            [AbsensiController::class, 'riwayat']
        )->name('riwayat');


        /*
        |--------------------------------------------------------------------------
        | Kirim Absensi Apel Pagi
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/absensi/masuk',
            [AbsensiController::class, 'masuk']
        )->name('absensi.masuk');


        /*
        |--------------------------------------------------------------------------
        | Scan QR Code Apel Pagi (Sudah Tidak Wajib)
        |--------------------------------------------------------------------------
        |
        | Pegawai tidak lagi perlu scan QR untuk mengisi Apel Pagi -- halaman
        | Status Apel (pegawai.absensi.index) langsung menampilkan form
        | pengisian. Route ini dipertahankan hanya supaya QR fisik yang
        | mungkin sudah tercetak/terpasang tidak berujung 404.
        |--------------------------------------------------------------------------
        */

        Route::get('/qrcode/{token}', function () {
            return redirect()->route('pegawai.absensi.index');
        })->name('qrcode.verify');


        /*
        |--------------------------------------------------------------------------
        | Halaman Verifikasi Lama (Sudah Digabung Ke Status Apel)
        |--------------------------------------------------------------------------
        */

        Route::get('/verifikasi', function () {
            return redirect()->route('pegawai.absensi.index');
        })->name('verifikasi');
    });


/*
|--------------------------------------------------------------------------
| Authentication Breeze
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';