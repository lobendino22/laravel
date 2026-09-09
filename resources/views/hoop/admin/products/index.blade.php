@extends('layouts.app')
@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .admin-shell {
        --ink: #17130f;
        --paper: #f7f4ee;
        --line: #e3ddd0;
        --muted: #6b6459;
        --orange: #e2611d;
        --green: #1f6f4f;
        --amber: #a5680a;
        --red: #b3402b;
        background: var(--paper);
        min-height: 100vh;
        font-family: 'Inter', system-ui, sans-serif;
        color: var(--ink);
    }
    .admin-header {
        background: var(--ink);
        color: #fff;
        padding: 22px 28px;
    }
    .admin-header-row {
        max-width: 1100px;
        margin: 0 auto;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 14px;
    }
    .admin-back-link {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        text-decoration: none;
        color: rgba(255,255,255,0.55);
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 10px;
    }
    .admin-back-link:hover { color: #fff; }
    .admin-title {
        font-family: 'Barlow Condensed', sans-serif;
        font-weight: 700;
        font-size: 1.9rem;
        line-height: 1;
    }
    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--orange);
        color: #fff;
        border-radius: 6px;
        padding: 10px 18px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
    }
    .btn-add:hover { background: #c8530f; color: #fff; }

    .admin-body { max-width: 1100px; margin: 0 auto; padding: 26px 28px 60px; }
    .alert-success {
        background: #eaf3ee;
        border: 1px solid #bcdccb;
        color: var(--green);
        border-radius: 6px;
        padding: 12px 16px;
        font-size: 0.9rem;
        margin-bottom: 18px;
    }

    .admin-table-card {
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 8px;
        overflow: hidden;
    }
    table.product-table { width: 100%; border-collapse: collapse; }
    table.product-table th {
        text-align: left;
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--muted);
        padding: 14px 18px;
        border-bottom: 1px solid var(--line);
    }
    table.product-table td {
        padding: 12px 18px;
        border-bottom: 1px solid var(--line);
        font-size: 0.9rem;
        vertical-align: middle;
    }
    table.product-table tr:last-child td { border-bottom: none; }
    table.product-table tr:hover { background: #fbf9f5; }

    .prod-thumb { width: 54px; height: 54px; object-fit: cover; border-radius: 6px; border: 1px solid var(--line); }
    .prod-thumb-placeholder { width: 54px; height: 54px; border-radius: 6px; background: #eee8dc; }

    .prod-name { font-weight: 600; color: var(--ink); }
    .prod-desc { color: var(--muted); font-size: 0.82rem; margin-top: 2px; }
    .prod-price { text-align: right; font-variant-numeric: tabular-nums; font-weight: 600; }

    .stock-pill {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 600;
    }
    .stock-pill.in    { background: rgba(31,111,79,0.1); color: var(--green); }
    .stock-pill.out   { background: rgba(179,64,43,0.1); color: var(--red); }

    .row-actions { text-align: right; white-space: nowrap; }
    .icon-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 6px;
        border: 1px solid var(--line);
        color: var(--muted);
        text-decoration: none;
        background: #fff;
        margin-left: 6px;
    }
    .icon-btn:hover { border-color: #c9c1b0; color: var(--ink); }
    .icon-btn.danger:hover { border-color: var(--red); color: var(--red); }

    .empty-row { text-align: center; color: var(--muted); padding: 40px 18px; }
    .pagination-wrap { display: flex; justify-content: center; padding: 18px; }
</style>

<div class="admin-shell">
    <div class="admin-header">
        <div class="admin-header-row">
            <div>
                <a href="{{ route('hoop.admin.dashboard') }}" class="admin-back-link">
                    <i class="fa fa-arrow-left"></i> Back to admin
                </a>
                <div class="admin-title">Products</div>
            </div>
            <a href="{{ route('hoop.admin.products.create') }}" class="btn-add">
                <i class="fa fa-plus"></i> Add product
            </a>
        </div>
    </div>

    <div class="admin-body">
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="admin-table-card">
            <table class="product-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th style="text-align:right;">Price</th>
                        <th style="text-align:center;">Stock</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>
                                @if($product->photo)
                                    <img src="{{ $product->photo_url }}" alt="" class="prod-thumb">
                                @else
                                    <div class="prod-thumb-placeholder"></div>
                                @endif
                            </td>
                            <td>
                                <div class="prod-name">{{ $product->name }}</div>
                                <div class="prod-desc">{{ \Illuminate\Support\Str::limit($product->description ?? '', 60) }}</div>
                            </td>
                            <td class="prod-price">&#8369;{{ number_format($product->price, 2) }}</td>
                            <td style="text-align:center;">
                                @if($product->stock > 0)
                                    <span class="stock-pill in">{{ $product->stock }}</span>
                                @else
                                    <span class="stock-pill out">Out of stock</span>
                                @endif
                            </td>
                            <td class="row-actions">
                                <a href="{{ route('hoop.admin.products.edit', $product->id) }}" class="icon-btn"><i class="fa fa-edit"></i></a>
                                <a href="{{ route('hoop.admin.products.destroy', $product->id) }}" class="icon-btn danger" onclick="return confirm('Delete this product?')"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="empty-row">No products yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
            @if($products->hasPages())
                <div class="pagination-wrap">
                    {{ $products->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection