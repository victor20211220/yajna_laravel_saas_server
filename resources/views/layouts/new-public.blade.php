<!DOCTYPE html>
<html>

<meta name="csrf-token" content="{{ csrf_token() }}">
@include('partials.new-public.header')

<body>
<header class="py-4 border border-bottom-secondary">
    <a class="text-center d-block" href="{{ url('/') }}">
        <img src="{{ asset('assets/images/icons/logo.svg') }}" alt="" class="logo-img">
    </a>
</header>
<div class="mb-4"></div>
<!-- Main Content -->
<div class="container">
    @yield('content')
</div>
@include('partials.new-public.footer')

</body>
</html>
