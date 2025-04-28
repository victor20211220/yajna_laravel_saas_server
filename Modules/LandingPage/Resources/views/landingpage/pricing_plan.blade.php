@extends('layouts.admin')
@section('page-title')
    {{ __('Landing Page') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Landing Page')}}</li>
@endsection
@section('title')
    {{ __('Landing Page') }}
@endsection
@php
    $lang = \App\Models\Utility::getValByName('default_language');
   // $logo=asset(Storage::url('uploads/logo/'));
    $logo=\App\Models\Utility::get_file('uploads/logo');
    $logo_light = \App\Models\Utility::getValByName('logo_light');
    $logo_dark = \App\Models\Utility::getValByName('logo_dark');
    $company_favicon = \App\Models\Utility::getValByName('company_favicon');
    $setting = \App\Models\Utility::colorset();

    $color = (!empty($setting['color'])) ? $setting['color'] : 'theme-3';
    $SITE_RTL= isset($setting['SITE_RTL'])?$setting['SITE_RTL']:'off';
    $meta_image = \App\Models\Utility::get_file('uploads/meta/');

@endphp




@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Landing Page')}}</li>
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
                        {{ Form::open(array('route' => 'pricing_plan.store', 'method'=>'post', 'enctype' => "multipart/form-data",'class' => 'needs-validation', 'novalidate')) }}
                        <div class="card-header d-flex align-items-center justify-content-between gap-2">
                            <h5>{{ __('Plan Section') }}</h5>
                                <div class="form-check form-switch custom-switch-v1">
                                    <input type="checkbox" class="form-check-input input-primary" name="plan_status" id="plan_status"
                                        {{ $settings['plan_status'] == 'on' ? 'checked="checked"' : '' }}>
                                    <label class="custom-control-label" for="plan_status"></label>
                                </div>
                        </div>


                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('Title', __('Title'), ['class' => 'form-label']) }}<x-required></x-required>
                                            {{ Form::text('plan_title',$settings['plan_title'], ['class' => 'form-control ', 'placeholder' => __('Enter Title'),'required'=>'required']) }}
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
                                            {{ Form::text('plan_heading',$settings['plan_heading'], ['class' => 'form-control ', 'placeholder' => __('Enter Heading'),'required'=>'required']) }}
                                            @error('mail_host')
                                            <span class="invalid-mail_driver" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group mb-0">
                                            {{ Form::label('Description', __('Description'), ['class' => 'form-label']) }}<x-required></x-required>
                                            {{ Form::text('plan_description', $settings['plan_description'], ['class' => 'form-control', 'placeholder' => __('Enter Description'),'required'=>'required']) }}
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
                                <input class="btn btn-print-invoice btn-primary" type="submit" value="{{ __('Save Changes') }}">
                            </div>
                        {{ Form::close() }}
                    </div>
                    {{--  End for all settings tab --}}
                </div>
            </div>
        </div>
    </div>
@endsection



