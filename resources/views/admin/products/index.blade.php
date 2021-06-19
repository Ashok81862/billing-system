@extends('adminlte::page')

@section('title', 'All Products')

@section('content')
<x-alert />
<x-delete />


<div class="card">
    <div class="card-header border-bottom-0">
        <h3 class="card-title text-bold" style="font-size:1.4rem">All Products</h3>
        <div class="card-tools">
            <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-info">
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
                    <th>Name</th>
                    <th>Unit</th>
                    <th>Price</th>
                    <th>Sale Price </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->unit->singular_name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->sale_price }}</td>
                    <td>
                        <!-- Show -->
                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-fw fa-eye mr-1"></i>
                            <span>Show</span>
                        </a>

                        <!-- Edit -->
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-fw fa-edit mr-1"></i>
                            <span>Edit</span>
                        </a>

                        <!-- Delete -->
                        <a href="#" onclick="confirmDelete({{ $product->id }})" class="btn btn-danger btn-sm">
                            <i class="fas fa-fw fa-edit mr-1"></i>
                            <span>Delete</span>
                        </a>

                        <!-- Delete Form -->
                        <form id="delete-form-{{ $product->id }}" action="{{ route('admin.products.destroy', $product->id) }}" method="post">
                            @csrf @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($products->total() >10)
    <div class="card-footer">
        {{ $products->links() }}
    </div>
    @endif
</div>
@stop
