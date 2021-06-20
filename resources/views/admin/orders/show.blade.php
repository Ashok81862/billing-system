@extends('adminlte::page')

@section('title', 'Order Details')

@section('content')

    <x-alert />

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold" style="font-size:1.4rem">Order Details</h3>
            <div class="card-tools">
                <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-fw fa-edit mr-1"></i>
                    <span>Edit</span>
                </a>

                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-info">
                    <i class="fas fa-fw fa-arrow-left mr-1"></i>
                    <span>Go Back</span>
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered">
                <tr>
                    <td>ID</td>
                    <td>{{ $order->id }}</td>
                </tr>
                <tr>
                    <td>Customer</td>
                    <td>
                        @if($order->customer_id)
                            {{ $order->customer->name }}
                        @else
                            Unknown
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Product</td>
                    <td>{{ $order->product->name }}</td>
                </tr>
                <tr>
                    <td>Quantity</td>
                    <td>{{ $order->quantity }}</td>
                </tr>
                <tr>
                    <td>Created At</td>
                    <td>{{ $order->created_at }}</td>
                </tr>
                <tr>
                    <td>Updated At</td>
                    <td>{{ $order->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>
@stop
