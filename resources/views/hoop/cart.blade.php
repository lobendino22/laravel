@extends('layouts.app')
@section('content')
<style>
    .cart-container { max-width: 900px; margin: 0 auto; padding: 40px 20px; }
    .cart-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
    .cart-brand { text-align: center; margin-bottom: 30px; }
    .cart-brand img { height: 50px; width: auto; margin-bottom: 8px; }
    .cart-brand h1 { font-weight: 800; letter-spacing: 3px; color: #1ab394; margin: 12px 0 4px; font-size: 2rem; }
    .cart-brand p { color: #6b7280; font-size: 1rem; margin: 0; }
    .cart-table { width: 100%; border-collapse: collapse; }
    .cart-table th { text-align: left; padding: 16px 20px; background: #f1f5f9; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; font-weight: 600; border-bottom: 1px solid #e2e8f0; }
    .cart-table td { padding: 16px 20px; border-bottom: 1px solid #e2e8f0; vertical-align: middle; }
    .cart-product { display: flex; align-items: center; gap: 14px; }
    .cart-product-img { width: 64px; height: 64px; border-radius: 10px; object-fit: cover; background: #f1f5f9; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
    .cart-product-name { font-weight: 600; color: #1e293b; font-size: 1rem; }
    .cart-price { color: #64748b; font-size: 0.95rem; }
    .cart-qty-input { width: 70px; padding: 10px 12px; border: 1px solid #e2e8f0; border-radius: 8px; text-align: center; font-size: 0.95rem; background: #fff; transition: border-color 0.2s, box-shadow 0.2s; }
    .cart-qty-input:focus { outline: none; border-color: #1ab394; box-shadow: 0 0 0 3px rgba(26,179,148,0.1); }
    .cart-subtotal { font-weight: 700; color: #1e293b; text-align: right; font-size: 1.05rem; }
    .cart-remove { color: #94a3b8; transition: all 0.2s; }
    .cart-remove:hover { color: #ef4444; transform: scale(1.1); }
    .cart-footer { display: flex; justify-content: space-between; align-items: center; margin-top: 30px; padding: 24px 0; border-top: 2px solid #e2e8f0; }
    .cart-total-label { color: #64748b; font-size: 1rem; font-weight: 500; }
    .cart-total-price { font-weight: 800; font-size: 1.5rem; color: #1ab394; margin-left: 10px; }
    .cart-btn { padding: 14px 28px; border-radius: 10px; font-weight: 600; font-size: 0.95rem; transition: all 0.2s; text-decoration: none; display: inline-block; }
    .cart-btn-update { background: #fff; border: 2px solid #e2e8f0; color: #1e293b; }
    .cart-btn-update:hover { background: #f8fafc; border-color: #cbd5e1; transform: translateY(-1px); }
    .cart-btn-checkout { background: linear-gradient(135deg, #1ab394, #17987e); color: #fff; border: none; }
    .cart-btn-checkout:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(26,179,148,0.4); color: #fff; }
    .cart-empty { text-align: center; padding: 60px 20px; }
    .cart-empty-icon { font-size: 3rem; color: #d1d5db; margin-bottom: 16px; }
    .cart-empty h3 { color: #1e293b; margin-bottom: 8px; }
    .cart-empty p { color: #6b7280; margin-bottom: 20px; font-size: 1.05rem; }
    .cart-shop-link { color: #1ab394; font-weight: 600; text-decoration: none; }
    .cart-shop-link:hover { text-decoration: underline; color: #17987e; }
</style>

<div class="cart-container">
    <div class="cart-brand">
        <img src="{{ asset('img/hoopzone.png') }}" alt="HoopZone">
        <h1>HOOP ZONE</h1>
        <p>Shopping Cart</p>
    </div>

    <div class="cart-header">
        <h3>Shopping Cart</h3>
        <a href="{{ route('hoop-shop') }}" style="color:#6b7280; text-decoration:none; font-size:0.9rem;">
            <i class="fa fa-arrow-left"></i> Continue Shopping
        </a>
    </div>

    @if(empty($items))
        <div class="cart-empty">
            <div class="cart-empty-icon">
                <i class="fa fa-shopping-bag"></i>
            </div>
            <p class="text-muted">Your cart is empty</p>
            <a href="{{ route('hoop-shop') }}" class="cart-shop-link">Browse Products</a>
        </div>
    @else
        <form method="POST" action="{{ route('hoop.cart.update') }}">
            @csrf
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th class="text-center">Unit Price</th>
                        <th class="text-center">Qty</th>
                        <th class="text-right">Subtotal</th>
                        <th class="text-right"></th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($items as $item)
                        @php
                            $subtotal = $item['subtotal'];
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td>
                                <div class="cart-product">
                                    @if($item['product']->photo)
                                        <img src="{{ asset('_uploads/' . $item['product']->photo) }}" alt=""
                                             class="cart-product-img">
                                    @else
                                        <div style="width:56px;height:56px;border-radius:8px;background:#f7f8fa;display:flex;align-items:center;justify-content:center;">
                                            <i class="fa fa-basketball-ball text-muted"></i>
                                        </div>
                                    @endif
                                    <span class="cart-product-name">{{ $item['product']->name }}</span>
                                </div>
                            </td>
                            <td class="cart-price text-center">₱{{ number_format($item['product']->price, 2) }}</td>
                            <td class="text-center">
                                <input type="number" name="qty[{{ $item['product']->id }}]" value="{{ $item['qty'] }}"
                                       min="0" max="{{ $item['product']->stock }}" class="cart-qty-input">
                            </td>
                            <td class="cart-subtotal">₱{{ number_format($subtotal, 2) }}</td>
                            <td class="text-right">
                                <a href="{{ route('hoop.cart.remove', $item['product']->id) }}"
                                   class="cart-remove" title="Remove"
                                   onclick="return confirm('Remove this item?')">
                                    <i class="fa fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="cart-footer">
                <div>
                    <span class="cart-total-label">Total:</span>
                    <span class="cart-total-price">₱{{ number_format($total, 2) }}</span>
                </div>
                <div>
                    <button type="submit" class="cart-btn cart-btn-update">Update Cart</button>
                    <a href="{{ route('hoop.checkout') }}" class="cart-btn cart-btn-checkout" style="margin-left:12px;">
                        Checkout <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </form>
    @endif
</div>
@endsection