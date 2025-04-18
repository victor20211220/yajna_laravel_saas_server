<?php
    use App\Models\Utility;
    $logo=\App\Models\Utility::get_file('uploads/logo/');
    $company_favicon=Utility::getValByName('company_favicon');
    $setting = App\Models\Utility::settings();

?>

<head>

    <title><?php echo e((Utility::getValByName('title_text')) ? Utility::getValByName('title_text') : config('app.name', 'vCardGo SaaS')); ?> - <?php echo $__env->yieldContent('page-title'); ?></title>

    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->

    <meta charset="utf-8"  />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Dashboard Template Description" />
    <meta name="keywords" content="Dashboard Template" />
    <meta name="author" content="Workdo" />

    <!-- Favicon icon -->
    <?php if(Auth::user()->type == 'super admin'): ?>
        <link rel="icon" href="<?php echo e($logo.'/favicon.png'); ?>" type="image" sizes="16x16">
    <?php else: ?>
        <link rel="icon" href="<?php echo e($logo . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png'. '?' . time())); ?>" type="image" sizes="16x16">
    <?php endif; ?>

    <!-- font css -->

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/main.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/animate.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/tabler-icons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/feather.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/fontawesome.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/material.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('custom/libs/summernote/summernote-bs4.css')); ?>">
     <?php echo $__env->yieldPushContent('css-page'); ?>

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/style.css')); ?>" >

    <!-- vendor css -->
    <?php if($setting['SITE_RTL'] =='on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-rtl.css')); ?>" id="main-style-link">
    <?php else: ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>" >
    <?php endif; ?>
    <?php if(isset($cust_darklayout) && $cust_darklayout=='on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-dark.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/custom-dark.css')); ?>" id="main-style-link">
    <?php endif; ?>

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/customizer.css')); ?>">
     <!-- custom css -->
     <link rel="stylesheet" href="<?php echo e(asset('assets/css/custom.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('custom/css/emojionearea.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('custom/css/custom.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/bootstrap-switch-button.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/choices.min.css')); ?>">
</head>


<?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/partials/admin/header.blade.php ENDPATH**/ ?>