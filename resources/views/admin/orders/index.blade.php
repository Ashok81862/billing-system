@extends('adminlte::page')

@section('title', 'All Orders')

@section('content')
<x-alert />
<x-delete />


<div class="card">
    <div class="card-header border-bottom-0">
        <h3 class="card-title text-bold" style="font-size:1.4rem">All Orders</h3>
        <div class="card-tools">
            <a href="{{ route('admin.orders.create') }}" class="btn btn-sm btn-info">
                <i class="fas fa-fw fa-plus-circle mr-1"></i>
                <span>Add New</span>
            </a>
        </div>
    </div>
    <div class="card-body p-0 border-top-0">
        <table class="table table-bordered border-top-0">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Products</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>
                        @if($order->customer_id)
                            {{ $order->customer->name }}
                        @else
                            General
                        @endif
                    </td>
                    <td>
                        @if($order->products)
                            {{ $order->products->count()}}
                        @else
                            No Product
                        @endif
                    </td>
                    <td>Rs. {{ $order->total }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>
                        <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @if($orders->total() >10)
    <div class="card-footer">
        {{ $orders->links() }}
    </div>
    @endif
</div>
@stop
