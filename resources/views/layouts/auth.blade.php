@php
    use \App\Models\Utility;
    // get theme color
    $setting = \App\Models\Utility::settings();
    $layout_setting = \App\Models\Utility::getLayoutsSetting();

    $company_logo = \App\Models\Utility::GetLogo();

    $logo = \App\Models\Utility::get_file('uploads/logo/');

    $company_favicon = Utility::getValByName('company_favicon');
    $set_cookie = App\Models\Utility::cookie_settings();
    $lang = app()->getLocale('lang');
    if ($lang == 'ar' || $lang == 'he') {
        $setting['SITE_RTL'] = 'on';
    }
    $langSetting = App\Models\Utility::langSetting();
    $color = !empty($setting['color']) ? $setting['color'] : 'theme-3';

    if (isset($setting['color_flag']) && $setting['color_flag'] == 'true') {
        $themeColor = 'custom-color';
    } else {
        $themeColor = $color;
    }
@endphp
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $setting['SITE_RTL'] == 'on' ? 'rtl' : '' }}">

<head>
    <style>
        :root {
            --color-customColor: #171717;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/custom-color.css') }}">
    <title>
        {{ Utility::getValByName('title_text') ? Utility::getValByName('title_text') : config('app.name', 'vCardGo SaaS') }}
        - @yield('page-title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,  initial-scale=1.0, user-scalable=0, minimal-ui"/>
    <meta name="description" content="Dashboard Template Description"/>
    <meta name="keywords" content="Dashboard Template"/>
    <meta name="author" content="Workdo"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->

    <link rel="icon" href="{{ $logo . '/favicon.png' }}" type="image/x-icon"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @stack('css-page')
    <link rel="stylesheet" href="{{ asset('assets/css/new-custom.css?v='.time()) }}"/>

</head>


<body>
<div class="container-fluid login-container d-flex flex-row py-4 px-3 p-md-0">

    <!-- Left Side: Logo + Form -->
    <div class="col-12 col-md-6 d-flex flex-column py-5 p-md-5">

        <!-- Logo (top on desktop, center on mobile) -->
        <div class="text-center text-md-start mb-4">
            {!! svg('logo.svg', ['class' => 'logo-img fill-white fill-md-primary']) !!}
        </div>

        <!-- Form (centered left side desktop, centered mobile) -->
        <div class="flex-grow-1 d-flex flex-column justify-content-center">
            <div class="login-form mx-auto py-5 px-4 p-md-0">
                @yield('content')
            </div>
        </div>

        <!-- Footer (always bottom) -->
        <div class="text-center small mt-4">
            <div class="footer-links">
                <a href="#" class="text-decoration-none me-2 text-white text-md-primary">Terms of Use</a>
                <span class="mx-1 text-white text-md-primary">|</span>
                <a href="#" class="text-decoration-none ms-2 text-white text-md-primary">Privacy Policy</a>
            </div>
            <div class="mt-2 copyright text-md-primary">
                Copyright &copy; {{ date('Y') }} Tapeetap All Rights Reserved
            </div>
        </div>

    </div>

    <!-- Right Side: Background image (Desktop only) -->
    <div class="col-md-6 d-none d-md-block login-desktop-bg"></div>

</div>

<!-- Mobile Background -->
<div class="login-mobile-bg d-md-none"></div>

<!-- Required Js -->
<script src="{{ asset('assets/js/vendor-all.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
<script src="{{ asset('custom/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('custom/libs/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('custom/js/custom-toast.js') }}"></script>
@include('components.custom-toast')

<script>
    feather.replace();
</script>
@stack('custom-scripts')

</body>
</html>
