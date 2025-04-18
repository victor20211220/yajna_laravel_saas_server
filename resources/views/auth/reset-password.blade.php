@extends('layouts.auth')
@section('content')
    @php
        use App\Models\Utility;
        $logo = asset(Storage::url('uploads/logo/'));
        $company_logo = Utility::getValByName('company_logo');
    @endphp


    <div class="card-body">
        <div>
            <h2 class="mb-3 f-w-600"><span class="text-primary">{{ __('Reset') }} {{ __('Password!') }}</span></h2>
        </div>
        {{ Form::open(['route' => 'password.update', 'method' => 'post', 'id' => '', 'class' => 'needs-validation', 'novalidate' => '']) }}
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <div class="custom-login-form">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('Email') }}</label><x-required></x-required>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{__('Enter Your Email')}}" required>
                @error('email')
                    <span class="error invalid-email text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label class="form-label">{{ __('Password') }}</label><x-required></x-required>
                <input type="password" id="password" name="password"
                    class="form-control  @error('password') is-invalid @enderror" required autocomplete="new-password"
                    placeholder="{{__('Enter Your Password')}}" required>
                @error('password')
                    <span class="error invalid-password text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label class="form-label">{{ __('Confirm Password') }}</label><x-required></x-required>
                <input type="password" id="password" name="password_confirmation"
                    class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password"
                    placeholder="{{__('Confirm Your Password')}}">
                @error('password_confirmation')
                    <span class="error invalid-password text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="d-grid">
                {{-- {{ Form::submit(__('Login'), ['class' => 'btn btn-primary mt-2', 'id' => 'saveBtn']) }} --}}
                <button type="submit" class="btn btn-primary mt-2"><span
                        class="d-block py-1">{{ __('Reset Password') }}</span></button>
            </div>
        </div>
        {{ Form::close() }}

    </div>
@endsection
