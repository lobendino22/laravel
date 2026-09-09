@extends('layouts.app')
@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .admin-shell {
        --ink: #17130f;
        --paper: #f7f4ee;
        --line: #e3ddd0;
        --muted: #6b6459;
        --orange: #e2611d;
        --red: #b3402b;
        background: var(--paper);
        min-height: 100vh;
        font-family: 'Inter', system-ui, sans-serif;
        color: var(--ink);
    }
    .admin-header { background: var(--ink); color: #fff; padding: 22px 28px; }
    .admin-header-row { max-width: 700px; margin: 0 auto; }
    .admin-back-link {
        display: inline-flex; align-items: center; gap: 7px; text-decoration: none;
        color: rgba(255,255,255,0.55); font-size: 0.85rem; font-weight: 600; margin-bottom: 10px;
    }
    .admin-back-link:hover { color: #fff; }
    .admin-title { font-family: 'Barlow Condensed', sans-serif; font-weight: 700; font-size: 1.9rem; line-height: 1; }

    .admin-body { max-width: 700px; margin: 0 auto; padding: 28px 28px 60px; }
    .admin-card { background: #fff; border: 1px solid var(--line); border-radius: 8px; padding: 28px 30px; }

    .alert-danger {
        background: #fbeae6; border: 1px solid #f0c3b8; color: var(--red);
        border-radius: 6px; padding: 12px 16px; font-size: 0.9rem; margin-bottom: 20px;
    }

    .field { margin-bottom: 20px; }
    .field label { display: block; font-size: 0.85rem; font-weight: 600; color: var(--muted); margin-bottom: 6px; }
    .field label small { font-weight: 400; color: var(--muted); }
    .field .form-control {
        border: 1px solid var(--line); border-radius: 6px; padding: 9px 12px;
        font-size: 0.95rem; color: var(--ink); background: #fff; width: 100%;
        transition: border-color 0.15s, box-shadow 0.15s;
    }
    .field .form-control:focus {
        outline: none; border-color: var(--orange);
        box-shadow: 0 0 0 3px rgba(226,97,29,0.12);
    }

    .form-actions {
        display: flex; gap: 10px; margin-top: 26px; padding-top: 22px; border-top: 1px solid var(--line);
    }
    .btn-save {
        background: var(--orange); color: #fff; border: none; border-radius: 6px;
        padding: 10px 22px; font-weight: 600; font-size: 0.92rem; cursor: pointer;
    }
    .btn-save:hover { background: #c8530f; color: #fff; }
    .btn-cancel {
        background: transparent; color: var(--ink); border: 1px solid var(--line);
        border-radius: 6px; padding: 10px 20px; font-weight: 600; font-size: 0.92rem; text-decoration: none;
    }
    .btn-cancel:hover { border-color: #c9c1b0; color: var(--ink); }
</style>

<div class="admin-shell">
    <div class="admin-header">
        <div class="admin-header-row">
            <a href="{{ route('hoop.admin.customers') }}" class="admin-back-link">
                <i class="fa fa-arrow-left"></i> Back to customers
            </a>
            <div class="admin-title">{{ isset($customer) ? 'Edit customer' : 'Add customer' }}</div>
        </div>
    </div>

    <div class="admin-body">
        <div class="admin-card">
            <form method="POST"
                  action="{{ isset($customer) ? route('hoop.admin.customers.update', $customer->id) : route('hoop.admin.customers.store') }}">
                @csrf
                @if(isset($customer))
                    @method('PUT')
                @endif

                @if($errors->any())
                    <div class="alert-danger">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <div class="field">
                    <label for="name">Full name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $customer->name ?? '') }}" required>
                </div>

                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $customer->email ?? '') }}" required>
                </div>



                <div class="form-actions">
                    <button type="submit" class="btn-save">{{ isset($customer) ? 'Update customer' : 'Save customer' }}</button>
                    <a href="{{ route('hoop.admin.customers') }}" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection