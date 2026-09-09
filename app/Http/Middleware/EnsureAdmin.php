<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Guests must log in first (admin and client share the same login page).
        if (! auth()->check()) {
            return redirect()->route('hoop.login')
                ->with('error', 'Please log in to continue.');
        }

        // Only the admin role may enter the admin area.
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('hoop-shop')
                ->with('error', 'You do not have permission to access the admin area.');
        }

        return $next($request);
    }
}
