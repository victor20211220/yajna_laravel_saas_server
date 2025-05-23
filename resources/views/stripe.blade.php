@extends('layouts.admin')

@push('custom-scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="{{ asset('custom/js/jquery.form.js') }}"></script>
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
    <script>
        var config = {
            "publicKey": "{{ isset($admin_payment_setting['khalti_public_key']) ? $admin_payment_setting['khalti_public_key'] : '' }}",
            "productIdentity": "1234567890",
            "productName": "demo",
            "productUrl": "{{env('APP_URL')}}",
            "paymentPreference": [
                "KHALTI",
                "EBANKING",
                "MOBILE_BANKING",
                "CONNECT_IPS",
                "SCT",
            ],
            "eventHandler": {
                onSuccess (payload) {
                    if(payload.status==200) {
                        $.ajaxSetup({
                                headers: {
                                    'X-CSRF-Token': '{{csrf_token()}}'
                                }
                            });
                        $.ajax({
                            url: '{{ route('plan.get.khalti.status') }}',
                            method: 'POST',
                            data : {
                                'payload' : payload,
                                'coupon_code' : $('.coupon').val(),
                                'plan_id' : $('#plan_id').val(),
                            },
                            beforeSend: function () {
                                $(".loader-wrapper").removeClass('d-none');
                            },
                            success: function(data) {
                                $(".loader-wrapper").addClass('d-none');
                                if(data.status_code === 200){
                                    toastrs('{{ __('Success') }}', 'Payment Done Successfully', 'success');
                                    setTimeout(() => {
                                     location.href = '{{route('plans.index')}}';
                                    }, 2000);
                                }
                                else{
                                    toastrs('{{ __('Error') }}', 'Payment Failed', 'success');
                                }
                            },
                            error: function(err) {
                                toastrs('{{ __('Error') }}', err.response, 'success');
                            },
                        });
                    }
                },
                onError (error) {
                    toastrs('{{ __('Error') }}', error, 'success');
                },
                onClose () {
                }
            }

        };

        var checkout = new KhaltiCheckout(config);
        var btn = document.getElementsByClassName("payment-btn")[0];
    </script>
        <script>
            $(document).on("click", ".payment-btn", function(event) {

                event.preventDefault()
                get_khalti_status();
        })

        function get_khalti_status(){
            var coupon_code = $('.coupon').val();
            var plan_id = $('#plan_id').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route('plan.pay.with.khalti') }}',
                method: 'POST',
                data : {
                    'coupon_code' : coupon_code,
                    'plan_id' : plan_id,
                },

                beforeSend: function () {
                    $(".loader-wrapper").removeClass('d-none');
                },
                success: function (data) {
                    $(".loader-wrapper").addClass('d-none');
                    if(data == 0)
                    {
                        toastrs('{{ __('Success') }}', 'Payment Done Successfully', 'success');
                        setTimeout(() => {
                            location.href = '{{route('plans.index')}}';
                        }, 2000);
                    }
                    else
                    {

                        let price = data*100;
                        checkout.show({amount: price});
                    }
                }
            });
        }
    </script>
    @if (isset($admin_payment_setting['is_stripe_enabled']) &&
            $admin_payment_setting['is_stripe_enabled'] == 'on' &&
            !empty($admin_payment_setting['stripe_key']) &&
            !empty($admin_payment_setting['stripe_secret']))
        <?php $stripe_session = Session::get('stripe_session'); ?>
        <?php if(isset($stripe_session) && $stripe_session): ?>
        <script>
            var stripe = Stripe('{{ $admin_payment_setting['stripe_key'] }}');
            stripe.redirectToCheckout({
                sessionId: '{{ $stripe_session->id }}',
            }).then((result) => {
                console.log(result);
            });
        </script>
        <?php endif ?>
    @endif

    <script type="text/javascript">
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300
        })
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(document).on("click", "#pay_with_paystack", function() {
            @if (isset($admin_payment_setting['paystack_public_key']))
                $('#paystack-payment-form').ajaxForm(function(res) {
                    if (res.flag == 1) {
                        var paystack_callback = "{{ url('/plan/paystack') }}";
                        var order_id = '{{ time() }}';
                        var coupon_id = res.coupon;
                        var handler = PaystackPop.setup({
                            key: '{{ $admin_payment_setting['paystack_public_key'] }}',
                            email: res.email,
                            amount: res.total_price * 100,
                            currency: res.currency,
                            ref: 'pay_ref_id' + Math.floor((Math.random() * 1000000000) +
                                1
                            ), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                            metadata: {
                                custom_fields: [{
                                    display_name: "Email",
                                    variable_name: "email",
                                    value: res.email,
                                }]
                            },

                            callback: function(response) {
                                window.location.href = paystack_callback + '/' + response
                                    .reference + '/' + '{{ encrypt($plan->id) }}' +
                                    '?coupon_id=' + coupon_id
                            },
                            onClose: function() {
                                alert('window closed');
                            }
                        });
                        handler.openIframe();
                    } else if (res.flag == 2) {
                        setTimeout(() => {
                            toastrs('{{ __('Success') }}', res.msg, 'success');
                            window.location.href = "{{ route('plans.index') }}";
                        }, 1000);
                    } else {
                        show_toastr('Error', data.message, 'msg');
                    }

                }).submit();
            @endif
        });
        @if (isset($admin_payment_setting['flutterwave_public_key']))
            //    Flaterwave Payment
            $(document).on("click", "#pay_with_flaterwave", function() {

                $('#flaterwave-payment-form').ajaxForm(function(res) {

                    if (res.flag == 1) {
                        var coupon_id = res.coupon;
                        var API_publicKey = '{{ $admin_payment_setting['flutterwave_public_key'] }}';
                        var nowTim = "{{ date('d-m-Y-h-i-a') }}";
                        var flutter_callback = "{{ url('/plan/flaterwave') }}";
                        var x = getpaidSetup({
                            PBFPubKey: API_publicKey,
                            customer_email: '{{ Auth::user()->email }}',
                            amount: res.total_price,
                            currency: '{{ $admin_payment_setting['CURRENCY'] }}',
                            txref: nowTim + '__' + Math.floor((Math.random() * 1000000000)) +
                                'fluttpay_online-' + {{ date('Y-m-d') }},
                            meta: [{
                                metaname: "payment_id",
                                metavalue: "id"
                            }],
                            onclose: function() {},
                            callback: function(response) {
                                var txref = response.tx.txRef;
                                if (
                                    response.tx.chargeResponseCode == "00" ||
                                    response.tx.chargeResponseCode == "0"
                                ) {
                                    window.location.href = flutter_callback + '/' + txref +
                                        '/' +
                                        '{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}?coupon_id=' +
                                        coupon_id;
                                } else {
                                    // redirect to a failure page.
                                }
                                x
                                    .close(); // use this to close the modal immediately after payment.
                            }
                        });
                    } else if (res.flag == 2) {
                        setTimeout(() => {
                            toastrs('{{ __('Success') }}', res.msg, 'success');
                            window.location.href = "{{ route('plans.index') }}";
                        }, 1000);
                    } else {
                        show_toastr('Error', data.message, 'msg');
                    }

                }).submit();
            });
        @endif
        @if (isset($admin_payment_setting['razorpay_public_key']))
            // Razorpay Payment
            $(document).on("click", "#pay_with_razorpay", function() {
                $('#razorpay-payment-form').ajaxForm(function(res) {
                    if (res.flag == 1) {

                        var razorPay_callback = '{{ url('/plan/razorpay') }}';
                        var totalAmount = res.total_price * 100;
                        var coupon_id = res.coupon;
                        var options = {
                            "key": "{{ $admin_payment_setting['razorpay_public_key'] }}", // your Razorpay Key Id
                            "amount": totalAmount,
                            "name": 'Plan',
                            "currency": '{{ $admin_payment_setting['CURRENCY'] }}',
                            "description": "",
                            "handler": function(response) {
                                window.location.href = razorPay_callback + '/' + response
                                    .razorpay_payment_id + '/' +
                                    '{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}?coupon_id=' +
                                    coupon_id;
                            },
                            "theme": {
                                "color": "#528FF0"
                            }
                        };
                        var rzp1 = new Razorpay(options);
                        rzp1.open();
                    } else if (res.flag == 2) {
                        setTimeout(() => {
                            toastrs('{{ __('Success') }}', res.msg, 'success');
                            window.location.href = "{{ route('plans.index') }}";
                        }, 1000);
                    } else {
                        toastrs('Error', res.msg, 'msg');
                    }

                }).submit();
            });
        @endif
        // Payfast



        $(document).ready(function() {

            $(document).on('click', '.apply-coupon', function() {
                var ele = $(this);
                var coupon = ele.closest('.form-group').find('.coupon').val();

                $.ajax({
                    url: '{{ route('apply.coupon') }}',
                    type: 'GET',
                    datType: 'json',
                    data: {
                        plan_id: '{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}',
                        coupon: coupon
                    },
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    success: function(data) {
                        $('.final-price').text(data.final_price);
                        $('#final_price_pay').val(data.price);
                        $('#mollie_total_price').val(data.price);
                        $('#skrill_total_price').val(data.price);
                        $('#coingate_total_price').val(data.price);
                        $('.bank_amount').text(data.final_price);
                        $('.stripe_amount').text(data.final_price);
                        $('#stripe_coupon, #paypal_coupon, #skrill_coupon,#coingate_coupon,#bank_coupon')
                            .val(coupon);

                        if (ele.closest($('#payfast-form')).length == 1) {
                            get_payfast_status(data.price, coupon);
                        }

                        if (data.is_success == true) {
                            toastrs('{{ __('Success') }}', data.message, 'success');
                        } else if (data.is_success == false) {
                            toastrs('{{ __('Error') }}', data.message, 'error');
                        } else {
                            toastrs('{{ __('Error') }}', 'Coupon code is required', 'error');
                        }
                    }
                })
            });
        });
        @if (
            $admin_payment_setting['is_payfast_enabled'] == 'on' &&
                !empty($admin_payment_setting['payfast_merchant_id']) &&
                !empty($admin_payment_setting['payfast_merchant_key']))
            $(document).ready(function() {
                get_payfast_status(amount = 0, coupon = null);
            })

            function get_payfast_status(amount, coupon) {
                var plan_id = $('#plan_id').val();
                $.ajax({
                    url: '{{ route('payfast.payment') }}',
                    method: 'POST',
                    data: {
                        'plan_id': plan_id,
                        'coupon_amount': amount,
                        'coupon_code': coupon
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {

                        if (data.success == true) {
                            $('#get-payfast-inputs').append(data.inputs);

                        } else {
                            show_toastr('Error', data.inputs, 'error')
                        }
                    }
                });
            }
        @endif
    </script>
@endpush

@push('css-page')
    <style>
        .page-content.overflow-hidden {
            overflow: unset !important;
        }
    </style>
@endpush

@php
    $dir = asset(Storage::url('uploads/plan'));
    $dir_payment = asset(Storage::url('uploads/payments'));
@endphp
@section('page-title')
    {{ __('Plan Subscription') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('plans.index') }}">{{ __('Plan') }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Plan Subscription') }}</li>
@endsection
@section('content')

    <div class="row" style="align-items: flex-start;">
        <div class="col-xl-3 plans-sticky sticky-top" style="top:30px">
            <div class="card mb-5">
                <div class="list-group list-group-flush" id="useradd-sidenav">
                    @if ($admin_payment_setting['is_manually_enabled'] == 'on')
                        <a href="#manual_payment"
                            class="list-group-item list-group-item-action border-0">{{ __('Manually') }}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    @endif
                    @if ($admin_payment_setting['is_bank_enabled'] == 'on')
                        <a href="#bank_payment"
                            class="list-group-item list-group-item-action border-0">{{ __('Bank Transfer') }}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    @endif

                    @if (
                        $admin_payment_setting['is_stripe_enabled'] == 'on' &&
                            !empty($admin_payment_setting['stripe_key']) &&
                            !empty($admin_payment_setting['stripe_secret']))
                        <a href="#stripe_payment"
                            class="list-group-item list-group-item-action border-0">{{ __('Stripe') }}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    @endif

                    @if (
                        $admin_payment_setting['is_paypal_enabled'] == 'on' &&
                            !empty($admin_payment_setting['paypal_client_id']) &&
                            !empty($admin_payment_setting['paypal_secret_key']))
                        <a href="#paypal_payment"
                            class="list-group-item list-group-item-action  border-0">{{ __('Paypal') }}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    @endif

                    @if (
                        $admin_payment_setting['is_paystack_enabled'] == 'on' &&
                            !empty($admin_payment_setting['paystack_public_key']) &&
                            !empty($admin_payment_setting['paystack_secret_key']))
                        <a href="#paystack_payment"
                            class="list-group-item list-group-item-action  border-0">{{ __('Paystack') }}<div
                                class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                    @endif


                    @if (isset($admin_payment_setting['is_flutterwave_enabled']) && $admin_payment_setting['is_flutterwave_enabled'] == 'on')
                        <a href="#flutterwave_payment"
                            class="list-group-item list-group-item-action  border-0">{{ __('Flutterwave') }}<div
                                class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                    @endif

                    @if (isset($admin_payment_setting['is_razorpay_enabled']) && $admin_payment_setting['is_razorpay_enabled'] == 'on')
                        <a href="#razorpay_payment"
                            class="list-group-item list-group-item-action  border-0">{{ __('Razorpay') }} <div
                                class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                    @endif

                    @if (isset($admin_payment_setting['is_mercado_enabled']) && $admin_payment_setting['is_mercado_enabled'] == 'on')
                        <a href="#mercado_payment"
                            class="list-group-item list-group-item-action  border-0">{{ __('Mercado Pago') }}<div
                                class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                    @endif

                    @if (isset($admin_payment_setting['is_paytm_enabled']) && $admin_payment_setting['is_paytm_enabled'] == 'on')
                        <a href="#paytm_payment"
                            class="list-group-item list-group-item-action  border-0">{{ __('Paytm') }}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    @endif

                    @if (isset($admin_payment_setting['is_mollie_enabled']) && $admin_payment_setting['is_mollie_enabled'] == 'on')
                        <a href="#mollie_payment"
                            class="list-group-item list-group-item-action  border-0">{{ __('Mollie') }}<div
                                class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                    @endif

                    @if (isset($admin_payment_setting['is_skrill_enabled']) && $admin_payment_setting['is_skrill_enabled'] == 'on')
                        <a href="#skrill_payment"
                            class="list-group-item list-group-item-action  border-0">{{ __('Skrill') }}<div
                                class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                    @endif

                    @if (isset($admin_payment_setting['is_coingate_enabled']) && $admin_payment_setting['is_coingate_enabled'] == 'on')
                        <a href="#coingate_payment"
                            class="list-group-item list-group-item-action  border-0">{{ __('Coingate') }}<div
                                class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                    @endif

                    @if (isset($admin_payment_setting['is_paymentwall_enabled']) && $admin_payment_setting['is_paymentwall_enabled'] == 'on')
                        <a href="#paymentwall_payment"
                            class="list-group-item list-group-item-action  border-0">{{ __('Paymentwall') }}<div
                                class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                    @endif
                    @if (isset($admin_payment_setting['is_toyyibpay_enabled']) && $admin_payment_setting['is_toyyibpay_enabled'] == 'on')
                        <a href="#toyyibpay_payment"
                            class="list-group-item list-group-item-action  border-0">{{ __('Toyyibpay') }}<div
                                class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                    @endif
                    @if (isset($admin_payment_setting['is_payfast_enabled']) && $admin_payment_setting['is_payfast_enabled'] == 'on')
                        <a href="#payfast_payment"
                            class="list-group-item list-group-item-action border-0">{{ __('Payfast') }}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    @endif
                    @if (isset($admin_payment_setting['is_iyzipay_enabled']) && $admin_payment_setting['is_iyzipay_enabled'] == 'on')
                        <a href="#iyzipay_payment"
                            class="list-group-item list-group-item-action border-0">{{ __('Iyzipay') }}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    @endif
                    @if (isset($admin_payment_setting['is_sspay_enabled']) && $admin_payment_setting['is_sspay_enabled'] == 'on')
                        <a href="#sspay_payment"
                            class="list-group-item list-group-item-action border-0">{{ __('SSpay') }}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    @endif
                    @if (isset($admin_payment_setting['is_paytab_enabled']) && $admin_payment_setting['is_paytab_enabled'] == 'on')
                        <a href="#paytab_payment"
                            class="list-group-item list-group-item-action border-0">{{ __('Paytab') }}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    @endif
                    @if (isset($admin_payment_setting['is_benefit_enabled']) && $admin_payment_setting['is_benefit_enabled'] == 'on')
                        <a href="#benefit_payment"
                            class="list-group-item list-group-item-action border-0">{{ __('Benefit') }}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    @endif
                    @if (isset($admin_payment_setting['is_cashfree_enabled']) && $admin_payment_setting['is_cashfree_enabled'] == 'on')
                        <a href="#cashfree_payment"
                            class="list-group-item list-group-item-action border-0">{{ __('Cashfree') }}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    @endif
                    @if (isset($admin_payment_setting['is_aamarpay_enabled']) && $admin_payment_setting['is_aamarpay_enabled'] == 'on')
                        <a href="#aamarpay_payment"
                            class="list-group-item list-group-item-action border-0">{{ __('Aamarpay') }}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    @endif
                    @if (isset($admin_payment_setting['is_paytr_enabled']) && $admin_payment_setting['is_paytr_enabled'] == 'on')
                        <a href="#paytr_payment"
                            class="list-group-item list-group-item-action border-0">{{ __('Pay TR') }}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    @endif
                    @if (isset($admin_payment_setting['is_midtrans_enabled']) && $admin_payment_setting['is_midtrans_enabled'] == 'on')
                        <a href="#midtrans_payment"
                            class="list-group-item list-group-item-action border-0">{{ __('Midtrans') }}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    @endif
                    @if (isset($admin_payment_setting['is_xendit_enabled']) && $admin_payment_setting['is_xendit_enabled'] == 'on')
                        <a href="#xendit_payment"
                            class="list-group-item list-group-item-action border-0">{{ __('Xendit') }}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    @endif
                    @if (isset($admin_payment_setting['is_yookassa_enabled']) && $admin_payment_setting['is_yookassa_enabled'] == 'on')
                        <a href="#yookassa_payment"
                            class="list-group-item list-group-item-action border-0">{{ __('YooKassa') }}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    @endif
                    @if (isset($admin_payment_setting['is_nepalste_enabled']) && $admin_payment_setting['is_nepalste_enabled'] == 'on')
                        <a href="#nepalste_payment"
                            class="list-group-item list-group-item-action border-0">{{ __('Nepalste') }}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    @endif
                    @if (isset($admin_payment_setting['is_paiement_enabled']) && $admin_payment_setting['is_paiement_enabled'] == 'on')
                        <a href="#paiement_payment"
                            class="list-group-item list-group-item-action border-0">{{ __('Paiement Pro') }}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    @endif
                    @if (isset($admin_payment_setting['is_cinetpay_enabled']) && $admin_payment_setting['is_cinetpay_enabled'] == 'on')
                        <a href="#cinetpay_payment"
                            class="list-group-item list-group-item-action border-0">{{ __('CinetPay') }}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    @endif
                    @if (isset($admin_payment_setting['is_payhere_enabled']) && $admin_payment_setting['is_payhere_enabled'] == 'on')
                        <a href="#payhere_payment"
                            class="list-group-item list-group-item-action border-0">{{ __('PayHere') }}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    @endif
                    @if (isset($admin_payment_setting['is_fedapay_enabled']) && $admin_payment_setting['is_fedapay_enabled'] == 'on')
                        <a href="#fedapay_payment"
                            class="list-group-item list-group-item-action border-0">{{ __('FedaPay') }}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    @endif
                    @if (isset($admin_payment_setting['is_tap_enabled']) && $admin_payment_setting['is_tap_enabled'] == 'on')
                        <a href="#tap_payment"
                            class="list-group-item list-group-item-action border-0">{{ __('Tap') }}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    @endif
                    @if (isset($admin_payment_setting['is_authorizenet_enabled']) &&
                            $admin_payment_setting['is_authorizenet_enabled'] == 'on')
                        <a href="#authorizenet_payment"
                            class="list-group-item list-group-item-action border-0">{{ __('AuthorizeNet') }}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    @endif
                    @if (isset($admin_payment_setting['is_khalti_enabled']) && $admin_payment_setting['is_khalti_enabled'] == 'on')
                        <a href="#khalti_payment"
                            class="list-group-item list-group-item-action border-0">{{ __('Khalti') }}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    @endif
                    @if (isset($admin_payment_setting['is_easybuzz_enabled']) && $admin_payment_setting['is_easybuzz_enabled'] == 'on')
                        <a href="#easybuzz_payment"
                            class="list-group-item list-group-item-action border-0">{{ __('Easybuzz') }}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    @endif
                    @if (isset($admin_payment_setting['ozow_payment_is_enabled']) && $admin_payment_setting['ozow_payment_is_enabled'] == 'on')
                        <a href="#ozow_payment"
                            class="list-group-item list-group-item-action border-0">{{ __('Ozow') }}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    @endif
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="card price-card price-1 wow animate__fadeInUp" data-wow-delay="0.2s"
                    style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                    <div class="card-body">
                        <span class="price-badge bg-primary">{{ $plan->name }}</span>
                        @if (\Auth::user()->type == 'company' && \Auth::user()->plan == $plan->id)
                            <div class="d-flex flex-row-reverse m-0 p-0 ">
                                <span class="d-flex align-items-center ">
                                    <i class="f-10 lh-1 fas fa-circle text-success"></i>
                                    <span class="ms-2">{{ __('Active') }}</span>
                                </span>
                            </div>
                        @endif
                        <span
                            class="mb-4 f-w-600 p-price">{{ env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$' }}{{ $plan->price }}<small
                                class="text-sm">{{ __('/ Duration : ') . __(ucfirst($plan->duration)) }}</small></span>
                        <p class="mb-0">
                            {{ 'Free Trial Day : ' }}{{ $plan->trial_day }}
                        </p>
                        <p class="mb-0">
                            {{ $plan->description }}
                        </p>
                        @if (\Auth::user()->type == 'company' && \Auth::user()->plan == $plan->id)
                            @if ($plan->duration !== 'Lifetime')
                                @if (
                                    \Auth::user()->type == 'company' &&
                                        (empty(\Auth::user()->plan_expire_date) || \Auth::user()->plan_expire_date < date('Y-m-d')))
                                    <p class="mb-0">
                                        {{ __('Plan Expired') }}
                                    </p>
                                @else
                                    <p class="mb-0">
                                        {{ __('Plan Expired : ') }}
                                        {{ !empty(\Auth::user()->plan_expire_date) ? date('d-m-Y', strtotime(\Auth::user()->plan_expire_date)) : 'Lifetime' }}
                                    </p>
                                @endif
                            @else
                                <p class="mb-0">
                                    {{ __('Plan Expired : Lifetime') }}
                                </p>
                            @endif
                        @endif
                        <ul class="list-unstyled my-2">
                            <li>
                                <span class="theme-avtar">
                                    <i class="text-primary ti ti-circle-plus"></i></span>
                                {{ count($plan->getThemes()) }} {{ __('Themes') }}
                            </li>
                            <li>
                                <span class="theme-avtar">
                                    <i class="text-primary ti ti-circle-plus"></i></span>
                                {{ $plan->business == '-1' ? 'Unlimited' : $plan->business }} {{ __('Business') }}
                            </li>
                            @if ($plan->enable_custdomain == 'on')
                                <li>
                                    <span class="theme-avtar">
                                        <i class="text-primary ti ti-circle-plus"></i></span>
                                    {{ __('Custom Domain') }}
                                </li>
                            @else
                                <li>
                                    <span class="theme-avtar">
                                        <i data-feather="x" class="text-danger"></i></span>
                                    <span class="text-danger"> {{ __('Custom Domain') }}</span>
                                </li>
                            @endif
                            @if ($plan->enable_branding == 'on')
                                <li>
                                    <span class="theme-avtar">
                                        <i class="text-primary ti ti-circle-plus"></i></span>
                                    {{ __('Branding') }}
                                </li>
                            @else
                                <li>
                                    <span class="theme-avtar">
                                        <i data-feather="x" class="text-danger"></i></span>
                                    <span class="text-danger">{{ __('Branding') }}</span>
                                </li>
                            @endif
                            @if ($plan->enable_custsubdomain == 'on')
                                <li>
                                    <span class="theme-avtar">
                                        <i class="text-primary ti ti-circle-plus"></i></span>
                                    {{ __('Sub Domain') }}
                                </li>
                            @else
                                <li>
                                    <span class="theme-avtar">
                                        <i data-feather="x" class="text-danger"></i></span>
                                    <span class="text-danger">{{ __('Sub Domain') }}</span>
                                </li>
                            @endif
                            @if ($plan->pwa_business == 'on')
                                <li>
                                    <span class="theme-avtar">
                                        <i class="text-primary ti ti-circle-plus"></i></span>
                                    {{ __('Progressive Web App (PWA)') }}
                                </li>
                            @else
                                <li>
                                    <span class="theme-avtar">
                                        <i data-feather="x" class="text-danger"></i></span>
                                    <span class="text-danger">{{ __('Progressive Web App (PWA)') }}</span>
                                </li>
                            @endif
                            @if ($plan->enable_chatgpt == 'on')
                                <li>
                                    <span class="theme-avtar">
                                        <i class="text-primary ti ti-circle-plus"></i></span>
                                    {{ __('Chatgpt') }}
                                </li>
                            @else
                                <li>
                                    <span class="theme-avtar">
                                        <i data-feather="x" class="text-danger"></i></span>
                                    <span class="text-danger">{{ __('Chatgpt') }}</span>
                                </li>
                            @endif
                            @if ($plan->module)
                                @foreach (explode(',', $plan->module) as $module)
                                    <li>
                                        <span class="theme-avtar">
                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                        {{ \App\Models\Utility::Module_Alias_Name($module) }}
                                    </li>
                                @endforeach
                            @endif
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9">
            {{-- Manually Payment --}}
            @if ($admin_payment_setting['is_manually_enabled'] == 'on')
                <div id="manual_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('Manually') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="tab-pane {{ $admin_payment_setting['is_manually_enabled'] == 'on' ? 'active' : '' }}">
                            <p class="text-muted mb-0">
                                {{ __('Requesting manual payment for the planned amount for the subscriptions plan.') }}
                            </p>

                        </div>
                    </div>
                    <div class="card-footer text-end">
                        @if (\Auth::user()->requested_plan != $plan->id)
                            <a href="{{ route('send.request', [\Illuminate\Support\Facades\Crypt::encrypt($plan->id)]) }}"
                                class="btn btn-lg btn-primary btn-create" data-title="{{ __('Send Request') }}"
                                data-bs-placement="top" data-bs-toggle="tooltip"
                                data-bs-original-title="{{ __('Send Request') }}" data-toggle="tooltip">
                                {{ __('Send Request') }}
                            </a>
                        @else
                            <a href="{{ route('request.cancel', \Auth::user()->id) }}"
                                class="btn btn-icon  btn-danger btn-md" data-bs-placement="top" data-bs-toggle="tooltip"
                                data-bs-original-title="{{ __('Cancel Request') }}">
                                {{ __('Cancel Request') }}
                            </a>
                        @endif
                    </div>
                </div>
            @endif
            {{-- End Manually Payment --}}
            {{-- Bank Transfer --}}
            @if ($admin_payment_setting['is_bank_enabled'] == 'on')
                <div id="bank_payment" class="card">
                    <form action="{{ route('plan.pay.with.bank') }}" method="post" enctype="multipart/form-data"
                        class="w3-container w3-display-middle w3-card-4" id="payment-form1">
                        @csrf
                        <div class="card-header">
                            <h5>{{ __('Bank Transfer') }}</h5>
                        </div>
                        <div class="card-body">
                            <div
                                class="tab-pane {{ $admin_payment_setting['is_bank_enabled'] == 'on' ? 'active' : '' }}">
                                <div class="border rounded p-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="bank_detail"
                                                    class="form-label text-dark">{{ __('Bank Detail') }}</label><br>
                                                @if (isset($admin_payment_setting['bank_detail']) && !empty($admin_payment_setting['bank_detail']))
                                                    {!! $admin_payment_setting['bank_detail'] !!}
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="bankfile"
                                                    class="form-label text-dark">{{ __('Payment Receipt') }}</label>
                                                <input type="file" name="receipt" class="form-control"
                                                    enctype="multipart/form-data">
                                                @if ($errors->has('receipt'))
                                                    <span class="invalid-feedback d-block">
                                                        {{ $errors->first('receipt') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="bank_coupon" class="form-label">{{ __('Coupon') }}</label>
                                                <div class="d-flex align-items-center gap-3">
                                                    <input type="text" id="bank_coupon" name="coupon"
                                                        class="form-control coupon"
                                                        placeholder="{{ __('Enter Coupon Code') }}">
                                                    <a href="#"
                                                        class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                                        data-bs-toggle="tooltip" data-bs-title="{{ __('Apply') }}"><i
                                                            data-feather="save"></i></a>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <span><b>{{ 'Plan Price : ' }}</b>{{ isset($admin_payment_setting['CURRENCY_SYMBOL']) && $admin_payment_setting['CURRENCY_SYMBOL']
                                                    ? $admin_payment_setting['CURRENCY_SYMBOL'] . $plan->price
                                                    : '$' . $plan->price }}</span>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <b>{{ 'Net Amount : ' }}</b><span
                                                class="bank_amount">{{ isset($admin_payment_setting['CURRENCY_SYMBOL']) && $admin_payment_setting['CURRENCY_SYMBOL']
                                                ? $admin_payment_setting['CURRENCY_SYMBOL'] . $plan->price
                                                : '$' . $plan->price }}</span><br>
                                                <small>{{ __('(After coupon apply)') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <input type="hidden" name="plan_id" value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                            <input type="submit" value="{{ __('Pay Now') }}"
                            class="btn btn-lg btn-primary btn-create">
                        </div>
                    </form>
                    {{-- </div> --}}
                </div>
            @endif
            {{-- End Bank Transfer --}}
            {{-- stripe payment --}}
            @if ( $admin_payment_setting['is_stripe_enabled'] == 'on' &&
                    !empty($admin_payment_setting['stripe_key']) &&
                    !empty($admin_payment_setting['stripe_secret']))
                <div id="stripe_payment" class="card">
                    <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation"
                        id="payment-form">
                        @csrf
                        <div class="card-header">
                            <h5>{{ __('Stripe') }}</h5>
                        </div>
                        <div class="card-body">
                            <div
                                class="tab-pane {{ ($admin_payment_setting['is_stripe_enabled'] == 'on' && !empty($admin_payment_setting['stripe_key']) && !empty($admin_payment_setting['stripe_secret'])) == 'on' ? 'active' : '' }}">

                                <div class="border rounded p-3 stripe-payment-div">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="custom-radio">
                                                <label
                                                    class="font-16 font-weight-bold">{{ __('Credit / Debit Card') }}</label>
                                            </div>
                                            <p class="mb-0 pt-1 text-sm">
                                                {{ __('Safe money transfer using your bank account. We support Mastercard, Visa, Discover and American express.') }}
                                            </p>
                                        </div>
                                        <div class="col-sm-4 text-sm-right mt-3 mt-sm-0">
                                            <img src="{{ asset('public/custom/img/payments/master.png') }}"
                                                height="24" alt="master-card-img">
                                            <img src="{{ asset('public/custom/img/payments/discover.png') }}"
                                                height="24" alt="discover-card-img">
                                            <img src="{{ asset('public/custom/img/payments/visa.png') }}" height="24"
                                                alt="visa-card-img">
                                            <img src="{{ asset('public/custom/img/payments/american express.png') }}"
                                                height="24" alt="american-express-card-img">
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="card-name-on"
                                                    class="form-label text-dark">{{ __('Name on card') }}</label>
                                                <input type="text" name="name" id="card-name-on"
                                                    class="form-control required"
                                                    placeholder="{{ \Auth::user()->name }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div id="card-element">
                                                <!-- A Stripe Element will be inserted here. -->
                                            </div>
                                            <div id="card-errors" role="alert"></div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group d-flex align-items-center gap-3 mb-0">
                                                <input type="text" id="stripe_coupon" name="coupon"
                                                    class="form-control coupon"
                                                    placeholder="{{ __('Enter Coupon Code') }}">
                                                <a href="#" class="text-white btn btn-lg btn-primary apply-coupon"
                                                    data-bs-toggle="tooltip" data-bs-title="{{ __('Apply') }}"><i
                                                        data-feather="save" class=""></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="error" style="display: none;">
                                                <div class='alert-danger alert'>
                                                    {{ __('Please correct the errors and try again.') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end Credit/Debit Card box-->


                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <input type="hidden" id="stripe" value="stripe" name="payment_processor"
                                class="custom-control-input">
                            <input type="hidden" name="plan_id"
                                value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                            <input type="submit" value="{{ __('Pay Now') }}"
                                class="btn btn-lg btn-primary btn-create">
                        </div>
                    </form>
                    {{-- </div> --}}
                </div>
            @endif
            {{-- stripr payment end --}}

            {{-- paypal end --}}
            @if ( $admin_payment_setting['is_paypal_enabled'] == 'on' &&
                    !empty($admin_payment_setting['paypal_client_id']) &&
                    !empty($admin_payment_setting['paypal_secret_key']))
                <div id="paypal_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('Paypal') }}</h5>
                    </div>

                    <form class="w3-container w3-display-middle w3-card-4" method="POST" id="payment-form"
                        action="{{ route('plan.pay.with.paypal') }}">
                        @csrf
                        <div class="card-body">
                            <div class="tab-pane {{ ($admin_payment_setting['is_stripe_enabled'] != 'on' && $admin_payment_setting['is_paypal_enabled'] == 'on' && !empty($admin_payment_setting['paypal_client_id']) && !empty($admin_payment_setting['paypal_secret_key'])) == 'on' ? 'active' : '' }}"
                                id="paypal_payment">
                                <input type="hidden" name="plan_id"
                                    value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                <div class="form-group mb-0">
                                    <label for="paypal_coupon" class="form-label">{{ __('Coupon') }}</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="text" id="paypal_coupon" name="coupon"
                                            class="form-control coupon" placeholder="{{ __('Enter Coupon Code') }}">
                                        <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                            data-bs-toggle="tooltip" data-bs-title="{{ __('Apply') }}"><i
                                                data-feather="save"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <input type="submit" value="{{ __('Pay Now') }}"
                                    class="btn btn-lg btn-primary btn-create">
                            </div>
                        </div>
                    </form>


                </div>
            @endif
            {{-- paypal end --}}

            {{-- Paystack --}}
            @if (
                $admin_payment_setting['is_paystack_enabled'] == 'on' &&
                    !empty($admin_payment_setting['paystack_public_key']) &&
                    !empty($admin_payment_setting['paystack_secret_key']))
                <div id="paystack_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('Paystack') }}</h5>

                    </div>

                    <form class="w3-container w3-display-middle w3-card-4" method="POST" id="paystack-payment-form"
                        action="{{ route('plan.pay.with.paystack') }}">
                        @csrf
                        <div class="card-body">
                            <div class="tab-pane " id="paystack_payment">
                                <input type="hidden" name="plan_id"
                                    value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                <div class="form-group mb-0">
                                    <label for="paypal_coupon" class="form-label">{{ __('Coupon') }}</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="text" id="paystack_coupon" name="coupon"
                                        class="form-control coupon" data-from="paystack"
                                        placeholder="{{ __('Enter Coupon Code') }}">
                                        <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                        data-toggle="tooltip" data-title="{{ __('Apply') }}"><i
                                            data-feather="save"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <input type="button" id="pay_with_paystack" value="{{ __('Pay Now') }}"
                                    class="btn btn-lg btn-primary btn-create">
                            </div>
                        </div>
                    </form>


                </div>
            @endif
            {{-- Paystack end --}}

            {{-- Flutterwave --}}
            @if (isset($admin_payment_setting['is_flutterwave_enabled']) && $admin_payment_setting['is_flutterwave_enabled'] == 'on')
                <div id="flutterwave_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('Flutterwave') }}</h5>

                    </div>

                    <form role="form" action="{{ route('plan.pay.with.flaterwave') }}" method="post"
                        class="require-validation" id="flaterwave-payment-form">
                        @csrf
                        <div class="card-body">
                            <div class="tab-pane " id="flutterwave_payment">
                                <input type="hidden" name="plan_id"
                                    value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                    <div class="form-group mb-0">
                                        <label for="paypal_coupon" class="form-label">{{ __('Coupon') }}</label>
                                        <div class="d-flex align-items-center gap-3">
                                         <input type="text" id="flaterwave_coupon" name="coupon"
                                            class="form-control coupon" placeholder="{{ __('Enter Coupon Code') }}">
                                            <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                            data-toggle="tooltip" data-title="{{ __('Apply') }}"><i
                                                data-feather="save"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <input type="button" id="pay_with_flaterwave" value="{{ __('Pay Now') }}"
                                    class="btn-create btn btn-lg btn-primary">
                            </div>
                        </div>
                    </form>



                </div>
            @endif
            {{-- Flutterwave END --}}

            {{-- Razorpay --}}
            @if (isset($admin_payment_setting['is_razorpay_enabled']) && $admin_payment_setting['is_razorpay_enabled'] == 'on')
                <div id="razorpay_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('Razorpay') }} </h5>

                    </div>

                    <form role="form" action="{{ route('plan.pay.with.razorpay') }}" method="post"
                        class="require-validation" id="razorpay-payment-form">
                        @csrf
                        <div class="card-body">
                            <div class="tab-pane " id="razorpay_payment">
                                <input type="hidden" name="plan_id"
                                    value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                <div class="form-group mb-0">
                                    <label for="razorpay_coupon" class="form-label">{{ __('Coupon') }}</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="text" id="razorpay_coupon" name="coupon"
                                                class="form-control coupon" data-from="razorpay"
                                                placeholder="{{ __('Enter Coupon Code') }}">
                                        <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                        data-toggle="tooltip" data-title="{{ __('Apply') }}"><i
                                            data-feather="save"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <input type="button" id="pay_with_razorpay" value="{{ __('Pay Now') }}"
                                    class="btn btn-lg btn-primary btn-create">
                            </div>
                        </div>
                    </form>

                </div>
            @endif
            {{-- Razorpay end --}}

            {{-- Mercado Pago --}}
            @if (isset($admin_payment_setting['is_mercado_enabled']) && $admin_payment_setting['is_mercado_enabled'] == 'on')
                <div id="mercado_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('Mercado Pago') }}</h5>

                    </div>

                    <form role="form" action="{{ route('plan.pay.with.mercado') }}" method="post"
                        class="require-validation" id="mercado-payment-form">
                        @csrf
                        <div class="card-body">
                            <div class="tab-pane " id="mercado_payment">
                                <input type="hidden" name="plan_id"
                                    value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                <div class="form-group mb-0">
                                    <label for="mercado_coupon" class="form-label">{{ __('Coupon') }}</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="text" id="mercado_coupon" name="coupon"
                                            class="form-control coupon" data-from="mercado"
                                            placeholder="{{ __('Enter Coupon Code') }}">
                                        <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                        data-toggle="tooltip" data-title="{{ __('Apply') }}"><i
                                            data-feather="save"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <input type="submit" id="pay_with_mercado" value="{{ __('Pay Now') }}"
                                    class="btn-create btn btn-lg btn-primary badge-blue">
                            </div>
                        </div>
                    </form>

                </div>
            @endif
            {{-- Mercado Pago end --}}

            {{-- Paytm --}}
            @if (isset($admin_payment_setting['is_paytm_enabled']) && $admin_payment_setting['is_paytm_enabled'] == 'on')
                <div id="paytm_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('Paytm') }}</h5>
                    </div>

                    <form role="form" action="{{ route('plan.pay.with.paytm') }}" method="post"
                        class="require-validation" id="paytm-payment-form">
                        @csrf
                        <div class="card-body">

                            <div class="tab-pane " id="paytm_payment">
                                <input type="hidden" name="plan_id"
                                    value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                    <div class="form-group">
                                        <label for="paypal_coupon" class="form-label">{{ __('Coupon') }}</label>
                                        <div class="d-flex align-items-center gap-3">
                                            <input type="text" id="paytm_coupon" name="coupon"
                                                class="form-control coupon" data-from="paytm"
                                                placeholder="{{ __('Enter Coupon Code') }}">
                                            <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                            data-toggle="tooltip" data-title="{{ __('Apply') }}"><i
                                                data-feather="save"></i></a>
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-0">
                                            <label for="flaterwave_coupon"
                                                class="form-label text-dark">{{ __('Mobile Number') }}</label>
                                            <input type="text" id="mobile" name="mobile"
                                                class="form-control mobile" data-from="mobile"
                                                placeholder="{{ __('Enter Mobile Number') }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <input type="submit" id="pay_with_paytm" value="{{ __('Pay Now') }}"
                                    class=" btn btn-lg btn-primary btn-create badge-blue">
                            </div>
                        </div>
                    </form>


                </div>
            @endif
            {{-- Paytm end --}}

            {{-- Mollie --}}
            @if (isset($admin_payment_setting['is_mollie_enabled']) && $admin_payment_setting['is_mollie_enabled'] == 'on')
                <div id="mollie_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('Mollie') }}</h5>
                    </div>
                    <form role="form" action="{{ route('plan.pay.with.mollie') }}" method="post"
                        class="require-validation" id="mollie-payment-form">
                        @csrf
                        <div class="card-body">
                            <div class="tab-pane " id="mollie_payment">
                                <input type="hidden" name="plan_id"
                                    value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                <div class="form-group mb-0">
                                    <label for="mollie_coupon" class="form-label">{{ __('Coupon') }}</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="text" id="mollie_coupon" name="coupon"
                                            class="form-control coupon" data-from="mollie"
                                            placeholder="{{ __('Enter Coupon Code') }}">
                                            <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                        data-toggle="tooltip" data-title="{{ __('Apply') }}"><i
                                            data-feather="save"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <input type="submit" id="pay_with_mollie" value="{{ __('Pay Now') }}"
                                    class="btn-create btn btn-lg btn-primary badge-blue">
                            </div>
                        </div>
                    </form>
                    {{-- Mollie end --}}
                </div>
            @endif
            {{-- Skrill --}}
            @if (isset($admin_payment_setting['is_skrill_enabled']) && $admin_payment_setting['is_skrill_enabled'] == 'on')
                <div id="skrill_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('Skrill') }}</h5>

                    </div>

                    <form role="form" action="{{ route('plan.pay.with.skrill') }}" method="post"
                        class="require-validation" id="skrill-payment-form">
                        @csrf
                        <div class="card-body">

                            <div class="tab-pane " id="skrill_payment">
                                <input type="hidden" name="plan_id"
                                    value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                    <div class="form-group mb-0">
                                        <label for="paypal_coupon" class="form-label">{{ __('Coupon') }}</label>
                                        <div class="d-flex align-items-center gap-3">
                                            <input type="text" id="skrill_coupon" name="coupon"
                                                class="form-control coupon" data-from="skrill"
                                                placeholder="{{ __('Enter Coupon Code') }}">

                                            <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                                data-toggle="tooltip" data-title="{{ __('Apply') }}"><i
                                                    data-feather="save"></i></a>
                                        </div>
                                    </div>
                                @php
                                    $skrill_data = [
                                        'transaction_id' => md5(date('Y-m-d') . strtotime('Y-m-d H:i:s') . 'user_id'),
                                        'user_id' => 'user_id',
                                        'amount' => 'amount',
                                        'currency' => 'currency',
                                    ];
                                    session()->put('skrill_data', $skrill_data);

                                @endphp

                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <input type="submit" id="pay_with_skrill" value="{{ __('Pay Now') }}"
                                    class="btn-create btn btn-lg btn-primary badge-blue">
                            </div>
                        </div>
                    </form>


                </div>
            @endif
            {{-- Skrill end --}}

            {{-- Coingate --}}
            @if (isset($admin_payment_setting['is_coingate_enabled']) && $admin_payment_setting['is_coingate_enabled'] == 'on')
                <div id="coingate_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('Coingate') }}</h5>

                    </div>

                    <form role="form" action="{{ route('plan.pay.with.coingate') }}" method="post"
                        class="require-validation" id="coingate-payment-form">
                        @csrf
                        <div class="card-body">

                            <div class="tab-pane " id="coingate_payment">
                                <input type="hidden" name="plan_id"
                                    value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                <div class="form-group mb-0">
                                    <label for="paypal_coupon" class="form-label">{{ __('Coupon') }}</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="text" id="coingate_coupon" name="coupon"
                                            class="form-control coupon" data-from="coingate"
                                            placeholder="{{ __('Enter Coupon Code') }}">
                                        <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                        data-toggle="tooltip" data-title="{{ __('Apply') }}"><i
                                            data-feather="save"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <input type="submit" id="pay_with_coingate" value="{{ __('Pay Now') }}"
                                    class="btn-create btn btn-lg btn-primary">
                            </div>
                        </div>
                    </form>


                </div>
            @endif
            {{-- Coingate end --}}

            {{-- Paymentwall --}}
            @if (isset($admin_payment_setting['is_paymentwall_enabled']) && $admin_payment_setting['is_paymentwall_enabled'] == 'on')
                <div id="paymentwall_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('Paymentwall') }}</h5>
                    </div>

                    <form role="form" action="{{ route('paymentwall') }}" method="post" class="require-validation"
                        id="coingate-payment-form">
                        @csrf
                        <div class="card-body">
                            <div class="tab-pane " id="paymentwall_payment">
                                <input type="hidden" name="plan_id"
                                    value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                <div class="form-group mb-0">
                                    <label for="paymentwall_coupon" class="form-label">{{ __('Coupon') }}</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="text" id="paymentwall_coupon" name="coupon"
                                            class="form-control coupon" data-from="paymentwall"
                                            placeholder="{{ __('Enter Coupon Code') }}">
                                            <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                        data-toggle="tooltip" data-title="{{ __('Apply') }}"><i
                                            data-feather="save"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <input type="submit" id="pay_with_paymentwall" value="{{ __('Pay Now') }}"
                                    class="btn-create btn btn-lg btn-primary badge-blue">
                            </div>
                        </div>
                    </form>
                </div>
            @endif
            {{-- Paymentwall end --}}

            {{-- Toyyibpay --}}
            @if (isset($admin_payment_setting['is_toyyibpay_enabled']) && $admin_payment_setting['is_toyyibpay_enabled'] == 'on')
                <div id="toyyibpay_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('Toyyibpay') }}</h5>
                    </div>

                    <form role="form" action="{{ route('plan.pay.with.toyyibpay') }}" method="post"
                        class="require-validation" id="coingate-payment-form">
                        @csrf
                        <div class="card-body">
                            <div class="tab-pane " id="toyyibpay_payment">
                                <input type="hidden" name="plan_id"
                                    value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                <div class="form-group">
                                    <label for="paypal_coupon" class="form-label">{{ __('Coupon') }}</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="text" id="toyyibpay_coupon" name="coupon"
                                            class="form-control coupon" data-from="toyyibpay"
                                            placeholder="{{ __('Enter Coupon Code') }}">
                                        <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                        data-toggle="tooltip" data-title="{{ __('Apply') }}"><i
                                            data-feather="save"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <input type="submit" id="pay_with_toyyibpay" value="{{ __('Pay Now') }}"
                                    class="btn-create btn btn-lg btn-primary badge-blue">
                            </div>
                        </div>
                    </form>
                </div>
            @endif
            {{-- Toyyibpay end --}}
            {{-- Payfast --}}
            @if (isset($admin_payment_setting['is_payfast_enabled']) && $admin_payment_setting['is_payfast_enabled'] == 'on')
                <div id="payfast_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('Payfast') }}</h5>
                    </div>

                    @if (
                        $admin_payment_setting['is_payfast_enabled'] == 'on' &&
                            !empty($admin_payment_setting['payfast_merchant_id']) &&
                            !empty($admin_payment_setting['payfast_merchant_key']) &&
                            !empty($admin_payment_setting['payfast_signature']) &&
                            !empty($admin_payment_setting['payfast_mode']))
                        <div
                            class="tab-pane {{ ($admin_payment_setting['is_payfast_enabled'] == 'on' && !empty($admin_payment_setting['payfast_merchant_id']) && !empty($admin_payment_setting['payfast_merchant_key'])) == 'on' ? 'active' : '' }}">
                            @php
                                $pfHost =
                                    $admin_payment_setting['payfast_mode'] == 'sandbox'
                                        ? 'sandbox.payfast.co.za'
                                        : 'www.payfast.co.za';
                            @endphp
                            <form role="form" action={{ 'https://' . $pfHost . '/eng/process' }} method="post"
                                class="require-validation" id="payfast-form">
                                <div class="card-body">
                                    <div class="tab-pane " id="toyyibpay_payment">
                                        <input type="hidden" name="plan_id"
                                            value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                        <div class="form-group mb-0">
                                            <label for="payfast_coupon"
                                                class="form-label">{{ __('Coupon') }}</label>
                                            <div class="d-flex align-items-center gap-3">
                                                <input type="text" id="payfast_coupon" name="coupon"
                                                    class="form-control coupon"
                                                    placeholder="{{ __('Enter Coupon Code') }}">
                                                <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                                data-toggle="tooltip" data-title="{{ __('Apply') }}"><i
                                                    data-feather="save"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="get-payfast-inputs"></div>
                                <div class="card-footer">
                                    <div class="text-end">
                                        <input type="hidden" name="plan_id" id="plan_id"
                                            value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                        <input type="submit" value="{{ __('Pay Now') }}" id="payfast-get-status"
                                            class="btn btn-lg btn-primary">
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            @endif
            {{-- Payfast end --}}

            {{-- Iyzipay --}}
            @if (isset($admin_payment_setting['is_iyzipay_enabled']) && $admin_payment_setting['is_iyzipay_enabled'] == 'on')
                <div id="iyzipay_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('Iyzipay') }}</h5>
                    </div>

                    @if (
                        $admin_payment_setting['is_iyzipay_enabled'] == 'on' &&
                            !empty($admin_payment_setting['iyzipay_key']) &&
                            !empty($admin_payment_setting['iyzipay_secret']) &&
                            !empty($admin_payment_setting['iyzipay_mode']))
                        <div
                            class="tab-pane {{ ($admin_payment_setting['is_iyzipay_enabled'] == 'on' && !empty($admin_payment_setting['iyzipay_key']) && !empty($admin_payment_setting['iyzipay_secret'])) == 'on' ? 'active' : '' }}">
                            <form role="form" action="{{ route('iyzipay.payment.init') }}" method="post"
                                class="require-validation" id="iyzipay-form">
                                @csrf
                                <div class="card-body">
                                    <div class="tab-pane " id="">
                                        <input type="hidden" name="plan_id"
                                            value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                        <div class="form-group mb-0">
                                            <label for="iyzipay_coupon"
                                                class="form-label">{{ __('Coupon') }}</label>
                                            <div class="d-flex align-items-center gap-3">
                                                <input type="text" id="iyzipay_coupon" name="coupon"
                                                    class="form-control coupon"
                                                    placeholder="{{ __('Enter Coupon Code') }}">
                                                <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                                data-toggle="tooltip" data-title="{{ __('Apply') }}"><i
                                                data-feather="save"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="get-payfast-inputs"></div>
                                <div class="card-footer">
                                    <div class="text-end">
                                        <input type="hidden" name="plan_id" id="plan_id"
                                            value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                        <input type="submit" value="{{ __('Pay Now') }}" id=""
                                            class="btn btn-lg btn-primary">
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            @endif
            {{-- Iyzipay end --}}
            {{-- sspay --}}
            @if (isset($admin_payment_setting['is_sspay_enabled']) && $admin_payment_setting['is_sspay_enabled'] == 'on')
                <div id="sspay_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('Sspay') }}</h5>
                    </div>
                    <form role="form" action="{{ route('sspay.prepare.plan') }}" method="post"
                        class="require-validation" id="coingate-payment-form">
                        @csrf
                        <div class="card-body">
                            <div class="tab-pane " id="">
                                <input type="hidden" name="plan_id"
                                    value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                <div class="form-group mb-0">
                                    <label for="paypal_coupon" class="form-label">{{ __('Coupon') }}</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="text" id="toyyibpay_coupon" name="coupon"
                                            class="form-control coupon" data-from="toyyibpay"
                                            placeholder="{{ __('Enter Coupon Code') }}">
                                        <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                        data-toggle="tooltip" data-title="{{ __('Apply') }}"><i
                                            data-feather="save"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <input type="submit" id="" value="{{ __('Pay Now') }}"
                                    class="btn-create btn btn-lg btn-primary badge-blue">
                            </div>
                        </div>
                    </form>
                </div>
            @endif
            {{-- sspay end --}}
            {{-- Paytab --}}
            @if (isset($admin_payment_setting['is_paytab_enabled']) && $admin_payment_setting['is_paytab_enabled'] == 'on')
                <div id="paytab_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('Paytab') }}</h5>
                    </div>
                    <form role="form" action="{{ route('plan.pay.with.paytab') }}" method="post"
                        class="require-validation" id="coingate-payment-form">
                        @csrf
                        <div class="card-body">
                            <div class="tab-pane " id="">
                                <input type="hidden" name="plan_id"
                                    value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                <div class="form-group mb-0">
                                    <label for="paytab_coupon" class="form-label">{{ __('Coupon') }}</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="text" id="paytab_coupon" name="coupon"
                                            class="form-control coupon" data-from="paytab"
                                            placeholder="{{ __('Enter Coupon Code') }}">
                                            <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                            data-toggle="tooltip" data-title="{{ __('Apply') }}"><i
                                                data-feather="save"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <input type="submit" id="" value="{{ __('Pay Now') }}"
                                    class="btn-create btn btn-lg btn-primary badge-blue">
                            </div>
                        </div>
                    </form>
                </div>
            @endif
            {{-- Paytab end --}}
            {{-- Benefit --}}
            @if (isset($admin_payment_setting['is_benefit_enabled']) && $admin_payment_setting['is_benefit_enabled'] == 'on')
                <div id="benefit_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('Benefit') }}</h5>
                    </div>
                    <form role="form" action="{{ route('benefit.initiate') }}" method="post"
                        class="require-validation" id="coingate-payment-form">
                        @csrf
                        <div class="card-body">
                            <div class="tab-pane " id="">
                                <input type="hidden" name="plan_id"
                                    value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                <div class="form-group mb-0">
                                    <label for="benefit_coupon" class="form-label">{{ __('Coupon') }}</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="text" id="benefit_coupon" name="coupon"
                                            class="form-control coupon" data-from="benefit"
                                            placeholder="{{ __('Enter Coupon Code') }}">
                                        <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                        data-toggle="tooltip" data-title="{{ __('Apply') }}"><i
                                        data-feather="save"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <input type="submit" id="" value="{{ __('Pay Now') }}"
                                    class="btn-create btn btn-lg btn-primary badge-blue">
                            </div>
                        </div>
                    </form>
                </div>
            @endif
            {{-- Benefit end --}}
            {{-- Cashfree --}}
            @if (isset($admin_payment_setting['is_cashfree_enabled']) && $admin_payment_setting['is_cashfree_enabled'] == 'on')
                <div id="cashfree_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('Cashfree') }}</h5>
                    </div>
                    <form role="form" action="{{ route('cashfree.payment') }}" method="post"
                        class="require-validation" id="coingate-payment-form">
                        @csrf
                        <div class="card-body">
                            <div class="tab-pane " id="">
                                <input type="hidden" name="plan_id"
                                    value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                <div class="form-group mb-0">
                                    <label for="cashfree_coupon" class="form-label">{{ __('Coupon') }}</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="text" id="cashfree_coupon" name="coupon"
                                            class="form-control coupon" data-from="cashfree"
                                            placeholder="{{ __('Enter Coupon Code') }}">
                                        <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                        data-toggle="tooltip" data-title="{{ __('Apply') }}"><i
                                            data-feather="save"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <input type="submit" id="" value="{{ __('Pay Now') }}"
                                    class="btn-create btn btn-lg btn-primary badge-blue">
                            </div>
                        </div>
                    </form>
                </div>
            @endif
            {{-- Cashfree end --}}
            {{-- Aamarpay --}}
            @if (isset($admin_payment_setting['is_aamarpay_enabled']) && $admin_payment_setting['is_aamarpay_enabled'] == 'on')
                <div id="aamarpay_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('Aamarpay') }}</h5>
                    </div>
                    <form role="form" action="{{ route('pay.aamarpay.payment') }}" method="post"
                        class="require-validation" id="payment-form">
                        @csrf
                        <div class="card-body">
                            <div class="tab-pane " id="">
                                <input type="hidden" name="plan_id"
                                    value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                <div class="form-group mb-0">
                                    <label for="aamarpay_coupon" class="form-label">{{ __('Coupon') }}</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="text" id="aamarpay_coupon" name="coupon"
                                            class="form-control coupon" data-from="aamarpay"
                                            placeholder="{{ __('Enter Coupon Code') }}">
                                        <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                        data-toggle="tooltip" data-title="{{ __('Apply') }}"><i
                                        data-feather="save"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <input type="submit" id="" value="{{ __('Pay Now') }}"
                                    class="btn-create btn btn-lg btn-primary badge-blue">
                            </div>
                        </div>
                    </form>
                </div>
            @endif
            {{-- Aamarpay end --}}
            {{-- Paytr --}}
            @if (isset($admin_payment_setting['is_paytr_enabled']) && $admin_payment_setting['is_paytr_enabled'] == 'on')
                <div id="paytr_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('Pay TR') }}</h5>
                    </div>
                    <form role="form" action="{{ route('pay.paytr.payment') }}" method="post"
                        class="require-validation" id="payment-form">
                        @csrf
                        <div class="card-body">
                            <div class="tab-pane " id="">
                                <input type="hidden" name="plan_id"
                                    value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                <div class="form-group mb-0">
                                    <label for="paytr_coupon" class="form-label">{{ __('Coupon') }}</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="text" id="paytr_coupon" name="coupon"
                                            class="form-control coupon" data-from="paytr"
                                            placeholder="{{ __('Enter Coupon Code') }}">
                                        <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                        data-toggle="tooltip" data-title="{{ __('Apply') }}"><i
                                            data-feather="save"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <input type="submit" id="" value="{{ __('Pay Now') }}"
                                    class="btn-create btn btn-lg btn-primary badge-blue">
                            </div>
                        </div>
                    </form>
                </div>
            @endif
            {{-- Paytr end --}}

            {{-- Midtrans --}}
            @if (isset($admin_payment_setting['is_midtrans_enabled']) && $admin_payment_setting['is_midtrans_enabled'] == 'on')
                <div id="midtrans_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('Midtrans') }}</h5>
                    </div>
                    <form role="form" action="{{ route('plan.get.midtrans') }}" method="post"
                        class="require-validation" id="midtrans-form">
                        @csrf
                        <div class="card-body">
                            <div class="tab-pane " id="">
                                <input type="hidden" name="plan_id"
                                    value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                <div class="form-group mb-0">
                                    <label for="midtrans_coupon"
                                        class="form-label">{{ __('Coupon') }}</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="text" id="midtrans_coupon" name="coupon"
                                            class="form-control coupon" data-from="midtrans"
                                            placeholder="{{ __('Enter Coupon Code') }}">
                                        <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                        data-toggle="tooltip" data-title="{{ __('Apply') }}"><i
                                        data-feather="save"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <input type="submit" id="" value="{{ __('Pay Now') }}"
                                    class="btn-create btn btn-lg btn-primary badge-blue">
                            </div>
                        </div>
                    </form>
                </div>
            @endif
            {{-- Midtrans end --}}

            {{-- Xendit --}}
            @if (isset($admin_payment_setting['is_xendit_enabled']) && $admin_payment_setting['is_xendit_enabled'] == 'on')
                <div id="xendit_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('Xendit') }}</h5>
                    </div>
                    <form role="form" action="{{ route('plan.xendit.payment') }}" method="post"
                        class="require-validation" id="xendit-form">
                        @csrf
                        <div class="card-body">
                            <div class="tab-pane " id="">
                                <input type="hidden" name="plan_id"
                                    value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                <div class="form-group mb-0">
                                    <label for="xendit_coupon" class="form-label">{{ __('Coupon') }}</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="text" id="xendit_coupon" name="coupon"
                                            class="form-control coupon" data-from="xendit"
                                            placeholder="{{ __('Enter Coupon Code') }}">
                                        <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                            data-toggle="tooltip" data-title="{{ __('Apply') }}"><i
                                        data-feather="save"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <input type="submit" id="" value="{{ __('Pay Now') }}"
                                    class="btn-create btn btn-lg btn-primary badge-blue">
                            </div>
                        </div>
                    </form>
                </div>
            @endif


            {{-- YooKassa --}}
            @if (isset($admin_payment_setting['is_yookassa_enabled']) && $admin_payment_setting['is_yookassa_enabled'] == 'on')
                <div id="yookassa_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('YooKassa') }}</h5>
                    </div>
                    <form role="form" action="{{ route('plan.pay.with.yookassa') }}" method="post"
                        class="require-validation" id="yookassa-form">
                        @csrf
                        <div class="card-body">
                            <div class="tab-pane " id="">
                                <input type="hidden" name="plan_id"
                                    value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                <div class="form-group mb-0">
                                    <label for="yookassa_coupon"
                                        class="form-label">{{ __('Coupon') }}</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="text" id="yookassa_coupon" name="coupon"
                                            class="form-control coupon" data-from="yookassa"
                                            placeholder="{{ __('Enter Coupon Code') }}">
                                        <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                        data-toggle="tooltip" data-title="{{ __('Apply') }}"><i
                                            data-feather="save"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <input type="submit" id="" value="{{ __('Pay Now') }}"
                                    class="btn-create btn btn-lg btn-primary badge-blue">
                            </div>
                        </div>
                    </form>
                </div>
            @endif
            {{-- Nepalste --}}
            @if (isset($admin_payment_setting['is_nepalste_enabled']) && $admin_payment_setting['is_nepalste_enabled'] == 'on')
                <div id="nepalste_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('Nepalste') }}</h5>
                    </div>
                    <form role="form" action="{{ route('plan.pay.with.nepalste') }}" method="post"
                        class="require-validation">
                        @csrf
                        <div class="card-body">
                            <div class="tab-pane " id="">
                                <input type="hidden" name="plan_id"
                                    value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                <div class="form-group mb-0">
                                    <label for="nepalste_coupon"
                                        class="form-label">{{ __('Coupon') }}</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="text" id="nepalste_coupon" name="coupon"
                                            class="form-control coupon" data-from="nepalste"
                                            placeholder="{{ __('Enter Coupon Code') }}">
                                        <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                        data-toggle="tooltip" data-title="{{ __('Apply') }}"><i
                                            data-feather="save"></i></a>
                                     </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <input type="submit" id="" value="{{ __('Pay Now') }}"
                                    class="btn-create btn btn-lg btn-primary badge-blue">
                            </div>
                        </div>
                    </form>
                </div>
            @endif
            {{-- Paiement Pro --}}
            @if (isset($admin_payment_setting['is_paiement_enabled']) && $admin_payment_setting['is_paiement_enabled'] == 'on')
                <div id="paiement_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('Paiement Pro') }}</h5>
                    </div>
                    <form role="form" action="{{ route('plan.pay.with.paiementpro') }}" method="post"
                        class="require-validation">
                        @csrf
                        <div class="card-body">
                            <div class="tab-pane " id="">
                                <input type="hidden" name="plan_id"
                                    value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="flaterwave_coupon"
                                                    class="form-label text-dark">{{ __('Mobile Number') }}</label>
                                                <input type="text" id="mobile" name="mobile"
                                                    class="form-control mobile" data-from="mobile"
                                                    placeholder="{{ __('Enter Mobile Number') }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="flaterwave_coupon"
                                                    class="form-label text-dark">{{ __('Channel') }}</label>
                                                <input type="text" id="channel" name="channel"
                                                    class="form-control channel" data-from="channel"
                                                    placeholder="{{ __('Enter Channel') }}" required>
                                                <small
                                                    class="text-danger">{{ __('Example : OMCIV2,MOMO,CARD,FLOOZ ,PAYPAL') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label for="paiement_coupon"
                                            class="form-label">{{ __('Coupon') }}</label>
                                        <div class="d-flex align-items-center gap-3">
                                            <input type="text" id="paiement_coupon" name="coupon"
                                                class="form-control coupon" data-from="paiement"
                                                placeholder="{{ __('Enter Coupon Code') }}">
                                            <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                            data-toggle="tooltip" data-title="{{ __('Apply') }}"><i
                                            data-feather="save"></i></a>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <input type="submit" id="" value="{{ __('Pay Now') }}"
                                    class="btn-create btn btn-lg btn-primary badge-blue">
                            </div>
                        </div>
                    </form>
                </div>
            @endif

            @if (isset($admin_payment_setting['is_cinetpay_enabled']) && $admin_payment_setting['is_cinetpay_enabled'] == 'on')
                <div id="cinetpay_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('CinetPay') }}</h5>
                    </div>
                    <form role="form" action="{{ route('plan.pay.with.cinetpay') }}" method="post"
                        class="require-validation">
                        @csrf
                        <div class="card-body">
                            <div class="tab-pane " id="">
                                <input type="hidden" name="plan_id"
                                    value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                <div class="form-group mb-0">
                                    <label for="cinetpay_coupon"
                                        class="form-label">{{ __('Coupon') }}</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="text" id="cinetpay_coupon" name="coupon"
                                            class="form-control coupon" data-from="cinetpay"
                                            placeholder="{{ __('Enter Coupon Code') }}">
                                            <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                        data-toggle="tooltip" data-title="{{ __('Apply') }}"><i
                                            data-feather="save"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <input type="submit" id="" value="{{ __('Pay Now') }}"
                                    class="btn-create btn btn-lg btn-primary badge-blue">
                            </div>
                        </div>
                    </form>
                </div>
            @endif
            @if (isset($admin_payment_setting['is_payhere_enabled']) && $admin_payment_setting['is_payhere_enabled'] == 'on')
                <div id="payhere_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('PayHere') }}</h5>
                    </div>
                    <form role="form" action="{{ route('plan.pay.with.payhere') }}" method="post"
                        class="require-validation">
                        @csrf
                        <div class="card-body">
                            <div class="tab-pane " id="">
                                <input type="hidden" name="plan_id"
                                    value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                <div class="form-group mb-0">
                                    <label for="payhere_coupon"  class="form-label">{{ __('Coupon') }}</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="text" id="payhere_coupon" name="coupon"
                                            class="form-control coupon" data-from="payhere"
                                            placeholder="{{ __('Enter Coupon Code') }}">
                                        <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                        data-toggle="tooltip" data-title="{{ __('Apply') }}"><i
                                            data-feather="save"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <input type="submit" id="" value="{{ __('Pay Now') }}"
                                    class="btn-create btn btn-lg btn-primary badge-blue">
                            </div>
                        </div>
                    </form>
                </div>
            @endif
            @if (isset($admin_payment_setting['is_fedapay_enabled']) && $admin_payment_setting['is_fedapay_enabled'] == 'on')
                <div id="fedapay_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('FedaPay') }}</h5>
                    </div>
                    <form role="form" action="{{ route('plan.pay.with.fedapay') }}" method="post"
                        class="require-validation">
                        @csrf
                        <div class="card-body">
                            <div class="tab-pane " id="">
                                <input type="hidden" name="plan_id"
                                    value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                <div class="form-group mb-0">
                                    <label for="fedapay_coupon" class="form-label">{{ __('Coupon') }}</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="text" id="fedapay_coupon" name="coupon"
                                            class="form-control coupon" data-from="fedapay"
                                            placeholder="{{ __('Enter Coupon Code') }}">
                                        <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                        data-toggle="tooltip" data-title="{{ __('Apply') }}"><i
                                            data-feather="save"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <input type="submit" id="" value="{{ __('Pay Now') }}"
                                    class="btn-create btn btn-lg btn-primary badge-blue">
                            </div>
                        </div>
                    </form>
                </div>
            @endif
            @if (isset($admin_payment_setting['is_tap_enabled']) && $admin_payment_setting['is_tap_enabled'] == 'on')
                <div id="tap_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('Tap') }}</h5>
                    </div>
                    <form role="form" action="{{ route('plan.pay.with.tap') }}" method="post"
                        class="require-validation">
                        @csrf
                        <div class="card-body">
                            <div class="tab-pane " id="">
                                <input type="hidden" name="plan_id"
                                    value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                <div class="form-group mb-0">
                                    <label for="tap_coupon"
                                        class="form-label">{{ __('Coupon') }}</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="text" id="tap_coupon" name="coupon"
                                            class="form-control coupon" data-from="tap"
                                            placeholder="{{ __('Enter Coupon Code') }}">
                                            <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                        data-toggle="tooltip" data-title="{{ __('Apply') }}"><i
                                            data-feather="save"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <input type="submit" id="" value="{{ __('Pay Now') }}"
                                    class="btn-create btn btn-lg btn-primary badge-blue">
                            </div>
                        </div>
                    </form>
                </div>
            @endif
            @if (isset($admin_payment_setting['is_authorizenet_enabled']) && $admin_payment_setting['is_authorizenet_enabled'] == 'on')
                <div id="authorizenet_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('AuthorizeNet') }}</h5>
                    </div>
                    <form role="form" action="{{ route('plan.pay.with.authorizenet') }}" method="post"
                        class="require-validation">
                        @csrf
                        <div class="card-body">
                            <div class="tab-pane " id="">
                                <input type="hidden" name="plan_id"
                                    value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                <div class="form-group mb-0">
                                    <label for="authorizenet_coupon"class="form-label">{{ __('Coupon') }}</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="text" id="authorizenet_coupon" name="coupon"
                                            class="form-control coupon" data-from="authorizenet"
                                            placeholder="{{ __('Enter Coupon Code') }}">
                                        <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                        data-toggle="tooltip" data-title="{{ __('Apply') }}"><i
                                            data-feather="save"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <input type="submit" id="" value="{{ __('Pay Now') }}"
                                    class="btn-create btn btn-lg btn-primary badge-blue">
                            </div>
                        </div>
                    </form>
                </div>
            @endif
            @if (isset($admin_payment_setting['is_khalti_enabled']) && $admin_payment_setting['is_khalti_enabled'] == 'on')
                <div id="khalti_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('Khalti') }}</h5>
                    </div>
                    <form role="form" action="{{ route('plan.pay.with.khalti') }}" method="post"
                        class="require-validation">
                        @csrf
                        <div class="card-body">
                            <div class="tab-pane " id="">
                                <input type="hidden" name="plan_id" id="plan_id"
                                    value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                <div class="form-group mb-0">
                                    <label for="khalti_coupon"
                                        class="form-label">{{ __('Coupon') }}</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="text" id="khalti_coupon" name="coupon"
                                            class="form-control coupon" data-from="khalti"
                                            placeholder="{{ __('Enter Coupon Code') }}">
                                            <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                        data-toggle="tooltip" data-title="{{ __('Apply') }}"><i
                                            data-feather="save"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <input type="submit" id="" value="{{ __('Pay Now') }}"
                                    class="btn-create btn btn-lg btn-primary badge-blue payment-btn">
                            </div>
                        </div>
                    </form>
                </div>
            @endif
            @if (isset($admin_payment_setting['is_easybuzz_enabled']) && $admin_payment_setting['is_easybuzz_enabled'] == 'on')
                <div id="easybuzz_payment" class="card">
                    <div class="card-header">
                        <h5>{{ __('Easebuzz') }}</h5>
                    </div>
                    <form role="form" action="{{ route('plan.pay.with.easebuzz') }}" method="post"
                        class="require-validation">
                        @csrf
                        <div class="card-body">
                            <div class="tab-pane " id="">
                                <input type="hidden" name="plan_id" id="plan_id"
                                    value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                <div class="form-group mb-0">
                                    <label for="easebuzz_coupon" class="form-label">{{ __('Coupon') }}</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="text" id="easebuzz_coupon" name="coupon"
                                            class="form-control coupon" data-from="easebuzz"
                                            placeholder="{{ __('Enter Coupon Code') }}">
                                        <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                        data-toggle="tooltip" data-title="{{ __('Apply') }}"><i
                                        data-feather="save"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <input type="submit" id="" value="{{ __('Pay Now') }}"
                                    class="btn-create btn btn-lg btn-primary badge-blue">
                            </div>
                        </div>
                    </form>
                </div>
            @endif

               {{-- Ozow --}}
            @if (isset($admin_payment_setting['ozow_payment_is_enabled']) && $admin_payment_setting['ozow_payment_is_enabled'] == 'on')

                <div id="ozow_payment" class="card mb-0">
                    <div class="card-header">
                        <h5>{{ __('Ozow') }}</h5>
                    </div>

                    <form role="form" action="{{ route('plan.pay.with.ozow', $plan->id) }}"
                        method="post" id="ozow-payment-form"
                        class="require-validation">
                        @csrf

                        <div class="card-body">
                            <div class="tab-pane " id="">
                                <input type="hidden" name="plan_id" id="plan_id"
                                value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                <div class="form-group mb-0">
                                    <label for="ozow_coupon"
                                            class="form-label">{{ __('Coupon') }}</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="text" id="ozow_coupon" name="coupon"
                                            class="form-control coupon" data-from="ozow"
                                            placeholder="{{ __('Enter Coupon Code') }}">
                                        <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon"
                                        data-toggle="tooltip" data-title="{{ __('Apply') }}"><i
                                        data-feather="save"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <input type="submit" id="" value="{{ __('Pay Now') }}"
                                    class="btn-create btn btn-lg btn-primary badge-blue">
                            </div>
                        </div>

                    </form>

                </div>
            @endif


        </div>
    </div>
    </div>

@endsection
