@section('plugins.Sweetalert2', true)

@push('js')
<script>
   Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '{{ session('error') }} !!',
    })
</script>
@endpush

