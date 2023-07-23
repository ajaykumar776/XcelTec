@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Your content goes here -->
@endsection

@section('scripts')
<!-- Include your script code here -->
<script>
    if (session('success'))
        toastr.success("{{ ucfirst(session('success.message')) }}", 'Success');
    setTimeout(function() {
        window.location = '{{ session('
        success.redirectUrl ') }}';
    }, 100);
    endif

    @if(session('error'))
    toastr.error("{{ ucfirst(session('error.message')) }}", 'Error');
    setTimeout(function() {
        window.location = '{{ session('
        error.redirectUrl ') }}';
    }, 4000);
    @endif

    @if(session('warning'))
    Swal.fire({
        icon: 'warning',
        title: 'Opps!',
        text: "{{ ucfirst(session('warning.message')) }}"
    }).then(function() {
        window.location = '{{ session('
        warning.redirectUrl ') }}';
    });
    @endif

    @if(session('info'))
    Swal.fire({
        icon: 'info',
        title: 'Hi!',
        text: '{{ session('
        info ') }}'
    });
    @endif
</script>
@endsection