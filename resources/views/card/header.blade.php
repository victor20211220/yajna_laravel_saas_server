@php
    $url_link = env('APP_URL') . '/' . $business->slug;
@endphp
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="author" content="{{ $business->title }}">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
<meta name="HandheldFriendly" content="True">

<title>{{ $business->title }}</title>
<meta name="author" content="{{ $business->title }}">
<meta name="keywords" content="{{ $business->meta_keyword }}">
<meta name="description" content="{{ $business->meta_description }}">

{{-- Meta tag Preview --}}
<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ $url_link }}">
<meta property="og:title" content="{{ $business->title }}">
<meta property="og:description" content="{{ $business->meta_description }}">
<meta property="og:image"
      content="{{ !empty($business->meta_image) ? $meta_tag_image : asset('custom/img/placeholder-image.jpg') }}">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ $url_link }}">
<meta property="twitter:title" content="{{ $business->title }}">
<meta property="twitter:description" content="{{ $business->meta_description }}">
<meta property="twitter:image"
      content="{{ !empty($business->meta_image) ? $meta_tag_image : asset('custom/img/placeholder-image.jpg') }}">

{{-- End Meta tag Preview --}}


<link rel="icon"
      href="{{ $logo1 . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') }}"
      type="image" sizes="16x16">
<link rel="stylesheet" href="{{ asset('custom/' . $theme . '/libs/@fortawesome/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('custom/' . $theme . '/fonts/stylesheet.css') }}">
<link rel="stylesheet" href="{{ asset('custom/' . $theme . '/css/main-style.css') }}">
<link rel="stylesheet" href="{{ asset('custom/' . $theme . '/css/responsive.css') }}">

<link rel="stylesheet" href="{{ asset('custom/css/emojionearea.min.css') }}">
@if (isset($is_slug))
    <link rel='stylesheet' href='{{ asset('css/cookieconsent.css') }}' media="screen"/>
    <style type="text/css">
        {{ $business->customcss }}
    </style>
@endif

@if ($business->google_fonts != 'Default' && isset($business->google_fonts))
    <style>
        @import url('{{ \App\Models\Utility::getvalueoffont($business->google_fonts)['link'] }}');

        :root {
            --first-font: {{ strtok(\App\Models\Utility::getvalueoffont($business->google_fonts)['fontfamily'], ',') }};
            --second-font: {{ strtok(\App\Models\Utility::getvalueoffont($business->google_fonts)['fontfamily'], ',') }};
        }
    </style>
@endif
{{--custom color picker--}}
@if(!$themeName)
    <style>
        :root {
            --theme-color: {{ $business->theme_color ?? '#000000' }};
        }
    </style>
@endif
{{--end custom color picker--}}

{{-- pwa customer app --}}
<meta name="mobile-wep-app-capable" content="yes">
<meta name="apple-mobile-wep-app-capable" content="yes">
<meta name="msapplication-starturl" content="/">
<link rel="apple-touch-icon"
      href="{{ $logo1 . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') }}"/>

@if ($business->enable_pwa_business == 'on' && $plan->pwa_business == 'on')
    <link rel="manifest"
          href="{{ asset('storage/uploads/theme_app/business_' . $business->id . '/manifest.json') }}"/>
@endif
@if (!empty($business->pwa_business($business->slug)->theme_color))
    <meta name="theme-color" content="{{ $business->pwa_business($business->slug)->theme_color }}"/>
@endif
@if (!empty($business->pwa_business($business->slug)->background_color))
    <meta name="apple-mobile-web-app-status-bar"
          content="{{ $business->pwa_business($business->slug)->background_color }}"/>
@endif

@foreach ($pixelScript as $script)
        <?= $script ?>
@endforeach
