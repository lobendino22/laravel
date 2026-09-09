@extends('layouts.app')
@section('content')
<style>
    body.checkout-page { background: #f8fafc; }
    .checkout-container { max-width: 1000px; margin: 0 auto; padding: 40px 20px; }
    .checkout-brand { text-align: center; margin-bottom: 30px; }
    .checkout-brand img { height: 50px; width: auto; margin-bottom: 8px; }
    .checkout-brand h1 { font-weight: 800; letter-spacing: 3px; color: #1ab394; margin: 12px 0 4px; font-size: 2rem; }
    .checkout-brand p { color: #6b7280; font-size: 1rem; margin: 0; }
    .checkout-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
    .checkout-back { color: #64748b; text-decoration: none; font-size: 0.95rem; transition: color 0.2s; }
    .checkout-back:hover { color: #1ab394; }
    .checkout-form-section { background: #fff; border: none; border-radius: 16px; padding: 28px; margin-bottom: 24px; box-shadow: 0 10px 40px rgba(0,0,0,0.06); }
    .checkout-section-title { font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; font-weight: 700; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid #e2e8f0; }
    .checkout-label { font-size: 0.9rem; font-weight: 600; color: #1e293b; margin-bottom: 8px; display: block; }
    .checkout-input { width: 100%; padding: 14px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 1rem; transition: border-color 0.2s, box-shadow 0.2s; background: #f8fafc; }
    .checkout-input:focus { outline: none; border-color: #1ab394; box-shadow: 0 0 0 3px rgba(26,179,148,0.1); background: #fff; }
    .checkout-input:disabled { background: #f1f5f9; color: #64748b; cursor: not-allowed; }
    .checkout-summary { background: #fff; border: none; border-radius: 16px; padding: 28px; box-shadow: 0 10px 40px rgba(0,0,0,0.06); }
    .checkout-summary-item { display: flex; justify-content: space-between; align-items: center; padding: 14px 0; border-bottom: 1px solid #f1f5f9; font-size: 0.95rem; }
    .checkout-summary-item:last-child { border-bottom: none; }
    .checkout-summary-name { color: #1e293b; font-weight: 500; }
    .checkout-summary-name span { color: #94a3b8; font-size: 0.85rem; margin-left: 6px; }
    .checkout-summary-price { color: #475569; font-weight: 500; }
    .checkout-shipping { color: #64748b; font-size: 0.95rem; }
    .checkout-total-row { display: flex; justify-content: space-between; align-items: center; padding: 18px 0 0; margin-top: 12px; border-top: 2px solid #e2e8f0; }
    .checkout-total-label { font-weight: 700; color: #1e293b; font-size: 1.1rem; }
    .checkout-total-price { font-weight: 800; font-size: 1.4rem; color: #1ab394; }
    .checkout-place-btn { width: 100%; padding: 16px; border: none; background: linear-gradient(135deg, #1ab394, #17987e); color: #fff; border-radius: 10px; font-weight: 700; font-size: 1.05rem; letter-spacing: 0.5px; transition: all 0.2s; margin-top: 20px; cursor: pointer; }
    .checkout-place-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(26,179,148,0.4); color: #fff; }
    .checkout-place-btn:active { transform: translateY(0); }
</style>

<body class="checkout-page">
<div class="checkout-container">
    <div class="checkout-brand">
        <img src="{{ asset('img/hoopzone.png') }}" alt="HoopZone">
        <h1>HOOP ZONE</h1>
        <p>Checkout</p>
    </div>

    <div class="checkout-header">
        <h3>Checkout</h3>
        <a href="{{ route('hoop.cart') }}" class="checkout-back">
            <i class="fa fa-arrow-left"></i> Back to Cart
        </a>
    </div>

<div class="row">
        <div class="col-md-7">
            <div class="checkout-form-section">
                <h4 class="checkout-section-title">Shipping Details</h4>
                <form method="POST" action="{{ route('hoop.checkout.place') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="checkout-label">Customer</label>
                        <input type="text" class="checkout-input" value="{{ auth()->user()->name }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="checkout-label" for="phone">Phone Number</label>
                        <input type="text" name="phone" id="phone" class="checkout-input" placeholder="09xx xxx xxxx" required>
                    </div>
                    <div class="mb-3">
                        <label class="checkout-label" for="address">Delivery Address</label>
                        <textarea name="address" id="address" rows="3" class="checkout-input"
                                  placeholder="Street, Barangay, City" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="checkout-label" for="note">Order Note (optional)</label>
                        <textarea name="note" id="note" rows="2" class="checkout-input"
                                  placeholder="Any special instructions"></textarea>
                    </div>
                    <button type="submit" class="checkout-place-btn">
                        <i class="fa fa-lock"></i> Place Order
                    </button>
                </form>
            </div>
        </div>
        <div class="col-md-5">
            <div class="checkout-summary">
                <h4 class="checkout-section-title">Order Summary</h4>
                @php $total = 0; @endphp
                @foreach($items as $item)
                    @php $total += $item['subtotal']; @endphp
                    <div class="checkout-summary-item">
                        <span class="checkout-summary-name">
                            {{ $item['product']->name }}
                            <span> x{{ $item['qty'] }}</span>
                        </span>
                        <span class="checkout-summary-price">₱{{ number_format($item['subtotal'], 2) }}</span>
                    </div>
                @endforeach
                <div class="checkout-summary-item">
                    <span class="checkout-shipping">Shipping</span>
                    <span class="checkout-summary-price">Free</span>
                </div>
                <div class="checkout-total-row">
                    <span class="checkout-total-label">Total</span>
                    <span class="checkout-total-price">₱{{ number_format($total, 2) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@endsection