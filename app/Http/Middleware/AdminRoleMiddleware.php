<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminRoleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (auth()->check()) {
            // Check if the user has the admin role
            if (auth()->user()->roles->contains('name', 'admin')) {
                return $next($request);
            
            }
        }

        // If not an admin, redirect or deny access as needed
        return redirect('/')->with('error', 'You do not have permission to access this page.');
    }
}
