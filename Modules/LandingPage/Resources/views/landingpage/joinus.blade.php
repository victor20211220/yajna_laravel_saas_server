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

    $settings = \Modules\LandingPage\Entities\LandingPageSetting::settings();
    $logo = \App\Models\Utility::get_file('uploads/landing_page_image');

@endphp



@push('custom-scripts')
    <script>
        document.getElementById('home_banner').onchange = function() {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('image').src = src
        }
        document.getElementById('home_logo').onchange = function() {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('image1').src = src
        }
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

                    {{ Form::model(null, ['route' => ['join_us.store'], 'method' => 'POST', 'class' => 'needs-validation', 'novalidate']) }}
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between gap-2">
                            <h5>{{ __('Join User') }}</h5>
                            <div class="form-check form-switch custom-switch-v1">
                                <input type="checkbox" name="joinus_status" id="joinus_status" class="form-check-input input-primary"
                                    {{ $settings['joinus_status'] == 'on' ? 'checked="checked"' : '' }}>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('Heading', __('Heading'), ['class' => 'form-label']) }}<x-required></x-required>
                                        {{ Form::text('joinus_heading', $settings['joinus_heading'], ['class' => 'form-control', 'placeholder' => __('Enter Description'), 'required' => 'required']) }}
                                        @error('mail_port')
                                            <span class="invalid-mail_port" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('Description', __('Description'), ['class' => 'form-label']) }}<x-required></x-required>
                                        {{ Form::text('joinus_description', $settings['joinus_description'], ['class' => 'form-control', 'placeholder' => __('Enter Description'), 'required' => 'required']) }}
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
                    </div>
                    {{ Form::close() }}
                    <div class="card mb-0">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-lg-9 col-md-9 col-sm-9">
                                    <h5>{{ __('Join Us User') }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (is_array($join_us) || is_object($join_us))
                                            @foreach ($join_us as $key)
                                                <tr>
                                                    <td>{{ $key->email }}</td>
                                                    <td>
                                                        <span>
                                                            <div class="action-btn bg-danger ms-2">
                                                                <a href="#"
                                                                    class="bs-pass-para mx-3 btn btn-sm d-inline-flex align-items-center"
                                                                    data-confirm="{{ __('Are You Sure?') }}"
                                                                    data-text="{{ __('This action can not be undone. Do you want to continue?') }}"
                                                                    data-confirm-yes="delete-form-{{ $key->id }}"
                                                                    title="{{ __('Delete') }}" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"><span class="text-white"><i
                                                                            class="ti ti-trash"></i></span></a>
                                                            </div>
                                                            {!! Form::open([
                                                                'method' => 'DELETE',
                                                                'route' => ['join_us.destroy', $key->id],
                                                                'id' => 'delete-form-' . $key->id,
                                                            ]) !!}
                                                            {!! Form::close() !!}

                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>{{--  End for all settings tab --}}
                </div>
            </div>
        </div>
    </div>
@endsection
