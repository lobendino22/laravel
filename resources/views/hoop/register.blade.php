@extends('layouts.app')
@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .register-page {
        font-family: 'Inter', system-ui, sans-serif;
        color: #f2ede3;
        background: #1c1a17;
        min-height: 100vh;
    }
    .register-container { max-width: 420px; margin: 0 auto; padding: 40px 20px 60px; }
    .register-brand { text-align: center; margin-bottom: 30px; }
    .register-brand img { height: 46px; width: auto; margin-bottom: 8px; }
    .register-brand h1 {
        font-family: 'Barlow Condensed', sans-serif;
        font-weight: 800; letter-spacing: 2px; color: #f2ede3 !important;
        margin: 10px 0 2px; font-size: 2.25rem;
    }
    .register-brand p { color: #9a9186 !important; font-size: 1rem; margin: 0; }
    .register-card { background: #26231f; border: 1px solid #3a352e; border-radius: 12px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.5); }
    .register-card-body { padding: 36px; }
    .register-label { font-size: 0.85rem; font-weight: 600; color: #d8d0c2 !important; margin-bottom: 6px; display: block; }
    .register-input { width: 100%; padding: 14px 16px; border: 1px solid #3a352e; border-radius: 8px; font-size: 1rem; transition: border-color 0.2s, box-shadow 0.2s; background: #1c1a17; color: #f2ede3; }
    .register-input:focus { outline: none; border-color: #e2611d; box-shadow: 0 0 0 3px rgba(226,97,29,0.15); }
    .register-input::placeholder { color: #6d655a; opacity: 1; }
    .register-btn { width: 100%; padding: 14px; border: none; background: #e2611d; color: #fff; border-radius: 8px; font-weight: 700; font-size: 1rem; letter-spacing: 0.5px; transition: transform 0.2s, background 0.2s; cursor: pointer; margin-top: 8px; }
    .register-btn:hover { background: #c8530f; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(226,97,29,0.35); color: #fff; }
    .register-btn:active { transform: translateY(0); }
    .register-error { background: rgba(201,106,84,0.12); border: 1px solid rgba(201,106,84,0.4); color: #e8b4a6; border-radius: 8px; padding: 10px 14px; font-size: 0.88rem; margin-bottom: 18px; }
    .register-footer { text-align: center; margin-top: 28px; padding: 0 20px; }
    .register-footer a { color: #e2611d; font-weight: 600; text-decoration: none; }
    .register-footer a:hover { text-decoration: underline; color: #c8530f; }
</style>

<div class="register-page">
    <div class="register-container">
        <div class="register-brand">
            <img src="{{ asset('img/hoopzone.png') }}" alt="HoopZone">
            <h1>HOOP ZONE</h1>
            <p>Create your account</p>
        </div>

        @if($errors->any())
            <div class="register-error">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="register-card">
            <div class="register-card-body">
                <form method="POST" action="{{ route('hoop.register.submit') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="register-label" for="name">Full Name</label>
                        <input type="text" name="name" id="name" class="register-input" value="{{ old('name') }}"
                               placeholder="Juan Dela Cruz" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label class="register-label" for="email">Email</label>
                        <input type="email" name="email" id="email" class="register-input" value="{{ old('email') }}"
                               placeholder="you@example.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="register-label" for="password">Password</label>
                        <input type="password" name="password" id="password" class="register-input"
                               placeholder="At least 6 characters" required>
                    </div>
                    <div class="mb-4">
                        <label class="register-label" for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="register-input"
                               placeholder="Repeat password" required>
                    </div>
                    <button type="submit" class="register-btn">Create Account</button>
                </form>
            </div>
        </div>

        <div class="register-footer">
            <p style="color:#9a9186; font-size:0.95rem; margin-bottom: 0;">
                Already have an account? <a href="{{ route('hoop.login') }}">Sign in</a>
            </p>
        </div>
    </div>
</div>
@endsection