<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        'plan/paytm/*',
        'plan-pay-with-paytm/*',
        'plan-pay-with-paymentwall/*',
        'paymentwall/*',
        'iyzipay/callback/*',
        'plan-paytab-success/',
        '/aamarpay*',
        'plan/cinetpay-status/*',
        'plan-easebuzz-payment-notify*'

    ];
}
