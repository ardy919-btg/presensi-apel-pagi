<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Halaman Profile
    |--------------------------------------------------------------------------
    */

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Update Profile
    |--------------------------------------------------------------------------
    */

    public function update(
        ProfileUpdateRequest $request
    ): RedirectResponse {

        $user = $request->user();


        /*
        |--------------------------------------------------------------------------
        | Sesi Masuk Tanpa Password Tidak Boleh Mengubah Profil
        |--------------------------------------------------------------------------
        |
        | Sesi ini cuma bermodal NIP/nama. Kalau boleh mengubah email, orang
        | lain bisa mengganti email pegawai dengan akun Google miliknya lalu
        | masuk sebagai pegawai itu di hari lain lewat Login Google.
        |
        */

        if ($request->session()->get('login_tanpa_password')) {
            return Redirect::route('profile.edit')->with(
                'warning',
                'Untuk mengubah profil, silakan logout lalu login memakai password.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Update Data Yang Sudah Divalidasi
        |--------------------------------------------------------------------------
        */

        $user->fill(
            $request->validated()
        );


        /*
        |--------------------------------------------------------------------------
        | Reset Verifikasi Email Jika Email Admin Berubah
        |--------------------------------------------------------------------------
        */

        if (
            $user->role === 'admin' &&
            $user->isDirty('email')
        ) {

            $user->email_verified_at = null;
        }


        /*
        |--------------------------------------------------------------------------
        | Simpan
        |--------------------------------------------------------------------------
        */

        $user->save();


        return Redirect::route(
            'profile.edit'
        )->with(
            'status',
            'profile-updated'
        );
    }
}