@extends('layouts.app')
@section('content')
<x-page-header pagetitle="Book" class="bg-primary"/>
<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="middle-box text-center">
            <h3 class="font-bold">This is the Book Page</h3>
            <div class="error-desc">
                Book Title: {{ $title }}
                <br/><a href="{{ route('dashboard') }}" class="btn btn-primary m-t">Back to Dashboard</a>
            </div>
        </div>
    </div>
</div>
@endsection
