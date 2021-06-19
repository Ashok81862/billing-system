@extends('adminlte::page')

@section('title', 'Employee Details')

@section('content')

    <x-alert />

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold" style="font-size:1.4rem">Employee Details</h3>
            <div class="card-tools">
                <a href="{{ route('admin.employees.edit', $employee->id) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-fw fa-edit mr-1"></i>
                    <span>Edit</span>
                </a>

                <a href="{{ route('admin.employees.index') }}" class="btn btn-sm btn-info">
                    <i class="fas fa-fw fa-arrow-left mr-1"></i>
                    <span>Go Back</span>
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered">
                <tr>
                    <td>ID</td>
                    <td>{{ $employee->id }}</td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>{{ $employee->name }}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>{{ $employee->address }}</td>
                </tr>
                <tr>
                    <td>Contact</td>
                    <td>{{ $employee->phone }}</td>
                </tr>
                <tr>
                    <td>PAN Number</td>
                    <td>{{ $employee->pan_number }}</td>
                </tr>
                <tr>
                    <td>Salary</td>
                    <td>{{ $employee->salary }}</td>
                </tr>
                <tr>
                    <td>Position</td>
                    <td>{{ $employee->position }}</td>
                </tr>
                <tr>
                    <td>Created At</td>
                    <td>{{ $employee->created_at }}</td>
                </tr>
                <tr>
                    <td>Updated At</td>
                    <td>{{ $employee->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>
@stop
