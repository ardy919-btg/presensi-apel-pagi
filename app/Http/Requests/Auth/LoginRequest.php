<?php

namespace App\Http\Requests\Auth;

use App\Helpers\AttendanceTime;
use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login' => [
                'required',
                'string',
            ],

            'password' => [
                AttendanceTime::loginTanpaPasswordHariIni() ? 'nullable' : 'required',
                'string',
            ],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        /*
        |--------------------------------------------------------------------------
        | Tentukan Login Menggunakan Email atau NIP
        |--------------------------------------------------------------------------
        */

        $login = trim($this->string('login')->toString());

        $field = filter_var(
            $login,
            FILTER_VALIDATE_EMAIL
        )
            ? 'email'
            : 'nip';


        /*
        |--------------------------------------------------------------------------
        | Proses Login
        |--------------------------------------------------------------------------
        */

        $credentials = [
            $field => $login,
            'password' => $this->input('password'),
        ];


        $berhasil = filled($this->input('password')) && Auth::attempt(
            $credentials,
            $this->boolean('remember')
        );

        $this->session()->forget('login_tanpa_password');


        /*
        |--------------------------------------------------------------------------
        | Login Pegawai Tanpa Password (Khusus Hari Senin)
        |--------------------------------------------------------------------------
        |
        | Kalau admin mematikan "Hari Senin Pegawai Wajib Input Password",
        | pegawai aktif cukup dikenali lewat NIP/email/nama; password yang
        | salah (mis. terisi otomatis dari situs lain) diabaikan. Admin
        | tidak pernah lewat jalur ini.
        |
        */

        if (! $berhasil && AttendanceTime::loginTanpaPasswordHariIni()) {

            $pegawai = $this->cariPegawaiAktif($login);

            if ($pegawai) {

                Auth::login(
                    $pegawai,
                    $this->boolean('remember')
                );

                $this->session()->put('login_tanpa_password', true);

                $berhasil = true;
            }
        }


        if (! $berhasil) {

            RateLimiter::hit(
                $this->throttleKey()
            );

            throw ValidationException::withMessages([
                'login' => 'Email/NIP atau password salah.',
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Cek Status Akun
        |--------------------------------------------------------------------------
        */

        if (Auth::user()->status !== 'aktif') {

            Auth::logout();

            throw ValidationException::withMessages([
                'login' => 'Akun Anda sedang nonaktif.',
            ]);
        }


        RateLimiter::clear(
            $this->throttleKey()
        );
    }

    /**
     * Cari pegawai aktif dari NIP, email, atau nama persis (nama hanya
     * dipakai kalau tepat satu pegawai aktif yang memakai nama itu).
     */
    private function cariPegawaiAktif(string $login): ?User
    {
        $query = fn () => User::where('role', 'pegawai')
            ->where('status', 'aktif');

        $pegawai = $query()
            ->where(function ($q) use ($login) {
                $q->where('nip', $login)
                    ->orWhere('email', $login);
            })
            ->first();

        if ($pegawai) {
            return $pegawai;
        }

        $samaNama = $query()
            ->where('name', $login)
            ->limit(2)
            ->get();

        return $samaNama->count() === 1
            ? $samaNama->first()
            : null;
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts(
            $this->throttleKey(),
            5
        )) {
            return;
        }

        event(
            new Lockout($this)
        );

        $seconds = RateLimiter::availableIn(
            $this->throttleKey()
        );

        throw ValidationException::withMessages([
            'login' => trans(
                'auth.throttle',
                [
                    'seconds' => $seconds,
                    'minutes' => ceil($seconds / 60),
                ]
            ),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(
            Str::lower(
                $this->string('login')->toString()
            )
            . '|'
            . $this->ip()
        );
    }
}