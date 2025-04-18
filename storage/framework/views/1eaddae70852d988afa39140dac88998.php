<?php
    $url_link = env('APP_URL') . '/' . $business->slug;
?>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="author" content="<?php echo e($business->title); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
<meta name="HandheldFriendly" content="True">

<title><?php echo e($business->title); ?></title>
<meta name="author" content="<?php echo e($business->title); ?>">
<meta name="keywords" content="<?php echo e($business->meta_keyword); ?>">
<meta name="description" content="<?php echo e($business->meta_description); ?>">


<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo e($url_link); ?>">
<meta property="og:title" content="<?php echo e($business->title); ?>">
<meta property="og:description" content="<?php echo e($business->meta_description); ?>">
<meta property="og:image"
    content="<?php echo e(!empty($business->meta_image) ? $meta_tag_image : asset('custom/img/placeholder-image.jpg')); ?>">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="<?php echo e($url_link); ?>">
<meta property="twitter:title" content="<?php echo e($business->title); ?>">
<meta property="twitter:description" content="<?php echo e($business->meta_description); ?>">
<meta property="twitter:image"
    content="<?php echo e(!empty($business->meta_image) ? $meta_tag_image : asset('custom/img/placeholder-image.jpg')); ?>">




<link rel="icon"
    href="<?php echo e($logo1 . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png')); ?>"
    type="image" sizes="16x16">
<link rel="stylesheet" href="<?php echo e(asset('custom/' . $theme . '/libs/@fortawesome/fontawesome-free/css/all.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('custom/' . $theme . '/fonts/stylesheet.css')); ?>">

<?php if($SITE_RTL == 'on'): ?>
    <link rel="stylesheet" href="<?php echo e(asset('custom/' . $theme . '/css/rtl-main-style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('custom/' . $theme . '/css/rtl-responsive.css')); ?>">
<?php else: ?>
    <link rel="stylesheet" href="<?php echo e(asset('custom/' . $theme . '/css/main-style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('custom/' . $theme . '/css/responsive.css')); ?>">
<?php endif; ?>

<link rel="stylesheet" href="<?php echo e(asset('custom/css/emojionearea.min.css')); ?>">
<?php if(isset($is_slug)): ?>
    <link rel='stylesheet' href='<?php echo e(asset('css/cookieconsent.css')); ?>' media="screen" />
    <style type="text/css">
        <?php echo e($business->customcss); ?>

    </style>
<?php endif; ?>

<?php if($business->google_fonts != 'Default' && isset($business->google_fonts)): ?>
    <style>
        @import url('<?php echo e(\App\Models\Utility::getvalueoffont($business->google_fonts)['link']); ?>');

        :root {
            --first-font: <?php echo e(strtok(\App\Models\Utility::getvalueoffont($business->google_fonts)['fontfamily'], ',')); ?>;
            --second-font: <?php echo e(strtok(\App\Models\Utility::getvalueoffont($business->google_fonts)['fontfamily'], ',')); ?>;
        }
    </style>
<?php endif; ?>

<?php if(!$themeName): ?>
<style>
    :root {
        --theme-color: <?php echo e($business->theme_color ?? '#000000'); ?>;
    }
</style>
<?php endif; ?>



<meta name="mobile-wep-app-capable" content="yes">
<meta name="apple-mobile-wep-app-capable" content="yes">
<meta name="msapplication-starturl" content="/">
<link rel="apple-touch-icon"
    href="<?php echo e($logo1 . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png')); ?>" />

<?php if($business->enable_pwa_business == 'on' && $plan->pwa_business == 'on'): ?>
    <link rel="manifest"
        href="<?php echo e(asset('storage/uploads/theme_app/business_' . $business->id . '/manifest.json')); ?>" />
<?php endif; ?>
<?php if(!empty($business->pwa_business($business->slug)->theme_color)): ?>
    <meta name="theme-color" content="<?php echo e($business->pwa_business($business->slug)->theme_color); ?>" />
<?php endif; ?>
<?php if(!empty($business->pwa_business($business->slug)->background_color)): ?>
    <meta name="apple-mobile-web-app-status-bar"
        content="<?php echo e($business->pwa_business($business->slug)->background_color); ?>" />
<?php endif; ?>

<?php $__currentLoopData = $pixelScript; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $script): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?= $script ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/card/header.blade.php ENDPATH**/ ?>