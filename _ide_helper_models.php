<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Coingate{
/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coingate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coingate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coingate query()
 */
	class Coingate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $business_id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $date
 * @property string|null $time
 * @property string $status
 * @property string|null $note
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment_deatail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment_deatail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment_deatail query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment_deatail whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment_deatail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment_deatail whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment_deatail whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment_deatail whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment_deatail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment_deatail whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment_deatail whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment_deatail wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment_deatail whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment_deatail whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment_deatail whereUpdatedAt($value)
 */
	class Appointment_deatail extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $slug
 * @property string|null $theme
 * @property string|null $title
 * @property int|null $business_category
 * @property string|null $password
 * @property string|null $enable_password
 * @property string|null $designation
 * @property string|null $sub_title
 * @property string|null $description
 * @property string|null $banner
 * @property string|null $logo
 * @property string|null $card_theme
 * @property string|null $theme_color
 * @property string|null $links
 * @property string $status
 * @property string|null $meta_keyword
 * @property string|null $meta_description
 * @property string|null $meta_image
 * @property string|null $enable_businesslink
 * @property string|null $enable_subdomain
 * @property string|null $subdomain
 * @property string $enable_domain
 * @property string|null $domains
 * @property string|null $google_analytic
 * @property string|null $fbpixel_code
 * @property string|null $customjs
 * @property string|null $customcss
 * @property string|null $is_custom_html_enabled
 * @property string|null $custom_html_text
 * @property string|null $is_gdpr_enabled
 * @property string|null $gdpr_text
 * @property string|null $is_branding_enabled
 * @property string|null $branding_text
 * @property string|null $google_fonts
 * @property string $enable_pwa_business
 * @property string $admin_enable
 * @property string $directory_status
 * @property string|null $is_google_map_enabled
 * @property string|null $google_map_link
 * @property string|null $is_svg_enabled
 * @property string|null $svg_text
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $company_logo
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $email
 * @property string|null $website
 * @property string|null $card_bg_color
 * @property string|null $button_bg_color
 * @property string|null $card_text_color
 * @property string|null $button_text_color
 * @property string|null $google_review_link
 * @property int|null $google_review_enabled
 * @property int $is_lead_direct_download_enabled
 * @property int $is_auto_contact_popup_enabled
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Campaigns> $campaigns
 * @property-read int|null $campaigns_count
 * @property-read \App\Models\ShareContactField|null $shareContactField
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereAdminEnable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereBanner($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereBrandingText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereBusinessCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereButtonBgColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereButtonTextColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereCardBgColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereCardTextColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereCardTheme($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereCompanyLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereCustomHtmlText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereCustomcss($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereCustomjs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereDesignation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereDirectoryStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereDomains($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereEnableBusinesslink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereEnableDomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereEnablePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereEnablePwaBusiness($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereEnableSubdomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereFbpixelCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereGdprText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereGoogleAnalytic($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereGoogleFonts($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereGoogleMapLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereGoogleReviewEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereGoogleReviewLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereIsAutoContactPopupEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereIsBrandingEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereIsCustomHtmlEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereIsGdprEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereIsGoogleMapEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereIsLeadDirectDownloadEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereIsSvgEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereLinks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereMetaImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereMetaKeyword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereSubTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereSubdomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereSvgText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereTheme($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereThemeColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Business whereWebsite($value)
 */
	class Business extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $business_id
 * @property string $type
 * @property string|null $source
 * @property string|null $category
 * @property string $created_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessAnalytics newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessAnalytics newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessAnalytics query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessAnalytics whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessAnalytics whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessAnalytics whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessAnalytics whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessAnalytics whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessAnalytics whereType($value)
 */
	class BusinessAnalytics extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $logo
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessCategory whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessCategory whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusinessCategory whereUpdatedAt($value)
 */
	class BusinessCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $icon
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Businessfield newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Businessfield newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Businessfield query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Businessfield whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Businessfield whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Businessfield whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Businessfield whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Businessfield whereUpdatedAt($value)
 */
	class Businessfield extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $business_id
 * @property string|null $foreground_color
 * @property string|null $background_color
 * @property string|null $radius
 * @property string|null $qr_type
 * @property string|null $qr_text
 * @property string|null $qr_text_color
 * @property string|null $image
 * @property string|null $size
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Businessqr newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Businessqr newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Businessqr query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Businessqr whereBackgroundColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Businessqr whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Businessqr whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Businessqr whereForegroundColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Businessqr whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Businessqr whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Businessqr whereQrText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Businessqr whereQrTextColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Businessqr whereQrType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Businessqr whereRadius($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Businessqr whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Businessqr whereUpdatedAt($value)
 */
	class Businessqr extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $user
 * @property int|null $category
 * @property int|null $business
 * @property int|null $total_days
 * @property float|null $total_cost
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $payment_method
 * @property int $status
 * @property int|null $approval
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Business|null $businesses
 * @property-read \App\Models\BusinessCategory|null $categories
 * @property-read \App\Models\User|null $users
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaigns newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaigns newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaigns query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaigns whereApproval($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaigns whereBusiness($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaigns whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaigns whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaigns whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaigns whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaigns whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaigns whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaigns wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaigns whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaigns whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaigns whereTotalCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaigns whereTotalDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaigns whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaigns whereUser($value)
 */
	class Campaigns extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $business_id
 * @property string|null $playstore_id
 * @property string|null $appstore_id
 * @property string|null $variant
 * @property int|null $is_enabled
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CardAppinfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CardAppinfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CardAppinfo query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CardAppinfo whereAppstoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CardAppinfo whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CardAppinfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CardAppinfo whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CardAppinfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CardAppinfo whereIsEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CardAppinfo wherePlaystoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CardAppinfo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CardAppinfo whereVariant($value)
 */
	class CardAppinfo extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $business_id
 * @property float $payment_amount
 * @property string|null $content
 * @property string|null $payment_status
 * @property string|null $payment_type
 * @property int|null $is_enabled
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CardPayment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CardPayment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CardPayment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CardPayment whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CardPayment whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CardPayment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CardPayment whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CardPayment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CardPayment whereIsEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CardPayment wherePaymentAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CardPayment wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CardPayment wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CardPayment whereUpdatedAt($value)
 */
	class CardPayment extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $business_id
 * @property string|null $content
 * @property int|null $is_enabled
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInfo whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInfo whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInfo whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInfo whereIsEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInfo whereUpdatedAt($value)
 */
	class ContactInfo extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $business_id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $message
 * @property string $status
 * @property string|null $note
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $company
 * @property string|null $job_title
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contacts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contacts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contacts query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contacts whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contacts whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contacts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contacts whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contacts whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contacts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contacts whereJobTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contacts whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contacts whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contacts whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contacts wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contacts whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contacts whereUpdatedAt($value)
 */
	class Contacts extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $min
 * @property int|null $max
 * @property float|null $price
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CostSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CostSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CostSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CostSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CostSetting whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CostSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CostSetting whereMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CostSetting whereMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CostSetting wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CostSetting whereUpdatedAt($value)
 */
	class CostSetting extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string|null $type
 * @property int|null $minimum_spend
 * @property int|null $maximum_spend
 * @property string $code
 * @property float $discount
 * @property int $limit
 * @property int|null $per_user_limit
 * @property string|null $expiry_date
 * @property string|null $description
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereExpiryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereMaximumSpend($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereMinimumSpend($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon wherePerUserLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereUpdatedAt($value)
 */
	class Coupon extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $business_id
 * @property string|null $domain_name
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Business|null $business
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DomainRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DomainRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DomainRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DomainRequest whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DomainRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DomainRequest whereDomainName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DomainRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DomainRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DomainRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DomainRequest whereUserId($value)
 */
	class DomainRequest extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string|null $from
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailTemplate whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailTemplate whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailTemplate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailTemplate whereUpdatedAt($value)
 */
	class EmailTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $parent_id
 * @property string $lang
 * @property string $subject
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailTemplateLang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailTemplateLang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailTemplateLang query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailTemplateLang whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailTemplateLang whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailTemplateLang whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailTemplateLang whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailTemplateLang whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailTemplateLang whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailTemplateLang whereUpdatedAt($value)
 */
	class EmailTemplateLang extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $business_id
 * @property string|null $content
 * @property int|null $is_enabled
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $is_video_enabled
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereIsEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereIsVideoEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereUpdatedAt($value)
 */
	class Gallery extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $section_name
 * @property int $section_order
 * @property string|null $content
 * @property string $section_type
 * @property string $default_content
 * @property string $section_demo_image
 * @property string $section_blade_file_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPageSection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPageSection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPageSection query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPageSection whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPageSection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPageSection whereDefaultContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPageSection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPageSection whereSectionBladeFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPageSection whereSectionDemoImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPageSection whereSectionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPageSection whereSectionOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPageSection whereSectionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPageSection whereUpdatedAt($value)
 */
	class LandingPageSection extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $code
 * @property string $fullName
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Languages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Languages newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Languages query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Languages whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Languages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Languages whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Languages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Languages whereUpdatedAt($value)
 */
	class Languages extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $ip
 * @property string|null $date
 * @property string|null $details
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginDetail whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginDetail whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginDetail whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginDetail whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoginDetail whereUserId($value)
 */
	class LoginDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $card_name
 * @property float $price
 * @property string|null $image
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NFCCard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NFCCard newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NFCCard query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NFCCard whereCardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NFCCard whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NFCCard whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NFCCard whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NFCCard whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NFCCard wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NFCCard whereUpdatedAt($value)
 */
	class NFCCard extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $order_id
 * @property int|null $nfc_card_id
 * @property int|null $business_id
 * @property int $quantity
 * @property float $price
 * @property string $status
 * @property int|null $user_id
 * @property int|null $approval
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderRequest whereApproval($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderRequest whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderRequest whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderRequest whereNfcCardId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderRequest whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderRequest wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderRequest whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderRequest whereUserId($value)
 */
	class OrderRequest extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereUpdatedAt($value)
 */
	class Permission extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $business_id
 * @property string|null $platform
 * @property string|null $pixel_id
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PixelFields newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PixelFields newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PixelFields query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PixelFields whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PixelFields whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PixelFields whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PixelFields whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PixelFields wherePixelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PixelFields wherePlatform($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PixelFields whereUpdatedAt($value)
 */
	class PixelFields extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property float $price
 * @property string $duration
 * @property string|null $themes
 * @property int $business
 * @property int $max_users
 * @property string|null $description
 * @property string $enable_custdomain
 * @property string $enable_custsubdomain
 * @property string $enable_branding
 * @property string $pwa_business
 * @property string $enable_chatgpt
 * @property float $storage_limit
 * @property string|null $is_trial
 * @property int $trial_day
 * @property string $is_plan_enable
 * @property string|null $module
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereBusiness($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereEnableBranding($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereEnableChatgpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereEnableCustdomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereEnableCustsubdomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereIsPlanEnable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereIsTrial($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereMaxUsers($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereModule($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan wherePwaBusiness($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereStorageLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereThemes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereTrialDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereUpdatedAt($value)
 */
	class Plan extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $order_id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $card_number
 * @property string|null $card_exp_month
 * @property string|null $card_exp_year
 * @property string $plan_name
 * @property int $plan_id
 * @property float $price
 * @property string $price_currency
 * @property string $txn_id
 * @property string $payment_status
 * @property string|null $receipt
 * @property int $user_id
 * @property int $store_id
 * @property string|null $payment_type
 * @property int $is_refund
 * @property string $order_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\UserCoupon|null $total_coupon_used
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlanOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlanOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlanOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlanOrder whereCardExpMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlanOrder whereCardExpYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlanOrder whereCardNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlanOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlanOrder whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlanOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlanOrder whereIsRefund($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlanOrder whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlanOrder whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlanOrder whereOrderType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlanOrder wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlanOrder wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlanOrder wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlanOrder wherePlanName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlanOrder wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlanOrder wherePriceCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlanOrder whereReceipt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlanOrder whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlanOrder whereTxnId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlanOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PlanOrder whereUserId($value)
 */
	class PlanOrder extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $business_id
 * @property string|null $content
 * @property int|null $is_enabled
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereIsEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereUpdatedAt($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $type
 * @property string|null $json
 * @property int|null $total_scan
 * @property int|null $template_id
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QRSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QRSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QRSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QRSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QRSetting whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QRSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QRSetting whereJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QRSetting whereTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QRSetting whereTotalScan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QRSetting whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QRSetting whereUpdatedAt($value)
 */
	class QRSetting extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $commision
 * @property int|null $threshold_amount
 * @property string|null $guidelines
 * @property int|null $is_enable
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferralSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferralSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferralSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferralSetting whereCommision($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferralSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferralSetting whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferralSetting whereGuidelines($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferralSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferralSetting whereIsEnable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferralSetting whereThresholdAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferralSetting whereUpdatedAt($value)
 */
	class ReferralSetting extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $plan_id
 * @property string $plan_price
 * @property int $commission
 * @property int $referral_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferralTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferralTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferralTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferralTransaction whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferralTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferralTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferralTransaction wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferralTransaction wherePlanPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferralTransaction whereReferralCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferralTransaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferralTransaction whereUserId($value)
 */
	class ReferralTransaction extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $business_id
 * @property int $is_name_required
 * @property int $is_name_enabled
 * @property int $is_phone_required
 * @property int $is_phone_enabled
 * @property int $is_email_required
 * @property int $is_email_enabled
 * @property int $is_company_required
 * @property int $is_company_enabled
 * @property int $is_job_title_required
 * @property int $is_job_title_enabled
 * @property int $is_notes_required
 * @property int $is_notes_enabled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShareContactField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShareContactField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShareContactField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShareContactField whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShareContactField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShareContactField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShareContactField whereIsCompanyEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShareContactField whereIsCompanyRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShareContactField whereIsEmailEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShareContactField whereIsEmailRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShareContactField whereIsJobTitleEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShareContactField whereIsJobTitleRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShareContactField whereIsNameEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShareContactField whereIsNameRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShareContactField whereIsNotesEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShareContactField whereIsNotesRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShareContactField whereIsPhoneEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShareContactField whereIsPhoneRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShareContactField whereUpdatedAt($value)
 */
	class ShareContactField extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $template_name
 * @property string $prompt
 * @property string $module
 * @property string $field_json
 * @property int $is_tone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Template newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Template newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Template query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Template whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Template whereFieldJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Template whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Template whereIsTone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Template whereModule($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Template wherePrompt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Template whereTemplateName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Template whereUpdatedAt($value)
 */
	class Template extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $request_amount
 * @property int $request_user_id
 * @property int $status
 * @property string|null $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TransactionOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TransactionOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TransactionOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TransactionOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TransactionOrder whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TransactionOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TransactionOrder whereRequestAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TransactionOrder whereRequestUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TransactionOrder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TransactionOrder whereUpdatedAt($value)
 */
	class TransactionOrder extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property string|null $remember_token
 * @property string|null $lang
 * @property int|null $current_business
 * @property string|null $avatar
 * @property string $type
 * @property int $plan
 * @property string|null $plan_expire_date
 * @property int $requested_plan
 * @property int $created_by
 * @property string $mode
 * @property int $plan_is_active
 * @property float $storage_limit
 * @property int $is_enable_login
 * @property string $is_trial_plan
 * @property string|null $trial_expire_date
 * @property string $admin_enable
 * @property string|null $active_module
 * @property int $referral_code
 * @property int $used_referral_code
 * @property int $commission_amount
 * @property string|null $google2fa_secret
 * @property int $google2fa_enable
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Plan|null $currentPlan
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereActiveModule($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereAdminEnable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCommissionAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCurrentBusiness($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereGoogle2faEnable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereGoogle2faSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIsEnableLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIsTrialPlan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePlan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePlanExpireDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePlanIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereReferralCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRequestedPlan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereStorageLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTrialExpireDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUsedReferralCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutRole($roles, $guard = null)
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user
 * @property int $coupon
 * @property string|null $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Coupon|null $coupon_detail
 * @property-read \App\Models\User|null $userDetail
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCoupon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCoupon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCoupon query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCoupon whereCoupon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCoupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCoupon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCoupon whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCoupon whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCoupon whereUser($value)
 */
	class UserCoupon extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $template_id
 * @property int $user_id
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEmailTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEmailTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEmailTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEmailTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEmailTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEmailTemplate whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEmailTemplate whereTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEmailTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEmailTemplate whereUserId($value)
 */
	class UserEmailTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Utility newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Utility newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Utility query()
 */
	class Utility extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $module
 * @property string $method
 * @property string $url
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Webhook newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Webhook newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Webhook query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Webhook whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Webhook whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Webhook whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Webhook whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Webhook whereModule($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Webhook whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Webhook whereUrl($value)
 */
	class Webhook extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $business_id
 * @property string|null $content
 * @property int|null $is_enabled
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|appoinment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|appoinment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|appoinment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|appoinment whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|appoinment whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|appoinment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|appoinment whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|appoinment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|appoinment whereIsEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|appoinment whereUpdatedAt($value)
 */
	class appoinment extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $business_id
 * @property string|null $content
 * @property int|null $is_enabled
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|business_hours newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|business_hours newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|business_hours query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|business_hours whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|business_hours whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|business_hours whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|business_hours whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|business_hours whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|business_hours whereIsEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|business_hours whereUpdatedAt($value)
 */
	class business_hours extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $plan_id
 * @property string $duration
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Plan|null $plan
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|plan_request newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|plan_request newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|plan_request query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|plan_request whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|plan_request whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|plan_request whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|plan_request wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|plan_request whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|plan_request whereUserId($value)
 */
	class plan_request extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $business_id
 * @property string|null $content
 * @property int|null $is_enabled
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|service newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|service newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|service query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|service whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|service whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|service whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|service whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|service whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|service whereIsEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|service whereUpdatedAt($value)
 */
	class service extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $business_id
 * @property string|null $content
 * @property int|null $is_enabled
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|social newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|social newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|social query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|social whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|social whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|social whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|social whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|social whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|social whereIsEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|social whereUpdatedAt($value)
 */
	class social extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $business_id
 * @property string|null $content
 * @property int|null $is_enabled
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|testimonial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|testimonial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|testimonial query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|testimonial whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|testimonial whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|testimonial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|testimonial whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|testimonial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|testimonial whereIsEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|testimonial whereUpdatedAt($value)
 */
	class testimonial extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $module
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|userActiveModule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|userActiveModule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|userActiveModule query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|userActiveModule whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|userActiveModule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|userActiveModule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|userActiveModule whereModule($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|userActiveModule whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|userActiveModule whereUserId($value)
 */
	class userActiveModule extends \Eloquent {}
}

