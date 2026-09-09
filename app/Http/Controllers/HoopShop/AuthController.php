<?php

namespace App\Http\Controllers\HoopShop;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Client login form
    public function showLogin()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('hoop.admin.dashboard');
            }
            return redirect()->route('hoop-shop');
        }
        return view('hoop.login');
    }

    // Process client login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Redirect based on user role
            if (Auth::user()->role === 'admin') {
                return redirect()->route('hoop.admin.dashboard')->with('success', 'Welcome back, Admin!');
            }

            if (session()->has('checkout_url')) {
                $url = session()->pull('checkout_url');
                return redirect()->to($url);
            }

            return redirect()->route('hoop-shop')->with('success', 'Welcome back, ' . Auth::user()->name . '!');
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }

    // Client register form
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('hoop-shop');
        }
        return view('hoop.register');
    }

    // Process client register
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => 'client',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        if (session()->has('checkout_url')) {
            $url = session()->pull('checkout_url');
            return redirect()->to($url);
        }

        return redirect()->route('hoop-shop')->with('success', 'Account created! Welcome to Hoop Shop.');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        
        // Preserve the cart in session before regenerating
        $cart = session()->get('cart', []);
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Restore the cart after session regeneration
        if (!empty($cart)) {
            session()->put('cart', $cart);
        }

        return redirect()->route('hoop-shop');
    }

    // Edit profile form
    public function editProfile()
    {
        return view('hoop.edit-profile', ['user' => Auth::user()]);
    }

    // Update profile
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->update($data);

        return redirect()->route('hoop.profile')->with('success', 'Profile updated successfully!');
    }

    // Update password
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if (!Hash::check($data['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update([
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('hoop.profile')->with('success', 'Password updated successfully!');
    }
}
