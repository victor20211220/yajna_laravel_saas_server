@extends('layouts.admin')
@section('page-title')
    {{ __('Landing Page') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Landing Page') }}</li>
@endsection
@section('title')
    {{ __('Landing Page') }}
@endsection
@php
    $logo = \App\Models\Utility::get_file('uploads/logo');
    $settings = \Modules\LandingPage\Entities\LandingPageSetting::settings();
@endphp

@push('css-page')
    <link rel="stylesheet" href="{{ asset('Modules/LandingPage/Resources/custom/libs/summernote/summernote-bs4.css') }}">
@endpush

@push('custom-scripts')
    {{-- <script src="{{ Module::asset('LandingPage:Resources/assets/js/plugins/tinymce.min.js')}}" referrerpolicy="origin"></script> --}}
    <script src="{{ asset('css/summernote/summernote-bs4.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough']],
                    ['list', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'unlink']],
                ],
                height: 250,
            });
            $('.dropdown-toggle').dropdown();
        });
    </script>
@endpush

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Landing Page') }}</li>
@endsection


@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card mb-xl-0 sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            @include('landingpage::layouts.tab')
                        </div>
                    </div>
                </div>

                <div class="col-xl-9">
                    {{--  Start for all settings tab --}}
                    {{ Form::model(null, ['route' => ['landingpage.store'], 'method' => 'POST', 'class' => 'needs-validation', 'novalidate']) }}
                    @csrf
                    <div class="card mb-0">
                        <div class="card-header d-flex align-items-center justify-content-between gap-2">
                            <h5>{{ __('Top Bar') }}</h5>
                            <div class="form-check form-switch custom-switch-v1">
                                <input type="checkbox" class="form-check-input input-primary" name="topbar_status"
                                    id="topbar_status" {{ $settings['topbar_status'] == 'on' ? 'checked="checked"' : '' }}>
                            </div>
                        </div>

                        <div class="card-body pb-0">
                            <div class="row">

                                <div class="col-12">
                                    {{ Form::label('content', __('Message'), ['class' => 'col-form-label text-dark']) }}<x-required></x-required>
                                    {{ Form::textarea('topbar_notification_msg', $settings['topbar_notification_msg'], ['class' => 'summernote form-control', 'required' => 'required', 'id' => 'mytextarea', 'required' => 'required']) }}
                                </div>

                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <input class="btn btn-print-invoice btn-primary" type="submit"
                                value="{{ __('Save Changes') }}">
                        </div>
                    </div>
                    {{ Form::close() }}

                    {{--  End for all settings tab --}}
                </div>
            </div>
        </div>
    </div>
@endsection
