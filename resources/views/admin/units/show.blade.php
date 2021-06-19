@extends('adminlte::page')

@section('title', 'Unit Details')

@section('content')

    <x-alert />

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold" style="font-size:1.4rem">Unit Details</h3>
            <div class="card-tools">
                <a href="{{ route('admin.units.edit', $unit->id) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-fw fa-edit mr-1"></i>
                    <span>Edit</span>
                </a>

                <a href="{{ route('admin.units.index') }}" class="btn btn-sm btn-info">
                    <i class="fas fa-fw fa-arrow-left mr-1"></i>
                    <span>Go Back</span>
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered">
                <tr>
                    <td>ID</td>
                    <td>{{ $unit->id }}</td>
                </tr>
                <tr>
                    <td>Unit Name</td>
                    <td>{{ $unit->singular_name }}</td>
                </tr>
                <tr>
                    <td>Plural Unit Name</td>
                    <td>{{ $unit->plural_name }}</td>
                </tr>
                <tr>
                    <td>Abbreviation</td>
                    <td>{{ $unit->singular_abbr }}</td>
                </tr>
                <tr>
                    <td>Plural Abbreviation</td>
                    <td>{{ $unit->plural_abbr }}</td>
                </tr>
                <tr>
                    <td>Created At</td>
                    <td>{{ $unit->created_at }}</td>
                </tr>
                <tr>
                    <td>Updated At</td>
                    <td>{{ $unit->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>
@stop
