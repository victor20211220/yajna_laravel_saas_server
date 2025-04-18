@php
    $layout_setting = \App\Models\Utility::settings();
    $setting = \App\Models\Utility::settings();
    $set_cookie = \App\Models\Utility::cookie_settings();
    $langSetting = \App\Models\Utility::langSetting();
    $color = !empty($setting['color']) ? $setting['color'] : 'theme-3';
    if (isset($setting['color_flag']) && $setting['color_flag'] == 'true') {
        $themeColor = 'custom-color';
    } else {
        $themeColor = $color;
    }

@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $layout_setting['SITE_RTL'] == 'on' ? 'rtl' : '' }}">

<head>
    <style>
        :root {
            --color-customColor: <?=$color ?>;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/custom-color.css') }}">
</head>
<meta name="csrf-token" content="{{ csrf_token() }}">
@include('partials.admin.header')

<body class="{{ $themeColor }}" >
    <input type="hidden" id="path_admin" value="{{ url('/') }}">
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <div class="container-application">
        @include('partials.admin.sidemenu')
        <div class="main-content position-relative">
            @include('partials.admin.menu')
            <div class="page-content">
                <div class="dash-container">
                    <div class="dash-content">
                        <!-- [ breadcrumb ] start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center justify-content-between gap-2">
                                    <div class="col-auto">
                                        <h4 class="m-b-10"> @yield('title')</h4>
                                        @if (Request::route()->getName() != 'home')
                                            <ul class="breadcrumb mt-1">
                                                @yield('breadcrumb')
                                            </ul>
                                        @endif
                                    </div>
                                    <div class="col-auto">
                                        @yield('action-btn')
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- [ breadcrumb ] end -->
                        <!-- [ Main Content ] start -->
                        {{-- <div class="row"> --}}
                        @yield('content')
                        {{-- </div> --}}
                        <!-- [ Main Content ] end -->
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="position-fixed top-0 end-0 p-3" style="z-index: 99999">
        <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="{{ asset('assets/images/favicon.svg') }}" class="img-fluid m-r-5" alt="images"
                    style="width:17px;">
                <strong class="me-auto">{{ __('Dashboard') }}</strong>
                <small>{{__('11 mins ago')}}</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ __('Hello, world! This is a toast message.') }}
            </div>
        </div>
    </div>

    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="commonModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelCommanModelLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="commonModalOver" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelCommanModelLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>

    @include('partials.admin.footer')
    <footer class="dash-footer">
        <div class="footer-wrapper">
            <div class="py-1">
                <span class="text-muted">
                    &copy;&nbsp;{{ date('Y') }}&nbsp;{{ isset($langSetting['footer_text']) ? $langSetting['footer_text'] : config('app.name', 'vCardGo-SaaS') }}
                </span>
            </div>
        </div>
    </footer>


    @if (Session::has('success'))
        <script>
            toastrs('{{ __('Success') }}', '{!! session('success') !!}', 'success');
        </script>
        {{ Session::forget('success') }}
    @endif
    @if (Session::has('error'))
        <script>
            toastrs('{{ __('Error') }}', '{!! session('error') !!}', 'error');
        </script>
        {{ Session::forget('error') }}
    @endif

    <script>
        var exampleModal = document.getElementById('exampleModal')

        exampleModal.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            var button = event.relatedTarget
            // Extract info from data-bs-* attributes
            var recipient = button.getAttribute('data-bs-whatever')
            var url = button.getAttribute('data-url')

            var modalTitle = exampleModal.querySelector('.modal-title')
            var modalBodyInput = exampleModal.querySelector('.modal-body input')
            modalTitle.textContent = recipient
            var size = button.getAttribute('data-size');
            $("#exampleModal .modal-dialog").addClass('modal-' + size);
            $.ajax({
                url: url,
                success: function(data) {
                    $('#exampleModal .modal-body').html(data);
                    $("#exampleModal").modal('show');
                },
                error: function(data) {
                    data = data.responseJSON;
                    toastrs('Error', data.error, 'error')
                }
            });
        })

        function arrayToJson(form) {
            var data = $(form).serializeArray();
            var indexed_array = {};

            $.map(data, function(n, i) {
                indexed_array[n['name']] = n['value'];
            });

            return indexed_array;
        }

        $(document).on('click',
            'a[data-ajax-popup-over="true"], button[data-ajax-popup-over="true"], div[data-ajax-popup-over="true"]',
            function() {

                var validate = $(this).attr('data-validate');
                var id = '';
                if (validate) {
                    id = $(validate).val();
                }

                var title = $(this).data('title');
                var size = ($(this).data('size') == '') ? 'md' : $(this).data('size');
                var url = $(this).data('url');

                $("#commonModalOver .modal-title").html(title);
                $("#commonModalOver .modal-dialog").addClass('modal-' + size);

                $.ajax({
                    url: url + '?id=' + id,
                    success: function(data) {
                        $('#commonModalOver .modal-body').html(data);
                        $("#commonModalOver").modal('show');
                        taskCheckbox();
                    },
                    error: function(data) {
                        data = data.responseJSON;
                        show_toastr('Error', data.error, 'error')
                    }
                });

            });
    </script>


</body>
@if ($set_cookie['enable_cookie'] == 'on')
    @include('layouts.cookie_consent')
@endif

</html>
