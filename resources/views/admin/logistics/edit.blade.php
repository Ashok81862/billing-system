@extends('adminlte::page')

@section('title', 'Update Logistic')

@section('plugins.Select2', true)

@push('js')
<script>
    $(document).ready(function() {
        $('#logistic_type_id').select2();
    });
</script>
@endpush


@section('content')
<x-alert />

<div class="card">
    <div class="card-header border-bottom-0">
        <h3 class="card-title text-bold" style="font-size:1.4rem">Update Logistic</h3>
        <div class="card-tools">
            <a href="{{ route('admin.logistics.index') }}" class="btn btn-sm btn-info">
                <i class="fas fa-fw fa-arrow-left mr-1"></i>
                <span>Go Back</span>
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.logistics.update', $logistic->id) }}" method="POST">
            @csrf   @method('PUT')
            <div class="form-group">
                <label for="amount">Amount</label>
                <input
                    type="number"
                    name="amount" id="amount"
                    value="{{ old('amount') ?? $logistic->amount }}"
                    class="form-control @error('amount') is-invalid @enderror"
                    autofocus
                >
                @error('amount')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="logistic_type_id">Type</label>
                <select
                    name="logistic_type_id" id="logistic_type_id"
                    class="form-control @error('logistic_type_id') is-invalid @enderror"
                >
                    @foreach($logisticTypes as $type)
                        <option
                            value="{{ $type->id }}"
                            @if($logistic->logistic_type_id == $type->id) selected @endif
                        >{{ $type->name }}</option>
                    @endforeach
                </select>

                @error('logistic_type_id')
                <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>


            <div class="form-group">
                <label for="remark">Remarks</label>
                <textarea
                    name="remark" id="remark"
                    class="form-control @error('remark') is-invalid @enderror"
                    autofocus
                >{{ old('remark') ?? $logistic->remark }}</textarea>
                @error('remark')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mt-4 mb-1">
                <input type="submit" class="btn btn-primary" value="Update Logistic">
                <a href="{{ route('admin.logistics.index') }}" class="btn btn-link float-right">Cancel</a>
            </div>
        </form>
    </div>
</div>
@stop
