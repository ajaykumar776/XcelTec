@include('layouts.header')

<div class="container-  ">
    <!-- Content Section -->
    @yield('content')
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('developer.js') }}"></script>


@include('layouts.footer')