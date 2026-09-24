<?php

namespace App\Services;

use App\Models\DriveSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class GoogleDriveService
{
    /**
     * Scope terbatas -- aplikasi cuma bisa akses file/folder yang dibuat
     * lewat aplikasi ini sendiri (bukan seluruh Drive akun tersebut).
     */
    public const SCOPE = 'https://www.googleapis.com/auth/drive.file';

    /**
     * Apakah penyimpanan Google Drive siap dipakai (kredensial OAuth Client
     * sudah ada di .env DAN sudah pernah dihubungkan lewat halaman admin).
     */
    public function configured(): bool
    {
        return (bool) config('services.google.client_id')
            && (bool) config('services.google.client_secret')
            && DriveSetting::current()->terhubung();
    }

    /**
     * Tukar refresh token dengan access token yang masih berlaku.
     * Di-cache karena access token Google berlaku ~1 jam.
     */
    private function accessToken(): ?string
    {
        return Cache::remember('google_drive_access_token', 3000, function () {

            $refreshToken = DriveSetting::current()->refresh_token;

            if (! $refreshToken) {
                return null;
            }

            $response = Http::asForm()->post(
                'https://oauth2.googleapis.com/token',
                [
                    'client_id' => config('services.google.client_id'),
                    'client_secret' => config('services.google.client_secret'),
                    'refresh_token' => $refreshToken,
                    'grant_type' => 'refresh_token',
                ]
            );

            if (! $response->successful()) {
                return null;
            }

            return $response->json('access_token');
        });
    }

    /**
     * Upload 1 file (dari isi biner mentah) ke folder Drive yang tersimpan
     * di pengaturan. Mengembalikan file ID Google Drive, atau null kalau
     * gagal/belum dikonfigurasi.
     */
    public function upload(string $isiFile, string $namaFile, string $mimeType): ?string
    {
        if (! $this->configured()) {
            return null;
        }

        $accessToken = $this->accessToken();

        if (! $accessToken) {
            return null;
        }

        $folderId = DriveSetting::current()->folder_id;

        $metadata = json_encode([
            'name' => $namaFile,
            'parents' => [$folderId],
        ]);

        $response = Http::withToken($accessToken)
            ->attach('metadata', $metadata, 'metadata.json', ['Content-Type' => 'application/json; charset=UTF-8'])
            ->attach('file', $isiFile, $namaFile, ['Content-Type' => $mimeType])
            ->post('https://www.googleapis.com/upload/drive/v3/files?uploadType=multipart&fields=id');

        if (! $response->successful()) {
            return null;
        }

        $fileId = $response->json('id');

        if (! $fileId) {
            return null;
        }

        return $fileId;
    }

    /**
     * Unduh isi file dari Drive. File tetap privat; aplikasi yang
     * menyajikannya ke pengguna yang sudah login (lihat AbsensiFotoController).
     *
     * @return array{0: string, 1: string}|null [isi biner, mime type]
     */
    public function download(string $fileId): ?array
    {
        $accessToken = $this->configured() ? $this->accessToken() : null;

        if (! $accessToken) {
            return null;
        }

        $response = Http::withToken($accessToken)
            ->get('https://www.googleapis.com/drive/v3/files/' . $fileId . '?alt=media');

        if (! $response->successful()) {
            return null;
        }

        return [
            $response->body(),
            $response->header('Content-Type') ?: 'image/jpeg',
        ];
    }

    /**
     * Cabut izin "siapa saja dengan link" dari 1 file. Mengembalikan
     * true kalau file kini privat (termasuk kalau memang sudah privat).
     */
    public function cabutAksesPublik(string $fileId): bool
    {
        $accessToken = $this->configured() ? $this->accessToken() : null;

        if (! $accessToken) {
            return false;
        }

        $list = Http::withToken($accessToken)->get(
            'https://www.googleapis.com/drive/v3/files/' . $fileId . '/permissions',
            ['fields' => 'permissions(id,type)']
        );

        if (! $list->successful()) {
            return false;
        }

        foreach ($list->json('permissions', []) as $izin) {

            if (($izin['type'] ?? null) === 'anyone') {

                $hapus = Http::withToken($accessToken)->delete(
                    'https://www.googleapis.com/drive/v3/files/' . $fileId
                    . '/permissions/' . $izin['id']
                );

                if (! $hapus->successful()) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Hapus 1 file dari Drive. Best-effort -- kegagalan tidak melempar
     * exception supaya tidak menggagalkan operasi utama pemanggilnya.
     */
    public function delete(?string $fileId): void
    {
        if (! $fileId || ! $this->configured()) {
            return;
        }

        $accessToken = $this->accessToken();

        if (! $accessToken) {
            return;
        }

        try {
            Http::withToken($accessToken)
                ->delete('https://www.googleapis.com/drive/v3/files/' . $fileId);
        } catch (\Throwable $e) {
            // best effort -- abaikan
        }
    }

    /**
     * Buat folder baru di Drive akun yang terhubung. Dipakai sekali saat
     * proses "Hubungkan Google Drive" (lihat GoogleDriveController).
     */
    public function buatFolder(string $accessToken, string $nama): ?array
    {
        $response = Http::withToken($accessToken)->post(
            'https://www.googleapis.com/drive/v3/files?fields=id,webViewLink',
            [
                'name' => $nama,
                'mimeType' => 'application/vnd.google-apps.folder',
            ]
        );

        if (! $response->successful()) {
            return null;
        }

        return $response->json();
    }

    /**
     * URL untuk memulai alur otorisasi OAuth (langkah 1 dari proses
     * "Hubungkan Google Drive").
     */
    public function authorizationUrl(string $redirectUri, string $state): string
    {
        $params = [
            'client_id' => config('services.google.client_id'),
            'redirect_uri' => $redirectUri,
            'response_type' => 'code',
            'access_type' => 'offline',
            'prompt' => 'consent',
            'scope' => self::SCOPE,
            'state' => $state,
        ];

        return 'https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query($params);
    }

    /**
     * Tukar authorization code (dari callback OAuth) dengan access token +
     * refresh token (langkah 2).
     */
    public function exchangeCode(string $code, string $redirectUri): ?array
    {
        $response = Http::asForm()->post(
            'https://oauth2.googleapis.com/token',
            [
                'client_id' => config('services.google.client_id'),
                'client_secret' => config('services.google.client_secret'),
                'code' => $code,
                'redirect_uri' => $redirectUri,
                'grant_type' => 'authorization_code',
            ]
        );

        if (! $response->successful()) {
            return null;
        }

        return $response->json();
    }
}
