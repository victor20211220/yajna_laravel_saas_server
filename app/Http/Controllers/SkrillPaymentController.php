<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\PlanOrder;
use App\Models\Plan;
use App\Models\UserCoupon;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Obydul\LaraSkrill\SkrillClient;
use Obydul\LaraSkrill\SkrillRequest;

class SkrillPaymentController extends Controller
{
    public $email;
    public $is_enabled;

    public function paymentConfig()
    {

        $payment_setting = Utility::getAdminPaymentSetting();
        $this->email      = isset($payment_setting['skrill_email']) ? $payment_setting['skrill_email'] : '';
        $this->is_enabled = isset($payment_setting['is_skrill_enabled']) ? $payment_setting['is_skrill_enabled'] : 'off';

        return $this;
    }


    public function planPayWithSkrill(Request $request)
    {
        $payment    = $this->paymentConfig();
        $planID     = \Illuminate\Support\Facades\Crypt::decrypt($request->plan_id);
        $plan       = Plan::find($planID);
        $authuser   = Auth::user();
        $coupons_id = '';
        $payment_setting = Utility::getAdminPaymentSetting();
        if($plan)
        {
            $price = $plan->price;
            if(isset($request->coupon) && !empty($request->coupon))
            {
                $request->coupon = trim($request->coupon);
                $coupons         = Coupon::where('code', strtoupper($request->coupon))->where('is_active', '1')->first();
                if(!empty($coupons))
                {
                    $usedCoupun             = $coupons->used_coupon();
                    if ($coupons->type == 'percentage') {
                        $discount_value = ($plan->price / 100) * $coupons->discount;
                    } else {
                        $discount_value = $coupons->discount;
                    }
                    $price = $plan->price - $discount_value;

                    if($coupons->limit == $usedCoupun)
                    {
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
                     $price = $plan->price;
                    }
                }
                else
                {
                    return redirect()->back()->with('error', __('This coupon code is invalid or has expired.'));
                }
            }

            if($price <= 0)
            {
                $authuser->plan = $plan->id;
                $authuser->save();

                $assignPlan = $authuser->assignPlan($plan->id);

                if($assignPlan['is_success'] == true && !empty($plan))
                {

                    $orderID = time();
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
                            'price_currency' => !empty($payment_setting['CURRENCY']) ? $payment_setting['CURRENCY'] : 'USD',
                            'txn_id' => '',
                            'payment_type' => __('Skrill'),
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

                    return redirect()->route('plans.index')->with('success', __('Plan activated Successfully!'));
                }
                else
                {
                    return redirect()->back()->with('error', __('Plan fail to upgrade.'));
                }
            }
            $tran_id             = md5(date('Y-m-d') . strtotime('Y-m-d H:i:s') . 'user_id');
            $skill               = new SkrillRequest();
            $skill->pay_to_email = $this->email;
            $skill->return_url   = route(
                'plan.skrill', [
                    $request->plan_id,
                    'tansaction_id=' . MD5($tran_id),
                    'coupon_id=' . $coupons_id,
                    ]
                );
            $skill->cancel_url   = route('plan.skrill', [$request->plan_id]);

            // create object instance of SkrillRequest
            $skill->transaction_id  = MD5($tran_id); // generate transaction id
            $skill->amount          = $price;
            $skill->currency        = $payment_setting['CURRENCY'];
            $skill->language        = 'EN';
            $skill->prepare_only    = '1';
            $skill->merchant_fields = 'site_name, customer_email';
            $skill->site_name       = \Auth::user()->name;
            $skill->customer_email  = \Auth::user()->email;

            // create object instance of SkrillClient
            $client = new SkrillClient($skill);
            $sid    = $client->generateSID(); //return SESSION ID
            // handle error
            $jsonSID = json_decode($sid);
            if($jsonSID != null && $jsonSID->code == "BAD_REQUEST")
            {
                return redirect()->back()->with('error', $jsonSID->message);
            }


            // do the payment
            $redirectUrl = $client->paymentRedirectUrl($sid); //return redirect url
            if($tran_id)
            {
                $data = [
                    'amount' => $price,
                    'trans_id' => MD5($request['transaction_id']),
                    'currency' => $payment_setting['CURRENCY'],
                    'coupon_id' => $coupons_id,
                ];
                session()->put('skrill_data', $data);
            }

            return redirect($redirectUrl);

        }
        else
        {
            return redirect()->back()->with('error', 'Plan is deleted.');
        }

    }

    public function getPaymentStatus(Request $request, $plan)
    {
        $payment_setting = Utility::getAdminPaymentSetting();
        $planID  = \Illuminate\Support\Facades\Crypt::decrypt($plan);
        $plan    = Plan::find($planID);
        $user    = \Auth::user();
        $orderID = time();
        if($plan)
        {
            try
            {

                if(session()->has('skrill_data'))
                {
                    $get_data = session()->get('skrill_data');

                    if($get_data['coupon_id'] && $get_data['coupon_id'] != '')
                    {
                        $coupons = Coupon::find($get_data['coupon_id']);
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

                    $order                 = new PlanOrder();
                    $order->order_id       = $orderID;
                    $order->name           = $user->name;
                    $order->card_number    = '';
                    $order->card_exp_month = '';
                    $order->card_exp_year  = '';
                    $order->plan_name      = $plan->name;
                    $order->plan_id        = $plan->id;
                    $order->price          = isset($get_data['amount']) ? $get_data['amount'] : 0;
                    $order->price_currency = $payment_setting['CURRENCY'];
                    $order->txn_id         = isset($request->transaction_id) ? $request->transaction_id : '';
                    $order->payment_type   = __('Skrill');
                    $order->payment_status = 'success';
                    $order->receipt        = '';
                    $order->user_id        = $user->id;
                    $order->save();
                    Utility::referralTransaction($plan);
                    $assignPlan = $user->assignPlan($plan->id);

                    if($assignPlan['is_success'])
                    {
                        return redirect()->route('plans.index')->with('success', __('Plan activated Successfully!'));
                    }
                    else
                    {
                        return redirect()->route('plans.index')->with('error', __($assignPlan['error']));
                    }

                }
                else
                {
                    return redirect()->route('plans.index')->with('error', __('Transaction has been failed! '));
                }
            }
            catch(\Exception $e)
            {
                return redirect()->route('plans.index')->with('error', __('Plan not found!'));
            }
        }
    }
}
