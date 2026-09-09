@extends('layouts.app')
@section('content')
<style>
    body.register-page {
        background: linear-gradient(135deg, #1ab394 0%, #17987e 100%) !important;
        min-height: 100vh;
    }
    .register-container { max-width: 420px; margin: 0 auto; padding: 40px 20px; }
    .register-brand { text-align: center; margin-bottom: 30px; }
    .register-brand img { height: 50px; width: auto; margin-bottom: 10px; }
    .register-brand h1 { font-weight: 800; letter-spacing: 3px; color: #ffffff; margin: 12px 0 4px; font-size: 2.25rem; text-shadow: 0 2px 4px rgba(0,0,0,0.2); }
    .register-brand p { color: rgba(255,255,255,0.85); font-size: 1rem; margin: 0; }
    .register-card { border: none; border-radius: 16px; background: #ffffff; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.3); }
    .register-card-body { padding: 36px; }
    .register-label { font-size: 0.85rem; font-weight: 600; color: #1c2024; margin-bottom: 6px; display: block; }
    .register-input { width: 100%; padding: 14px 16px; border: 1px solid #e9ecef; border-radius: 8px; font-size: 1rem; transition: border-color 0.2s, box-shadow 0.2s; background: #f8f9fa; }
    .register-input:focus { outline: none; border-color: #1ab394; box-shadow: 0 0 0 3px rgba(26,179,148,0.15); background: #fff; }
    .register-btn { width: 100%; padding: 14px; border: none; background: linear-gradient(135deg, #1ab394, #17987e); color: #fff; border-radius: 8px; font-weight: 700; font-size: 1rem; letter-spacing: 0.5px; transition: transform 0.2s, box-shadow 0.2s; cursor: pointer; margin-top: 8px; }
    .register-btn:hover { background: linear-gradient(135deg, #17987e, #14856d); transform: translateY(-2px); box-shadow: 0 8px 20px rgba(26,179,148,0.4); color: #fff; }
    .register-btn:active { transform: translateY(0); }
    .register-footer { text-align: center; margin-top: 28px; padding: 0 20px; }
    .register-footer a { color: #1ab394; font-weight: 600; text-decoration: none; }
    .register-footer a:hover { text-decoration: underline; }
</style>

<body class="register-page">
    <div class="register-container">
        <div class="register-brand">
            <img src="{{ asset('img/hoopzone.png') }}" alt="HoopZone">
            <h1>HOOP ZONE</h1>
            <p>Create your account</p>
        </div>

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
            <p style="color:rgba(255,255,255,0.8); font-size:0.95rem; margin-bottom: 0;">
                Already have an account? <a href="{{ route('hoop.login') }}">Sign in</a>
            </p>
        </div>
    </div>
</body>
@endsection