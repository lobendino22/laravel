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
        --red: #e0705a;
        --surface: #26231f;
        --surface-2: #2e2a25;
        background: var(--paper);
        min-height: 100vh;
        font-family: 'Inter', system-ui, sans-serif;
        color: var(--ink);
    }
    .admin-header {
        background: #14110e;
        color: #fff;
        padding: 22px 28px;
    }
    .admin-header-row {
        max-width: 820px;
        margin: 0 auto;
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
    .admin-body { max-width: 820px; margin: 0 auto; padding: 28px 28px 60px; }
    .admin-card {
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: 8px;
        padding: 28px 30px;
    }
    .alert-danger {
        background: rgba(201,106,84,0.12);
        border: 1px solid rgba(201,106,84,0.4);
        color: var(--red);
        border-radius: 6px;
        padding: 12px 16px;
        font-size: 0.9rem;
        margin-bottom: 20px;
    }
    .field { margin-bottom: 20px; }
    .field label {
        display: block;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--muted) !important;
        margin-bottom: 6px;
    }
    .field .form-control {
        border: 1px solid var(--line);
        border-radius: 6px;
        padding: 9px 12px;
        font-size: 0.95rem;
        color: var(--ink) !important;
        background: var(--surface);
        width: 100%;
        transition: border-color 0.15s, box-shadow 0.15s;
    }
    .field .form-control:focus {
        outline: none;
        border-color: var(--orange);
        box-shadow: 0 0 0 3px rgba(226,97,29,0.12);
    }
    .field small.text-muted { display: block; margin-top: 6px; font-size: 0.8rem; color: var(--muted) !important; }

    .toggle-group { display: flex; gap: 8px; margin-bottom: 12px; }
    .toggle-group input { position: absolute; opacity: 0; pointer-events: none; }
    .toggle-group label {
        display: inline-flex;
        align-items: center;
        padding: 7px 14px;
        border: 1px solid var(--line);
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        color: var(--muted);
        cursor: pointer;
        margin: 0;
        transition: border-color 0.15s, color 0.15s, background 0.15s;
    }
    .toggle-group label:has(input:checked) {
        border-color: var(--orange);
        color: var(--orange);
        background: rgba(226,97,29,0.06);
        font-weight: 600;
    }

    .current-photo {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 10px;
    }
    .current-photo img {
        border: 1px solid var(--line);
        border-radius: 6px;
        max-height: 64px;
        max-width: 90px;
        object-fit: cover;
    }
    .current-photo small { color: var(--muted); }

    .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 26px;
        padding-top: 22px;
        border-top: 1px solid var(--line);
    }
    .btn-save {
        background: var(--orange);
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 10px 22px;
        font-weight: 600;
        font-size: 0.92rem;
        cursor: pointer;
        transition: background 0.15s;
    }
    .btn-save:hover { background: #c8530f; color: #fff; }
    .btn-cancel {
        background: transparent;
        color: var(--ink);
        border: 1px solid var(--line);
        border-radius: 6px;
        padding: 10px 20px;
        font-weight: 600;
        font-size: 0.92rem;
        text-decoration: none;
    }
    .btn-cancel:hover { border-color: #4a443b; color: var(--ink); }
</style>

<div class="admin-shell">
    <div class="admin-header">
        <div class="admin-header-row">
            <a href="{{ route('hoop.admin.products') }}" class="admin-back-link">
                <i class="fa fa-arrow-left"></i> Back to products
            </a>
            <div class="admin-title">{{ isset($product) ? 'Edit product' : 'Add product' }}</div>
        </div>
    </div>

    <div class="admin-body">
        <div class="admin-card">
            <form method="POST"
                  action="{{ isset($product) ? route('hoop.admin.products.update', $product->id) : route('hoop.admin.products.store') }}"
                  enctype="multipart/form-data">
                @csrf
                @if(isset($product))
                    @method('PUT')
                @endif

                @if($errors->any())
                    <div class="alert-danger">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <div class="field">
                    <label for="name">Product name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name ?? '') }}" required>
                </div>

                <div class="field">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', $product->description ?? '') }}</textarea>
                </div>

                <div class="field">
                    <label for="price">Price (&#8369;)</label>
                    <input type="number" name="price" id="price" step="0.01" min="0" class="form-control" value="{{ old('price', $product->price ?? '') }}" required>
                </div>

                <div class="field">
                    <label for="stock">Stock</label>
                    <input type="number" name="stock" id="stock" min="0" class="form-control" value="{{ old('stock', $product->stock ?? '') }}" required>
                </div>

                @php
                    $hasPhoto = isset($product) && $product->photo;
                    $isExternal = $hasPhoto && (str_starts_with($product->photo, 'http://') || str_starts_with($product->photo, 'https://'));
                    $imageSource = old('image_source', $isExternal ? 'url' : 'upload');
                    $imageUrl = old('image_url', $isExternal ? $product->photo : '');
                @endphp

                <div class="field">
                    <label>Product image</label>
                    <div class="toggle-group">
                        <label>
                            <input type="radio" name="image_source" value="upload" {{ $imageSource === 'upload' ? 'checked' : '' }}>
                            Upload image
                        </label>
                        <label>
                            <input type="radio" name="image_source" value="url" {{ $imageSource === 'url' ? 'checked' : '' }}>
                            Use an image link
                        </label>
                    </div>

                    <div id="photo-upload-field" style="{{ $imageSource === 'upload' ? '' : 'display: none;' }}">
                        <input type="file" name="photo" id="photo" class="form-control">
                        <small class="text-muted">JPG, PNG, GIF or WEBP &mdash; max 2 MB.</small>
                    </div>
                    <div id="photo-url-field" style="{{ $imageSource === 'url' ? '' : 'display: none;' }}">
                        <input type="url" name="image_url" id="image_url" class="form-control"
                               placeholder="https://example.com/product-photo.jpg" value="{{ $imageUrl }}">
                        <small class="text-muted">Paste a direct image link. On Google Images: right-click the photo &rarr; Copy image address.</small>
                    </div>

                    @if($hasPhoto)
                        <div class="current-photo">
                            <img src="{{ $product->photo_url }}" alt="Current photo">
                            <small>Current image</small>
                        </div>
                    @endif
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-save">{{ isset($product) ? 'Update product' : 'Save product' }}</button>
                    <a href="{{ route('hoop.admin.products') }}" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    (function () {
        var uploadField = document.getElementById('photo-upload-field');
        var urlField = document.getElementById('photo-url-field');
        var radios = document.querySelectorAll('input[name="image_source"]');
        radios.forEach(function (radio) {
            radio.addEventListener('change', function () {
                uploadField.style.display = radio.value === 'upload' ? '' : 'none';
                urlField.style.display = radio.value === 'url' ? '' : 'none';
            });
        });
    })();
</script>
@endsection