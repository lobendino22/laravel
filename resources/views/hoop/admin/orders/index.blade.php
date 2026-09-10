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
        --amber: #e0b268;
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

    .order-list { display: flex; flex-direction: column; gap: 14px; }
    .order-card {
        background: var(--surface); border: 1px solid var(--line); border-radius: 8px;
        padding: 18px 22px; display: grid;
        grid-template-columns: 120px 1.3fr 1.4fr 110px 170px 44px;
        gap: 18px; align-items: start;
    }
    .order-id { font-family: 'Barlow Condensed', sans-serif; font-weight: 700; font-size: 1.3rem; }
    .order-date { color: var(--muted); font-size: 0.78rem; margin-top: 2px; }

    .cust-name { font-weight: 600; }
    .cust-meta { color: var(--muted); font-size: 0.82rem; margin-top: 3px; line-height: 1.5; }
    .cust-note {
        display: flex; gap: 6px; margin-top: 6px; font-size: 0.8rem;
        color: var(--amber); align-items: flex-start;
    }

    .item-line { font-size: 0.85rem; line-height: 1.6; }
    .item-line .qty { color: var(--muted); }

    .order-total { font-variant-numeric: tabular-nums; font-weight: 700; text-align: right; }

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
        .order-card { grid-template-columns: 1fr; }
        .order-total { text-align: left; }
    }
</style>

<div class="admin-shell">
    <div class="admin-header">
        <div class="admin-header-row">
            <a href="{{ route('hoop.admin.dashboard') }}" class="admin-back-link">
                <i class="fa fa-arrow-left"></i> Back to admin
            </a>
            <div class="admin-title">Orders</div>
        </div>
    </div>

    <div class="admin-body">
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @forelse($orders as $order)
                <div class="order-list">
                    <div class="order-card">
                        <div>
                            <div class="order-id">#{{ $order->id }}</div>
                            <div class="order-date">{{ $order->created_at->format('M d, Y h:i A') }}</div>
                        </div>

                        <div>
                            <div class="cust-name">{{ $order->user->name ?? 'Deleted user' }}</div>
                            <div class="cust-meta">{{ $order->phone }}<br>{{ $order->address }}</div>
                            @if($order->note)
                                <div class="cust-note"><i class="fa fa-sticky-note-o"></i> {{ $order->note }}</div>
                            @endif
                        </div>

                        <div>
                            @foreach($order->items as $item)
                                <div class="item-line">{{ $item->product_name }} <span class="qty">&times;{{ $item->quantity }}</span></div>
                            @endforeach
                        </div>

                        <div class="order-total">&#8369;{{ number_format($order->total, 2) }}</div>

                        <div>
                            <form method="POST" action="{{ route('hoop.admin.orders.status', $order->id) }}">
                                @csrf
                                <select name="status" class="status-select" onchange="this.form.submit()">
                                    @foreach($statuses as $status)
                                        <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>{{ $status }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>

                        <div>
                            <a href="{{ route('hoop.admin.orders.destroy', $order->id) }}" class="icon-btn" onclick="return confirm('Delete this order?')"><i class="fa fa-trash"></i></a>
                        </div>
                    </div>
                </div>
        @empty
            <div class="empty-state">No orders yet.</div>
        @endforelse
    </div>
</div>
@endsection