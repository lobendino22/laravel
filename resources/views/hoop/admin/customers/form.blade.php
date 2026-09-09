@extends('layouts.app')
@section('content')
<x-page-header pagetitle="{{ isset($customer) ? 'Edit Customer' : 'Add Customer' }}" class="bg-info"/>
<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <form method="POST"
              action="{{ isset($customer) ? route('hoop.admin.customers.update', $customer->id) : route('hoop.admin.customers.store') }}">
            @csrf
            @if(isset($customer))
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
                        <label for="name">Full name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $customer->name ?? '') }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $customer->email ?? '') }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">
                            Password
                            @if(isset($customer))
                                <small class="text-muted">(leave blank to keep current)</small>
                            @endif
                        </label>
                        <input type="password" name="password" id="password" class="form-control" {{ isset($customer) ? '' : 'required' }}>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password_confirmation">Confirm password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" {{ isset($customer) ? '' : 'required' }}>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary">{{ isset($customer) ? 'Update' : 'Save' }}</button>
                    <a href="{{ route('hoop.admin.customers') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection