<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\CardPayment;
use App\Models\Coupon;
use App\Models\PlanOrder;
use App\Models\Plan;
use App\Models\UserCoupon;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class PaypalController extends Controller
{
    private $_api_context;


    public function paymentConfig()
    {
        if (\Auth::check()) {
            $payment_setting = Utility::getAdminPaymentSetting();
        } else {
            $payment_setting = Utility::getCompanyPaymentSetting($this->invoiceData->created_by);
        }
        if ($payment_setting['paypal_mode'] == 'live') {
            config([
                'paypal.live.client_id' => isset($payment_setting['paypal_client_id']) ? $payment_setting['paypal_client_id'] : '',
                'paypal.live.client_secret' => isset($payment_setting['paypal_secret_key']) ? $payment_setting['paypal_secret_key'] : '',
                'paypal.mode' => isset($payment_setting['paypal_mode']) ? $payment_setting['paypal_mode'] : '',
            ]);
        } else {
            config([
                'paypal.sandbox.client_id' => isset($payment_setting['paypal_client_id']) ? $payment_setting['paypal_client_id'] : '',
                'paypal.sandbox.client_secret' => isset($payment_setting['paypal_secret_key']) ? $payment_setting['paypal_secret_key'] : '',
                'paypal.mode' => isset($payment_setting['paypal_mode']) ? $payment_setting['paypal_mode'] : '',
            ]);
        }

    }
    public function planPayWithPaypal(Request $request)
    {

        $objUser = \Auth::user();
        $planID = \Illuminate\Support\Facades\Crypt::decrypt($request->plan_id);
        $plan = Plan::find($planID);
        $this->paymentconfig();
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $get_amount = $plan->price;
        $payment_setting = Utility::getAdminPaymentSetting();
        $currency=!empty($payment_setting['CURRENCY']) ? $payment_setting['CURRENCY'] : 'USD';
        if ($plan) {
            try {

                $coupon_id = 0;
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
                            return redirect()->back()->with('error', __('This coupon code has expired.'));
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
                        return redirect()->back()->with('error', __('This coupon code is invalid or has expired.'));
                    }
                }
                $coupons = Coupon::find($coupon_id);
                $user = Auth::user();
                $orderID = time();
                if (!empty($coupons) && $plan->price >= $coupons->minimum_spend && $plan->price <= $coupons->maximum_spend) {
                    $userCoupon = new UserCoupon();
                    $userCoupon->user = $user->id;
                    $userCoupon->coupon = $coupons->id;
                    $userCoupon->order = $orderID;
                    $userCoupon->save();
                    $usedCoupun = $coupons->used_coupon();

                }
                if ($price <= 0) {
                    $authuser = Auth::user();
                    $authuser->plan = $plan->id;
                    $authuser->save();
                    $assignPlan = $authuser->assignPlan($plan->id);
                    if ($assignPlan['is_success'] == true && !empty($plan)) {
                        if (!empty($authuser->payment_subscription_id) && $authuser->payment_subscription_id != '') {
                            try {
                                $authuser->cancel_subscription($authuser->id);
                            } catch (\Exception $exception) {
                                \Log::debug($exception->getMessage());
                            }
                        }
                        $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
                        PlanOrder::create(
                            [
                                'order_id' => $orderID,
                                'name' => null,
                                'email' => null,
                                'card_number' => null,
                                'card_exp_month' => null,
                                'card_exp_year' => null,
                                'plan_name' => $plan->name,
                                'plan_id' => $plan->id,
                                'price' => $price == null ? 0 : $price,
                                'price_currency' => $currency,
                                'txn_id' => '',
                                'payment_type' => 'Paypal',
                                'payment_status' => 'succeeded',
                                'receipt' => null,
                                'user_id' => $authuser->id,
                            ]
                        );
                        if(!empty($coupons) && $plan->price >= $coupons->minimum_spend && $plan->price <= $coupons->maximum_spend)
                        {
                            $userCoupon         = new UserCoupon();
                            $userCoupon->user   = $authuser->id;
                            $userCoupon->coupon = $coupons->id;
                            $userCoupon->order  = $orderID;
                            $userCoupon->save();

                            $usedCoupun = $coupons->used_coupon();
                            if ($coupons->limit <= $usedCoupun) {
                                $coupons->is_active = 0;
                                $coupons->save();
                            }
                        }
                        $assignPlan = $authuser->assignPlan($plan->id);

                        return redirect()->route('plans.index')->with('success', __('Plan Successfully Activated'));
                    }
                }
                $this->paymentConfig();
                $paypalToken = $provider->getAccessToken();
                $response = $provider->createOrder([
                    "intent" => "CAPTURE",
                    "application_context" => [
                        "return_url" => route('plan.get.payment.status', [$plan->id, $price, $coupon_id]),
                        "cancel_url" => route('plan.get.payment.status', [$plan->id, $price, $coupon_id]),
                    ],
                    "purchase_units" => [
                        0 => [
                            "amount" => [
                                "currency_code" => $currency,
                                "value" => $price
                            ]
                        ]
                    ]
                ]);
                if (isset($response['id']) && $response['id'] != null) {
                    // redirect to approve href
                    foreach ($response['links'] as $links) {
                        if ($links['rel'] == 'approve') {
                            return redirect()->away($links['href']);
                        }
                    }
                    return redirect()
                        ->route('plans.index')
                        ->with('error', 'Something went wrong.');
                } else {
                    return redirect()
                        ->route('plans.index')
                        ->with('error', $response['message'] ?? 'Something went wrong.');
                }
            } catch (\Exception $e) {
                return redirect()->route('plans.index')->with('error', __($e->getMessage()));
            }
        } else {
            return redirect()->route('plans.index')->with('error', __('Plan is deleted.'));
        }
    }

    public function planGetPaymentStatus(Request $request, $plan_id, $amount, $coupon_id)
    {
        $payment_setting = Utility::getAdminPaymentSetting();
        $user = Auth::user();
        $plan = Plan::find($plan_id);
        $currency=!empty($payment_setting['CURRENCY']) ? $payment_setting['CURRENCY'] : 'USD';
        if ($plan) {
            $this->paymentConfig();
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();
            $response = $provider->capturePaymentOrder($request['token']);

            $payment_id = Session::get('paypal_payment_id');
            $order_id = strtoupper(str_replace('.', '', uniqid('', true)));

            Utility::referralTransaction($plan);
            if ($coupon_id != '' && $coupon_id != 0) {
                $coupons = Coupon::find($coupon_id);

                if (!empty($coupons) && $plan->price >= $coupons->minimum_spend && $plan->price <= $coupons->maximum_spend) {
                    $userCoupon = new UserCoupon();
                    $userCoupon->user = $user->id;
                    $userCoupon->coupon = $coupons->id;
                    $userCoupon->order = $order_id;
                    $userCoupon->save();
                    $usedCoupun = $coupons->used_coupon();

                }
            }
            if (isset($response['status']) && $response['status'] == 'COMPLETED') {
                if ($response['status'] == 'COMPLETED') {
                    $statuses = 'success';
                }

                $order = new PlanOrder();
                $order->order_id = $order_id;
                $order->name = $user->name;
                $order->card_number = '';
                $order->card_exp_month = '';
                $order->card_exp_year = '';
                $order->plan_name = $plan->name;
                $order->plan_id = $plan->id;
                $order->price = $amount;
                $order->price_currency = $currency;
                $order->txn_id = $payment_id;
                $order->payment_type = __('PAYPAL');
                $order->payment_status = $statuses;
                $order->txn_id = '';
                $order->receipt = '';
                $order->user_id = $user->id;
                $order->save();
                $assignPlan = $user->assignPlan($plan->id);
                if ($assignPlan['is_success']) {
                    return redirect()->route('plans.index')->with('success', __('Plan activated Successfully.'));
                } else {
                    return redirect()->route('plans.index')->with('error', __($assignPlan['error']));
                }

                return redirect()
                    ->route('plans.index')
                    ->with('success', 'Transaction complete.');
            } else {
                return redirect()
                    ->route('plans.index')
                    ->with('error', $response['message'] ?? 'Something went wrong.');
            }
        } else {
            return redirect()->route('plans.index')->with('error', __('Plan is deleted.'));
        }
    }

    public function cardPayWithPaypal(Request $request, $id)
    {
        $paymentData = CardPayment::cardPaymentData($id);
        $business = Business::find($id);
        $amount = $paymentData->payment_amount;
        $content = json_decode($paymentData->content);
        $paypal_mode = $content->paypal->paypal_mode;
        $paypal_client_id = $content->paypal->paypal_client_id;
        $paypal__secret_key = $content->paypal->paypal_secret_key;
        if ($paypal_mode == 'live') {
            config([
                'paypal.live.client_id' => isset($paypal_client_id) ? $paypal_client_id : '',
                'paypal.live.client_secret' => isset($paypal__secret_key) ? $paypal__secret_key : '',
                'paypal.mode' => isset($paypal_mode) ? $paypal_mode : '',
            ]);
        } else {
            config([
                'paypal.sandbox.client_id' => isset($paypal_client_id) ? $paypal_client_id : '',
                'paypal.sandbox.client_secret' => isset($paypal__secret_key) ? $paypal__secret_key : '',
                'paypal.mode' => isset($paypal_mode) ? $paypal_mode : '',
            ]);
        }
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $currency=!empty($payment_setting['CURRENCY']) ? $payment_setting['CURRENCY'] : 'USD';
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('card.get.payment.status', [$id]),
                "cancel_url" => route('card.get.payment.status', [$id]),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => $currency,
                        "value" => $amount
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()->route('get.vcard', [$business->slug])->with('error', 'Something went wrong.');
        } else {
            return redirect()->route('get.vcard', [$business->slug])->with('error', $response['message'] ?? 'Something went wrong.');
        }

    }
    public function cardGetPaymentStatus(Request $request, $business_id)
    {

        $cardPayment = CardPayment::cardPaymentData($business_id);
        $business = Business::find($business_id);
        $content = json_decode($cardPayment->content);
        $paypal_mode = $content->paypal->paypal_mode;
        $paypal_client_id = $content->paypal->paypal_client_id;
        $paypal__secret_key = $content->paypal->paypal_secret_key;

        if ($paypal_mode == 'live') {
            config([
                'paypal.live.client_id' => isset($paypal_client_id) ? $paypal_client_id : '',
                'paypal.live.client_secret' => isset($paypal__secret_key) ? $paypal__secret_key : '',
                'paypal.mode' => isset($paypal_mode) ? $paypal_mode : '',
            ]);
        } else {
            config([
                'paypal.sandbox.client_id' => isset($paypal_client_id) ? $paypal_client_id : '',
                'paypal.sandbox.client_secret' => isset($paypal__secret_key) ? $paypal__secret_key : '',
                'paypal.mode' => isset($paypal_mode) ? $paypal_mode : '',
            ]);
        }
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        $payment_id = Session::get('paypal_payment_id');
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $cardPayment->payment_status = 'Paid';
            $cardPayment->payment_type = __('Paypal');
            $cardPayment->save();
            return redirect()->route('get.vcard', [$business->slug])->with('success', 'Payment Added Succesfully');
        } else {
            return redirect()->route('get.vcard', [$business->slug])->with('error', 'Transaction has been failed..');
        }

    }
}
