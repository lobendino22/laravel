<?php

namespace App\Http\Controllers\HoopShop\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Admin login form
    public function showLogin()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('hoop.admin.dashboard');
        }
        return view('hoop.admin.login');
    }

    // Process admin login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user && $user->role !== 'admin') {
            return back()->withErrors(['email' => 'This account is not an admin account.']);
        }

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('hoop.admin.dashboard')->with('success', 'Welcome back, Admin!');
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }

    // Logout admin
    public function logout(Request $request)
    {
        Auth::logout();

        // Preserve any client session data (e.g. cart) before fully invalidating
        $cart = $request->session()->get('cart', []);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if (!empty($cart)) {
            session()->put('cart', $cart);
        }

        return redirect()->route('hoop.login');
    }
}
