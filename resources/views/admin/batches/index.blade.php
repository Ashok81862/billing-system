@extends('adminlte::page')

@section('title', 'All Batches')

@section('content')
<x-alert />
<x-delete />


<div class="card">
    <div class="card-header border-bottom-0">
        <h3 class="card-title text-bold" style="font-size:1.4rem">All Batches</h3>
        <div class="card-tools">
            <a href="{{ route('admin.batches.create') }}" class="btn btn-sm btn-info">
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
                    <th>Vendor</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($batches as $batch)
                <tr>
                    <td>{{ $batch->id }}</td>
                    <td>{{ $batch->name }}</td>
                    <td>{{ $batch->vendor->name }}</td>
                    <td>{{ $batch->total }}</td>
                    <td>
                        <!-- Edit -->
                        <a href="{{ route('admin.batches.edit', $batch->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-fw fa-edit mr-1"></i>
                            <span>Edit</span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($batches->total() >10)
    <div class="card-footer">
        {{ $batches->links() }}
    </div>
    @endif
</div>
@stop
