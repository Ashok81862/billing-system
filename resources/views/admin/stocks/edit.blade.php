@extends('adminlte::page')

@section('title', 'Update Stock')

@section('plugins.Select2', true)

@section('content')
<x-alert />

<div class="card">
    <div class="card-header border-bottom-0">
        <h3 class="card-title text-bold" style="font-size:1.4rem">Update Stock</h3>
        <div class="card-tools">
            <a href="{{ route('admin.stocks.index') }}" class="btn btn-sm btn-info">
                <i class="fas fa-fw fa-arrow-left mr-1"></i>
                <span>Go Back</span>
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.stocks.update', $stock->id) }}" method="POST">
            @csrf @method('PUT')

            <div class="form-group">
                <label for="product_id">Product </label>
                    <select
                        name="product_id" id="product_id"
                        class="form-control @error('product_id') is-invalid @enderror"
                    >
                        @foreach($products as $product)
                            <option
                                value="{{ $product->id }}"
                                @if($stock->product_id == $product->id) selected @endif
                            >{{ $product->name }} / Rs.{{ $product->price }}</option>
                        @endforeach
                    </select>

                    @error('unit_id')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input
                    type="number"
                    name="quantity" id="quantity"
                    value="{{ old('quantity') ?? $stock->quantity }}"
                    class="form-control @error('quantity') is-invalid @enderror"
                >
                @error('quantity')
                <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="remark">Remarks</label>
                <textarea
                    name="remark" id="remark"
                    class="form-control @error('remark') is-invalid @enderror"
                >{{ old('remark') ?? $stock->remark }}</textarea>
                @error('remark')
                <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mt-4 mb-1">
                <input type="submit" class="btn btn-primary" value="Update Stock">
                <a href="{{ route('admin.stocks.index') }}" class="btn btn-link float-right">Cancel</a>
            </div>
        </form>
    </div>
</div>
@stop
