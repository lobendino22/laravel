@extends('layouts.app')
@section('content')
@if(Session::has('success'))
<p class="alert alert-success">{{ Session::get('success') }}</p>
@endif
<x-page-header pagetitle="Manage Books" class="bg-info"/>
<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <a href="{{ url('/book-form') }}" class="btn btn-primary mb-3">Add Book</a>
        <div class="row">
            @foreach($data as $d)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img class="card-img-top" src="{{ asset('_uploads/'.$d->photo) }}" alt="Book Image"
                        style="width:100%">
                    <div class="card-body">
                        <h5 class="card-title">{{ $d->title }}</h5>
                        <p class="card-text">
                            Country ID: {{ $d->country_id }}<br>
                            Stock: {{ $d->stock }}<br>
                            Price: ₱{{ number_format($d->amount, 2) }}
                        </p>
                        <a href="{{ url('/edit-book/'.$d->id) }}" class="btn btn-info btn-sm" onclick="return
                            confirm('Update this book?')"><i class="fa fa-edit"></i></a>
                        <form action="{{ url('/delete-book/'.$d->id) }}" method="post" style="display:inline;" onsubmit="return confirm('Delete this book?')">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
