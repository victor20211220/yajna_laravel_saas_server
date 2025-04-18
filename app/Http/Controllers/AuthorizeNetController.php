<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utility;
use App\Models\Plan;
use App\Models\UserCoupon;
use App\Models\PlanOrder;
use App\Models\User;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Exception;

class AuthorizeNetController extends Controller
{
    public function planPayWithAuthorizeNet(Request $request)
    {
        $planID = Crypt::decrypt($request->plan_id);
        $authuser = \Auth::user();
        $adminPaymentSettings = Utility::getAdminPaymentSetting();
        $currency = !empty($adminPaymentSettings['CURRENCY']) ? $adminPaymentSettings['CURRENCY'] : 'USD';
        $plan = Plan::find($planID);
        $coupon_id = '0';

        $coupon_code = null;
        $discount_value = null;
        $coupons = Coupon::where('code', $request->coupon)->where('is_active', '1')->first();
        if ($plan) {
            $price = $plan->price;
            if (isset($request->coupon) && !empty($request->coupon)) {
                $request->coupon = trim($request->coupon);
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
                    $perusedCoupun = $coupons->per_used_coupon($authuser->id, $coupons->id);
                    if ($coupons->per_user_limit == $perusedCoupun) {
                        $get_amount = $plan->price;
                    }
                } else {
                    return redirect()->back()->with('error', __('This coupon code is invalid or has expired.'));
                }
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
                        } catch (Exception $e) {
                            return redirect()->route('plans.index')->with('error', __($e->getMessage()));
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
                            'price' => $price == null ? 0 : $price,
                            'price_currency' => $currency,
                            'txn_id' => '',
                            'payment_type' => 'AuthorizetNet',
                            'payment_status' => 'succeeded',
                            'receipt' => null,
                            'user_id' => $authuser->id,
                        ]
                    );
                    $assignPlan = $authuser->assignPlan($plan->id);

                    return redirect()->route('plans.index')->with('success', __('Plan Successfully Activated'));
                }
            }
            $data = [
                'id' =>  $plan->id,
                'amount' =>  $price,
                'coupon_code' =>  $request->coupon,
            ];
            $data  =    json_encode($data);
            try {
                return view('plan.request', compact('plan', 'price','data'));
            } catch (Exception $e) {
                return redirect()->route('plans.index')->with('error', __($e->getMessage()));
            }

        } else {
            return redirect()->back()->with('error', 'Plan is deleted.');
        }
    }
    public function planPayWithAuthorizeNetData(Request $request)
    {
        $payment_setting = Utility::getAdminPaymentSetting();
        $currency = isset($payment_setting['currency']) ? $payment_setting['currency'] : '';

        $input          = $request->all();
        $data           = json_decode($input['data'] , true);

         $plan           = Plan::find($data['id']);
        $getAmount         =  $data['amount'];
        $user = \Auth::user();

        Utility::referralTransaction($plan);
        $orderID = strtoupper(str_replace('.', '', uniqid('', true)));

        $order = new PlanOrder();
        $order->order_id = time();
        $order->name = $user->name;
        $order->card_number = '';
        $order->card_exp_month = '';
        $order->card_exp_year = '';
        $order->plan_name = $plan->name;
        $order->plan_id = $plan->id;
        $order->price = $getAmount;
        $order->price_currency = $currency;
        $order->txn_id = time();
        $order->payment_type = __('AuthorizetNet');
        $order->payment_status = 'success';
        $order->txn_id = '';
        $order->receipt = '';
        $order->user_id = $user->id;
        $order->save();
        $user = User::find($user->id);
        $coupons = Coupon::where('code', $data['coupon_code'])->where('is_active', '1')->first();
        if(!empty($coupons) && $plan->price >= $coupons->minimum_spend && $plan->price <= $coupons->maximum_spend){
            $userCoupon = new UserCoupon();
            $userCoupon->user = $user->id;
            $userCoupon->coupon = $coupons->id;
            $userCoupon->order = $order->order_id;
            $userCoupon->save();
            $usedCoupun = $coupons->used_coupon();

        }
        Utility::referralTransaction($plan);
        $assignPlan = $user->assignPlan($plan->id);
        if ($assignPlan['is_success']) {
            return redirect()->route('plans.index')->with('success', __('Plan activated Successfully.'));
        } else {
            return redirect()->route('plans.index')->with('error', __($assignPlan['error']));
        }
    }
}
