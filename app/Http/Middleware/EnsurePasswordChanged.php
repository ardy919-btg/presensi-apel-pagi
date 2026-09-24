<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePasswordChanged
{
    /**
     * Paksa pengguna yang masih memakai password default untuk
     * menggantinya dulu sebelum memakai fitur lain.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (
            $user &&
            $user->must_change_password &&
            ! $request->routeIs('profile.*', 'password.update', 'logout')
        ) {

            return redirect()
                ->route('profile.edit')
                ->with(
                    'warning',
                    'Demi keamanan, silakan ganti password Anda terlebih dahulu.'
                );
        }

        return $next($request);
    }
}
