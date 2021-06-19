@extends('adminlte::page')

@section('title', 'All Customers')

@section('content')
<x-alert />
<x-delete />


<div class="card">
    <div class="card-header border-bottom-0">
        <h3 class="card-title text-bold" style="font-size:1.4rem">All Customers</h3>
        <div class="card-tools">
            <a href="{{ route('admin.customers.create') }}" class="btn btn-sm btn-info">
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
                    <th>Registration No.</th>
                    <th>Contact</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->reg_number }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>
                        <!-- Show -->
                        <a href="{{ route('admin.customers.show', $customer->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-fw fa-eye mr-1"></i>
                            <span>Show</span>
                        </a>

                        <!-- Edit -->
                        <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-fw fa-edit mr-1"></i>
                            <span>Edit</span>
                        </a>

                        <!-- Delete -->
                        <a href="#" onclick="confirmDelete({{ $customer->id }})" class="btn btn-danger btn-sm">
                            <i class="fas fa-fw fa-edit mr-1"></i>
                            <span>Delete</span>
                        </a>

                        <!-- Delete Form -->
                        <form id="delete-form-{{ $customer->id }}" action="{{ route('admin.customers.destroy', $customer->id) }}" method="post">
                            @csrf @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($customers->total() >10)
    <div class="card-footer">
        {{ $customers->links() }}
    </div>
    @endif
</div>
@stop
