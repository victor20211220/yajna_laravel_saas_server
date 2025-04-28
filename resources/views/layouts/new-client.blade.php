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
<body class="position-relative">
<input type="hidden" id="path_admin" value="{{ url('/') }}">
<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>

<!-- Sidebar -->
@include('partials.new-client.sidemenu')

<!-- Main Content -->
<div id="mainContent" class="main-content">
    <div class="position-absolute end-0 top-0 me-4 mt-4 d-flex justify-content-center">
        @impersonating($guard = null)
        <a class="btn btn-danger me-3" href="{{ route('exit.company') }}"><i class="bi bi-ban"></i>
            {{ __('Exit Company Login') }}
        </a>
        @endImpersonating
        <div id="toggleSidebar" class="toggle-btn d-none">
            <i id="toggleIcon" class="bi bi-arrow-left"></i>
        </div>
    </div>
    @yield('title')
    @yield('content')
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

<!-- Crop Modal -->
<div class="modal fade" id="cropperModal" tabindex="-1" aria-labelledby="cropperModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <h5 class="modal-title">Drag to reposition</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div style="max-height: 400px;">
                    <img id="cropperTarget" class="img-fluid"/>
                </div>
                <input type="range" min="0.5" max="3" step="0.1" value="1" id="zoomSlider" class="form-range mt-3">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white border" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="saveCropped" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
@include('partials.new-client.footer')


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

    exampleModal.addEventListener('show.bs.modal', function (event) {
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
            success: function (data) {
                $('#exampleModal .modal-body').html(data);
                $("#exampleModal").modal('show');
            },
            error: function (data) {
                data = data.responseJSON;
                toastrs('Error', data.error, 'error')
            }
        });
    })

    function arrayToJson(form) {
        var data = $(form).serializeArray();
        var indexed_array = {};

        $.map(data, function (n, i) {
            indexed_array[n['name']] = n['value'];
        });

        return indexed_array;
    }

    $(document).on('click',
        'a[data-ajax-popup-over="true"], button[data-ajax-popup-over="true"], div[data-ajax-popup-over="true"]',
        function () {

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
                success: function (data) {
                    $('#commonModalOver .modal-body').html(data);
                    $("#commonModalOver").modal('show');
                    taskCheckbox();
                },
                error: function (data) {
                    data = data.responseJSON;
                    show_toastr('Error', data.error, 'error')
                }
            });

        });
</script>
</body>
</html>
