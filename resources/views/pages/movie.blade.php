@extends('layouts.app')
@section('content')
<x-page-header pagetitle="Movie" class="bg-primary"/>
<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="middle-box text-center">
            <h3 class="font-bold">This is the Movie Page</h3>
            <div class="error-desc">
                Movie Title: {{ $title }}
                <br/><a href="{{ route('dashboard') }}" class="btn btn-primary m-t">Back to Dashboard</a>
            </div>
        </div>
    </div>
</div>
@endsection
