@if ($errors->any())
    @include('components.error')
@endif

@if (session('success'))
   @include('components.success')
@endif

@if (session('error'))
    @include('components.bug')
@endif
