@extends('adminlte::page')

@section('title', 'Customer Details')

@section('content')

    <x-alert />

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold" style="font-size:1.4rem">customer Details</h3>
            <div class="card-tools">
                <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-fw fa-edit mr-1"></i>
                    <span>Edit</span>
                </a>

                <a href="{{ route('admin.customers.index') }}" class="btn btn-sm btn-info">
                    <i class="fas fa-fw fa-arrow-left mr-1"></i>
                    <span>Go Back</span>
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered">
                <tr>
                    <td>ID</td>
                    <td>{{ $customer->id }}</td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>{{ $customer->name }}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>{{ $customer->address }}</td>
                </tr>
                <tr>
                    <td>Contact</td>
                    <td>{{ $customer->phone }}</td>
                </tr>
                <tr>
                    <td>Registration Number</td>
                    <td>{{ $customer->reg_number }}</td>
                </tr>
                <tr>
                    <td>Remarks</td>
                    <td>{{ $customer->remark }}</td>
                </tr>
                <tr>
                    <td>Created At</td>
                    <td>{{ $customer->created_at }}</td>
                </tr>
                <tr>
                    <td>Updated At</td>
                    <td>{{ $customer->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>
@stop
