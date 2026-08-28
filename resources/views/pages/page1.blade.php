@extends('layouts.app')
@section('content')
<x-page-header pagetitle="Page 1" class="bg-primary"/>
<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="middle-box text-center">
            <h3 class="font-bold">This is Page 1</h3>
            <div class="error-desc">
                Artist: {{ $artist }}
                <br/><a href="{{ route('dashboard') }}" class="btn btn-primary m-t">Back to Dashboard</a>
            </div>
        </div>
    </div>
</div>
@endsection