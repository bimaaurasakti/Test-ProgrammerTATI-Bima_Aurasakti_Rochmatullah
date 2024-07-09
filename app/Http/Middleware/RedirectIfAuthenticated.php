<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Jika pengguna sudah diotentikasi, periksa apakah pengguna aktif atau tidak
                $user = $request->user();

                if ($user && $user->is_active == 0) {
                    // Jika pengguna tidak aktif, logout pengguna dan kembalikan ke halaman login
                    Auth::logout();
                    return redirect()->route('login')->with('error', 'Your account is not active.');
                }
                
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
