@extends('adminlte::page')

@section('content')

    <x-alert />

    <div class="card">
        <div class="card-header border-bottom-0">
            <h3 class="card-title text-bold" style="font-size:1.4rem">All Sales</h3>
        </div>
        <div class="card-body p-0 border-top-0">
            <table class="table table-bordered border-top-0">
                <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Order</th>
                    <th>Payment Method</th>
                    <th>Total</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sales as $sale)
                    <tr>
                        <td>{{ $sale->id }}</td>
                        <td>
                            <a href="{{ route('admin.orders.edit', $sale->order_id) }}">
                                Order for {{ $sale->order->customer->name ?? 'General' }}
                            </a>
                        </td>
                        <td>{{ $sale->payment_method }}</td>
                        <td>Rs. {{ $sale->total }}</td>
                        <td>{{ $sale->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @if($sales->total() > 30)
        <div class="card-footer">
            {{ $sales->links() }}
        </div>
        @endif
    </div>
@stop
