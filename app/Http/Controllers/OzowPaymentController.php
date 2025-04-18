<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\UserCoupon;
use App\Models\PlanOrder;
use App\Models\Plan;
use App\Models\User;
use App\Models\Coupon;
use App\Models\Utility;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class OzowPaymentController extends Controller
{
    public static function generate_request_hash_check($inputString)
    {
        $stringToHash = strtolower($inputString);
        return hash('sha512', $stringToHash);
    }

    public function planPayWithOzow(Request $request)
    {
        $planID          = Crypt::decrypt($request->plan_id);
        $plan            = Plan::find($planID);
        $payment_setting = Utility::getAdminPaymentSetting();
        $currency        = isset($payment_setting['CURRENCY']) ? $payment_setting['CURRENCY'] : '';

        if ($currency != 'ZAR') {
            return redirect()->route(route: 'plans.index')->with('error', __('Your currency is not supported.'));
        }

        $plan       = Plan::find($planID);
        $authuser   = Auth::user();

        if ($plan) {
            try {
                $coupon_id = null;
                $price     = $plan->price;

                if (!empty($request->coupon)) {
                    $coupons = Coupon::where('code', strtoupper($request->coupon))->where('is_active', '1')->first();
                    if (!empty($coupons)) {
                        $usedCoupun     = $coupons->used_coupon();
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
                        }
                    } else {
                        return redirect()->back()->with('error', __('This coupon code is invalid or has expired.'));
                    }
                }

                if ($price <= 0) {
                    $authuser->plan = $plan->id;
                    $authuser->save();

                    $assignPlan = $authuser->assignPlan($plan->id);

                    if ($assignPlan['is_success'] == true && !empty($plan)) {

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
                                'price_currency' => $currency,
                                'txn_id' => '',
                                'payment_type' => __('Ozow'),
                                'payment_status' => 'success',
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
                        return redirect()->route('plans.index')->with('success', __('Plan Activated Successfully!'));
                    } else {
                        return redirect()->back()->with('error', __('Plan fail to upgrade.'));
                    }
                }

                $siteCode       = isset($payment_setting['ozow_site_key']) ? $payment_setting['ozow_site_key'] : '';
                $privateKey     = isset($payment_setting['ozow_private_key']) ? $payment_setting['ozow_private_key'] : '';
                $apiKey         = isset($payment_setting['ozow_api_key']) ? $payment_setting['ozow_api_key'] : '';
                $isTest         = isset($payment_setting['ozow_payment_mode']) && $payment_setting['ozow_payment_mode'] == 'sandbox'  ? 'true' : 'false';
                $plan_id        = $plan->id;
                $amount         = $price;
                $cancelUrl      = route('plan.get.ozow.status', [$plan_id, 'amount' => 20, 'coupon' => $request->coupon]);
                $successUrl     = route('plan.get.ozow.status', [$plan_id, 'amount' => $amount, 'coupon' => $request->coupon]);
                $bankReference  = time() . 'FKU';
                $transactionReference = time();
                $countryCode    = "ZA";

                $inputString    = $siteCode . $countryCode . $currency . $amount . $transactionReference . $bankReference . $cancelUrl . $successUrl . $successUrl . $successUrl . $isTest . $privateKey;

                $hashCheck      = $this->generate_request_hash_check($inputString);

                $data = [
                    "countryCode"           => $countryCode,
                    "amount"                => $amount,
                    "transactionReference"  => $transactionReference,
                    "bankReference"         => $bankReference,
                    "cancelUrl"             => $cancelUrl,
                    "currencyCode"          => $currency,
                    "errorUrl"              => $successUrl,
                    "isTest"                => $isTest, // boolean value here is okay
                    "notifyUrl"             => $successUrl,
                    "siteCode"              => $siteCode,
                    "successUrl"            => $successUrl,
                    "hashCheck"             => $hashCheck,
                ];

                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL             => 'https://api.ozow.com/postpaymentrequest',
                    CURLOPT_RETURNTRANSFER  => true,
                    CURLOPT_ENCODING        => '',
                    CURLOPT_MAXREDIRS       => 10,
                    CURLOPT_TIMEOUT         => 0,
                    CURLOPT_FOLLOWLOCATION  => true,
                    CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST   => 'POST',
                    CURLOPT_POSTFIELDS      => json_encode($data),
                    CURLOPT_HTTPHEADER      => array(
                        'Accept: application/json',
                        'ApiKey: ' . $apiKey,
                        'Content-Type: application/json'
                    ),
                ));

                $response = curl_exec($curl);
                curl_close($curl);
                $json_attendance = json_decode($response);

                if (isset($json_attendance->url) && $json_attendance->url != null) {
                    return redirect()->away($json_attendance->url);
                } else {
                    return redirect()
                        ->route('plans.index', Crypt::encrypt($plan->id))
                        ->with('error', $response['message'] ?? 'Something went wrong.');
                }
            } catch (\Exception $e) {
                return redirect()->route('plans.index')->with('error', __($e->getMessage()));
            }
        } else {
            return redirect()->route('plans.index')->with('error', __('Plan is deleted.'));
        }
    }

    public function planGetOzowStatus(Request $request, $plan_id)
    {
        if ($request->Status == "Complete") {
            $payment_setting = Utility::getAdminPaymentSetting();
            $currency = isset($payment_setting['currency']) ? $payment_setting['currency'] : 'NPR';

            $orderID = strtoupper(str_replace('.', '', uniqid('', true)));

            $getAmount = $request->Amount;
            $authuser = Auth::user();
            $plan = Plan::find($plan_id);

            if ($plan) {
                Utility::referralTransaction($plan);

                $order = new PlanOrder();
                $order->order_id = $orderID;
                $order->name = $authuser->name;
                $order->card_number = '';
                $order->card_exp_month = '';
                $order->card_exp_year = '';
                $order->plan_name = $plan->name;
                $order->plan_id = $plan->id;
                $order->price = $getAmount;
                $order->price_currency = $currency;
                $order->txn_id = $orderID;
                $order->payment_type = __('Ozow');
                $order->payment_status = 'success';
                $order->txn_id = '';
                $order->receipt = '';
                $order->user_id = $authuser->id;
                $order->save();
                $assignPlan = $authuser->assignPlan($plan->id);

                // $coupons = Coupon::find($request->coupon);
                $coupons = Coupon::where('code', strtoupper($request->coupon))->where('is_active', '1')->first();

                if (!empty($request->coupon)) {
                    if(!empty($coupons) && $plan->price >= $coupons->minimum_spend && $plan->price <= $coupons->maximum_spend)
                    {
                        $userCoupon = new UserCoupon();
                        $userCoupon->user = $authuser->id;
                        $userCoupon->coupon = $coupons->id;
                        $userCoupon->order = $orderID;
                        $userCoupon->save();
                        $usedCoupun = $coupons->used_coupon();
                        if ($coupons->limit <= $usedCoupun) {
                            $coupons->is_active = 0;
                            $coupons->save();
                        }
                    }
                }

                if ($assignPlan['is_success']) {
                    return redirect()->route('plans.index')->with('success', __('Plan activated Successfully.'));
                } else {
                    return redirect()->route('plans.index')->with('error', __($assignPlan['error']));
                }
            } else {
                return redirect()->route('plans.index')->with('error', __('Plan Not Found!'));
            }
        } else {
            return redirect()->route('plans.index')->with('error', __('Transaction has been failed.'));
        }
    }
}
