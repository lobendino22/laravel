<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureClient
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check()) {
            if ($request->route()->getName() === 'hoop.checkout') {
                session()->put('checkout_url', $request->fullUrl());
            }

            return redirect()->route('hoop.login')
                ->with('error', 'Please log in to continue.');
        }

        // Admins are not allowed inside the customer-only area.
        if (auth()->user()->role === 'admin') {
            return redirect()->route('hoop.admin.dashboard')
                ->with('error', 'Admin accounts cannot access customer pages.');
        }

        return $next($request);
    }
}
