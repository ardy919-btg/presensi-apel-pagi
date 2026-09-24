<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Saran Nama/NIP pegawai untuk autocomplete di form login.
     *
     * Sengaja dibatasi maksimal 3 hasil dan hanya pegawai aktif --
     * form login diakses publik (belum login), jadi endpoint ini juga
     * publik. Query minimal 2 karakter untuk mengurangi kemungkinan
     * enumerasi data pegawai secara massal.
     */
    public function suggestions(Request $request): JsonResponse
    {
        $q = trim((string) $request->query('q', ''));

        if (mb_strlen($q) < 2) {
            return response()->json([]);
        }

        $pegawai = User::where('role', 'pegawai')
            ->where('status', 'aktif')
            ->where(function ($query) use ($q) {

                $query->where('name', 'like', '%' . $q . '%')
                    ->orWhere('nip', 'like', '%' . $q . '%');
            })
            ->orderBy('name')
            ->limit(3)
            ->get(['name', 'nip']);

        return response()->json($pegawai);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->intended(
                route('admin.dashboard')
            );
        }

        return redirect()->intended(
            route('pegawai.absensi.index')
        );
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}