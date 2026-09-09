@extends('layouts.app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Hoop Shop</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Hoop Shop</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <a href="{{ route('hoop-shop') }}" class="btn btn-primary">View Shop</a>
        </div>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="middle-box text-center">
            <h3 class="font-bold">Welcome to the Hoop Shop!</h3>
            <div class="error-desc">
                Your one-stop shop for hoops, gear, and more.
                <br/><a href="{{ route('hoop-shop') }}" class="btn btn-primary m-t">Browse Products</a>
            </div>
        </div>
    </div>
</div>
@endsection
