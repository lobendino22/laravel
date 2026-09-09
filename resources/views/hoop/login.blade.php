@extends('layouts.app')
@section('content')
<style>
    .login-container { max-width: 440px; margin: 0 auto; padding: 48px 20px 40px; }
    .login-brand { text-align: center; margin-bottom: 30px; }
    .login-brand img { height: 52px; width: auto; margin-bottom: 10px; }
    .login-brand h1 { font-weight: 800; letter-spacing: 3px; color: #1c2024; margin: 12px 0 4px; font-size: 2.25rem; }
    .login-brand p { color: #6b7280; font-size: 1rem; margin: 0; }
    .login-card { border: none; border-radius: 16px; background: #ffffff; overflow: hidden; box-shadow: 0 12px 40px rgba(0,0,0,0.12); }
    .login-card-body { padding: 36px 32px; }
    .login-label { font-size: 0.85rem; font-weight: 600; color: #1c2024; margin-bottom: 6px; display: block; }
    .login-input { width: 100%; padding: 13px 15px; border: 1px solid #e9ecef; border-radius: 8px; font-size: 1rem; transition: border-color 0.2s, box-shadow 0.2s; background: #f8f9fa; }
    .login-input:focus { outline: none; border-color: #1ab394; box-shadow: 0 0 0 3px rgba(26,179,148,0.18); background: #fff; }
    .login-btn { width: 100%; padding: 13px; border: none; background: linear-gradient(135deg, #1ab394, #17987e); color: #fff; border-radius: 8px; font-weight: 700; font-size: 1rem; letter-spacing: 0.5px; transition: transform 0.2s, box-shadow 0.2s; cursor: pointer; }
    .login-btn:hover { background: linear-gradient(135deg, #17987e, #14856d); transform: translateY(-2px); box-shadow: 0 8px 20px rgba(26,179,148,0.4); color: #fff; }
    .login-btn:active { transform: translateY(0); }
    .login-footer { text-align: center; margin-top: 28px; }
    .login-footer p { color: #6b7280; font-size: 0.95rem; margin-bottom: 0; }
    .login-footer a { color: #1ab394; font-weight: 600; text-decoration: none; }
    .login-footer a:hover { text-decoration: underline; }
    .login-error { background: #fdecea; border: 1px solid #f5c6cb; color: #b02a37; border-radius: 8px; padding: 10px 14px; font-size: 0.88rem; margin-bottom: 18px; }
</style>

<div class="login-container">
    <div class="login-brand">
        <img src="{{ asset('img/hoopzone.png') }}" alt="HoopZone">
        <h1>HOOP ZONE</h1>
        <p>Welcome back</p>
    </div>

    @if($errors->any())
        <div class="login-error">
            {{ $errors->first('email') ?? $errors->first() }}
        </div>
    @endif

    <div class="login-card">
        <div class="login-card-body">
            <form method="POST" action="{{ route('hoop.login.submit') }}">
                @csrf
                <div class="mb-3">
                    <label class="login-label" for="email">Email</label>
                    <input type="email" name="email" id="email" class="login-input" value="{{ old('email') }}"
                           placeholder="you@example.com" required autofocus>
                </div>
                <div class="mb-3">
                    <label class="login-label" for="password">Password</label>
                    <input type="password" name="password" id="password" class="login-input"
                           placeholder="Enter your password" required>
                </div>
                <div class="form-check mb-4">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input" style="width:auto; accent-color: #1ab394;">
                    <label class="form-check-label" for="remember" style="font-size:0.9rem; color:#6b7280;">Remember me</label>
                </div>
                <button type="submit" class="login-btn">Sign In</button>
            </form>
        </div>
    </div>

    <div class="login-footer">
        <p>Don't have an account? <a href="{{ route('hoop.register') }}">Create one</a></p>
    </div>
</div>
@endsection