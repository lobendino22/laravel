@extends('layouts.app')
@section('content')
<style>
    body.profile-page { background: #f0f4f5; }
    .profile-container { max-width: 720px; margin: 0 auto; padding: 40px 24px; }
    .profile-header { text-align: center; margin-bottom: 28px; }
    .profile-header img { height: 50px; width: auto; margin-bottom: 8px; }
    .profile-header h1 { font-weight: 800; letter-spacing: 3px; color: #1ab394; margin: 12px 0 4px; font-size: 2rem; }
    .profile-header p { color: #6b7280; font-size: 1rem; margin: 0; }
    .profile-card { background: #fff; border: none; border-radius: 16px; padding: 28px; box-shadow: 0 10px 40px rgba(0,0,0,0.08); margin-bottom: 20px; }
    .profile-card-title { font-size: 1.1rem; font-weight: 700; margin-bottom: 22px; padding-bottom: 12px; border-bottom: 2px solid #e5e7eb; display: flex; align-items: center; gap: 10px; }
    .profile-card-title i { color: #1ab394; font-size: 1.2rem; }
    .profile-form .form-group { margin-bottom: 18px; }
    .profile-form label { display: block; font-size: 0.9rem; font-weight: 600; color: #1c2024; margin-bottom: 8px; }
    .profile-form label .required { color: #e94560; }
    .profile-form input { width: 100%; padding: 13px 15px; border: 1px solid #e5e7eb; border-radius: 10px; font-size: 1rem; transition: all 0.2s; background: #f8f9fa; }
    .profile-form input:focus { outline: none; border-color: #1ab394; box-shadow: 0 0 0 3px rgba(26,179,148,0.1); background: #fff; }
    .profile-form .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .profile-actions { display: flex; gap: 12px; margin-top: 26px; padding-top: 22px; border-top: 2px solid #e5e7eb; }
    .profile-btn { padding: 14px 28px; border-radius: 10px; font-weight: 600; font-size: 1rem; cursor: pointer; transition: all 0.2s; border: none; text-decoration: none; text-align: center; display: inline-flex; align-items: center; justify-content: center; gap: 8px; }
    .profile-btn.save { background: linear-gradient(135deg, #1ab394, #17987e); color: #fff; flex: 1; }
    .profile-btn.save:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(26,179,148,0.4); color: #fff; }
    .profile-btn.cancel { background: #f3f4f6; color: #6b7280; }
    .profile-btn.cancel:hover { background: #e5e7eb; color: #1c2024; }
    .profile-message { padding: 14px 18px; border-radius: 10px; margin-bottom: 20px; font-size: 0.95rem; }
    .profile-message.success { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
    .profile-message.error { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
    .profile-back { display: inline-flex; align-items: center; gap: 8px; color: #6b7280; text-decoration: none; font-size: 0.95rem; margin-bottom: 22px; transition: all 0.2s; }
    .profile-back:hover { color: #1ab394; transform: translateX(-3px); }
    .profile-back i { font-size: 1rem; }
    .password-toggle { position: relative; }
    .password-toggle input { padding-right: 48px; }
    .password-toggle .toggle-btn {
        position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
        background: none; border: none; cursor: pointer; color: #6b7280; padding: 4px;
        display: inline-flex; align-items: center; justify-content: center;
    }
    .password-toggle .toggle-btn:hover { color: #1c2024; }
</style>

<body class="profile-page">
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
                    <span style="color: #e94560; font-size: 0.8rem; margin-top: 4px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email Address <span class="required">*</span></label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <span style="color: #e94560; font-size: 0.8rem; margin-top: 4px; display: block;">{{ $message }}</span>
                @enderror
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
                    <span style="color: #e94560; font-size: 0.8rem; margin-top: 4px; display: block;">{{ $message }}</span>
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
                        <span style="color: #e94560; font-size: 0.8rem; margin-top: 4px; display: block;">{{ $message }}</span>
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
                        <span style="color: #e94560; font-size: 0.8rem; margin-top: 4px; display: block;">{{ $message }}</span>
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
    }
</script>
</body>
@endsection
