@extends('layouts.app')
@section('content')
@php
    $brand = '#0f172a';
    $ink   = '#111827';
    $muted = '#64748b';
    $line  = '#e9edf2';
@endphp
<style>
    .admin-shell { background: #f6f8fb; min-height: 100vh; padding: 28px 24px 48px; }
    .admin-page-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        background: #fff;
        border: 1px solid #eef1f5;
        border-radius: 16px;
        padding: 18px 22px;
        margin-bottom: 22px;
        box-shadow: 0 1px 2px rgba(15,23,42,0.03);
    }
    .admin-brand-row {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .admin-brand-logo {
        height: 42px;
        width: auto;
        display: block;
    }
    @media (max-width: 540px) {
        .admin-brand-row { flex-wrap: wrap; }
        .admin-brand-logo { height: 36px; }
    }
    .admin-kicker {
        color: #e95c29;
        font-size: 0.75rem;
        font-weight: 800;
        letter-spacing: 1.4px;
        text-transform: uppercase;
    }
    .admin-title {
        font-weight: 800;
        color: #111827;
        font-size: 1.5rem;
        margin-top: 3px;
        letter-spacing: -0.3px;
    }
    .admin-head-meta {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #64748b;
        font-size: 0.85rem;
        margin-top: 2px;
    }
    .storefront-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 16px;
        background: #fff;
        border: 1px solid #d2d6de;
        border-radius: 10px;
        font-size: 0.9rem;
        font-weight: 600;
        color: #111827;
        text-decoration: none;
        transition: background 0.2s, border-color 0.2s, box-shadow 0.2s;
    }
    .storefront-btn:hover {
        background: #f3f4f6;
        border-color: #9aa4b2;
    }
    .storefront-btn i {
        color: #1ab394;
    }
    .stat-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; }
    .stat-card {
        position: relative;
        background: #fff;
        border: 1px solid #eef1f5;
        border-radius: 16px;
        padding: 22px 22px 20px;
        transition: box-shadow .2s ease, transform .2s ease, border-color .2s ease;
    }
    .stat-card:hover {
        box-shadow: 0 12px 28px rgba(15,23,42,0.08);
        transform: translateY(-2px);
        border-color: #d7dee6;
    }
    .stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 14px;
    }
    .stat-label {
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.7px;
        color: #64748b;
    }
    .stat-chip {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        border-radius: 12px;
        font-size: 1.15rem;
        color: #fff;
        flex-shrink: 0;
    }
    .stat-value {
        font-size: 2.2rem;
        font-weight: 800;
        color: #111827;
        line-height: 1.1;
        margin: 4px 0 2px;
        letter-spacing: -0.5px;
    }
    .stat-sub {
        color: #6b7280;
        font-size: 0.85rem;
    }
    .stat-action {
        margin-top: 16px;
        width: 100%;
        display: block;
        text-align: center;
        text-decoration: none;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 0.9rem;
        font-weight: 600;
        transition: background 0.2s, color 0.2s, box-shadow 0.2s;
        border: 1px solid transparent;
    }
    .stat-action:hover { color: #fff; }
    .stat-action.teal   { background: #10b981; color: #fff; }
    .stat-action.teal:hover { box-shadow: 0 6px 14px rgba(16,185,129,0.3); }
    .stat-action.emerald { background: #10b981; color: #fff; }
    .stat-action.emerald:hover { box-shadow: 0 6px 14px rgba(16,185,129,0.3); }
    .stat-action.amber  { background: #f59e0b; color: #fff; }
    .stat-action.amber:hover { box-shadow: 0 6px 14px rgba(245,158,11,0.3); }
    .stat-action.slate  { background: #334155; color: #fff; }
    .stat-action.slate:hover { box-shadow: 0 6px 14px rgba(51,65,85,0.3); }
    .stat-action.pink   { background: #e95c29; color: #fff; }
    .stat-action.pink:hover { box-shadow: 0 6px 14px rgba(233,92,41,0.3); }
</style>

<div class="admin-shell">
    <div class="admin-page-head">
        <div class="admin-brand-row">
            <img src="{{ asset('img/hoopzone.png') }}" alt="HoopZone" class="admin-brand-logo">
            <div>
                <div class="admin-kicker">Hoop Shop Admin</div>
                <div class="admin-title">Dashboard</div>
                <div class="admin-head-meta">
                    <i class="fa fa-calendar-alt mr-1" style="color:#1ab394;"></i>
                    {{ now()->format('M d, Y') }}
                </div>
            </div>
        </div>
        <a href="{{ route('hoop-shop') }}" class="storefront-btn">
            <i class="fa fa-basketball-ball"></i>
            <span>View Storefront</span>
        </a>
    </div>

    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-label">Products</div>
                <div class="stat-chip" style="background: linear-gradient(135deg, #10b981, #059669);">
                    <i class="fa fa-box"></i>
                </div>
            </div>
            <div class="stat-value">{{ number_format($productCount) }}</div>
            <div class="stat-sub">Total products</div>
            <a href="{{ route('hoop.admin.products') }}" class="stat-action teal">
                Manage Products
            </a>
        </div>

        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-label">Customers</div>
                <div class="stat-chip" style="background: linear-gradient(135deg, #10b981, #047857);">
                    <i class="fa fa-users"></i>
                </div>
            </div>
            <div class="stat-value">{{ number_format($customerCount) }}</div>
            <div class="stat-sub">Client accounts</div>
            <a href="{{ route('hoop.admin.customers') }}" class="stat-action emerald">
                Manage Customers
            </a>
        </div>

        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-label">Orders</div>
                <div class="stat-chip" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                    <i class="fa fa-shopping-cart"></i>
                </div>
            </div>
            <div class="stat-value">{{ number_format($orderCount) }}</div>
            <div class="stat-sub">Total orders</div>
            <a href="{{ route('hoop.admin.orders') }}" class="stat-action amber">
                Manage Orders
            </a>
        </div>

        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-label">Revenue</div>
                <div class="stat-chip" style="background: linear-gradient(135deg, #334155, #0f172a);">
                    <i class="fa fa-peso"></i>
                </div>
            </div>
            <div class="stat-value">₱{{ number_format($revenue, 2) }}</div>
            <div class="stat-sub">Excludes cancelled orders</div>
            <a href="#" class="stat-action slate">
                View Revenue
            </a>
        </div>
    </div>
</div>
@endsection