@extends('adminlte::page')

@section('title', 'All Logistics')

@section('content')
<x-alert />
<x-delete />


<div class="card">
    <div class="card-header border-bottom-0">
        <h3 class="card-title text-bold" style="font-size:1.4rem">All Logistics</h3>
        <div class="card-tools">
            <a href="{{ route('admin.logistics.create') }}" class="btn btn-sm btn-info">
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logistics as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <!-- Edit -->
                        <a href="{{ route('admin.logistics.edit', $category->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-fw fa-edit mr-1"></i>
                            <span>Edit</span>
                        </a>

                        <!-- Delete -->
                        <a href="#" onclick="confirmDelete({{ $category->id }})" class="btn btn-danger btn-sm">
                            <i class="fas fa-fw fa-edit mr-1"></i>
                            <span>Delete</span>
                        </a>

                        <!-- Delete Form -->
                        <form id="delete-form-{{ $category->id }}" action="{{ route('admin.logistics.destroy', $category->id) }}" method="post">
                            @csrf @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($logistics->total() >10)
    <div class="card-footer">
        {{ $logistics->links() }}
    </div>
    @endif
</div>
@stop
