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

@endphp

@push('custom-scripts')
    <script>
        $(document).ready(function () {
            $("#loginForm").submit(function (e) {
                $("#saveBtn").attr("disabled", true);
                return true;
            });
        });
        $('#togglePassword').on('click', function () {
            var passwordInput = $('#password');
            var icon = $(this);

            if (passwordInput.attr('type') === 'password') {
                passwordInput.attr('type', 'text');
                icon.removeClass('bi-eye').addClass('bi-eye-slash');
            } else {
                passwordInput.attr('type', 'password');
                icon.removeClass('bi-eye-slash').addClass('bi-eye');
            }
        });
    </script>
@endpush


@section('content')
    <!-- [ auth-signup ] start -->
    {{ Form::open(['route' => 'login', 'method' => 'post', 'id' => 'loginForm']) }}
    <h2 class="fw-bold mb-3 text-center text-md-start">Welcome!</h2>
    <p class="mb-4 text-muted">Enter your Email or Phone Number to log in</p>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        {{ Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => __('Email'), 'required'=> true]) }}
        @error('email')
        <span class="error invalid-email text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <div class="input-group">
            {{ Form::password('password', ['class' => 'form-control rounded-start', 'placeholder' => __('Enter Your Password'), 'id' => 'password','required'=> true]) }}
            <span class="input-group-text bg-white border-start-0 rounded-end" style="cursor: pointer;">
                <i class="bi bi-eye" id="togglePassword"></i>
            </span>
            @error('password')
            <span class="error invalid-password text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="text-end mt-1">
            <a href="{{ route('password.request', $lang) }}" class="small text-decoration-none">Forgot Password?</a>
        </div>
    </div>

    {{ Form::submit(__('Log in'), ['class' => 'btn btn-primary w-100 mt-3', 'id' => 'saveBtn']) }}
    {{ Form::close() }}
    <!-- [ auth-signup ] end -->
@endsection
