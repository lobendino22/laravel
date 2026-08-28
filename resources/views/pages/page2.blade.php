@extends('layouts.app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Page 2</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Page 2</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <a href="" class="btn btn-primary">Actions</a>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="middle-box text-center">
            <h3 class="font-bold">This is Page 2</h3>
            <div class="error-desc">
                You can create here any grid layout you want. And any variation layout you imagine:)
                <br/><a href="{{ route('dashboard') }}" class="btn btn-primary m-t">Back to Dashboard</a>
            </div>
        </div>
    </div>
</div>
@endsection
