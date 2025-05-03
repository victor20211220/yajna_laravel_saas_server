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
<body class="position-relative jquery-d-none">
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
</body>
</html>
