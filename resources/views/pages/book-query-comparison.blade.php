@extends('layouts.app')

@section('content')
<x-page-header pagetitle="Query Builder vs. Eloquent" class="bg-info"/>

<div class="container py-4">
    <form method="GET" action="{{ url('/book-query-comparison') }}" class="row g-2 mb-4">
        <div class="col-md-3">
            <input type="text" name="search" class="form-control" placeholder="Search book title..." value="{{ $search }}">
        </div>
        <div class="col-md-2">
            <label class="form-check mt-2">
                <input class="form-check-input" type="checkbox" name="low_stock" value="1" {{ $lowStock ? 'checked' : '' }}>
                <span class="form-check-label text-white">Low Stock</span>
            </label>
        </div>
        <div class="col-md-2">
            <label class="form-label mt-2 text-white">Stock Limit:</label>
            <input type="number" name="stock_limit" class="form-control" value="{{ $stockLimit }}" min="0" max="1000">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ url('/book-query-comparison') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <h4 class="text-white">Laravel Query Builder</h4>
            <p class="text-white">Records: {{ $queryBuilderBooks->count() }}</p>
            @forelse($queryBuilderBooks as $book)
                <div class="card mb-2">
                    <div class="card-body">
                        <h5>{{ $book->title }}</h5>
                        <p class="mb-0">Stock: {{ $book->stock }}</p>
                        <p class="mb-0">Price: ₱{{ number_format($book->amount, 2) }}</p>
                    </div>
                </div>
            @empty
                <p class="text-white">No books found.</p>
            @endforelse
        </div>

        <div class="col-lg-6 mb-4">
            <h4 class="text-white">Eloquent ORM</h4>
            <p class="text-white">Records: {{ $eloquentBooks->count() }}</p>
            @forelse($eloquentBooks as $book)
                <div class="card mb-2">
                    <div class="card-body">
                        <h5>{{ $book->title }}</h5>
                        <p class="mb-0">Stock: {{ $book->stock }}</p>
                        <p class="mb-0">Price: ₱{{ number_format($book->amount, 2) }}</p>
                    </div>
                </div>
            @empty
                <p class="text-white">No books found.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection