@extends('layouts.auth')
@section('page-title')
    {{ __('Login') }}
@endsection
@section('content')
    <div class="card">
        <div class="row align-items-center text-start">
            <div class="card-body">
                <div class="">
                    <h2 class="mb-3 f-w-600">{{ __('Login') }}</h2>
                </div>
                <form class="form-horizontal" action="{{ route('2faVerify') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="2fa_referrer"
                        value="{{ request()->get('2fa_referrer') ?? URL()->current() }}">

                    <div class="form-group">
                        <div class="col-md-12">
                            <p>Please enter the <strong>OTP</strong> generated on your Authenticator App. <br> Ensure you
                                submit the current one because it refreshes every 30 seconds.</p>
                            <label for="one_time_password" class="col-md-12 form-label">One Time Password</label>
                            <input id="one_time_password" type="password"
                                class="form-control @if ($errors->any()) is-invalid @endif"
                                name="one_time_password" required="required" autofocus>
                            @if ($errors->any())
                                <span class="error invalid-email text-danger" role="alert">
                                    @foreach ($errors->all() as $error)
                                        <small>{{ $error }}</small>
                                    @endforeach
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4 mt-3">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
