@extends('adminlte::page')

@section('title', 'Update Product')

@section('content')
<x-alert />

<div class="card">
    <div class="card-header border-bottom-0">
        <h3 class="card-title text-bold" style="font-size:1.4rem">Update Product</h3>
        <div class="card-tools">
            <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-info">
                <i class="fas fa-fw fa-arrow-left mr-1"></i>
                <span>Go Back</span>
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
            @csrf @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input
                    type="text"
                    name="name" id="name"
                    value="{{ old('name') ?? $product->name }}"
                    class="form-control @error('name') is-invalid @enderror"
                    autofocus
                >
                @error('name')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input
                    type="number"
                    name="price" id="price"
                    value="{{ old('price') ?? $product->price }}"
                    class="form-control @error('price') is-invalid @enderror"
                >
                @error('price')
                <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-1">
                <label for="on_sale">
                    <input
                        type="checkbox"
                        name="on_sale" id="on_sale"
                        value="1"
                        @if(old('on_sale') || $product->on_sale) checked @endif
                        onchange="toggleSalePrice()"
                    >

                    <span class="ml-2">On Sale?</span>

                </label>
                @error('on_sale')
                <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group" id="sp">
                <label for="sale_price">Price on Sale</label>
                <input
                    type="text"
                    name="sale_price" id="sale_price"
                    value="{{ old('sale_price') ?? $product->sale_price }}"
                    class="form-control @error('sale_price') is-invalid @enderror"
                >
                @error('sale_price')
                <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

           <div class="form-group">
            <label for="unit_id">Unit </label>
            <select
                name="unit_id" id="unit_id"
                class="form-control @error('unit_id') is-invalid @enderror"
            >
                @foreach($units as $unit)
                    <option
                        value="{{ $unit->id }}"
                        @if($product->unit_id == $unit->id) selected @endif
                    >{{ $unit->singular_name }}</option>
                @endforeach
            </select>

            @error('unit_id')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>

            <div class="form-group">
                <label for="body">Description</label>
                <textarea
                    name="body" id="body"
                    class="form-control @error('body') is-invalid @enderror"
                >{{ old('body') ?? $product->remark }}</textarea>
                @error('body')
                <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mt-4 mb-1">
                <input type="submit" class="btn btn-primary" value="Add New product">
                <a href="{{ route('admin.products.index') }}" class="btn btn-link float-right">Cancel</a>
            </div>
        </form>
    </div>
</div>
@stop
