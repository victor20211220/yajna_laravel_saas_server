@php
    use App\Models\Utility;
    $logo=\App\Models\Utility::get_file('uploads/logo/');
    $company_favicon=Utility::getValByName('company_favicon');
    $setting = App\Models\Utility::settings();

@endphp

<head>

    <title>{{(Utility::getValByName('title_text')) ? Utility::getValByName('title_text') : config('app.name', 'vCardGo SaaS')}}
        - @yield('page-title')</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="stylesheet" href="{{ asset('assets/css/new-public.css?v='.time()) }}">
</head>


