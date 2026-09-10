@extends('layouts.app')
@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .login-container { max-width: 440px; margin: 0 auto; padding: 48px 20px 60px; }
    .login-brand { text-align: center; margin-bottom: 30px; }
    .login-brand img { height: 46px; width: auto; margin-bottom: 8px; }
    .login-brand h1 {
        font-family: 'Barlow Condensed', sans-serif;
        font-weight: 800; letter-spacing: 2px; color: #f2ede3 !important;
        margin: 10px 0 2px; font-size: 2.25rem;
    }
    .login-brand p { color: #9a9186 !important; font-size: 1rem; margin: 0; }
    .login-card { background: #26231f; border: 1px solid #3a352e; border-radius: 12px; overflow: hidden; box-shadow: 0 12px 40px rgba(0,0,0,0.45); }
    .login-card-body { padding: 36px 32px; }
    .login-label { font-size: 0.85rem; font-weight: 600; color: #d8d0c2 !important; margin-bottom: 6px; display: block; }
    .login-input { width: 100%; padding: 13px 15px; border: 1px solid #3a352e; border-radius: 8px; font-size: 1rem; transition: border-color 0.2s, box-shadow 0.2s; background: #1c1a17; color: #f2ede3; }
    .login-input:focus { outline: none; border-color: #e2611d; box-shadow: 0 0 0 3px rgba(226,97,29,0.18); }
    .login-input::placeholder { color: #6d655a; opacity: 1; }
    .login-btn { width: 100%; padding: 13px; border: none; background: #e2611d; color: #fff; border-radius: 8px; font-weight: 700; font-size: 1rem; letter-spacing: 0.5px; transition: transform 0.2s, background 0.2s; cursor: pointer; }
    .login-btn:hover { background: #c8530f; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(226,97,29,0.35); color: #fff; }
    .login-btn:active { transform: translateY(0); }
    .login-footer { text-align: center; margin-top: 28px; }
    .login-footer p { color: #9a9186 !important; font-size: 0.95rem; margin-bottom: 0; }
    .login-footer a { color: #e2611d; font-weight: 600; text-decoration: none; }
    .login-footer a:hover { text-decoration: underline; color: #c8530f; }
    .login-error { background: rgba(201,106,84,0.12); border: 1px solid rgba(201,106,84,0.4); color: #e8b4a6; border-radius: 8px; padding: 10px 14px; font-size: 0.88rem; margin-bottom: 18px; }
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
                    <input type="checkbox" name="remember" id="remember" class="form-check-input" style="width:auto; accent-color: #e2611d;">
                    <label class="form-check-label" for="remember" style="font-size:0.9rem; color:#9a9186;">Remember me</label>
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