@extends('layouts.app')
@section('content')
<style>
.admin-breadcrumb { display: flex; align-items: center; gap: 10px; margin: 18px 0 6px; }
.admin-back-link { display: inline-flex; align-items: center; gap: 8px; text-decoration: none; color: #64748b; font-weight: 600; font-size: 0.9rem; transition: color 0.2s; }
.admin-back-link:hover { color: #1ab394; }
.admin-back-link i { color: #9aa4b2; }
</style>
<div class="admin-breadcrumb">
    <a href="{{ route('hoop.admin.dashboard') }}" class="admin-back-link">
        <i class="fa fa-arrow-left"></i>
        Back to Admin
    </a>
</div>
<x-page-header pagetitle="Manage Products" class="bg-info"/>
<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <a href="{{ route('hoop.admin.products.create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Add Product</a>
        <div class="ibox">
            <div class="ibox-content">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th class="text-right">Price</th>
                            <th class="text-center">Stock</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>
                                    @if($product->photo)
                                        <img src="{{ asset('_uploads/' . $product->photo) }}" alt="" style="width:60px;height:60px;object-fit:cover;">
                                    @else
                                        <div class="bg-secondary" style="width:60px;height:60px;"></div>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $product->name }}</strong>
                                    <br><small class="text-muted">{{ \Illuminate\Support\Str::limit($product->description ?? '', 60) }}</small>
                                </td>
                                <td class="text-right">₱{{ number_format($product->price, 2) }}</td>
                                <td class="text-center">
                                    @if($product->stock > 0)
                                        <span class="badge badge-success">{{ $product->stock }}</span>
                                    @else
                                        <span class="badge badge-danger">Out of stock</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('hoop.admin.products.edit', $product->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('hoop.admin.products.destroy', $product->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Delete this product?')"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center text-muted">No products yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection