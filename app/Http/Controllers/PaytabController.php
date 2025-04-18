<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PayTab\paypage;
use App\Models\Plan;
use App\Models\PlanOrder;
use App\Models\UserCoupon;
use App\Models\Coupon;
use Exception;
use App\Models\Utility;
use Illuminate\Support\Facades\Auth;

class PaytabController extends Controller
{
    public $paytab_profile_id, $paytab_server_key, $paytab_region, $is_enabled;

    public function paymentConfig()
    {

        if (\Auth::check()) {
            $payment_setting = Utility::getAdminPaymentSetting();
        }
        config([
            'paytabs.profile_id' => isset($payment_setting['paytab_profile_id']) ? $payment_setting['paytab_profile_id'] : '',
            'paytabs.server_key' => isset($payment_setting['paytab_server_key']) ? $payment_setting['paytab_server_key'] : '',
            'paytabs.region' => isset($payment_setting['paytab_region']) ? $payment_setting['paytab_region'] : '',
            'paytabs.currency' => !empty($payment_setting['CURRENCY']) ? $payment_setting['CURRENCY'] : 'USD',
        ]);
    }


    //
    public function planPayWithpaytab(Request $request)
    {
        try {
            $planID = \Illuminate\Support\Facades\Crypt::decrypt($request->plan_id);
            $plan = Plan::find($planID);
            $this->paymentconfig();
            $user = Auth::user();
            $payment_setting = Utility::getAdminPaymentSetting();
            if ($plan) {
                $get_amount = $plan->price;

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
                        $perusedCoupun = $coupons->per_used_coupon($user->id, $coupons->id);
                        if ($coupons->per_user_limit == $perusedCoupun) {
                        }
                        if ($get_amount <= 0) {
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
                                $userCoupon = new UserCoupon();
                                $userCoupon->user = $authuser->id;
                                $userCoupon->coupon = $coupons->id;
                                $userCoupon->order = $orderID;
                                $userCoupon->save();
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
                                        'price_currency' => !empty($payment_setting['CURRENCY']) ? $payment_setting['CURRENCY'] : 'USD',
                                        'txn_id' => '',
                                        'payment_type' => 'Paytab',
                                        'payment_status' => 'success',
                                        'receipt' => null,
                                        'user_id' => $authuser->id,
                                    ]
                                );
                                $assignPlan = $authuser->assignPlan($plan->id);
                                return redirect()->route('plans.index')->with('success', __('Plan Successfully Activated'));
                            }
                        }
                    } else {
                        return redirect()->back()->with('error', __('This coupon code is invalid or has expired.'));
                    }
                }
                $coupon = (empty($request->coupon)) ? "0" : $request->coupon;
                $paypage = new paypage();
                $pay = $paypage->sendPaymentCode('all')
                    ->sendTransaction('sale','ecom') // Expecting two arguments here
                    ->sendCart(1, $get_amount, 'plan payment')
                    ->sendCustomerDetails(isset($user->name) ? $user->name : "", isset($user->email) ? $user->email : '', '', '', '', '', '', '', '')
                    ->sendURLs(
                        route('plan.paytab.success', ['success' => 1, 'data' => $request->all(), 'plan_id' => $plan->id, 'amount' => $get_amount, 'coupon' => $coupon]),
                        route('plan.paytab.success', ['success' => 0, 'data' => $request->all(), 'plan_id' => $plan->id, 'amount' => $get_amount, 'coupon' => $coupon])
                    )
                    ->sendLanguage('en')
                    ->sendFramed($on = false)
                    ->create_pay_page();
                return $pay;


            } else {
                return redirect()->route('plans.index')->with('error', __('Plan is deleted.'));
            }
        } catch (Exception $e) {
            return redirect()->route('plans.index')->with('error', __($e->getMessage()));
        }

    }
    public function PaytabGetPayment(Request $request)
    {
        $planId = $request->plan_id;
        $couponCode = $request->coupon;
        $getAmount = $request->amount;

        $payment_setting = Utility::getAdminPaymentSetting();
        if ($couponCode != 0) {
            $coupons = Coupon::where('code', strtoupper($couponCode))->where('is_active', '1')->first();
            $request['coupon_id'] = $coupons->id;
        } else {
            $coupons = null;
        }

        $plan = Plan::find($planId);
        $user = auth()->user();
        $orderID = strtoupper(str_replace('.', '', uniqid('', true)));

        try {
            if ($request->success == "1") {
                $order = new PlanOrder();
                $order->order_id = $orderID;
                $order->name = $user->name;
                $order->card_number = '';
                $order->card_exp_month = '';
                $order->card_exp_year = '';
                $order->plan_name = $plan->name;
                $order->plan_id = $plan->id;
                $order->price = $getAmount;
                $order->price_currency = !empty($payment_setting['CURRENCY']) ? $payment_setting['CURRENCY'] : 'USD';
                $order->payment_type = __('Paytab');
                $order->payment_status = 'success';
                $order->txn_id = '';
                $order->receipt = '';
                $order->user_id = $user->id;
                $order->save();
                $assignPlan = $user->assignPlan($plan->id);
                $coupons = Coupon::find($request->coupon_id);
                if (!empty($request->coupon_id)) {
                    if (!empty($coupons) && $plan->price >= $coupons->minimum_spend && $plan->price <= $coupons->maximum_spend) {
                        $userCoupon = new UserCoupon();
                        $userCoupon->user = $user->id;
                        $userCoupon->coupon = $coupons->id;
                        $userCoupon->order = $orderID;
                        $userCoupon->save();
                        $usedCoupun = $coupons->used_coupon();

                    }
                }
                Utility::referralTransaction($plan);
                if ($assignPlan['is_success']) {
                    return redirect()->route('plans.index')->with('success', __('Plan activated Successfully.'));
                } else {
                    return redirect()->route('plans.index')->with('error', __($assignPlan['error']));
                }

            } else {
                return redirect()->route('plans.index')->with('error', __('Your Transaction is fail please try again'));
            }
        } catch (Exception $e) {
            return redirect()->route('plans.index')->with('error', __($e->getMessage()));
        }
    }

}
