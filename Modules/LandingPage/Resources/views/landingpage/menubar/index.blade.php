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
@push('css-page')

<link rel="stylesheet" href="{{ asset('css/summernote/summernote-bs4.css') }}">
@endpush

@php

    $settings = \Modules\LandingPage\Entities\LandingPageSetting::settings();
    $logo = \App\Models\Utility::get_file('uploads/landing_page_image');

@endphp

@push('custom-scripts')
    <script src="{{ asset('css/summernote/summernote-bs4.js') }}"></script>
    <script>
    $(document).ready(function() {
                $('.summernote').summernote({
                    height: 200,
                });
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

                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-10">
                                    <h5>{{ __('Custom Page') }}</h5>
                                </div>
                            </div>
                        </div>

                        {{ Form::open(['route' => 'custom_store', 'method' => 'post', 'enctype' => 'multipart/form-data','class' => 'needs-validation', 'novalidate']) }}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-md-0">
                                        {{ Form::label('Site Logo', __('Site Logo'), ['class' => 'form-label']) }}<x-required></x-required>
                                        <div class="logo-content mt-4">
                                            <img id="image" src="{{ $logo . '/' . $settings['site_logo'].'?'.time() }}"
                                                class="big-logo" style="filter: drop-shadow(2px 3px 7px #011C4B);"  width="150px">
                                        </div>
                                        <div class="choose-files mt-4">
                                            <label for="site_logo">
                                                <div class=" bg-primary company_logo_update" style="cursor: pointer;">
                                                    <i class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                </div>
                                                <input type="file" name="site_logo" id="site_logo"
                                                    class="form-control file d-none" data-filename="site_logo"  width="150px"
                                                    onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                                            </label>
                                        </div>
                                        @error('site_logo')
                                            <div class="row">
                                                <span class="invalid-logo" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group mb-0">
                                        {{ Form::label('Site Description', __('Site Description'), ['class' => 'form-label']) }}<x-required></x-required>
                                        {{ Form::text('site_description', $settings['site_description'], ['class' => 'form-control', 'placeholder' => __('Enter Description'),'required'=>'required']) }}
                                        @error('mail_port')
                                            <span class="invalid-mail_port" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <input class="btn btn-print-invoice btn-primary" type="submit"
                                value="{{ __('Save Changes') }}">
                        </div>
                        {{ Form::close() }}
                    </div>


                    <div class="card mb-0">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-lg-9 col-md-9 col-sm-9">
                                    <h5>{{ __('Menu Bar') }}</h5>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 justify-content-end d-flex">
                                    <a data-size="lg" data-url="{{ route('custom_page.create') }}" data-ajax-popup="true"
                                        data-bs-toggle="tooltip"  data-bs-placement="top" data-title="{{__('Create Menu Bar')}}" title="{{__('Create Menu Bar')}}"
                                        class="btn btn-sm btn-primary">
                                        <i class="ti ti-plus text-light"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            {{-- <div class="justify-content-end d-flex">

                                    <a data-size="lg" data-url="{{ route('users.create') }}" data-ajax-popup="true"  data-bs-toggle="tooltip" title="{{__('Create')}}"  class="btn btn-sm btn-primary">
                                        <i class="ti ti-plus text-light"></i>
                                    </a>
                                </div> --}}

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('No') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (is_array($pages) || is_object($pages))
                                            @php
                                                $no = 1;
                                            @endphp

                                            @foreach ($pages as $key => $value)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $value['menubar_page_name'] }}</td>
                                                    <td>
                                                        <span>
                                                            <div class="action-btn me-2">
                                                                <a href="#" class="mx-3 bg-info btn btn-sm align-items-center"
                                                                    data-url="{{ route('custom_page.edit', $key) }}"
                                                                    data-ajax-popup="true"
                                                                    data-title="{{ __('Edit Menu Bar') }}" data-size="lg"
                                                                    data-bs-toggle="tooltip" title="{{ __('Edit') }}"
                                                                    data-original-title="{{ __('Edit') }}">
                                                                    <i class="ti ti-pencil text-white"></i>
                                                                </a>
                                                            </div>
                                                            @if($value['page_slug'] != 'terms_and_conditions' && $value['page_slug'] != 'about_us' && $value['page_slug'] != 'privacy_policy')
                                                                <div class="action-btn me-2">
                                                                    <a href="#"
                                                                        class="bs-pass-para bg-danger mx-3 btn btn-sm d-inline-flex align-items-center"
                                                                        data-confirm="{{ __('Are You Sure?') }}"
                                                                        data-text="{{ __('This action can not be undone. Do you want to continue?') }}"
                                                                        data-confirm-yes="delete-form-{{ $key }}"
                                                                        title="{{ __('Delete') }}" data-bs-toggle="tooltip"
                                                                        data-bs-placement="top"><span class="text-white"><i
                                                                                class="ti ti-trash"></i></span></a>
                                                                </div>
                                                                {!! Form::open([
                                                                    'method' => 'DELETE',
                                                                    'route' => ['custom_page.destroy', $key],
                                                                    'id' => 'delete-form-' . $key,
                                                                ]) !!}
                                                                {!! Form::close() !!}
                                                            </div>
                                                            @endif
                                                        </span>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{--  End for all settings tab --}}
                </div>
            </div>
        </div>
    </div>
@endsection
