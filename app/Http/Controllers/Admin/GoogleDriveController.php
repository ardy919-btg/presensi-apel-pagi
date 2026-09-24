<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DriveSetting;
use App\Services\GoogleDriveService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class GoogleDriveController extends Controller
{
    public function __construct(
        private GoogleDriveService $drive
    ) {
    }


    /*
    |--------------------------------------------------------------------------
    | Langkah 1: Redirect Ke Layar Izin Google
    |--------------------------------------------------------------------------
    */

    public function connect(Request $request): RedirectResponse
    {
        if (
            ! config('services.google.client_id') ||
            ! config('services.google.client_secret')
        ) {
            return redirect()
                ->route('admin.simulasi.edit')
                ->with(
                    'error',
                    'GOOGLE_CLIENT_ID / GOOGLE_CLIENT_SECRET belum diisi di .env server.'
                );
        }

        $state = Str::random(40);

        $request->session()->put('drive_oauth_state', $state);

        return redirect(
            $this->drive->authorizationUrl(
                route('admin.drive.callback'),
                $state
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Langkah 2: Callback Setelah Admin Memberi Izin Di Google
    |--------------------------------------------------------------------------
    */

    public function callback(Request $request): RedirectResponse
    {
        if ($request->filled('error')) {
            return redirect()
                ->route('admin.simulasi.edit')
                ->with(
                    'error',
                    'Otorisasi Google Drive dibatalkan atau gagal: ' . $request->input('error')
                );
        }

        $state = $request->session()->pull('drive_oauth_state');

        if (
            ! $state ||
            $state !== $request->input('state') ||
            ! $request->filled('code')
        ) {
            return redirect()
                ->route('admin.simulasi.edit')
                ->with(
                    'error',
                    'Permintaan otorisasi Google Drive tidak valid. Silakan coba lagi.'
                );
        }

        $tokens = $this->drive->exchangeCode(
            $request->input('code'),
            route('admin.drive.callback')
        );

        if (! $tokens || empty($tokens['access_token'])) {
            return redirect()
                ->route('admin.simulasi.edit')
                ->with(
                    'error',
                    'Gagal menukar kode otorisasi Google Drive. Silakan coba lagi.'
                );
        }

        if (empty($tokens['refresh_token'])) {
            return redirect()
                ->route('admin.simulasi.edit')
                ->with(
                    'error',
                    'Google tidak memberikan refresh token (biasanya karena akun ini sudah pernah '
                    . 'memberi izin sebelumnya). Buka myaccount.google.com/permissions, cabut akses '
                    . '"Absensi Apel BPKAD", lalu coba hubungkan ulang.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Ambil Email Akun Yang Baru Terhubung
        |--------------------------------------------------------------------------
        */

        $email = null;

        $userInfo = Http::withToken($tokens['access_token'])
            ->get('https://www.googleapis.com/oauth2/v2/userinfo');

        if ($userInfo->successful()) {
            $email = $userInfo->json('email');
        }


        /*
        |--------------------------------------------------------------------------
        | Buat Folder Tujuan Foto Selfie
        |--------------------------------------------------------------------------
        |
        | Scope drive.file cuma bisa akses file/folder yang dibuat lewat
        | aplikasi ini sendiri, jadi folder tujuan wajib dibuat di sini.
        |
        */

        $folder = $this->drive->buatFolder(
            $tokens['access_token'],
            'Absensi Apel BPKAD - Selfie'
        );

        if (! $folder || empty($folder['id'])) {
            return redirect()
                ->route('admin.simulasi.edit')
                ->with(
                    'error',
                    'Berhasil otorisasi, tapi gagal membuat folder tujuan di Google Drive.'
                );
        }

        DriveSetting::current()->update([
            'refresh_token' => $tokens['refresh_token'],
            'folder_id' => $folder['id'],
            'connected_email' => $email,
            'connected_at' => now(),
        ]);

        return redirect()
            ->route('admin.simulasi.edit')
            ->with(
                'success',
                'Google Drive berhasil terhubung' . ($email ? ' sebagai ' . $email : '') . '.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Putuskan Koneksi Google Drive
    |--------------------------------------------------------------------------
    */

    public function disconnect(): RedirectResponse
    {
        DriveSetting::current()->update([
            'refresh_token' => null,
            'folder_id' => null,
            'connected_email' => null,
            'connected_at' => null,
        ]);

        return redirect()
            ->route('admin.simulasi.edit')
            ->with(
                'success',
                'Google Drive berhasil diputuskan. Foto selfie baru akan disimpan di server lokal.'
            );
    }
}
