@extends('adminlte::page')

@section('title', 'Vendor Details')

@section('content')

    <x-alert />

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold" style="font-size:1.4rem">Vendor Details</h3>
            <div class="card-tools">
                <a href="{{ route('admin.vendors.edit', $vendor->id) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-fw fa-edit mr-1"></i>
                    <span>Edit</span>
                </a>

                <a href="{{ route('admin.vendors.index') }}" class="btn btn-sm btn-info">
                    <i class="fas fa-fw fa-arrow-left mr-1"></i>
                    <span>Go Back</span>
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered">
                <tr>
                    <td>ID</td>
                    <td>{{ $vendor->id }}</td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>{{ $vendor->name }}</td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>{{ $vendor->category->name }}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>{{ $vendor->address }}</td>
                </tr>
                <tr>
                    <td>Contact</td>
                    <td>{{ $vendor->phone }}</td>
                </tr>
                <tr>
                    <td>Registration Number</td>
                    <td>{{ $vendor->reg_number }}</td>
                </tr>
                <tr>
                    <td>Remarks</td>
                    <td>{{ $vendor->remark }}</td>
                </tr>
                <tr>
                    <td>Created At</td>
                    <td>{{ $vendor->created_at }}</td>
                </tr>
                <tr>
                    <td>Updated At</td>
                    <td>{{ $vendor->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>
@stop
