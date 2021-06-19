@section('plugins.Sweetalert2', true)

@push('js')
<script>
    Swal.fire({
    icon: 'success',
    title: 'Congratulations',
    text: '{{ session('success') }}',
    timer: false,
    showConfirmButton: 'Ok'
  })
</script>
@endpush

