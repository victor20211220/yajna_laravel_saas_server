@extends('layouts.admin')
@php
    $profile = \App\Models\Utility::get_file('uploads/avatar');

    $users = \Auth::user();
    $user = Auth::user();
    $google2fa_url = "";
    $secret_key = "";
    if($user->google2fa_enable == 0 && $user->google2fa_secret != null)
    {
        $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());
        $google2fa_url = $google2fa->getQRCodeInline(
            config('app.name'),
            $user->email,
            $user->google2fa_secret
        );
        $secret_key = $user->google2fa_secret;
    }

    $data = array(
        'user' => $user,
        'secret' => $secret_key,
        'google2fa_url' => $google2fa_url
    );
@endphp
@section('page-title')
    {{ __('Profile Account') }}
@endsection
@section('title')
 {{ __('Profile') }}
@endsection
@push('custom-scripts')
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300
        })
    </script>
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Profile') }}</li>
@endsection
@section('content')
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            <a href="#useradd-2"
                                class="list-group-item list-group-item-action border-0 ">{{ __('Personal info') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#useradd-3"
                                class="list-group-item list-group-item-action border-0">{{ __('Change Password') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#useradd-4" class="list-group-item list-group-item-action border-0">
                                {{ __('Two Factor Authentication') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div id="useradd-2" class="card">
                        <div class="card-header">
                            <h5>{{ __('Personal info') }}</h5>
                            <small class="text-muted">{{ __('Edit details about your personal information') }}</small>
                        </div>
                        {{ Form::model($userDetail, ['route' => ['update.account'], 'method' => 'post', 'enctype' => 'multipart/form-data','class' => 'needs-validation', 'novalidate']) }}
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-lg-6 mb-3 img-validate-class">
                                    <div class="form-group">
                                        <img src="{{ !empty($users->avatar) ? $profile . '/' . $users->avatar : $profile . '/avatar.png' }}"
                                            id="blah" class="img-thumbnail m-2 w-25"/>
                                        <span class="profiles"></span>
                                        <div class="choose-files mt-3">
                                            <label for="avatar">
                                                <div class="bg-primary company_logo_update mb-3" style="cursor: pointer;"> <i class="ti ti-upload px-1"></i>{{ __('Choose file here') }}</div>

                                                <input type="file" class="form-control file d-none file-validate" id="avatar" name="profile"
                                                    data-filename="profiles"
                                                    onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                                    <span class="text-xs text-muted mb-5">{{__('Please upload a valid image file. Size of image should not be more than 2MB.')}}</span>
                                            </label>
                                            <p class="file-error text-danger" style=""></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}<x-required></x-required>
                                        {{ Form::text('name', null, ['class' => 'form-control font-style', 'placeholder' => __('Enter User Name'),'required'=>'required']) }}
                                        @error('name')
                                            <span class="invalid-name" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('email', __('Email'), ['class' => 'form-label']) }}<x-required></x-required>
                                        {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('Enter User Email'),'required'=>'required']) }}
                                        @error('email')
                                            <span class="invalid-email" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                {{ Form::submit(__('Save Change'), ['class' => 'btn btn-print-invoice btn-primary ']) }}
                            </div>

                        </div>
                        {{ Form::close() }}

                    </div>

                    <div id="useradd-3" class="card">
                        <div class="card-header">
                            <h5>{{ __('Change Password') }}</h5>
                            <small class="text-muted">{{ __('Edit details about your Password') }}</small>
                        </div>
                        {{ Form::model($userDetail, ['route' => ['update.password', $userDetail->id], 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) }}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        {{ Form::label('current_password', __('Current Password'), ['class' => 'form-label']) }}<x-required></x-required>
                                        {{ Form::password('current_password', ['class' => 'form-control', 'placeholder' => __('Enter Current Password'),'required'=>'required']) }}

                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        {{ Form::label('new_password', __('New Password'), ['class' => 'form-label']) }}<x-required></x-required>
                                        {{ Form::password('new_password', ['class' => 'form-control', 'placeholder' => __('Enter New Password'),'required'=>'required']) }}

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('confirm_password', __('Re-type New Password'), ['class' => 'form-label']) }}<x-required></x-required>
                                        {{ Form::password('confirm_password', ['class' => 'form-control', 'placeholder' => __('Enter Re-type New Password'),'required'=>'required']) }}

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            {{ Form::submit(__('Save Change'), ['class' => 'btn btn-print-invoice  btn-primary ']) }}
                        </div>
                        {{ Form::close() }}



                    </div>

                    <div id="useradd-4" class="card">
                        <div class="card-header">
                            <h5 class="mb-2">{{ __('Two Factor Authentication')}}</h5>
                        </div>
                        <div class="card-body">
                            <p>{{ __('Two factor authentication (2FA) strengthens access security by requiring two methods (also referred to as factors) to verify your identity. Two factor authentication protects against phishing, social engineering and password brute force attacks and secures your logins from attackers exploiting weak or stolen credentials.')}}</p>
                            @if($data['user']->google2fa_secret == null)
                                @can('google authentication enable')
                                    <form class="form-horizontal" method="POST" action="{{ route('generate2faSecret') }}">
                                        {{ csrf_field() }}
                                        <div class="col-lg-12 text-center">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __(' Generate Secret Key to Enable 2FA')}}
                                            </button>
                                        </div>
                                    </form>
                                @endcan
                            @elseif($data['user']->google2fa_enable == 0 && $data['user']->google2fa_secret != null)
                                    1. {{__('Install “Google Authentication App” on your')}} <a href="https://apps.apple.com/us/app/google-authenticator/id388497605" target="_black"> {{ __('IOS')}}</a> {{ __('or')}} <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2" target="_black">{{ __('Android phone.')}}</a><br/>
                                    2. {{ __('Open the Google Authentication App and scan the below QR code.')}}<br/>
                                    @php
                                        $f = finfo_open();
                                        $mime_type = finfo_buffer($f, $data['google2fa_url'], FILEINFO_MIME_TYPE);
                                    @endphp
                                    @if($mime_type == 'text/plain')
                                        <img src="{{ $data['google2fa_url'] }}" alt="">
                                    @else
                                        {!! $data['google2fa_url'] !!}
                                    @endif
                                    <br/><br/>
                                    {{ __('Alternatively, you can use the code:')}} <code>{{ $data['secret'] }}</code>.<br/>
                                    3. {{ __('Enter the 6-digit Google Authentication code from the app')}}<br/><br/>
                                    @can('google authentication enable')
                                        <form class="form-horizontal" method="POST" action="{{ route('enable2fa') }}">
                                            {{ csrf_field() }}
                                            <div class="form-group{{ $errors->has('verify-code') ? ' has-error' : '' }}">
                                                <label for="secret" class="col-form-label">{{ __('Authenticator Code')}}</label>
                                                <input id="secret" type="password" class="form-control" name="secret" required="required" placeholder="{{ __('Enter Authenticator Code') }}">
                                            </div>
                                            <div class="col-lg-12 text-center">
                                                <button type="submit" class="btn btn-primary">
                                                    {{__('Enable 2FA')}}
                                                </button>
                                            </div>
                                        </form>
                                    @endcan
                            @elseif($data['user']->google2fa_enable == 1 && $data['user']->google2fa_secret != null)
                                <div class="alert alert-success">
                                    {{ __('2FA is currently')}} <strong>{{ __('Enabled')}}</strong> {{ __('on your account.')}}
                                </div>
                                <p>{{ __('If you are looking to disable Two Factor Authentication. Please confirm your password and Click Disable 2FA Button.')}}</p>
                                @can('google authentication disable')
                                    <form class="form-horizontal" method="POST" action="{{ route('disable2fa') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                            <label for="change-password" class="col-form-label">{{ __('Current Password')}}</label>
                                                <input id="current-password" type="password" class="form-control" name="current-password" required="required">
                                                @if ($errors->has('current-password'))
                                                    <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('current-password') }}</strong>
                                                </span>
                                                @endif
                                        </div>
                                        <div class="col-lg-12 text-center">
                                            <button type="submit" class="btn btn-primary">
                                                {{__('Disable 2FA')}}
                                            </button>
                                        </div>
                                    </form>
                                @endcan
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
@endsection
