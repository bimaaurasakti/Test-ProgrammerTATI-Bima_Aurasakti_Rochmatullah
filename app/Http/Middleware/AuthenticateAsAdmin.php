<?php

namespace App\Http\Middleware;

use App\Dictionaries\Users\UserTypeDictionary;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateAsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (auth()->check()) {
            // Check if user is admin
            $user = $request->user();

            if ($user && !in_array($user->user_type, UserTypeDictionary::GROUP_USER_TYPE_ADMIN)) {
                // Logout user if not admin and redirect to login with error message
                auth()->logout();
                return redirect()->route('login')->withErrors(['Unauthorized access.']);
            }
        }

        return $next($request);
    }
}
