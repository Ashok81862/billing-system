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
                    <th>Product</th>
                    <th>Quantity</th>
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
                            Unknown
                        @endif
                    </td>
                    <td>{{ $order->product->name }}/{{ $order->product->price }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>
                        <!-- Show -->
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-fw fa-eye mr-1"></i>
                            <span>Show</span>
                        </a>

                        <!-- Edit -->
                        <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-fw fa-edit mr-1"></i>
                            <span>Edit</span>
                        </a>

                        <!-- Delete -->
                        <a href="#" onclick="confirmDelete({{ $order->id }})" class="btn btn-danger btn-sm">
                            <i class="fas fa-fw fa-edit mr-1"></i>
                            <span>Delete</span>
                        </a>

                        <!-- Delete Form -->
                        <form id="delete-form-{{ $order->id }}" action="{{ route('admin.orders.destroy', $order->id) }}" method="post">
                            @csrf @method('DELETE')
                        </form>
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
