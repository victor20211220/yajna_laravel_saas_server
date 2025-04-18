<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Plan;
use App\Models\PlanOrder;
use App\Models\UserCoupon;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use YooKassa\Client;

class YooKassaController extends Controller
{
    public function planPayWithYooKassa(Request $request)
    {
        $payment_setting = Utility::getAdminPaymentSetting();
        $yookassa_shop_id = $payment_setting['yookassa_shop_id'];
        $yookassa_secret_key = $payment_setting['yookassa_secret_key'];
        $currency = isset($payment_setting['CURRENCY']) ? $payment_setting['CURRENCY'] : 'USD';

        try {

            $planID = \Illuminate\Support\Facades\Crypt::decrypt($request->plan_id);
            $authuser = Auth::user();
            $plan = Plan::find($planID);
            if ($plan) {

                $get_amount = $plan->price;
                $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
                if (!empty($request->coupon)) {
                    $coupons = Coupon::where('code', strtoupper($request->coupon))->where('is_active', '1')->first();

                    if (!empty($coupons)) {
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
                        $userCoupon = new UserCoupon();
                        $userCoupon->user = Auth::user()->id;
                        $userCoupon->coupon = $coupons->id;
                        $userCoupon->order = $orderID;
                        $userCoupon->save();
                    } else {
                        return redirect()->back()->with('error', __('This coupon code is invalid or has expired.'));
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
                            'payment_type' => __('YooKassa'),
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

                try {

                    if (is_int((int)$yookassa_shop_id)) {
                        $client = new Client();
                        $client->setAuth((int)$yookassa_shop_id, $yookassa_secret_key);
                        $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
                        $product = !empty($plan->name) ? $plan->name : 'Life time';
                        $payment = $client->createPayment(
                            array(
                                'amount' => array(
                                    'value' => $get_amount,
                                    'currency' => $currency,
                                ),
                                'confirmation' => array(
                                    'type' => 'redirect',
                                    'return_url' => route('plan.get.yookassa.status', [$plan->id, 'order_id' => $orderID, 'price' => $get_amount]),
                                ),
                                'capture' => true,
                                'description' => 'Заказ №1',
                            ),
                            uniqid('', true)
                        );

                        $authuser = Auth::user();
                        $authuser->plan = $plan->id;
                        $authuser->save();


                        if (!empty($authuser->payment_subscription_id) && $authuser->payment_subscription_id != '') {
                            try {
                                $authuser->cancel_subscription($authuser->id);
                            } catch (\Exception $exception) {
                                Log::debug($exception->getMessage());
                            }
                        }

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
                                'payment_type' => __('YooKassa'),
                                'payment_status' => 'pending',
                                'receipt' => null,
                                'user_id' => $authuser->id,
                            ]
                        );


                        Session::put('payment_id', $payment['id']);

                        if ($payment['confirmation']['confirmation_url'] != null) {
                            return redirect($payment['confirmation']['confirmation_url']);
                        } else {
                            return redirect()->route('plans.index')->with('error', 'Something went wrong, Please try again');
                        }

                        // return redirect()->route('plans.index')->with('success', __('Plan Successfully Activated'));

                    } else {
                        return redirect()->back()->with('error', 'Please Enter  Valid Shop Id Key');
                    }
                } catch (\Throwable $th) {

                    return redirect()->back()->with('error', $th->getMessage());
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function planGetYooKassaStatus(Request $request, $planId)
    {

        $payment_setting = Utility::getAdminPaymentSetting();
        $yookassa_shop_id = $payment_setting['yookassa_shop_id'];
        $yookassa_secret_key = $payment_setting['yookassa_secret_key'];
        $currency = isset($payment_setting['CURRENCY']) ? $payment_setting['CURRENCY'] : 'USD';

        if (is_int((int)$yookassa_shop_id)) {
            $client = new Client();
            $client->setAuth((int)$yookassa_shop_id, $yookassa_secret_key);
            $paymentId = Session::get('payment_id');
            Session::forget('payment_id');
            if ($paymentId == null) {
                return redirect()->back()->with('error', __('Transaction Unsuccesfull'));
            }

            $payment = $client->getPaymentInfo($paymentId);

            if (isset($payment) && $payment->status == "succeeded") {

                $plan = Plan::find($planId);
                $user = auth()->user();
                //$orderID = strtoupper(str_replace('.', '', uniqid('', true)));
                try {
                    $Order                 = PlanOrder::where('order_id', $request->order_id)->first();
                    $Order->payment_status = 'succeeded';
                    $Order->save();

                    Utility::referralTransaction($plan);
                    $assignPlan = $user->assignPlan($plan->id);
                    $coupons = Coupon::find($request->coupon_id);

                    if (!empty($request->coupon_id)) {
                        if (!empty($coupons) && $plan->price >= $coupons->minimum_spend && $plan->price <= $coupons->maximum_spend) {
                            $userCoupon = new UserCoupon();
                            $userCoupon->user = $user->id;
                            $userCoupon->coupon = $coupons->id;
                            $userCoupon->order = $request->order_id;
                            $userCoupon->save();
                            $usedCoupun = $coupons->used_coupon();

                        }
                    }

                    if ($assignPlan['is_success']) {
                        return redirect()->route('plans.index')->with('success', __('Plan activated Successfully.'));
                    } else {
                        return redirect()->route('plans.index')->with('error', __($assignPlan['error']));
                    }
                } catch (\Exception $e) {
                    return redirect()->route('plans.index')->with('error', __($e->getMessage()));
                }
            } else {
                return redirect()->back()->with('error', 'Please Enter  Valid Shop Id Key');
            }
        }
    }
}
