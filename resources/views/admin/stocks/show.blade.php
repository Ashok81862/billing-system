@extends('adminlte::page')

@section('title', 'Stock Details')

@section('content')

    <x-alert />

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold" style="font-size:1.4rem">Stock Details</h3>
            <div class="card-tools">
                <a href="{{ route('admin.stocks.edit', $stock->id) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-fw fa-edit mr-1"></i>
                    <span>Edit</span>
                </a>

                <a href="{{ route('admin.stocks.index') }}" class="btn btn-sm btn-info">
                    <i class="fas fa-fw fa-arrow-left mr-1"></i>
                    <span>Go Back</span>
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered">
                <tr>
                    <td>ID</td>
                    <td>{{ $stock->id }}</td>
                </tr>
                <tr>
                    <td>Product</td>
                    <td>{{ $stock->product->name }}</td>
                </tr>
                <tr>
                    <td>Quantity</td>
                    <td>{{ $stock->quantity }}</td>
                </tr>
                <tr>
                    <td>Remarks</td>
                    <td>{{ $stock->remark }}</td>
                </tr>
                <tr>
                    <td>Created At</td>
                    <td>{{ $stock->created_at }}</td>
                </tr>
                <tr>
                    <td>Updated At</td>
                    <td>{{ $stock->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>
@stop
