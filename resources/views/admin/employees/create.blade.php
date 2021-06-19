@extends('adminlte::page')

@section('title', 'Create Employee')

@section('content')
<x-alert />

<div class="card">
    <div class="card-header border-bottom-0">
        <h3 class="card-title text-bold" style="font-size:1.4rem">Create Employee</h3>
        <div class="card-tools">
            <a href="{{ route('admin.employees.index') }}" class="btn btn-sm btn-info">
                <i class="fas fa-fw fa-arrow-left mr-1"></i>
                <span>Go Back</span>
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.employees.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input
                            type="text"
                            name="name" id="name"
                            value="{{ old('name') ?? '' }}"
                            class="form-control @error('name') is-invalid @enderror"
                            autofocus
                        >
                        @error('name')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input
                            type="text"
                            name="address" id="address"
                            value="{{ old('address') ?? '' }}"
                            class="form-control @error('address') is-invalid @enderror"
                        >
                        @error('address')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

           <div class="row">
               <div class="col">
                <div class="form-group">
                    <label for="phone">Contact Number</label>
                    <input
                        type="text"
                        name="phone" id="phone"
                        value="{{ old('phone') ?? '' }}"
                        class="form-control @error('phone') is-invalid @enderror"
                    >
                    @error('phone')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
               </div>
               <div class="col">
                <div class="form-group">
                    <label for="pan_number">PAN Number</label>
                    <input
                        type="number"
                        name="pan_number" id="pan_number"
                        value="{{ old('pan_number') ?? '' }}"
                        class="form-control @error('pan_number') is-invalid @enderror"
                    >
                    @error('pan_number')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
               </div>
           </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="salary">Salary</label>
                        <input
                            type="number"
                            name="salary" id="salary"
                            value="{{ old('salary') ?? '' }}"
                            class="form-control @error('salary') is-invalid @enderror"
                        >
                        @error('salary')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="position">Position</label>
                        <input
                            type="text"
                            name="position" id="position"
                            value="{{ old('position') ?? '' }}"
                            class="form-control @error('position') is-invalid @enderror"
                        >
                        @error('position')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-4 mb-1">
                <input type="submit" class="btn btn-primary" value="Add New Employee">
                <a href="{{ route('admin.employees.index') }}" class="btn btn-link float-right">Cancel</a>
            </div>
        </form>
    </div>
</div>
@stop
