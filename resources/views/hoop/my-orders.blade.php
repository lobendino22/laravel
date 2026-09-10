@extends('layouts.app')
@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .orders-page { background: #1c1a17; min-height: 100vh; font-family: 'Inter', system-ui, sans-serif; }
    .orders-container { max-width: 900px; margin: 0 auto; padding: 40px 20px 60px; }
    .orders-brand { text-align: center; margin-bottom: 30px; }
    .orders-brand img { height: 46px; width: auto; margin-bottom: 8px; }
    .orders-brand h1 {
        font-family: 'Barlow Condensed', sans-serif;
        font-weight: 800; letter-spacing: 2px; color: #f2ede3 !important;
        margin: 10px 0 2px; font-size: 2rem;
    }
    .orders-brand p { color: #9a9186 !important; font-size: 1rem; margin: 0; }
    .orders-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 12px; }
    .orders-header h3 { font-family: 'Barlow Condensed', sans-serif; font-weight: 700; font-size: 1.4rem; color: #f2ede3 !important; margin: 0; }
    .orders-back { color: #9a9186; text-decoration: none; font-size: 0.95rem; transition: color 0.2s; }
    .orders-back:hover { color: #e2611d; }
    .edit-profile-link { color: #e0705a; text-decoration: none; font-size: 0.9rem; font-weight: 600; margin-left: 12px; transition: all 0.2s; }
    .edit-profile-link:hover { text-decoration: underline; transform: translateX(-2px); color: #e8b4a6; }
    .order-card { background: #26231f; border: 1px solid #3a352e; border-radius: 12px; padding: 28px; margin-bottom: 24px; box-shadow: 0 10px 40px rgba(0,0,0,0.35); transition: transform 0.2s, box-shadow 0.2s; }
    .order-card:hover { transform: translateY(-3px); box-shadow: 0 15px 50px rgba(0,0,0,0.45); }
    .order-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; padding-bottom: 16px; border-bottom: 1px solid #3a352e; flex-wrap: wrap; gap: 10px; }
    .order-id { font-weight: 700; color: #f2ede3 !important; font-size: 1.1rem; }
    .order-badge { padding: 5px 14px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
    .order-badge-Pending { background: rgba(224,178,104,0.15); color: #e0b268; }
    .order-badge-Processing { background: rgba(116,185,255,0.15); color: #74b9ff; }
    .order-badge-Shipped { background: rgba(162,155,254,0.15); color: #a29bfe; }
    .order-badge-Delivered { background: rgba(0,184,148,0.15); color: #7ec9a3; }
    .order-badge-Cancelled { background: rgba(201,106,84,0.15); color: #e8b4a6; }
    .order-date { color: #9a9186; font-size: 0.9rem; margin-left: 12px; font-weight: 500; }
    .order-info { display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 20px; font-size: 0.95rem; color: #9a9186; }
    .order-info-item { display: flex; align-items: center; gap: 8px; }
    .order-info-item i { color: #e2611d; width: 16px; }
    .order-table { width: 100%; border-collapse: collapse; margin-top: 16px; }
    .order-table th { text-align: left; padding: 12px 16px; background: #2e2a25; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px; color: #9a9186; font-weight: 700; border-bottom: 1px solid #3a352e; }
    .order-table td { padding: 12px 16px; border-bottom: 1px solid #3a352e; font-size: 0.95rem; color: #d8d0c2; }
    .order-table .text-right { text-align: right; }
    .order-total-row { background: #2e2a25 !important; font-weight: 700; }
    .order-total-row td { color: #f2ede3; padding: 14px 16px; }
    .order-total-price { color: #e2611d; font-size: 1.15rem; }
    .orders-empty { text-align: center; padding: 80px 20px; }
    .orders-empty-icon { font-size: 4rem; color: #4a443b; margin-bottom: 20px; }
    .orders-empty h3 { color: #f2ede3 !important; margin-bottom: 8px; font-weight: 700; }
    .orders-empty p { color: #9a9186 !important; margin-bottom: 24px; font-size: 1.1rem; }
    .btn-start-shopping { background: #e2611d; color: #fff; border: none; border-radius: 10px; padding: 14px 32px; font-weight: 600; font-size: 1rem; transition: all 0.2s; text-decoration: none; display: inline-block; }
    .btn-start-shopping:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(226,97,29,0.35); color: #fff; }
    .orders-empty-v2 { text-align: center; padding: 60px 20px; }
    .orders-empty-v2 .icon { font-size: 3rem; color: #4a443b; margin-bottom: 16px; }
</style>

<div class="orders-page">
    <div class="orders-container">
        <div class="orders-brand">
            <img src="{{ asset('img/hoopzone.png') }}" alt="HoopZone">
            <h1>HOOP ZONE</h1>
            <p>My Orders</p>
        </div>

        <div class="orders-header">
            <h3>My Orders</h3>
            <a href="{{ route('hoop-shop') }}" class="orders-back">
                <i class="fa fa-arrow-left"></i> Back to Shop
            </a>
            <a href="{{ route('hoop.profile') }}" class="edit-profile-link">
                <i class="fa fa-user-edit"></i> Edit Profile
            </a>
        </div>

@if($orders->isEmpty())
    <div class="orders-empty">
        <div class="orders-empty-icon">
            <i class="fa fa-truck"></i>
        </div>
        <p class="text-muted">You have no orders yet.</p>
        <a href="{{ route('hoop-shop') }}" class="btn-start-shopping">
            Start Shopping
        </a>
    </div>
@else
    @foreach($orders as $order)
        <div class="order-card">
            <div class="order-header">
                <span class="order-id">Order #{{ $order->id }}</span>
                <div>
                    <span class="order-badge order-badge-{{ $order->status }}">
                        {{ $order->status }}
                    </span>
                    <span class="order-date">{{ $order->created_at->format('M d, Y h:i A') }}</span>
                </div>
            </div>
            <div class="order-info">
                <div class="order-info-item">
                    <i class="fa fa-phone"></i>
                    <span>{{ $order->phone }}</span>
                </div>
                <div class="order-info-item">
                    <i class="fa fa-map-marker"></i>
                    <span>{{ $order->address }}</span>
                </div>
                @if($order->note)
                    <div class="order-info-item">
                        <i class="fa fa-sticky-note-o"></i>
                        <span>{{ $order->note }}</span>
                    </div>
                @endif
            </div>
            <table class="order-table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th class="text-center">Qty</th>
                        <th class="text-right">Price</th>
                        <th class="text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-right">₱{{ number_format($item->price, 2) }}</td>
                            <td class="text-right">₱{{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="order-total-row">
                        <th colspan="3" class="text-right">TOTAL</th>
                        <th class="text-right order-total-price">₱{{ number_format($order->total, 2) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    @endforeach
@endif
    </div>
</div>
@endsection