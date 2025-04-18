<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Invoice;
use App\Models\InvoicePayment;
use App\Models\PlanOrder;
use App\Models\Plan;
use App\Transaction;
use App\Models\UserCoupon;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Stripe;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use App\Models\Business;
use App\Models\CardPayment;
use Illuminate\Http\RedirectResponse;
use Nwidart\Modules\Facades\Module;


class StripePaymentController extends Controller
{
    public $settings;
    public function index()
    {
        $objUser = \Auth::user();
        $orders = PlanOrder::select(
            [
                'plan_orders.*',
                'users.name as user_name',
            ]
        )->with('total_coupon_used.coupon_detail')
            ->join('users', 'plan_orders.user_id', '=', 'users.id')
            ->orderBy('plan_orders.created_at', 'DESC')
            ->get();


        $ordersDetails = PlanOrder::select('*')
            ->whereIn('id', function ($query) {
                $query->selectRaw('MAX(id)')
                    ->from('plan_orders')
                    ->groupBy('user_id');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('order.index', compact('orders', 'ordersDetails'));
    }


    public function stripe($code)
    {
        if (\Auth::user()->type != 'super admin') {
            try {
                $plan_id = \Illuminate\Support\Facades\Crypt::decrypt($code);
                $plan    = Plan::find($plan_id);
            } catch (\RuntimeException $e) {
                return redirect()->back()->with('error', __('Plan not avaliable'));
            }
            $modules = [];
            $modules = Module::getByStatus(1);
            if ($plan) {
                $admin_payment_setting = Utility::getAdminPaymentSetting();
                if ((isset($admin_payment_setting['is_stripe_enabled']) && $admin_payment_setting['is_stripe_enabled'] == 'on') ||
                    (isset($admin_payment_setting['is_bank_enabled']) && $admin_payment_setting['is_bank_enabled'] == 'on') ||
                    (isset($admin_payment_setting['is_paypal_enabled']) && $admin_payment_setting['is_paypal_enabled'] == 'on') ||
                    (isset($admin_payment_setting['is_paystack_enabled']) && $admin_payment_setting['is_paystack_enabled'] == 'on') ||
                    (isset($admin_payment_setting['is_flutterwave_enabled']) && $admin_payment_setting['is_flutterwave_enabled'] == 'on') ||
                    (isset($admin_payment_setting['is_razorpay_enabled']) && $admin_payment_setting['is_razorpay_enabled'] == 'on') ||
                    (isset($admin_payment_setting['is_mercado_enabled']) && $admin_payment_setting['is_mercado_enabled'] == 'on') ||
                    (isset($admin_payment_setting['is_paytm_enabled']) && $admin_payment_setting['is_paytm_enabled'] == 'on') ||
                    (isset($admin_payment_setting['is_mollie_enabled']) && $admin_payment_setting['is_mollie_enabled'] == 'on') ||
                    (isset($admin_payment_setting['is_skrill_enabled']) && $admin_payment_setting['is_skrill_enabled'] == 'on') ||
                    (isset($admin_payment_setting['is_coingate_enabled']) && $admin_payment_setting['is_coingate_enabled'] == 'on') ||
                    (isset($admin_payment_setting['is_paymentwall_enabled']) && $admin_payment_setting['is_paymentwall_enabled'] == 'on') ||
                    (isset($admin_payment_setting['is_toyyibpay_enabled']) && $admin_payment_setting['is_toyyibpay_enabled'] == 'on') ||
                    (isset($admin_payment_setting['is_payfast_enabled']) && $admin_payment_setting['is_payfast_enabled'] == 'on') ||
                    (isset($admin_payment_setting['enable_bank']) && $admin_payment_setting['enable_bank'] == 'on') ||
                    (isset($admin_payment_setting['manually_enabled']) && $admin_payment_setting['manually_enabled'] == 'on') ||
                    (isset($admin_payment_setting['is_iyzipay_enabled']) && $admin_payment_setting['is_iyzipay_enabled'] == 'on') ||
                    (isset($admin_payment_setting['is_sspay_enabled']) && $admin_payment_setting['is_sspay_enabled'] == 'on') ||
                    (isset($admin_payment_setting['is_paytab_enabled']) && $admin_payment_setting['is_paytab_enabled'] == 'on') ||
                    (isset($admin_payment_setting['is_benefit_enabled']) && $admin_payment_setting['is_benefit_enabled'] == 'on') ||
                    (isset($admin_payment_setting['is_cashfree_enabled']) && $admin_payment_setting['is_cashfree_enabled'] == 'on') ||
                    (isset($admin_payment_setting['is_aamarpay_enabled']) && $admin_payment_setting['is_aamarpay_enabled'] == 'on') ||
                    (isset($admin_payment_setting['is_paytr_enabled']) && $admin_payment_setting['is_paytr_enabled'] == 'on') ||
                    (isset($admin_payment_setting['is_yookassa_enabled']) && $admin_payment_setting['is_yookassa_enabled'] == 'on') ||
                    (isset($admin_payment_setting['is_midtrans_enabled']) && $admin_payment_setting['is_midtrans_enabled'] == 'on') ||
                    (isset($admin_payment_setting['is_xendit_enabled']) && $admin_payment_setting['is_xendit_enabled'] == 'on') ||
                    (isset($admin_payment_setting['is_nepalste_enabled']) && $admin_payment_setting['is_nepalste_enabled'] == 'on') ||
                    (isset($admin_payment_setting['is_paiementpro_enabled']) && $admin_payment_setting['is_paiementpro_enabled'] == 'on') ||
                    (isset($admin_payment_setting['is_fedapay_enabled']) && $admin_payment_setting['is_fedapay_enabled'] == 'on') ||
                    (isset($admin_payment_setting['is_payhere_enabled']) && $admin_payment_setting['is_payhere_enabled'] == 'on') ||
                    (isset($admin_payment_setting['is_cinetpay_enabled']) && $admin_payment_setting['is_cinetpay_enabled'] == 'on') ||
                    (isset($admin_payment_setting['is_tap_enabled']) && $admin_payment_setting['is_tap_enabled'] == 'on')  ||
                    (isset($admin_payment_setting['is_authorizenet_enabled']) && $admin_payment_setting['is_authorizenet_enabled'] == 'on') ||
                    (isset($admin_payment_setting['is_khalti_enabled']) && $admin_payment_setting['is_khalti_enabled'] == 'on') ||
                    (isset($admin_payment_setting['is_easybuzz_enabled']) && $admin_payment_setting['is_easybuzz_enabled'] == 'on') ||
                    (isset($admin_payment_setting['ozow_payment_is_enabled']) && $admin_payment_setting['ozow_payment_is_enabled'] == 'on')
                ) {
                    return view('stripe', compact('plan', 'admin_payment_setting', 'modules'));
                } else {
                    return redirect()->back()->with('error', __('The admin has not set the payment method. '));
                }
            } else {
                return redirect()->back()->with('error', __('Plan is deleted.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function stripePost(Request $request)
    {
        try {
            $objUser                = \Auth::user();
            $planID                 = \Illuminate\Support\Facades\Crypt::decrypt($request->plan_id);
            $plan                   = Plan::find($planID);
            $admin_payment_setting  = Utility::getAdminPaymentSetting();
            $admin_currency         = !empty($admin_payment_setting['CURRENCY']) ? $admin_payment_setting['CURRENCY'] : 'USD';
            $orderID                = strtoupper(str_replace('.', '', uniqid('', true)));

            if ($plan) {
                $price = $plan->price;
                if (!empty($request->coupon)) {
                    $coupons = Coupon::where('code', strtoupper($request->coupon))->where('is_active', '1')->first();
                    if (!empty($coupons)) {
                        $usedCoupun = $coupons->used_coupon();
                        if ($coupons->type == 'percentage') {
                            $discount_value = ($plan->price / 100) * $coupons->discount;
                        } else {
                            $discount_value = $coupons->discount;
                        }
                        $price = $plan->price - $discount_value;
                        if ($coupons->limit == $usedCoupun) {
                            throw new  \Exception(__('This coupon code has expired.'), 000);
                        }
                        $coupon_id = $coupons->id;
                        if ($plan->price < $coupons->minimum_spend) {
                            $price = $plan->price;
                        }
                        if ($plan->price > $coupons->maximum_spend) {
                            $price = $plan->price;
                        }
                        $perusedCoupun = $coupons->per_used_coupon($objUser->id, $coupons->id);
                        if ($coupons->per_user_limit == $perusedCoupun) {
                            $price = $plan->price;
                        }
                    } else {
                        throw new  \Exception(__('This coupon code is invalid or has expired.'), 000);
                    }
                }

                $product = $plan->name;
                $code = '';
                /* Final price */
                $stripe_formatted_price = in_array($admin_currency, ['MGA', 'BIF', 'CLP', 'PYG', 'DJF', 'RWF', 'GNF', 'UGX', 'JPY', 'VND', 'VUV', 'XAF', 'KMF', 'KRW', 'XOF', 'XPF',]) ? number_format($price, 2, '.', '') : number_format($price, 2, '.', '') * 100;

                if ($stripe_formatted_price <= 0) {
                    $assignPlan = $objUser->assignPlan($plan->id);
                    if ($assignPlan['is_success']) {

                        PlanOrder::create([
                            'order_id'          => $orderID,
                            'name'              => $request->name,
                            'card_number'       => isset($data['payment_method_details']['card']['last4']) ? $data['payment_method_details']['card']['last4'] : '',
                            'card_exp_month'    => isset($data['payment_method_details']['card']['exp_month']) ? $data['payment_method_details']['card']['exp_month'] : '',
                            'card_exp_year'     => isset($data['payment_method_details']['card']['exp_year']) ? $data['payment_method_details']['card']['exp_year'] : '',
                            'plan_name'         => $plan->name,
                            'plan_id'           => $plan->id,
                            'price'             => $price,
                            'price_currency'    => !empty($admin_payment_setting['CURRENCY']) ? $admin_payment_setting['CURRENCY'] : '',
                            'txn_id'            => '',
                            'payment_type'      => __('STRIPE'),
                            'payment_status'    => isset($data['status']) ? $data['status'] : 'success',
                            'user_id'           => $objUser->id,
                        ]);

                        if (!empty($coupons) && $plan->price >= $coupons->minimum_spend && $plan->price <= $coupons->maximum_spend) {
                            $userCoupon = new UserCoupon();
                            $userCoupon->user = $objUser->id;
                            $userCoupon->coupon = $coupons->id;
                            $userCoupon->order = $orderID;
                            $userCoupon->save();
                            $usedCoupun = $coupons->used_coupon();
                        }
                        return redirect()->route('plans.index')->with('success', __('Plan successfully activated.'));
                    } else {
                        throw new  \Exception(__($assignPlan['error']), 000);
                    }
                }

                try {
                    \Stripe\Stripe::setApiKey($admin_payment_setting['stripe_secret']);

                    $stripe_session = \Stripe\Checkout\Session::create([
                        'payment_method_types' => ['card'],
                        'line_items' => [[
                            'price_data' => [
                                'currency' => $admin_currency,
                                'product_data' => [
                                    'name' => $product,
                                    'description' => $product,
                                ],
                                'unit_amount' => $stripe_formatted_price,
                            ],
                            'quantity' => 1,
                        ],],
                        'metadata' => [
                            'user_id' => $objUser->id,
                            'package_id' => $plan->id,
                            'code' => $code,
                        ],
                        'mode' => 'payment',
                        'success_url' => url('stripe-payment-status?session_id={CHECKOUT_SESSION_ID}&plan_id=' . $plan->id . '&currency=' . $admin_currency . '&amount=' . $price . '&coupon_id=' . $request->coupon . '&return_type=success'),
                        'cancel_url' => url('stripe-payment-status?session_id={CHECKOUT_SESSION_ID}&plan_id=' . $plan->id . '&currency=' . $admin_currency . '&amount=' . $price . '&coupon_id=' . $request->coupon . '&return_type=cancel'),
                    ]);

                    return new RedirectResponse($stripe_session->url);
                } catch (\Exception $e) {
                    return redirect()->route('plans.index')->with('error', $e->getCode() == 000 ? __($e->getMessage()) : __('oops, something went wrong'));
                }
            }
            throw new  \Exception(__('Plan is deleted.'), 000);
        } catch (\Exception $e) {
            return redirect()->route('plans.index')->with('error', $e->getCode() == 000 ? __($e->getMessage()) : __('oops, something went wrong'));
        }
    }

    public function planGetStripePaymentStatus(Request $request)
    {
        $admin_payment_setting = Utility::getAdminPaymentSetting();
        $plan = Plan::find($request->plan_id);

        try {
            if ($request->return_type == 'success') {
                $objUser                    = \Auth::user();

                $assignPlan = $objUser->assignPlan($request->plan_id);
                $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
                if ($request->has('coupon_id') && $request->coupon_id != '') {

                    if (!empty($request->coupon_id)) {
                        $coupons = Coupon::where('code', strtoupper($request->coupon_id))->where('is_active', '1')->first();
                        $usedCoupun = $coupons->used_coupon();
                        if (!empty($coupons) && $plan->price >= $coupons->minimum_spend && $plan->price <= $coupons->maximum_spend) {
                            $userCoupon = new UserCoupon();
                            $userCoupon->user = $objUser->id;
                            $userCoupon->coupon = $coupons->id;
                            $userCoupon->order = $orderID;
                            $userCoupon->save();
                            $usedCoupun = $coupons->used_coupon();
                        }
                    }
                }
                try {
                    $stripe = new \Stripe\StripeClient(!empty($admin_payment_setting['stripe_secret']) ? $admin_payment_setting['stripe_secret'] : '');

                    $session_id = $request->get('session_id');
                    $session = $stripe->checkout->sessions->retrieve($session_id);

                    $paymentIntent = $stripe->paymentIntents->retrieve(
                        $session->payment_intent,
                        ['expand' => ['latest_charge']]
                    );


                    $receipt_url = $paymentIntent->latest_charge->receipt_url;
                } catch (\Exception $exception) {
                    $receipt_url = "";
                }
                PlanOrder::create(
                    [
                        'order_id' => $orderID,
                        'name' => $objUser->name,
                        'card_number' => '',
                        'card_exp_month' => '',
                        'card_exp_year' => '',
                        'plan_name' => $plan->name,
                        'plan_id' => $plan->id,
                        'price' =>  $request->amount,
                        'price_currency' => !empty($admin_payment_setting['CURRENCY']) ? $admin_payment_setting['CURRENCY'] : 'USD',
                        'txn_id' => '',
                        'payment_type' => 'STRIPE',
                        'payment_status' => $request->return_type,
                        'receipt' => $receipt_url,
                        'user_id' => $objUser->id,
                    ]
                );

                Utility::referralTransaction($plan);
                if ($assignPlan['is_success']) {

                    return redirect()->route('plans.index')->with('success', __('Plan successfully activated.'));
                } else {
                    return redirect()->route('plans.index')->with('error', __($assignPlan['error']));
                }
            } else {
                return redirect()->route('plans.index')->with('error', __('Your Payment has failed!'));
            }
        } catch (\Exception $exception) {
            return redirect()->route('plans.index')->with('error', __('Something went wrong.'));
        }
    }

    public function addPayment(Request $request, $id)
    {
        $company_payment_setting = Utility::getCompanyPaymentSetting();
        $settings = DB::table('settings')->where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('value', 'name');
        $objUser = \Auth::user();
        $invoice = Invoice::find($id);
        if ($invoice) {
            if ($request->amount > $invoice->getDue()) {
                return redirect()->back()->with('error', __('Invalid amount.'));
            } else {
                try {

                    $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
                    $price = $request->amount;
                    Stripe\Stripe::setApiKey($company_payment_setting['stripe_secret']);
                    $data = Stripe\Charge::create(
                        [
                            "amount" => 100 * $price,
                            "currency" => Utility::getValByName('site_currency'),
                            "source" => $request->stripeToken,
                            "description" => 'Invoice ' . Utility::invoiceNumberFormat($settings, $invoice->invoice_id),
                            "metadata" => ["order_id" => $orderID],
                        ]
                    );

                    if ($data['amount_refunded'] == 0 && empty($data['failure_code']) && $data['paid'] == 1 && $data['captured'] == 1) {
                        $payments = InvoicePayment::create(
                            [

                                'invoice_id' => $invoice->id,
                                'date' => date('Y-m-d'),
                                'amount' => $price,
                                'account_id' => 0,
                                'payment_method' => 0,
                                'order_id' => $orderID,
                                'currency' => $data['currency'],
                                'txn_id' => $data['balance_transaction'],
                                'payment_type' => __('STRIPE'),
                                'receipt' => $data['receipt_url'],
                                'reference' => '',
                                'description' => 'Invoice ' . Utility::invoiceNumberFormat($settings, $invoice->invoice_id),
                            ]
                        );

                        if ($invoice->getDue() <= 0) {
                            $invoice->status = 4;
                        } elseif (($invoice->getDue() - $request->amount) == 0) {
                            $invoice->status = 4;
                        } else {
                            $invoice->status = 3;
                        }
                        $invoice->save();

                        $invoicePayment = new Transaction();
                        $invoicePayment->user_id = $invoice->customer_id;
                        $invoicePayment->user_type = 'Customer';
                        $invoicePayment->type = 'STRIPE';
                        $invoicePayment->created_by = \Auth::user()->id;
                        $invoicePayment->payment_id = $invoicePayment->id;
                        $invoicePayment->category = 'Invoice';
                        $invoicePayment->amount = $price;
                        $invoicePayment->date = date('Y-m-d');
                        $invoicePayment->created_by = \Auth::user()->creatorId();
                        $invoicePayment->payment_id = $payments->id;
                        $invoicePayment->description = 'Invoice ' . Utility::invoiceNumberFormat($settings, $invoice->invoice_id);
                        $invoicePayment->account = 0;
                        Transaction::addTransaction($invoicePayment);

                        Utility::userBalance('customer', $invoice->customer_id, $request->amount, 'debit');

                        Utility::bankAccountBalance($request->account_id, $request->amount, 'credit');

                        return redirect()->back()->with('success', __(' Payment successfully added.'));
                    } else {
                        return redirect()->back()->with('error', __('Transaction has been failed.'));
                    }
                } catch (\Exception $e) {

                    return redirect()->back()->with('error', __($e->getMessage()));
                }
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function destroyOrder($id)
    {
        $planorder = PlanOrder::find($id);
        if ($planorder) {
            $planorder->delete();
            return redirect()->back()->with('success', __('Order successfully deleted.'));
        }
        return redirect()->back()->with('error', __('Order not found.'));
    }

    public function cardPayWithStripe(Request $request, $id)
    {
        $paymentData = CardPayment::cardPaymentData($id);
        $business = Business::find($id);
        $amount = $paymentData->payment_amount;
        $content = json_decode($paymentData->content);
        $stripe_key = $content->stripe->stripe_key;
        $stripe_secret = $content->stripe->stripe_secret;
        $currancy = Utility::getValByName('site_currency');

        /* Final price */
        $stripe_formatted_price = in_array(
            $currancy,
            [
                'MGA',
                'BIF',
                'CLP',
                'PYG',
                'DJF',
                'RWF',
                'GNF',
                'UGX',
                'JPY',
                'VND',
                'VUV',
                'XAF',
                'KMF',
                'KRW',
                'XOF',
                'XPF',
            ]
        ) ? number_format($amount, 2, '.', '') : number_format($amount, 2, '.', '') * 100;

        $return_url_parameters = function ($return_type) {
            return '&return_type=' . $return_type . '&payment_processor=stripe';
        };

        /* Initiate Stripe */
        \Stripe\Stripe::setApiKey($stripe_secret);
        $code = '';
        $product = $business->title;
        $stripe = new \Stripe\StripeClient($stripe_secret);
        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'USD',
                        'product_data' => [
                            'name' => $product,
                        ],
                        'unit_amount' => $stripe_formatted_price,
                    ],
                    'quantity' => 1,
                ]
            ],
            'mode' => 'payment',
            'success_url' => route(
                'card.stripe',
                [
                    'cardpayment_id' => $paymentData->id,
                    'business_id' => $business->id,
                    $return_url_parameters('success'),
                ]
            ),
            'cancel_url' => route(
                'card.stripe',
                [
                    'cardpayment_id' => $paymentData->id,
                    'business_id' => $business->id,
                    $return_url_parameters('cancel'),
                ]
            ),


        ]);

        $checkout_session = $checkout_session ?? false;

        try {
            return new RedirectResponse($checkout_session->url);
        } catch (\Exception $e) {
            return redirect()->route('get.vcard', [$business->slug])->with('error', __('Transaction has been failed!'));
        }
    }

    public function cardGetStripePaymentStatus(Request $request)
    {
        $cardPayment = CardPayment::cardPaymentData($request->business_id);
        $business = Business::find($request->business_id);
        $content = json_decode($cardPayment->content);
        if ($request->return_type == 'success') {
            $cardPayment->payment_status = 'Paid';
            $cardPayment->payment_type = __('Stripe');
            $cardPayment->save();
            return redirect()->route('get.vcard', [$business->slug])->with('success', 'Payment Added Succesfully');
        } else {
            return redirect()->route('get.vcard', [$business->slug])->with('error', 'Something went wrong.');
        }
    }
}
