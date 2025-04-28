@extends('layouts.admin')
@section('page-title')
    {{ __('Landing Page') }}
@endsection
@section('title')
    {{ __('Landing Page') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Landing Page') }}</li>
@endsection

@php
    $lang = \App\Models\Utility::getValByName('default_language');
    // $logo=asset(Storage::url('uploads/logo/'));
    $logo = \App\Models\Utility::get_file('uploads/logo');
    $logo_light = \App\Models\Utility::getValByName('logo_light');
    $logo_dark = \App\Models\Utility::getValByName('logo_dark');
    $company_favicon = \App\Models\Utility::getValByName('company_favicon');
    $setting = \App\Models\Utility::colorset();

    $color = !empty($setting['color']) ? $setting['color'] : 'theme-3';
    $SITE_RTL = isset($setting['SITE_RTL']) ? $setting['SITE_RTL'] : 'off';
    $meta_image = \App\Models\Utility::get_file('uploads/meta/');

    $selectedType = $settings['business_campaign_type'];
@endphp




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


                    <div class="card mb-0">
                        {{ Form::open(['route' => 'business-campaigns.store', 'method' => 'post', 'enctype' => 'multipart/form-data', 'class' => 'needs-validation', 'novalidate']) }}
                        <div class="card-header d-flex align-items-center justify-content-between gap-2">
                            <h5>{{ __('Business Campaign Section') }}</h5>
                            <div class="form-check form-switch custom-switch-v1">
                                <input type="checkbox" class="form-check-input input-primary" name="business_campaign"
                                    id="business_campaign"
                                    {{ $settings['business_campaign'] == 'on' ? 'checked="checked"' : '' }}>
                                <label class="custom-control-label" for="business_campaign">
                            </div>
                        </div>


                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('Title', __('Title'), ['class' => 'form-label']) }}<x-required></x-required>
                                        {{ Form::text('business_campaign_title', $settings['business_campaign_title'], ['class' => 'form-control ', 'placeholder' => __('Enter Title'), 'required' => 'required']) }}
                                        @error('mail_host')
                                            <span class="invalid-mail_driver" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('Heading', __('Heading'), ['class' => 'form-label']) }}<x-required></x-required>
                                        {{ Form::text('business_campaign_heading', $settings['business_campaign_heading'], ['class' => 'form-control ', 'placeholder' => __('Enter Heading'), 'required' => 'required']) }}
                                        @error('mail_host')
                                            <span class="invalid-mail_driver" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('Description', __('Description'), ['class' => 'form-label']) }}<x-required></x-required>
                                        {{ Form::text('business_campaign_description', $settings['business_campaign_description'], ['class' => 'form-control', 'placeholder' => __('Enter Description'), 'required' => 'required']) }}
                                        @error('mail_port')
                                            <span class="invalid-mail_port" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('Type', __('Type'), ['class' => 'form-label']) }}<x-required></x-required>
                                        <select name="business_campaign_type" id="business_campaign_type"
                                            class="form-control select2">
                                            <option value="">{{ __('Select Type') }}</option>
                                            <option value="latest" {{ $selectedType == 'latest' ? 'selected' : '' }}>
                                                {{ __('Latest') }}</option>
                                            <option value="most_popular"
                                                {{ $selectedType == 'most_popular' ? 'selected' : '' }}>
                                                {{ __('Most Popular') }}</option>
                                        </select>
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
                    {{--  End for all settings tab --}}
                </div>
            </div>
        </div>
    </div>
@endsection
