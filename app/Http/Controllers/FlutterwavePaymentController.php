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

class FlutterwavePaymentController extends Controller
{
    public $secret_key;
    public $public_key;
    public $is_enabled;


    public function paymentConfig()
    {
        if(\Auth::user()->type == 'company')
        {
            $payment_setting = Utility::getAdminPaymentSetting();
        }
        else
        {
            $payment_setting = Utility::getCompanyPaymentSetting();
        }

        $this->secret_key = isset($payment_setting['flutterwave_secret_key']) ? $payment_setting['flutterwave_secret_key'] : '';
        $this->public_key = isset($payment_setting['flutterwave_public_key']) ? $payment_setting['flutterwave_public_key'] : '';
        $this->is_enabled = isset($payment_setting['is_flutterwave_enabled']) ? $payment_setting['is_flutterwave_enabled'] : 'off';

        return $this;
    }


    public function planPayWithFlutterwave(Request $request)
    {
        $planID    = \Illuminate\Support\Facades\Crypt::decrypt($request->plan_id);
        $plan      = Plan::find($planID);
        $authuser  = Auth::user();
        $setting = Utility::settings();
        $coupon_id = '';
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

                    if($usedCoupun >= $coupons->limit)
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
                            'price_currency' => !empty($payment_setting['CURRENCY']) ? $payment_setting['CURRENCY'] : 'USD',
                            'txn_id' => '',
                            'payment_type' => __('Flutterwave'),
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
                        $res['msg']  = __("Plan successfully upgraded.");
                        $res['flag'] = 2;
                        return $res;
                }
                else
                {

                    return Utility::error_res(__('Plan fail to upgrade.'));
                }
            }

            $res_data['email']       = \Auth::user()->email;
            $res_data['total_price'] = $price;
            $res_data['currency']    = $setting['site_currency'];
            $res_data['flag']        = 1;
            $res_data['coupon']      = $coupon_id;


            return $res_data;
        }
        else
        {
            return Utility::error_res(__('Plan is deleted.'));
        }

    }

    public function getPaymentStatus(Request $request, $pay_id, $plan)
    {
        $payment = $this->paymentConfig();
        $planID  = \Illuminate\Support\Facades\Crypt::decrypt($plan);
        $plan    = Plan::find($planID);
        $result  = array();
        $user = Auth::user();
        $payment_setting = Utility::getAdminPaymentSetting();

        if($plan)
        {
            try
            {
                $orderID = time();
                $data    = array(
                    'txref' => $pay_id,
                    'SECKEY' => $this->secret_key,
                    //secret key from pay button generated on rave dashboard
                );
                // make request to endpoint using unirest.
                $headers = array('Content-Type' => 'application/json');
                $body    = \Unirest\Request\Body::json($data);

                $url     = "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify"; //please make sure to change this to production url when you go live
                // Make `POST` request and handle response with unirest
                $response = \Unirest\Request::post($url, $headers, $body);
                if(!empty($response))
                {
                    $response = json_decode($response->raw_body, true);
                }
                if(isset($response['status']) && $response['status'] == 'success')
                {
                    $paydata = $response['data'];

                    if($request->has('coupon_id') && $request->coupon_id != '')
                    {
                        $coupons = Coupon::find($request->coupon_id);
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
                    $order->price          = isset($paydata['amount']) ? $paydata['amount'] : 0;
                    $order->price_currency = !empty($payment_setting['CURRENCY']) ? $payment_setting['CURRENCY'] : 'USD';
                    $order->txn_id         = isset($paydata['txid']) ? $paydata['txid'] : $pay_id;
                    $order->payment_type   = __('Flutterwave');
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

    public function invoicePayWithFlutterwave(Request $request)
    {
        $invoiceID = \Illuminate\Support\Facades\Crypt::decrypt($request->invoice_id);
        $invoice   = Invoice::find($invoiceID);

        if($invoice)
        {
            $price = $request->amount;
            if($price > 0)
            {
                $res_data['email']       = \Auth::user()->email;
                $res_data['total_price'] = $price;
                $res_data['currency']    = Utility::getValByName('site_currency');
                $res_data['flag']        = 1;

                return $res_data;

            }
            else
            {
                $res['msg']  = __("Enter valid amount.");
                $res['flag'] = 2;

                return $res;
            }

        }
        else
        {
            return redirect()->route('invoice.index')->with('error', __('Invoice is deleted.'));

        }


    }

    public function getInvoicePaymentStatus(Request $request, $pay_id, $invoice_id)
    {
        $orderID   = strtoupper(str_replace('.', '', uniqid('', true)));
        $settings  = DB::table('settings')->where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('value', 'name');
        $payment   = $this->paymentConfig();
        $invoiceID = \Illuminate\Support\Facades\Crypt::decrypt($invoice_id);
        $invoice   = Invoice::find($invoiceID);
        $result    = array();

        if($invoice)
        {
            try
            {

                $data = array(
                    'txref' => $pay_id,
                    'SECKEY' => $this->secret_key,
                    //secret key from pay button generated on rave dashboard
                );
                // make request to endpoint using unirest.
                $headers = array('Content-Type' => 'application/json');
                $body    = \Unirest\Request\Body::json($data);
                $url     = "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify"; //please make sure to change this to production url when you go live

                // Make `POST` request and handle response with unirest
                $response = \Unirest\Request::post($url, $headers, $body);
                if(!empty($response))
                {
                    $response = json_decode($response->raw_body, true);
                }
                if(isset($response['status']) && $response['status'] == 'success')
                {
                    $paydata = $response['data'];

                    $payments = InvoicePayment::create(
                        [
                            'invoice' => $invoice->id,
                            'date' => date('Y-m-d'),
                            'amount' => $request->amount,
                            'payment_method' => 1,
                            'transaction' => $orderID,
                            'payment_type' => __('Flutterwave'),
                            'receipt' => '',
                            'notes' => __('Invoice') . ' ' . Utility::invoiceNumberFormat($settings, $invoice->invoice_id),
                        ]
                    );

                    $invoice = Invoice::find($invoice->id);

                    if($invoice->getDue() <= 0.0)
                    {
                        Invoice::change_status($invoice->id, 5);
                    }
                    elseif($invoice->getDue() > 0)
                    {
                        Invoice::change_status($invoice->id, 4);
                    }
                    else
                    {
                        Invoice::change_status($invoice->id, 3);
                    }

                    return redirect()->back()->with('success', __(' Payment successfully added.'));

                }
                else
                {
                    return redirect()->back()->with('error', __('Transaction has been failed! '));
                }
            }
            catch(\Exception $e)
            {
                return redirect()->back()->with('error', __('Invoice not found!'));
            }
        }
    }
}
