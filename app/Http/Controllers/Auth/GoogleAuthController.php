<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class GoogleAuthController extends Controller
{
    /**
     * Proses login menggunakan Google Identity Services.
     *
     * Frontend mengirim ID token (credential) dari tombol "Sign in with
     * Google". Token itu diverifikasi ke server Google (bukan dipercaya
     * begitu saja dari browser) sebelum dipakai untuk mencocokkan akun.
     */
    public function callback(Request $request): RedirectResponse
    {
        $clientId = config('services.google.client_id');

        if (! $clientId) {
            return redirect()
                ->route('login')
                ->withErrors([
                    'login' => 'Login dengan Google belum diaktifkan di server.',
                ]);
        }

        $request->validate([
            'credential' => ['required', 'string'],
        ]);

        $response = Http::get(
            'https://oauth2.googleapis.com/tokeninfo',
            ['id_token' => $request->input('credential')]
        );

        if (! $response->successful()) {
            return redirect()
                ->route('login')
                ->withErrors([
                    'login' => 'Verifikasi akun Google gagal. Silakan coba lagi.',
                ]);
        }

        $payload = $response->json();

        /*
        |--------------------------------------------------------------------------
        | Pastikan Token Benar-Benar Untuk Aplikasi Ini
        |--------------------------------------------------------------------------
        */

        $emailVerified = filter_var(
            $payload['email_verified'] ?? false,
            FILTER_VALIDATE_BOOLEAN
        );

        if (
            ($payload['aud'] ?? null) !== $clientId ||
            ! $emailVerified ||
            empty($payload['email'])
        ) {
            return redirect()
                ->route('login')
                ->withErrors([
                    'login' => 'Verifikasi akun Google gagal. Silakan coba lagi.',
                ]);
        }

        $email = strtolower($payload['email']);


        /*
        |--------------------------------------------------------------------------
        | Cocokkan Ke Akun Yang Sudah Ada (Berdasarkan Email)
        |--------------------------------------------------------------------------
        */

        $user = User::where('email', $email)->first();

        if (! $user) {
            return redirect()
                ->route('login')
                ->withErrors([
                    'login' => 'Akun Google (' . $email . ') belum terhubung ke akun manapun di sistem ini. '
                        . 'Silakan login manual menggunakan NIP/password terlebih dahulu, lalu lengkapi '
                        . 'alamat email Google Anda di halaman Profil.',
                ]);
        }

        if ($user->status !== 'aktif') {
            return redirect()
                ->route('login')
                ->withErrors([
                    'login' => 'Akun Anda sedang nonaktif.',
                ]);
        }

        Auth::login($user, true);

        $request->session()->regenerate();

        return redirect()->intended(
            $user->role === 'admin'
                ? route('admin.dashboard')
                : route('pegawai.absensi.index')
        );
    }
}
