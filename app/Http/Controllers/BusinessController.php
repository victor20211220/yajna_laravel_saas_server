<?php

namespace App\Http\Controllers;

use App\Models\Appointment_deatail;
use App\Models\BusinessCategory;
use App\Models\Campaigns;
use App\Models\CardAppinfo;
use App\Models\CardPayment;
use App\Models\DomainRequest;
use App\Models\Product;

use Illuminate\Support\Facades\Http;
use JeroenDesloovere\VCard\VCard;
use App\Models\Business;
use App\Models\Plan;
use App\Models\Businessfield;
use App\Models\Utility;
use App\Models\business_hours;
use App\Models\appoinment;
use App\Models\service;
use App\Models\social;
use App\Models\User;
use App\Models\ContactInfo;
use App\Models\testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Storage;
use File;
use Illuminate\Validation\Rules;
use App\Models\Gallery;
use App\Models\PixelFields;
use App\Models\Businessqr;
use App\Models\Contacts;
use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (\Auth::user()->can('manage business')) {
            $business = Business::where('created_by', \Auth::user()->creatorId())->orderBy('id', 'DESC');
            if (!empty($request->business)) {
                $business = $business->where('title', 'like', '%' . $request->business . '%');
            }
            if (!empty($request->start_date)) {
                $business->where('created_at', '>=', $request->start_date); // Use greater than or equal for start date
            }
            if (!empty($request->end_date)) {
                $business->where('created_at', '<=', $request->end_date); // Use less than or equal for end date
            }
            $business = $business->get();
            $no = 0;
            foreach ($business as $key => $value) {
                $value->no = $no;
                $no++;
            }

            return view('business.index', compact('business'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = BusinessCategory::get()->pluck('name', 'id');
        $businessfields = Utility::getFields();
        return view('business.create', compact('businessfields', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (\Auth::user()->can('create business')) {
            $max_business = \Auth::user()->getMaxBusiness();
            $count = Business::where('created_by', \Auth::user()->creatorId())->count();

            if ($count < $max_business || $max_business == -1) {
                $validator = \Validator::make(
                    $request->all(),
                    [
                        'business_title' => 'required',
                        'theme' => 'required',
                        'category' => 'required',
                    ]
                );

                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();
                    return redirect()->back()->with('error', $messages->first());
                }

                $slug = Utility::createSlug('businesses', $request->business_title);

                $card_theme = [];
                $card_theme['theme'] = $request->theme;
                $card_theme['order'] = Utility::getDefaultThemeOrder($request->theme);
                $business = Business::create([
                    'title' => $request->business_title,
                    'slug' => $slug,
                    'business_category' => $request->category,
                    'branding_text' => 'Copyright © ' . env('APP_NAME') . ' ' . date("Y"),
                    'card_theme' => json_encode($card_theme),
                    'theme_color' => !empty($request->theme_color) ? $request->theme_color : 'color1-' . $request->theme,
                    'created_by' => \Auth::user()->creatorId()
                ]);
                $business->enable_businesslink = 'on';
                $business->is_branding_enabled = 'on';
                $business->theme = $request->theme;
                $business->save();
                $currentuser = \Auth::user();
                if (is_null($currentuser->current_business)) {
                    $currentuser->current_business = $business->id;
                    $currentuser->save();
                }
                return redirect()->route('business.edit', $business->id)->with('success', __('Business Created Successfully'));
            } else {
                return redirect()->back()->with('error', __('Your user business is over, Please upgrade plan.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Business  $businessphp
     * @return \Illuminate\Http\Response
     */
    public function edit(Business $business, $id)
    {
        $user = \Auth::user();
        $user->current_business = $id;
        $user->save();

        $id = $user->current_business;

        if ($id == 0) {
            $business = Business::where('created_by', \Auth::user()->creatorId())->first();
        } else {
            $business = Business::where('id', $id)->first();
            $count = Business::where('id', $id)->where('created_by', \Auth::user()->creatorId())->count();
            if ($count == 0) {
                return redirect()->route('business.index')->with('error', __('This card number is not yours.'));
            }
        }
        if ($business != NULL) {
            if (json_decode($business->card_theme) == NULL) {
                $card_order = [];
                $card_order['theme'] = $business->card_theme;
                $card_order['order'] = Utility::getDefaultThemeOrder($business->card_theme);
                $business->card_theme = json_encode($card_order);
                $business->save();
            }
            $businessfields = Utility::getFields();

            $appoinment = appoinment::appointmentData($business->id);

            $appoinment_hours = [];

            if (!empty($appoinment->content)) {
                $appoinment_hours = json_decode($appoinment->content);
            }
            $contactinfo = ContactInfo::contactData($business->id);
            $contactinfo_content = [];
            if (!empty($contactinfo->content)) {
                $contactinfo_content = json_decode($contactinfo->content);
            }
            $services = service::serviceData($business->id);
            $services_content = [];
            if (!empty($services->content)) {
                $services_content = json_decode($services->content);
            }
            $testimonials = testimonial::testimonialData($business->id);

            $testimonials_content = [];
            if (!empty($testimonials->content)) {
                $testimonials_content = json_decode($testimonials->content);
            }
            $sociallinks = social::socialData($business->id);
            $social_content = [];
            if (!empty($sociallinks->content)) {
                $social_content = json_decode($sociallinks->content);
            }
            $days = business_hours::$days;
            $businesshours = business_hours::businessHour($business->id);
            $business_hours = [];
            if (!empty($businesshours->content)) {
                $business_hours = json_decode($businesshours->content);
            }

            $customhtml = $business;

            $custom_html = [];
            if (!empty($customhtml->custom_html_text)) {
                $custom_html = json_decode($customhtml->custom_html_text);
            }

            $branding = $business;

            //$branding = [];
            if (!empty($business->branding_text)) {
                $branding = $business->branding_text;
            }

            //Gallery
            $gallery = gallery::galleryData($business->id);
            $gallery_contents = [];
            if (!empty($gallery->content)) {
                $gallery_contents = json_decode($gallery->content);
            }


            $plan = Plan::where('id', $business->id)->first();
            $domainip = '';
            if (!empty($business->enable_domain) && $business->enable_domain == 'on') {
                $serverIp = $_SERVER['SERVER_ADDR'];
                $domain = $business->domains;
                if (isset($domain) && !empty($domain)) {
                    $domainip = gethostbyname($domain);
                }
                if ($serverIp == $domainip) {
                    $domainPointing = 1;
                } else {
                    $domainPointing = 0;
                }
            } else {
                $serverIp = $_SERVER['SERVER_ADDR'];
                $domain = $serverIp;
                $domainip = gethostbyname($domain);
                $domainPointing = 0;
            }

            $serverName = str_replace(
                [
                    'http://',
                    'https://',
                ],
                '',
                env('APP_URL')
            );
            $serverIp = gethostbyname($serverName);

            if ($serverIp != $_SERVER['SERVER_ADDR']) {
                $serverIp;
            } else {
                $serverIp = request()->server('SERVER_ADDR');
            }

            $plan = Plan::where('id', $user->plan)->first();
            $app_url = trim(env('APP_URL'), '/');
            $business_url = $app_url . '/' . $business['slug'];


            if (!empty($business->enable_subdomain) && $business->enable_subdomain == 'on') {
                // Remove the http://, www., and slash(/) from the URL
                $input = env('APP_URL');

                // If URI is like, eg. www.way2tutorial.com/
                $input = trim($input, '/');
                // If not have http:// or https:// then prepend it
                if (!preg_match('#^http(s)?://#', $input)) {
                    $input = 'http://' . $input;
                }

                $urlParts = parse_url($input);

                // Remove www.
                $subdomain_name = preg_replace('/^www\./', '', $urlParts['host']);
                // Output way2tutorial.com
                $subdomain_Ip = gethostbyname($urlParts['host']);
                if ($serverIp == $subdomain_Ip) {
                    $subdomainPointing = 1;
                } else {
                    $subdomainPointing = 0;
                }
            } else {
                $input = env('APP_URL');

                // If URI is like, eg. www.way2tutorial.com/
                $input = trim($input, '/');
                // If not have http:// or https:// then prepend it
                if (!preg_match('#^http(s)?://#', $input)) {
                    $input = 'http://' . $input;
                }

                $urlParts = parse_url($input);
                $subdomain_Ip = $urlParts['host'];
                $subdomainPointing = 0;
                $subdomain_name = str_replace(
                    [
                        'http://',
                        'https://',
                    ],
                    '',
                    env('APP_URL')
                );
            }

            try {
                $pwa_data = \File::get(storage_path('uploads/theme_app/business_' . $business->id . '/manifest.json'));
                $pwa_data = json_decode($pwa_data);
            } catch (\Throwable $th) {
                $pwa_data = '';
            }

            // $PixelFields = PixelFields::where('business_id', $id)->get();
            $PixelFields = PixelFields::where('business_id', $business->id)->get();
            $pixelScript = [];
            foreach ($PixelFields as $pixel) {

                if (!$pixel->disabled) {
                    $pixelScript[] = pixelSourceCode($pixel['platform'], $pixel['pixel_id']);
                }
            }

            // Cookie Data
            $cookieDetail = [];
            $filename = '';
            //$cookieData = Business::where('slug', '=', $business->slug)->first();

            $filename = $business->slug . '.csv';
            $cookieDetail = json_decode($business->gdpr_text);

            $qr_code = Business::$qr_type;
            $qr_detail = Businessqr::where('business_id', $id)->first();
            $products = Product::productData($business->id);
            $products_content = [];
            if (!empty($products->content)) {
                $products_content = json_decode($products->content);
            }
            $cardPayment = CardPayment::cardPaymentData($business->id);
            $cardPayment_content = [];
            if (!empty($cardPayment->content)) {
                $cardPayment_content = json_decode($cardPayment->content);
            }
            $appInfo = CardAppinfo::cardAppData($business->id);

            $currencyData = Utility::getCurrency();
            $category = BusinessCategory::get()->pluck('name', 'id');
            $tab = 1;

            //
            $social_nos = 1;
            $appointment_no = 0;
            $appointment_nos = 0;
            $service_row_nos = 0;
            $product_row_nos = 0;
            $testimonials_row_nos = 0;
            $gallery_row_no = 0;

            $nos = 1;
            $stringid = $business->id;
            $is_enable = false;
            $is_enabled = false;
            $is_contact_enable = false;
            $is_enable_appoinment = false;
            $is_enable_service = false;
            $is_enable_product = false;
            $is_enable_testimonials = false;
            $is_enable_sociallinks = false;
            $is_custom_html_enable = false;
            $is_google_map_enabled = false;
            $is_enable_gallery = false;
            $is_payment = false;
            $is_appinfo = false;
            $custom_html = $business->custom_html_text;
            $is_branding_enabled = false;
            $branding = $business->branding_text;
            $is_gdpr_enabled = false;
            $gdpr_text = $business->gdpr_text;
            $card_theme = json_decode($business->card_theme);

            $banner = \App\Models\Utility::get_file('card_banner');
            $logo = \App\Models\Utility::get_file('card_logo');
            $image = \App\Models\Utility::get_file('testimonials_images');
            $s_image = \App\Models\Utility::get_file('service_images');
            $pr_image = \App\Models\Utility::get_file('product_images');

            $company_favicon = \App\Models\Utility::getsettingsbyid($business->created_by);
            $company_favicon = $company_favicon['company_favicon'];
            $logo1 = \App\Models\Utility::get_file('uploads/logo/');

            $meta_image = \App\Models\Utility::get_file('meta_image');
            $gallery_path = \App\Models\Utility::get_file('gallery');
            $qr_path = \App\Models\Utility::get_file('qrcode');

            $theme = $business->theme;
            $color = substr($business->theme_color, 0, 6);
            $svg_text = \App\Models\Utility::get_file('svg');
            $url_link = env('APP_URL') . '/' . $business->slug;
            $meta_tag_image = $meta_image . '/' . $business->meta_image;

            if (!is_null($contactinfo) && !is_null($contactinfo)) {
                $contactinfo['is_enabled'] == '1' ? ($is_contact_enable = true) : ($is_contact_enable = false);
            }
            if (!is_null($custom_html) && !is_null($customhtml)) {
                $customhtml->is_custom_html_enabled == '1' ? ($is_custom_html_enable = true) : ($is_custom_html_enable = false);
            }
            if (!is_null($business->is_branding_enabled) && !is_null($business->is_branding_enabled)) {
                !empty($business->is_branding_enabled) && $business->is_branding_enabled == 'on'
                    ? ($is_branding_enabled = true)
                    : ($is_branding_enabled = false);
            } else {
                $is_branding_enabled = false;
            }
            if (!is_null($business->is_gdpr_enabled) && !is_null($business->is_gdpr_enabled)) {
                !empty($business->is_gdpr_enabled) && $business->is_gdpr_enabled == 'on'
                    ? ($is_gdpr_enabled = true)
                    : ($is_gdpr_enabled = false);
            }
            if (!is_null($appInfo)) {
                $appInfo['is_enabled'] == '1' ? ($is_appinfo = true) : ($is_appinfo = false);
            }
            if (!is_null($business) && !is_null($business)) {
                $business->is_svg_enabled == '1' ? ($is_svg_enabled = true) : ($is_svg_enabled = false);
            }
            if (!is_null($social_content) && !is_null($sociallinks)) {
                $sociallinks['is_enabled'] == '1' ? ($is_enable_sociallinks = true) : ($is_enable_sociallinks = false);
            }
            if (!is_null($business) && !is_null($business)) {
                $business->is_google_map_enabled == '1' ? ($is_google_map_enabled = true) : ($is_google_map_enabled = false);
            }
            if (!is_null($cardPayment) && !is_null($cardPayment)) {
                $cardPayment->is_enabled == '1' ? ($is_enabled = true) : ($is_enabled = false);
            }

            $themeName = \App\Models\Utility::themeOne()[$theme][$business->theme_color]['theme_name'] ?? null;

            return view('business.edit', compact('category', 'businessfields', 'currencyData', 'appoinment_hours', 'contactinfo', 'contactinfo_content', 'appoinment', 'services_content', 'services', 'testimonials_content', 'testimonials', 'social_content', 'sociallinks', 'businesshours', 'business_hours', 'business', 'custom_html', 'customhtml', 'branding', 'branding', 'days', 'id', 'business_url', 'serverIp', 'subdomain_name', 'plan', 'pwa_data', 'gallery_contents', 'gallery', 'PixelFields', 'pixelScript', 'cookieDetail', 'filename', 'qr_code', 'qr_detail', 'subdomain_Ip', 'subdomainPointing', 'domainip', 'domainPointing', 'products', 'products_content', 'cardPayment', 'cardPayment_content', 'appInfo', 'social_nos', 'appointment_no', 'service_row_nos', 'product_row_nos', 'testimonials_row_nos', 'gallery_row_no', 'nos', 'stringid', 'custom_html', 'branding', 'is_branding_enabled', 'gdpr_text', 'card_theme', 'banner', 'logo', 'image', 's_image', 'pr_image', 'company_favicon', 'logo1', 'meta_image', 'gallery_path', 'qr_path', 'theme', 'color', 'url_link', 'is_custom_html_enable', 'is_gdpr_enabled', 'is_appinfo', 'is_svg_enabled', 'svg_text','is_enable_sociallinks','appointment_nos','meta_tag_image','is_enable','is_google_map_enabled','is_enabled','themeName'))->with('tab', $tab);
        } else {

            return abort('404', 'Not Found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Business $business)
    {
        if (\Auth::user()->can('edit business')) {
            if (!is_null($business)) {
                $count = Business::where('id', $business->id)->where('created_by', \Auth::user()->creatorId())->count();
                if ($count == 0) {
                    return redirect()->route('business.index')->with('error', __('This card number is not yours.'));
                }
                if (is_null($business->banner) || is_null($business->logo)) {
                    $validator = \Validator::make(
                        $request->all(),
                        [
                            'banner' => 'required',
                            'logo' => 'required',
                        ]
                    );
                    if ($validator->fails()) {
                        $messages = $validator->getMessageBag();

                        return redirect()->back()->with('error', $messages->first());
                    }
                }


                $count = Business::where('slug', $request->slug)->count();
                if (!is_null($business)) {
                    if ($count == 0) {
                        $business->slug = $request->slug;
                    } elseif ($count == 1) {
                        if ($business->slug != $request->slug) {
                            return redirect()->route('business.index')->with('error', __('Slug is already used.........!'));
                        }

                    }
                }
                $business->title = $request->title;
                $business->sub_title = $request->sub_title;
                $business->description = $request->description;

                if ($request->hasFile('logo')) {
                    $logoname = $business['logo'] ? $business['logo'] : '';

                    $image_path = 'card_logo/' . $logoname;

                    $image_size = $request->file('logo')->getSize();
                    $result = Utility::updateStorageLimit(\Auth::user()->creatorId(), $image_size);
                    if ($result == 1) {
                        $result = Utility::changeStorageLimit(\Auth::user()->creatorId(), $image_path);
                        $settings = Utility::getStorageSetting();
                        $logo = $request->file('logo');
                        $ext = $logo->getClientOriginalExtension();
                        $fileName = 'logo_' . time() . rand() . '.' . $ext;

                        $business->logo = $fileName;
                        if ($settings['storage_setting'] == 'local') {
                            $dir = 'card_logo/';
                        } else {
                            $dir = 'card_logo/';

                        }
                        $image_path = $dir . $business['logo'];
                        if (File::exists($image_path)) {
                            File::delete($image_path);
                        }
                        $path = Utility::upload_file($request, 'logo', $fileName, $dir, []);

                        if ($path['flag'] == 1) {
                            $url = $path['url'];
                        } else {
                            return redirect()->route('business.index', \Auth::user()->id)->with('error', __($path['msg']));
                        }
                    }
                }

                if ($request->hasFile('banner')) {
                    $bannername = $business['banner'] ? $business['banner'] : '';
                    $image_path1 = 'card_banner/' . $bannername;
                    $image_size = $request->file('banner')->getSize();
                    $result = Utility::updateStorageLimit(\Auth::user()->creatorId(), $image_size);

                    if ($result == 1) {
                        $result = Utility::changeStorageLimit(\Auth::user()->creatorId(), $image_path1);

                        $settings = Utility::getStorageSetting();
                        $banner = $request->file('banner');
                        $ext = $banner->getClientOriginalExtension();
                        $fileName = 'banner' . time() . rand() . '.' . $ext;

                        $business->banner = $fileName;


                        if ($settings['storage_setting'] == 'local') {
                            $dir = 'card_banner/';
                        } else {
                            $dir = 'card_banner/';

                        }
                        $image_path = $dir . $business['banner'];
                        if (File::exists($image_path)) {
                            File::delete($image_path);
                        }
                        $path = Utility::upload_file($request, 'banner', $fileName, $dir, []);

                        if ($path['flag'] == 1) {
                            $url = $path['url'];
                        } else {
                            return redirect()->route('business.index', \Auth::user()->id)->with('error', __($path['msg']));
                        }
                    }
                }
                $business_id = $request->business_id;


                if ($request->is_business_hours_enabled == "on") {
                    $requestAll = $request->all();
                    $days = business_hours::$days;
                    $business_hours = [];



                    foreach ($days as $k => $day) {
                        $time['days'] = isset($requestAll['days_' . $k]) ? 'on' : 'off';
                        $time['start_time'] = $requestAll['start-' . $k];
                        $time['end_time'] = $requestAll['end-' . $k];
                        $business_hours[$k] = $time;
                    }
                    $business_hours = json_encode($business_hours);
                    $businessHours = business_hours::where('business_id', $business_id)->first();
                    if (!is_null($businessHours)) {
                        $businessHours->content = $business_hours;
                        $businessHours->is_enabled = '1';
                        $businessHours->created_by = \Auth::user()->creatorId();
                        $businessHours->save();
                    } else {
                        business_hours::create([
                            'business_id' => $business_id,
                            'content' => $business_hours,
                            'is_enabled' => '1',
                            'created_by' => \Auth::user()->creatorId()
                        ]);
                    }
                } else {
                    $businessHours = business_hours::where('business_id', $business_id)->first();
                    if (!is_null($businessHours)) {
                        $businessHours->is_enabled = '0';
                        $businessHours->created_by = \Auth::user()->creatorId();
                        $businessHours->save();
                    } else {
                        business_hours::create([
                            'business_id' => $business_id,
                            'is_enabled' => '0',
                            'created_by' => \Auth::user()->creatorId()
                        ]);
                    }
                }

                if ($request->is_appoinment_enabled == "on") {

                    $app_hours = $request->hours;

                    $appointment_count = 1;
                    $appoinment_hours = [];
                    $hours = [];
                    if (!empty($app_hours)) {
                        foreach ($app_hours as $business_hours_key => $business_hours_val) {
                            $hours['id'] = $appointment_count;
                            $hours['start'] = $business_hours_val['start'];
                            $hours['end'] = $business_hours_val['end'];
                            $appoinment_hours[$business_hours_key] = $hours;
                            $appointment_count++;
                        }
                        $appoinment_hours = json_encode($appoinment_hours);
                        $appoinment = appoinment::where('business_id', $business_id)->first();
                        if (!is_null($appoinment)) {
                            $appoinment->content = $appoinment_hours;
                            $appoinment->is_enabled = '1';
                            $appoinment->created_by = \Auth::user()->creatorId();
                            $appoinment->save();
                        } else {
                            appoinment::create([
                                'business_id' => $business_id,
                                'content' => $appoinment_hours,
                                'is_enabled' => '1',
                                'created_by' => \Auth::user()->creatorId()
                            ]);
                        }

                    } else {
                        $appoinment_hours = json_encode($appoinment_hours);
                        $appoinment = appoinment::where('business_id', $business_id)->first();
                        if (!is_null($appoinment)) {
                            $appoinment->content = $appoinment_hours;
                            $appoinment->is_enabled = '1';
                            $appoinment->created_by = \Auth::user()->creatorId();
                            $appoinment->save();
                        } else {
                            appoinment::create([
                                'business_id' => $business_id,
                                'content' => $appoinment_hours,
                                'is_enabled' => '1',
                                'created_by' => \Auth::user()->creatorId()
                            ]);
                        }

                    }
                } else {
                    $appoinment = appoinment::where('business_id', $business_id)->first();
                    if (!is_null($appoinment)) {
                        $appoinment->is_enabled = '0';
                        $appoinment->created_by = \Auth::user()->creatorId();
                        $appoinment->save();
                    } else {
                        appoinment::create([
                            'business_id' => $business_id,
                            'is_enabled' => '0',
                            'created_by' => \Auth::user()->creatorId()
                        ]);
                    }
                }

                if ($request->is_services_enabled == "on") {
                    $servicedetails = $request->services;
                    $service_count = 1;
                    $service_details = [];
                    $details = [];

                    if (!empty($servicedetails)) {
                        foreach ($servicedetails as $service_key => $service_val) {

                            $images = $request->file('services');
                            $details['id'] = $service_count;
                            $details['title'] = $service_val['title'];
                            $details['description'] = $service_val['description'];
                            $details['purchase_link'] = $service_val['purchase_link'];
                            $details['link_title'] = $service_val['link_title'];

                            if (isset($images[$service_key])) {

                                foreach ($images as $filekey => $file) {
                                    $image_name = isset($service_val['get_image']) ? $service_val['get_image'] : '';
                                    $image_path = 'service_images/' . $image_name;

                                    $file_size = $file['image']->getSize();
                                    $result = Utility::updateStorageLimit(\Auth::user()->creatorId(), $file_size);
                                    if ($result == 1) {

                                        $result = Utility::changeStorageLimit(\Auth::user()->creatorId(), $image_path);

                                        $settings = Utility::getStorageSetting();
                                        $img_ext = $images[$service_key]['image']->getClientOriginalExtension();
                                        $img_fileName = 'img_' . time() . rand() . '.' . $img_ext;


                                        $details['image'] = $img_fileName;
                                        if ($settings['storage_setting'] == 'local') {
                                            $dir = 'service_images/';
                                        } else {
                                            $dir = 'service_images/';

                                        }
                                        $image_path = $dir . $details['image'];
                                        if (File::exists($image_path)) {
                                            File::delete($image_path);
                                        }


                                        $path = Utility::keyWiseUpload_file($request, 'image', $img_fileName, $dir, 'services', $service_key, []);
                                        if ($path['flag'] == 1) {
                                            $url = $path['url'];
                                        } else {
                                            return redirect()->route('business.index', \Auth::user()->id)->with('error', __($path['msg']));
                                        }
                                    } else {
                                        if (isset($service_val['get_image']) && !is_null($service_val['get_image'])) {
                                            $details['image'] = $service_val['get_image'];
                                        } else {
                                            $details['image'] = "";
                                        }
                                    }
                                }

                            } else {

                                if (isset($service_val['get_image']) && !is_null($service_val['get_image'])) {
                                    $details['image'] = $service_val['get_image'];
                                } else {
                                    $details['image'] = "";
                                }
                            }

                            $service_details[$service_key] = $details;
                            $service_count++;

                        }
                        $service_details = json_encode($service_details);


                        $services_data = service::where('business_id', $business_id)->first();
                        if (!is_null($services_data)) {

                            if ($service_details != 'null') {
                                $services_data->content = $service_details;
                                $services_data->is_enabled = '1';
                                $services_data->created_by = \Auth::user()->creatorId();
                                $services_data->save();
                            } else {
                                // $services_data->content = $service_details;
                                $services_data->is_enabled = '1';
                                $services_data->created_by = \Auth::user()->creatorId();
                                $services_data->save();
                            }
                        } else {
                            service::create([
                                'business_id' => $business_id,
                                'content' => $service_details,
                                'is_enabled' => '1',
                                'created_by' => \Auth::user()->creatorId()
                            ]);
                        }
                    } else {
                        $service_details = json_encode($service_details);
                        $services_data = service::where('business_id', $business_id)->first();
                        if (!is_null($services_data)) {

                            if ($service_details != 'null') {
                                $services_data->content = $service_details;
                                $services_data->is_enabled = '1';
                                $services_data->created_by = \Auth::user()->creatorId();
                                $services_data->save();
                            } else {
                                // $services_data->content = $service_details;
                                $services_data->is_enabled = '1';
                                $services_data->created_by = \Auth::user()->creatorId();
                                $services_data->save();
                            }
                        } else {
                            service::create([
                                'business_id' => $business_id,
                                'content' => $service_details,
                                'is_enabled' => '1',
                                'created_by' => \Auth::user()->creatorId()
                            ]);
                        }
                    }
                } else {
                    $services_data = service::where('business_id', $business_id)->first();
                    if (!is_null($services_data)) {
                        $services_data->is_enabled = '0';
                        $services_data->created_by = \Auth::user()->creatorId();
                        $services_data->save();
                    } else {
                        service::create([
                            'business_id' => $business_id,
                            'is_enabled' => '0',
                            'created_by' => \Auth::user()->creatorId()
                        ]);
                    }
                }

                if ($request->is_testimonials_enabled == "on") {

                    $testimonialsdetails = $request->testimonials;
                    $testimonials_count = 1;
                    $testimonials_details = [];
                    $testi_details = [];

                    if (!empty($testimonialsdetails)) {
                        foreach ($testimonialsdetails as $testimonials_key => $testimonials_val) {
                            $testimonials_images = $request->file('testimonials');
                            $testi_details['id'] = $testimonials_count;
                            if (isset($testimonials_val['rating'])) {
                                $testi_details['rating'] = $testimonials_val['rating'];
                            } else {
                                $testi_details['rating'] = "0";
                            }
                            if (isset($testimonials_val['name']) && $testimonials_val['name'] != 'null') {
                                $testi_details['name'] = $testimonials_val['name'];
                            } else {
                                $testi_details['name'] = '';
                            }
                            if (isset($testimonials_val['description']) && $testimonials_val['description'] != 'null') {
                                $testi_details['description'] = $testimonials_val['description'];
                            } else {
                                $testi_details['description'] = '';
                            }

                            if (isset($testimonials_images[$testimonials_key])) {
                                foreach ($testimonials_images as $filekey => $file) {
                                    $image_name = isset($testimonials_val['get_image']) ? $testimonials_val['get_image'] : '';
                                    $image_path = 'testimonials_images/' . $image_name;

                                    $file_size = $file['image']->getSize();
                                    $result = Utility::updateStorageLimit(\Auth::user()->creatorId(), $file_size);
                                    if ($result == 1) {
                                        $result = Utility::changeStorageLimit(\Auth::user()->creatorId(), $image_path);
                                        $settings = Utility::getStorageSetting();
                                        $testimonials_img_ext = $testimonials_images[$testimonials_key]['image']->getClientOriginalExtension();

                                        $testimonials_img_fileName = 'img_' . time() . rand() . '.' . $testimonials_img_ext;
                                        //$testimonials_images[$testimonials_key]['image'] = $testimonials_img_fileName;

                                        $dir = 'testimonials_images/';
                                        $testi_details['image'] = $testimonials_img_fileName;
                                        $image_path = $dir . $testimonials_images[$testimonials_key]['image'];

                                        if (File::exists($image_path)) {
                                            File::delete($image_path);
                                        }

                                        $path = Utility::keyWiseUpload_file($request, 'image', $testimonials_img_fileName, $dir, 'testimonials', $testimonials_key, []);
                                        if ($path['flag'] == 1) {
                                            $url = $path['url'];
                                        } else {
                                            return redirect()->route('business.index', \Auth::user()->id)->with('error', __($path['msg']));
                                        }
                                    } else {
                                        if (isset($testimonials_val['get_image']) && !is_null($testimonials_val['get_image'])) {
                                            $testi_details['image'] = $testimonials_val['get_image'];
                                        } else {
                                            $testi_details['image'] = '';

                                        }
                                    }

                                }

                            } else {
                                if (isset($testimonials_val['get_image']) && !is_null($testimonials_val['get_image'])) {
                                    $testi_details['image'] = $testimonials_val['get_image'];
                                } else {
                                    $testi_details['image'] = '';

                                }
                            }

                            $testimonials_details[$testimonials_key] = $testi_details;
                            $testimonials_count++;
                        }


                        $testimonials_details = json_encode($testimonials_details);

                        $testimonials_data = testimonial::where('business_id', $business_id)->first();
                        if (!is_null($testimonials_data)) {
                            if ($testimonials_details != 'null') {
                                $testimonials_data->content = $testimonials_details;
                                $testimonials_data->is_enabled = '1';
                                $testimonials_data->created_by = \Auth::user()->creatorId();
                                $testimonials_data->save();
                            } else {
                                $testimonials_data->is_enabled = '1';
                                $testimonials_data->created_by = \Auth::user()->creatorId();
                                $testimonials_data->save();
                            }
                        } else {
                            testimonial::create([
                                'business_id' => $business_id,
                                'content' => $testimonials_details,
                                'is_enabled' => '1',
                                'created_by' => \Auth::user()->creatorId()
                            ]);
                        }
                    } else {
                        $testimonials_details = json_encode($testimonials_details);

                        $testimonials_data = testimonial::where('business_id', $business_id)->first();
                        if (!is_null($testimonials_data)) {
                            if ($testimonials_details != 'null') {
                                $testimonials_data->content = $testimonials_details;
                                $testimonials_data->is_enabled = '1';
                                $testimonials_data->created_by = \Auth::user()->creatorId();
                                $testimonials_data->save();
                            } else {
                                $testimonials_data->is_enabled = '1';
                                $testimonials_data->created_by = \Auth::user()->creatorId();
                                $testimonials_data->save();
                            }
                        } else {
                            testimonial::create([
                                'business_id' => $business_id,
                                'content' => $testimonials_details,
                                'is_enabled' => '1',
                                'created_by' => \Auth::user()->creatorId()
                            ]);
                        }
                    }


                } else {
                    $testimonials_data = testimonial::where('business_id', $business_id)->first();
                    if (!is_null($testimonials_data)) {
                        $testimonials_data->is_enabled = '0';
                        $testimonials_data->created_by = \Auth::user()->creatorId();
                        $testimonials_data->save();
                    } else {
                        testimonial::create([
                            'business_id' => $business_id,
                            'is_enabled' => '0',
                            'created_by' => \Auth::user()->creatorId()
                        ]);
                    }
                }

                if ($request->is_socials_enabled == "on") {

                    $sociallinks_content = json_encode($request->socials);
                    $sociallinks = social::where('business_id', $business_id)->first();


                    if (!is_null($sociallinks)) {

                        if ($sociallinks_content != 'null') {
                            $sociallinks->content = $sociallinks_content;
                            $sociallinks->is_enabled = '1';
                            $sociallinks->created_by = \Auth::user()->creatorId();
                            $sociallinks->save();
                        } else {

                            $sociallinks->content = $sociallinks_content;
                            $sociallinks->is_enabled = '1';
                            $sociallinks->created_by = \Auth::user()->creatorId();
                            $sociallinks->save();
                        }

                    } else {
                        if ($sociallinks_content != 'null') {
                            social::create([
                                'business_id' => $business_id,
                                'content' => $sociallinks_content,
                                'is_enabled' => '1',
                                'created_by' => \Auth::user()->creatorId()
                            ]);
                        }
                    }
                } else {
                    $sociallinks = social::where('business_id', $business_id)->first();
                    if (!is_null($sociallinks)) {
                        $sociallinks->is_enabled = '0';
                        $sociallinks->created_by = \Auth::user()->creatorId();
                        $sociallinks->save();
                    } else {

                        social::create([
                            'business_id' => $business_id,
                            'is_enabled' => '0',
                            'created_by' => \Auth::user()->creatorId()
                        ]);
                    }
                }

                if ($request->is_contacts_enabled == "on") {


                    $contacts_content = json_encode($request->contact);

                    $contactsinfo = ContactInfo::where('business_id', $business_id)->first();
                    if (!is_null($contactsinfo)) {
                        if ($contacts_content != 'null') {
                            $contactsinfo->content = $contacts_content;
                            $contactsinfo->is_enabled = '1';
                            $contactsinfo->created_by = \Auth::user()->creatorId();
                            $contactsinfo->save();

                        } else {
                            $contactsinfo->content = $contacts_content;
                            $contactsinfo->is_enabled = '1';
                            $contactsinfo->created_by = \Auth::user()->creatorId();
                            $contactsinfo->save();
                        }

                    } else {

                        ContactInfo::create([
                            'business_id' => $business_id,
                            'content' => $contacts_content,
                            'is_enabled' => '1',
                            'created_by' => \Auth::user()->creatorId()
                        ]);
                    }
                } else {
                    $contactsinfo = ContactInfo::where('business_id', $business_id)->first();
                    if (!is_null($contactsinfo)) {
                        $contactsinfo->is_enabled = '0';
                        $contactsinfo->created_by = \Auth::user()->creatorId();
                        $contactsinfo->save();
                    } else {
                        ContactInfo::create([
                            'business_id' => $business_id,
                            'is_enabled' => '0',
                            'created_by' => \Auth::user()->creatorId()
                        ]);
                    }
                }

                if ($request->is_custom_html_enabled == "on") {
                    $custom_html = str_replace(array("\r\n"), "", $request->custom_html_text);
                    $custom_html_text = Business::where('id', $business_id)->first();
                    if (!is_null($custom_html_text)) {

                        $custom_html_text->custom_html_text = $custom_html;
                        $custom_html_text->is_custom_html_enabled = '1';
                        $custom_html_text->created_by = \Auth::user()->creatorId();
                        $custom_html_text->save();

                    } else {
                        Business::create([
                            'id' => $business_id,
                            'customhtml' => $custom_html,
                            'is_enabled' => '1',
                            'created_by' => \Auth::user()->creatorId()
                        ]);
                    }
                } else {
                    $custom_html = str_replace(array("\r\n"), "", $request->custom_html_text);
                    $custom_html_text = Business::where('id', $business_id)->first();
                    if (!is_null($custom_html_text)) {

                        $custom_html_text->custom_html_text = $custom_html;
                        $custom_html_text->is_custom_html_enabled = '0';
                        $custom_html_text->created_by = \Auth::user()->creatorId();
                        $custom_html_text->save();

                    } else {
                        Business::create([
                            'id' => $business_id,
                            'customhtml' => $custom_html,
                            'is_enabled' => '0',
                            'created_by' => \Auth::user()->creatorId()
                        ]);
                    }
                }

                //Gallary
                if ($request->is_gallery_enabled == "on") {
                    $gallery_data = explode(",", $request->galary_data); //pass when data is not empty

                    $fileName = '';
                    $details = [];
                    $gallery_details = [];
                    $gallery_content = [];
                    $image_data = '';

                    $galleryinfo = Gallery::where('business_id', $business_id)->first();
                    if (!empty($galleryinfo->content)) {
                        $gallery_content = (array) json_decode($galleryinfo->content);
                        foreach ($gallery_content as $key => $data) {
                            $image_data = $data->value;
                        }
                    }
                    if ($request->upload_video) {
                        if ($request->hasFile('upload_video')) {

                            $image_size_video = $request->file('upload_video')->getSize();
                            $result = Utility::updateStorageLimit(\Auth::user()->creatorId(), $image_size_video);

                            if ($result == 1) {
                                $settings = Utility::getStorageSetting();
                                $video = $request->file('upload_video');
                                $ext = $video->getClientOriginalExtension();
                                $fileName = 'video_' . time() . rand() . '.' . $ext;

                                if ($settings['storage_setting'] == 'local') {
                                    $dir = 'gallery/';
                                } else {
                                    $dir = 'gallery/';

                                }
                                $image_path = $dir . $image_data;
                                if (File::exists($image_path)) {
                                    File::delete($image_path);
                                }

                                $path = Utility::upload_file($request, 'upload_video', $fileName, $dir, []);

                                if ($path['flag'] == 1) {
                                    $url = $path['url'];
                                } else {
                                    return redirect()->route('business.index', \Auth::user()->id)->with('error', __($path['msg']));
                                }
                            }
                        }
                    }
                    if ($request->upload_image) {
                        if ($request->hasFile('upload_image')) {

                            $image_size_img = $request->file('upload_image')->getSize();
                            $result = Utility::updateStorageLimit(\Auth::user()->creatorId(), $image_size_img);

                            if ($result == 1) {
                                $settings = Utility::getStorageSetting();
                                $images = $request->file('upload_image');
                                $ext = $images->getClientOriginalExtension();
                                $fileName = 'image_' . time() . rand() . '.' . $ext;
                                // $business->logo = $fileName;
                                if ($settings['storage_setting'] == 'local') {
                                    $dir = 'gallery/';
                                } else {
                                    $dir = 'gallery/';

                                }
                                $image_path = $dir . $image_data;
                                if (File::exists($image_path)) {
                                    File::delete($image_path);
                                }
                                $path = Utility::upload_file($request, 'upload_image', $fileName, $dir, []);

                                if ($path['flag'] == 1) {
                                    $url = $path['url'];
                                } else {
                                    return redirect()->route('business.index', \Auth::user()->id)->with('error', __($path['msg']));
                                }
                            } else {

                            }
                        }
                    }


                    if ($request->galleryoption == 'custom_image_link') {
                        $fileName = $request->custom_image_link;
                    }

                    if ($request->galleryoption == 'custom_video_link') {
                        $fileName = $request->custom_video_link;
                    }

                    if ($request->galleryoption != null && $fileName != '') {

                        $details['id'] = $request->gallery_count;
                        $details['type'] = $request->galleryoption;
                        $details['value'] = $fileName;
                        $gallery_details = (object) $details;
                        $gallery_content[] = $gallery_details;
                    }


                    $gallery_contents = [];
                    foreach ($gallery_content as $key => $value) {
                        $gallery_contents[] = [
                            'id' => $key,
                            'type' => $value->type,
                            'value' => $value->value,
                        ];
                    }
                    if (!is_null($galleryinfo)) {
                        if ($gallery_details != 'null') {
                            $galleryinfo->content = json_encode($gallery_contents);
                            $galleryinfo->is_enabled = '1';
                            $galleryinfo->created_by = \Auth::user()->creatorId();
                            $galleryinfo->save();

                        } else {
                            $galleryinfo->content = $gallery_details;
                            $galleryinfo->is_enabled = '1';
                            $galleryinfo->created_by = \Auth::user()->creatorId();
                            $galleryinfo->save();
                        }

                    } else {

                        Gallery::create([
                            'business_id' => $business_id,
                            'content' => json_encode($gallery_contents),
                            'is_enabled' => '1',
                            'created_by' => \Auth::user()->creatorId()
                        ]);
                    }


                } else {

                    $gallery_info = Gallery::where('business_id', $business_id)->first();
                    if (!is_null($gallery_info)) {
                        $gallery_info->is_enabled = '0';
                        $gallery_info->created_by = \Auth::user()->creatorId();
                        $gallery_info->save();
                    } else {
                        Gallery::create([
                            'business_id' => $business_id,
                            'is_enabled' => '0',
                            'created_by' => \Auth::user()->creatorId()
                        ]);
                    }
                }

                //Product
                if ($request->is_product_enabled == "on") {
                    $productdetails = $request->product;
                    $product_count = 1;
                    $product_details = [];
                    $prdetails = [];
                    if (!empty($productdetails)) {
                        foreach ($productdetails as $product_key => $product_val) {

                            $pr_images = $request->file('product');
                            $prdetails['id'] = $product_count;
                            $prdetails['title'] = $product_val['title'];
                            $prdetails['description'] = $product_val['description'];
                            $prdetails['price'] = $product_val['price'];
                            $prdetails['purchase_link'] = $product_val['purchase_link'];
                            $prdetails['link_title'] = $product_val['link_title'];
                            $prdetails['currency'] = $product_val['currency'];

                            if (isset($pr_images[$product_key])) {

                                foreach ($pr_images as $filekey => $file) {
                                    $image_name = isset($product_val['get_image']) ? $product_val['get_image'] : '';
                                    $image_path = 'product_images/' . $image_name;

                                    $file_size = $file['image']->getSize();
                                    $result = Utility::updateStorageLimit(\Auth::user()->creatorId(), $file_size);
                                    if ($result == 1) {

                                        $result = Utility::changeStorageLimit(\Auth::user()->creatorId(), $image_path);

                                        $settings = Utility::getStorageSetting();
                                        $img_ext = $pr_images[$product_key]['image']->getClientOriginalExtension();
                                        $img_fileName = 'img_' . time() . rand() . '.' . $img_ext;


                                        $prdetails['image'] = $img_fileName;
                                        if ($settings['storage_setting'] == 'local') {
                                            $dir = 'product_images/';
                                        } else {
                                            $dir = 'product_images/';

                                        }
                                        $image_path = $dir . $prdetails['image'];
                                        if (File::exists($image_path)) {
                                            File::delete($image_path);
                                        }


                                        $path = Utility::keyWiseUpload_file($request, 'image', $img_fileName, $dir, 'product', $product_key, []);
                                        if ($path['flag'] == 1) {
                                            $url = $path['url'];
                                        } else {
                                            return redirect()->route('business.index', \Auth::user()->id)->with('error', __($path['msg']));
                                        }
                                    } else {
                                        if (isset($product_val['get_image']) && !is_null($product_val['get_image'])) {
                                            $prdetails['image'] = $product_val['get_image'];
                                        } else {
                                            $prdetails['image'] = "";
                                        }
                                    }
                                }

                            } else {

                                if (isset($product_val['get_image']) && !is_null($product_val['get_image'])) {
                                    $prdetails['image'] = $product_val['get_image'];
                                } else {
                                    $prdetails['image'] = "";
                                }
                            }

                            $product_details[$product_key] = $prdetails;
                            $product_count++;

                        }
                        $product_details = json_encode($product_details);

                        $product_data = Product::where('business_id', $business_id)->first();
                        if (!is_null($product_data)) {

                            if ($product_details != 'null') {
                                $product_data->content = $product_details;
                                $product_data->is_enabled = '1';
                                $product_data->created_by = \Auth::user()->creatorId();
                                $product_data->save();
                            } else {
                                $product_data->is_enabled = '1';
                                $product_data->created_by = \Auth::user()->creatorId();
                                $product_data->save();
                            }
                        } else {
                            Product::create([
                                'business_id' => $business_id,
                                'content' => $product_details,
                                'is_enabled' => '1',
                                'created_by' => \Auth::user()->creatorId()
                            ]);
                        }
                    } else {
                        $product_details = json_encode($product_details);
                        $product_data = Product::where('business_id', $business_id)->first();
                        if (!is_null($product_data)) {

                            if ($product_details != 'null') {
                                $product_data->content = $product_details;
                                $product_data->is_enabled = '1';
                                $product_data->created_by = \Auth::user()->creatorId();
                                $product_data->save();
                            } else {
                                $product_data->is_enabled = '1';
                                $product_data->created_by = \Auth::user()->creatorId();
                                $product_data->save();
                            }
                        } else {
                            Product::create([
                                'business_id' => $business_id,
                                'content' => $product_details,
                                'is_enabled' => '1',
                                'created_by' => \Auth::user()->creatorId()
                            ]);
                        }
                    }
                } else {
                    $product_data = Product::where('business_id', $business_id)->first();
                    if (!is_null($product_data)) {
                        $product_data->is_enabled = '0';
                        $product_data->created_by = \Auth::user()->creatorId();
                        $product_data->save();
                    } else {
                        Product::create([
                            'business_id' => $business_id,
                            'is_enabled' => '0',
                            'created_by' => \Auth::user()->creatorId()
                        ]);
                    }
                }
                if ($request->is_google_map_enabled == "on") {
                    $request->validate([
                        'google_map_link' => ['required'], // Ensure it's a valid URL
                    ]);
                    $google_map_link = $request->google_map_link;
                    if (strpos($google_map_link, '<iframe') !== false) {
                        $businessData = Business::where('id', $business_id)->first();
                        if (!is_null($businessData)) {

                            $businessData->google_map_link = $google_map_link;
                            $businessData->is_google_map_enabled = '1';
                            $businessData->created_by = \Auth::user()->creatorId();
                            $businessData->save();

                        } else {
                            Business::create([
                                'id' => $business_id,
                                'google_map_link' => $google_map_link,
                                'is_enabled' => '1',
                                'created_by' => \Auth::user()->creatorId()
                            ]);
                        }
                    } else {
                        $tab = 2;
                        return redirect()->back()->with('error', __('Provided link is not an iframe in google map block.'))->with('tab', $tab);
                    }
                } else {
                    $google_map_link = $request->google_map_link;
                    $businessData = Business::where('id', $business_id)->first();
                    if (!is_null($businessData)) {

                        $businessData->google_map_link = $google_map_link;
                        $businessData->is_google_map_enabled = '0';
                        $businessData->created_by = \Auth::user()->creatorId();
                        $businessData->save();

                    } else {
                        Business::create([
                            'id' => $business_id,
                            'google_map_link' => $google_map_link,
                            'is_enabled' => '0',
                            'created_by' => \Auth::user()->creatorId()
                        ]);
                    }
                }
                if ($request->is_app_info_enabled == "on") {
                    $validator = \Validator::make(
                        $request->all(),
                        [
                            'playstore_id' => 'required|url',
                            'appstore_id' => 'required|url',
                        ]
                    );
                    if ($validator->fails()) {
                        $messages = $validator->getMessageBag();
                        return redirect()->back()->with('error', $messages->first());
                    }
                    $appData = CardAppinfo::where('business_id', $business_id)->first();
                    if (!is_null($appData)) {

                        $appData->playstore_id = $request->playstore_id;
                        $appData->appstore_id = $request->appstore_id;
                        $appData->variant = !is_null($request->variant) ? $request->variant : 1;
                        $appData->is_enabled = '1';
                        $appData->created_by = \Auth::user()->creatorId();
                        $appData->save();

                    } else {
                        CardAppinfo::create([
                            'business_id' => $business_id,
                            'playstore_id' => $request->playstore_id,
                            'appstore_id' => $request->appstore_id,
                            'variant' => !is_null($request->variant) ? $request->variant : 1,
                            'is_enabled' => '1',
                            'created_by' => \Auth::user()->creatorId()
                        ]);
                    }
                } else {

                    $appData = CardAppinfo::where('business_id', $business_id)->first();
                    if (!is_null($appData)) {
                        $appData->is_enabled = '0';
                        $appData->created_by = \Auth::user()->creatorId();
                        $appData->save();
                    } else {
                        CardAppinfo::create([
                            'business_id' => $business_id,
                            'is_enabled' => '0',
                            'created_by' => \Auth::user()->creatorId()
                        ]);
                    }
                }
                // svg
                if ($request->is_svg_enabled == "on") {
                    if ($request->hasFile('svg_text')) {
                        $validator = Validator::make($request->all(), [
                            'svg_text' => 'mimes:svg|max:2048', // Allow only SVG files, with a size limit (optional)
                        ]);

                        // Check if the validation fails
                        if ($validator->fails()) {
                            return redirect()->route('business.index', \Auth::user()->id)->with('error', 'Please select a SVG image');
                        }
                        $logoname = $business['svg_text'] ? $business['svg_text'] : '';
                        $image_path = 'svg/' . $logoname;
                        $svg_text = $request->file('svg_text');
                        $ext = $svg_text->getClientOriginalExtension();
                        $fileName = 'svg_' . time() . rand() . '.' . $ext;

                        $business->svg_text = $fileName;

                        $dir = 'svg/';
                        $image_path = $dir . $business['svg_text'];
                        if (File::exists($image_path)) {
                            File::delete($image_path);
                        }
                        $path = Utility::upload_file($request, 'svg_text', $fileName, $dir, []);

                        if ($path['flag'] == 1) {
                            $url = $path['url'];
                        } else {
                            return redirect()->route('business.index', \Auth::user()->id)->with('error', __($path['msg']));
                        }
                    }
                    else{
                        $business->is_svg_enabled = '1';
                        $business->created_by = \Auth::user()->creatorId();
                        $business->save();
                    }
                }else {
                    $business->is_svg_enabled = '0';
                    $business->created_by = \Auth::user()->creatorId();
                    $business->save();
                }
                //payment block
                if($request->is_payment_enabled == "on"){
                    $paymentOptions = $request->input('paymentoption') ?? [];
                    $stripeKey = $request->input('stripe_key');
                    $stripeSecret = $request->input('stripe_secret');
                    $paypalMode = $request->input('paypal_mode');
                    $paypalClientId = $request->input('paypal_client_id');
                    $paypalSecretKey = $request->input('paypal_secret_key');
                    $paymentInfo = [];
                    // Check if Stripe is selected
                    if (in_array('stripe', $paymentOptions)) {
                        $paymentInfo['stripe'] = [
                            'status' => 'on',
                            'stripe_key' => $request->input('stripe_key'),
                            'stripe_secret' => $request->input('stripe_secret'),
                        ];
                    } else {
                        $paymentInfo['stripe'] = [
                            'status' => 'off',
                            'stripe_key' => $request->input('stripe_key'),
                            'stripe_secret' => $request->input('stripe_secret'),
                        ];
                    }
                    // Check if Paypal is selected
                    if (in_array('paypal', $paymentOptions)) {
                        $paymentInfo['paypal'] = [
                            'status' => 'on',
                            'paypal_mode' => $request->input('paypal_mode'),
                            'paypal_client_id' => $request->input('paypal_client_id'),
                            'paypal_secret_key' => $request->input('paypal_secret_key'),
                        ];
                    } else {
                        $paymentInfo['paypal'] = [
                            'status' => 'off',
                            'paypal_mode' => $request->input('paypal_mode'),
                            'paypal_client_id' => $request->input('paypal_client_id'),
                            'paypal_secret_key' => $request->input('paypal_secret_key'),
                        ];
                    }
                    $jsonResult = json_encode($paymentInfo);
                    $cardPayment = CardPayment::where('business_id', $business->id)->first();
                    if ($cardPayment != null) {
                        $cardPayment->business_id = $business->id;
                        $cardPayment->payment_amount = $request->payment_amount;
                        $cardPayment->content = $jsonResult;
                        //$cardPayment->payment_status = 'Unpaid';
                        $cardPayment->is_enabled = $request->is_payment_enabled == 'on' ? '1' : '0';
                        $cardPayment->created_by = \Auth::user()->creatorId();
                        $cardPayment->save();
                    }
                    else {
                        $cardPayment = new CardPayment();
                        $cardPayment->business_id = $business->id;
                        $cardPayment->payment_amount = $request->payment_amount;
                        $cardPayment->content = $jsonResult;
                        $cardPayment->is_enabled = $request->is_payment_enabled == 'on' ? '1' : '0';
                        $cardPayment->created_by = \Auth::user()->creatorId();
                        $cardPayment->save();

                    }


                }else{
                    $cardPayment = CardPayment::where('business_id', $business_id)->first();
                    if (!is_null($cardPayment)) {
                        $cardPayment->is_enabled = '0';
                        $cardPayment->created_by = \Auth::user()->creatorId();
                        $cardPayment->save();
                    } else {
                        CardPayment::create([
                            'business_id' => $business_id,
                            'is_enabled' => '0',
                            'created_by' => \Auth::user()->creatorId()
                        ]);
                    }

                }
                $business->designation = $request->designation;
                $business->business_category = $request->category;
                $business->created_by = \Auth::user()->creatorId();
                $business->save();
                $tab = 2;
                return redirect()->back()->with('success', __('Business Information Add Successfully') . ((isset($result) && $result != 1) ? '<br> <span class="text-danger">' . $result . '</span>' : ''))->with('tab', $tab);
            } else {

                return redirect()->back()->with('error', __('Business does not exist'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (\Auth::user()->can('delete business')) {
            $count = Business::where('created_by', \Auth::user()->creatorId())->count();
            if ($count == 0) {
                return redirect()->route('business.index')->with('error', __('This card number is not yours.'));
            }
            if ($count > 1) {
                $user = \Auth::user();

                $business = Business::where('id', $id)->first();
                $businessqr = Businessqr::where('business_id', $id)->get();


                $bannername = $business['banner'];
                $logoname = $business['logo'];
                $metaimage = $business['banner'];


                $image_path1 = 'card_banner/' . $bannername;
                $image_path2 = 'card_logo/' . $logoname;
                $image_path3 = 'meta_images/' . $metaimage;


                $result = Utility::changeStorageLimit(\Auth::user()->creatorId(), $image_path1);
                $result = Utility::changeStorageLimit(\Auth::user()->creatorId(), $image_path2);
                $result = Utility::changeStorageLimit(\Auth::user()->creatorId(), $image_path3);
                //$result = Utility::changeStorageLimit(\Auth::user()->creatorId(), $image_path5);

                $business = Business::where('id', $id)->delete();
                Appointment_deatail::where('business_id', $id)->delete();
                Contacts::where('business_id', $id)->delete();
                Campaigns::where('business', $id)->delete();


                $currentBusiness = Business::where('created_by', \Auth::user()->creatorId())->first();

                $user->current_business = $currentBusiness->id;
                $user->save();
                return redirect()->back()->with('success', __('Business Information Deleted Successfully'));
            } else {
                return redirect()->back()->with('error', __('You have only one business'));
            }

        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    public function addField(Request $request)
    {
        return $request->all();
    }

    public function getcard($slug)
    {
        $business = Business::getBusinessBySlug($slug);

        if (!\Auth::check()) {
            if (!is_null($business)) {
                $visit = visitor()->visit($business);
                $visit_data = \DB::table('visitor')->where('slug', $visit->slug)->get();
                foreach ($visit_data as $key => $value) {
                    $busi_data = Business::getBusinessBySlug($value->slug);
                    if (!is_null($busi_data)) {
                        $v_data = \DB::table('visitor')->where('id', $value->id)->update(['created_by' => $busi_data->created_by]);
                    }
                }
            }
        }
        $business = Business::getBusinessBySlug($slug);
        if (!is_null($business)) {
            $domain = DomainRequest::where('status', '1')->where('business_id', $business->id)->first();
            if ($business->enable_domain == 'on') {
                if ($domain) {

                    if ($business->admin_enable == 'on') {
                        if (\Auth::check()) {
                            $lang = \App\Models\Utility::settings();
                            \App::setLocale($lang['company_default_language']);
                        } else {

                            $data = DB::table('settings');
                            $data = $data->where('created_by', '=', $business->created_by)->where('name', 'company_default_language')->first();
                            \App::setLocale(!empty($data->value) ? $data->value : 'en');
                        }

                        $is_slug = "true";

                        $businessfields = Utility::getFields();
                        $businesshours = business_hours::where('business_id', $business->id)->first();
                        $appoinment = appoinment::where('business_id', $business->id)->first();
                        $appoinment_hours = [];
                        if (!empty($appoinment->content)) {
                            $appoinment_hours = json_decode($appoinment->content);
                        }

                        $services = service::where('business_id', $business->id)->first();
                        $services_content = [];
                        if (!empty($services->content)) {
                            $services_content = json_decode($services->content);
                        }

                        $testimonials = testimonial::where('business_id', $business->id)->first();
                        $testimonials_content = [];
                        if (!empty($testimonials->content)) {
                            $testimonials_content = json_decode($testimonials->content);
                        }

                        $contactinfo = ContactInfo::where('business_id', $business->id)->first();
                        $contactinfo_content = [];
                        if (!empty($contactinfo->content)) {
                            $contactinfo_content = json_decode($contactinfo->content);
                        }

                        $sociallinks = social::where('business_id', $business->id)->first();
                        $social_content = [];
                        if (!empty($sociallinks->content)) {
                            $social_content = json_decode($sociallinks->content);
                        }

                        //Gallery
                        $gallery = gallery::where('business_id', $business->id)->first();
                        $gallery_contents = [];
                        if (!empty($gallery->content)) {
                            $gallery_contents = json_decode($gallery->content);
                        }


                        $customhtml = Business::where('id', $business->id)->first();
                        $user = User::find($business->created_by);
                        $plan = Plan::find($user->plan);
                        $days = business_hours::$days;
                        $business_hours = '';
                        if (!empty($businesshours->content)) {
                            $business_hours = json_decode($businesshours->content);
                        }
                        if (json_decode($business->card_theme) == NULL) {
                            $card_order = [];
                            $card_order['theme'] = $business->card_theme;
                            $card_order['order'] = Utility::getDefaultThemeOrder($business->card_theme);
                            $business->card_theme = json_encode($card_order);
                            $business->save();
                        }
                        $card_theme = json_decode($business->card_theme);

                        $pixels = PixelFields::where('business_id', $business->id)->get();
                        $pixelScript = [];
                        foreach ($pixels as $pixel) {

                            if (!$pixel->disabled) {
                                $pixelScript[] = pixelSourceCode($pixel['platform'], $pixel['pixel_id']);
                            }
                        }

                        $qr_detail = Businessqr::where('business_id', $business->id)->first();
                        //Product
                        $products = Product::where('business_id', $business->id)->first();
                        $products_content = [];
                        if (!empty($products->content)) {
                            $products_content = json_decode($products->content);
                        }
                        $cardPayment = CardPayment::cardPaymentData($business->id);
                        $cardPayment_content = [];
                        if (!empty($cardPayment->content)) {
                            $cardPayment_content = json_decode($cardPayment->content);
                        }
                        $appInfo = CardAppinfo::cardAppData($business->id);
                         //
                         $social_nos = 1;
                         $appointment_nos = 0;
                         $service_row_nos = 0;
                         $product_row_nos = 0;
                         $testimonials_row_nos = 0;
                         $gallery_row_no = 0;

                         $nos = 1;
                         $stringid = $business->id;
                         $is_enable = false;
                         $is_enabled= false;
                         $is_contact_enable = false;
                         $is_enable_appoinment = false;
                         $is_enable_service = false;
                         $is_enable_product = false;
                         $is_enable_testimonials = false;
                         $is_enable_sociallinks = false;
                         $is_custom_html_enable = false;
                         $is_google_map_enabled = false;
                         $is_enable_gallery = false;
                         $is_payment = false;
                         $is_appinfo = false;
                         $custom_html = $business->custom_html_text;
                         $is_branding_enabled = false;
                         $branding = $business->branding_text;
                         $is_gdpr_enabled = false;
                         $gdpr_text = $business->gdpr_text;
                         $card_theme = json_decode($business->card_theme);

                         $banner = \App\Models\Utility::get_file('card_banner');
                         $logo = \App\Models\Utility::get_file('card_logo');
                         $image = \App\Models\Utility::get_file('testimonials_images');
                         $s_image = \App\Models\Utility::get_file('service_images');
                         $pr_image = \App\Models\Utility::get_file('product_images');

                         $company_favicon = \App\Models\Utility::getsettingsbyid($business->created_by);
                         $company_favicon = $company_favicon['company_favicon'];
                         $logo1 = \App\Models\Utility::get_file('uploads/logo/');

                         $meta_image = \App\Models\Utility::get_file('meta_image');
                         $gallery_path = \App\Models\Utility::get_file('gallery');
                         $qr_path = \App\Models\Utility::get_file('qrcode');
                         $svg_text = \App\Models\Utility::get_file('svg');

                         $theme = $business->theme;
                         $color = substr($business->theme_color, 0, 6);
                         $meta_tag_image = $meta_image . '/' . $business->meta_image;
                         if (!is_null($custom_html) && !is_null($customhtml)) {
                             $customhtml->is_custom_html_enabled == '1' ? ($is_custom_html_enable = true) : ($is_custom_html_enable = false);
                         }
                         if (!is_null($business->is_branding_enabled) && !is_null($business->is_branding_enabled)) {
                             !empty($business->is_branding_enabled) && $business->is_branding_enabled == 'on'
                                 ? ($is_branding_enabled = true)
                                 : ($is_branding_enabled = false);
                         } else {
                             $is_branding_enabled = false;
                         }
                         if (!is_null($business->is_gdpr_enabled) && !is_null($business->is_gdpr_enabled)) {
                             !empty($business->is_gdpr_enabled) && $business->is_gdpr_enabled == 'on'
                                 ? ($is_gdpr_enabled = true)
                                 : ($is_gdpr_enabled = false);
                         }
                         if (!is_null($appInfo)) {
                             $appInfo['is_enabled'] == '1' ? ($is_appinfo = true) : ($is_appinfo = false);
                         }
                         if (!is_null($business) && !is_null($business)) {
                             $business->is_svg_enabled == '1' ? ($is_svg_enabled = true) : ($is_svg_enabled = false);
                         }
                         if (!is_null($social_content) && !is_null($sociallinks)) {
                             $sociallinks['is_enabled'] == '1' ? ($is_enable_sociallinks = true) : ($is_enable_sociallinks = false);
                         }
                         if (!is_null($business) && !is_null($business)) {
                             $business->is_google_map_enabled == '1' ? ($is_google_map_enabled = true) : ($is_google_map_enabled = false);
                         }
                         if (!is_null($cardPayment) && !is_null($cardPayment)) {
                             $cardPayment->is_enabled == '1' ? ($is_enabled = true) : ($is_enabled = false);
                         }
                         $SITE_RTL = \App\Models\Utility::settings()['SITE_RTL'];
                         $url_link = env('APP_URL') . '/' . $business->slug;
                         $theme=$business->theme;
                         $themeName = \App\Models\Utility::themeOne()[$theme][$business->theme_color]['theme_name'] ?? null;
                        return view('card.' . $card_theme->theme . '.index', compact('appInfo', 'businessfields', 'contactinfo', 'contactinfo_content', 'appoinment_hours', 'appoinment', 'services_content', 'services', 'testimonials_content', 'testimonials', 'social_content', 'sociallinks', 'customhtml', 'businesshours', 'business_hours', 'business', 'days', 'is_slug', 'plan', 'gallery', 'gallery_contents', 'pixelScript', 'qr_detail', 'products', 'products_content', 'cardPayment', 'cardPayment_content', 'social_nos', 'service_row_nos', 'product_row_nos', 'testimonials_row_nos', 'gallery_row_no', 'nos', 'stringid', 'is_custom_html_enable', 'is_branding_enabled', 'branding', 'is_gdpr_enabled', 'gdpr_text', 'card_theme', 'banner', 'logo', 'image', 's_image', 'pr_image', 'company_favicon', 'logo1', 'meta_image', 'gallery_path', 'qr_path', 'theme', 'color', 'SITE_RTL', 'url_link', 'is_appinfo', 'is_svg_enabled', 'svg_text','is_enable_sociallinks','appointment_nos','is_google_map_enabled','custom_html','is_enabled','meta_tag_image','themeName'));
                    } else {
                        return abort('403', 'The Link You Followed Has Disactive');
                    }
                } else {
                    abort(404);
                }
            } else {

                if ($business->admin_enable == 'on') {


                    if (\Auth::check()) {
                        $lang = \App\Models\Utility::settings();
                        \App::setLocale($lang['company_default_language']);
                    } else {

                        $data = DB::table('settings');
                        $data = $data->where('created_by', '=', $business->created_by)->where('name', 'company_default_language')->first();
                        \App::setLocale(!empty($data->value) ? $data->value : 'en');
                    }

                    $is_slug = "true";

                    $businessfields = Utility::getFields();
                    $businesshours = business_hours::where('business_id', $business->id)->first();
                    $appoinment = appoinment::where('business_id', $business->id)->first();
                    $appoinment_hours = [];
                    if (!empty($appoinment->content)) {
                        $appoinment_hours = json_decode($appoinment->content);
                    }

                    $services = service::where('business_id', $business->id)->first();
                    $services_content = [];
                    if (!empty($services->content)) {
                        $services_content = json_decode($services->content);
                    }

                    $testimonials = testimonial::where('business_id', $business->id)->first();
                    $testimonials_content = [];
                    if (!empty($testimonials->content)) {
                        $testimonials_content = json_decode($testimonials->content);
                    }

                    $contactinfo = ContactInfo::where('business_id', $business->id)->first();
                    $contactinfo_content = [];
                    if (!empty($contactinfo->content)) {
                        $contactinfo_content = json_decode($contactinfo->content);
                    }

                    $sociallinks = social::where('business_id', $business->id)->first();
                    $social_content = [];
                    if (!empty($sociallinks->content)) {
                        $social_content = json_decode($sociallinks->content);
                    }

                    //Gallery
                    $gallery = gallery::where('business_id', $business->id)->first();
                    $gallery_contents = [];
                    if (!empty($gallery->content)) {
                        $gallery_contents = json_decode($gallery->content);
                    }


                    $customhtml = Business::where('id', $business->id)->first();
                    $user = User::find($business->created_by);
                    $plan = Plan::find($user->plan);
                    $days = business_hours::$days;
                    $business_hours = '';
                    if (!empty($businesshours->content)) {
                        $business_hours = json_decode($businesshours->content);
                    }
                    if (json_decode($business->card_theme) == NULL) {
                        $card_order = [];
                        $card_order['theme'] = $business->card_theme;
                        $card_order['order'] = Utility::getDefaultThemeOrder($business->card_theme);
                        $business->card_theme = json_encode($card_order);
                        $business->save();
                    }
                    $card_theme = json_decode($business->card_theme);

                    $pixels = PixelFields::where('business_id', $business->id)->get();
                    $pixelScript = [];
                    foreach ($pixels as $pixel) {

                        if (!$pixel->disabled) {
                            $pixelScript[] = pixelSourceCode($pixel['platform'], $pixel['pixel_id']);
                        }
                    }

                    $qr_detail = Businessqr::where('business_id', $business->id)->first();
                    //Product
                    $products = Product::where('business_id', $business->id)->first();
                    $products_content = [];
                    if (!empty($products->content)) {
                        $products_content = json_decode($products->content);
                    }
                    $cardPayment = CardPayment::cardPaymentData($business->id);
                    $cardPayment_content = [];
                    if (!empty($cardPayment->content)) {
                        $cardPayment_content = json_decode($cardPayment->content);
                    }
                    $appInfo = CardAppinfo::cardAppData($business->id);
                    //
                    $social_nos = 1;
                    $appointment_nos = 0;
                    $service_row_nos = 0;
                    $product_row_nos = 0;
                    $testimonials_row_nos = 0;
                    $gallery_row_no = 0;

                    $nos = 1;
                    $stringid = $business->id;
                    $is_enable = false;
                    $is_enabled= false;
                    $is_contact_enable = false;
                    $is_enable_appoinment = false;
                    $is_enable_service = false;
                    $is_enable_product = false;
                    $is_enable_testimonials = false;
                    $is_enable_sociallinks = false;
                    $is_custom_html_enable = false;
                    $is_google_map_enabled = false;
                    $is_enable_gallery = false;
                    $is_payment = false;
                    $is_appinfo = false;
                    $custom_html = $business->custom_html_text;
                    $is_branding_enabled = false;
                    $branding = $business->branding_text;
                    $is_gdpr_enabled = false;
                    $gdpr_text = $business->gdpr_text;
                    $card_theme = json_decode($business->card_theme);

                    $banner = \App\Models\Utility::get_file('card_banner');
                    $logo = \App\Models\Utility::get_file('card_logo');
                    $image = \App\Models\Utility::get_file('testimonials_images');
                    $s_image = \App\Models\Utility::get_file('service_images');
                    $pr_image = \App\Models\Utility::get_file('product_images');

                    $company_favicon = \App\Models\Utility::getsettingsbyid($business->created_by);
                    $company_favicon = $company_favicon['company_favicon'];
                    $logo1 = \App\Models\Utility::get_file('uploads/logo/');

                    $meta_image = \App\Models\Utility::get_file('meta_image');
                    $gallery_path = \App\Models\Utility::get_file('gallery');
                    $qr_path = \App\Models\Utility::get_file('qrcode');
                    $svg_text = \App\Models\Utility::get_file('svg');

                    $theme = $business->theme;
                    $color = substr($business->theme_color, 0, 6);
                    $meta_tag_image = $meta_image . '/' . $business->meta_image;

                    if (!is_null($custom_html) && !is_null($customhtml)) {
                        $customhtml->is_custom_html_enabled == '1' ? ($is_custom_html_enable = true) : ($is_custom_html_enable = false);
                    }
                    if (!is_null($business->is_branding_enabled) && !is_null($business->is_branding_enabled)) {
                        !empty($business->is_branding_enabled) && $business->is_branding_enabled == 'on'
                            ? ($is_branding_enabled = true)
                            : ($is_branding_enabled = false);
                    } else {
                        $is_branding_enabled = false;
                    }
                    if (!is_null($business->is_gdpr_enabled) && !is_null($business->is_gdpr_enabled)) {
                        !empty($business->is_gdpr_enabled) && $business->is_gdpr_enabled == 'on'
                            ? ($is_gdpr_enabled = true)
                            : ($is_gdpr_enabled = false);
                    }
                    if (!is_null($appInfo)) {
                        $appInfo['is_enabled'] == '1' ? ($is_appinfo = true) : ($is_appinfo = false);
                    }
                    if (!is_null($business) && !is_null($business)) {
                        $business->is_svg_enabled == '1' ? ($is_svg_enabled = true) : ($is_svg_enabled = false);
                    }
                    if (!is_null($social_content) && !is_null($sociallinks)) {
                        $sociallinks['is_enabled'] == '1' ? ($is_enable_sociallinks = true) : ($is_enable_sociallinks = false);
                    }
                    if (!is_null($business) && !is_null($business)) {
                        $business->is_google_map_enabled == '1' ? ($is_google_map_enabled = true) : ($is_google_map_enabled = false);
                    }
                    if (!is_null($cardPayment) && !is_null($cardPayment)) {
                        $cardPayment->is_enabled == '1' ? ($is_enabled = true) : ($is_enabled = false);
                    }
                    $SITE_RTL = \App\Models\Utility::settings()['SITE_RTL'];
                    $url_link = env('APP_URL') . '/' . $business->slug;
                    $theme=$business->theme;
                    $themeName = \App\Models\Utility::themeOne()[$theme][$business->theme_color]['theme_name'] ?? null;
                    return view('card.' . $card_theme->theme . '.index', compact('appInfo', 'businessfields', 'contactinfo', 'contactinfo_content', 'appoinment_hours', 'appoinment', 'services_content', 'services', 'testimonials_content', 'testimonials', 'social_content', 'sociallinks', 'customhtml', 'businesshours', 'business_hours', 'business', 'days', 'is_slug', 'plan', 'gallery', 'gallery_contents', 'pixelScript', 'qr_detail', 'products', 'products_content', 'cardPayment', 'cardPayment_content', 'social_nos', 'service_row_nos', 'product_row_nos', 'testimonials_row_nos', 'gallery_row_no', 'nos', 'stringid', 'is_custom_html_enable', 'is_branding_enabled', 'branding', 'is_gdpr_enabled', 'gdpr_text', 'card_theme', 'banner', 'logo', 'image', 's_image', 'pr_image', 'company_favicon', 'logo1', 'meta_image', 'gallery_path', 'qr_path', 'theme', 'color', 'SITE_RTL', 'url_link', 'is_appinfo', 'is_svg_enabled', 'svg_text','is_enable_sociallinks','appointment_nos','is_google_map_enabled','custom_html','is_enabled','meta_tag_image','themeName'));
                } else {
                    return abort('403', 'The Link You Followed Has Disactive');
                }

            }
        } else {
            return abort('404', 'Not Found');
        }

    }

    public function editTheme($id, Request $request)
    {
        if (\Auth::user()->can('theme settings business')) {
            $count = Business::where('id', $id)->where('created_by', \Auth::user()->creatorId())->count();
            if ($count == 0) {
                return redirect()->route('business.index')->with('error', __('This card number is not yours.'));
            }
            $validator = \Validator::make(
                $request->all(),
                [
                    // 'theme_color' => 'required',
                    'themefile' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            $card_order = [];
            $card_order['theme'] = $request->themefile;
            $card_order['order'] = Utility::getDefaultThemeOrder($request->themefile);
            $businesss = Business::where('id', $id)->first();
            if ($request->color_flag == 'true') {
                $businesss['theme_color']  = $request->custom_color;
            } else {
                $businesss['theme_color'] = $request->theme_color;
            }

            $businesss['card_theme'] = json_encode($card_order);
            $businesss['theme']= $request->themefile;
            $businesss->save();
            $tab = 1;
            return redirect()->back()->with('success', __('Theme Successfully Updated.'))->with('tab', $tab);
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    public function getVcardDownload($slug)
    {
        $business = Business::where('slug', $slug)->first();
        $vcard = new VCard();

        $lastname = '';
        $firstname = $business->title;
        $additional = '';
        $prefix = '';
        $suffix = '';
        $cardLogo = isset($business->logo) && !empty($business->logo) ? asset(Storage::url('card_logo/' . $business->logo)) : asset('custom/img/logo-placeholder-image-2.png');
        // add personal data
        $vcard->addName($lastname, $firstname, $additional, $prefix, $suffix);

        // add work data
        $vcard->addCompany($business->title);
        $vcard->addRole($business->designation);

        $cardLogoResponse = Http::get($cardLogo);
        if ($cardLogoResponse->successful()) {
            $cardLogoData = $cardLogoResponse->body();
            // Save the image locally, e.g., in the public directory
            $localImagePath = public_path('card/card_logo.jpg');
            file_put_contents($localImagePath, $cardLogoData);
            $vcard->addPhoto($localImagePath);

        }
        $contacts = ContactInfo::where('business_id', $business->id)->first();

        if (!empty($contacts) && !empty($contacts->content)) {
            if (isset($contacts['is_enabled']) && $contacts['is_enabled'] == '1') {
                $contact = json_decode($contacts->content, true);
                foreach ($contact as $key => $val) {
                    foreach ($val as $key2 => $val2) {
                        if ($key2 == 'Email') {
                            $vcard->addEmail($val2, 'TYPE=EMAIL');
                        }
                        if ($key2 == 'Phone') {
                            $vcard->addPhoneNumber($val2, 'TYPE=Phone NO');
                        }
                        if ($key2 == 'Whatsapp') {
                            $vcard->addPhoneNumber($val2, 'WORK');
                        }
                        if ($key2 == 'Web_url') {
                            $vcard->addURL($val2);
                        }

                    }

                }
            }

        }
        $sociallinks = social::where('business_id', $business->id)->first();
        $social_content = [];
        if (!empty($sociallinks->content)) {
            $social_content = json_decode($sociallinks->content);
        }
        if (!is_null($social_content) && !is_null($sociallinks)) {
            if (isset($sociallinks['is_enabled']) && $sociallinks['is_enabled'] == '1') {
                foreach ($social_content as $social_key => $social_val) {
                    foreach ($social_val as $social_key1 => $social_val1) {
                        if ($social_key1 != 'id') {
                            $vcard->addURL($social_val1, 'TYPE=' . $social_key1);
                        }
                    }
                }
            }
        }
        $path = public_path('/card');
        \File::delete($path);
        if (!is_dir($path)) {
            \File::makeDirectory($path, 0777);
        }
        $vcard->setSavePath($path);

        $vcard->save();
        $file = $vcard->getFilename() . '.' . $vcard->getFileExtension();
        self::download($path . '/' . $file);



    }
    function download($file)
    {
        if (file_exists($file)) {
            $iPhone = stripos($_SERVER['HTTP_USER_AGENT'], "iPhone");
            header('Content-Description: File Transfer');
            if ($iPhone) {
                header('Content-Type: text/vcard');
            } else {
                header('Content-Type: application/octet-stream');
            }
            header('Content-Disposition: attachment; filename=' . basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            flush();
            readfile($file);
            exit;
        }
    }

    public function analytics(Request $request, $id)
    {

        if (\Auth::user()->can('view analytics business')) {

            $count = Business::where('id', $id)->where('created_by', \Auth::user()->creatorId())->count();
            if ($count == 0) {
                return redirect()->route('business.index')->with('error', __('This card number is not yours.'));
            }

            $business = Business::find($id);
            $duration = ['duration' => 'week'];


            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            $isFiltered = !is_null($startDate) && !is_null($endDate);


            $chartData = $this->getOrderChart($duration, $id, $startDate, $endDate);


            $visitorQuery = \DB::table('visitor')->where('slug', $business->slug);

            if ($startDate && $endDate) {
                $visitorQuery->whereBetween('created_at', [$startDate, $endDate]);
            }

            $user_device = $visitorQuery->selectRaw("count('*') as total, device")
                ->groupBy('device')->orderBy('device', 'DESC')->get();

            $user_browser = $visitorQuery->selectRaw("count('*') as total, browser")
                ->groupBy('browser')->orderBy('browser', 'DESC')->get();

            $user_platform = $visitorQuery->selectRaw("count('*') as total, platform")
                ->groupBy('platform')->orderBy('platform', 'DESC')->get();


            $devicearray = ['label' => [], 'data' => []];
            foreach ($user_device as $device) {
                $devicearray['label'][] = $device->device ?: 'Other';
                $devicearray['data'][] = $device->total;
            }

            $browserarray = ['label' => [], 'data' => []];
            foreach ($user_browser as $browser) {
                $browserarray['label'][] = $browser->browser;
                $browserarray['data'][] = $browser->total;
            }

            $platformarray = ['label' => [], 'data' => []];
            foreach ($user_platform as $platform) {
                $platformarray['label'][] = $platform->platform;
                $platformarray['data'][] = $platform->total;
            }

            $promoteData = Campaigns::where('business', $id)->get();

            $annotations = [];
            $totalBudget = 0;
            $promotionData = ['label' => [], 'data' => []];
            $promotionPeriodData = ['label' => [], 'data' => []];

            foreach ($promoteData as $promote) {
                $startDateString = Carbon::parse($promote->start_date)->format('d-M');
                $endDateString = Carbon::parse($promote->end_date)->format('d-M');
                $totalBudget += $promote->total_cost;

                $annotation = [
                    'startDateString' => $startDateString,
                    'endDateString' => $endDateString,
                    'days' => $promote->total_days,
                    'budget' => $promote->total_cost,
                    'budgetPercentage' => ($promote->total_cost / $totalBudget) * 100,

                ];
                $annotations[] = $annotation;
                $promotionData['label'][] = $startDateString . ' to ' . $endDateString;
                $promotionData['data'][] = $promote->total_cost;
                $promotionPeriodData['label'][] = $startDateString . ' to ' . $endDateString;
                $promotionPeriodData['data'][] = $promote->total_days;
            }

            return view('business.analytics', compact('platformarray', 'chartData', 'browserarray', 'devicearray', 'id', 'isFiltered', 'promoteData', 'annotations','promotionData','promotionPeriodData'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function getOrderChart($arrParam, $id, $startDate = null, $endDate = null)
    {
        $user = \Auth::user();
        $arrDuration = [];

        // Adjust the date range if start and end dates are provided
        if ($startDate && $endDate) {
            $start = strtotime($startDate);
            $end = strtotime($endDate);
            for ($i = $start; $i <= $end; $i += 86400) {
                $arrDuration[date('Y-m-d', $i)] = date('d-M', $i);
            }
        } else {
            // Define the duration based on the provided parameters or defaults
            if ($arrParam['duration'] == 'week') {
                $previous_month = strtotime("-15 days");
                for ($i = 0; $i < 15; $i++) {
                    $arrDuration[date('Y-m-d', $previous_month)] = date('d-M', $previous_month);
                    $previous_month = strtotime(date('Y-m-d', $previous_month) . " +1 day");
                }
            }
        }

        $arrTask = ['label' => [], 'data' => [], 'unique_data' => []];

        // Adjust the query to consider the start and end dates if provided
        $dateRange = [];
        foreach ($arrDuration as $date => $label) {
            $data['visitor'] = \DB::table('visitor')
                ->select(\DB::raw('count(*) as total'))
                ->whereDate('created_at', '=', $date)
                ->where('created_by', \Auth::user()->creatorId())
                ->first();

            $uniq = \DB::table('visitor')
                ->select('ip')
                ->distinct()
                ->whereDate('created_at', '=', $date)
                ->where('created_by', \Auth::user()->creatorId())
                ->get();

            $data['unique'] = $uniq->count();
            $arrTask['label'][] = $label;
            $arrTask['data'][] = $data['visitor']->total;
            $arrTask['unique_data'][] = $data['unique'];
        }

        $business = Business::where('id', $id)->first();
        if ($business != NULL) {
            $array_app = [];
            $d['data'] = [];
            $d['name'] = $business->title;
            foreach ($arrDuration as $date => $label) {
                $d['data'][] = \DB::table('appointment_deatails')
                    ->where('business_id', $business->id)
                    ->where('created_by', \Auth::user()->creatorId())
                    ->whereDate('created_at', '=', $date)
                    ->count();
            }
            $array_app[] = $d;
            $arrTask['data'] = $array_app;
            return $arrTask;
        } else {
            return abort('404', 'Not Found');
        }
    }


    public function domainsetting($id, Request $request)
    {
        if (\Auth::user()->can('custom settings business')) {
            $cookieData = [];

            $count = Business::where('id', $id)->where('created_by', \Auth::user()->creatorId())->count();
            if ($count == 0) {
                return redirect()->route('business.index')->with('error', __('This card number is not yours.'));
            }
            $business = Business::where('id', $id)->first();


            if ($request->enable_domain == 'enable_domain') {
                // Remove the http://, www., and slash(/) from the URL
                $input = $request->domains;
                // If URI is like, eg. www.way2tutorial.com/
                $input = trim($input, '/');
                // If not have http:// or https:// then prepend it
                if (!preg_match('#^http(s)?://#', $input)) {
                    $input = 'http://' . $input;
                }

                $urlParts = parse_url($input);
                // Remove www.
                $domain_name = preg_replace('/^www\./', '', $urlParts['host'] ?? null);

                // Output way2tutorial.com
            }
            if ($request->enable_domain == 'enable_subdomain') {
                // Remove the http://, www., and slash(/) from the URL
                $input = env('APP_URL');

                // If URI is like, eg. www.way2tutorial.com/
                $input = trim($input, '/');
                // If not have http:// or https:// then prepend it
                if (!preg_match('#^http(s)?://#', $input)) {
                    $input = 'http://' . $input;
                }

                $urlParts = parse_url($input);

                // Remove www.
                $subdomain_name = preg_replace('/^www\./', '', $urlParts['host']);
                // Output way2tutorial.com
                $subdomain_name = $request->subdomain . '.' . $subdomain_name;
            }

            if ($request->enable_domain == 'enable_domain') {
                $business['domains'] = $domain_name;
            }

            $business['enable_businesslink'] = ($request->enable_domain == 'enable_businesslink' || empty($request->enable_domain)) ? 'on' : 'off';
            $business['enable_domain'] = ($request->enable_domain == 'enable_domain') ? 'on' : 'off';
            $business['enable_subdomain'] = ($request->enable_domain == 'enable_subdomain') ? 'on' : 'off';

            if ($request->enable_domain == 'enable_subdomain') {
                $business['subdomain'] = $subdomain_name;
            }
            $business->save();

            $domainRequest = DomainRequest::where('business_id', $business->id)->first();
            if ($request->enable_domain == 'enable_domain') {
                if ($domainRequest) {
                    $domainRequest->domain_name = $request->domains;
                    $domainRequest->business_id = $business->id;
                    $domainRequest->user_id = \Auth::user()->creatorId();
                    $domainRequest->save();
                } else {
                    $domainRequest = new DomainRequest();
                    $domainRequest->domain_name = $request->domains;
                    $domainRequest->business_id = $business->id;
                    $domainRequest->user_id = \Auth::user()->creatorId();
                    $domainRequest->save();
                }
            } else if ($request->enable_domain == 'enable_businesslink') {
                if ($domainRequest) {
                    $domainRequest->delete();
                }

            }


            //CustomJs And CustomCSS

            if ($request->has('customjs') || $request->has('customcss')) {

                $business = Business::find($id);
                $business->customjs = $request->customjs;
                $business->customcss = $request->customcss;
                $business->save();
            }

            //Google_Fonts
            if ($request->has('google_fonts')) {

                $business = Business::find($id);
                $business->google_fonts = $request->google_fonts;
                $business->save();

            }

            //Password
            if ($request->password && $request->is_password_enabled) {

                $request->validate([
                    'password' => Rules\Password::defaults(),
                ]);
                $business = Business::find($id);
                $business->password = $request->password;
                $business->enable_password = $request->is_password_enabled;
                $business->save();

            }

            //Branding
            if ($request->branding_text) {

                $business = Business::find($id);
                $business->is_branding_enabled = $request->branding;
                $business->branding_text = $request->branding_text;
                $business->save();

            }
            $tab = 3;
            return redirect()->back()->with('success', __('Custom Detail Successfully Updated.'))->with('tab', $tab);
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }

    public function cardpdf($slug)
    {
        $business = Business::where('slug', $slug)->first();
        $user = User::find($business->created_by);
        $plan = Plan::find($user->plan);
        if (!is_null($business)) {
            \App::setLocale($business->getLanguage());
            $is_slug = "true";
            $is_pdf = "true";
            $businessfields = Utility::getFields();
            $businesshours = business_hours::where('business_id', $business->id)->first();
            $appoinment = appoinment::where('business_id', $business->id)->first();
            $appoinment_hours = [];
            if (!empty($appoinment->content)) {
                $appoinment_hours = json_decode($appoinment->content);
            }

            $services = service::where('business_id', $business->id)->first();
            $services_content = [];
            if (!empty($services->content)) {
                $services_content = json_decode($services->content);
            }

            $testimonials = testimonial::where('business_id', $business->id)->first();
            $testimonials_content = [];
            if (!empty($testimonials->content)) {
                $testimonials_content = json_decode($testimonials->content);
            }

            $contactinfo = ContactInfo::where('business_id', $business->id)->first();
            $contactinfo_content = [];
            if (!empty($contactinfo->content)) {
                $contactinfo_content = json_decode($contactinfo->content);
            }

            $sociallinks = social::where('business_id', $business->id)->first();
            $social_content = [];
            if (!empty($sociallinks->content)) {
                $social_content = json_decode($sociallinks->content);
            }

            //Gallery
            $gallery = gallery::where('business_id', $business->id)->first();
            $gallery_contents = [];
            if (!empty($gallery->content)) {
                $gallery_contents = json_decode($gallery->content);
            }


            $customhtml = Business::where('id', $business->id)->first();
            $plan = Plan::where('id', $user->plan)->first();


            $days = business_hours::$days;
            $business_hours = '';
            if (!empty($businesshours->content)) {
                $business_hours = json_decode($businesshours->content);
            }
            if (json_decode($business->card_theme) == NULL) {
                $card_order = [];
                $card_order['theme'] = $business->card_theme;
                $card_order['order'] = Utility::getDefaultThemeOrder($business->card_theme);
                $business->card_theme = json_encode($card_order);
                $business->save();
            }
            $card_theme = json_decode($business->card_theme);
            // $PixelFields = PixelFields::where('business_id', $id)->get();
            $PixelFields = PixelFields::where('business_id', $business->id)->get();
            $pixelScript = [];
            foreach ($PixelFields as $pixel) {

                if (!$pixel->disabled) {
                    $pixelScript[] = pixelSourceCode($pixel['platform'], $pixel['pixel_id']);
                }
            }
            //Product
            $products = Product::where('business_id', $business->id)->first();
            $products_content = [];
            if (!empty($products->content)) {
                $products_content = json_decode($products->content);
            }
            $cardPayment = CardPayment::cardPaymentData($business->id);
            $cardPayment_content = [];
            if (!empty($cardPayment->content)) {
                $cardPayment_content = json_decode($cardPayment->content);
            }
            $appInfo = CardAppinfo::cardAppData($business->id);

            //
            $social_nos = 1;
            $appointment_nos = 0;
            $service_row_nos = 0;
            $product_row_nos = 0;
            $testimonials_row_nos = 0;
            $gallery_row_no = 0;
            $nos = 1;
            $is_appinfo = false;
            $stringid = $business->id;
            $is_custom_html_enable = false;
            $custom_html = $business->custom_html_text;
            $is_branding_enabled = false;
            $branding = $business->branding_text;
            $is_gdpr_enabled = false;
            $is_google_map_enabled = false;
            $is_enable_sociallinks = false;
            $is_enabled=false;
            $gdpr_text = $business->gdpr_text;
            $card_theme = json_decode($business->card_theme);

            $banner = \App\Models\Utility::get_file('card_banner');
            $logo = \App\Models\Utility::get_file('card_logo');
            $image = \App\Models\Utility::get_file('testimonials_images');
            $s_image = \App\Models\Utility::get_file('service_images');
            $pr_image = \App\Models\Utility::get_file('product_images');

            $company_favicon = \App\Models\Utility::getsettingsbyid($business->created_by);
            $company_favicon = $company_favicon['company_favicon'];
            $logo1 = \App\Models\Utility::get_file('uploads/logo/');

            $meta_image = \App\Models\Utility::get_file('meta_image');
            $gallery_path = \App\Models\Utility::get_file('gallery');
            $qr_path = \App\Models\Utility::get_file('qrcode');
            $svg_text = \App\Models\Utility::get_file('svg');

            $theme = $business->theme;
            $color = substr($business->theme_color, 0, 6);
            $meta_tag_image = $meta_image . '/' . $business->meta_image;


            if (!is_null($custom_html) && !is_null($customhtml)) {
                $customhtml->is_custom_html_enabled == '1' ? ($is_custom_html_enable = true) : ($is_custom_html_enable = false);
            }
            if (!is_null($business->is_branding_enabled) && !is_null($business->is_branding_enabled)) {
                !empty($business->is_branding_enabled) && $business->is_branding_enabled == 'on'
                    ? ($is_branding_enabled = true)
                    : ($is_branding_enabled = false);
            } else {
                $is_branding_enabled = false;
            }
            if (!is_null($business->is_gdpr_enabled) && !is_null($business->is_gdpr_enabled)) {
                !empty($business->is_gdpr_enabled) && $business->is_gdpr_enabled == 'on'
                    ? ($is_gdpr_enabled = true)
                    : ($is_gdpr_enabled = false);
            }
            if (!is_null($appInfo)) {
                $appInfo['is_enabled'] == '1' ? ($is_appinfo = true) : ($is_appinfo = false);
            }
            if (!is_null($business) && !is_null($business)) {
                $business->is_svg_enabled == '1' ? ($is_svg_enabled = true) : ($is_svg_enabled = false);
            }
            if (!is_null($social_content) && !is_null($sociallinks)) {
                $sociallinks['is_enabled'] == '1' ? ($is_enable_sociallinks = true) : ($is_enable_sociallinks = false);
            }
            if (!is_null($business) && !is_null($business)) {
                $business->is_google_map_enabled == '1' ? ($is_google_map_enabled = true) : ($is_google_map_enabled = false);
            }
            if (!is_null($cardPayment) && !is_null($cardPayment)) {
                $cardPayment->is_enabled == '1' ? ($is_enabled = true) : ($is_enabled = false);
            }
            $SITE_RTL = \App\Models\Utility::settings()['SITE_RTL'];
            $url_link = env('APP_URL') . '/' . $business->slug;
            $theme=$business->theme;
            $themeName = \App\Models\Utility::themeOne()[$theme][$business->theme_color]['theme_name'] ?? null;

            return view('card.' . $card_theme->theme . '.index', compact('appInfo', 'businessfields', 'contactinfo', 'contactinfo_content', 'appoinment_hours', 'appoinment', 'services_content', 'services', 'testimonials_content', 'testimonials', 'social_content', 'sociallinks', 'customhtml', 'businesshours', 'business_hours', 'business', 'days', 'is_slug', 'is_pdf', 'plan', 'gallery', 'gallery_contents', 'pixelScript', 'products', 'products_content', 'cardPayment', 'cardPayment_content', 'social_nos', 'service_row_nos', 'product_row_nos', 'testimonials_row_nos', 'gallery_row_no', 'nos', 'stringid', 'is_custom_html_enable','custom_html', 'is_branding_enabled', 'branding', 'is_gdpr_enabled', 'gdpr_text', 'card_theme', 'banner', 'logo', 'image', 's_image', 'pr_image', 'company_favicon', 'logo1', 'meta_image', 'gallery_path', 'qr_path', 'theme', 'color', 'SITE_RTL', 'url_link', 'is_appinfo', 'is_svg_enabled', 'svg_text','is_enable_sociallinks','appointment_nos','meta_tag_image','is_google_map_enabled','is_enabled','themeName'));
        } else {
            return abort('403', 'The Link You Followed Has Expired');
        }
    }
    public function downloadqr(Request $request)
    {
        $user = \Auth::user();
        $plan = Plan::where('id', $user->plan)->first();
        $logo = asset(Storage::url('uploads/logo/'));
        $company_logo = Utility::getValByName('company_logo');
        $img = asset($logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png'));

        $qrData = $request->qrData;
        $business = Business::where('slug', $qrData)->first();
        $qr_detail = Businessqr::where('business_id', $business->id)->first();
        $view = view('business.businessQR', compact('qrData', 'business', 'qr_detail', 'plan'))->render();
        $data['success'] = true;
        $data['data'] = $view;
        return $data;

    }

    public function blocksetting($id, Request $request)
    {
        if (\Auth::user()->can('block settings business')) {
            $count = Business::where('id', $id)->where('created_by', \Auth::user()->creatorId())->count();
            if ($count == 0) {
                return redirect()->route('business.index')->with('error', __('This card number is not yours.'));
            }
            $business = Business::where('id', $id)->first();
            $card_order = [];
            $order = [];
            $card_order['theme'] = $request->theme_name;
            $req_order = explode(",", $request->order);
            foreach ($req_order as $key => $value) {
                $od = $key + 1;
                $order[$value] = $od;
            }
            $card_order['order'] = $order;
            $business->card_theme = $card_order;
            $business->save();

            $contact_data = ContactInfo::where('business_id', $id)->first();
            if ($contact_data != NULL) {
                $contact_data['is_enabled'] = $request->is_contact_info_enabled == 'on' ? '1' : '0';
                $contact_data->save();
            } else {
                ContactInfo::create([
                    'business_id' => $id,
                    'is_enabled' => $request->is_contact_info_enabled == 'on' ? '1' : '0',
                    'created_by' => \Auth::user()->creatorId()
                ]);
            }

            $bussiness_hour_data = business_hours::where('business_id', $id)->first();
            if ($bussiness_hour_data != NULL) {
                $bussiness_hour_data['is_enabled'] = $request->is_bussiness_hour_enabled == 'on' ? '1' : '0';
                $bussiness_hour_data->save();
            } else {
                business_hours::create([
                    'business_id' => $id,
                    'is_enabled' => $request->is_bussiness_hour_enabled == 'on' ? '1' : '0',
                    'created_by' => \Auth::user()->creatorId()
                ]);
            }

            $appointment_data = appoinment::where('business_id', $id)->first();
            if ($appointment_data != NULL) {
                $appointment_data['is_enabled'] = $request->is_appointment_enabled == 'on' ? '1' : '0';
                $appointment_data->save();
            } else {
                appoinment::create([
                    'business_id' => $id,
                    'is_enabled' => $request->is_appointment_enabled == 'on' ? '1' : '0',
                    'created_by' => \Auth::user()->creatorId()
                ]);
            }

            $service_data = service::where('business_id', $id)->first();
            if ($service_data != NULL) {
                $service_data['is_enabled'] = $request->is_service_enabled == 'on' ? '1' : '0';
                $service_data->save();
            } else {
                service::create([
                    'business_id' => $id,
                    'is_enabled' => $request->is_service_enabled == 'on' ? '1' : '0',
                    'created_by' => \Auth::user()->creatorId()
                ]);
            }


            $testimonials_data = testimonial::where('business_id', $id)->first();
            if ($testimonials_data != NULL) {
                $testimonials_data['is_enabled'] = $request->is_testimonials_enabled == 'on' ? '1' : '0';
                $testimonials_data->save();
            } else {
                testimonial::create([
                    'business_id' => $id,
                    'is_enabled' => $request->is_testimonials_enabled == 'on' ? '1' : '0',
                    'created_by' => \Auth::user()->creatorId()
                ]);
            }

            $social_data = social::where('business_id', $id)->first();
            if ($social_data != NULL) {
                $social_data['is_enabled'] = $request->is_social_enabled == 'on' ? '1' : '0';
                $social_data->save();
            } else {
                social::create([
                    'business_id' => $id,
                    'is_enabled' => $request->is_social_enabled == 'on' ? '1' : '0',
                    'created_by' => \Auth::user()->creatorId()
                ]);
            }

            //Gallery
            $gallery_data = Gallery::where('business_id', $id)->first();
            if ($gallery_data != NULL) {
                $gallery_data['is_enabled'] = $request->is_gallery_enabled == 'on' ? '1' : '0';
                $gallery_data->save();
            } else {
                Gallery::create([
                    'business_id' => $id,
                    'is_enabled' => $request->is_gallery_enabled == 'on' ? '1' : '0',
                    'created_by' => \Auth::user()->creatorId()
                ]);
            }

            $businessDetail = Business::where('id', $id)->first();
            if ($businessDetail != NULL) {
                $businessDetail['is_custom_html_enabled'] = $request->is_custom_html_enabled == 'on' ? '1' : '0';
                $businessDetail['is_google_map_enabled'] = $request->is_google_map_enabled == 'on' ? '1' : '0';
                $businessDetail['is_svg_enabled'] = $request->is_svg_enabled == 'on' ? '1' : '0';

                $businessDetail->save();
            } else {
                Business::create([
                    'business_id' => $id,
                    'is_enabled' => $request->is_google_map_enabled == 'on' ? '1' : '0',
                    'created_by' => \Auth::user()->creatorId()
                ]);
            }
            $product_data = Product::where('business_id', $id)->first();
            if ($product_data != NULL) {
                $product_data['is_enabled'] = $request->is_product_enabled == 'on' ? '1' : '0';
                $product_data->save();
            } else {
                Product::create([
                    'business_id' => $id,
                    'is_enabled' => $request->is_product_enabled == 'on' ? '1' : '0',
                    'created_by' => \Auth::user()->creatorId()
                ]);
            }
            $cardPayment_data = CardPayment::where('business_id', $id)->first();
            if ($cardPayment_data != NULL) {
                $cardPayment_data['is_enabled'] = $request->is_payment_enabled == 'on' ? '1' : '0';
                $cardPayment_data->save();
            } else {
                CardPayment::create([
                    'business_id' => $id,
                    'payment_amount' => 0,
                    'content' => json_encode([]), // Convert array to JSON string
                    'payment_status' => 'Unpaid',
                    'is_enabled' => $request->is_payment_enabled == 'on' ? '1' : '0',
                    'created_by' => \Auth::user()->creatorId()
                ]);
            }
            $cardapp_data = CardAppinfo::where('business_id', $id)->first();
            if ($cardapp_data != NULL) {
                $cardapp_data['is_enabled'] = $request->is_appinfo_enabled == 'on' ? '1' : '0';
                $cardapp_data->save();
            } else {
                CardAppinfo::create([
                    'business_id' => $id,
                    'is_enabled' => $request->is_appinfo_enabled == 'on' ? '1' : '0',
                    'created_by' => \Auth::user()->creatorId()
                ]);
            }

            $branding = Business::where('id', $id)->first();
            $tab = 4;
            return redirect()->back()->with('success', __('Block Order Successfully Updated.'))->with('tab', $tab);
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }



    public function saveseo(Request $request, $id)
    {
        if (\Auth::user()->can('SEO settings business')) {

            $business = Business::find($id);
            $business->meta_keyword = $request->meta_keyword;
            $business->meta_description = $request->meta_description;
            $business->google_analytic = $request->google_analytic;
            $business->fbpixel_code = $request->fbpixel_code;

            if ($request->hasFile('meta_image')) {
                $image_path1 = 'meta_image/' . $request->company_logo;
                $image_size = $request->file('meta_image')->getSize();
                $result = Utility::updateStorageLimit(\Auth::user()->creatorId(), $image_size);

                if ($result == 1) {
                    $result = Utility::changeStorageLimit(\Auth::user()->creatorId(), $image_path1);
                    $settings = Utility::getStorageSetting();
                    $meta_image = $request->file('meta_image');
                    $ext = $meta_image->getClientOriginalExtension();

                    $fileName = 'meta_image_' . time() . rand() . '.' . $ext;

                    $business->meta_image = $fileName;
                        $dir = 'meta_image/';
                    } else {
                        $dir = 'meta_image/';

                    }
                    $image_path = $dir . $business['meta_image'];
                    if (File::exists($image_path)) {
                        File::delete($image_path);
                    }
                    $path = Utility::upload_file($request, 'meta_image', $fileName, $dir, []);

                    if ($path['flag'] == 1) {
                        $url = $path['url'];
                    } else {
                        return redirect()->route('business.index', \Auth::user()->id)->with('error', __($path['msg']));
                    }
                }
            $business->save();
            $tab = 5;
            return redirect()->back()->with('success', __('SEO Successfully Updated.') . ((isset($result) && $result != 1) ? '<br> <span class="text-danger">' . $result . '</span>' : ''))->with('tab', $tab);

        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function destroyGallery(Request $request)
    {
        $id = $request->business_id;
        $data_id = $request->id;
        // $final_data=[];
        $gallery = Gallery::where('business_id', $id)->first();
        $gallery_details = json_decode($gallery->content);

        // // now, we will search the ID
        $gallery_detailss = [];
        foreach ($gallery_details as $key => $data) {
            // if we found it,
            if ($data->id != $data_id) {
                $gallery_detailss[] = $data;
            }
        }
        $gallery_content = json_encode($gallery_detailss);
        $gallery->content = $gallery_content;
        $gallery->save();
        Session::put(['tab' => 2]);
        return true;

    }

    //Pixels
    public function pixel_create($business_id)
    {
        $pixals_platforms = Utility::pixel_plateforms();
        return view('pixelfield.create', compact('pixals_platforms', 'business_id'));
    }

    public function pixel_store(Request $request)
    {
        if (\Auth::user()->can('pixel settings business')) {
            $request->validate([
                'platform' => 'required',
                'pixel_id' => 'required'
            ]);
            $pixel_fields = new PixelFields();
            $pixel_fields->platform = $request->platform;
            $pixel_fields->pixel_id = $request->pixel_id;
            $pixel_fields->business_id = $request->business_id;
            $pixel_fields->created_by = \Auth::user()->creatorId();
            $pixel_fields->save();
            $tab = 5;
            return redirect()->back()->with('success', __('Pixelfield Created Successfully'))->with('tab', $tab);
        } else {
            return redirect()->back()->with('error', __('permission Denied'));
        }
    }

    public function pixel_edit($business_id,$id)
    {
        $PixelField = PixelFields::where('id', $id)->first();
        return view('pixelfield.edit', compact('pixals_platforms', 'business_id','PixelField'));
    }

    public function pixel_update(Request $request,$id)
    {
        if (\Auth::user()->can('pixel settings business')) {
            $request->validate([
                'platform' => 'required',
                'pixel_id' => 'required'
            ]);
            $pixel_fields = PixelFields::where('id', $id)->first();
            $pixel_fields->platform = $request->platform;
            $pixel_fields->pixel_id = $request->pixel_id;
            $pixel_fields->save();
            $tab = 5;
            return redirect()->back()->with('success', __('Pixelfield Updated Successfully'))->with('tab', $tab);
        } else {
            return redirect()->back()->with('error', __('permission Denied'));
        }
    }

    public function pixeldestroy($id)
    {
        if (\Auth::user()->can('pixel settings business')) {
            $user = \Auth::user();
            $PixelFields = PixelFields::where('id', $id)->first();

            $PixelFields->delete();
            $tab = 5;
            return redirect()->back()->with('success', __('Pixelfield Successfully Deleted'))->with('tab', $tab);
        } else {
            return redirect()->back()->with('error', __('permission Denied'));
        }
    }

    public function savePWA(Request $request, $id)
    {
        if (\Auth::user()->can('PWA settings business')) {
            $business_id = $id;
            $business = Business::find($id);
            $business['enable_pwa_business'] = $request->pwa_business ?? 'off';

            if ($request->pwa_business == 'on') {
                $validator = \Validator::make(
                    $request->all(),
                    [
                        'pwa_app_title' => 'required|max:100',
                        'pwa_app_name' => 'required|max:50',
                        'pwa_app_background_color' => 'required|max:15',
                        'pwa_app_theme_color' => 'required|max:15',
                    ]
                );

                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                $logo1 = Utility::get_file('uploads/logo/');
                $company_favicon = Utility::getValByName('company_favicon');
                $lang = \Auth::user()->lang;

                if ($business['enable_businesslink'] == 'on') {
                    $start_url = env('APP_URL') . '/' . $business['slug'];
                } else if ($business['enable_domain'] == 'on') {
                    $start_url = 'https://' . $business['domains'] . '/';
                } else {
                    $start_url = 'https://' . $business['subdomain'] . '/';
                }

                $mainfest = '{
                                "lang": "' . $lang . '",
                                "name": "' . $request->pwa_app_title . '",
                                "short_name": "' . $request->pwa_app_name . '",
                                "start_url": "' . $start_url . '",
                                "display": "standalone",
                                "background_color": "' . $request->pwa_app_background_color . '",
                                "theme_color": "' . $request->pwa_app_theme_color . '",
                                "orientation": "portrait",
                                "categories": [
                                    "shopping"
                                ],
                                "icons": [
                                    {
                                        "src": "' . $logo1 . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') . '",
                                        "sizes": "128x128",
                                        "type": "image/png",
                                        "purpose": "any"
                                    },
                                    {
                                        "src": "' . $logo1 . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') . '",
                                        "sizes": "144x144",
                                        "type": "image/png",
                                        "purpose": "any"
                                    },
                                    {
                                        "src": "' . $logo1 . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') . '",
                                        "sizes": "152x152",
                                        "type": "image/png",
                                        "purpose": "any"
                                    },
                                    {
                                        "src": "' . $logo1 . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') . '",
                                        "sizes": "192x192",
                                        "type": "image/png",
                                        "purpose": "any"
                                    },
                                    {
                                        "src": "' . $logo1 . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') . '",
                                        "sizes": "256x256",
                                        "type": "image/png",
                                        "purpose": "any"
                                    },
                                    {
                                        "src": "' . $logo1 . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') . '",
                                        "sizes": "512x512",
                                        "type": "image/png",
                                        "purpose": "any"
                                    },
                                    {
                                        "src": "' . $logo1 . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') . '",
                                        "sizes": "1024x1024",
                                        "type": "image/png",
                                        "purpose": "any"
                                    }
                                ]
                            }';


                if (!file_exists('storage/uploads/theme_app/business_' . $business_id)) {
                    mkdir(storage_path('uploads/theme_app/business_' . $business_id), 0777, true);
                }
                if (!file_exists('storage/uploads/theme_app/business_' . $business_id . '/manifest.json')) {
                    fopen('storage/uploads/theme_app/business_' . $business_id . "/manifest.json", "w");
                }
                \File::put('storage/uploads/theme_app/business_' . $business_id . '/manifest.json', $mainfest);
            }

            $business->save();
            $tab = 6;
            return redirect()->back()->with('success', __('PWA Successfully Updated.'))->with('tab', $tab);
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    public function saveCookiesetting(Request $request, $id)
    {
        $count = Business::where('id', $id)->where('created_by', \Auth::user()->creatorId())->count();
        if ($count == 0) {
            return redirect()->route('business.index')->with('error', __('This card number is not yours.'));
        }
        $business = Business::where('id', $id)->first();

        if ($request->enable_cookie && $request->enable_cookie == 'on') {
            $cookieData['cookie_logging'] = $request->cookie_logging;
            $cookieData['cookie_title'] = $request->cookie_title;
            $cookieData['cookie_description'] = $request->cookie_description;
            $cookieData['strictly_cookie_title'] = $request->strictly_cookie_title;
            $cookieData['strictly_cookie_description'] = $request->strictly_cookie_description;
            $cookieData['more_information_description'] = $request->more_information_description;
            $cookieData['contactus_url'] = $request->contactus_url;

            $business = Business::find($id);
            $business->is_gdpr_enabled = $request->enable_cookie;
            $business->gdpr_text = json_encode($cookieData);
            $business->save();
        } else {
            $business->is_gdpr_enabled = $request->enable_cookie;
        }
        $tab = 7;
        return redirect()->back()->with('success', __('Cookie-Setting Successfully Updated.'))->with('tab', $tab);

    }
    public function cardCookieConsent(Request $request)
    {
        $data = Business::where('slug', '=', $request->slug)->first();
        $filename = '';
        $filename = $data->slug . '.csv';
        $settings = json_decode($data->gdpr_text);
        if ($request['cookie']) {
            if ($data->is_gdpr_enabled == "on" && $settings->cookie_logging == "on") {
                $allowed_levels = ['necessary', 'analytics', 'targeting'];
                $levels = array_filter($request['cookie'], function ($level) use ($allowed_levels) {
                    return in_array($level, $allowed_levels);
                });

                $whichbrowser = new \WhichBrowser\Parser($_SERVER['HTTP_USER_AGENT']);
                // Generate new CSV line
                $browser_name = $whichbrowser->browser->name ?? null;
                $os_name = $whichbrowser->os->name ?? null;
                $browser_language = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? mb_substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) : null;
                $device_type = get_device_type($_SERVER['HTTP_USER_AGENT']);

                $ip = $_SERVER['REMOTE_ADDR'];
                //  $ip = '49.36.83.154';
                $query = @unserialize(file_get_contents('http://ip-api.com/php/' . $ip));


                $date = (new \DateTime())->format('Y-m-d');
                $time = (new \DateTime())->format('H:i:s') . ' UTC';


                $new_line = implode(',', [
                    $ip,
                    $date,
                    $time,
                    json_encode($request['cookie']),
                    $device_type,
                    $browser_language,
                    $browser_name,
                    $os_name,
                    isset($query) ? $query['country'] : '',
                    isset($query) ? $query['region'] : '',
                    isset($query) ? $query['regionName'] : '',
                    isset($query) ? $query['city'] : '',
                    isset($query) ? $query['zip'] : '',
                    isset($query) ? $query['lat'] : '',
                    isset($query) ? $query['lon'] : ''
                ]);
                if (!file_exists(storage_path() . '/uploads/sample/data.csv')) {

                    $first_line = 'IP,Date,Time,Accepted cookies,Device type,Browser language,Browser name,OS Name,Country,Region,RegionName,City,Zipcode,Lat,Lon';
                    file_put_contents(storage_path() . '/uploads/sample/' . $filename, $first_line . PHP_EOL, FILE_APPEND | LOCK_EX);
                }
                file_put_contents(storage_path() . '/uploads/sample/' . $filename, $new_line . PHP_EOL, FILE_APPEND | LOCK_EX);

                return response()->json('success');
            }
            return response()->json('error');
        }
        return redirect()->back();
    }

     //Custom Qr code
     public function saveCustomQrsetting(Request $request, $id)
     {
         $business = Businessqr::where('business_id', $id)->first();
         if ($request->hasFile('image')) {
             $fileName1 = isset($business->image) ? $business->image : null;

             $image_path1 = 'qrcode/' . $fileName1;

             $image_size = $request->file('image')->getSize();
             $result = Utility::updateStorageLimit(\Auth::user()->creatorId(), $image_size);
             if ($result == 1) {
                 $result = Utility::changeStorageLimit(\Auth::user()->creatorId(), $image_path1);
                 $settings = Utility::getStorageSetting();
                 $qrcode = $request->file('image');
                 $ext = $qrcode->getClientOriginalExtension();
                 $fileName = 'qrcode' . time() . rand() . '.' . $ext;


                 if ($settings['storage_setting'] == 'local') {
                     $dir = 'qrcode/';
                 } else {
                     $dir = 'qrcode/';

                 }
                 $image_path = $dir . $fileName;
                 if (File::exists($image_path)) {
                     File::delete($image_path);
                 }
                 $path = Utility::upload_file($request, 'image', $fileName, $dir, []);


             }
         }
         if (empty($business)) {
             $business = new Businessqr();

         }

         if (!isset($fileName)) {
             $fileName = isset($business->image) ? $business->image : null;
         }

         $business->business_id = $id;
         $business->foreground_color = isset($request->foreground_color) ? $request->foreground_color : '#000000';
         $business->background_color = isset($request->background_color) ? $request->background_color : '#ffffff';
         $business->radius = isset($request->radius) ? $request->radius : 26;
         $business->qr_type = isset($request->qr_type) ? $request->qr_type : 0;
         $business->qr_text = isset($request->qr_text) ? $request->qr_text : "vCard";
         $business->qr_text_color = isset($request->qr_text_color) ? $request->qr_text_color : '#f50a0a';
         $business->size = isset($request->size) ? $request->size : 9;
         $business->image = isset($fileName) ? $fileName : null;
         $business->save();
         $tab = 8;
         return redirect()->back()->with('success', 'QrCode generated successfully' . ((isset($result) && $result != 1) ? '<br> <span class="text-danger">' . $result . '</span>' : ''))->with('tab', $tab);

     }

    public function ChangeStatus($id)
    {
        $business = Business::find($id);

        if ($business->status == 'locked') {
            $business->status = 'active';
            $business->save();
            return redirect()->back()->with('success', __('Business unlock successfully'));
        } else {
            return redirect()->back()->with('success', __('Business lock successfully'));
        }


    }

    public function adminBusiness($id)
    {

        $businessDetails = Business::where('created_by', $id)->get();
        $totalBusiness = Business::where('created_by', $id)->count();
        $totalBusinessEnable = Business::where('created_by', $id)->where('admin_enable', '=', 'on')->count();
        $totalBusinessDisable = Business::where('created_by', $id)->where('admin_enable', '=', 'off')->count();
        $userDetails = User::where('created_by', $id)->get();
        $totalUser = User::where('created_by', $id)->count();
        $totalUserEnable = User::where('created_by', $id)->where('admin_enable', '=', 'on')->count();
        $totalUserDisable = User::where('created_by', $id)->where('admin_enable', '=', 'off')->count();
        return view('business.businessList', compact('businessDetails', 'totalBusiness', 'totalBusinessEnable', 'totalBusinessDisable', 'userDetails', 'totalUser', 'totalUserEnable', 'totalUserDisable'));
    }
    public function businessEnable(Request $request)
    {
        $data = [];
        $business = Business::find($request->id);

        if ($request->is_disable == 1) {
            $business->admin_enable = 'on';
            $data['msg'] = 'Business is enable.';
        } else {
            $business->admin_enable = 'off';
            $data['msg'] = 'Business is disable.';
        }
        $business->save();
        $totalBusiness = Business::where('created_by', $business->created_by)->count();
        $totalBusinessEnable = Business::where('created_by', $business->created_by)->where('admin_enable', '=', 'on')->count();
        $totalBusinessDisable = Business::where('created_by', $business->created_by)->where('admin_enable', '=', 'off')->count();
        $data['business'] = $business;
        $data['totalBusiness'] = $totalBusiness;
        $data['totalBusinessEnable'] = $totalBusinessEnable;
        $data['totalBusinessDisable'] = $totalBusinessDisable;
        $data['is_success'] = true;
        return $data;
    }

    public function duplicateBusiness($id)
    {
        $max_business = \Auth::user()->getMaxBusiness();
        $count = Business::where('created_by', \Auth::user()->id)->count();
        if ($count < $max_business || $max_business == -1) {

            $business = Business::where('id', $id)->first();
            $user = User::find($business->created_by);
            $plan = Plan::find($user->plan);
            if (!is_null($business)) {
                \App::setLocale($business->getLanguage());
                $businesshours = business_hours::where('business_id', $business->id)->first();
                $appoinment = appoinment::where('business_id', $business->id)->first();
                $services = service::where('business_id', $business->id)->first();
                $products = Product::where('business_id', $business->id)->first();
                $testimonials = testimonial::where('business_id', $business->id)->first();
                $contactinfo = ContactInfo::where('business_id', $business->id)->first();
                $sociallinks = social::where('business_id', $business->id)->first();
                $gallery = gallery::where('business_id', $business->id)->first();

                $PixelFields = PixelFields::where('business_id', $business->id)->get();
                $businessQR = Businessqr::where('business_id', $business->id)->first();
                $cardPayment = CardPayment::where('business_id', $business->id)->first();
                $cardAppinfo = CardAppinfo::where('business_id', $business->id)->first();

                $pixelScript = [];
                foreach ($PixelFields as $pixel) {

                    if (!$pixel->disabled) {
                        $pixelScript[] = pixelSourceCode($pixel['platform'], $pixel['pixel_id']);
                    }
                }
                //business
                $business_new = new Business();
                $business_new->title = $business->title . '_copy';
                $business_new->slug = $business->slug . '_copy';
                $business_new->theme = $business->theme;
                $business_new->password = $business->password;
                $business_new->enable_password = $business->enable_password;
                $business_new->designation = $business->designation;
                $business_new->sub_title = $business->sub_title;
                $business_new->description = $business->description;
                $business_new->card_theme = $business->card_theme;
                $business_new->theme_color = $business->theme_color;
                $business_new->links = $business->links;
                $business_new->status = $business->status;
                $business_new->meta_keyword = $business->meta_keyword;
                $business_new->meta_description = $business->meta_description;
                $business_new->enable_businesslink = $business->enable_businesslink;
                $business_new->enable_subdomain = $business->enable_subdomain;
                $business_new->subdomain = $business->subdomain;
                $business_new->enable_domain = $business->enable_domain;
                $business_new->domains = $business->domains;
                $business_new->google_analytic = $business->google_analytic;
                $business_new->fbpixel_code = $business->fbpixel_code;
                $business_new->google_fonts = $business->google_fonts;
                $business_new->customcss = $business->customcss;
                $business_new->customjs = $business->customjs;
                $business_new->is_custom_html_enabled = $business->is_custom_html_enabled;
                $business_new->custom_html_text = $business->custom_html_text;
                $business_new->is_google_map_enabled = $business->is_google_map_enabled;
                $business_new->google_map_link = $business->google_map_link;
                $business_new->is_svg_enabled=  $business->is_svg_enabled;
                $business_new->svg_text=  $business->svg_text;
                $business_new->is_gdpr_enabled = $business->is_gdpr_enabled;
                $business_new->gdpr_text = $business->gdpr_text;
                $business_new->is_branding_enabled = $business->is_branding_enabled;
                $business_new->branding_text = $business->branding_text;
                $business_new->created_by = \Auth::user()->creatorId();
                $business_new->enable_pwa_business = $business->enable_pwa_business;

                $newMetaImage = 'new_meta_image_' . uniqid() . '.' . pathinfo($business->meta_image, PATHINFO_EXTENSION);
                $newLogo = 'new_logo_' . uniqid() . '.' . pathinfo($business->logo, PATHINFO_EXTENSION);
                $newBanner = 'new_banner_' . uniqid() . '.' . pathinfo($business->banner, PATHINFO_EXTENSION);


                $settings = Utility::getStorageSetting();
                if ($settings['storage_setting'] == 'wasabi') {
                    config([
                        'filesystems.disks.wasabi.key' => $settings['wasabi_key'],
                        'filesystems.disks.wasabi.secret' => $settings['wasabi_secret'],
                        'filesystems.disks.wasabi.region' => $settings['wasabi_region'], // Ensure this value is set in your configuration
                        'filesystems.disks.wasabi.bucket' => $settings['wasabi_bucket'],
                        'filesystems.disks.wasabi.endpoint' => $settings['wasabi_root'], // Ensure this value is set in your configuration
                    ]);
                }
                if ($settings['storage_setting'] == 's3') {
                    config([
                        'filesystems.disks.s3.key' => $settings['s3_key'],
                        'filesystems.disks.s3.secret' => $settings['s3_secret'],
                        'filesystems.disks.s3.region' => $settings['s3_region'], // Ensure this value is set in your configuration
                        'filesystems.disks.s3.bucket' => $settings['s3_bucket'],
                    ]);
                }

                if ($business->meta_image !== null) {
                    // Copy meta image
                    $metaImageContent = Storage::disk($settings['storage_setting'])->get('meta_image/' . $business->meta_image);

                    if ($metaImageContent !== null) {
                        $newMetaImagePath = 'meta_image/' . $newMetaImage;
                        Storage::disk($settings['storage_setting'])->put($newMetaImagePath, Storage::disk($settings['storage_setting'])->get('meta_image/' . $business->meta_image));
                        $business_new->meta_image = $newMetaImage;
                    }
                }
                if ($business->logo !== null) {
                    $logoContent = Storage::disk($settings['storage_setting'])->get('card_logo/' . $business->logo);

                    if ($logoContent !== false) {
                        $newlogoPath = 'card_logo/' . $newLogo;

                        Storage::disk($settings['storage_setting'])->put($newlogoPath, Storage::disk($settings['storage_setting'])->get('card_logo/' . $business->logo));
                        $business_new->logo = $newLogo;
                    }
                }
                if ($business->banner !== null) {
                    // Copy banner
                    $bannerContent = Storage::disk($settings['storage_setting'])->get('card_banner/' . $business->banner);
                    if ($bannerContent !== null) {
                        $newBannerPath = 'card_banner/' . $newBanner;
                        Storage::disk($settings['storage_setting'])->put($newBannerPath, Storage::disk($settings['storage_setting'])->get('card_banner/' . $business->banner));
                        $business_new->banner = $newBanner;
                    }
                }

                $business_new->save();

                if (!empty($services)) {
                    $services_new = new service();
                    $services_new->business_id = $business_new->id;
                    $services_new->content = $services->content;
                    $services_new->is_enabled = $services->is_enabled;
                    $services_new->created_by = $services->created_by;
                    $services_new->save();
                }
                if (!empty($businesshours)) {
                    $business_hours_new = new business_hours();
                    $business_hours_new->business_id = $business_new->id;
                    $business_hours_new->content = $businesshours->content;
                    $business_hours_new->is_enabled = $businesshours->is_enabled;
                    $business_hours_new->created_by = $businesshours->created_by;
                    $business_hours_new->save();
                }
                if (!empty($appoinment)) {
                    $appoinment_new = new appoinment();
                    $appoinment_new->business_id = $business_new->id;
                    $appoinment_new->content = $appoinment->content;
                    $appoinment_new->is_enabled = $appoinment->is_enabled;
                    $appoinment_new->created_by = $appoinment->created_by;
                    $appoinment_new->save();
                }

                if (!empty($testimonials)) {
                    $testimonials_new = new testimonial();
                    $testimonials_new->business_id = $business_new->id;
                    $testimonials_new->content = $testimonials->content;
                    $testimonials_new->is_enabled = $testimonials->is_enabled;
                    $testimonials_new->created_by = $testimonials->created_by;
                    $testimonials_new->save();
                }

                if (!empty($contactinfo)) {
                    $contactinfo_new = new ContactInfo();
                    $contactinfo_new->business_id = $business_new->id;
                    $contactinfo_new->content = $contactinfo->content;
                    $contactinfo_new->is_enabled = $contactinfo->is_enabled;
                    $contactinfo_new->created_by = $contactinfo->created_by;
                    $contactinfo_new->save();
                }
                if (!empty($sociallinks)) {
                    $sociallinks_new = new social();
                    $sociallinks_new->business_id = $business_new->id;
                    $sociallinks_new->content = $sociallinks->content;
                    $sociallinks_new->is_enabled = $sociallinks->is_enabled;
                    $sociallinks_new->created_by = $sociallinks->created_by;
                    $sociallinks_new->save();
                }
                if (!empty($gallery)) {
                    $gallery_new = new gallery();
                    $gallery_new->business_id = $business_new->id;
                    $gallery_new->content = $gallery->content;
                    $gallery_new->is_enabled = $gallery->is_enabled;
                    $gallery_new->created_by = $gallery->created_by;
                    $gallery_new->save();

                }
                if (!empty($products)) {
                    $product_new = new Product();
                    $product_new->business_id = $business_new->id;
                    $product_new->content = $products->content;
                    $product_new->is_enabled = $products->is_enabled;
                    $product_new->created_by = $products->created_by;
                    $product_new->save();
                }

                if (!empty($PixelFields)) {
                    foreach ($PixelFields as $field) {
                        $pixel_fields_new = new PixelFields();
                        $pixel_fields_new->platform = $field->platform;
                        $pixel_fields_new->pixel_id = $field->pixel_id;
                        $pixel_fields_new->business_id = $business_new->id;
                        $pixel_fields_new->created_by = \Auth::user()->creatorId();
                        $pixel_fields_new->save();
                    }
                }
                if (!empty($businessQR)) {
                    $newBusinessqr = $businessQR->replicate();
                    $newBusinessqr->business_id = $business_new->id;
                    $newBusinessqr->save();
                }
                if (!empty($cardPayment)) {
                    $newcardPayment = $cardPayment->replicate();
                    $newcardPayment->business_id = $business_new->id;
                    $newcardPayment->save();
                }
                if (!empty($cardAppinfo)) {
                    $newcardApp = $cardAppinfo->replicate();
                    $newcardApp->business_id = $business_new->id;
                    $newcardApp->save();
                }
                if ($business_new->enable_pwa_business == 'on') {
                    $logo1 = Utility::get_file('uploads/logo/');
                    $company_favicon = Utility::getValByName('company_favicon');
                    $lang = \Auth::user()->lang;

                    if ($business['enable_businesslink'] == 'on') {
                        $start_url = env('APP_URL');
                    } else if ($business['enable_domain'] == 'on') {
                        $start_url = 'https://' . $business_new['domains'] . '/';
                    } else {
                        $start_url = 'https://' . $business_new['subdomain'] . '/';
                    }

                    try {
                        $pwa_data = \File::get(storage_path('uploads/theme_app/business_' . $business->id . '/manifest.json'));
                        $pwa_data = json_decode($pwa_data);
                    } catch (\Throwable $th) {
                        $pwa_data = '';
                    }


                    $mainfest = '{
                                    "lang": "' . $lang . '",
                                    "name": "' . $pwa_data->name . '",
                                    "short_name": "' . $pwa_data->short_name . '",
                                    "start_url": "' . $start_url . '/' . $business_new->slug . '",
                                    "display": "standalone",
                                    "background_color": "' . $pwa_data->background_color . '",
                                    "theme_color": "' . $pwa_data->theme_color . '",
                                    "orientation": "portrait",
                                    "categories": [
                                        "shopping"
                                    ],
                                    "icons": [
                                        {
                                            "src": "' . $logo1 . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') . '",
                                            "sizes": "128x128",
                                            "type": "image/png",
                                            "purpose": "any"
                                        },
                                        {
                                            "src": "' . $logo1 . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') . '",
                                            "sizes": "144x144",
                                            "type": "image/png",
                                            "purpose": "any"
                                        },
                                        {
                                            "src": "' . $logo1 . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') . '",
                                            "sizes": "152x152",
                                            "type": "image/png",
                                            "purpose": "any"
                                        },
                                        {
                                            "src": "' . $logo1 . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') . '",
                                            "sizes": "192x192",
                                            "type": "image/png",
                                            "purpose": "any"
                                        },
                                        {
                                            "src": "' . $logo1 . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') . '",
                                            "sizes": "256x256",
                                            "type": "image/png",
                                            "purpose": "any"
                                        },
                                        {
                                            "src": "' . $logo1 . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') . '",
                                            "sizes": "512x512",
                                            "type": "image/png",
                                            "purpose": "any"
                                        },
                                        {
                                            "src": "' . $logo1 . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') . '",
                                            "sizes": "1024x1024",
                                            "type": "image/png",
                                            "purpose": "any"
                                        }
                                    ]
                                }';


                    if (!file_exists('storage/uploads/theme_app/business_' . $business_new->id)) {
                        mkdir(storage_path('uploads/theme_app/business_' . $business_new->id), 0777, true);
                    }
                    if (!file_exists('storage/uploads/theme_app/business_' . $business_new->id . '/manifest.json')) {
                        fopen('storage/uploads/theme_app/business_' . $business_new->id . "/manifest.json", "w");
                    }
                    \File::put('storage/uploads/theme_app/business_' . $business_new->id . '/manifest.json', $mainfest);
                }
                return redirect()->back()->with('success', __('Business duplicate Successfully'));


            } else {
                return abort('403', 'The Link You Followed Has Expired');
            }
        } else {
            return redirect()->back()->with('error', __('Your user business is over, Please upgrade plan.'));
        }

    }

    public function whatsappShare($id)
    {
        $business = Business::where('id', $id)->first();
        return view('business.whatsappShare', compact('business'));
    }
    public function Viewqrcode($id)
    {
        $business = Business::where('id', $id)->first();
        $qr_detail = Businessqr::where('business_id', $business->id)->first();
        return view('business.viewqr', compact('qr_detail', 'business'));
    }


}
