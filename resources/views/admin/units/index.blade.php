@extends('adminlte::page')

@section('title', 'All Units')

@section('content')
<x-alert />
<x-delete />


<div class="card">
    <div class="card-header border-bottom-0">
        <h3 class="card-title text-bold" style="font-size:1.4rem">All Units</h3>
        <div class="card-tools">
            <a href="{{ route('admin.units.create') }}" class="btn btn-sm btn-info">
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
                    <th>Plural Name</th>
                    <th>Abbrevation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($units as $unit)
                <tr>
                    <td>{{ $unit->id }}</td>
                    <td>{{ $unit->singular_name }}</td>
                    <td>{{ $unit->plural_name }}</td>
                    <td>{{ $unit->singular_abbr }}</td>
                    <td>
                        <!-- Show -->
                        <a href="{{ route('admin.units.show', $unit->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-fw fa-eye mr-1"></i>
                            <span>Show</span>
                        </a>

                        <!-- Edit -->
                        <a href="{{ route('admin.units.edit', $unit->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-fw fa-edit mr-1"></i>
                            <span>Edit</span>
                        </a>

                        <!-- Delete -->
                        <a href="#" onclick="confirmDelete({{ $unit->id }})" class="btn btn-danger btn-sm">
                            <i class="fas fa-fw fa-edit mr-1"></i>
                            <span>Delete</span>
                        </a>

                        <!-- Delete Form -->
                        <form id="delete-form-{{ $unit->id }}" action="{{ route('admin.units.destroy', $unit->id) }}" method="post">
                            @csrf @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($units->total() >10)
    <div class="card-footer">
        {{ $units->links() }}
    </div>
    @endif
</div>
@stop
