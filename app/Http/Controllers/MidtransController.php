<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Plan;
use App\Models\PlanOrder;
use App\Models\UserCoupon;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class MidtransController extends Controller
{
    public function planPayWithMidtrans(Request $request)
    {
        $payment_setting = Utility::getAdminPaymentSetting();
        $midtrans_secret = $payment_setting['midtrans_secret_key'];
        $mode = $payment_setting['midtrans_mode'];

        $currency = isset($payment_setting['CURRENCY']) ? $payment_setting['CURRENCY'] : 'USD';
        $authuser = Auth::user();
        try {
            $planID = Crypt::decrypt($request->plan_id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Handle decryption error, for example, redirect to an error page
            return redirect()->route('plans.index')->with('error', 'Your transaction are cancel.');
        }
        $plan = Plan::find($planID);
        $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
        if ($plan) {
            $get_amount = round($plan->price);

            if ($request->has('coupon') && $request->coupon != '') {

                $coupons = Coupon::where('code', strtoupper($request->coupon))->where('is_active', '1')->first();
                $discount_value = ($plan->price / 100) * $coupons->discount;
                $discounted_price = $plan->price - $discount_value;

                if (!empty($coupons) && $plan->price >= $coupons->minimum_spend && $plan->price <= $coupons->maximum_spend) {
                    $userCoupon = new UserCoupon();
                    $userCoupon->user = $authuser->id;
                    $userCoupon->coupon = $coupons->id;
                    $userCoupon->order = $orderID;
                    $userCoupon->save();

                    $usedCoupun = $coupons->used_coupon();
                    if ($coupons->type == 'percentage') {
                        $discount_value = ($plan->price / 100) * $coupons->discount;
                    } else {
                        $discount_value = $coupons->discount;
                    }
                    $get_amount = $plan->price - $discount_value;

                    if ($coupons->limit == $usedCoupun) {
                        return redirect()->back()->with('error', __('This coupon code has expired.'));
                    }
                    $coupon_id = $coupons->id;
                    if ($plan->price < $coupons->minimum_spend) {
                        $get_amount = $plan->price;
                    }
                    if ($plan->price > $coupons->maximum_spend) {
                        $get_amount = $plan->price;
                    }
                    $perusedCoupun = $coupons->per_used_coupon($authuser->id, $coupons->id);
                    if ($coupons->per_user_limit == $perusedCoupun) {
                    }

                }
            }

            if ($get_amount <= 0) {
                $authuser->plan = $plan->id;
                $authuser->save();

                $assignPlan = $authuser->assignPlan($plan->id);

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
                        'price' => $get_amount == null ? 0 : $get_amount,
                        'price_currency' => $currency,
                        'txn_id' => '',
                        'payment_type' => __('Midtrans'),
                        'payment_status' => 'Succeeded',
                        'receipt' => null,
                        'user_id' => $authuser->id,
                    ]
                );
                $assignPlan = $authuser->assignPlan($plan->id);

                if ($assignPlan['is_success']) {
                    return redirect()->route('plans.index')->with('success', __('Plan activated Successfully.'));
                } else {
                    return redirect()->route('plans.index')->with('error', __($assignPlan['error']));
                }
            }

            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = $midtrans_secret;
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).

            if ($mode == 'sandbox') {
                \Midtrans\Config::$isProduction = false;
            } else {
                \Midtrans\Config::$isProduction = true;
            }

            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;
            try {
                $params = array(
                    'transaction_details' => array(
                        'order_id' => $orderID,
                        'gross_amount' => round($get_amount),
                    ),
                    'customer_details' => array(
                        'first_name' => Auth::user()->name,
                        'last_name' => '',
                        'email' => Auth::user()->email,
                        'phone' => '8787878787',
                    ),
                    'callbacks' => array(
                        'finish' => route('plan.get.midtrans.status'), // Success URL
                        'unfinish' => route('plans.index'), // Cancel URL
                        'error' => route('plans.index'), // Error URL
                    ),
                );
                $snapToken = \Midtrans\Snap::getSnapToken($params);

                $authuser = Auth::user();


                $data = [
                    'snap_token' => $snapToken,
                    'midtrans_secret' => $midtrans_secret,
                    'order_id' => $orderID,
                    'plan_id' => $plan->id,
                    'amount' => $get_amount,
                    'fallback_url' => 'plan.get.midtrans.status'
                ];

                return view('midtras.payment', compact('data'));
            } catch (\Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }


        }
    }

    public function planGetMidtransStatus(Request $request)
    {
        $response = json_decode($request->json, true);
        if (isset($response['status_code']) && $response['status_code'] == 200) {
            $plan = Plan::find($request['plan_id']);
            $payment_setting = Utility::getAdminPaymentSetting();
            $get_amount = round($request->amount);
            $currency = isset($payment_setting['CURRENCY']) ? $payment_setting['CURRENCY'] : 'USD';
            $orderID = $request->order_id;

            $user = auth()->user();
            $user->plan = $plan->id;
            $user->save();

            try {
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
                        'price' => $get_amount == null ? 0 : $get_amount,
                        'price_currency' => $currency,
                        'txn_id' => '',
                        'payment_type' => __('Midtrans'),
                        'payment_status' => 'Succeeded',
                        'receipt' => null,
                        'user_id' => $user->id,
                    ]
                );
                Utility::referralTransaction($plan);
                $assignPlan = $user->assignPlan($plan->id);

                if ($assignPlan['is_success']) {
                    return redirect()->route('plans.index')->with('success', __('Plan activated Successfully.'));
                } else {
                    return redirect()->route('plans.index')->with('error', __($assignPlan['error']));
                }
            } catch (\Exception $e) {
                return redirect()->route('plans.index')->with('error', __($e->getMessage()));
            }
        } else {
            return redirect()->back()->with('error', $response['status_message']);
        }
    }
}
