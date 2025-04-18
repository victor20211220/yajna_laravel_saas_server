<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Plan;
use App\Models\PlanOrder;
use App\Models\User;
use App\Models\UserCoupon;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
// use Xendit\Xendit;
use App\Xendit\Xendit;
class XenditPaymentController extends Controller
{
    public function planPayWithXendit(Request $request)
    {
        $payment_setting = Utility::getAdminPaymentSetting();
        $xendit_api = $payment_setting['xendit_api_key'];

        $currency = isset($payment_setting['CURRENCY']) ? $payment_setting['CURRENCY'] : 'USD';

        $planID = \Illuminate\Support\Facades\Crypt::decrypt($request->plan_id);
        $plan = Plan::find($planID);
        $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
        $user = Auth::user();
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
                    $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
                    $userCoupon = new UserCoupon();
                    $userCoupon->user = Auth::user()->id;
                    $userCoupon->coupon = $coupons->id;
                    $userCoupon->order = $orderID;
                    $userCoupon->save();
                } else {
                    return redirect()->back()->with('error', __('This coupon code is invalid or has expired.'));
                }
            }

            if($get_amount <= 0)
            {
                $user->plan = $plan->id;
                $user->save();

                $assignPlan = $user->assignPlan($plan->id);
                $orderID = time();

                if($request->has('coupon') && $request->coupon != ''){

                    $coupons         = Coupon::where('code', strtoupper($request->coupon))->where('is_active', '1')->first();
                    $discount_value         = ($plan->price / 100) * $coupons->discount;
                    $discounted_price = $plan->price - $discount_value;

                    if(!empty($coupons) && $plan->price >= $coupons->minimum_spend && $plan->price <= $coupons->maximum_spend)
                    {
                        $userCoupon         = new UserCoupon();
                        $userCoupon->user   = $user->id;
                        $userCoupon->coupon = $coupons->id;
                        $userCoupon->order  = $orderID;
                        $userCoupon->save();

                        $usedCoupun = $coupons->used_coupon();

                    }
                }

                if($assignPlan['is_success'] == true && !empty($plan))
                {
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
                            'price' => $plan->price,
                            'price_currency' => $get_amount == null ? 0 : $get_amount,
                            'txn_id' => '',
                            'payment_type' => 'Xendit',
                            'payment_status' => 'succeeded',
                            'receipt' => null,
                            'user_id' => $user->id,
                        ]
                    );
                    // $assignPlan = $authuser->assignPlan($plan->id, $request->mollie_payment_frequency);
                    return redirect()->route('plans.index')->with('success', __('Plan activated Successfully!'));
                }
                else
                {
                    return redirect()->back()->with('error', __('Plan fail to upgrade.'));
                }
            }

            $response = ['orderId' => $orderID, 'user' => $user, 'get_amount' => $get_amount, 'plan' => $plan, 'currency' => $currency];
            Xendit::setApiKey($xendit_api);
            $params = [
                'external_id' => $orderID,
                'payer_email' => Auth::user()->email,
                'description' => 'Payment for order ' . $orderID,
                'amount' => $get_amount,
                'callback_url' =>  route('plan.xendit.status'),
                'success_redirect_url' => route('plan.xendit.status', $response),
                'failure_redirect_url' => route('plans.index'),
            ];

            $invoice = \App\Xendit\Invoice::create($params);
            Session::put('invoice',$invoice);

            return redirect($invoice['invoice_url']);
        }
    }

    public function planGetXenditStatus(Request $request)
    {
        $payment_setting = Utility::getAdminPaymentSetting();
        $xendit_api = $payment_setting['xendit_api_key'];
        Xendit::setApiKey($xendit_api);

        $session = Session::get('invoice');
        $getInvoice = \App\Xendit\Invoice::retrieve($session['id']);


        $authuser = User::find($request->user);
        $plan = Plan::find($request->plan);

        if($getInvoice['status'] == 'PAID'){

            PlanOrder::create(
                [
                    'order_id' => $request->orderId,
                    'name' => null,
                    'email' => null,
                    'card_number' => null,
                    'card_exp_month' => null,
                    'card_exp_year' => null,
                    'plan_name' => $plan->name,
                    'plan_id' => $plan->id,
                    'price' => $request->get_amount == null ? 0 : $request->get_amount,
                    'price_currency' => $request->currency,
                    'txn_id' => '',
                    'payment_type' => __('Xendit'),
                    'payment_status' => 'succeeded',
                    'receipt' => null,
                    'user_id' => $request->user,
                ]
            );
            Utility::referralTransaction($plan);
            $assignPlan = $authuser->assignPlan($plan->id);

            if($assignPlan['is_success'])
            {
                return redirect()->route('plans.index')->with('success', __('Plan activated Successfully!'));
            }
            else
            {
                return redirect()->route('plans.index')->with('error', __($assignPlan['error']));
            }
        }
    }
}
