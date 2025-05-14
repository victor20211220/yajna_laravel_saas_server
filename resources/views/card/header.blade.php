@php
    $url_link = env('APP_URL') . '/' . $business->slug;
@endphp
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="author" content="{{ $business->title }}">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
<meta name="HandheldFriendly" content="True">
<title>{{ $business->title }}</title>
<!-- Slick Carousel -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    #businessCard {
        --bs-body-font-family: 'Inter', sans-serif !important;
        --custom-card-bg: {{ $business->card_bg_color ?? '#FFFFFF' }};
        --custom-color: {{ $business->card_text_color ?? '#171717' }};
        --custom-button-bg: {{ $business->button_bg_color ?? '#1570FD' }};
        --custom-button-color: {{ $business->button_text_color ?? '#FFFFFF' }};
        --custom-section-border-color: '#C9CCD1';
    }
</style>
<link rel="stylesheet" href="{{ asset('assets/css/new-card-custom.css?v='.time()) }}">
{{--end custom color picker--}}
