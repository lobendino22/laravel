@extends('layouts.app')
@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .admin-shell {
        --ink: #f2ede3;
        --paper: #1c1a17;
        --line: #3a352e;
        --muted: #9a9186;
        --orange: #e2611d;
        --green: #7ec9a3;
        --red: #e0705a;
        --surface: #26231f;
        --surface-2: #2e2a25;
        background: var(--paper);
        min-height: 100vh;
        font-family: 'Inter', system-ui, sans-serif;
        color: var(--ink);
    }
    .admin-header { background: #14110e; color: #fff; padding: 22px 28px; }
    .admin-header-row { max-width: 1180px; margin: 0 auto; }
    .admin-back-link {
        display: inline-flex; align-items: center; gap: 7px; text-decoration: none;
        color: rgba(255,255,255,0.55); font-size: 0.85rem; font-weight: 600; margin-bottom: 10px;
    }
    .admin-back-link:hover { color: #fff; }
    .admin-title { font-family: 'Barlow Condensed', sans-serif; font-weight: 700; font-size: 1.9rem; line-height: 1; }

    .admin-body { max-width: 1180px; margin: 0 auto; padding: 26px 28px 60px; }
    .alert-success {
        background: rgba(31,111,79,0.15); border: 1px solid rgba(31,111,79,0.45); color: var(--green);
        border-radius: 6px; padding: 12px 16px; font-size: 0.9rem; margin-bottom: 18px;
    }

    .customer-list { display: flex; flex-direction: column; gap: 14px; }
    .customer-card {
        background: var(--surface); border: 1px solid var(--line); border-radius: 8px;
        padding: 18px 22px; display: grid;
        grid-template-columns: 140px 1.4fr 1.4fr 110px 170px 44px;
        gap: 18px; align-items: start;
    }
    .customer-name { font-family: 'Barlow Condensed', sans-serif; font-weight: 700; font-size: 1.3rem; }
    .customer-email { color: var(--muted); font-size: 0.82rem; margin-top: 2px; }

    .join-date { color: var(--muted); font-size: 0.78rem; }

    .customer-stats { font-size: 0.85rem; line-height: 1.6; }
    .customer-stats .stat-label { color: var(--muted); }

    .status-badge {
        display: inline-block; padding: 4px 10px; border-radius: 4px;
        font-size: 0.78rem; font-weight: 600;
    }
    .status-badge.active { background: rgba(31,111,79,0.2); color: var(--green); }
    .status-badge.deactivated { background: rgba(201,106,84,0.15); color: var(--red); }

    .status-select {
        border: 1px solid var(--line);
        border-radius: 6px;
        padding: 7px 10px;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--ink);
        background: var(--surface);
        width: 100%;
        cursor: pointer;
    }
    .status-select:focus { outline: none; border-color: var(--orange); }

    .icon-btn {
        display: inline-flex; align-items: center; justify-content: center;
        width: 32px; height: 32px; border-radius: 6px; border: 1px solid var(--line);
        color: var(--muted); text-decoration: none; background: var(--surface);
    }
    .icon-btn:hover { border-color: var(--red); color: var(--red); }

    .empty-state { text-align: center; color: var(--muted); padding: 50px 18px; background: var(--surface); border: 1px solid var(--line); border-radius: 8px; }

    @media (max-width: 920px) {
        .customer-card { grid-template-columns: 1fr; }
    }
</style>

<div class="admin-shell">
    <div class="admin-header">
        <div class="admin-header-row">
            <a href="{{ route('hoop.admin.dashboard') }}" class="admin-back-link">
                <i class="fa fa-arrow-left"></i> Back to admin
            </a>
            <div class="admin-title">Customers</div>
        </div>
    </div>

    <div class="admin-body">
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @forelse($customers as $customer)
                <div class="customer-card">
                    <div>
                        <div class="customer-name">{{ $customer->name }}</div>
                        <div class="customer-email">{{ $customer->email }}</div>
                    </div>

                    <div>
                        <div class="join-date">Joined {{ $customer->created_at->format('M d, Y') }}</div>
                    </div>

                    <div class="customer-stats">
                        <div class="stat-label">Orders: <strong>{{ $customer->orders()->count() }}</strong></div>
                    </div>

                    <div class="status-badge {{ $customer->active ? 'active' : 'deactivated' }}">
                        {{ $customer->active ? 'Active' : 'Deactivated' }}
                    </div>

                    <div>
                        <form method="POST" action="{{ route('hoop.admin.customers.toggleActive', $customer->id) }}">
                            @csrf
                            <select name="status" class="status-select" onchange="this.form.submit()">
                                <option value="active" {{ $customer->active ? 'selected' : '' }}>Active</option>
                                <option value="deactivated" {{ !$customer->active ? 'selected' : '' }}>Deactivated</option>
                            </select>
                        </form>
                    </div>

                    <div>
                        <a href="{{ route('hoop.admin.customers.destroy', $customer->id) }}" class="icon-btn" onclick="return confirm('Delete this customer and their orders?')"><i class="fa fa-trash"></i></a>
                    </div>
                </div>
        @empty
            <div class="empty-state">No customers yet.</div>
        @endforelse
    </div>
</div>
@endsection