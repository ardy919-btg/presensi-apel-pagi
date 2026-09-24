<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Services\GoogleDriveService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AbsensiFotoController extends Controller
{
    /**
     * Sajikan foto selfie hanya untuk pengguna yang login: admin boleh
     * melihat semua, pegawai hanya foto miliknya sendiri.
     */
    public function show(Absensi $absensi, GoogleDriveService $drive): Response|StreamedResponse
    {
        $user = auth()->user();

        abort_unless(
            $user->role === 'admin' || $absensi->user_id === $user->id,
            403
        );

        abort_unless($absensi->foto_masuk, 404);

        $header = [
            'Cache-Control' => 'private, max-age=86400',
        ];

        if ($absensi->foto_masuk_storage === 'drive') {

            $file = $drive->download($absensi->foto_masuk);

            abort_unless($file, 404);

            return response($file[0], 200, $header + ['Content-Type' => $file[1]]);
        }

        abort_unless(Storage::disk('public')->exists($absensi->foto_masuk), 404);

        return Storage::disk('public')->response($absensi->foto_masuk, null, $header);
    }
}
