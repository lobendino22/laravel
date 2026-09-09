@extends('layouts.app')
@section('content')
<x-page-header pagetitle="{{ isset($product) ? 'Edit Product' : 'Add Product' }}" class="bg-info"/>
<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <form method="POST"
              action="{{ isset($product) ? route('hoop.admin.products.update', $product->id) : route('hoop.admin.products.store') }}"
              enctype="multipart/form-data">
            @csrf
            @if(isset($product))
                @method('PUT')
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="name">Product name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name ?? '') }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', $product->description ?? '') }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="price">Price (₱)</label>
                        <input type="number" name="price" id="price" step="0.01" min="0" class="form-control" value="{{ old('price', $product->price ?? '') }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="stock">Stock</label>
                        <input type="number" name="stock" id="stock" min="0" class="form-control" value="{{ old('stock', $product->stock ?? '') }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="photo">Photo</label>
                        <input type="file" name="photo" id="photo" class="form-control">
                        @if(isset($product) && $product->photo)
                            <small class="text-muted">Current: {{ $product->photo }}</small>
                        @endif
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary">{{ isset($product) ? 'Update' : 'Save' }}</button>
                    <a href="{{ route('hoop.admin.products') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection