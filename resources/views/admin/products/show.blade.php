@extends('adminlte::page')

@section('title', 'Product Details')

@section('content')

    <x-alert />

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold" style="font-size:1.4rem">Product Details</h3>
            <div class="card-tools">
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-fw fa-edit mr-1"></i>
                    <span>Edit</span>
                </a>

                <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-info">
                    <i class="fas fa-fw fa-arrow-left mr-1"></i>
                    <span>Go Back</span>
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered">
                <tr>
                    <td>ID</td>
                    <td>{{ $product->id }}</td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>{{ $product->name }}</td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>{{ $product->price }}</td>
                </tr>
                <tr>
                    <td>Sale Price</td>
                    <td>{{ $product->sale_price }}</td>
                </tr>
                <tr>
                    <td>Units</td>
                    <td>{{ $product->unit->singular_name }}</td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>{{ $product->body }}</td>
                </tr>
                <tr>
                    <td>Created At</td>
                    <td>{{ $product->created_at }}</td>
                </tr>
                <tr>
                    <td>Updated At</td>
                    <td>{{ $product->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>
@stop
