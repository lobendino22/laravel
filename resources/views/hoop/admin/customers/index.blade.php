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
<x-page-header pagetitle="Manage Customers" class="bg-info"/>
<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <a href="{{ route('hoop.admin.customers.create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Add Customer</a>
        <div class="ibox">
            <div class="ibox-content">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Joined</th>
                            <th>Orders</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                            <tr>
                                <td><strong>{{ $customer->name }}</strong></td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->created_at->format('M d, Y') }}</td>
                                <td><span class="badge badge-primary">{{ $customer->orders()->count() }}</span></td>
                                <td class="text-right">
                                    <a href="{{ route('hoop.admin.customers.edit', $customer->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('hoop.admin.customers.destroy', $customer->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Delete this customer and their orders?')"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center text-muted">No customers yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection