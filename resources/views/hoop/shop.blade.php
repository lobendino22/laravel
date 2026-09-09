@extends('layouts.app')
@section('content')
<style>
    .hoop-brand { font-weight: 800; letter-spacing: 2px; color: #1c2024; font-size: 1.4rem; }
    .hoop-brand img { height: 32px; width: auto; vertical-align: middle; margin-right: 8px; }
    .hoop-subtitle { color: #6b7280; font-size: 0.95rem; margin-top: 4px; }
    .hoop-search { max-width: 400px; margin: 0 auto; }
    .hoop-search .form-control { border: 1px solid #e9ecef; border-radius: 30px; padding: 10px 20px; }
    .hoop-search .btn { border-radius: 30px; padding: 10px 20px; }
    .hoop-product { border: 1px solid #e9ecef; border-radius: 12px; overflow: hidden; transition: all 0.2s ease; background: #fff; }
    .hoop-product:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.06); transform: translateY(-2px); }
    .hoop-product-img { height: 200px; background: #f7f8fa; display: flex; align-items: center; justify-content: center; }
    .hoop-product-img img { width: 100%; height: 100%; object-fit: cover; }
    .hoop-product-name { font-weight: 600; font-size: 0.95rem; color: #1c2024; margin-bottom: 4px; }
    .hoop-product-desc { color: #6b7280; font-size: 0.82rem; line-height: 1.4; }
    .hoop-price { font-weight: 700; color: #e95c29; font-size: 1.1rem; }
    .hoop-stock { font-size: 0.75rem; color: #6b7280; }
    .hoop-btn-add { border: none; background: #1c2024; color: #fff; border-radius: 6px; padding: 8px 18px; font-weight: 500; font-size: 0.85rem; transition: background 0.2s; }
    .hoop-btn-add:hover { background: #e95c29; }
    .hoop-input-qty { border: 1px solid #e9ecef; border-radius: 6px; padding: 6px 10px; width: 56px; text-align: center; }
    .hoop-empty { padding: 60px 20px; }
    .hoop-empty-icon { font-size: 3rem; color: #d1d5db; }
</style>

<div class="container py-5">
    <a href="javascript:history.back()" class="back-btn" style="display: inline-flex; align-items: center; gap: 6px; color: var(--text-muted); text-decoration: none; font-size: 0.9rem; margin-bottom: 20px; transition: var(--transition);" onmouseover="this.style.color='#e94560'" onmouseout="this.style.color='var(--text-muted)'">
        <i class="fa fa-arrow-left"></i> Back
    </a>
    <div class="text-center mb-5">
        <div class="hoop-brand">
            <img src="{{ asset('img/hoopzone.png') }}" alt="HoopZone"> HOOP ZONE
        </div>
        <p class="hoop-subtitle">Basketball apparel & gear</p>
    </div>

    <div class="hoop-search mb-5">
        <form method="GET" action="{{ route('hoop-shop') }}">
            <div class="input-group">
                <input type="text" name="search" value="{{ $query ?? '' }}" class="form-control"
                       placeholder="Search products...">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>

    @if(!empty($query))
        <p class="text-center text-muted mb-4" style="font-size: 0.9rem;">
            Results for <strong>&ldquo;{{ $query }}&rdquo;</strong>
            &nbsp;·&nbsp; <a href="{{ route('hoop-shop') }}">Clear</a>
        </p>
    @endif

    @if($products->isEmpty())
        <div class="hoop-empty text-center">
            <div class="hoop-empty-icon mb-3">
                <i class="fa fa-basketball-ball"></i>
            </div>
            <p class="text-muted">No products found</p>
        </div>
    @else
        <div class="row">
            @foreach($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="hoop-product">
                        <div class="hoop-product-img">
                            @if($product->photo)
                                <img src="{{ asset('_uploads/' . $product->photo) }}" alt="{{ $product->name }}">
                            @else
                                <i class="fa fa-basketball-ball fa-2x text-muted"></i>
                            @endif
                        </div>
                        <div class="p-3">
                            <div class="hoop-product-name">{{ $product->name }}</div>
                            <div class="hoop-product-desc mb-3">
                                {{ \Illuminate\Support\Str::limit($product->description ?? '', 60) }}
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="hoop-price">₱{{ number_format($product->price, 2) }}</span>
                                <span class="hoop-stock">
                                    @if($product->stock > 0)
                                        {{ $product->stock }} pcs
                                    @else
                                        Sold out
                                    @endif
                                </span>
                            </div>
                            @if($product->stock > 0)
                                <form method="POST" action="{{ route('hoop.cart.add', $product->id) }}" class="d-flex align-items-center gap-2">
                                    @csrf
                                    <input type="number" name="qty" value="1" min="1" max="{{ $product->stock }}"
                                           class="hoop-input-qty">
                                    <button type="submit" class="hoop-btn-add">Add to Cart</button>
                                </form>
                            @else
                                <button class="btn btn-light btn-sm w-100" disabled style="border:1px solid #e9ecef; border-radius:6px;">Out of stock</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection