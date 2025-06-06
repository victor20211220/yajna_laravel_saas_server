<?php

namespace App\Models;

use App\Models\User;
use App\Models\Campaigns;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Business extends Model
{
    private static $businessDetailModal = null;
    private static $businessDetail = null;
    private static $businessSlugData = null;

    protected $fillable = [
        'slug',
        'title',
        'business_category',
        'designation',
        'sub_title',
        'description',
        'branding_text',
        'banner',
        'logo',
        'card_theme',
        'theme_color',
        'links',
        'meta_keyword',
        'meta_description',
        'meta_image',
        'domains',
        'enable_businesslink',
        'subdomain',
        'enable_domain',
        'created_by'
    ];

    public function campaigns()
    {
        return $this->belongsToMany(Campaigns::class, 'business');
    }

    public function getLanguage()
    {
        if (\Auth::user()->type == 'company') {

            $user = User::find($this->created_by);
        } else {

            $user = User::where('created_by', '=', $this->created_by)->first();

        }
        return $user->currentLanguage();

    }

    public static function pwa_business($slug)
    {

        $business = self::getBusinessBySlug($slug);
        try {

            $pwa_data = \File::get(storage_path('uploads/theme_app/business_' . $business->id . '/manifest.json'));

            $pwa_data = json_decode($pwa_data);
        } catch (\Throwable $th) {
            $pwa_data = [];
        }
        return $pwa_data;

    }

    public static function allBusiness()
    {
        if (self::$businessDetailModal == null) {
            $businesses = self::getBusiness();

            $business = $businesses->map(function ($business) {
                return [
                    'id' => $business->id,
                    'title' => $business->title,
                    'admin_enable' => $business->admin_enable,
                ];
            });

            if (request()->route()->getName() == 'appointments.index' || request()->route()->getName() == 'contacts.index') {
                $business->prepend(['id' => '0', 'title' => 'All', 'admin_enable' => 'on']);
            }
            self::$businessDetailModal = $business;
        }


        return self::$businessDetailModal;
    }

    public static function card_cookie($slug)
    {
        $data = self::getBusinessBySlug($slug);
        return $data->gdpr_text;
    }

    public static $qr_type = [
        0 => 'Normal',
        4 => 'Image',
    ];

    public static function getBusiness()
    {
        if (self::$businessDetail == null) {
            $business = Business::where('created_by', \Auth::user()->creatorId())->get();
            self::$businessDetail = $business;
        }
        return self::$businessDetail;
    }

    public static function getBusinessBySlug($slug)
    {
        if (self::$businessSlugData == null) {
            $data = Business::where('slug', '=', $slug)->first();
            self::$businessSlugData = $data;
        }
        return self::$businessSlugData;
    }

    // for enable disable
    public static function EnableOrNot($var1 = null, $var2 = null)
    {
        $a = false;

        if (!is_null($var1) && !is_null($var2)) {
            $a = $var1['is_enabled'] == '1' ? true : false;
        }

        return $a;
    }

    // app/Models/Business.php

    public function shareContactField()
    {
        return $this->hasOne(ShareContactField::class);
    }

    protected $with = ['shareContactField'];

}
