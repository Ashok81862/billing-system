@extends('adminlte::page')

@section('title', 'Create Unit')

@section('content')
<x-alert />

<div class="card">
    <div class="card-header border-bottom-0">
        <h3 class="card-title text-bold" style="font-size:1.4rem">Create Unit</h3>
        <div class="card-tools">
            <a href="{{ route('admin.units.index') }}" class="btn btn-sm btn-info">
                <i class="fas fa-fw fa-arrow-left mr-1"></i>
                <span>Go Back</span>
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.units.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="singular_name">Unit Name</label>
                        <input
                            type="text"
                            name="singular_name" id="singular_name"
                            value="{{ old('singular_name') ?? '' }}"
                            class="form-control @error('singular_name') is-invalid @enderror"
                            autofocus
                        >
                        @error('singular_name')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="plural_name">Multiple Unit</label>
                        <input
                            type="text"
                            name="plural_name" id="plural_name"
                            value="{{ old('plural_name') ?? '' }}"
                            class="form-control @error('plural_name') is-invalid @enderror"
                            autofocus
                        >
                        @error('plural_name')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="singular_abbr">Abbreviation</label>
                        <input
                            type="text"
                            name="singular_abbr" id="singular_abbr"
                            value="{{ old('singular_abbr') ?? '' }}"
                            class="form-control @error('singular_abbr') is-invalid @enderror"
                            autofocus
                        >
                        @error('singular_abbr')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="plural_abbr">Multiple Abbreviation</label>
                        <input
                            type="text"
                            name="plural_abbr" id="plural_abbr"
                            value="{{ old('plural_abbr') ?? '' }}"
                            class="form-control @error('plural_abbr') is-invalid @enderror"
                            autofocus
                        >
                        @error('plural_abbr')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-4 mb-1">
                <input type="submit" class="btn btn-primary" value="Add New Unit">
                <a href="{{ route('admin.units.index') }}" class="btn btn-link float-right">Cancel</a>
            </div>
        </form>
    </div>
</div>
@stop
