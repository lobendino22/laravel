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
<x-page-header pagetitle="Manage Orders" class="bg-info"/>
<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="ibox">
            <div class="ibox-content">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Customer</th>
                            <th>Items</th>
                            <th class="text-right">Total</th>
                            <th>Status</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>
                                    <strong>#{{ $order->id }}</strong>
                                    <br><small class="text-muted">{{ $order->created_at->format('M d, Y h:i A') }}</small>
                                </td>
                                <td>
                                    {{ $order->user->name ?? 'Deleted user' }}
                                    <br><small class="text-muted">{{ $order->phone }}<br>{{ $order->address }}</small>
                                    @if($order->note)
                                        <br><small class="text-info"><i class="fa fa-sticky-note-o"></i> {{ $order->note }}</small>
                                    @endif
                                </td>
                                <td>
                                    @foreach($order->items as $item)
                                        {{ $item->product_name }} ({{ $item->quantity }})<br>
                                    @endforeach
                                </td>
                                <td class="text-right">₱{{ number_format($order->total, 2) }}</td>
                                <td>
                                    <form method="POST" action="{{ route('hoop.admin.orders.status', $order->id) }}" class="form-inline">
                                        @csrf
                                        <select name="status" class="form-control form-control-sm mr-1" onchange="this.form.submit()">
                                            @foreach($statuses as $status)
                                                <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>{{ $status }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('hoop.admin.orders.destroy', $order->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Delete this order?')"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted">No orders yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection