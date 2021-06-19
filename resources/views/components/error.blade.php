@section('plugins.Sweetalert2', true)

@push('js')
<script>
   Swal.fire({
        icon: 'warning',
        title: 'Oops...',
        text: '{{ $errors->first() }}!!',
    })
</script>
@endpush

