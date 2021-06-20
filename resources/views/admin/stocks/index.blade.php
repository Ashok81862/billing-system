@extends('adminlte::page')

@section('title', 'All Stocks')

@section('content')
<x-alert />
<x-delete />


<div class="card">
    <div class="card-header border-bottom-0">
        <h3 class="card-title text-bold" style="font-size:1.4rem">All Stocks</h3>
        <div class="card-tools">
            <a href="{{ route('admin.stocks.create') }}" class="btn btn-sm btn-info">
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
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stocks as $stock)
                <tr>
                    <td>{{ $stock->id }}</td>
                    <td>{{ $stock->product->name }} / Rs.{{ $stock->product->price }}</td>
                    <td>{{ $stock->quantity }}</td>
                    <td>
                        <!-- Show -->
                        <a href="{{ route('admin.stocks.show', $stock->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-fw fa-eye mr-1"></i>
                            <span>Show</span>
                        </a>

                        <!-- Edit -->
                        <a href="{{ route('admin.stocks.edit', $stock->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-fw fa-edit mr-1"></i>
                            <span>Edit</span>
                        </a>

                        <!-- Delete -->
                        <a href="#" onclick="confirmDelete({{ $stock->id }})" class="btn btn-danger btn-sm">
                            <i class="fas fa-fw fa-edit mr-1"></i>
                            <span>Delete</span>
                        </a>

                        <!-- Delete Form -->
                        <form id="delete-form-{{ $stock->id }}" action="{{ route('admin.stocks.destroy', $stock->id) }}" method="post">
                            @csrf @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($stocks->total() >10)
    <div class="card-footer">
        {{ $stocks->links() }}
    </div>
    @endif
</div>
@stop
