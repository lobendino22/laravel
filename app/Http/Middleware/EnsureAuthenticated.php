<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAuthenticated
{
    /**
     * Require a login for shared account pages (e.g. profile) that both
     * clients and admins may use.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check()) {
            return redirect()->route('hoop.login')
                ->with('error', 'Please log in to continue.');
        }

        return $next($request);
    }
}
