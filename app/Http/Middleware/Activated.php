<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Activated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user authenticate
        if (auth()->check()) {
            // Check if user is activated
            $user = $request->user();

            if ($user && $user->is_active == 0) {
                // Logout user if not activated
                auth()->logout();
                return redirect()->route('login')->withErrors(['Your account is disabled.']);
            }
        }

        return $next($request);
    }
}
