<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     if(!Auth::guard('admin')->check()){
    //         return redirect()->route('admin.login');
    //     }
    //     return $next($request);
    // }
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is not authenticated as an admin
        if (!Auth::guard('admin')->check()) {
            // Redirect to the admin login page if unauthenticated
            return redirect()->route('admin.login');
        }

        // Allow the request to proceed if authenticated
        return $next($request);
    }

}
