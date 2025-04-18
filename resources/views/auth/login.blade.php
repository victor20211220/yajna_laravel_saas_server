@extends('layouts.auth')

@section('page-title')
    {{ __('Login') }}
@endsection
@php
    use \App\Models\Utility;
    $languages = \App\Models\Utility::languages();

    $logo = asset(Storage::url('uploads/logo/'));
    $company_logo = Utility::getValByName('company_logo');
    $settings = Utility::settings();
    $recaptcha = \App\Models\Utility::setCaptchaConfig();

@endphp
@section('language-bar')
    <div class="lang-dropdown-only-desk">
        <li class="dropdown dash-h-item drp-language">
            <a class="dash-head-link dropdown-toggle btn" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="drp-text"> {{ $languages[$lang] }}
                </span>
            </a>
            <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
                @foreach ($languages as $code => $language)
                    <a href="{{ route('login', $code) }}"tabindex="0"
                        class="dropdown-item {{ $code == $lang ? 'active' : '' }} ">
                        <span>{{ Str::ucFirst($language) }}</span>
                    </a>
                @endforeach
            </div>
        </li>
    </div>
@endsection

@push('custom-scripts')
    @if ($settings['RECAPTCHA_MODULE'] == 'yes')
        @if (isset($settings['RECAPTCHA_VERSION']) && $settings['RECAPTCHA_VERSION'] == 'v2')
            {!! NoCaptcha::renderJs() !!}
        @else
            <script src="https://www.google.com/recaptcha/api.js?render={{ $settings['NOCAPTCHA_SITEKEY'] }}"></script>
            <script>
               document.addEventListener("DOMContentLoaded", function() {
                grecaptcha.ready(function() {
                    grecaptcha.execute('{{ $settings['NOCAPTCHA_SITEKEY'] }}', { action: 'submit' }).then(function(token) {
                        document.getElementById('g-recaptcha-response').value = token;
                    });
                });
            });
            </script>
        @endif
    @endif
    <script>
        $(document).ready(function() {
            $("#loginForm").submit(function(e) {
                $("#saveBtn").attr("disabled", true);
                return true;
            });
        });
    </script>
@endpush


@section('content')
    <!-- [ auth-signup ] start -->


    <div class="card-body">
        <div>
            <h2 class="mb-3 f-w-600">{{ __('Login') }}</h2>
        </div>
        {{ Form::open(['route' => 'login', 'method' => 'post', 'id' => 'loginForm', 'class' => 'login-form','class' => 'needs-validation', 'novalidate']) }}
        <div class="custom-login-form">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('Email') }}</label><x-required></x-required>
                {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('Enter Your Email'), 'required'=>'required']) }}
                @error('email')
                    <span class="error invalid-email text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label class="form-label">{{ __('Password') }}</label><x-required></x-required>
                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => __('Enter Your Password'), 'id' => 'input-password','required'=>'required']) }}
                @error('password')
                    <span class="error invalid-password text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-4">
                <div class="d-flex flex-wrap align-items-center justify-content-between">
                    @if (Route::has('password.request'))
                        <span><a href="{{ route('password.request', $lang) }}"
                                tabindex="0">{{ __('Forgot your password?') }}</a></span>
                    @endif
                </div>
            </div>
            @if ($settings['RECAPTCHA_MODULE'] == 'yes')
                @if (isset($settings['RECAPTCHA_VERSION']) && $settings['RECAPTCHA_VERSION'] == 'v2')
                    <div class="form-group col-lg-12 col-md-12 mt-3">
                        {!! NoCaptcha::display($settings['cust_darklayout'] == 'on' ? ['data-theme' => 'dark'] : []) !!}
                        @error('g-recaptcha-response')
                            <span class="small text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                @else
                    <div class="form-group col-lg-12 col-md-12 mt-3">
                        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" class="form-control">
                        @error('g-recaptcha-response')
                            <span class="error small text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                @endif
            @endif
            <div class="d-grid">
                {{ Form::submit(__('Login'), ['class' => 'btn btn-primary mt-2', 'id' => 'saveBtn']) }}
            </div>
            @if (Utility::getValByName('signup_button') == 'on')
                <p class="my-4 text-center">{{ __("Don't have an account?") }}
                    <a href="{{ url('register', $lang) }}" tabindex="0">{{ __('Register') }}</a>
                </p>
            @endif
        </div>
        {{ Form::close() }}

    </div>

    {{-- Custom End --}}
    <!-- [ auth-signup ] end -->
@endsection
