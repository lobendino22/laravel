@extends('layouts.app')
@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .hoop-page {
        --bg: #1c1a17;
        --surface: #26231f;
        --surface-2: #2e2a25;
        --line: #3a352e;
        --ink: #f2ede3;
        --muted: #9a9186;
        --orange: #e2611d;
        font-family: 'Inter', system-ui, sans-serif;
        background: var(--bg);
        min-height: 100vh;
        color: var(--ink);
    }

    .hoop-back-row { max-width: 1180px; margin: 0 auto; padding: 22px 24px 0; }
    .hoop-back-link {
        display: inline-flex; align-items: center; gap: 7px; text-decoration: none;
        color: var(--muted); font-size: 0.88rem; font-weight: 600;
    }
    .hoop-back-link:hover { color: var(--orange); }

    /* ---- Hero ---- */
    .hoop-hero {
        background: var(--surface);
        border-bottom: 1px solid var(--line);
        color: var(--ink);
        margin: 18px 0 0;
        padding: 48px 24px 40px;
        position: relative;
        overflow: hidden;
        text-align: center;
    }
    .hoop-hero::after {
        content: "";
        position: absolute;
        left: 50%;
        top: -260px;
        transform: translateX(-50%);
        width: 520px;
        height: 520px;
        border: 2px solid rgba(255,255,255,0.04);
        border-radius: 50%;
    }
    .hoop-hero-inner { position: relative; z-index: 1; max-width: 560px; margin: 0 auto; }
    .hoop-brand {
        display: flex; align-items: center; justify-content: center; gap: 12px;
    }
    .hoop-brand img { height: 40px; width: auto; }
    .hoop-brand-name {
        font-family: 'Barlow Condensed', sans-serif;
        font-weight: 800;
        font-size: 2.1rem;
        letter-spacing: 1px;
        color: var(--ink) !important;
    }
    .hoop-page .hoop-subtitle {
        color: #b7ad9e !important;
        font-size: 0.95rem;
        margin-top: 6px;
    }

    .hoop-search { max-width: 420px; margin: 26px auto 0; }
    .hoop-search-field {
        display: flex; align-items: center; gap: 10px;
        background: var(--bg);
        border: 1px solid var(--line);
        border-radius: 8px;
        padding: 4px 6px 4px 16px;
        transition: border-color 0.15s;
    }
    .hoop-search-field:focus-within { border-color: var(--orange); }
    .hoop-search-field input {
        flex: 1; background: transparent; border: none; outline: none;
        color: var(--ink); font-size: 0.92rem; padding: 9px 0;
    }
    .hoop-search-field input::placeholder { color: var(--muted); }
    .hoop-search-field button {
        background: var(--orange); border: none; color: #fff;
        border-radius: 6px; width: 36px; height: 36px;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; transition: background 0.15s; flex-shrink: 0;
    }
    .hoop-search-field button:hover { background: #c8530f; }

    /* ---- Body ---- */
    .hoop-body { max-width: 1180px; margin: 0 auto; padding: 30px 24px 60px; }

    .hoop-results-bar {
        text-align: center;
        color: var(--muted);
        font-size: 0.88rem;
        margin-bottom: 22px;
    }
    .hoop-results-bar strong { color: var(--ink); }
    .hoop-results-bar a { color: var(--orange); text-decoration: none; font-weight: 600; margin-left: 6px; }
    .hoop-results-bar a:hover { text-decoration: underline; }

    .hoop-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
        gap: 20px;
    }

    .hoop-product {
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: 10px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: box-shadow 0.15s, border-color 0.15s;
    }
    .hoop-product:hover { border-color: #4a443b; box-shadow: 0 10px 24px rgba(0,0,0,0.35); }

    .hoop-product-img {
        height: 190px;
        background: var(--surface-2);
        display: flex; align-items: center; justify-content: center;
    }
    .hoop-product-img img { width: 100%; height: 100%; object-fit: cover; }
    .hoop-product-img i { color: #5a5348; }

    .hoop-product-body { padding: 16px 16px 18px; display: flex; flex-direction: column; flex: 1; }
    .hoop-product-name { font-weight: 600; font-size: 0.95rem; margin-bottom: 4px; color: var(--ink); }
    .hoop-product-desc { color: var(--muted); font-size: 0.82rem; line-height: 1.45; flex: 1; margin-bottom: 14px; }

    .hoop-price-row {
        display: flex; align-items: baseline; justify-content: space-between; margin-bottom: 14px;
    }
    .hoop-price {
        font-family: 'Barlow Condensed', sans-serif;
        font-weight: 700; font-size: 1.4rem; color: var(--ink);
    }
    .hoop-stock { font-size: 0.78rem; color: var(--muted); }
    .hoop-stock.low { color: var(--orange); font-weight: 600; }

    .hoop-cart-form { display: flex; align-items: center; gap: 8px; }
    .hoop-input-qty {
        border: 1px solid var(--line); border-radius: 6px; padding: 8px;
        width: 52px; text-align: center; font-size: 0.9rem;
        color: var(--ink); background: var(--bg);
    }
    .hoop-input-qty:focus { outline: none; border-color: var(--orange); }
    .hoop-btn-add {
        flex: 1; border: none; background: var(--orange); color: #fff;
        border-radius: 6px; padding: 9px 14px; font-weight: 600; font-size: 0.85rem;
        cursor: pointer; transition: background 0.15s;
    }
    .hoop-btn-add:hover { background: #c8530f; }
    .hoop-btn-soldout {
        width: 100%; border: 1px solid var(--line); background: var(--bg);
        color: var(--muted); border-radius: 6px; padding: 9px 14px;
        font-weight: 600; font-size: 0.85rem; cursor: not-allowed;
    }

    .hoop-empty { text-align: center; padding: 70px 20px; }
    .hoop-empty i { font-size: 2.6rem; color: #4a443b; }
    .hoop-empty p { color: var(--muted); margin-top: 14px; font-size: 0.95rem; }

    /* ---- Pagination (Bootstrap component — themed to match) ---- */
    .hoop-page .pagination { gap: 6px; }
    .hoop-page .page-item .page-link {
        background: var(--surface) !important;
        border: 1px solid var(--line) !important;
        color: var(--ink) !important;
        border-radius: 6px !important;
        margin: 0 !important;
        min-width: 38px;
        text-align: center;
    }
    .hoop-page .page-item .page-link:hover {
        background: var(--surface-2) !important;
        border-color: #4a443b !important;
        color: var(--orange) !important;
    }
    .hoop-page .page-item.active .page-link {
        background: var(--orange) !important;
        border-color: var(--orange) !important;
        color: #fff !important;
    }
    .hoop-page .page-item.disabled .page-link {
        background: var(--surface) !important;
        border-color: var(--line) !important;
        color: var(--muted) !important;
        opacity: 0.6;
    }

    @media (max-width: 540px) {
        .hoop-brand-name { font-size: 1.6rem; }
        .hoop-hero { padding: 38px 20px 32px; }
    }
</style>

<div class="hoop-page">
    <div class="hoop-back-row">
        <a href="javascript:history.back()" class="hoop-back-link">
            <i class="fa fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="hoop-hero">
        <div class="hoop-hero-inner">
            <div class="hoop-brand">
                <img src="{{ asset('img/hoopzone.png') }}" alt="HoopZone">
                <span class="hoop-brand-name">Hoop Zone</span>
            </div>
            <p class="hoop-subtitle">Basketball apparel &amp; gear</p>

            <div class="hoop-search">
                <form method="GET" action="{{ route('hoop-shop') }}">
                    <div class="hoop-search-field">
                        <input type="text" name="search" value="{{ $query ?? '' }}" placeholder="Search products...">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="hoop-body">
        @if(!empty($query))
            <div class="hoop-results-bar">
                Results for <strong>&ldquo;{{ $query }}&rdquo;</strong>
                <a href="{{ route('hoop-shop') }}">Clear</a>
            </div>
        @endif

        @if($products->isEmpty())
            <div class="hoop-empty">
                <i class="fa fa-basketball-ball"></i>
                <p>No products found</p>
            </div>
        @else
            <div class="hoop-grid">
                @foreach($products as $product)
                    <div class="hoop-product">
                        <div class="hoop-product-img">
                            @if($product->photo)
                                <img src="{{ $product->photo_url }}" alt="{{ $product->name }}">
                            @else
                                <i class="fa fa-basketball-ball fa-2x"></i>
                            @endif
                        </div>
                        <div class="hoop-product-body">
                            <div class="hoop-product-name">{{ $product->name }}</div>
                            <div class="hoop-product-desc">{{ \Illuminate\Support\Str::limit($product->description ?? '', 60) }}</div>

                            <div class="hoop-price-row">
                                <span class="hoop-price">&#8369;{{ number_format($product->price, 2) }}</span>
                                <span class="hoop-stock {{ $product->stock > 0 && $product->stock <= 5 ? 'low' : '' }}">
                                    @if($product->stock > 0)
                                        {{ $product->stock }} pcs
                                    @else
                                        Sold out
                                    @endif
                                </span>
                            </div>

                            @if($product->stock > 0)
                                <form method="POST" action="{{ route('hoop.cart.add', $product->id) }}" class="hoop-cart-form">
                                    @csrf
                                    <input type="number" name="qty" value="1" min="1" max="{{ $product->stock }}" class="hoop-input-qty">
                                    <button type="submit" class="hoop-btn-add">Add to cart</button>
                                </form>
                            @else
                                <button class="hoop-btn-soldout" disabled>Out of stock</button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            @if($products->hasPages())
                <div class="d-flex justify-content-center mt-4 mb-2">
                    {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            @endif
        @endif
    </div>
</div>
@endsection