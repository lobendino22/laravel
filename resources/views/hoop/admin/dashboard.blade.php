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
        --surface: #26231f;
        --surface-2: #2e2a25;
        background: var(--paper);
        min-height: 100vh;
        font-family: 'Inter', system-ui, sans-serif;
        color: var(--ink);
    }

    /* ---- Header: scoreboard band ---- */
    .admin-header {
        background: #14110e;
        color: #fff;
        padding: 26px 28px;
        position: relative;
        overflow: hidden;
    }
    .admin-header::after {
        /* single deliberate decorative touch: a court arc, not repeated anywhere else */
        content: "";
        position: absolute;
        right: -80px;
        top: -180px;
        width: 420px;
        height: 420px;
        border: 2px solid rgba(255,255,255,0.06);
        border-radius: 50%;
    }
    .admin-header-row {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        max-width: 1180px;
        margin: 0 auto;
    }
    .admin-brand-row {
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .admin-brand-logo {
        height: 40px;
        width: auto;
        display: block;
    }
    .admin-title {
        font-family: 'Barlow Condensed', sans-serif;
        font-weight: 700;
        font-size: 2rem;
        line-height: 1;
        letter-spacing: 0.2px;
    }
    .admin-head-meta {
        color: rgba(255,255,255,0.55);
        font-size: 0.85rem;
        margin-top: 4px;
    }
    .admin-head-meta strong {
        color: var(--orange);
        font-weight: 600;
    }
    .storefront-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        background: transparent;
        border: 1px solid rgba(255,255,255,0.25);
        border-radius: 8px;
        font-size: 0.88rem;
        font-weight: 600;
        color: #fff;
        text-decoration: none;
        transition: border-color 0.2s, background 0.2s;
    }
    .storefront-btn:hover {
        background: rgba(255,255,255,0.08);
        border-color: rgba(255,255,255,0.5);
        color: #fff;
    }
    .storefront-btn i { color: var(--orange); }

    @media (max-width: 540px) {
        .admin-brand-logo { height: 32px; }
        .admin-title { font-size: 1.6rem; }
    }

    /* ---- Stat cards ---- */
    .admin-body {
        max-width: 1180px;
        margin: 0 auto;
        padding: 30px 28px 48px;
    }
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
        gap: 18px;
    }
    .stat-card {
        background: var(--surface);
        border: 1px solid var(--line);
        border-left: 3px solid var(--accent, var(--orange));
        border-radius: 6px;
        padding: 20px 22px;
    }
    .stat-card.products  { --accent: var(--orange); }
    .stat-card.customers { --accent: var(--green); }
    .stat-card.orders    { --accent: var(--amber); }
    .stat-card.revenue   { --accent: var(--ink); }

    .stat-label {
        font-size: 0.85rem;
        font-weight: 500;
        color: var(--muted);
    }
    .stat-value {
        font-family: 'Barlow Condensed', sans-serif;
        font-variant-numeric: tabular-nums;
        font-weight: 800;
        font-size: 2.6rem;
        line-height: 1;
        color: var(--ink);
        margin: 8px 0 4px;
    }
    .stat-sub {
        color: var(--muted);
        font-size: 0.82rem;
    }
    .stat-action {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: 16px;
        text-decoration: none;
        font-size: 0.88rem;
        font-weight: 600;
        color: var(--accent, var(--ink));
        border-bottom: 1px solid transparent;
        padding-bottom: 1px;
        transition: border-color 0.15s;
    }
    .stat-action:hover {
        color: var(--accent, var(--ink));
        border-bottom-color: currentColor;
    }
    .stat-action i {
        font-size: 0.72rem;
    }
</style>

<div class="admin-shell">
    <div class="admin-header">
        <div class="admin-header-row">
            <div class="admin-brand-row">
                <img src="{{ asset('img/hoopzone.png') }}" alt="HoopZone" class="admin-brand-logo">
                <div>
                    <div class="admin-title">Dashboard</div>
                    <div class="admin-head-meta">Hoop Shop admin &middot; <strong>{{ now()->format('M d, Y') }}</strong></div>
                </div>
            </div>
            <a href="{{ route('hoop-shop') }}" class="storefront-btn">
                <i class="fa fa-basketball-ball"></i>
                <span>View storefront</span>
            </a>
        </div>
    </div>

    <div class="admin-body">
        <div class="stat-grid">
            <div class="stat-card products">
                <div class="stat-label">Products</div>
                <div class="stat-value">{{ number_format($productCount) }}</div>
                <div class="stat-sub">Total products</div>
                <a href="{{ route('hoop.admin.products') }}" class="stat-action">
                    Manage products <i class="fa fa-chevron-right"></i>
                </a>
            </div>

            <div class="stat-card customers">
                <div class="stat-label">Customers</div>
                <div class="stat-value">{{ number_format($customerCount) }}</div>
                <div class="stat-sub">Client accounts</div>
                <a href="{{ route('hoop.admin.customers') }}" class="stat-action">
                    Manage customers <i class="fa fa-chevron-right"></i>
                </a>
            </div>

            <div class="stat-card orders">
                <div class="stat-label">Orders</div>
                <div class="stat-value">{{ number_format($orderCount) }}</div>
                <div class="stat-sub">Total orders</div>
                <a href="{{ route('hoop.admin.orders') }}" class="stat-action">
                    Manage orders <i class="fa fa-chevron-right"></i>
                </a>
            </div>

            <div class="stat-card revenue">
                <div class="stat-label">Revenue</div>
                <div class="stat-value">&#8369;{{ number_format($revenue, 2) }}</div>
            
                <a href="#" class="stat-action">
                    
                </a>
            </div>
        </div>
    </div>
</div>
@endsection