@php
    $layout_setting = \App\Models\Utility::settings();
    $setting = \App\Models\Utility::settings();
    $set_cookie = \App\Models\Utility::cookie_settings();
    $langSetting = \App\Models\Utility::langSetting();
@endphp

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<meta name="csrf-token" content="{{ csrf_token() }}">
@include('partials.new-client.header')

<body class="position-relative display-none">
<div id="bodyOverlay" class="position-absolute top-0 start-0 w-100 h-100 display-none"></div>
<input type="hidden" id="path_admin" value="{{ url('/') }}">
<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>

<!-- Sidebar -->
@include('partials.new-client.sidemenu')

<!-- Main Content -->
<div id="mainContent" class="main-content position-relative">
    {!! svg('/user_interface/open_sidebar.svg', ['class' => 'position-absolute z-3 top-0 ms-5 start-0 toggle-sidebar-icon', 'id' => 'openSidebar']) !!}
    @yield('title')
    @yield('content')
</div>
@include('partials.new-client.footer')

</body>
</html>
