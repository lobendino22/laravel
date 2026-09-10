@extends('layouts.app')
@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .profile-page {
        font-family: 'Inter', system-ui, sans-serif;
        color: #f2ede3;
        background: #1c1a17;
        min-height: 100vh;
    }
    .profile-container { max-width: 720px; margin: 0 auto; padding: 40px 24px 60px; }
    .profile-header { text-align: center; margin-bottom: 28px; }
    .profile-header img { height: 46px; width: auto; margin-bottom: 8px; }
    .profile-header h1 {
        font-family: 'Barlow Condensed', sans-serif;
        font-weight: 800; letter-spacing: 2px; color: #f2ede3 !important;
        margin: 10px 0 2px; font-size: 2rem;
    }
    .profile-header p { color: #9a9186 !important; font-size: 1rem; margin: 0; }
    .profile-card { background: #26231f; border: 1px solid #3a352e; border-radius: 12px; padding: 28px; box-shadow: 0 10px 40px rgba(0,0,0,0.35); margin-bottom: 20px; }
    .profile-card-title {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 1.15rem; font-weight: 700; color: #f2ede3 !important;
        margin-bottom: 22px; padding-bottom: 12px; border-bottom: 1px solid #3a352e;
        display: flex; align-items: center; gap: 10px;
    }
    .profile-card-title i { color: #e2611d; font-size: 1.2rem; }
    .profile-form .form-group { margin-bottom: 18px; }
    .profile-form label { display: block; font-size: 0.9rem; font-weight: 600; color: #d8d0c2 !important; margin-bottom: 8px; }
    .profile-form label .required { color: #e2611d; }
    .profile-form input, .profile-form textarea { width: 100%; padding: 13px 15px; border: 1px solid #3a352e; border-radius: 10px; font-size: 1rem; transition: all 0.2s; background: #1c1a17; color: #f2ede3; }
    .profile-form input:focus, .profile-form textarea:focus { outline: none; border-color: #e2611d; box-shadow: 0 0 0 3px rgba(226,97,29,0.12); }
    .profile-form input::placeholder, .profile-form textarea::placeholder { color: #6d655a; opacity: 1; }
    .profile-form textarea { resize: vertical; font-family: inherit; }
    .profile-form .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .profile-actions { display: flex; gap: 12px; margin-top: 26px; padding-top: 22px; border-top: 1px solid #3a352e; }
    .profile-btn { padding: 14px 28px; border-radius: 10px; font-weight: 600; font-size: 1rem; cursor: pointer; transition: all 0.2s; border: none; text-decoration: none; text-align: center; display: inline-flex; align-items: center; justify-content: center; gap: 8px; }
    .profile-btn.save { background: #e2611d; color: #fff; flex: 1; }
    .profile-btn.save:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(226,97,29,0.35); color: #fff; }
    .profile-btn.cancel { background: transparent; border: 1px solid #3a352e; color: #9a9186; }
    .profile-btn.cancel:hover { background: #2e2a25; color: #f2ede3; }
    .profile-message { padding: 14px 18px; border-radius: 10px; margin-bottom: 20px; font-size: 0.95rem; }
    .profile-message.success { background: rgba(31,111,79,0.15); color: #8fdcc7; border: 1px solid rgba(31,111,79,0.45); }
    .profile-message.error { background: rgba(201,106,84,0.12); color: #e8b4a6; border: 1px solid rgba(201,106,84,0.4); }
    .profile-back { display: inline-flex; align-items: center; gap: 8px; color: #9a9186; text-decoration: none; font-size: 0.95rem; margin-bottom: 22px; transition: all 0.2s; }
    .profile-back:hover { color: #e2611d; transform: translateX(-3px); }
    .profile-back i { font-size: 1rem; }
    .password-toggle { position: relative; }
    .password-toggle input { padding-right: 48px; }
    .password-toggle .toggle-btn {
        position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
        background: none; border: none; cursor: pointer; color: #9a9186; padding: 4px;
        display: inline-flex; align-items: center; justify-content: center;
    }
    .password-toggle .toggle-btn:hover { color: #f2ede3; }
</style>

<div class="profile-page">
<div class="profile-container">
    <a href="{{ auth()->user()->role === 'admin' ? route('hoop.admin.dashboard') : route('hoop-shop') }}" class="profile-back">
        <i class="fa fa-arrow-left"></i>
        {{ auth()->user()->role === 'admin' ? 'Back to Admin' : 'Back to Shop' }}
    </a>

    <div class="profile-header">
        <img src="{{ asset('img/hoopzone.png') }}" alt="HoopZone">
        <h1>HOOP ZONE</h1>
        <p>Edit Profile</p>
    </div>

    @if(session('success'))
        <div class="profile-message success">
            <i class="fa fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="profile-message error">
            <i class="fa fa-exclamation-circle"></i> Please fix the errors below.
        </div>
    @endif

    <div class="profile-card">
        <h3 class="profile-card-title">
            <i class="fa fa-user"></i> Account Information
        </h3>

        <form method="POST" action="{{ route('hoop.profile.update') }}" class="profile-form">
            @csrf

            <div class="form-group">
                <label for="name">Full Name <span class="required">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <span style="color: #e8b4a6; font-size: 0.8rem; margin-top: 4px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email Address <span class="required">*</span></label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <span style="color: #e8b4a6; font-size: 0.8rem; margin-top: 4px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="phone">Cellphone Number</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" placeholder="09xx xxx xxxx">
                    @error('phone')
                        <span style="color: #e8b4a6; font-size: 0.8rem; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address">Delivery Address</label>
                    <input type="text" name="address" id="address" value="{{ old('address', $user->address) }}" placeholder="Street, Barangay, City">
                    @error('address')
                        <span style="color: #e8b4a6; font-size: 0.8rem; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="profile-actions">
                <button type="submit" class="profile-btn save">
                    <i class="fa fa-save"></i> Save Changes
                </button>
                <a href="{{ auth()->user()->role === 'admin' ? route('hoop.admin.dashboard') : route('hoop-shop') }}" class="profile-btn cancel">Cancel</a>
            </div>
        </form>
    </div>

    <div class="profile-card">
        <h3 class="profile-card-title">
            <i class="fa fa-lock"></i> Change Password
        </h3>

        <form id="passwordForm" method="POST" action="{{ route('hoop.profile.password') }}" class="profile-form">
            @csrf

            <div class="form-group">
                <label for="current_password">Current Password <span class="required">*</span></label>
                <div class="password-toggle">
                    <input type="password" name="current_password" id="current_password" required autocomplete="current-password">
                    <button type="button" class="toggle-btn" onclick="togglePassword('current_password')">
                        <i class="fa fa-eye" id="current_password_icon"></i>
                    </button>
                </div>
                @error('current_password')
                    <span style="color: #e8b4a6; font-size: 0.8rem; margin-top: 4px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password">New Password <span class="required">*</span></label>
                    <div class="password-toggle">
                        <input type="password" name="password" id="password" required autocomplete="new-password">
                        <button type="button" class="toggle-btn" onclick="togglePassword('password')">
                            <i class="fa fa-eye" id="password_icon"></i>
                        </button>
                    </div>
                    @error('password')
                        <span style="color: #e8b4a6; font-size: 0.8rem; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm New Password <span class="required">*</span></label>
                    <div class="password-toggle">
                        <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password">
                        <button type="button" class="toggle-btn" onclick="togglePassword('password_confirmation')">
                            <i class="fa fa-eye" id="password_confirmation_icon"></i>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <span style="color: #e8b4a6; font-size: 0.8rem; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="profile-actions">
                <button type="submit" class="profile-btn save">
                    <i class="fa fa-key"></i> Update Password
                </button>
                <button type="button" class="profile-btn cancel" onclick="document.getElementById('passwordForm').reset()">Clear</button>
            </div>
        </form>
    </div>
</div>

<script>
    function togglePassword(fieldId) {
        var input = document.getElementById(fieldId);
        var icon = document.getElementById(fieldId + '_icon');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }    </script>
</div>
@endsection
