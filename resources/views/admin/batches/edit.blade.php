@extends('adminlte::page')

@section('title', 'Edit Batch')
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
            if(qty <= 1) return;
            document.getElementById('quantity').value = qty - 1;
        }

    </script>
@endsection

@section('content')
<x-alert />

<div class="card">
    <div class="card-header border-bottom-0">
        <h3 class="card-title text-bold" style="font-size:1.4rem">Edit Batch </h3>
        <div class="card-tools">
            <a href="{{ route('admin.batches.index') }}" class="btn btn-sm btn-info">
                <i class="fas fa-fw fa-arrow-left mr-1"></i>
                <span>Go Back</span>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card-body">
                <form action="{{ route('admin.batches.products.store', $batch->id) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="form-group">
                        <label for="product_id">Products </label>
                            <select
                                name="product_id" id="product_id"
                                class="form-control @error('product_id') is-invalid @enderror"
                            >
                                @foreach($products as $product)
                                    <option
                                        value="{{ $product->id }}"
                                        @if(old('product_id') == $product->id) selected @endif
                                    >{{ $product->name }}</option>
                                @endforeach
                            </select>

                            @error('product_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                    </div>

                    <div class="form-group">
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
                                value="{{ old('quantity') ?? 1 }}"
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

                    <div class="form-group">
                        <label for="unit_price">Unit Price</label>
                        <input
                            type="text"
                            name="unit_price" id="unit_price"
                            value="{{ old('unit_price') ?? '' }}"
                            class="form-control @error('unit_price') is-invalid @enderror"
                            autofocus
                        >
                        @error('unit_price')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>



                    <div class="mt-4 mb-1">
                        <input type="submit" class="btn btn-primary" value="Update Batch">
                        <a href="{{ route('admin.batches.index') }}" class="btn btn-link float-right">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="col">
            <table class="table table-bordered border-top-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($batch->batchProducts as $batchProduct)
                        <tr>
                            <td>{{ $batchProduct->product->name }}</td>
                            <td>{{ $batchProduct->quantity }}</td>
                            <td>{{ $batchProduct->unit_price }}</td>
                            <td>
                                 <!-- Delete -->
                                <a href="#" onclick="confirmDelete({{ $batchProduct->id }})" class="btn btn-danger btn-sm">
                                    <i class="fas fa-fw fa-edit mr-1"></i>
                                    <span>Delete</span>
                                </a>

                                <!-- Delete Form -->
                                <form id="delete-form-{{ $batchProduct->id }}" action="{{ route('admin.batches.products.remove', $batch->id) }}" method="post">
                                    <input type="hidden" name="product_id" value="{{ $batchProduct->id }}">
                                    @csrf @method('DELETE')
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td style="border-top:2px solid #444;text-align:right;font-weight:bold" colspan="3">
                            Total : Rs. {{ $batch->total }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
