@extends('adminlte::page')

@section('title', 'Create Vendor')

@section('content')
<x-alert />

<div class="card">
    <div class="card-header border-bottom-0">
        <h3 class="card-title text-bold" style="font-size:1.4rem">Create Vendor</h3>
        <div class="card-tools">
            <a href="{{ route('admin.vendors.index') }}" class="btn btn-sm btn-info">
                <i class="fas fa-fw fa-arrow-left mr-1"></i>
                <span>Go Back</span>
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.vendors.store') }}" method="POST">
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
                    <label for="reg_number">Registration Number</label>
                    <input
                        type="number"
                        name="reg_number" id="reg_number"
                        value="{{ old('reg_number') ?? '' }}"
                        class="form-control @error('reg_number') is-invalid @enderror"
                    >
                    @error('reg_number')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
               </div>
           </div>

           <div class="form-group">
            <label for="category_id">Category </label>
                <select
                    name="category_id" id="category_id"
                    class="form-control @error('category_id') is-invalid @enderror"
                >
                    @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            @if(old('category_id') == $category->id) selected @endif
                        >{{ $category->name }}</option>
                    @endforeach
                </select>

                @error('category_id')
                <small class="form-text text-danger">{{ $message }}</small>
                @enderror
        </div>


            <div class="form-group">
                <label for="remark">Remarks</label>
                <textarea
                    name="remark" id="remark"
                    class="form-control @error('remark') is-invalid @enderror"
                >{{ old('remark') ?? '' }}</textarea>
                @error('remark')
                <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mt-4 mb-1">
                <input type="submit" class="btn btn-primary" value="Add New Vendor">
                <a href="{{ route('admin.vendors.index') }}" class="btn btn-link float-right">Cancel</a>
            </div>
        </form>
    </div>
</div>
@stop
