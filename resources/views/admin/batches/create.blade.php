@extends('adminlte::page')

@section('title', 'Create Batch')
@section('plugins.Select2', true)

@section('js')
    <script>

        $(document).ready(function() {
           $('#vendor_id').select2();
        });
    </script>
@endsection

@section('content')
<x-alert />

<div class="card">
    <div class="card-header border-bottom-0">
        <h3 class="card-title text-bold" style="font-size:1.4rem">Create Batch</h3>
        <div class="card-tools">
            <a href="{{ route('admin.batches.index') }}" class="btn btn-sm btn-info">
                <i class="fas fa-fw fa-arrow-left mr-1"></i>
                <span>Go Back</span>
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.batches.store') }}" method="POST">
            @csrf
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

            <div class="form-group">
                <label for="vendor_id">Vendors </label>
                    <select
                        name="vendor_id" id="vendor_id"
                        class="form-control @error('vendor_id') is-invalid @enderror"
                    >
                        @foreach($vendors as $vendor)
                            <option
                                value="{{ $vendor->id }}"
                                @if(old('vendor_id') == $vendor->id) selected @endif
                            >{{ $vendor->name }}</option>
                        @endforeach
                    </select>

                    @error('vendor_id')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
            </div>

            <div class="mt-4 mb-1">
                <input type="submit" class="btn btn-primary" value="Add New Batch">
                <a href="{{ route('admin.batches.index') }}" class="btn btn-link float-right">Cancel</a>
            </div>
        </form>
    </div>
</div>
@stop
