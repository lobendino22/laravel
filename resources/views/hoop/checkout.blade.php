@extends('layouts.app')
@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .checkout-page {
        --bg: #1c1a17;
        --surface: #26231f;
        --surface-2: #2e2a25;
        --line: #3a352e;
        --ink: #f2ede3;
        --muted: #9a9186;
        --accent: #e2611d;
        --red: #c96a54;
        font-family: 'Inter', system-ui, sans-serif;
        color: var(--ink);
        background: var(--bg);
        min-height: 100vh;
        padding: 40px 20px 60px;
    }
    .checkout-container { max-width: 1000px; margin: 0 auto; }

    .checkout-brand { text-align: center; margin-bottom: 26px; }
    .checkout-brand img { height: 46px; width: auto; margin-bottom: 8px; }
    .checkout-brand h1 {
        font-family: 'Barlow Condensed', sans-serif;
        font-weight: 800; letter-spacing: 2px; color: var(--ink) !important;
        margin: 10px 0 2px; font-size: 1.9rem;
    }
    .checkout-brand p { color: var(--muted) !important; font-size: 0.95rem; margin: 0; }

    .checkout-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 22px; }
    .checkout-header h3 { font-family: 'Barlow Condensed', sans-serif; font-weight: 700; font-size: 1.4rem; color: var(--ink) !important; margin: 0; }
    .checkout-back { color: var(--muted); text-decoration: none; font-size: 0.9rem; }
    .checkout-back:hover { color: var(--accent); }

    .checkout-alert {
        padding: 13px 16px; border-radius: 8px; font-size: 0.9rem; margin-bottom: 20px;
        border: 1px solid rgba(201,106,84,0.4); background: rgba(201,106,84,0.12); color: #e8b4a6;
    }
    .checkout-alert.success {
        border-color: rgba(0,184,148,0.4); background: rgba(0,184,148,0.1); color: #8fdcc7;
    }

    .checkout-grid {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 24px;
        align-items: start;
    }

    .checkout-card {
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: 10px;
        padding: 26px;
    }
    .checkout-card-title {
        font-family: 'Barlow Condensed', sans-serif;
        font-weight: 700; font-size: 1.15rem; color: var(--ink) !important;
        margin: 0 0 20px; padding-bottom: 12px; border-bottom: 1px solid var(--line);
        display: flex; align-items: center; gap: 10px;
    }
    .checkout-card-title i { color: var(--accent); }

    .checkout-field { margin-bottom: 18px; }
    .checkout-label { display: block; font-size: 0.85rem; font-weight: 600; color: #d8d0c2 !important; margin-bottom: 7px; }
    .checkout-label span { color: var(--accent); }
    .checkout-input {
        width: 100%; padding: 12px 14px;
        border: 1px solid var(--line); border-radius: 8px;
        background: var(--bg); color: var(--ink);
        font-size: 0.92rem; font-family: 'Inter', system-ui, sans-serif;
        transition: border-color 0.15s, box-shadow 0.15s;
    }
    .checkout-input:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 3px rgba(226,97,29,0.15); }
    .checkout-input::placeholder { color: #6d655a; }
    .checkout-input:disabled { background: var(--surface-2); color: var(--muted); cursor: not-allowed; }
    textarea.checkout-input { resize: vertical; min-height: 84px; }
    .checkout-field-error { display: block; color: var(--red); font-size: 0.78rem; margin-top: 5px; }

    .checkout-place-btn {
        width: 100%; padding: 14px; border: none; border-radius: 8px;
        background: var(--accent); color: #fff !important;
        font-weight: 700; font-size: 1rem; letter-spacing: 0.4px;
        cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 9px;
        transition: background 0.15s, transform 0.15s;
    }
    .checkout-place-btn:hover { background: #c8530f; transform: translateY(-1px); }
    .checkout-place-btn:active { transform: translateY(0); }

    .checkout-summary { position: sticky; top: 24px; }
    .checkout-item {
        display: flex; align-items: center; gap: 12px;
        padding: 12px 0; border-bottom: 1px solid var(--line);
    }
    .checkout-item:last-of-type { border-bottom: none; }
    .checkout-item-img { width: 48px; height: 48px; border-radius: 8px; object-fit: cover; background: var(--surface-2); flex-shrink: 0; }
    .checkout-item-img-placeholder {
        width: 48px; height: 48px; border-radius: 8px; background: var(--surface-2);
        display: flex; align-items: center; justify-content: center; color: #5a5348; flex-shrink: 0;
    }
    .checkout-item-info { flex: 1; min-width: 0; }
    .checkout-item-name { font-weight: 600; font-size: 0.88rem; color: var(--ink) !important; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .checkout-item-qty { font-size: 0.78rem; color: var(--muted); margin-top: 2px; }
    .checkout-item-price { font-weight: 600; font-size: 0.88rem; color: var(--ink) !important; font-variant-numeric: tabular-nums; }

    .checkout-totals { margin-top: 6px; padding-top: 6px; }
    .checkout-total-row { display: flex; justify-content: space-between; font-size: 0.9rem; padding: 5px 0; }
    .checkout-total-row .co-label { color: var(--muted); }
    .checkout-total-row .co-value { color: var(--ink); }
    .checkout-total-row .co-value.shipping { color: #7ec9a3; }
    .checkout-total-row.grand {
        margin-top: 10px; padding-top: 14px; border-top: 2px solid var(--line);
        font-weight: 700; font-size: 1rem;
    }
    .checkout-total-row.grand .co-value {
        font-family: 'Barlow Condensed', sans-serif;
        font-weight: 800; font-size: 1.6rem; color: var(--accent) !important;
    }

    @media (max-width: 860px) {
        .checkout-grid { grid-template-columns: 1fr; }
        .checkout-summary { position: static; order: -1; }
    }
</style>

<div class="checkout-page">
    <div class="checkout-container">
        <div class="checkout-brand">
            <img src="{{ asset('img/hoopzone.png') }}" alt="HoopZone">
            <h1>HOOP ZONE</h1>
            <p>Checkout</p>
        </div>

        <div class="checkout-header">
            <h3>Checkout</h3>
            <a href="{{ route('hoop.cart') }}" class="checkout-back">
                <i class="fa fa-arrow-left"></i> Back to cart
            </a>
        </div>

        @if(session('error'))
            <div class="checkout-alert">
                <i class="fa fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="checkout-alert">
                <i class="fa fa-exclamation-circle"></i> Please fix the errors below.
            </div>
        @endif

        <div class="checkout-grid">
            <div class="checkout-card">
                <h4 class="checkout-card-title">
                    <i class="fa fa-truck"></i> Shipping Details
                </h4>

                <form method="POST" action="{{ route('hoop.checkout.place') }}">
                    @csrf

                    <div class="checkout-field">
                        <label class="checkout-label">Customer</label>
                        <input type="text" class="checkout-input" value="{{ auth()->user()->name }}" disabled>
                    </div>

                    <div class="checkout-field">
                        <label class="checkout-label" for="phone">Phone Number <span>*</span></label>
                        <input type="text" name="phone" id="phone" class="checkout-input" placeholder="09xx xxx xxxx"
                               value="{{ old('phone', auth()->user()->phone) }}" required>
                        @error('phone')
                            <span class="checkout-field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="checkout-field">
                        <label class="checkout-label" for="address">Delivery Address <span>*</span></label>
                        <textarea name="address" id="address" rows="3" class="checkout-input"
                                  placeholder="Street, Barangay, City" required>{{ old('address', auth()->user()->address) }}</textarea>
                        @error('address')
                            <span class="checkout-field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="checkout-field">
                        <label class="checkout-label" for="note">Order Note (optional)</label>
                        <textarea name="note" id="note" rows="2" class="checkout-input"
                                  placeholder="Any special instructions">{{ old('note') }}</textarea>
                        @error('note')
                            <span class="checkout-field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="checkout-place-btn">
                        <i class="fa fa-lock"></i> Place Order
                    </button>
                </form>
            </div>

            <div class="checkout-card checkout-summary">
                <h4 class="checkout-card-title">
                    <i class="fa fa-shopping-bag"></i> Order Summary
                </h4>

                @foreach($items as $item)
                    <div class="checkout-item">
                        @if($item['product']->photo)
                            <img src="{{ $item['product']->photo_url }}" alt="" class="checkout-item-img">
                        @else
                            <div class="checkout-item-img-placeholder">
                                <i class="fa fa-basketball-ball"></i>
                            </div>
                        @endif
                        <div class="checkout-item-info">
                            <div class="checkout-item-name">{{ $item['product']->name }}</div>
                            <div class="checkout-item-qty">Qty: {{ $item['qty'] }}</div>
                        </div>
                        <span class="checkout-item-price">&#8369;{{ number_format($item['subtotal'], 2) }}</span>
                    </div>
                @endforeach

                <div class="checkout-totals">
                    <div class="checkout-total-row">
                        <span class="co-label">Subtotal</span>
                        <span class="co-value">&#8369;{{ number_format(collect($items)->sum(fn ($i) => $i['subtotal']), 2) }}</span>
                    </div>
                    <div class="checkout-total-row">
                        <span class="co-label">Shipping</span>
                        <span class="co-value shipping">Free</span>
                    </div>
                    <div class="checkout-total-row grand">
                        <span class="co-label">Total</span>
                        <span class="co-value">&#8369;{{ number_format(collect($items)->sum(fn ($i) => $i['subtotal']), 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection