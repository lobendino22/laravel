@extends('layouts.app')
@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .cart-page {
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
    }
    .cart-container { max-width: 920px; margin: 0 auto; padding: 40px 20px 60px; }

    .cart-brand { text-align: center; margin-bottom: 30px; }
    .cart-brand img { height: 46px; width: auto; margin-bottom: 8px; }
    .cart-brand h1 {
        font-family: 'Barlow Condensed', sans-serif;
        font-weight: 800; letter-spacing: 2px; color: var(--ink) !important;
        margin: 10px 0 2px; font-size: 1.9rem;
    }
    .cart-brand p { color: var(--muted); font-size: 0.95rem; margin: 0; }

    .cart-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; }
    .cart-header h3 { font-family: 'Barlow Condensed', sans-serif; font-weight: 700; font-size: 1.4rem; color: var(--ink) !important; margin: 0; }
    .cart-header a { color: var(--muted); text-decoration: none; font-size: 0.9rem; }
    .cart-header a:hover { color: var(--accent); }

    .select-bar {
        display: flex; align-items: center; justify-content: space-between;
        background: var(--surface); border: 1px solid var(--line); border-radius: 8px 8px 0 0;
        padding: 12px 20px;
    }
    .select-all { display: flex; align-items: center; gap: 10px; font-size: 0.88rem; color: #c9c1b0 !important; font-weight: 600; }
    .select-count { color: var(--muted); font-size: 0.85rem; }
    .select-count strong { color: var(--accent); }

    .cart-table-wrap { border: 1px solid var(--line); border-top: none; border-radius: 0 0 8px 8px; overflow: hidden; background: var(--surface); }
    .cart-table { width: 100%; border-collapse: collapse; }
    .cart-table th {
        text-align: left; padding: 14px 20px; background: var(--surface-2);
        font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.6px;
        color: var(--muted); font-weight: 600; border-bottom: 1px solid var(--line);
    }
    .cart-table td { padding: 14px 20px; border-bottom: 1px solid var(--line); vertical-align: middle; }
    .cart-table tr:last-child td { border-bottom: none; }
    .cart-table tr.is-unselected { opacity: 0.45; }

    /* custom checkbox */
    .chk {
        appearance: none; -webkit-appearance: none;
        width: 20px; height: 20px; border: 1px solid var(--line);
        border-radius: 5px; background: var(--bg); cursor: pointer;
        position: relative; flex-shrink: 0;
        transition: border-color 0.15s, background 0.15s;
    }
    .chk:checked { background: var(--accent); border-color: var(--accent); }
    .chk:checked::after {
        content: "\f00c"; font-family: "FontAwesome"; color: #fff;
        font-size: 11px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
    }
    .chk:focus { outline: none; box-shadow: 0 0 0 3px rgba(226,97,29,0.2); }

    .cart-product { display: flex; align-items: center; gap: 14px; }
    .cart-product-img { width: 58px; height: 58px; border-radius: 8px; object-fit: cover; background: var(--surface-2); }
    .cart-product-img-placeholder {
        width: 58px; height: 58px; border-radius: 8px; background: var(--surface-2);
        display: flex; align-items: center; justify-content: center; color: #5a5348;
    }
    .cart-product-name { font-weight: 600; color: var(--ink) !important; font-size: 0.95rem; }

    .cart-price { color: var(--muted); font-size: 0.92rem; }
    .cart-qty-input {
        width: 64px; padding: 8px 10px; border: 1px solid var(--line); border-radius: 6px;
        text-align: center; font-size: 0.9rem; background: var(--bg); color: var(--ink);
        transition: border-color 0.15s;
    }
    .cart-qty-input:focus { outline: none; border-color: var(--accent); }

    .cart-subtotal { font-weight: 700; color: var(--ink) !important; text-align: right; font-size: 1rem; font-variant-numeric: tabular-nums; }
    .cart-remove { color: var(--muted); text-decoration: none; transition: color 0.15s; }
    .cart-remove:hover { color: var(--red); }

    .cart-footer {
        display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;
        margin-top: 22px; padding: 22px 22px; background: var(--surface); border: 1px solid var(--line); border-radius: 8px;
    }
    .cart-total-label { color: var(--muted); font-size: 0.95rem; font-weight: 500; }
    .cart-total-price {
        font-family: 'Barlow Condensed', sans-serif;
        font-weight: 800; font-size: 1.7rem; color: var(--accent) !important; margin-left: 8px;
    }
    .cart-total-note { display: block; color: var(--muted); font-size: 0.78rem; margin-top: 2px; }

    .cart-btn {
        padding: 12px 24px; border-radius: 8px; font-weight: 600; font-size: 0.92rem;
        transition: all 0.15s; text-decoration: none; display: inline-block; border: none; cursor: pointer;
    }
    .cart-btn-update { background: transparent; border: 1px solid var(--line); color: var(--ink) !important; }
    .cart-btn-update:hover { background: var(--surface-2); border-color: #4a443b; color: var(--ink) !important; }
    .cart-btn-checkout { background: var(--accent); color: #fff !important; }
    .cart-btn-checkout:hover:not(:disabled) { background: #c8530f; color: #fff !important; }
    .cart-btn-checkout:disabled { background: var(--surface-2); color: var(--muted) !important; cursor: not-allowed; }

    .cart-empty { text-align: center; padding: 60px 20px; background: var(--surface); border: 1px solid var(--line); border-radius: 8px; }
    .cart-empty-icon { font-size: 2.6rem; color: #4a443b; margin-bottom: 14px; }
    .cart-empty h3 { color: var(--ink) !important; margin-bottom: 6px; }
    .cart-empty p { color: var(--muted); margin-bottom: 18px; font-size: 1rem; }
    .cart-shop-link { color: var(--accent); font-weight: 600; text-decoration: none; }
    .cart-shop-link:hover { text-decoration: underline; }

    @media (max-width: 680px) {
        .cart-table thead { display: none; }
        .cart-table, .cart-table tbody, .cart-table tr, .cart-table td { display: block; width: 100%; }
        .cart-table tr { padding: 14px 20px; }
        .cart-table td { padding: 6px 0; border-bottom: none; }
        .cart-table td:first-child { display: flex; align-items: center; gap: 12px; }
        .cart-subtotal { text-align: left; }
    }
</style>

<div class="cart-page">
    <div class="cart-container">
        <div class="cart-brand">
            <img src="{{ asset('img/hoopzone.png') }}" alt="HoopZone">
            <h1>HOOP ZONE</h1>
            <p>Shopping cart</p>
        </div>

        <div class="cart-header">
            <h3>Shopping cart</h3>
            <a href="{{ route('hoop-shop') }}">
                <i class="fa fa-arrow-left"></i> Continue shopping
            </a>
        </div>

        @if(empty($items))
            <div class="cart-empty">
                <div class="cart-empty-icon">
                    <i class="fa fa-shopping-bag"></i>
                </div>
                <p>Your cart is empty</p>
                <a href="{{ route('hoop-shop') }}" class="cart-shop-link">Browse products</a>
            </div>
        @else
            <form method="POST" action="{{ route('hoop.checkout') }}" id="cart-form">
                @csrf

                <div class="select-bar">
                    <label class="select-all">
                        <input type="checkbox" class="chk" id="select-all">
                        Select all
                    </label>
                    <span class="select-count"><strong id="selected-count">0</strong> of {{ count($items) }} selected</span>
                </div>

                <div class="cart-table-wrap">
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th style="width:40px;"></th>
                                <th>Product</th>
                                <th class="text-center">Unit price</th>
                                <th class="text-center">Qty</th>
                                <th class="text-right">Subtotal</th>
                                <th class="text-right"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr data-row data-product-id="{{ $item['product']->id }}" data-subtotal="{{ $item['subtotal'] }}">
                                    <td>
                                        <input type="checkbox" class="chk item-check" name="selected[]" value="{{ $item['product']->id }}" checked>
                                    </td>
                                    <td>
                                        <div class="cart-product">
                                            @if($item['product']->photo)
                                                <img src="{{ $item['product']->photo_url }}" alt="" class="cart-product-img">
                                            @else
                                                <div class="cart-product-img-placeholder">
                                                    <i class="fa fa-basketball-ball"></i>
                                                </div>
                                            @endif
                                            <span class="cart-product-name">{{ $item['product']->name }}</span>
                                        </div>
                                    </td>
                                    <td class="cart-price text-center">&#8369;{{ number_format($item['product']->price, 2) }}</td>
                                    <td class="text-center">
                                        <input type="number" name="qty[{{ $item['product']->id }}]" value="{{ $item['qty'] }}"
                                               min="0" max="{{ $item['product']->stock }}" class="cart-qty-input">
                                    </td>
                                    <td class="cart-subtotal">&#8369;{{ number_format($item['subtotal'], 2) }}</td>
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
                </div>

                <div class="cart-footer">
                    <div>
                        <span class="cart-total-label">Selected total:</span>
                        <span class="cart-total-price" id="selected-total">&#8369;0.00</span>
                        <span class="cart-total-note">Unchecked items stay in your cart after checkout.</span>
                    </div>
                    <div>
                        <button type="submit" formaction="{{ route('hoop.cart.update') }}" class="cart-btn cart-btn-update">Update cart</button>
                        <button type="submit" formaction="{{ route('hoop.checkout.start') }}" id="checkout-btn" class="cart-btn cart-btn-checkout" style="margin-left:10px;">
                            Checkout <i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </form>
        @endif
    </div>
</div>

<script>
(function () {
    var selectAll = document.getElementById('select-all');
    var checkboxes = Array.from(document.querySelectorAll('.item-check'));
    var totalEl = document.getElementById('selected-total');
    var countEl = document.getElementById('selected-count');
    var checkoutBtn = document.getElementById('checkout-btn');

    function peso(n) {
        return '\u20b1' + n.toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function recalc() {
        var total = 0, selected = 0;
        checkboxes.forEach(function (cb) {
            var row = cb.closest('[data-row]');
            var checked = cb.checked;
            row.classList.toggle('is-unselected', !checked);
            if (checked) {
                total += parseFloat(row.dataset.subtotal) || 0;
                selected++;
            }
        });
        totalEl.textContent = peso(total);
        countEl.textContent = selected;
        checkoutBtn.disabled = selected === 0;
        selectAll.checked = selected === checkboxes.length;
        selectAll.indeterminate = selected > 0 && selected < checkboxes.length;
    }

    checkboxes.forEach(function (cb) { cb.addEventListener('change', recalc); });
    selectAll.addEventListener('change', function () {
        checkboxes.forEach(function (cb) { cb.checked = selectAll.checked; });
        recalc();
    });

    document.getElementById('cart-form').addEventListener('submit', function (e) {
        if (e.submitter && e.submitter.id === 'checkout-btn') {
            var anyChecked = checkboxes.some(function (cb) { return cb.checked; });
            if (!anyChecked) {
                e.preventDefault();
                alert('Select at least one item to check out.');
            }
        }
    });

    recalc();
})();
</script>
@endsection