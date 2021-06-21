@extends('adminlte::page')

@section('title', 'Update Order')
@section('plugins.Select2', true)

@section('js')
    <script>

        $(document).ready(function() {
           $('#product_id').select2();
        });

        $(document).ready(function() {
           $('#customer_id').select2();
        });

        function increaseQty() {
            let qty = Number(document.getElementById('quantity').value);
            document.getElementById('quantity').value = qty + 1;
        }

        function decreaseQty() {
            let qty = Number(document.getElementById('quantity').value);
            if (qty <= 1) return;
            document.getElementById('quantity').value = qty - 1;
        }

    </script>
@endsection

@section('content')
<x-alert />

<div class="card">
    <div class="card-header border-bottom-0">
        <h3 class="card-title text-bold" style="font-size:1.4rem">Update Order</h3>
        <div class="card-tools">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-info">
                <i class="fas fa-fw fa-arrow-left mr-1"></i>
                <span>Go Back</span>
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label for="customer_id">Customer </label>
                    <select
                        name="customer_id" id="customer_id"
                        class="form-control @error('customer_id') is-invalid @enderror"
                    >
                        <option value="">Unknown Customer</option>
                        @foreach($customers as $customer)
                            <option
                                value="{{ $customer->id }}"
                                @if($order->customer_id == $customer->id) selected @endif
                            >{{ $customer->name }}</option>
                        @endforeach
                    </select>

                    @error('customer_id')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
            </div>

            <div class="form-group">
                <label for="product_id">Product </label>
                    <select
                        name="product_id" id="product_id"
                        class="form-control @error('product_id') is-invalid @enderror"
                    >

                        @foreach($products as $product)
                            <option
                                value="{{ $product->id }}"
                                @if($order->product_id == $product->id) selected @endif
                            >{{ $product->name }} / Rs.{{ $product->price }}</option>
                        @endforeach
                    </select>

                    @error('product_id')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
            </div>

            <div class="form-group col-12 col-md-3">
                <label for="quantity">Quantity</label>
                <div class="input-group">
                    <div class="input-group-append">
                        <button type="button" class="input-group-text" onclick="decreaseQty()">
                            <i class="fa fa-minus fa-fw"></i>
                        </button>
                    </div>

                    <input
                        type="text"
                        name="quantity" id="quantity"
                        value="{{ old('quantity') ?? $order->quantity }}"
                        style="text-align: center;font-weight: bold"
                        class="form-control @error('quantity') is-invalid @enderror"
                    >

                    <div class="input-group-prepend">
                        <button type="button" class="input-group-text" onclick="increaseQty()">
                            <i class="fa fa-plus fa-fw"></i>
                        </button>
                    </div>

                </div>
                @error('quantity')
                <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>


            <div class="mt-4 mb-1">
                <input type="submit" class="btn btn-primary" value="Update Order">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-link float-right">Cancel</a>
            </div>
        </form>
    </div>
</div>
@stop
