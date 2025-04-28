<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="authorizenet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
    <title>{{ __('Authorizenet Plan Payment') }}</title>
    <meta name="description" content="authorizenet">
    <meta name="keywords" content="authorizenet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="icon" href="assets/images/favicon.png">

    <link rel="stylesheet" href="resources/css/AuthorizeNet/style.css">
    <link rel="stylesheet" href="resources/css/AuthorizeNet/main-style.css">
    <link rel="stylesheet" href="resources/css/AuthorizeNet/responsive.css">
    <link rel="stylesheet" href="resources/css/AuthorizeNet/daterangepicker.css">
    <style>
        .expiration input {
            border: 0;
        }
    </style>
</head>
<body class="theme-1">
@php
    $payment_setting = \App\Models\Utility::getAdminPaymentSetting();
    $currency = isset($payment_setting['currency']) ? $payment_setting['currency'] : 'USD';

@endphp
    <section class="payment-sec">
        <div class="container">
            <div class="card">
                <div class="card-body w-100">
                    <div class="payment-logo text-center pb-3">
                        <img src="{{asset('custom/AuthorizeNet/img/payment-logo.jpg')}}" alt="payment-logo" loading="lazy">
                    </div>
                    <form class="payment-form" method="post" action="{{ route('plan.get.authorizenet.status') }}" class="needs-validation" novalidate="">
                        @csrf
                        <input type="hidden" name="data"  value="{{$data}}">

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label class="d-block mb-1">{{ __('Owner Name') }}</label><x-required></x-required>
                                    <input class="form-control" type="text" placeholder="Name" value="{{ Auth::user()->name }}" disabled>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label class="d-block mb-1">{{ __('Amount') }}</label><x-required></x-required>
                                    <div class="input-group">
                                        <span class="input-group-prepend"><span
                                                class="input-group-text">{{ $currency ? $currency : 'USD' }}</span></span>
                                                <input class="form-control" type="number" placeholder="Amount" value="{{ $price }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label class="d-block mb-1">{{ __('Card Number') }}</label><x-required></x-required>
                                    <input class="form-control" pattern="\d{16}"  type="text" placeholder="Enter Card Number" name="cardNumber" required>
                                    <small class="form-text text-muted">{{ __('Please enter a 16-digit card number.') }}</small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group ">
                                    <label class="d-block mb-1">{{ __('CVV') }}</label><x-required></x-required>
                                    <input class="form-control" type="text" placeholder="Enter CVV" name="cvv" maxlength="3" size="3" required>
                                </div>
                            </div>
                            <div class="col-sm-4 form-group" >
                                <label class="d-block mb-1">{{ __('Expiration') }}</label><x-required></x-required>
                                <div class=" expiration form-control">
                                    <input type="text" class="" name="month" placeholder="MM" maxlength="2" size="2" />
                                    <span>/</span>
                                    <input type="text" class="" name="year" placeholder="YYYY" maxlength="4" size="4" />
                                </div>
                            </div>
                            <div class="col-12 w-50 m-auto">
                                <button class="btn btn-primary text-uppercase w-100">{{ __('pay') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('custom/AuthorizeNet/js/jquery.min.js') }}"></script>
    <script src="{{ asset('custom/AuthorizeNet/js/custom.js') }}"></script>
</body>
</html>
