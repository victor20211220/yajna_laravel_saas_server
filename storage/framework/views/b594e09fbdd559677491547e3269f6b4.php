<?php
    use App\Models\Utility;
    $card_theme = json_decode($business->card_theme);
    // dd($card_theme);
    $content = json_decode($business->content);
    $no = 1;
    $social_no = 1;
    $stringid = $business->id;
    $appointment_no = 0;
    $service_row_no = 0;
    $testimonials_row_no = 0;
    $gallery_row_no = 0;
    $product_row_no = 0;

    $is_preview_bussiness_hour = 'false';
    $banner = \App\Models\Utility::get_file('card_banner');
    $logo = \App\Models\Utility::get_file('card_logo');
    $image = \App\Models\Utility::get_file('testimonials_images');
    $s_image = \App\Models\Utility::get_file('service_images');
    $pr_image = \App\Models\Utility::get_file('product_images');
    $meta_image = \App\Models\Utility::get_file('meta_image');
    $gallery_path= \App\Models\Utility::get_file('gallery');
    $SITE_RTL = \App\Models\Utility::settings()['SITE_RTL'];
    $chatgpt_setting= \App\Models\Utility::chatgpt_setting(\Auth::user()->creatorId());
    $qr_path = \App\Models\Utility::get_file('qrcode');

    $users = \Auth::user();
    $businesses = \App\Models\Business::allBusiness();
    $currantBusiness = $users->currentBusiness();
    $bussiness_id = $users->current_business;

?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('custom/libs/dropzonejs/dropzone.css')); ?>">
    <style>
        @import url(<?php echo e(asset('css/font-awesome.css')); ?>);

        .image {
            position: relative;
        }

        .image .actions {
            right: 1em;
            top: 1em;
            display: block;
            position: absolute;
        }

        .image .actions a {
            display: inline-block;
        }

    </style>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Edit Business')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Business Information')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('business.index')); ?>"><?php echo e(__('Business')); ?></a>
    </li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Business Edit')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
<?php if($business->status != 'lock'): ?>
    <div class="d-flex align-items-center gap-2 header-info-btn-wrapper">
        <a href="#" data-size="md" data-url="<?php echo e(route('business.whatsapp',$business->id)); ?>" data-ajax-popup="true"
            data-bs-toggle="tooltip" title="<?php echo e(__('Whatsapp Share')); ?>" data-title="<?php echo e(__('Whatsapp Number')); ?>"
            class="btn btn-sm btn-primary  "><i
            class="ti ti-brand-whatsapp text-white"></i></a>

        </a>
        <a href="#"
                class="btn btn-sm bg-light-blue-subtitle align-items-center cp_link"
                data-link="<?php echo e(route('get.vcard',[$business->slug])); ?>" data-bs-placement="top" data-bs-toggle="tooltip"
                data-bs-original-title="<?php echo e(__('Click to copy card link')); ?>">  <i
                        class="ti ti-link text-white"></i></a>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view analytics business')): ?>
        <a href="<?php echo e(route('business.analytics', $business->id)); ?>"
            class="btn btn-sm bg-blue-subtitle  align-items-center"
            data-bs-toggle="tooltip" data-bs-placement="top"
            data-bs-original-title="<?php echo e(__('Business Analytics')); ?>">  <i
                    class="ti ti-brand-google-analytics   text-white"></i></a>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('calendar appointment')): ?>
        <a href="<?php echo e(route('appointment.calendar', $business->id)); ?>"
            class=" btn btn-sm  bg-light-green-subtitle  align-items-center"
            data-bs-toggle="tooltip" data-bs-placement="top"
            data-bs-original-title="<?php echo e(__('Business Calender')); ?>">  <i
                    class="ti ti-calendar text-white"></i></a>
        <?php endif; ?>
        <div>
            <div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="<?php echo e(__('Qr Code')); ?>">
                <a class="btn btn-sm bg-warning-subtle btn-icon" data-bs-toggle="modal"  data-bs-target="#qrcodeModal" id="download-qr"
                target="_blanks" >
                <span class="text-white"><i class="fa fa-qrcode"></i></span>
            </a>
        </div>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage contact')): ?>
        <a href="<?php echo e(route('business.contacts.show', $business->id)); ?>"
            class="btn-primary-subtle btn btn-sm align-items-center"
            data-bs-toggle="tooltip" data-bs-placement="top"
            data-bs-original-title="<?php echo e(__('Business Contacts')); ?>">  <i
                    class="ti ti-phone  text-white"></i></a>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete business')): ?>
        <div>
            <a href="#"
                class="bs-pass-para bg-danger btn btn-sm align-items-center"
                data-confirm="<?php echo e(__('Are You Sure?')); ?>" data-bs-placement="top"
                data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                data-confirm-yes="delete-form-<?php echo e($business->id); ?>"
                title="<?php echo e(__('Delete')); ?>" data-bs-toggle="tooltip"
                ><i class="ti ti-trash text-white"></i></a>

        <?php echo Form::open([
            'method' => 'DELETE',
            'route' => ['business.destroy', $business->id],
            'id' => 'delete-form-' . $business->id,
            'class' => 'needs-validation', 'novalidate'
        ]); ?>

        <?php echo Form::close(); ?>

        </div>
        <?php endif; ?>
        <div class="d-flex align-items-center gap-2">
            <a href="<?php echo e(route('get.card', $business->slug)); ?>" class="btn btn-sm btn-info btn-icon" data-bs-toggle="tooltip"
                data-bs-original-title="<?php echo e(__('Download')); ?>" title="<?php echo e(__('Download')); ?>" target="_blanks" data-bs-placement="top">
                <span class="text-white"><i class="ti ti-download"></i></span>
            </a>

            <a class="btn btn-sm btn-warning btn-icon ml-0" data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-original-title="<?php echo e(__('Preview')); ?>" href="<?php echo e(route('get.vcard',[$business->slug])); ?>" target="-blank" ><span
                    class="text-white"><i class="ti ti-eye"></i></span></a>
        </div>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <!-- [ Main Content ] start -->
        <!-- [ breadcrumb ] start -->
        <div class="page-header pt-3">
            <div class="page-block">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    
                    <ul class="list-unstyled business-list business-header mb-0">
                        <li class="dropdown dash-h-item drp-language">
                            <a class="dash-head-link dropdown-toggle arrow-none mx-0 cust-btn"
                                data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-original-title="<?php echo e(__('Select your bussiness')); ?>">
                                <i class="ti ti-apps"></i>
                                <span class="drp-text hide-mob"><?php echo e(__(ucfirst($currantBusiness))); ?></span>
                                <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                            </a>
                            <div class="dropdown-menu dash-h-dropdown  page-inner-dropdowm dashborad-drap">
                                <?php $__currentLoopData = $businesses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $businessData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($businessData['admin_enable']=='on'): ?>
                                        <a href="<?php echo e(route('business.edit', $businessData['id'])); ?>" class="dropdown-item">
                                            <i
                                                class="<?php if($bussiness_id == $businessData['id']): ?> ti ti-checks text-primary <?php elseif($currantBusiness == $businessData['title']): ?> ti ti-checks text-primary <?php endif; ?> "></i>
                                            <span><?php echo e(ucfirst($businessData['title'])); ?></span>
                                        </a>
                                    <?php else: ?>
                                        <a href="#" class="dropdown-item">
                                            <i class="ti ti-lock"></i>
                                            <span class="row-disabled"><?php echo e(ucfirst($businessData['title'])); ?></span>
                                        </a>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                        </li>
                    </ul>
                    
                    <ul class="nav nav-pills nav-fill information-tab" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php if(!session('tab') or (session('tab') and session('tab') == 1)): ?> active <?php endif; ?>" id="theme-setting-tab" data-bs-toggle="pill"
                                data-bs-target="#theme-setting" type="button"><?php echo e(__('Theme')); ?></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php if(session('tab') and session('tab') == 2): ?> active <?php endif; ?>" id="details-setting-tab" data-bs-toggle="pill"
                                data-bs-target="#details-setting" type="button"><?php echo e(__('Details')); ?></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php if(session('tab') and session('tab') == 3): ?> active <?php endif; ?>" id="domain-setting-tab" data-bs-toggle="pill"
                                data-bs-target="#domain-setting" type="button"><?php echo e(__('Custom')); ?></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php if(session('tab') and session('tab') == 4): ?> active <?php endif; ?>" id="block-setting-tab" data-bs-toggle="pill"
                                data-bs-target="#block-setting" type="button"><?php echo e(__('Reorder Blocks')); ?></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php if(session('tab') and session('tab') == 5): ?> active <?php endif; ?>" id="seo-setting-tab" data-bs-toggle="pill"
                                data-bs-target="#seo-setting" type="button"><?php echo e(__('SEO')); ?></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php if(session('tab') and session('tab') == 6): ?> active <?php endif; ?>" id="pwa-setting-tab" data-bs-toggle="pill"
                                data-bs-target="#pwa-setting" type="button"><?php echo e(__('PWA')); ?></button>
                        </li>
                        <li class="nav-item " role="presentation">
                            <button class="nav-link <?php if(session('tab') and session('tab') == 7): ?> active <?php endif; ?>" id="cookie-setting-tab" data-bs-toggle="pill"
                                data-bs-target="#cookie-setting" type="button"><?php echo e(__('Cookie')); ?></button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php if(session('tab') and session('tab') == 8): ?> active <?php endif; ?>" id="qrcode-setting-tab" data-bs-toggle="pill"
                                data-bs-target="#qrcode-setting" type="button"><?php echo e(__('QR Code')); ?></button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-sm-12">
                <div class="row">
                     <div class="col-lg-12">
                        <div class="tab-content" id="pills-tabContent">

                            <div class="tab-pane fade <?php if(!session('tab') or (session('tab') and session('tab') == 1)): ?> active show <?php endif; ?>" id="theme-setting" role="tabpanel"
                                aria-labelledby="pills-user-tab-1">
                                <div class="row gy-4">
                                    <div class="col-lg-8 col-md-7">
                                        <?php echo e(Form::open(['route' => ['business.edit-theme', $business->id], 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                                        <div class="select-theme-portion">
                                            <div class="d-flex flex-wrap align-items-center justify-content-between mb-3 gap-3">
                                                <h5 class="mb-0"><?php echo e(__('Select Theme:')); ?></h5>
                                                <?php echo e(Form::hidden('themefile', null, ['id' => 'themefile'])); ?>

                                                <button type="submit" class="btn btn-primary"> <i class="me-2"
                                                        data-feather="folder"></i> <?php echo e(__('Save Changes')); ?></button>
                                            </div>
                                            <div class="theme-slider">
                                                <?php $__currentLoopData = \App\Models\Utility::themeOne(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(in_array($key, Auth::user()->getPlanThemes())): ?>
                                                        <div class="theme-view-card">
                                                            <div class="theme-view-inner">
                                                                <div class="theme-view-img ">
                                                                    <img class="color1 <?php echo e($key); ?>_img"
                                                                        data-id="<?php echo e($key); ?>"
                                                                        src="<?php echo e(asset(Storage::url('uploads/card_theme/' . $key . '/color1.png'))); ?>"
                                                                        alt="">
                                                                </div>
                                                                <div class="theme-view-content mt-3">
                                                                    <?php $__currentLoopData = \App\Models\Utility::themeTitle(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php if($key==$k): ?>
                                                                            <h6><?php echo e(__($title)); ?></h6>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <div class="d-flex flex-wrap align-items-center" id="<?php echo e($key); ?>">
                                                                        <?php $__currentLoopData = $v; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $css => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <label class="colorinput">
                                                                                <input name="theme_color"
                                                                                    id="<?php echo e($css); ?>"
                                                                                    type="radio" value="<?php echo e($css); ?>"
                                                                                    data-theme="<?php echo e($key); ?>"
                                                                                    data-imgpath="<?php echo e($val['img_path']); ?>"
                                                                                    class="colorinput-input"
                                                                                    <?php echo e(isset($business->theme_color) && $business->theme_color == $css ? 'checked' : ''); ?>>
                                                                                <span class="border-box">
                                                                                    <span class="colorinput-color"
                                                                                        style="background:<?php echo e($val['color']); ?>"></span>
                                                                                </span>
                                                                            </label>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        <div class="color-picker">
                                                                            <div class="border-box">
                                                                                <input type="color"
                                                                                    value="<?php echo e($key == $business->theme ? $business->theme_color  : '#000000'); ?>"
                                                                                    class="colorPicker"
                                                                                    id="color-picker-<?php echo e($key); ?>">
                                                                                <input type="hidden" name="custom_color" id="custom_color">
                                                                                <input type="hidden" name="color_flag" id="color-flag-<?php echo e($key); ?>" value="false">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                        <?php echo e(Form::close()); ?>

                                    </div>
                                    <div class="col-lg-4 col-md-5">
                                        <div class="theme-preview theme-preview-1">
                                            <div class="mb-3">
                                                <h5><?php echo e(__('Preview')); ?></h5>
                                            </div>
                                            <div class="theme-preview-body">
                                                <img src="<?php echo e(asset(Storage::url('uploads/card_theme/theme1/color1.png'))); ?>"
                                                    class="theme_preview_img">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade <?php if(session('tab') and session('tab') == 2): ?> show active <?php endif; ?>" id="details-setting" role="tabpanel"
                                aria-labelledby="pills-user-tab-2">
                                <div class="row gy-4">
                                    <div class="col-lg-7 col-md-7">
                                        <div class="theme-detail-card card mb-0">
                                            <?php echo e(Form::open(['route' => ['business.update', $business->id], 'method' => 'put', 'enctype' => 'multipart/form-data','onsubmit' => 'return submitForm()'])); ?>

                                            <input type="hidden" name="url" value="<?php echo e(url('/')); ?>"
                                                id="url">
                                                <input type="hidden" name="url" value="<?php echo e($chatgpt_setting['enable_chatgpt']); ?>"
                                                id="chatgpt">

                                            <div class="d-flex flex-wrap align-items-center justify-content-between mb-3 gap-3" id="">
                                                <h5 class="mb-0"><?php echo e(__('Edit Business Details:')); ?></h5>
                                                <button type="submit" class="btn btn-primary"> <i class="me-2"
                                                        data-feather="folder"></i> <?php echo e(__('Save Changes')); ?></button>
                                            </div>
                                            <div class="theme-detail-body business-banner-wrapper" >
                                                <div class="row mb-3 img-validate-class img-validate-class-detail">
                                                    <div class="col-xl-8 col-12">
                                                        <p class="mb-2"><?php echo e(__('Banner:')); ?></p>
                                                        <div class="setting-block banner-setting">
                                                            <div class="position-relative overflow-hidden rounded">
                                                                <img src="<?php echo e(isset($business->banner) && !empty($business->banner) ? $banner . '/' . $business->banner : asset('custom/img/placeholder-image1.png')); ?>"
                                                                    alt="images" class="w-100 imagepreview" id="banner">
                                                                <div class="position-absolute top-50  end-0 start-0 text-center" style="transform: translateY(-50%)">
                                                                    <div class="choose-file">
                                                                        <input
                                                                            class="custom-input-file custom-input-file-link banner d-none file-validate"
                                                                            type="file" name="banner" id="file-1" multiple="">
                                                                            <label for="file-1">
                                                                                <button type="button"
                                                                                    onclick="selectFile('banner')" class="btn btn-primary"><i
                                                                                    class="me-2" data-feather="upload"></i><?php echo e(__('Choose a
                                                                                    file...')); ?></button>
                                                                            </label>
                                                                    </div>
                                                                    <?php $__errorArgs = ['banner'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <span class="invalid-favicon text-xs text-danger"
                                                                            role="alert" ><?php echo e($message); ?></span>
                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-4 col-12">
                                                        <p class="mb-2"><?php echo e(__('Logo:')); ?></p>
                                                        <div class="setting-block banner-small-setting">
                                                            <div class="position-relative">
                                                                <img src="<?php echo e(isset($business->logo) && !empty($business->logo) ? $logo.'/'.$business->logo : asset('custom/img/logo-placeholder-image-2.png')); ?>"
                                                                    alt="images" id="business_logo">
                                                                <div
                                                                    class="position-absolute top-50  end-0 start-0 text-center">
                                                                    <div class="choose-file">
                                                                        <input class="d-none business_logo file-validate" type="file"
                                                                            name="logo" id="file-2" >
                                                                            <label for="file-2">
                                                                                <button type="button"
                                                                                    onclick="selectFile('business_logo')" class="btn btn-primary"><i
                                                                                    class="me-2" data-feather="upload"></i><?php echo e(__('Upload')); ?></button>
                                                                            </label>
                                                                        <input type="hidden" name="business_id"
                                                                            value="<?php echo e($business->id); ?>">
                                                                        <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                            <span class="invalid-favicon text-xs text-danger"
                                                                                role="alert"><?php echo e($message); ?></span>
                                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="invalid-favicon text-m text-danger" id="banner_validate"></span>

                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <h5 class="mb-3"><?php echo e(__('Personal info')); ?></h5>
                                                            <?php if($chatgpt_setting['enable_chatgpt'] == 'on'): ?>
                                                            <div class="col-xl-12 col-lg-12 col-md-12 d-flex align-items-center justify-content-between justify-content-md-end"
                                                                data-bs-placement="top">
                                                                <a href="javascript:void(0)" data-size="lg" class="btn btn-sm btn-primary d-flex align-items-center gap-2" data-ajax-popup-over="true"
                                                                    data-url="<?php echo e(route('generate_ai_business', ['edit business',$stringid])); ?>" data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="<?php echo e(__('Generate')); ?>" data-title="<?php echo e(__('Generate content with AI')); ?>">
                                                                    <i class="fas fa-robot"></i>&nbsp;<?php echo e(__('Generate with AI')); ?>

                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="col-12">
                                                        
                                                        <div class="row">
                                                            <div class="col-sm-6 col-12">
                                                                <div class="form-group mb-0">
                                                                    <?php echo e(Form::label('Title', __('Title:'), ['class' => 'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaleab1765d328ab3f8835fc5d78676a070 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.required','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('required'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaleab1765d328ab3f8835fc5d78676a070)): ?>
<?php $attributes = $__attributesOriginaleab1765d328ab3f8835fc5d78676a070; ?>
<?php unset($__attributesOriginaleab1765d328ab3f8835fc5d78676a070); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaleab1765d328ab3f8835fc5d78676a070)): ?>
<?php $component = $__componentOriginaleab1765d328ab3f8835fc5d78676a070; ?>
<?php unset($__componentOriginaleab1765d328ab3f8835fc5d78676a070); ?>
<?php endif; ?>
                                                                    <?php echo Form::text('title', $business->title, ['class' => 'form-control emojiarea', 'id' => $stringid . '_title', 'placeholder' => __('Enter Title'),'data-name'=>'business_title']); ?>

                                                                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <span class="invalid-favicon text-xs text-danger"
                                                                            role="alert"><?php echo e($message); ?></span>
                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-12">
                                                                <div class="form-group mb-0">
                                                                    <?php echo e(Form::label('Designation', __('Designation:'), ['class' => 'form-label'])); ?>

                                                                    <?php echo e(Form::text('designation', $business->designation, ['class' => 'form-control', 'id' => $stringid . '_designation', 'placeholder' => __('Enter Designation')])); ?>

                                                                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <span class="invalid-favicon text-xs text-danger"
                                                                            role="alert"><?php echo e($message); ?></span>
                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-12">
                                                                <div class="form-group mb-0">
                                                                    <?php echo e(Form::label('Sub_Title', __('Sub Title:'), ['class' => 'form-label'])); ?>

                                                                    <?php echo e(Form::text('sub_title', $business->sub_title, ['class' => 'form-control validation_subtitle emojiarea', 'id' => $stringid . '_subtitle', 'placeholder' => __('Enter Sub Title')])); ?>

                                                                    <?php $__errorArgs = ['sub_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <span class="invalid-favicon text-xs text-danger"
                                                                            role="alert"><?php echo e($message); ?></span>
                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-12">
                                                                <div class="form-group mb-0">
                                                                    <?php echo e(Form::label('category', __('Category'), ['class' => 'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaleab1765d328ab3f8835fc5d78676a070 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.required','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('required'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaleab1765d328ab3f8835fc5d78676a070)): ?>
<?php $attributes = $__attributesOriginaleab1765d328ab3f8835fc5d78676a070; ?>
<?php unset($__attributesOriginaleab1765d328ab3f8835fc5d78676a070); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaleab1765d328ab3f8835fc5d78676a070)): ?>
<?php $component = $__componentOriginaleab1765d328ab3f8835fc5d78676a070; ?>
<?php unset($__componentOriginaleab1765d328ab3f8835fc5d78676a070); ?>
<?php endif; ?>
                                                                    <?php echo Form::select('category', $category, $business->business_category, ['class' => 'form-control select2 ', 'required' => 'required','placeholder'=>__('Select Category')]); ?>

                                                                    <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <small class="invalid-role" role="alert">
                                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                        </small>
                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group mb-0">
                                                                    <?php echo e(Form::label('Description', __('Description:'), ['class' => 'form-label'])); ?>

                                                                    <?php echo e(Form::textarea('description', $business->description, ['class' => 'form-control description-text emojiarea','rows' => '3','cols' => '30', 'id' => $stringid . '_desc', 'placeholder' => __('Enter Description')])); ?>

                                                                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <span class="invalid-favicon text-xs text-danger"
                                                                            role="alert"><?php echo e($message); ?></span>
                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </div>
                                                            </div>

                                                            <div class="col-12">
                                                                <h5 class="mb-3"><?php echo e(__('Personalized link:')); ?></h5>
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" readonly
                                                                            value=" <?php echo e($business_url); ?>"
                                                                            placeholder="https://demo.workdo.io/vcardgo-saas/james-donald">
                                                                        <?php echo e(Form::text('slug', $business->slug, ['class' => 'input-group-text text-start', 'placeholder' => __('Enter Slug')])); ?>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            
                                                      </div>
                                                   </div>

                                                <div class="row" >
                                                    <div class="col-12">
                                                        <h5 class="mb-2"><?php echo e(__('Settings:')); ?></h5>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="accordion accordion-flush setting-accordion"
                                                            id="accordionExample">
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header" id="headingOne">
                                                                    <button class="accordion-button collapsed"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#collapseOne"
                                                                        aria-expanded="false" aria-controls="collapseOne">
                                                                        <span class="d-flex align-items-center">
                                                                            <?php echo e(__('Contact Info')); ?>

                                                                        </span>
                                                                        <div class="d-flex align-items-center">
                                                                            <span class="me-2"><?php echo e(__('On/Off:')); ?></span>
                                                                            <div
                                                                                class="form-check form-switch custom-switch-v1">
                                                                                <input type="hidden"
                                                                                    name="is_contacts_enabled"
                                                                                    value="off">
                                                                                <input type="checkbox"
                                                                                    class="form-check-input input-primary"
                                                                                    name="is_contacts_enabled"
                                                                                    id="is_contacts_enabled"
                                                                                    <?php echo e(isset($contactinfo['is_enabled']) && $contactinfo['is_enabled'] == '1' ? 'checked="checked"' : ''); ?>>
                                                                                <label class="form-check-label"
                                                                                    for="is_contacts_enabled"></label>
                                                                            </div>
                                                                        </div>
                                                                    </button>
                                                                </h2>
                                                                <div id="collapseOne" class="accordion-collapse collapse"
                                                                    aria-labelledby="headingOne"
                                                                    data-bs-parent="#accordionExample">
                                                                    <div class="accordion-body">
                                                                        <div class="row" >
                                                                            <div id="showContact">
                                                                                <div class="col-12" >
                                                                                    <div class="row gy-4" id="inputrow_contact">
                                                                                        <?php if(!is_null($contactinfo_content)): ?>
                                                                                        <?php $__currentLoopData = $contactinfo_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                            <?php $__currentLoopData = $val; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $val1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                                <?php if($key1 != 'id'): ?>
                                                                                                    <div class="col-lg-4" id="inputFormRow">
                                                                                                        <div class="input-edits inputFormRow mb-4">

                                                                                                            <?php if($key1 == 'Address'): ?>
                                                                                                                <?php $__currentLoopData = $val1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $val2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                                                    <div
                                                                                                                        class="input-group">
                                                                                                                        <span
                                                                                                                            class="input-group-text"><img
                                                                                                                                src="<?php echo e(asset('custom/icon/black/' . strtolower($key1) . '.svg')); ?>"></span>
                                                                                                                        <input
                                                                                                                            type="text"
                                                                                                                            <?php if($key2 == 'Address'): ?> id="<?php echo e($key1 . '_' . $no); ?>" <?php endif; ?>
                                                                                                                            name="<?php echo e('contact[' . $no . '][' . $key1 . '][' . $key2 . ']'); ?>"
                                                                                                                            value="<?php echo e($val2); ?>"
                                                                                                                            class="form-control"
                                                                                                                            placeholder="<?php echo e(__('Enter Contact No')); ?>"
                                                                                                                            required>
                                                                                                                    </div>
                                                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                                                <input
                                                                                                                    type="hidden"
                                                                                                                    name="<?php echo e('contact[' . $no . '][id]'); ?>"
                                                                                                                    value="<?php echo e($no); ?>">
                                                                                                            <?php else: ?>
                                                                                                                <div
                                                                                                                    class="input-group">
                                                                                                                    <span
                                                                                                                        class="input-group-text"><img
                                                                                                                            src="<?php echo e(asset('custom/icon/black/' . strtolower($key1) . '.svg')); ?>"></span>
                                                                                                                    <input
                                                                                                                        type="text"
                                                                                                                        id="<?php echo e($key1 . '_' . $no); ?>"
                                                                                                                        name="<?php echo e('contact[' . $no . '][' . $key1 . ']'); ?>"
                                                                                                                        value="<?php echo e($val1); ?>"
                                                                                                                        class="form-control"
                                                                                                                        placeholder="<?php echo e(_('Enter Contact No')); ?>">
                                                                                                                </div>
                                                                                                                <input
                                                                                                                    type="hidden"
                                                                                                                    name="<?php echo e('contact[' . $no . '][id]'); ?>"
                                                                                                                    value="<?php echo e($no); ?>">
                                                                                                            <?php endif; ?>

                                                                                                            <a href="javascript:void(0);"
                                                                                                                class="close-btn"
                                                                                                                id="removeRow_contact"
                                                                                                                data-id="contact_<?php echo e($loop->parent->index + 1); ?>"><svg
                                                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                                                    width="25"
                                                                                                                    height="25"
                                                                                                                    viewBox="0 0 25 25"
                                                                                                                    fill="none">
                                                                                                                    <path
                                                                                                                        opacity="0.4"
                                                                                                                        d="M12.2539 22.6094C17.7768 22.6094 22.2539 18.1322 22.2539 12.6094C22.2539 7.08653 17.7768 2.60938 12.2539 2.60938C6.73106 2.60938 2.25391 7.08653 2.25391 12.6094C2.25391 18.1322 6.73106 22.6094 12.2539 22.6094Z"
                                                                                                                        fill="#FF0F00" />
                                                                                                                    <path
                                                                                                                        d="M13.3149 12.6092L15.7849 10.1392C16.0779 9.84618 16.0779 9.37115 15.7849 9.07815C15.4919 8.78515 15.0169 8.78515 14.7239 9.07815L12.2539 11.5482L9.78393 9.07815C9.49093 8.78515 9.01592 8.78515 8.72292 9.07815C8.42992 9.37115 8.42992 9.84618 8.72292 10.1392L11.1929 12.6092L8.72292 15.0791C8.42992 15.3721 8.42992 15.8472 8.72292 16.1402C8.86892 16.2862 9.06092 16.3601 9.25292 16.3601C9.44492 16.3601 9.63692 16.2872 9.78292 16.1402L12.2529 13.6701L14.7229 16.1402C14.8689 16.2862 15.0609 16.3601 15.2529 16.3601C15.4449 16.3601 15.6369 16.2872 15.7829 16.1402C16.0759 15.8472 16.0759 15.3721 15.7829 15.0791L13.3149 12.6092Z"
                                                                                                                        fill="#FF0F00" />
                                                                                                                </svg>
                                                                                                            </a>

                                                                                                        </div>
                                                                                                    </div>
                                                                                                <?php endif; ?>
                                                                                                <?php
                                                                                                    $no++;
                                                                                                ?>
                                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                    <?php endif; ?>
                                                                                    </div>

                                                                                </div>
                                                                                <div class="col-12 mt-3">
                                                                                    <a href="javascript:void(0);"
                                                                                        value="sdfcvgbnn"
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#fieldModal"
                                                                                        data-bs-whatever="<?php echo e(__('Choose contact field')); ?>"
                                                                                        data-bs-toggle="tooltip"
                                                                                        class="add-new-app flex-row">
                                                                                        <div
                                                                                            class="bg-secondary proj-add-icon">
                                                                                            <i class="ti ti-plus"></i>
                                                                                        </div>
                                                                                        <h6 class="mb-0 ms-2"><?php echo e(__('Add New Contact')); ?></h6>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal fade" id="fieldModal" tabindex="-1"
                                                                role="dialog" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">
                                                                                <?php echo e(__('Add Field')); ?></h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row social-card-row">
                                                                               <?php $__currentLoopData = $businessfields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                               <div class="col-lg-3 col-md-4 col-6">
                                                                                  <div class="social-card text-center getvalue" value="<?php echo e($val); ?>"
                                                                                     id="<?php echo e($val); ?>" data-id="<?php echo e($val); ?>"
                                                                                     onclick="getValue(this.id)">
                                                                                     <div class="theme-avtar bg-primary">
                                                                                        <img src="<?php echo e(asset('custom/icon/white/' . $val . '.svg')); ?>"
                                                                                           alt="image" class="<?php echo e($val); ?>">
                                                                                     </div>
                                                                                     <div class="social-name">
                                                                                        <?php if($val == 'Web_url'): ?>
                                                                                        <h5 class="mb-0"><?php echo e(__('Web Url')); ?></h5>
                                                                                        <?php else: ?>
                                                                                        <h5 class="mb-0"><?php echo e($val); ?></h5>
                                                                                        <?php endif; ?>
                                                                                     </div>
                                                                                  </div>
                                                                               </div>
                                                                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            </div>
                                                                         </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header" id="headingTwo">
                                                                    <button class="accordion-button collapsed"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#collapseTwo"
                                                                        aria-expanded="false" aria-controls="collapseTwo">
                                                                        <span class="d-flex align-items-center"><?php echo e(__('Business Hours')); ?></span>
                                                                        <div class="d-flex align-items-center">
                                                                            <span class="me-2"><?php echo e(__('On/Off:')); ?></span>

                                                                            <div
                                                                                class="form-check form-switch custom-switch-v1">
                                                                                <input type="hidden"
                                                                                    name="is_business_hours_enabled"
                                                                                    value="off">
                                                                                <input type="checkbox"
                                                                                    name="is_business_hours_enabled"
                                                                                    class="form-check-input input-primary"
                                                                                    id="is_business_hours_enabled"
                                                                                    <?php echo e(isset($businesshours['is_enabled']) && $businesshours['is_enabled'] == '1' ? 'checked="checked"' : ''); ?>>
                                                                                <label class="form-check-label"
                                                                                    for="is_business_hours_enabled"></label>
                                                                            </div>
                                                                        </div>
                                                                    </button>
                                                                </h2>
                                                                <div id="collapseTwo" class="accordion-collapse collapse"
                                                                    aria-labelledby="headingTwo"
                                                                    data-bs-parent="#accordionExample">
                                                                    <div class="accordion-body">
                                                                        <div class="bussiness-hours">
                                                                            <div class="row align-items-center gy-4">
                                                                                <div class="col-lg-12">
                                                                                    <div class="bussiness-hours-header">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-2">
                                                                                                <span><?php echo e(__('Day')); ?></span>
                                                                                            </div>
                                                                                            <div class="col-lg-5">
                                                                                                <span><?php echo e(__('Start Time')); ?></span>
                                                                                            </div>
                                                                                            <div class="col-lg-5">
                                                                                                <span><?php echo e(__('End Time')); ?></span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <div class="col-12">
                                                                                        <div class="row cust-day-row gy-2 gx-2 align-items-center">
                                                                                            <div class="col-lg-auto flex-grow-1 col-md-12">
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input days"
                                                                                                        name="days_<?php echo e($k); ?>"
                                                                                                        type="checkbox"
                                                                                                        id="days_<?php echo e($k); ?>"
                                                                                                        <?php if(!is_null($business_hours)): ?> <?php echo e(isset($business_hours->$k) && $business_hours->$k->days == 'on' ? 'checked' : ''); ?> <?php endif; ?>>
                                                                                                    <label class="form-check-label f-4"
                                                                                                        for="days_<?php echo e($k); ?>">
                                                                                                        <?php echo e(__($day)); ?>

                                                                                                    </label>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-xxl-5 col-lg-4 col-md-6 col-sm-6">
                                                                                                <div class="form-group mb-0">
                                                                                                    <input type="time"
                                                                                                        id="days_<?php echo e($k); ?>_start"
                                                                                                        data-id="days_<?php echo e($k); ?>"
                                                                                                        name="start-<?php echo e($k); ?>"
                                                                                                        class="form-control timepicker"
                                                                                                        placeholder="08:10"
                                                                                                        value="<?php echo e(!is_null($business_hours) && isset($business_hours->$k) && $business_hours->$k->days == 'on'
                                                                                                            ? $business_hours->$k->start_time
                                                                                                            : ''); ?>"
                                                                                                        onchange="changeFunction(this.id)">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-xxl-5 col-lg-4 col-md-6 col-sm-6">
                                                                                                <div class="form-group mb-0">
                                                                                                    <input type="time"
                                                                                                        id="days_<?php echo e($k); ?>_end"
                                                                                                        data-id="days_<?php echo e($k); ?>"
                                                                                                        name="end-<?php echo e($k); ?>"
                                                                                                        class="form-control timepicker"
                                                                                                        onchange="changeFunction(this.id)"
                                                                                                        placeholder="08:10"
                                                                                                        value="<?php echo e(!is_null($business_hours) && isset($business_hours->$k) && $business_hours->$k->days == 'on'
                                                                                                            ? $business_hours->$k->end_time
                                                                                                            : ''); ?>">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header" id="headingThree">
                                                                    <button class="accordion-button collapsed"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#collapseThree"
                                                                        aria-expanded="false"
                                                                        aria-controls="collapseThree">
                                                                        <span
                                                                            class="d-flex align-items-center"><?php echo e(__('Appointments')); ?></span>
                                                                        <div class="d-flex align-items-center"
                                                                            data-value="<?php echo e(json_encode($appoinment_hours)); ?>">
                                                                            <span class="me-2"><?php echo e(__('On/Off:')); ?></span>
                                                                            <div
                                                                                class="form-check form-switch custom-switch-v1">
                                                                                <input type="hidden"
                                                                                    name="is_appoinment_enabled"
                                                                                    value="off">
                                                                                <input type="checkbox"
                                                                                    name="is_appoinment_enabled"
                                                                                    class="form-check-input input-primary"
                                                                                    id="is_appoinment_enabled"
                                                                                    <?php echo e(isset($appoinment['is_enabled']) && $appoinment['is_enabled'] == '1' ? 'checked="checked"' : ''); ?>>

                                                                                <label class="form-check-label"
                                                                                    for="is_appoinment_enabled"></label>
                                                                            </div>
                                                                        </div>
                                                                    </button>
                                                                </h2>
                                                                <div id="collapseThree"
                                                                    class="accordion-collapse collapse"
                                                                    aria-labelledby="headingTwo"
                                                                    data-bs-parent="#accordionExample">
                                                                    <div class="accordion-body">
                                                                        <div class="bussiness-hours" id="showAppoinment">
                                                                            <div class="row align-items-center gy-4">
                                                                                <div class="col-lg-12">
                                                                                    <div class="bussiness-hours-header">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-5">
                                                                                                <span><?php echo e(__('Start Time')); ?></span>
                                                                                            </div>
                                                                                            <div class="col-lg-5">
                                                                                                <span><?php echo e(__('End Time')); ?></span>
                                                                                            </div>
                                                                                            <div class="col-lg-2">
                                                                                                <span><?php echo e(__('Delete')); ?></span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div id="inputrow_appointment">
                                                                                    <?php if(!is_null($appoinment_hours)): ?>
                                                                                        <?php $__currentLoopData = $appoinment_hours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $hour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                            <div class="row mb-4 inputFormRow1"
                                                                                                id="inputFormRow1">
                                                                                                <div class="col-lg-5">
                                                                                                    <div
                                                                                                        class="form-group mb-0">
                                                                                                        <input
                                                                                                            type="time"
                                                                                                            name="<?php echo e('hours[' . $appointment_no . '][start]'); ?>"
                                                                                                            class="form-control appointment_time timepicker"
                                                                                                            id="appoinment_start_<?php echo e($appointment_no); ?>"
                                                                                                            placeholder="08:10"
                                                                                                            value="<?php echo e($hour->start); ?>"
                                                                                                            onchange="changeTime(this.id)" required/>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-lg-5">
                                                                                                    <div
                                                                                                        class="form-group mb-0">
                                                                                                        <input
                                                                                                            type="time"
                                                                                                            name="<?php echo e('hours[' . $appointment_no . '][end]'); ?>"
                                                                                                            class="form-control appointment_time timepicker"
                                                                                                            id="appoinment_end_<?php echo e($appointment_no); ?>"
                                                                                                            placeholder="08:10"
                                                                                                            value="<?php echo e($hour->end); ?>"
                                                                                                            onchange="changeTime(this.id)" required>

                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-lg-2">
                                                                                                    <a href="javascript:void(0);"
                                                                                                        class="close-btn"
                                                                                                        id="removeRow_appointment"
                                                                                                        data-id="<?php echo e('appointment_' . $appointment_no); ?>"><svg
                                                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                                                            width="25"
                                                                                                            height="25"
                                                                                                            viewBox="0 0 25 25"
                                                                                                            fill="none">
                                                                                                            <path
                                                                                                                opacity="0.4"
                                                                                                                d="M12.2539 22.6094C17.7768 22.6094 22.2539 18.1322 22.2539 12.6094C22.2539 7.08653 17.7768 2.60938 12.2539 2.60938C6.73106 2.60938 2.25391 7.08653 2.25391 12.6094C2.25391 18.1322 6.73106 22.6094 12.2539 22.6094Z"
                                                                                                                fill="#FF0F00">
                                                                                                            </path>
                                                                                                            <path
                                                                                                                d="M13.3149 12.6092L15.7849 10.1392C16.0779 9.84618 16.0779 9.37115 15.7849 9.07815C15.4919 8.78515 15.0169 8.78515 14.7239 9.07815L12.2539 11.5482L9.78393 9.07815C9.49093 8.78515 9.01592 8.78515 8.72292 9.07815C8.42992 9.37115 8.42992 9.84618 8.72292 10.1392L11.1929 12.6092L8.72292 15.0791C8.42992 15.3721 8.42992 15.8472 8.72292 16.1402C8.86892 16.2862 9.06092 16.3601 9.25292 16.3601C9.44492 16.3601 9.63692 16.2872 9.78292 16.1402L12.2529 13.6701L14.7229 16.1402C14.8689 16.2862 15.0609 16.3601 15.2529 16.3601C15.4449 16.3601 15.6369 16.2872 15.7829 16.1402C16.0759 15.8472 16.0759 15.3721 15.7829 15.0791L13.3149 12.6092Z"
                                                                                                                fill="#FF0F00">
                                                                                                            </path>
                                                                                                        </svg>
                                                                                                    </a>

                                                                                                </div>
                                                                                            </div>

                                                                                            <?php
                                                                                                $appointment_no++;
                                                                                            ?>

                                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                                <div class="col-12">

                                                                                    <a href="javascript:void(0)" class="add-new-app flex-row" onclick="appointmentRepeater()">
                                                                                        <div class="bg-secondary proj-add-icon">
                                                                                            <i class="ti ti-plus"></i>
                                                                                        </div>
                                                                                        <h6 class="mb-0 ms-2"><?php echo e(__('Add New Appointment')); ?></h6>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header" id="headingFour">
                                                                    <button class="accordion-button collapsed"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#collapseFour"
                                                                        aria-expanded="false"
                                                                        aria-controls="collapseFour">
                                                                        <span
                                                                            class="d-flex align-items-center"><?php echo e(__('Services')); ?></span>
                                                                        <div class="d-flex align-items-center">
                                                                            <span class="me-2"><?php echo e(__('On/Off:')); ?></span>
                                                                            <div
                                                                                class="form-check form-switch custom-switch-v1">
                                                                                <input type="hidden"
                                                                                    name="is_services_enabled"
                                                                                    value="off">
                                                                                <input type="checkbox"
                                                                                    name="is_services_enabled"
                                                                                    id="is_services_enabled"
                                                                                    class="form-check-input input-primary"
                                                                                    <?php echo e(isset($services['is_enabled']) && $services['is_enabled'] == '1' ? 'checked="checked"' : ''); ?>>

                                                                                <label class="form-check-label"
                                                                                    for="is_services_enabled"></label>
                                                                            </div>
                                                                        </div>
                                                                    </button>
                                                                </h2>

                                                                <div id="collapseFour" class="accordion-collapse collapse"
                                                                    aria-labelledby="headingFour"
                                                                    data-bs-parent="#accordionExample">
                                                                    <div class="accordion-body">
                                                                        <div class="showServices">
                                                                            <div class="row gy-4 mb-3 img-validate-class-detail"  id="inputrow_service">
                                                                                <p class="file-error-detail text-danger" style=""></p>
                                                                                <?php $image_count = 0; ?>
                                                                                <?php if(!is_null($services_content)): ?>
                                                                                    <?php $__currentLoopData = $services_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k1 => $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                        <div class="col-md-6 inputFormRow2" id="inputFormRow2">
                                                                                            
                                                                                            <div class="services-setting-card">
                                                                                                <a href="javascript:void(0)"
                                                                                                    class="close-btn"
                                                                                                    id="removeRow_services"
                                                                                                    data-id="<?php echo e('services_' . $service_row_no); ?>"><svg
                                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                                        width="25"
                                                                                                        height="25"
                                                                                                        viewBox="0 0 25 25"
                                                                                                        fill="none">
                                                                                                        <path opacity="0.4"
                                                                                                            d="M12.2539 22.6094C17.7768 22.6094 22.2539 18.1322 22.2539 12.6094C22.2539 7.08653 17.7768 2.60938 12.2539 2.60938C6.73106 2.60938 2.25391 7.08653 2.25391 12.6094C2.25391 18.1322 6.73106 22.6094 12.2539 22.6094Z"
                                                                                                            fill="#FF0F00">
                                                                                                        </path>
                                                                                                        <path
                                                                                                            d="M13.3149 12.6092L15.7849 10.1392C16.0779 9.84618 16.0779 9.37115 15.7849 9.07815C15.4919 8.78515 15.0169 8.78515 14.7239 9.07815L12.2539 11.5482L9.78393 9.07815C9.49093 8.78515 9.01592 8.78515 8.72292 9.07815C8.42992 9.37115 8.42992 9.84618 8.72292 10.1392L11.1929 12.6092L8.72292 15.0791C8.42992 15.3721 8.42992 15.8472 8.72292 16.1402C8.86892 16.2862 9.06092 16.3601 9.25292 16.3601C9.44492 16.3601 9.63692 16.2872 9.78292 16.1402L12.2529 13.6701L14.7229 16.1402C14.8689 16.2862 15.0609 16.3601 15.2529 16.3601C15.4449 16.3601 15.6369 16.2872 15.7829 16.1402C16.0759 15.8472 16.0759 15.3721 15.7829 15.0791L13.3149 12.6092Z"
                                                                                                            fill="#FF0F00">
                                                                                                        </path>
                                                                                                    </svg>
                                                                                                </a>
                                                                                                <div
                                                                                                    class="mb-5 services-img-setting">
                                                                                                    <div
                                                                                                        class="position-relative">
                                                                                                        <img id="<?php echo e('s_image' . $image_count); ?>"
                                                                                                            src="<?php echo e(isset($content->image) && !empty($content->image) ? $s_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png')); ?>"
                                                                                                            alt="images"
                                                                                                            class="imagepreview">
                                                                                                        <div
                                                                                                            class="position-absolute top-50  end-0 start-0 text-center">
                                                                                                            <div
                                                                                                                class="choose-file">
                                                                                                                <input
                                                                                                                    class="d-none s_image<?php echo e($image_count); ?> file-validate"
                                                                                                                    type="file"
                                                                                                                    name="<?php echo e('services[' . $service_row_no . '][image]'); ?>"
                                                                                                                    data-multiple-caption="{count} files selected"
                                                                                                                    id="file-1">
                                                                                                                    <span
                                                                                                                        class="btn btn-primary"
                                                                                                                        onclick="selectFile('s_image<?php echo e($image_count); ?>')"><svg
                                                                                                                        xmlns="http://www.w3.org/2000/svg" width="24"
                                                                                                                        height="24"
                                                                                                                        viewBox="0 0 24 24"
                                                                                                                        fill="none"
                                                                                                                        stroke="currentColor"
                                                                                                                        stroke-width="2"
                                                                                                                        stroke-linecap="round"
                                                                                                                        stroke-linejoin="round"
                                                                                                                        class="feather feather-upload me-2">
                                                                                                                        <path
                                                                                                                            d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4">
                                                                                                                        </path>
                                                                                                                        <polyline
                                                                                                                            points="17 8 12 3 7 8">
                                                                                                                        </polyline>
                                                                                                                        <line
                                                                                                                            x1="12"
                                                                                                                            y1="3"
                                                                                                                            x2="12"
                                                                                                                            y2="15">
                                                                                                                        </line>
                                                                                                                    </svg><?php echo e(__('Upload')); ?>

                                                                                                                    </span>
                                                                                                                <input
                                                                                                                    type="hidden"
                                                                                                                    name="<?php echo e('services[' . $service_row_no . '][get_image]'); ?>"
                                                                                                                    value="<?php echo e($content->image); ?>">
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                </div>

                                                                                                <?php if($chatgpt_setting['enable_chatgpt'] == 'on'): ?>
                                                                                                    <div class="col-xl-12 col-lg-12 col-md-12 d-flex align-items-center justify-content-between justify-content-md-end"
                                                                                                        data-bs-placement="top">
                                                                                                        <a href="javascript:void(0)" data-size="lg" class="btn btn-sm btn-primary d-flex align-items-center gap-2" data-ajax-popup-over="true"
                                                                                                            data-url="<?php echo e(route('generate_ai', ['service business',$service_row_no])); ?>" data-bs-toggle="tooltip" data-bs-placement="top"
                                                                                                            title="<?php echo e(__('Generate')); ?>" data-title="<?php echo e(__('Generate content with AI')); ?>">
                                                                                                            <i class="fas fa-robot"></i>&nbsp;<?php echo e(__('Generate with AI')); ?>

                                                                                                        </a>
                                                                                                    </div>
                                                                                                <?php endif; ?>
                                                                                                
                                                                                                    <div class="form-group">
                                                                                                        <label
                                                                                                            class="form-label"><?php echo e(__('Title:')); ?></label>
                                                                                                        <input type="text"
                                                                                                            class="form-control"
                                                                                                            data-name="service_title"
                                                                                                            id="<?php echo e('title_' . $service_row_no); ?>"
                                                                                                            name="<?php echo e('services[' . $service_row_no . '][title]'); ?>"
                                                                                                            placeholder="<?php echo e(__('Enter title')); ?>"
                                                                                                            value="<?php echo e($content->title); ?>"/>

                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label class="form-label"><?php echo e(__('Description:')); ?></label>
                                                                                                        <textarea class="form-control" data-name="service_description"
                                                                                                            id="<?php echo e('description_' . $service_row_no); ?>"
                                                                                                            name="<?php echo e('services[' . $service_row_no . '][description]'); ?>"
                                                                                                            placeholder="<?php echo e(__('Enter Description')); ?>" rows="3" cols="30"><?php echo e($content->description); ?></textarea>


                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label
                                                                                                            class="form-label"><?php echo e(__('Button Text:')); ?></label>
                                                                                                        <input type="text"
                                                                                                            name="<?php echo e('services[' . $service_row_no . '][link_title]'); ?>"
                                                                                                            id="<?php echo e('link_title_' . $service_row_no); ?>"
                                                                                                            class="form-control"
                                                                                                            placeholder="<?php echo e(('Enter link title')); ?>"
                                                                                                            value="<?php echo e($content->link_title); ?>">
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label
                                                                                                            class="form-label"><?php echo e(__('Button link:')); ?></label>
                                                                                                        <input type="text"
                                                                                                            id="<?php echo e('purchase_link_' . $service_row_no); ?>"
                                                                                                            name="<?php echo e('services[' . $service_row_no . '][purchase_link]'); ?>"
                                                                                                            class="form-control"
                                                                                                            placeholder="<?php echo e(__('Purchase link')); ?>"
                                                                                                            value="<?php if(isset($content->purchase_link)): ?> <?php echo e($content->purchase_link); ?> <?php endif; ?>">
                                                                                                    </div>
                                                                                                
                                                                                            </div>
                                                                                            
                                                                                        </div>

                                                                                        <?php
                                                                                            $image_count++;
                                                                                            $service_row_no++;
                                                                                        ?>
                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                <?php endif; ?>

                                                                            </div>
                                                                            <a href="javascript:void(0)"
                                                                                    class="add-new-service"
                                                                                    onclick="servieRepeater()">
                                                                                    <div
                                                                                    class="bg-secondary serv-add-icon">
                                                                                    <i class="ti ti-plus"></i>
                                                                                </div>
                                                                                    <h6><?php echo e(__('Add New Service')); ?></h6>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <?php if($business->theme != 'theme7' && $business->theme != 'theme8'&& $business->theme != 'theme11' && $business->theme != 'theme14' && $business->theme != 'theme10' && $business->theme != 'theme15'&& $business->theme != 'theme18'): ?>
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header" id="headingNine">
                                                                    <button class="accordion-button collapsed"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#collapseNine"
                                                                        aria-expanded="false"
                                                                        aria-controls="collapseNine">
                                                                        <span
                                                                            class="d-flex align-items-center"><?php echo e(__('Product')); ?></span>
                                                                        <div class="d-flex align-items-center">
                                                                            <span class="me-2"><?php echo e(__('On/Off:')); ?></span>
                                                                            <div
                                                                                class="form-check form-switch custom-switch-v1">
                                                                                <input type="hidden"
                                                                                    name="is_product_enabled"
                                                                                    value="off">
                                                                                <input type="checkbox"
                                                                                    name="is_product_enabled"
                                                                                    id="is_product_enabled"
                                                                                    class="form-check-input input-primary"
                                                                                    <?php echo e(isset($products['is_enabled']) && $products['is_enabled'] == '1' ? 'checked="checked"' : ''); ?>>

                                                                                <label class="form-check-label"
                                                                                    for="is_product_enabled"></label>
                                                                            </div>
                                                                        </div>
                                                                    </button>
                                                                </h2>

                                                                <div id="collapseNine" class="accordion-collapse collapse"
                                                                    aria-labelledby="headingNine"
                                                                    data-bs-parent="#accordionExample">
                                                                    <div class="accordion-body">
                                                                        <div class="showProducts">
                                                                            <div class="row gy-4 mb-3 img-validate-class-detail"  id="inputrow_product">
                                                                                <p class="file-error-detail text-danger" style=""></p>
                                                                                <?php $pr_image_count = 0; ?>
                                                                                <?php if(!is_null($products_content)): ?>
                                                                                    <?php $__currentLoopData = $products_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k1 => $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                        <div class="col-md-6 inputFormRow6" id="inputFormRow6">
                                                                                            
                                                                                            <div class="services-setting-card">
                                                                                                <a href="javascript:void(0)"
                                                                                                    class="close-btn"
                                                                                                    id="removeRow_product"
                                                                                                    data-id="<?php echo e('product_' . $product_row_no); ?>"><svg
                                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                                        width="25"
                                                                                                        height="25"
                                                                                                        viewBox="0 0 25 25"
                                                                                                        fill="none">
                                                                                                        <path opacity="0.4"
                                                                                                            d="M12.2539 22.6094C17.7768 22.6094 22.2539 18.1322 22.2539 12.6094C22.2539 7.08653 17.7768 2.60938 12.2539 2.60938C6.73106 2.60938 2.25391 7.08653 2.25391 12.6094C2.25391 18.1322 6.73106 22.6094 12.2539 22.6094Z"
                                                                                                            fill="#FF0F00">
                                                                                                        </path>
                                                                                                        <path
                                                                                                            d="M13.3149 12.6092L15.7849 10.1392C16.0779 9.84618 16.0779 9.37115 15.7849 9.07815C15.4919 8.78515 15.0169 8.78515 14.7239 9.07815L12.2539 11.5482L9.78393 9.07815C9.49093 8.78515 9.01592 8.78515 8.72292 9.07815C8.42992 9.37115 8.42992 9.84618 8.72292 10.1392L11.1929 12.6092L8.72292 15.0791C8.42992 15.3721 8.42992 15.8472 8.72292 16.1402C8.86892 16.2862 9.06092 16.3601 9.25292 16.3601C9.44492 16.3601 9.63692 16.2872 9.78292 16.1402L12.2529 13.6701L14.7229 16.1402C14.8689 16.2862 15.0609 16.3601 15.2529 16.3601C15.4449 16.3601 15.6369 16.2872 15.7829 16.1402C16.0759 15.8472 16.0759 15.3721 15.7829 15.0791L13.3149 12.6092Z"
                                                                                                            fill="#FF0F00">
                                                                                                        </path>
                                                                                                    </svg>
                                                                                                </a>
                                                                                                <div
                                                                                                    class="mb-5 services-img-setting">
                                                                                                    <div
                                                                                                        class="position-relative image-upload">
                                                                                                        <img id="<?php echo e('pr_image' . $pr_image_count); ?>"
                                                                                                            src="<?php echo e(isset($content->image) && !empty($content->image) ? $pr_image . '/' . $content->image : asset('custom/img/logo-placeholder-image-21.png')); ?>"
                                                                                                            alt="images"
                                                                                                            class="imagepreview">
                                                                                                        <div
                                                                                                            class="position-absolute top-50  end-0 start-0 text-center">
                                                                                                            <div
                                                                                                                class="choose-file">
                                                                                                                <input
                                                                                                                    class="d-none file-validate pr_image<?php echo e($pr_image_count); ?>"
                                                                                                                    type="file"
                                                                                                                    name="<?php echo e('product[' . $product_row_no . '][image]'); ?>"
                                                                                                                    data-multiple-caption="{count} files selected"
                                                                                                                    multiple=""
                                                                                                                    id="file-1">
                                                                                                                    <span
                                                                                                                        class="btn btn-primary"
                                                                                                                        onclick="selectFile('pr_image<?php echo e($pr_image_count); ?>')"><svg
                                                                                                                        xmlns="http://www.w3.org/2000/svg" width="24"
                                                                                                                        height="24"
                                                                                                                        viewBox="0 0 24 24"
                                                                                                                        fill="none"
                                                                                                                        stroke="currentColor"
                                                                                                                        stroke-width="2"
                                                                                                                        stroke-linecap="round"
                                                                                                                        stroke-linejoin="round"
                                                                                                                        class="feather feather-upload me-2">
                                                                                                                        <path
                                                                                                                            d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4">
                                                                                                                        </path>
                                                                                                                        <polyline
                                                                                                                            points="17 8 12 3 7 8">
                                                                                                                        </polyline>
                                                                                                                        <line
                                                                                                                            x1="12"
                                                                                                                            y1="3"
                                                                                                                            x2="12"
                                                                                                                            y2="15">
                                                                                                                        </line>
                                                                                                                    </svg><?php echo e(__('Upload')); ?>

                                                                                                                    </span>
                                                                                                                <input
                                                                                                                    type="hidden"
                                                                                                                    name="<?php echo e('product[' . $product_row_no . '][get_image]'); ?>"
                                                                                                                    value="<?php echo e($content->image); ?>">
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                    <div class="form-group">
                                                                                                        <label
                                                                                                            class="form-label"><?php echo e(__('Title:')); ?></label>
                                                                                                        <input type="text"
                                                                                                            class="form-control"
                                                                                                            data-name="product_title"
                                                                                                            id="<?php echo e('product_title_' . $product_row_no); ?>"
                                                                                                            name="<?php echo e('product[' . $product_row_no . '][title]'); ?>"
                                                                                                            placeholder="<?php echo e(('Enter Title')); ?>"
                                                                                                            value="<?php echo e($content->title); ?>"/>

                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label class="form-label"><?php echo e(__('Description:')); ?></label>
                                                                                                        <textarea class="form-control" data-name="product_description"
                                                                                                            id="<?php echo e('product_description_' . $product_row_no); ?>"
                                                                                                            name="<?php echo e('product[' . $product_row_no . '][description]'); ?>"
                                                                                                            placeholder="<?php echo e(__('Enter Description')); ?>" rows="3" cols="30"><?php echo e($content->description); ?></textarea>


                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label
                                                                                                         class="form-label"><?php echo e(__('Currency:')); ?></label>
                                                                                                         <select name="<?php echo e('product[' . $product_row_no . '][currency]'); ?>" id="<?php echo e('product_currency_select' . $product_row_no); ?>" class="form-control" onchange="changeValue(this.id)" placeholder="<?php echo e(__('Select')); ?>">
                                                                                                            <?php $__currentLoopData = $currencyData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                                                 <option value="<?php echo e($currency['symbol']); ?>" <?php echo e($content->currency == $currency['symbol'] ? 'selected' : ''); ?>><?php echo e($currency['symbol'].' - '.$currency['name']); ?></option>
                                                                                                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                                         </select>
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label
                                                                                                            class="form-label"><?php echo e(__('Price:')); ?></label>
                                                                                                        <input type="text"
                                                                                                            name="<?php echo e('product[' . $product_row_no . '][price]'); ?>"
                                                                                                            id="<?php echo e('product_price_' . $product_row_no); ?>"
                                                                                                            class="form-control"
                                                                                                            placeholder="<?php echo e(__('Enter Price')); ?>"
                                                                                                            value="<?php echo e($content->price); ?>">
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label
                                                                                                            class="form-label"><?php echo e(__('Button Text:')); ?></label>
                                                                                                        <input type="text"
                                                                                                            name="<?php echo e('product[' . $product_row_no . '][link_title]'); ?>"
                                                                                                            id="<?php echo e('product_link_title_' . $product_row_no); ?>"
                                                                                                            class="form-control"
                                                                                                            placeholder="<?php echo e(__('Enter link title')); ?>"
                                                                                                            value="<?php echo e($content->link_title); ?>">
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label
                                                                                                            class="form-label"><?php echo e(__('Button link:')); ?></label>
                                                                                                        <input type="text"
                                                                                                            id="<?php echo e('product_purchase_link_' . $product_row_no); ?>"
                                                                                                            name="<?php echo e('product[' . $product_row_no . '][purchase_link]'); ?>"
                                                                                                            class="form-control"
                                                                                                            placeholder="<?php echo e(__('Purchase link')); ?>"
                                                                                                            value="<?php if(isset($content->purchase_link)): ?> <?php echo e($content->purchase_link); ?> <?php endif; ?>">
                                                                                                    </div>

                                                                                                
                                                                                            </div>
                                                                                            
                                                                                        </div>

                                                                                        <?php
                                                                                            $pr_image_count++;
                                                                                            $product_row_no++;
                                                                                        ?>
                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                <?php endif; ?>

                                                                            </div>
                                                                            <a href="javascript:void(0)"
                                                                                    class="add-new-service"
                                                                                    onclick="productRepeater()">
                                                                                    <div
                                                                                    class="bg-secondary serv-add-icon">
                                                                                    <i class="ti ti-plus"></i>
                                                                                </div>
                                                                                    <h6><?php echo e(__('Add New Product')); ?></h6>
                                                                            </a>
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php endif; ?>
                                                            

                                                            
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header" id="headingFive">
                                                                    <button class="accordion-button collapsed"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#collapseFive"
                                                                        aria-expanded="false"
                                                                        aria-controls="collapseFive">
                                                                        <span
                                                                            class="d-flex align-items-center"><?php echo e(__('Testimonials')); ?></span>
                                                                        <div class="d-flex align-items-center">
                                                                            <span class="me-2"><?php echo e(__('On/Off:')); ?></span>
                                                                            <div
                                                                                class="form-check form-switch custom-switch-v1">
                                                                                <input type="hidden"
                                                                                name="is_testimonials_enabled"
                                                                                value="off">
                                                                                <input type="checkbox"
                                                                                    class="form-check-input input-primary" name="is_testimonials_enabled" id="is_testimonials_enabled"
                                                                                    id="customswitchv1-2" <?php echo e(isset($testimonials['is_enabled']) && $testimonials['is_enabled'] == '1' ? 'checked="checked"' : ''); ?>>
                                                                                <label class="form-check-label"
                                                                                    for="customswitchv1-2"></label>
                                                                            </div>
                                                                        </div>
                                                                    </button>
                                                                </h2>
                                                                <div id="collapseFive" class="accordion-collapse collapse"
                                                                    aria-labelledby="headingFive"
                                                                    data-bs-parent="#accordionExample">
                                                                    <div class="accordion-body">
                                                                        <div class="showTestimonials">
                                                                            <div class="row gy-4 mb-3 img-validate-class img-validate-class-detail" id="inputrow_testimonials">
                                                                                <p class="file-error-detail text-danger" style=""></p>
                                                                                <?php
                                                                                    $t_image_count = 0;
                                                                                    $t_rating_count = 0;
                                                                                ?>
                                                                                <?php if(!is_null($testimonials_content)): ?>
                                                                                    <?php $__currentLoopData = $testimonials_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k2 => $testi_content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                        <div class="col-md-6" id="inputFormRow3">
                                                                                            <div class="services-setting-card">
                                                                                                <a href="javascript:void(0)"
                                                                                                    class="close-btn" id="removeRow_testimonials" data-id="<?php echo e('testimonials_' . $testimonials_row_no); ?>"><svg
                                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                                        width="25" height="25"
                                                                                                        viewBox="0 0 25 25"
                                                                                                        fill="none">
                                                                                                        <path opacity="0.4"
                                                                                                            d="M12.2539 22.6094C17.7768 22.6094 22.2539 18.1322 22.2539 12.6094C22.2539 7.08653 17.7768 2.60938 12.2539 2.60938C6.73106 2.60938 2.25391 7.08653 2.25391 12.6094C2.25391 18.1322 6.73106 22.6094 12.2539 22.6094Z"
                                                                                                            fill="#FF0F00"></path>
                                                                                                        <path
                                                                                                            d="M13.3149 12.6092L15.7849 10.1392C16.0779 9.84618 16.0779 9.37115 15.7849 9.07815C15.4919 8.78515 15.0169 8.78515 14.7239 9.07815L12.2539 11.5482L9.78393 9.07815C9.49093 8.78515 9.01592 8.78515 8.72292 9.07815C8.42992 9.37115 8.42992 9.84618 8.72292 10.1392L11.1929 12.6092L8.72292 15.0791C8.42992 15.3721 8.42992 15.8472 8.72292 16.1402C8.86892 16.2862 9.06092 16.3601 9.25292 16.3601C9.44492 16.3601 9.63692 16.2872 9.78292 16.1402L12.2529 13.6701L14.7229 16.1402C14.8689 16.2862 15.0609 16.3601 15.2529 16.3601C15.4449 16.3601 15.6369 16.2872 15.7829 16.1402C16.0759 15.8472 16.0759 15.3721 15.7829 15.0791L13.3149 12.6092Z"
                                                                                                            fill="#FF0F00"></path>
                                                                                                    </svg>
                                                                                                </a>
                                                                                                <div class="mb-5 services-img-setting">
                                                                                                    <div class="position-relative image-upload">
                                                                                                            <img id="<?php echo e('t_image' . $t_image_count); ?>" src="<?php echo e(isset($testi_content->image) && !empty($testi_content->image) ? $image . '/' . $testi_content->image : asset('custom/img/logo-placeholder-image-21.png')); ?>" class="imagepreview"/>
                                                                                                        <div
                                                                                                            class="position-absolute top-50  end-0 start-0 text-center">
                                                                                                            <div class="choose-file">
                                                                                                                <input class="d-none t_image<?php echo e($t_image_count); ?> file-validate" data-multiple-caption="{count} files selected "
                                                                                                                    type="file"
                                                                                                                    name="<?php echo e('testimonials[' . $testimonials_row_no . '][image]'); ?>"
                                                                                                                    id="file-1">
                                                                                                                    <input
                                                                                                                    type="hidden"
                                                                                                                    name="<?php echo e('testimonials[' . $t_image_count . '][get_image]'); ?>" multiple=""
                                                                                                                    value="<?php echo e($testi_content->image); ?>"/>
                                                                                                                    <span
                                                                                                                        class="btn btn-primary"
                                                                                                                        onclick="selectFile('t_image<?php echo e($t_image_count); ?>')"><svg
                                                                                                                        xmlns="http://www.w3.org/2000/svg" width="24"
                                                                                                                        height="24"
                                                                                                                        viewBox="0 0 24 24"
                                                                                                                        fill="none"
                                                                                                                        stroke="currentColor"
                                                                                                                        stroke-width="2"
                                                                                                                        stroke-linecap="round"
                                                                                                                        stroke-linejoin="round"
                                                                                                                        class="feather feather-upload me-2">
                                                                                                                        <path
                                                                                                                            d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4">
                                                                                                                        </path>
                                                                                                                        <polyline
                                                                                                                            points="17 8 12 3 7 8">
                                                                                                                        </polyline>
                                                                                                                        <line
                                                                                                                            x1="12"
                                                                                                                            y1="3"
                                                                                                                            x2="12"
                                                                                                                            y2="15">
                                                                                                                        </line>
                                                                                                                    </svg><?php echo e(__('Upload')); ?>

                                                                                                                    </span>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <?php if($chatgpt_setting['enable_chatgpt'] == 'on'): ?>
                                                                                                    <div class="col-xl-12 col-lg-12 col-md-12 d-flex align-items-center justify-content-between justify-content-md-end"
                                                                                                        data-bs-placement="top">
                                                                                                        <a href="javascript:void(0)" data-size="lg" class="btn btn-sm btn-primary d-flex align-items-center gap-2" data-ajax-popup-over="true"
                                                                                                            data-url="<?php echo e(route('generate_ai_testimonial', ['testimonial',$testimonials_row_no])); ?>" data-bs-toggle="tooltip" data-bs-placement="top"
                                                                                                            title="<?php echo e(__('Generate')); ?>" data-title="<?php echo e(__('Generate content with AI')); ?>">
                                                                                                            <i class="fas fa-robot"></i>&nbsp;<?php echo e(__('Generate with AI')); ?>

                                                                                                        </a>
                                                                                                    </div>
                                                                                                <?php endif; ?>
                                                                                                    
                                                                                                <div class="form-group">
                                                                                                    <label class="form-label"><?php echo e(__('Rate:')); ?></label>
                                                                                                    <div
                                                                                                        class="border p-3 rounded d-flex align-items-center justify-content-between">
                                                                                                        <h6 class="mb-0">
                                                                                                            <span class="<?php echo e('stars' . $testimonials_row_no); ?>"><?php echo e($testi_content->rating); ?></span>/5
                                                                                                        </h6>
                                                                                                        <div class="rate testimonial-ratings" id='demo1'>

                                                                                                                <input
                                                                                                                class="<?php echo e('stars' . $testimonials_row_no); ?>"
                                                                                                                type="radio"
                                                                                                                id="<?php echo e('testimonials-5' . $t_rating_count); ?>"
                                                                                                                name="<?php echo e('testimonials[' . $testimonials_row_no . '][rating]'); ?>"
                                                                                                                value="5"
                                                                                                                onclick="getRadio(this)"
                                                                                                                <?php echo e(isset($testi_content->rating) && $testi_content->rating == '5' ? 'checked="checked"' : ''); ?> />
                                                                                                            <label
                                                                                                                class="full"
                                                                                                                for="<?php echo e('testimonials-5' . $t_rating_count); ?>"
                                                                                                                title="Awesome - 5 stars"></label>
                                                                                                            <input
                                                                                                                class="<?php echo e('stars' . $testimonials_row_no); ?>"
                                                                                                                type="radio"
                                                                                                                id="<?php echo e('testimonials-4' . $t_rating_count); ?>"
                                                                                                                name="<?php echo e('testimonials[' . $testimonials_row_no . '][rating]'); ?>"
                                                                                                                value="4"
                                                                                                                onclick="getRadio(this)"
                                                                                                                <?php echo e(isset($testi_content->rating) && $testi_content->rating == '4' ? 'checked="checked"' : ''); ?> />
                                                                                                            <label
                                                                                                                class="full"
                                                                                                                for="<?php echo e('testimonials-4' . $t_rating_count); ?>"
                                                                                                                title="Pretty good - 4 stars"></label>
                                                                                                            <input
                                                                                                                class="<?php echo e('stars' . $testimonials_row_no); ?>"
                                                                                                                type="radio"
                                                                                                                id="<?php echo e('testimonials-3' . $t_rating_count); ?>"
                                                                                                                name="<?php echo e('testimonials[' . $testimonials_row_no . '][rating]'); ?>"
                                                                                                                value="3"
                                                                                                                onclick="getRadio(this)"
                                                                                                                <?php echo e(isset($testi_content->rating) && $testi_content->rating == '3' ? 'checked="checked"' : ''); ?> />
                                                                                                            <label
                                                                                                                class="full"
                                                                                                                for="<?php echo e('testimonials-3' . $t_rating_count); ?>"
                                                                                                                title="Meh - 3 stars"></label>
                                                                                                            <input
                                                                                                                class="<?php echo e('stars' . $testimonials_row_no); ?>"
                                                                                                                type="radio"
                                                                                                                id="<?php echo e('testimonials-2' . $t_rating_count); ?>"
                                                                                                                name="<?php echo e('testimonials[' . $testimonials_row_no . '][rating]'); ?>"
                                                                                                                value="2"
                                                                                                                onclick="getRadio(this)"
                                                                                                                <?php echo e(isset($testi_content->rating) && $testi_content->rating == '2' ? 'checked="checked"' : ''); ?> />
                                                                                                            <label
                                                                                                                class="full"
                                                                                                                for="<?php echo e('testimonials-2' . $t_rating_count); ?>"
                                                                                                                title="Kinda bad - 2 stars"></label>
                                                                                                            <input
                                                                                                                class="<?php echo e('stars' . $testimonials_row_no); ?>"
                                                                                                                type="radio"
                                                                                                                id="<?php echo e('testimonials-1' . $t_rating_count); ?>"
                                                                                                                name="<?php echo e('testimonials[' . $testimonials_row_no . '][rating]'); ?>"
                                                                                                                value="1"
                                                                                                                onclick="getRadio(this)"
                                                                                                                <?php echo e(isset($testi_content->rating) && $testi_content->rating == '1' ? 'checked="checked"' : ''); ?> />
                                                                                                            <label
                                                                                                                class="full"
                                                                                                                for="<?php echo e('testimonials-1' . $t_rating_count); ?>"
                                                                                                                title="Sucks big time - 1 star"></label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        class="form-label"><?php echo e(__('Name:')); ?></label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        data-name="testimonial_name"
                                                                                                        id="<?php echo e('testimonial_name_' . $testimonials_row_no); ?>"
                                                                                                        name="<?php echo e('testimonials[' . $testimonials_row_no . '][name]'); ?>"
                                                                                                        placeholder="<?php echo e(__('Enter Name')); ?>"
                                                                                                        value="<?php echo e(isset($testi_content->name)?$testi_content->name:''); ?>"/>

                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        class="form-label"><?php echo e(__('Description:')); ?></label>
                                                                                                            <textarea class="form-control" name="<?php echo e('testimonials[' . $testimonials_row_no . '][description]'); ?>" id="<?php echo e('testimonial_description_' . $testimonials_row_no); ?>" cols="30" rows="3"><?php echo e($testi_content->description); ?></textarea>
                                                                                                </div>
                                                                                            
                                                                                            </div>
                                                                                        </div>
                                                                                        <?php
                                                                                            $t_rating_count++;
                                                                                            $t_image_count++;
                                                                                            $testimonials_row_no++;
                                                                                        ?>
                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                <?php endif; ?>

                                                                                
                                                                            </div>
                                                                            <a href="javascript:void(0)" class="add-new-service" onclick="testimonialRepeater();">
                                                                                <div
                                                                                    class="bg-secondary serv-add-icon">
                                                                                    <i class="ti ti-plus"></i>
                                                                                </div>
                                                                                <h6><?php echo e(__('Add New Testimonials')); ?></h6>
                                                                            </a>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            

                                                            
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header" id="headingSix">
                                                                    <button class="accordion-button collapsed"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#collapseSix"
                                                                        aria-expanded="false" aria-controls="collapseSix">
                                                                        <span class="d-flex align-items-center"><?php echo e(__('Social')); ?></span>
                                                                        <div class="d-flex align-items-center">
                                                                            <span class="me-2"><?php echo e(__('On/Off:')); ?></span>
                                                                            <div
                                                                                class="form-check form-switch custom-switch-v1">
                                                                                <input type="hidden" name="is_socials_enabled" value="off">
                                                                                <input type="checkbox"
                                                                                    class="form-check-input input-primary"
                                                                                    id="is_socials_enabled" name="is_socials_enabled"
                                                                                    <?php echo e(isset($sociallinks['is_enabled']) && $sociallinks['is_enabled'] == '1' ? 'checked="checked"' : ''); ?>>
                                                                                <label class="form-check-label"
                                                                                    for="is_socials_enabled"></label>
                                                                            </div>
                                                                        </div>
                                                                    </button>
                                                                </h2>
                                                                <div id="collapseSix" class="accordion-collapse collapse"
                                                                    aria-labelledby="headingSix"
                                                                    data-bs-parent="#accordionExample">
                                                                    <div class="accordion-body">
                                                                        <div class="row">
                                                                            <div id="showSocials">
                                                                                    
                                                                                <div class="col-12" >
                                                                                    <div class="row gy-4" id="inputrow_socials">
                                                                                        <?php if(!is_null($social_content)): ?>
                                                                                            <?php $__currentLoopData = $social_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social_key => $social_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                                <?php $__currentLoopData = $social_val; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social_key1 => $social_val1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                                    <?php if($social_key1 != 'id'): ?>
                                                                                                    <div class="col-lg-4" id="inputFormRow4">
                                                                                                        <div class="input-edits" >
                                                                                                            <div class="input-group">
                                                                                                                <span class="input-group-text"><img
                                                                                                                        src="<?php echo e(asset('custom/icon/black/' . strtolower($social_key1) . '.svg')); ?>"></span>
                                                                                                                <input type="text"
                                                                                                                    name="<?php echo e('socials[' . $social_no . '][' . $social_key1 . ']'); ?>"
                                                                                                                    value="<?php echo e($social_val1); ?>"
                                                                                                                    id="<?php echo e('social_link_' . $social_no); ?>"
                                                                                                                    class="form-control social_href"
                                                                                                                    placeholder="<?php echo e(__('Enter a link')); ?>" required/>
                                                                                                                    <input type="hidden" name="<?php echo e('socials[' . $social_no . '][id]'); ?>" value="<?php echo e($social_no); ?>">
                                                                                                            </div>
                                                                                                            <h6 class="text-danger mt-2 text-xs"  id="<?php echo e('social_link_' . $social_no . '_error_href'); ?>"></h6>
                                                                                                            <a href="javascript:void(0)"
                                                                                                                class="close-btn" id="removeRow_socials" data-id="socials_<?php echo e($loop->parent->index + 1); ?>"><svg
                                                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                                                    width="25" height="25"
                                                                                                                    viewBox="0 0 25 25"
                                                                                                                    fill="none">
                                                                                                                    <path opacity="0.4"
                                                                                                                        d="M12.2539 22.6094C17.7768 22.6094 22.2539 18.1322 22.2539 12.6094C22.2539 7.08653 17.7768 2.60938 12.2539 2.60938C6.73106 2.60938 2.25391 7.08653 2.25391 12.6094C2.25391 18.1322 6.73106 22.6094 12.2539 22.6094Z"
                                                                                                                        fill="#FF0F00"></path>
                                                                                                                    <path
                                                                                                                        d="M13.3149 12.6092L15.7849 10.1392C16.0779 9.84618 16.0779 9.37115 15.7849 9.07815C15.4919 8.78515 15.0169 8.78515 14.7239 9.07815L12.2539 11.5482L9.78393 9.07815C9.49093 8.78515 9.01592 8.78515 8.72292 9.07815C8.42992 9.37115 8.42992 9.84618 8.72292 10.1392L11.1929 12.6092L8.72292 15.0791C8.42992 15.3721 8.42992 15.8472 8.72292 16.1402C8.86892 16.2862 9.06092 16.3601 9.25292 16.3601C9.44492 16.3601 9.63692 16.2872 9.78292 16.1402L12.2529 13.6701L14.7229 16.1402C14.8689 16.2862 15.0609 16.3601 15.2529 16.3601C15.4449 16.3601 15.6369 16.2872 15.7829 16.1402C16.0759 15.8472 16.0759 15.3721 15.7829 15.0791L13.3149 12.6092Z"
                                                                                                                        fill="#FF0F00"></path>
                                                                                                                </svg></a>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <?php endif; ?>
                                                                                                    <?php
                                                                                                        $social_no++;
                                                                                                    ?>
                                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-auto flex-grow-1 mt-3">
                                                                                    <a href="javascript:void(0)"
                                                                                        class="add-new-app flex-row" value="sdfcvgbnn" data-bs-toggle="modal" data-bs-target="#socialsModal">
                                                                                        <div
                                                                                            class="bg-secondary proj-add-icon">
                                                                                            <i class="ti ti-plus"></i>
                                                                                        </div>
                                                                                        <h6 class="mb-0 ms-2"><?php echo e(__('Add New Social Links')); ?></h6>
                                                                                    </a>
                                                                                </div>
                                                                            
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            

                                                            
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header" id="headingseven">
                                                                    <button class="accordion-button collapsed"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#collapseseven"
                                                                        aria-expanded="false"
                                                                        aria-controls="collapseseven">
                                                                        <span class="d-flex align-items-center"><?php echo e(__('Google Map ')); ?></span>
                                                                        <div class="d-flex align-items-center">
                                                                            <span class="me-2"><?php echo e(__('On/Off:')); ?></span>
                                                                            <div
                                                                                class="form-check form-switch custom-switch-v1">
                                                                                <input type="hidden" name="is_google_map_enabled" value="off"/>
                                                                                <input type="checkbox" name="is_google_map_enabled" id="is_google_map_enabled"
                                                                                    class="form-check-input input-primary"
                                                                                    <?php echo e(isset($business['is_google_map_enabled']) && $business['is_google_map_enabled'] == '1' ? 'checked="checked"' : ''); ?>/>
                                                                                <label class="form-check-label"
                                                                                    for="is_google_map_enabled"></label>
                                                                            </div>
                                                                        </div>
                                                                    </button>
                                                                </h2>
                                                                <div id="collapseseven"
                                                                    class="accordion-collapse collapse"
                                                                    aria-labelledby="headingseven"
                                                                    data-bs-parent="#accordionExample">
                                                                    <div class="accordion-body">
                                                                        <div class="form-group google_map_link">

                                                                            <label class="d-block mb-2"
                                                                                for=""><?php echo e(__('Google Map Link:')); ?></label>
                                                                            <textarea class="form-control" name="google_map_link" placeholder="<?php echo e(__('Enter Google Map Link')); ?>" cols="10" rows="3" id="<?php echo e($stringid); ?>_map_link" ><?php echo e(isset($business['google_map_link']) && $business['google_map_link'] ? $business['google_map_link'] : ''); ?></textarea>
                                                                            <?php $__errorArgs = ['google_map_link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                            <span class="invalid-favicon text-xs text-danger"
                                                                                role="alert"><?php echo e($message); ?></span>
                                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                            <small class="text-mute"><?php echo e(__('Note : Please make sure to include the correct iframe code.')); ?></small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            

                                                            
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header" id="headingEleven">
                                                                    <button class="accordion-button collapsed"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#collapseEleven"
                                                                        aria-expanded="false"
                                                                        aria-controls="collapseseven">
                                                                        <span class="d-flex align-items-center"><?php echo e(__('Apps Detail')); ?></span>

                                                                        <div class="d-flex align-items-center">
                                                                            <span class="me-2"><?php echo e(__('On/Off:')); ?></span>
                                                                            <div
                                                                                class="form-check form-switch custom-switch-v1">
                                                                                <input type="hidden" name="is_app_info_enabled" value="off"/>
                                                                                <input type="checkbox" name="is_app_info_enabled" id="is_app_info_enabled"
                                                                                    class="form-check-input input-primary"
                                                                                    <?php echo e(isset($appInfo['is_enabled']) && $appInfo['is_enabled'] == '1' ? 'checked="checked"' : ''); ?>/>
                                                                                <label class="form-check-label"
                                                                                    for="is_app_info_enabled"></label>
                                                                            </div>
                                                                        </div>
                                                                    </button>
                                                                </h2>
                                                                <div id="collapseEleven"
                                                                    class="accordion-collapse collapse"
                                                                    aria-labelledby="headingEleven"
                                                                    data-bs-parent="#accordionExample">
                                                                    <div class="accordion-body">
                                                                        <div class="app_info_block">
                                                                            <div class="form-group">
                                                                                <label class="d-block mb-2" for="playstore_id"><?php echo e(__('Play Store Link:')); ?></label>
                                                                                <div class="input-group">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text">
                                                                                            <i class="ti ti-brand-google-play"></i>
                                                                                        </span>
                                                                                    </div>
                                                                                    <input type="text" class="form-control" name="playstore_id" placeholder="<?php echo e(__('Enter Your Play Store Link')); ?>" id="<?php echo e($stringid); ?>_playstore_id" value="<?php echo e(isset($appInfo['playstore_id']) && $appInfo['playstore_id'] ? $appInfo['playstore_id'] : ''); ?>">
                                                                                </div>
                                                                                <?php $__errorArgs = ['playstore_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                                    <span class="invalid-favicon text-xs text-danger" role="alert"><?php echo e($message); ?></span>
                                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="d-block mb-2" for=""><?php echo e(__('App Store Link:')); ?></label>
                                                                                <div class="input-group">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text">
                                                                                            <i class="ti ti-brand-appstore"></i>
                                                                                        </span>
                                                                                    </div>
                                                                                    <input type="text" class="form-control"  name="appstore_id" id="<?php echo e($stringid); ?>_appstore_id" placeholder="<?php echo e(__('Enter your App Store link')); ?>" value="<?php echo e(isset($appInfo['appstore_id']) && $appInfo['appstore_id'] ? $appInfo['appstore_id'] : ''); ?>"/>
                                                                                </div>

                                                                                <?php $__errorArgs = ['appstore_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                                    <span class="invalid-favicon text-xs text-danger"
                                                                                        role="alert"><?php echo e($message); ?></span>
                                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="d-block mb-2" for=""><?php echo e(__('App Variant:')); ?></label>
                                                                                <div id="selectable" class="app-selectable-div">
                                                                                    <img src="<?php echo e(asset('custom/icon/apps/variant1.png')); ?>" class="ui-widget-content" />
                                                                                    <img src="<?php echo e(asset('custom/icon/apps/variant2.png')); ?>" class="ui-widget-content" />
                                                                                    <img src="<?php echo e(asset('custom/icon/apps/variant3.png')); ?>" class="ui-widget-content" />
                                                                                    <img src="<?php echo e(asset('custom/icon/apps/variant4.png')); ?>" class="ui-widget-content" />
                                                                                    <img src="<?php echo e(asset('custom/icon/apps/variant5.png')); ?>" class="ui-widget-content" />
                                                                                </div>
                                                                                <input type="hidden" name="variant" id="selected-item-hidden" value ="<?php echo e(isset($appInfo['variant']) && $appInfo['variant'] ? $appInfo['variant'] : ''); ?>">
                                                                                <small><?php echo e(__('Note : If you do not select any variant then by default 1 variant will be selected.')); ?></small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            

                                                            
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header" id="headingpayment">
                                                                    <button class="accordion-button collapsed"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#collapsepayment"
                                                                        aria-expanded="false"
                                                                        aria-controls="collapsepayment">
                                                                        <span class="d-flex align-items-center"><?php echo e(__('Payment')); ?></span>
                                                                        <div class="d-flex align-items-center">
                                                                            <span class="me-2"><?php echo e(__('On/Off:')); ?></span>
                                                                            <div
                                                                                class="form-check form-switch custom-switch-v1">
                                                                                <input type="hidden" name="is_payment_enabled" value="off"/>
                                                                                <input type="checkbox" name="is_payment_enabled" id="is_payment_enabled"
                                                                                    class="form-check-input input-primary"
                                                                                    <?php echo e(isset($cardPayment->is_enabled) && $cardPayment->is_enabled == 1 ? 'checked="checked"' : ''); ?>/>
                                                                                <label class="form-check-label"
                                                                                    for="is_payment_enabled"></label>
                                                                            </div>
                                                                        </div>
                                                                    </button>
                                                                </h2>
                                                                <div id="collapsepayment"
                                                                    class="accordion-collapse collapse"
                                                                    aria-labelledby="headingPayment"
                                                                    data-bs-parent="#accordionExample">
                                                                    <div class="accordion-body">
                                                                        <div class="row gy-4 payment">
                                                                                <div class="col-lg-12 col-md-12">
                                                                                        <div class="theme-detail-card">
                                                                                            <div class="mb-4 d-flex align-items-center justify-content-between">
                                                                                                <h5 class="mb-0 flex-grow-1"><?php echo e(__('Payment Settings:')); ?></h5>
                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <div class="col-lg-3">
                                                                                                    <div class="card payment-card-left">
                                                                                                    <div class="row">
                                                                                                            <div class="form-group">
                                                                                                                <?php echo e(Form::label('payment_amount', __('Payment Amount'), ['class' => 'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaleab1765d328ab3f8835fc5d78676a070 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.required','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('required'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaleab1765d328ab3f8835fc5d78676a070)): ?>
<?php $attributes = $__attributesOriginaleab1765d328ab3f8835fc5d78676a070; ?>
<?php unset($__attributesOriginaleab1765d328ab3f8835fc5d78676a070); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaleab1765d328ab3f8835fc5d78676a070)): ?>
<?php $component = $__componentOriginaleab1765d328ab3f8835fc5d78676a070; ?>
<?php unset($__componentOriginaleab1765d328ab3f8835fc5d78676a070); ?>
<?php endif; ?>
                                                                                                                <?php echo e(Form::text('payment_amount', $cardPayment ? $cardPayment->payment_amount : '', ['class' => 'form-control','placeholder'=>__('Enter Payment Amount')])); ?>

                                                                                                                <?php $__errorArgs = ['payment_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                                                                    <span class="invalid-google_analytic" role="alert">
                                                                                                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                                                                    </span>
                                                                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                                                            </div>
                                                                                                    </div>
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="col-lg-9 card-payment-block">

                                                                                                    <div class="accordion accordion-flush card  setting-accordion" id="accordionExample">
                                                                                                        <div class="card-header">
                                                                                                            <h5><?php echo e(__('Payment Method')); ?></h5>

                                                                                                        </div>
                                                                                                        <div class="payment-card-left">
                                                                                                            <div class="accordion-item card " >
                                                                                                                <h2 class="accordion-header">
                                                                                                                    <button class="accordion-button collapsed" type="button"
                                                                                                                        data-bs-toggle="collapse" data-bs-target="#collapseStripe"
                                                                                                                        aria-expanded="false" aria-controls="collapseStripe">
                                                                                                                        <span class="d-flex align-items-center">

                                                                                                                            <?php echo e(__('Stripe')); ?>

                                                                                                                        </span>
                                                                                                                        <div class="d-flex align-items-center">
                                                                                                                            <label class="form-check-label m-1"
                                                                                                                                for="stripeLabel"><?php echo e(__('Enable')); ?></label>
                                                                                                                            <div class="form-check form-switch custom-switch-v1">
                                                                                                                                    <input type="checkbox" name="paymentoption[]" id="stripeLabel" data-target="Stripe" class="paymentButton form-check-input input-primary" value="stripe" <?php echo e(isset($cardPayment_content->stripe) && is_object($cardPayment_content->stripe) && $cardPayment_content->stripe->status === 'on' ? 'checked' : ''); ?>>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </button>
                                                                                                                </h2>
                                                                                                                <div id="collapseStripe" class="accordion-collapse collapse"
                                                                                                                    aria-labelledby="headingPayment" data-bs-parent="#accordionExample1">
                                                                                                                    <div class="accordion-body">
                                                                                                                        <div class="program-data-div row stripe-payment-card <?php echo e(isset($cardPayment_content->stripe) && is_object($cardPayment_content->stripe) && $cardPayment_content->stripe->status === 'on' ? 'active' : ''); ?>" id="stripeContainer">
                                                                                                                            <div class="col-md-6 col-sm-12">
                                                                                                                                <div class="form-group">
                                                                                                                                    <?php echo e(Form::label('stripe_key', __('Stripe Key'), ['class' => 'form-label'])); ?>

                                                                                                                                    <?php echo e(Form::text('stripe_key', isset($cardPayment_content->stripe) && is_object($cardPayment_content->stripe) ? $cardPayment_content->stripe->stripe_key : null, ['class' => 'form-control', 'placeholder' => __('Enter Stripe Key')])); ?><br>
                                                                                                                                    <?php if($errors->has('stripe_key')): ?>
                                                                                                                                        <span class="invalid-feedback d-block">
                                                                                                                                            <?php echo e($errors->first('stripe_key')); ?>

                                                                                                                                        </span>
                                                                                                                                    <?php endif; ?>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                            <div class="col-md-6  col-sm-12">
                                                                                                                                <div class="form-group">
                                                                                                                                    <?php echo e(Form::label('stripe_secret', __('Stripe Secret'), ['class' => 'form-label'])); ?>

                                                                                                                                    <?php echo e(Form::text('stripe_secret', isset($cardPayment_content->stripe)&& is_object($cardPayment_content->stripe) ?$cardPayment_content->stripe->stripe_secret:null, ['class' => 'form-control ', 'placeholder' => __('Enter Stripe Secret')])); ?>

                                                                                                                                    <?php if($errors->has('stripe_secret')): ?>
                                                                                                                                        <span class="invalid-feedback d-block">
                                                                                                                                            <?php echo e($errors->first('stripe_secret')); ?>

                                                                                                                                        </span>
                                                                                                                                    <?php endif; ?>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                    </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="accordion-item card">
                                                                                                                <h2 class="accordion-header">
                                                                                                                    <button class="accordion-button collapsed" type="button"
                                                                                                                        data-bs-toggle="collapse" data-bs-target="#collapsePaypal"
                                                                                                                        aria-expanded="false" aria-controls="collapsePaypal">
                                                                                                                        <span class="d-flex align-items-center">

                                                                                                                            <?php echo e(__('Paypal')); ?>

                                                                                                                        </span>
                                                                                                                        <div class="d-flex align-items-center">
                                                                                                                            <label class="form-check-label m-1"
                                                                                                                                for="is_flutterwave_enabled"><?php echo e(__('Enable')); ?></label>
                                                                                                                            <div class="form-check form-switch custom-switch-v1">

                                                                                                                                    <input type="checkbox" name="paymentoption[]" id="paypal" data-target="Paypal" class="paymentButton form-check-input input-primary" value="paypal" <?php echo e(isset($cardPayment_content->paypal) && is_object($cardPayment_content->paypal) && $cardPayment_content->paypal->status === 'on' ? 'checked' : ''); ?>>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </button>
                                                                                                                </h2>
                                                                                                                <div id="collapsePaypal" class="accordion-collapse collapse"
                                                                                                                    aria-labelledby="headingPayment" data-bs-parent="#accordionExample1">
                                                                                                                    <div class="accordion-body">
                                                                                                                        <div class="program-data-div paypal-payment-card <?php echo e(isset($cardPayment_content->paypal) && is_object($cardPayment_content->paypal) && $cardPayment_content->paypal->status === 'on' ? 'active' : ''); ?>" id="paypalContainer">
                                                                                                                            <div class="row">
                                                                                                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                                                                                    <div class="row pt-2">
                                                                                                                                        <label class="pb-2"
                                                                                                                                            for="paypal_mode"><?php echo e(__('Paypal Mode')); ?></label>
                                                                                                                                        <div class="col-md-6 col-12" >
                                                                                                                                            <div class="border card p-3">
                                                                                                                                                <div class="form-check">
                                                                                                                                                    <input type="radio"
                                                                                                                                                        class="form-check-input input-primary"
                                                                                                                                                        name="paypal_mode" value="sandbox" <?php echo e(isset($cardPayment_content->paypal) && $cardPayment_content->paypal->paypal_mode === 'sandbox' ? 'checked' : ''); ?>>
                                                                                                                                                    <label class="form-check-label d-block"
                                                                                                                                                        for="">
                                                                                                                                                        <span>
                                                                                                                                                            <span class="h5 d-block paypal-mode-check"><strong
                                                                                                                                                                    class="float-end"></strong><?php echo e(__('Sandbox')); ?></span>
                                                                                                                                                        </span>
                                                                                                                                                    </label>
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                        <div class="col-md-6 col-12">
                                                                                                                                            <div class="border card p-3">
                                                                                                                                                <div class="form-check">
                                                                                                                                                    <input type="radio"
                                                                                                                                                        class="form-check-input input-primary"
                                                                                                                                                        name="paypal_mode" value="live" <?php echo e(isset($cardPayment_content->paypal)&&$cardPayment_content->paypal->paypal_mode === 'live' ? 'checked' : ''); ?>>
                                                                                                                                                    <label class="form-check-label d-block"
                                                                                                                                                        for="">
                                                                                                                                                        <span>
                                                                                                                                                            <span class="h5 d-block paypal-mode-check"><strong
                                                                                                                                                                    class="float-end"></strong><?php echo e(__('Live')); ?></span>
                                                                                                                                                        </span>
                                                                                                                                                    </label>
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                                <div class="card-payment-info">
                                                                                                                                <div class="col-md-6 col-12">
                                                                                                                                    <div class="form-group">
                                                                                                                                        <label for="paypal_client_id"
                                                                                                                                            class="form-label"><?php echo e(__('Client ID')); ?></label>
                                                                                                                                            <input type="text" name="paypal_client_id"
                                                                                                                                            id="paypal_client_id" class="form-control"
                                                                                                                                            value="<?php echo e(is_object($cardPayment_content) && property_exists($cardPayment_content, 'paypal') ? $cardPayment_content->paypal->paypal_client_id : ''); ?>"
                                                                                                                                            placeholder="<?php echo e(__('Client ID')); ?>" />
                                                                                                                                        <?php if($errors->has('paypal_client_id')): ?>
                                                                                                                                            <span class="invalid-feedback d-block">
                                                                                                                                                <?php echo e($errors->first('paypal_client_id')); ?>

                                                                                                                                            </span>
                                                                                                                                        <?php endif; ?>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                                <div class="col-md-6 col-12">
                                                                                                                                    <div class="form-group">
                                                                                                                                        <label for="paypal_secret_key"
                                                                                                                                            class="form-label"><?php echo e(__('Secret Key')); ?></label>
                                                                                                                                        <input type="text" name="paypal_secret_key"
                                                                                                                                            id="paypal_secret_key" class="form-control"
                                                                                                                                            value="<?php echo e(is_object($cardPayment_content) && property_exists($cardPayment_content, 'paypal') ? $cardPayment_content->paypal->paypal_secret_key:''); ?>"
                                                                                                                                            placeholder="<?php echo e(__('Secret Key')); ?>"/><br>
                                                                                                                                        <?php if($errors->has('paypal_secret_key')): ?>
                                                                                                                                            <span class="invalid-feedback d-block">
                                                                                                                                                <?php echo e($errors->first('paypal_secret_key')); ?>

                                                                                                                                            </span>
                                                                                                                                        <?php endif; ?>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            

                                                            
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header" id="headingeight">
                                                                    <button class="accordion-button collapsed"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#collapseeight"
                                                                        aria-expanded="false"
                                                                        aria-controls="collapseeight">
                                                                        <span class="d-flex align-items-center"><?php echo e(__('Gallery')); ?></span>
                                                                        <div class="d-flex align-items-center">
                                                                            <span class="me-2"><?php echo e(__('On/Off:')); ?></span>
                                                                            <div
                                                                                class="form-check form-switch custom-switch-v1">
                                                                                <input type="hidden" name="is_gallery_enabled" value="off"/>
                                                                                <input type="checkbox" name="is_gallery_enabled" id="is_gallery_enabled"
                                                                                    class="form-check-input input-primary" <?php echo e(isset($gallery['is_enabled']) && $gallery['is_enabled'] == '1' ? 'checked="checked"' : ''); ?>/>
                                                                                <label class="form-check-label"
                                                                                    for="is_gallery_enabled"></label>
                                                                            </div>
                                                                        </div>
                                                                    </button>
                                                                </h2>

                                                                <div id="collapseeight"
                                                                    class="accordion-collapse collapse"
                                                                    aria-labelledby="headingeight"
                                                                    data-bs-parent="#accordionExample">

                                                                    <div class="accordion-body ">
                                                                        <div class="showGallery">
                                                                            
                                                                            <div class="col-12">
                                                                                <div class="row gy-2 gx-2 my-3 gallery-btn" >
                                                                                    <?php $__currentLoopData = \App\Models\Utility::gallaryoption(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $gallary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                        <div class="col-auto">
                                                                                                <label for="enable_<?php echo e($k); ?>"
                                                                                                class="btn btn-secondary">
                                                                                                <input type="radio" class="d-none btn btn-secondary gallery_click"
                                                                                                    name="galleryoption" value="<?php echo e($k); ?>" onclick="getSelectedGalleryValue()"
                                                                                                    id="enable_<?php echo e($k); ?>"/><i class="me-2" data-feather="folder"></i>
                                                                                                <?php echo e(__($gallary)); ?>

                                                                                                </label>
                                                                                        </div>
                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            
                                                                            <div class="upload-file-div video d-none img-validate-class img-validate-class-detail">
                                                                                <?php echo e(Form::label('upload_video', __('Upload Video'), ['class' => 'form-label'])); ?>

                                                                                <div class="choose-file">
                                                                                    <input class="file-validate custom-input-file custom-input-file-link  upload_video d-none" type="file" name="upload_video" id="file-6" onchange="showvideoname()">
                                                                                    <label for="file-6">
                                                                                        <button type="button" onclick="selectFile('upload_video')" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-upload me-2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                                                                                            <?php echo e(__('Choose a file...')); ?></button>
                                                                                        </label>
                                                                                        <span class="uploaded_video_name"></span>
                                                                                </div>
                                                                                <p class="file-error text-danger" style=""></p>
                                                                                <p class="error-msg-video text-danger" style=""><?php echo e(__('You can`t upload mp4 video because superadmin has not allowed it in storage settings.')); ?></p>
                                                                            </div>

                                                                            <div class="upload-file-div image d-none img-validate-class img-validate-class-detail">
                                                                                <?php echo e(Form::label('upload_image', __('Upload Image'), ['class' => 'form-label'])); ?>

                                                                                <div class="choose-file">
                                                                                    <input class="file-validate custom-input-file custom-input-file-link  upload_image1 d-none" onchange="showimagename()" type="file" name="upload_image" id="file-7">
                                                                                    <label for="file-7">
                                                                                        <button type="button" onclick="selectFile('upload_image1')" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-upload me-2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                                                                                            <?php echo e(__('Choose a file...')); ?></button>
                                                                                        </label>
                                                                                        <span class="uploaded_image_name"></span>
                                                                                </div>
                                                                                <p class="file-error-detail text-danger" style=""></p>
                                                                            </div>

                                                                            <div class="upload-file-div form-group col-md-12 custom_video d-none">
                                                                                <?php echo e(Form::label('custom_video_link', __('Custom video link'), ['class' => 'form-label'])); ?>

                                                                                <div class="input-group">
                                                                                <?php echo e(Form::text('custom_video_link', null, ['class' => 'form-control', 'placeholder' => __('Enter Your Custom Video Link')])); ?>

                                                                                </div>
                                                                            </div>

                                                                            <div class="upload-file-div form-group col-md-12 custom_image d-none">
                                                                                <?php echo e(Form::label('custom_image_link', __('Custom image link'), ['class' => 'form-label'])); ?>

                                                                                <div class="input-group">
                                                                                <?php echo e(Form::text('custom_image_link', null, ['class' => 'form-control', 'placeholder' => __('Enter Your Custom Image Link')])); ?>

                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="gallery-main">
                                                                                <div class="row">
                                                                                    <div class="col-12">
                                                                                        <div class="bussiness-hours-header">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-2">
                                                                                                    <span><?php echo e(__('Content Type')); ?></span>
                                                                                                </div>
                                                                                                <div class="col-lg-8">
                                                                                                    <span><?php echo e(__('Preview')); ?></span>
                                                                                                </div>
                                                                                                <div class="col-lg-2">
                                                                                                    <span><?php echo e(__('Delete')); ?></span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <?php if(!is_null($gallery_contents)): ?>
                                                                                    <?php $__currentLoopData = $gallery_contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery_key => $gallery_content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                        <div class="gallery-row row align-items-center gallary_data inputFormRow5" data-id="<?php echo e($gallery_row_no); ?>" id="inputFormRow5">
                                                                                            <?php if(isset($gallery_content->type)): ?>
                                                                                                <?php if($gallery_content->type=='video'): ?>
                                                                                                    <div class="col-md-3 col-12">
                                                                                                        <div class="title">
                                                                                                            <?php echo e(__('Video')); ?>

                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-7 col-12">
                                                                                                        <div class="img-wrp">
                                                                                                            <a href="<?php echo e($gallery_path.'/' . $gallery_content->value); ?>" target=_blank>
                                                                                                                <video height="" controls>
                                                                                                                    <source id="videoresource" src="<?php echo e(isset($gallery_content->value) && !empty($gallery_content->value) ? $gallery_path.'/'. $gallery_content->value : asset('custom/img/logo-placeholder-image-2.png')); ?>" type="video/mp4">
                                                                                                                </video>
                                                                                                            </a>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-2 col-12">
                                                                                                        <span class=icon>
                                                                                                            <a href="javascript:void(0)" class="close-btn remove_gallery" id="" data-id="<?php echo e($gallery_content->id); ?>">
                                                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                                                                                                                    <path opacity="0.4" d="M12.2539 22.6094C17.7768 22.6094 22.2539 18.1322 22.2539 12.6094C22.2539 7.08653 17.7768 2.60938 12.2539 2.60938C6.73106 2.60938 2.25391 7.08653 2.25391 12.6094C2.25391 18.1322 6.73106 22.6094 12.2539 22.6094Z" fill="#FF0F00">
                                                                                                                    </path>
                                                                                                                    <path d="M13.3149 12.6092L15.7849 10.1392C16.0779 9.84618 16.0779 9.37115 15.7849 9.07815C15.4919 8.78515 15.0169 8.78515 14.7239 9.07815L12.2539 11.5482L9.78393 9.07815C9.49093 8.78515 9.01592 8.78515 8.72292 9.07815C8.42992 9.37115 8.42992 9.84618 8.72292 10.1392L11.1929 12.6092L8.72292 15.0791C8.42992 15.3721 8.42992 15.8472 8.72292 16.1402C8.86892 16.2862 9.06092 16.3601 9.25292 16.3601C9.44492 16.3601 9.63692 16.2872 9.78292 16.1402L12.2529 13.6701L14.7229 16.1402C14.8689 16.2862 15.0609 16.3601 15.2529 16.3601C15.4449 16.3601 15.6369 16.2872 15.7829 16.1402C16.0759 15.8472 16.0759 15.3721 15.7829 15.0791L13.3149 12.6092Z" fill="#FF0F00">
                                                                                                                    </path>
                                                                                                                </svg>
                                                                                                            </a>
                                                                                                        </span>
                                                                                                    </div>
                                                                                                    <?php elseif($gallery_content->type=='image'): ?>
                                                                                                        <div class="col-md-3 col-12">
                                                                                                            <div class="title">
                                                                                                                <?php echo e(__('Image')); ?>

                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-7 col-12">
                                                                                                            <div class="img-wrp">
                                                                                                                <a href="<?php echo e($gallery_path.'/' . $gallery_content->value); ?>" target=_blank>
                                                                                                                    <img src="<?php echo e(isset($gallery_content->value) && !empty($gallery_content->value) ? $gallery_path.'/'. $gallery_content->value : asset('custom/img/logo-placeholder-image-2.png')); ?>"
                                                                                                                    alt="images" id="upload_image">
                                                                                                                </a>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-2 col-12">
                                                                                                            <span class=icon>
                                                                                                                <a href="javascript:void(0)" class="close-btn remove_gallery" id="" data-id="<?php echo e($gallery_content->id); ?>">
                                                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                                                                                                                        <path opacity="0.4" d="M12.2539 22.6094C17.7768 22.6094 22.2539 18.1322 22.2539 12.6094C22.2539 7.08653 17.7768 2.60938 12.2539 2.60938C6.73106 2.60938 2.25391 7.08653 2.25391 12.6094C2.25391 18.1322 6.73106 22.6094 12.2539 22.6094Z" fill="#FF0F00">
                                                                                                                        </path>
                                                                                                                        <path d="M13.3149 12.6092L15.7849 10.1392C16.0779 9.84618 16.0779 9.37115 15.7849 9.07815C15.4919 8.78515 15.0169 8.78515 14.7239 9.07815L12.2539 11.5482L9.78393 9.07815C9.49093 8.78515 9.01592 8.78515 8.72292 9.07815C8.42992 9.37115 8.42992 9.84618 8.72292 10.1392L11.1929 12.6092L8.72292 15.0791C8.42992 15.3721 8.42992 15.8472 8.72292 16.1402C8.86892 16.2862 9.06092 16.3601 9.25292 16.3601C9.44492 16.3601 9.63692 16.2872 9.78292 16.1402L12.2529 13.6701L14.7229 16.1402C14.8689 16.2862 15.0609 16.3601 15.2529 16.3601C15.4449 16.3601 15.6369 16.2872 15.7829 16.1402C16.0759 15.8472 16.0759 15.3721 15.7829 15.0791L13.3149 12.6092Z" fill="#FF0F00">
                                                                                                                        </path>
                                                                                                                    </svg>
                                                                                                                </a>
                                                                                                            </span>
                                                                                                        </div>
                                                                                                    <?php elseif($gallery_content->type=='custom_video_link'): ?>
                                                                                                        <div class="col-md-3 col-12">
                                                                                                            <div class="title">
                                                                                                                <?php echo e(__('Custom video link')); ?>

                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-7 col-12">
                                                                                                            <div class="img-wrp">
                                                                                                                <a href="<?php echo e($gallery_content->value); ?>" target=_blank>
                                                                                                                <video height="" controls poster="<?php echo e(asset('custom/img/video_youtube.jpg')); ?>">
                                                                                                                    <source id="videoresource1" src="<?php echo e(isset($gallery_content->value) && !empty($gallery_content->value) ? $gallery_content->value : asset('custom/img/logo-placeholder-image-2.png')); ?>" type="video/mp4">
                                                                                                                </video>
                                                                                                                </a>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-2 col-12">
                                                                                                            <span class=icon>
                                                                                                                <a href="javascript:void(0)" class="close-btn remove_gallery" id="" data-id="<?php echo e($gallery_content->id); ?>">
                                                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                                                                                                                        <path opacity="0.4" d="M12.2539 22.6094C17.7768 22.6094 22.2539 18.1322 22.2539 12.6094C22.2539 7.08653 17.7768 2.60938 12.2539 2.60938C6.73106 2.60938 2.25391 7.08653 2.25391 12.6094C2.25391 18.1322 6.73106 22.6094 12.2539 22.6094Z" fill="#FF0F00">
                                                                                                                        </path>
                                                                                                                        <path d="M13.3149 12.6092L15.7849 10.1392C16.0779 9.84618 16.0779 9.37115 15.7849 9.07815C15.4919 8.78515 15.0169 8.78515 14.7239 9.07815L12.2539 11.5482L9.78393 9.07815C9.49093 8.78515 9.01592 8.78515 8.72292 9.07815C8.42992 9.37115 8.42992 9.84618 8.72292 10.1392L11.1929 12.6092L8.72292 15.0791C8.42992 15.3721 8.42992 15.8472 8.72292 16.1402C8.86892 16.2862 9.06092 16.3601 9.25292 16.3601C9.44492 16.3601 9.63692 16.2872 9.78292 16.1402L12.2529 13.6701L14.7229 16.1402C14.8689 16.2862 15.0609 16.3601 15.2529 16.3601C15.4449 16.3601 15.6369 16.2872 15.7829 16.1402C16.0759 15.8472 16.0759 15.3721 15.7829 15.0791L13.3149 12.6092Z" fill="#FF0F00">
                                                                                                                        </path>
                                                                                                                    </svg>
                                                                                                                </a>
                                                                                                            </span>
                                                                                                        </div>
                                                                                                    <?php elseif($gallery_content->type=='custom_image_link'): ?>
                                                                                                        <div class="col-md-3 col-12">
                                                                                                            <div class="title">
                                                                                                                <?php echo e(__('Custom image link')); ?>

                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-7 col-12">
                                                                                                            <div class="img-wrp">
                                                                                                                <a href="<?php echo e($gallery_content->value); ?>" target=_blank>
                                                                                                                    <img id="imageresource1" src="<?php echo e(isset($gallery_content->value) && !empty($gallery_content->value) ? $gallery_content->value : asset('custom/img/logo-placeholder-image-2.png')); ?>" alt="images" id="upload_image">
                                                                                                                </a>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-2 col-12">
                                                                                                            <span class=icon>
                                                                                                                <a href="javascript:void(0)" class="close-btn remove_gallery" id="" data-id="<?php echo e($gallery_content->id); ?>">
                                                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                                                                                                                        <path opacity="0.4" d="M12.2539 22.6094C17.7768 22.6094 22.2539 18.1322 22.2539 12.6094C22.2539 7.08653 17.7768 2.60938 12.2539 2.60938C6.73106 2.60938 2.25391 7.08653 2.25391 12.6094C2.25391 18.1322 6.73106 22.6094 12.2539 22.6094Z" fill="#FF0F00">
                                                                                                                        </path>
                                                                                                                        <path d="M13.3149 12.6092L15.7849 10.1392C16.0779 9.84618 16.0779 9.37115 15.7849 9.07815C15.4919 8.78515 15.0169 8.78515 14.7239 9.07815L12.2539 11.5482L9.78393 9.07815C9.49093 8.78515 9.01592 8.78515 8.72292 9.07815C8.42992 9.37115 8.42992 9.84618 8.72292 10.1392L11.1929 12.6092L8.72292 15.0791C8.42992 15.3721 8.42992 15.8472 8.72292 16.1402C8.86892 16.2862 9.06092 16.3601 9.25292 16.3601C9.44492 16.3601 9.63692 16.2872 9.78292 16.1402L12.2529 13.6701L14.7229 16.1402C14.8689 16.2862 15.0609 16.3601 15.2529 16.3601C15.4449 16.3601 15.6369 16.2872 15.7829 16.1402C16.0759 15.8472 16.0759 15.3721 15.7829 15.0791L13.3149 12.6092Z" fill="#FF0F00">
                                                                                                                        </path>
                                                                                                                    </svg>
                                                                                                                </a>
                                                                                                            </span>
                                                                                                        </div>
                                                                                                    <?php endif; ?>

                                                                                                    <?php endif; ?>
                                                                                                </div>
                                                                                                <?php
                                                                                                $gallery_row_no++;
                                                                                                ?>

                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                    <input type="hidden" name="gallery_count" value="<?php echo e($gallery_row_no); ?>">
                                                                                    <input type="hidden" name="galary_data" value="">
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            

                                                            
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header" id="headingten">
                                                                    <button class="accordion-button collapsed"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#collapseten"
                                                                        aria-expanded="false"
                                                                        aria-controls="collapseten">
                                                                        <span class="d-flex align-items-center"><?php echo e(__('Custom HTML')); ?></span>
                                                                        <div class="d-flex align-items-center">
                                                                            <span class="me-2"><?php echo e(__('On/Off:')); ?></span>
                                                                            <div
                                                                                class="form-check form-switch custom-switch-v1">
                                                                                <input type="hidden" name="is_custom_html_enabled" value="off"/>
                                                                                <input type="checkbox" name="is_custom_html_enabled" id="is_custom_html_enabled"
                                                                                    class="form-check-input input-primary"
                                                                                    <?php echo e(isset($customhtml['is_custom_html_enabled']) && $customhtml['is_custom_html_enabled'] == '1' ? 'checked="checked"' : ''); ?>/>
                                                                                <label class="form-check-label"
                                                                                    for="is_custom_html_enabled"></label>
                                                                            </div>
                                                                        </div>
                                                                    </button>
                                                                </h2>
                                                                <div id="collapseten"
                                                                    class="accordion-collapse collapse"
                                                                    aria-labelledby="headingten"
                                                                    data-bs-parent="#accordionExample">
                                                                    <div class="accordion-body">
                                                                        <div class="form-group custom_html_text">
                                                                            <label class="d-block" for=""><?php echo e(__('HTML Code:')); ?></label>
                                                                            <label class="d-block mb-2"
                                                                                for=""><?php echo e(__('Description:')); ?></label>
                                                                            <textarea class="form-control" name="custom_html_text" id="<?php echo e($stringid); ?>_chtml" cols="30" rows="3" placeholder="<?php echo e(__('Enter Description')); ?>"><?php echo e(isset($customhtml['custom_html_text']) && $customhtml['custom_html_text'] ? $customhtml['custom_html_text'] : ''); ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            

                                                            
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header" id="headingsvg">
                                                                    <button class="accordion-button collapsed"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#collapsesvg"
                                                                        aria-expanded="false"
                                                                        aria-controls="collapsesvg">
                                                                        <span class="d-flex align-items-center"><?php echo e(__('Thank You')); ?></span>
                                                                        <div class="d-flex align-items-center">
                                                                            <span class="me-2"><?php echo e(__('On/Off:')); ?></span>
                                                                            <div
                                                                                class="form-check form-switch custom-switch-v1">
                                                                                <input type="hidden" name="is_svg_enabled" value="off"/>
                                                                                <input type="checkbox" name="is_svg_enabled" id="is_svg_enabled"
                                                                                    class="form-check-input input-primary"
                                                                                    <?php echo e(isset($customhtml['is_svg_enabled']) && $customhtml['is_svg_enabled'] == '1' ? 'checked="checked"' : ''); ?>/>
                                                                                <label class="form-check-label"
                                                                                    for="is_svg_enabled"></label>
                                                                            </div>
                                                                        </div>
                                                                    </button>
                                                                </h2>
                                                                <div id="collapsesvg"
                                                                    class="accordion-collapse collapse"
                                                                    aria-labelledby="headingsvg"
                                                                    data-bs-parent="#accordionExample">
                                                                    <div class="accordion-body">
                                                                        <div class="form-group svg_text upload-file-div">
                                                                            <?php echo e(Form::label('upload_image', __('Upload Image'), ['class' => 'form-label'])); ?>

                                                                            <div class="choose-file">
                                                                            <input class="d-none svg_text" type="file"  name="svg_text" id="svg" >
                                                                                <label for="SVG">
                                                                                <button type="button"
                                                                                    onclick="selectFile('svg_text')" class="btn btn-primary"><i
                                                                                    class="me-2" data-feather="upload"></i><?php echo e(__('Choose a file...')); ?></button>
                                                                            </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-end mt-4">
                                                    <button type="submit" class="btn btn-primary"> <i class="me-2"
                                                            data-feather="folder"></i> <?php echo e(__('Save Changes')); ?>

                                                    </button>
                                                </div>
                                                <?php echo e(Form::close()); ?>

                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-5">
                                            <div id="sticky" class="theme-preview large-preview preview-height">
                                                <div  class="theme-preview-body">
                                                    <div class="mb-3">
                                                        

                                                        <h5><?php echo e(__('Preview')); ?></h5>
                                                    </div>
                                                    <?php echo $__env->make('card.' . $card_theme->theme . '.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <div class="tab-pane fade <?php if(session('tab') and session('tab') == 3): ?> show active <?php endif; ?>" id="domain-setting" role="tabpanel"
                                aria-labelledby="pills-user-tab-3">
                                <div class="row gy-4">
                                    <div class="col-lg-8 col-md-7">
                                        <?php echo e(Form::open(['route' => ['business.domain-setting', $business->id], 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                                            <div class="theme-detail-card">
                                                <div class="d-flex flex-wrap align-items-center justify-content-between mb-3 gap-3">
                                                    <h5 class="mb-0"><?php echo e(__('Custom Domain')); ?></h5>
                                                    <button type="submit" class="btn btn-primary"> <i class="me-2" data-feather="folder"></i> <?php echo e(__('Save Changes')); ?></button>
                                                </div>
                                                <div class="row gy-3">
                                                    
                                                    <?php if($plan->enable_custdomain == 'on' || $plan->enable_custsubdomain == 'on'): ?>
                                                        <div class="col-12">
                                                            <div class="row gy-3">
                                                                <div class="col-auto <?php echo e($business->enable_businesslink == 'on' ? 'active' : ''); ?>">
                                                                        <label for="enable_storelink"
                                                                            class="btn btn-secondary <?php echo e($business->enable_businesslink == 'on' ? 'active' : ''); ?>">
                                                                            <input type="radio" class="btn btn-secondary domain_click d-none"
                                                                                name="enable_domain" value="enable_businesslink"
                                                                                id="enable_storelink"
                                                                                <?php echo e($business->enable_businesslink == 'on' ? 'checked' : ''); ?>/><i class="me-2" data-feather="folder"></i>
                                                                            <?php echo e(__('Business Link')); ?>

                                                                        </label>
                                                                </div>
                                                                <?php if($plan->enable_custdomain == 'on'): ?>
                                                                    <div class="col-auto <?php echo e($business->enable_domain == 'on' ? 'active' : ''); ?>">
                                                                            <label for="enable_domain"
                                                                            class="btn btn-secondary <?php echo e($business->enable_domain == 'on' ? 'active' : ''); ?>">
                                                                            <input type="radio" class="domain_click d-none btn btn-secondary"
                                                                                name="enable_domain" value="enable_domain"
                                                                                id="enable_domain"
                                                                                <?php echo e($business->enable_domain == 'on' ? 'checked' : ''); ?>/><i class="me-2" data-feather="folder"></i>
                                                                            <?php echo e(__('Domain')); ?>

                                                                        </label>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <?php if($plan->enable_custsubdomain == 'on'): ?>
                                                                    <div class="col-auto" <?php echo e($business->enable_subdomain == 'on' ? 'active' : ''); ?>>
                                                                            <label for="enable_subdomain"
                                                                            class="btn btn-secondary <?php echo e($business->enable_subdomain == 'on' ? 'active' : ''); ?>">
                                                                            <input type="radio" class="domain_click d-none btn btn-secondary"
                                                                                name="enable_domain" value="enable_subdomain"
                                                                                id="enable_subdomain"
                                                                                <?php echo e($business->enable_subdomain == 'on' ? 'checked' : ''); ?>><i class="me-2" data-feather="folder"></i>
                                                                            <?php echo e(__('Sub Domain')); ?>

                                                                        </label>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-group mb-0" id="StoreLink" style="<?php echo e($business->enable_businesslink == 'on' ? 'display: block' : 'display: none'); ?>">
                                                                <label class="form-label"><?php echo e(__('Business Link:')); ?></label>
                                                                <div class="row gy-2">
                                                                    <div class="col-xl-11 col-lg-9 col-md-8">
                                                                        <input type="text" class="form-control d-inline-block" id="myInput"
                                                                            value="<?php echo e($business_url); ?>" readonly/>
                                                                    </div>
                                                                    <div class="col-xl-1 col-lg-3 col-md-4">
                                                                        <button type="button" class="btn btn-primary w-100" data-bs-toggle="tooltip" data-bs-placement="top"   data-bs-original-title="<?php echo e(__('Copy Business Link')); ?>" title="<?php echo e(__('Copy Business Link')); ?>" id="button-addon2" onclick="myFunction()"><i
                                                                            class="far fa-copy" ></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-12 domain"
                                                                style="<?php echo e($business->enable_domain == 'on' ? 'display:block' : 'display:none'); ?>">
                                                                <?php echo e(Form::label('business_domain', __('Custom Domain'), ['class' => 'form-label'])); ?>

                                                                <?php echo e(Form::text('domains', $business->domains, ['class' => 'form-control', 'placeholder' => __('xyz.com')])); ?>

                                                            </div>
                                                            <?php if($domainPointing == 1): ?>
                                                                <div class="form-group col-md-12 text-sm mt-3" id="domainnote"
                                                                    style="display: none">
                                                                    <span><b class="text-success"><?php echo e(__('Note : Before add Custom Domain, your domain A record is pointing to our server IP :')); ?><?php echo e($serverIp); ?>|
                                                                        <?php echo e(__('Your Custom Domain IP Is This: ')); ?><?php echo e($domainip); ?></b></span>
                                                                    <br>
                                                                </div>
                                                            <?php else: ?>
                                                                    <div class="form-group col-md-12 text-sm mt-3" id="domainnote"
                                                                    style="display: none">
                                                                    <span><b><?php echo e(__('Note : Before add Custom Domain, your domain A record is pointing to our server IP :')); ?><?php echo e($serverIp); ?>|</b>
                                                                        <b
                                                                            class="text-danger"><?php echo e(__('Your Custom Domain IP Is This: ')); ?><?php echo e($domainip); ?></b></span>
                                                                    <br>
                                                                </div>
                                                            <?php endif; ?>
                                                            
                                                            <?php if($plan->enable_custsubdomain == 'on'): ?>
                                                                <div class="form-group col-md-12 sundomain"
                                                                    style="<?php echo e($business->enable_subdomain == 'on' ? 'display:block' : 'display:none'); ?>">
                                                                    <?php echo e(Form::label('business_subdomain', __('Sub Domain'), ['class' => 'form-label'])); ?>

                                                                    <div class="input-group">
                                                                        <?php echo e(Form::text('subdomain', $business->slug, ['class' => 'form-control', 'placeholder' => __('Enter Domain'), 'readonly'])); ?>

                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text h-44 py-1"
                                                                                id="basic-addon2">.<?php echo e($subdomain_name); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if($subdomainPointing == 1): ?>
                                                                <div class="text-sm mt-2" id="subdomainnote"
                                                                    style="display: none">
                                                                    <span><b class="text-success"><?php echo e(__('Note : Before add Sub Domain, your domain A record is pointing to our server IP :')); ?><?php echo e($serverIp); ?>|
                                                                            <?php echo e(__('Your Sub Domain IP Is This: ')); ?><?php echo e($domainip); ?></b></span>
                                                                </div>
                                                            <?php else: ?>
                                                                <div class="text-sm mt-2" id="subdomainnote"
                                                                    style="display: none">
                                                                    <span><b><?php echo e(__('Note : Before add Sub Domain, your domain A record is pointing to our server IP :')); ?><?php echo e($serverIp); ?>|</b>
                                                                        <b
                                                                            class="text-danger"><?php echo e(__('Your Sub Domain IP Is This: ')); ?><?php echo e($domainip); ?></b></span>
                                                                </div>
                                                            <?php endif; ?>

                                                        </div>
                                                    <?php else: ?>
                                                        <div class="form-group">
                                                            <div class="form-group" id="StoreLink">
                                                                <label class="form-label"><?php echo e(__('Business Link:')); ?></label>
                                                                <div class="row gy-2">
                                                                    <div class="col-xl-10 col-lg-8 col-md-7">
                                                                        <input type="text" class="form-control d-inline-block" id="myInput"
                                                                            value="<?php echo e($business_url); ?>" readonly/>
                                                                    </div>
                                                                    <div class="col-xl-2 col-lg-4 col-md-5">
                                                                        <button type="button" class="btn btn-primary w-100" id="button-addon2" onclick="myFunction()"><i
                                                                                class="me-2 far fa-copy" ></i><?php echo e(__('Copy Link')); ?> </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    

                                                    
                                                    <div class="col-12">
                                                        <h5 class="mb-0"><?php echo e(__('Custom JS and CSS')); ?></h5>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="form-label" for=""><?php echo e(__('Custom JS:')); ?></label>
                                                            <textarea class="form-control" name="customjs" placeholder="<?php echo e(__('Enter your custom JavaScript code here')); ?>" cols="10" rows="3"><?php echo e($business->customjs); ?></textarea>
                                                            <?php $__errorArgs = ['customjs'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <span class="invalid-about" role="alert">
                                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                </span>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-0">
                                                            <label class="form-label" for=""><?php echo e(__('Custom CSS:')); ?></label>
                                                            <textarea class="form-control" name="customcss" placeholder="<?php echo e(__('Enter your custom CSS code here')); ?>"  cols="10" rows="3"><?php echo e($business->customcss); ?></textarea>
                                                            <?php $__errorArgs = ['customcss'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <span class="invalid-about" role="alert">
                                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                </span>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                    </div>
                                                    

                                                    
                                                    <div class="col-md-6">
                                                        <div class="mb-2">
                                                            <h5 class="mb-0"><?php echo e(__('Google Fonts:')); ?></h5>
                                                        </div>
                                                        <div class="form-group mb-0">
                                                            <label class="form-label" for=""><?php echo e(__('Font:')); ?></label>
                                                            <select class="form-control" name="google_fonts">
                                                                <option value=""><?php echo e(__('Select Font')); ?></option>
                                                                <?php $__currentLoopData = \App\Models\Utility::getfonts(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $fonts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($k); ?>" <?php echo e($business->google_fonts == $k ? 'selected' : ''); ?>>
                                                                        <?php if($k == 'TimesNewRoman'): ?>
                                                                            <?php echo e(__('Times New Roman')); ?>

                                                                        <?php elseif($k == 'OpenSans'): ?>
                                                                            <?php echo e(__('Open Sans')); ?>

                                                                        <?php elseif($k == 'WorkSans'): ?>
                                                                            <?php echo e(__('Work Sans')); ?>

                                                                        <?php elseif($k == 'PTSans'): ?>
                                                                            <?php echo e(__('PT Sans')); ?>

                                                                        <?php elseif($k == 'ConcertOne'): ?>
                                                                            <?php echo e(__('Concert One')); ?>

                                                                        <?php else: ?>
                                                                            <?php echo e($k); ?>

                                                                        <?php endif; ?>
                                                                    </option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                            <?php $__errorArgs = ['google_fonts'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <span class="invalid-favicon text-xs text-danger"
                                                                role="alert"><?php echo e($message); ?></span>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <div class="col-md-6">
                                                        <div class="mb-2 d-flex align-items-center justify-content-between">
                                                            <h5 class="mb-0 flex-grow-1"><?php echo e(__('Password:')); ?></h5>
                                                            <div class="d-flex align-items-center">
                                                                <span class="me-2"><?php echo e(__('On/Off:')); ?></span>
                                                                <div class="form-check form-switch custom-switch-v1">
                                                                    <input type="hidden" name="is_password_enabled" value="off">
                                                                    <input type="checkbox" name="is_password_enabled"
                                                                        class="form-check-input input-primary"
                                                                        id="is_password_enabled" <?php echo e(isset($business->enable_password) && $business->enable_password == 'on' ? 'checked="checked"' : ''); ?>/>
                                                                    <label class="form-check-label"
                                                                    id="is_password_enabled"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-0">
                                                            <label class="form-label" for=""><?php echo e(__('Type Password:')); ?></label>
                                                            <input class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="password"  name="password" id="input-password"
                                                                placeholder="****************" value="<?php echo e($business->password); ?>"/>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <?php if($plan->enable_branding == 'on'): ?>
                                                        <div class="col-12">
                                                            <div class="mb-2 d-flex align-items-center justify-content-between">
                                                                <h5 class="mb-0 flex-grow-1"><?php echo e(__('Branding:')); ?></h5>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-2"><?php echo e(__('On/Off:')); ?></span>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="checkbox"
                                                                            class="form-check-input input-primary"
                                                                            name="branding" id="branding" <?php echo e(isset($business['is_branding_enabled']) && $business['is_branding_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                        <label class="form-check-label"
                                                                            for="branding"></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group branding_text mb-0">
                                                                <label class="form-label" for=""><?php echo e(__('Description:')); ?></label>
                                                                <textarea class="form-control emojiarea" placeholder="<?php echo e(__('Enter Description')); ?>" name="branding_text" <?php echo e($business->branding); ?> id = "<?php echo e($stringid . '_branding'); ?>" type="text" name="branding_text" cols="30" rows="3" value="<?php echo e(isset($business['branding_text']) && $business['branding_text'] ? $business['branding_text'] : ''); ?>" placeholder="<?php echo e(isset($business['branding_text']) && $business['branding_text'] ? $business['branding_text'] : ''); ?>"class="form-control"><?php echo e(isset($business['branding_text']) && $business['branding_text'] ? $business['branding_text'] : ''); ?></textarea>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    

                                                </div>
                                                <div class="text-end mt-4">
                                                    <button type="submit" class="btn btn-primary"> <i class="me-2"
                                                            data-feather="folder"></i><?php echo e(__('Save Changes')); ?></button>
                                                </div>
                                            </div>
                                        <?php echo e(Form::close()); ?>

                                    </div>
                                    <div class="col-lg-4 col-md-5">
                                        <div class="theme-preview theme-preview-3">
                                            <div class="mb-3">
                                                <h5><?php echo e(__('Preview')); ?></h5>
                                            </div>
                                            <div class="theme-preview-body">
                                                <img src="<?php echo e(asset(Storage::url('uploads/card_theme/theme1/color1.png'))); ?>"
                                                class="theme_preview_img">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade <?php if(session('tab') and session('tab') == 4): ?> show active <?php endif; ?>" id="block-setting" role="tabpanel"
                                aria-labelledby="pills-user-tab-4">
                                <div class="row">
                                    <?php echo e(Form::open(['route' => ['business.block-setting', $business->id], 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                                    <div class="col-12">
                                        <div class="theme-detail-card">
                                            <div class="d-flex flex-wrap align-items-center justify-content-between mb-3 gap-3">
                                                <h5 class="mb-0"><?php echo e(__('Reorder Blocks')); ?></h5>
                                                <button type="submit" class="btn btn-primary"><i class="me-2" data-feather="folder" id="btnSubmit"></i>&nbsp;<?php echo e(__('Save Changes')); ?></button>
                                            </div>
                                            <ul class="list-unstyled list-group sortable">
                                                <input type="hidden" name="theme_name"
                                                    value="<?php echo e($card_theme->theme); ?>">
                                                <input type="hidden" name="order" value=""
                                                    id="hidden_order">
                                                <?php for($i = 1; $i <= 15; $i++): ?>
                                                    <?php $__currentLoopData = $card_theme->order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order_key => $order_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($i == $order_value): ?>
                                                        <li class="list-group-item d-flex align-items-center justify-content-between
                                                            <?php echo e($card_theme->theme == 'theme2' && $order_key == 'description' ? 'd-none' : ''); ?><?php echo e($card_theme->theme == 'theme3' && $order_key == 'description' ? 'd-none' : ''); ?> <?php echo e($card_theme->theme == 'theme4' && $order_key == 'description' ? 'd-none' : ''); ?> <?php echo e($card_theme->theme == 'theme5' && $order_key == 'description' ? 'd-none' : ''); ?> <?php echo e($card_theme->theme == 'theme6' && $order_key == 'description' ? 'd-none' : ''); ?>

                                                            <?php echo e(($card_theme->theme == 'theme7' || $card_theme->theme == 'theme8' || $card_theme->theme == 'theme11' || $card_theme->theme == 'theme14' || $card_theme->theme == 'theme10'|| $card_theme->theme == 'theme15'|| $card_theme->theme == 'theme18') && $order_key == 'product' || $order_key == 'description' ? 'd-none' : ''); ?>

                                                            <?php echo e($card_theme->theme == 'theme9' && $order_key == 'description' ? 'd-none' : ''); ?> <?php echo e($card_theme->theme == 'theme4' && $order_key == 'gallery' ? 'd-none' : ''); ?>"
                                                                data-id="<?php echo e($order_key); ?>">
                                                                <?php if($order_key == 'scan_me'): ?>
                                                                    <h6 class="mb-0">
                                                                        <i class="me-3" data-feather="move"></i>
                                                                        <span><?php echo e(__('Scan Me')); ?></span>
                                                                    </h6>
                                                                <?php elseif($order_key == 'contact_info'): ?>
                                                                    <h6 class="mb-0">
                                                                        <i class="me-3" data-feather="move"></i>
                                                                        <span><?php echo e(__('Contact Info')); ?></span>
                                                                    </h6>
                                                                <?php elseif($order_key == 'bussiness_hour'): ?>
                                                                   <h6 class="mb-0">
                                                                        <i class="me-3" data-feather="move"></i>
                                                                        <span><?php echo e(__('Bussiness Hour')); ?></span>
                                                                    </h6>

                                                                <?php elseif($order_key == 'custom_html'): ?>
                                                                        <h6 class="mb-0">
                                                                        <i class="me-3" data-feather="move"></i>
                                                                        <span><?php echo e(__('Custom HTML')); ?></span>
                                                                    </h6>
                                                                <?php elseif($order_key == 'google_map'): ?>
                                                                    <h6 class="mb-0">
                                                                    <i class="me-3" data-feather="move"></i>
                                                                    <span><?php echo e(__('Google Map')); ?></span>
                                                                </h6>
                                                                <?php elseif($order_key == 'svg'): ?>
                                                                    <h6 class="mb-0">
                                                                    <i class="me-3" data-feather="move"></i>
                                                                    <span><?php echo e(__('Thank You')); ?></span>
                                                                </h6>
                                                                <?php elseif($order_key == 'app_info'): ?>
                                                                    <h6 class="mb-0">
                                                                        <i class="me-3" data-feather="move"></i>
                                                                        <span><?php echo e(__('Apps Detail')); ?></span>
                                                                    </h6>

                                                                <?php else: ?>
                                                                    <h6 class="mb-0">
                                                                        <i class="me-3" data-feather="move"></i>
                                                                        <span><?php echo e(__(ucfirst($order_key))); ?></span>
                                                                    </h6>
                                                                <?php endif; ?>
                                                                <div class="d-flex align-items-center <?php echo e($card_theme->theme == 'theme5' && $order_key == 'social' ? 'd-none' : ''); ?>">
                                                                    <?php if($order_key != 'description' && $order_key != 'more' && $order_key != 'scan_me'): ?>
                                                                        <span class="me-2"><?php echo e(__('On/Off:')); ?></span>
                                                                        <div class="form-check form-switch custom-switch-v1">
                                                                            <input type="hidden"
                                                                                name="is_<?php echo e($order_key); ?>_enabled"
                                                                                value="off">

                                                                            <input type="checkbox"
                                                                                name="is_<?php echo e($order_key); ?>_enabled"
                                                                                class="form-check-input input-primary"
                                                                                id="is_<?php echo e($order_key); ?><?php echo e($order_key == 'custom_html' ? '11' : ''); ?>_enabled"
                                                                                <?php echo e(\App\Models\Utility::isEnableBlock($order_key, $business->id) == '1' ? 'checked="checked"' : ''); ?>/>
                                                                            <label class="form-check-label"
                                                                                for="is_<?php echo e($order_key); ?><?php echo e($order_key == 'custom_html' ? '11' : ''); ?>_enabled"></label>
                                                                        </div>
                                                                    <?php else: ?>
                                                                        <span><?php echo e(__('This is required')); ?></span>
                                                                    <?php endif; ?>
                                                                </div>

                                                            </li>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endfor; ?>
                                            </ul>

                                            <p class="mt-3 mb-0"><b><?php echo e(__('Note: You can easily order change of card blocks using drag & drop.')); ?></b></p>
                                        </div>
                                    </div>
                                    <?php echo e(Form::close()); ?>

                                </div>
                            </div>
                            <div class="tab-pane fade <?php if(session('tab') and session('tab') == 5): ?> show active <?php endif; ?>" id="seo-setting" role="tabpanel"
                                aria-labelledby="pills-user-tab-5">
                                <div class="row">

                                    <div class="col-12">
                                        <div class="theme-detail-card">
                                            <?php echo e(Form::open(['route' => ['business.seo-setting', $business->id], 'method' => 'POST', 'enctype' => 'multipart/form-data','class' => 'needs-validation', 'novalidate'])); ?>

                                             <div class="d-flex flex-wrap align-items-center justify-content-between mb-3 gap-3">
                                                <h5 class="mb-0"><?php echo e(__('SEO')); ?></h5>
                                                <button type="submit" class="btn btn-primary"> <i class="me-2" data-feather="folder"></i>&nbsp;<?php echo e(__('Save Changes')); ?> </button>
                                            </div>
                                            <?php if($chatgpt_setting['enable_chatgpt'] == 'on'): ?>
                                                    <div class="col-xl-12 col-lg-12 col-md-12 d-flex align-items-center justify-content-between justify-content-md-end"
                                                        data-bs-placement="top">
                                                        <a href="javascript:void(0)" data-size="lg" class="btn btn-sm btn-primary" data-ajax-popup-over="true"
                                                            data-url="<?php echo e(route('generate', ['seo'])); ?>" data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="<?php echo e(__('Generate')); ?>" data-title="<?php echo e(__('Generate content with AI')); ?>">
                                                            <i class="fas fa-robot"></i>&nbsp;<?php echo e(__('Generate with AI')); ?>

                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            <div class="row">
                                                <div class="col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <?php echo e(Form::label('meta_keyword', __('Meta Keywords'), ['class' => 'form-label'])); ?>

                                                        <?php echo e(Form::text('meta_keyword', $business->meta_keyword, ['class' => 'form-control', 'rows' => '3', 'placeholder' => __('Enter Meta Keywords')])); ?>

                                                    </div>
                                                <?php $__errorArgs = ['metakeywords'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-favicon text-xs text-danger"
                                                        role="alert"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <?php echo e(Form::label('google_analytic', __('Google Analytic'), ['class' => 'form-label'])); ?>

                                                        <?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaleab1765d328ab3f8835fc5d78676a070 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.required','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('required'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaleab1765d328ab3f8835fc5d78676a070)): ?>
<?php $attributes = $__attributesOriginaleab1765d328ab3f8835fc5d78676a070; ?>
<?php unset($__attributesOriginaleab1765d328ab3f8835fc5d78676a070); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaleab1765d328ab3f8835fc5d78676a070)): ?>
<?php $component = $__componentOriginaleab1765d328ab3f8835fc5d78676a070; ?>
<?php unset($__componentOriginaleab1765d328ab3f8835fc5d78676a070); ?>
<?php endif; ?>
                                                        <?php echo e(Form::text('google_analytic', $business->google_analytic, ['class' => 'form-control', 'placeholder' => __('UA-XXXXXXXXX-X'),'required'=>'required'])); ?>

                                                    </div>
                                                        <?php $__errorArgs = ['google_analytic'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="invalid-google_analytic" role="alert">
                                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <?php echo e(Form::label('meta_description', __('Meta Description'), ['class' => 'form-label'])); ?>

                                                        <?php echo e(Form::textarea('meta_description', $business->meta_description, ['class' => 'form-control', 'rows' => '3', 'cols' => '30', 'placeholder' => __('Enter Meta Description')])); ?>

                                                    </div>
                                                    <?php $__errorArgs = ['meta_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="invalid-favicon text-xs text-danger"
                                                            role="alert"><?php echo e($message); ?></span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="col-sm-6 col-12">
                                                    <div class="form-group">
                                                       <?php echo e(Form::label('facebook_pixel_code', __('Facebook Pixel'), ['class' => 'form-label'])); ?>

                                                       <?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaleab1765d328ab3f8835fc5d78676a070 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.required','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('required'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaleab1765d328ab3f8835fc5d78676a070)): ?>
<?php $attributes = $__attributesOriginaleab1765d328ab3f8835fc5d78676a070; ?>
<?php unset($__attributesOriginaleab1765d328ab3f8835fc5d78676a070); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaleab1765d328ab3f8835fc5d78676a070)): ?>
<?php $component = $__componentOriginaleab1765d328ab3f8835fc5d78676a070; ?>
<?php unset($__componentOriginaleab1765d328ab3f8835fc5d78676a070); ?>
<?php endif; ?>
                                                       <?php echo e(Form::text('fbpixel_code', $business->fbpixel_code, ['class' => 'form-control', 'placeholder' => __('UA-0000000-0'),'required'=>'required'])); ?>

                                                    </div>
                                                    <?php $__errorArgs = ['facebook_pixel_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-google_analytic" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                    </span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                        
                                                        <div class="col-md-6 col-12 form-group img-validate-class mb-0">
                                                            <?php echo e(Form::label('meta_image', __('Meta Image'), ['class' => 'form-label'])); ?>

                                                            <div class="setting-block">
                                                                <div class="choose-file-image position-relative rounded">
                                                                    <a href="<?php echo e(isset($business->meta_image) && !empty($business->meta_image) ? $meta_image . '/' . $business->meta_image : asset('custom/img/placeholder-image1.jpg')); ?>" target="_blank">

                                                                        <img id="blah" alt="your image"
                                                                        src="<?php echo e(isset($business->meta_image) && !empty($business->meta_image) ? $meta_image . '/' . $business->meta_image : asset('custom/img/placeholder-image1.jpg')); ?>"
                                                                            class="meta_images">
                                                                    </a>
                                                                    <div class="choose-file-wrp">
                                                                        <div class="choose-file">
                                                                            <label for="meta_image">
                                                                                <div class="btn btn-md bg-primary company_logo_update" style="color: white;"> <i
                                                                                    class="ti ti-upload px-1"></i><?php echo e(__('Select image')); ?>

                                                                                    </div>
                                                                                    <input type="file" class="form-control file file-validate" name="meta_image"
                                                                                    id="meta_image" data-filename="meta_image"
                                                                                    onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                                                            </label>
                                                                        </div>
                                                                        <?php $__errorArgs = ['meta_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <span class="invalid-company_logo text-xs text-danger"
                                                                            role="alert"><?php echo e($message); ?></span>
                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <p class="file-error text-danger mb-0" style=""></p>
                                                </div>
                                            </div>
                                            <?php echo e(Form::close()); ?>

                                        </div>
                                    </div>
                                    
                                    <div class="col-12 mt-4">
                                        <div class="theme-detail-card">
                                            <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
                                                <h5 class="mb-0"><?php echo e(__('Pixel Fields')); ?></h5>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pixel settings business')): ?>
                                                    <div class="d-flex align-items-center justify-content-between justify-content-md-end"
                                                    data-bs-placement="top" data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Create Pixel')); ?>">
                                                        <a href="#" class="btn btn-sm btn-primary btn-icon py-2 m-1" data-bs-target="#exampleModal"
                                                            data-url="<?php echo e(route('pixel.create',$business->id)); ?>" data-bs-whatever="<?php echo e(__('Create Pixel')); ?>" data-bs-toggle="modal">
                                                            <span class="text-white">
                                                                <i class="d-flex ti ti-plus text-white"></i>
                                                            </span>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover" id="dataTable">
                                                            <thead>
                                                            <tr>
                                                                <th> <?php echo e(__('Platform')); ?></th>
                                                                <th> <?php echo e(__('Pixel ID')); ?></th>
                                                                <th class="text-right" width="200px"> <?php echo e(__('Action')); ?></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $__currentLoopData = $PixelFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pixel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <tr>
                                                                        <td><?php echo e(ucfirst($pixel->platform)); ?></td>
                                                                        <td><?php echo e($pixel->pixel_id); ?></td>
                                                                        <td class="Action">
                                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pixel settings business')): ?>
                                                                            <span>
                                                                                <div class="action-btn  me-2" data-bs-placement="top"
                                                                                    data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Pixel Edit')); ?>" title="<?php echo e(__('Pixel Edit')); ?>">
                                                                                    <a href="#" class="btn btn-sm btn-info btn-icon py-2 m-1" data-bs-target="#exampleModal"
                                                                                        data-url="<?php echo e(route('pixel.edit',[$business->id, $pixel->id])); ?>"
                                                                                        data-bs-whatever="<?php echo e(__('Edit Pixel')); ?>" data-bs-toggle="modal" >
                                                                                        <span class="text-white">
                                                                                            <i class="d-flex ti ti-pencil text-white"></i></span>
                                                                                    </a>
                                                                                </div>

                                                                                <div class="action-btn me-2">
                                                                                    <a href="#"
                                                                                        class="bs-pass-para bg-danger mx-3 py-2 btn btn-sm d-inline-flex align-items-center"
                                                                                        data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                                                        data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                                                        data-confirm-yes="delete-form-<?php echo e($pixel->id); ?>"
                                                                                        title="<?php echo e(__('Delete')); ?>" data-bs-toggle="tooltip"
                                                                                        data-bs-placement="top"><span class="text-white"><i
                                                                                                class="d-flex ti ti-trash"></i></span></a>
                                                                                </div>
                                                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['pixel.destroy', $pixel->id],'id'=>'delete-form-'.$pixel->id]); ?>

                                                                                <?php echo Form::close(); ?>



                                                                            </span>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          
                                       </div>
                                    </div>
                            
                            <div class="tab-pane fade <?php if(session('tab') and session('tab') == 6): ?> show active <?php endif; ?>" id="pwa-setting" role="tabpanel" aria-labelledby="pills-user-tab-6">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="theme-detail-card">
                                            <?php echo e(Form::open(['route' => ['business.pwa-setting', $business->id], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'needs-validation','novalidate', 'id'=>'pwaForm' ])); ?>

                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <h5 class="mb-0"><?php echo e(__('PWA (Progressive Web App)')); ?></h5>
                                            </div>
                                                <div class="form-check form-switch custom-switch-v1 <?php if($plan->pwa_business == 'off'): ?> disabledPWA <?php endif; ?>">
                                                    <input type="checkbox"
                                                        class="form-check-input enable_pwa_business"
                                                        name="pwa_business" id="pwa_business"
                                                        <?php echo e($business['enable_pwa_business'] == 'on' ? 'checked=checked' : ''); ?>>
                                                        <?php echo e(Form::label('pwa_store', __('Progressive Web App (PWA)'), ['class' => 'form-check-label mb-3'])); ?>

                                                </div>
                                                <?php if($plan->pwa_business == 'on'): ?>
                                                    <div class="row row-gap">
                                                            <div class="col-lg-3 col-sm-6 col-12">
                                                                <div class="form-group mb-0 pwa_is_enable">
                                                                    <?php echo e(Form::label('pwa_app_title', __('App Title'), ['class' => 'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaleab1765d328ab3f8835fc5d78676a070 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.required','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('required'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaleab1765d328ab3f8835fc5d78676a070)): ?>
<?php $attributes = $__attributesOriginaleab1765d328ab3f8835fc5d78676a070; ?>
<?php unset($__attributesOriginaleab1765d328ab3f8835fc5d78676a070); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaleab1765d328ab3f8835fc5d78676a070)): ?>
<?php $component = $__componentOriginaleab1765d328ab3f8835fc5d78676a070; ?>
<?php unset($__componentOriginaleab1765d328ab3f8835fc5d78676a070); ?>
<?php endif; ?>
                                                                    <?php echo e(Form::text('pwa_app_title', !empty($pwa_data->name) ? $pwa_data->name : '', ['class' => 'form-control', 'placeholder' => __('App Title'), 'required'=>'required'])); ?>

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-sm-6 col-12">
                                                                <div class="form-group mb-0 pwa_is_enable">
                                                                    <?php echo e(Form::label('pwa_app_name', __('App Name'), ['class' => 'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaleab1765d328ab3f8835fc5d78676a070 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.required','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('required'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaleab1765d328ab3f8835fc5d78676a070)): ?>
<?php $attributes = $__attributesOriginaleab1765d328ab3f8835fc5d78676a070; ?>
<?php unset($__attributesOriginaleab1765d328ab3f8835fc5d78676a070); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaleab1765d328ab3f8835fc5d78676a070)): ?>
<?php $component = $__componentOriginaleab1765d328ab3f8835fc5d78676a070; ?>
<?php unset($__componentOriginaleab1765d328ab3f8835fc5d78676a070); ?>
<?php endif; ?>
                                                                    <?php echo e(Form::text('pwa_app_name', !empty($pwa_data->short_name) ? $pwa_data->short_name : '', ['class' => 'form-control', 'placeholder' => __('App Name'),'required'=>'required'])); ?>

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-sm-6 col-12">
                                                                <div
                                                                    class="form-group mb-0 pwa_is_enable ">
                                                                    <?php echo e(Form::label('pwa_app_background_color', __('App Background Color'), ['class' => 'form-label'])); ?>

                                                                    <div
                                                                        class="d-flex align-items-center color-picker-wrapper">

                                                                        <?php echo e(Form::color('pwa_app_background_color', !empty($pwa_data->background_color) ? $pwa_data->background_color : '', ['class' => 'form-control color-picker', 'placeholder' => __('18761234567')])); ?>

                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-sm-6 col-12">
                                                                <div class="form-group mb-0 pwa_is_enable">
                                                                    <?php echo e(Form::label('pwa_app_theme_color', __('App Theme Color'), ['class' => 'form-label'])); ?>

                                                                    <div
                                                                        class="d-flex align-items-center color-picker-wrapper">
                                                                        <?php echo e(Form::color('pwa_app_theme_color', !empty($pwa_data->theme_color) ? $pwa_data->theme_color : '', ['class' => 'form-control color-picker', 'placeholder' => __('18761234567')])); ?>

                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                <?php endif; ?>
                                            <div class="d-flex align-items-center justify-content-end mt-3">
                                                <button type="submit" class="btn btn-primary"> <i class="me-2"
                                                   data-feather="folder"></i>&nbsp;<?php echo e(__('Save Changes')); ?> </button>
                                             </div>
                                            <?php echo e(Form::close()); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="tab-pane fade <?php if(session('tab') and session('tab') == 7): ?> show active <?php endif; ?>" id="cookie-setting" role="tabpanel" aria-labelledby="pills-user-tab-7">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="theme-detail-card">
                                            <?php echo e(Form::open(['route' => ['business.cookie-setting', $business->id], 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                                            <?php if($chatgpt_setting['enable_chatgpt']=='on'): ?>
                                            <div class="ai_cookie col-xl-12 col-lg-12 col-md-12 d-flex align-items-center justify-content-between justify-content-md-end mb-3 <?php echo e(isset($business['is_gdpr_enabled']) && $business['is_gdpr_enabled'] == 'on' ? '' : 'disabledCookie'); ?>"
                                                data-bs-placement="top">
                                                <a href="javascript:void(0)" data-size="lg" class="btn btn-sm btn-primary d-flex align-items-center gap-2" data-ajax-popup-over="true"
                                                    data-url="<?php echo e(route('generate', ['cookie'])); ?>" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="<?php echo e(__('Generate')); ?>" data-title="<?php echo e(__('Generate content with AI')); ?>">
                                                    <i class="fas fa-robot"></i>&nbsp;<?php echo e(__('Generate with AI')); ?>

                                                </a>
                                            </div>
                                            <?php endif; ?>
                                            <div class="mb-2 d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0 flex-grow-1"><?php echo e(__('Cookie Settings:')); ?></h5>
                                                <div class="d-flex align-items-center">
                                                    <span class="me-2"><?php echo e(__('On/Off:')); ?></span>
                                                    <div class="form-check form-switch custom-switch-v1" onclick="enablecookie()">
                                                        <input type="checkbox"
                                                            class="form-check-input input-primary"
                                                            name="enable_cookie" id="enable_cookie" <?php echo e(isset($business['is_gdpr_enabled']) && $business['is_gdpr_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                        <label class="form-check-label"
                                                            for="customswitchv2-2"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row p-1">
                                                <div class="cookieDiv <?php echo e(isset($business['is_gdpr_enabled']) && $business['is_gdpr_enabled'] == 'on' ? '' : 'disabledCookie'); ?>">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-check form-switch custom-switch-v1 mb-3" id="cookie_log">
                                                                <input type="checkbox" name="cookie_logging" class="form-check-input input-primary cookie_setting"
                                                                    id="cookie_logging" <?php echo e(isset($cookieDetail->cookie_logging) && $cookieDetail->cookie_logging == 'on' ? ' checked ' : 'checked'); ?>>
                                                                <label class="form-check-label" for="cookie_logging"><?php echo e(__('Enable logging')); ?></label>
                                                            </div>
                                                            <div class="form-group" >
                                                                <?php echo e(Form::label('cookie_title', __('Cookie Title'), ['class' => 'form-label' ])); ?>

                                                                <?php echo e(Form::text('cookie_title', !empty($cookieDetail->cookie_title)?$cookieDetail->cookie_title: __('We use cookies!'), ['class' => 'form-control cookie_setting','placeholder' => __('Enter Cookie Title')] )); ?>

                                                            </div>
                                                            <div class="form-group ">
                                                                <?php echo e(Form::label('cookie_description', __('Cookie Description'), ['class' => 'form-label'])); ?>

                                                                <?php echo Form::textarea('cookie_description', !empty($cookieDetail->cookie_description)?$cookieDetail->cookie_description:__('Hi, this website uses essential cookies to ensure its proper operation and tracking cookies to understand how you interact with it'), ['class' => 'form-control cookie_setting', 'rows' => '3','placeholder' => __('Enter Cookie Description')]); ?>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-check form-switch custom-switch-v1 mb-3">
                                                                <input type="checkbox" name="necessary_cookies" class="form-check-input input-primary"
                                                                    id="necessary_cookies" checked onclick="return false">
                                                                <label class="form-check-label" for="necessary_cookies"><?php echo e(__('Strictly necessary cookies')); ?></label>
                                                            </div>
                                                            <div class="form-group ">
                                                                <?php echo e(Form::label('strictly_cookie_title', __(' Strictly Cookie Title'), ['class' => 'form-label'])); ?>

                                                                <?php echo e(Form::text('strictly_cookie_title', !empty($cookieDetail->strictly_cookie_title)?$cookieDetail->strictly_cookie_title:__('Strictly necessary cookies'), ['class' => 'form-control cookie_setting','placeholder' => __('Enter Strictly Cookie Title')])); ?>

                                                            </div>
                                                            <div class="form-group ">
                                                                <?php echo e(Form::label('strictly_cookie_description', __('Strictly Cookie Description'), ['class' => ' form-label'])); ?>

                                                                <?php echo Form::textarea('strictly_cookie_description', !empty($cookieDetail->strictly_cookie_description)?$cookieDetail->strictly_cookie_description:__('These cookies are essential for the proper functioning of my website. Without these cookies, the website would not work properly'), ['class' => 'form-control cookie_setting ', 'rows' => '3', 'placeholder' => __('Enter Strictly Cookie Description')]); ?>

                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <h5><?php echo e(__('More Information')); ?></h5>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                                <?php echo e(Form::label('more_information_description', __('Contact Us Description'), ['class' => 'form-label'])); ?>

                                                                <?php echo e(Form::text('more_information_description', !empty($cookieDetail->more_information_description)?$cookieDetail->more_information_description:__('For any queries in relation to our policy on cookies and your choices,'), ['class' => 'form-control cookie_setting','placeholder' => __('Enter Contact Us Description')])); ?>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                                <?php echo e(Form::label('contactus_url', __('Contact Us URL'), ['class' => 'form-label'])); ?>

                                                                <?php echo e(Form::text('contactus_url', !empty($cookieDetail->contactus_url)?$cookieDetail->contactus_url:'#', ['class' => 'form-control cookie_setting','placeholder' => __('Enter Contact Us URL')])); ?>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div>
                                                    <?php if(isset($cookieDetail->cookie_logging) && $cookieDetail->cookie_logging == 'on'): ?>
                                                        <label for="file" class="form-label"><?php echo e(__('Download cookie accepted data')); ?></label>
                                                            <a href="<?php echo e(asset(Storage::url('uploads/sample')) . '/'.$filename); ?>" class="btn btn-primary mr-2 ">
                                                                <i class="ti ti-download"></i>
                                                            </a>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <h5 class="mb-0"></h5>
                                                    <button type="submit" class="btn btn-primary"> <i class="me-2" data-feather="folder"></i>&nbsp;<?php echo e(__('Save Changes')); ?> </button>
                                                </div>
                                            </div>
                                            <?php echo e(Form::close()); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            

                            <div class="tab-pane fade <?php if(session('tab') and session('tab') == 8): ?> show active <?php endif; ?>" id="qrcode-setting" role="tabpanel" aria-labelledby="pills-user-tab-8">
                                <div class="row gy-4">
                                    <div class="col-lg-8 col-md-7">
                                        <?php echo e(Form::open(['route' => ['business.qrcode_setting', $business->id], 'method' => 'POST', 'enctype' => 'multipart/form-data','class' => 'needs-validation', 'novalidate'])); ?>

                                            <div class="theme-detail-card">
                                                <div class="mb-3 d-flex align-items-center justify-content-between">
                                                    <h5 class="mb-0 flex-grow-1"><?php echo e(__('Qr Code Settings:')); ?></h5>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-12">
                                                        <div class="form-group">
                                                            <?php echo e(Form::label('Foreground Color', __('Foreground Color'), ['class' => 'form-label'])); ?>

                                                            <input type="color" name="foreground_color" value="<?php echo e(isset($qr_detail->foreground_color)? $qr_detail->foreground_color :'#000000'); ?>" class="form-control foreground_color qr_data p-0" data-multiple-caption="{count} files selected" multiple="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-12">
                                                        <div class="form-group">
                                                            <?php echo e(Form::label('Background Color', __('Background Color'), ['class' => 'form-label'])); ?>

                                                            <input type="color" name="background_color"  value="<?php echo e(isset($qr_detail->background_color)?$qr_detail->background_color:'#ffffff'); ?>" class="form-control background_color qr_data p-0" data-multiple-caption="{count} files selected" multiple="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-12">
                                                        <div class="form-group">
                                                            <?php echo e(Form::label('Corner Radius', __('Corner Radius'), ['class' => 'form-label'])); ?>

                                                            <input type="range" name="radius" class="radius qr_data" min="1" max="50" step="1" style="width:100%;" value="<?php echo e(isset($qr_detail->radius)?$qr_detail->radius:26); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="d-flex flex-wrap align-items-center gap-2 gallery-btn">

                                                            <?php $__currentLoopData = $qr_code; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div>
                                                                <label for="enable_<?php echo e($k); ?>" class="btn btn-secondary qr_type">
                                                                    <input type="radio" class="d-none btn btn-secondary qr_type_click" <?php if(isset($qr_detail->qr_type) && ($qr_detail->qr_type==$k)): ?> checked <?php endif; ?>
                                                                    name="qr_type" value="<?php echo e($k); ?>" id="<?php echo e($k); ?>" />
                                                                <?php if($value == 'Normal'): ?>
                                                                    <i class="me-2" data-feather="settings"></i>
                                                                <?php elseif($value == 'Text'): ?>
                                                                    <i class="me-2" data-feather="file-text"></i>
                                                                <?php elseif($value == 'Image'): ?>
                                                                    <i class="me-2" data-feather="image"></i>
                                                                <?php endif; ?>
                                                                <?php echo e(__($value)); ?>

                                                                </label>
                                                            </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    </div>
                                                    <span id="qr_type_option" style="<?php echo e($qr_detail == null ? 'display: none' : 'display: block'); ?>" >
                                                        <div id="text_div">
                                                            <div class="col-md-12 mt-2 " >
                                                                <div class="form-group">
                                                                    <?php echo e(Form::label('Text', __('Text'), ['class' => 'form-label'])); ?>

                                                                    <input type="text" name="qr_text" value="<?php echo e(isset($qr_detail->qr_text)?$qr_detail->qr_text:''); ?>" placeholder="<?php echo e(__('Enter Text')); ?>" class="form-control qr_text qr_keyup">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <?php echo e(Form::label('Text Color', __('Text Color'), ['class' => 'form-label'])); ?>

                                                                    <input type="color" name="qr_text_color" value="<?php echo e(isset($qr_detail->qr_text_color)?$qr_detail->qr_text_color:'#f50a0a'); ?>" class="form-control qr_text_color qr_data">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 mt-2 img-validate-class" id="image_div">
                                                            <div class="form-group">
                                                                <?php echo e(Form::label('image', __('Image'), ['class' => 'form-label'])); ?>

                                                                <input type="file" name="image" accept=".png, .jpg, .jpeg" class="form-control qr_image qr_data file-validate">
                                                                <input type="hidden" name="old_image" value="">
                                                                <p class="file-error text-danger" style=""></p>
                                                                <img id="image-buffer" src="<?php echo e(isset($qr_detail->image) ? $qr_path.'/'.  $qr_detail->image :''); ?>" class="d-none" crossorigin="anonymous">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12" id="size_div">
                                                            <div class="form-group">
                                                                <?php echo e(Form::label('Size', __('Size'), ['class' => 'form-label'])); ?>

                                                                <input type="range" name="size" class="qr_size qr_data"  value="<?php echo e(isset($qr_detail->size)?$qr_detail->size:9); ?>" min="1" max="50" step="1" style="width:100%;">
                                                            </div>
                                                        </div>

                                                    </span>

                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mt-3 ">
                                                    <h5 class="mb-0"></h5>
                                                    <button type="submit" class="btn btn-primary"> <i class="me-2" data-feather="folder"></i>&nbsp;<?php echo e(__('Save Changes')); ?> </button>
                                                </div>
                                            </div>
                                        <?php echo e(Form::close()); ?>

                                    </div>
                                    <div class="col-lg-4 col-md-5">
                                        <div class="theme-preview">
                                            <div class=" code" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->

    <div class="modal fade" id="socialsModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo e(__('Add Field')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row social-card-row">
                        <?php $__currentLoopData = $businessfields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($val != 'Email' && $val != 'Phone'): ?>
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="social-card text-center getvalue" value="<?php echo e($val); ?>"
                                        id="<?php echo e($val); ?>" data-id="<?php echo e($val); ?>"
                                        onclick="socialRepeater(this.id)">
                                        <div class="theme-avtar bg-primary">
                                            <img src="<?php echo e(asset('custom/icon/white/' . $val . '.svg')); ?>"
                                                alt="image" class="<?php echo e($val); ?>">
                                        </div>
                                        <div class="social-name">
                                            <?php if($val == 'Web_url'): ?>
                                                <h5 class="mb-0"><?php echo e(__('Web Url')); ?></h5>
                                            <?php else: ?>
                                                <h5 class="mb-0"><?php echo e($val); ?></h5>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div id="addnewfield">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="qrcodeModal" data-backdrop="false" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo e(__('QR Code')); ?></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div id="qrdata">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('custom-scripts'); ?>
    <script src="<?php echo e(asset('custom/libs/dropzonejs/min/dropzone.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('custom/js/repeaterInput.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap-toggle.js')); ?>"></script>

    <script src="<?php echo e(asset('custom/libs/jquery-ui/jquery-ui.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-switch-button.min.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="<?php echo e(asset('custom/theme1/js/slick.min.js')); ?>" defer="defer"></script>
    <script src="<?php echo e(asset('custom/js/emojionearea.min.js')); ?>"></script>

    <script src="<?php echo e(asset('custom/js/jquery.qrcode.min.js')); ?>"></script>

    <script>
        $(function() {
            $(".sortable").sortable();
            $(".sortable").disableSelection();
            $(".sortable").sortable({
                stop: function() {
                    var order = [];
                    $(this).find('li').each(function(index, data) {
                        order[index] = $(data).attr('data-id');

                    });
                    $('#hidden_order').val(order);

                }
            });
            var block_order = [];
            $(".sortable").find('li').each(function(index, data) {
                block_order[index] = $(data).attr('data-id');
            });

            $('#hidden_order').val(block_order);
        });
    </script>

    <script type="text/javascript">
        var theme = '<?php echo e($card_theme->theme); ?>';
        var theme_path = `<?php echo e(asset('custom/${theme}/icon/')); ?>`;
        var asset_path = `<?php echo e(asset('custom/icon/')); ?>`
        var color = `<?php echo e($business->theme_color); ?>`.substring(0, 6);
        var add_row_no = <?php echo e($no); ?>;

        function getValue(el) {
            //alert(el);
            var data = repeaterInput(el, 'contact', add_row_no, 'inputrow_contact', theme_path, `${theme}`, color,
                asset_path);
            add_row_no = data;
        }
        function getCurrencyValue(el) {
            $('.currency_symbol').val(el);
            $("#currencyModal").modal('hide');


        }
        var row_no = <?php echo e($appointment_no); ?>;

        function appointmentRepeater() {

            var data = repeaterInput('', 'appointment', row_no, 'inputrow_appointment', "", `${theme}`, color, asset_path);
            row_no = data;
            // $('select').niceSelect('update');

        }
        var service_row_no = <?php echo e($service_row_no); ?>;

        function servieRepeater() {
            var data = repeaterInput('', 'service', service_row_no, 'inputrow_service', theme_path, `${theme}`, color,
                asset_path);
            service_row_no = data;
        }
        var product_row_no = <?php echo e($product_row_no); ?>;

        function productRepeater() {
            var data = repeaterInput('', 'product', product_row_no, 'inputrow_product', theme_path, `${theme}`, color,
                asset_path);
                product_row_no = data;
        }

        var testimonials_row_no = <?php echo e($testimonials_row_no); ?>;

        function testimonialRepeater() {
            var data = repeaterInput('', 'testimonial', testimonials_row_no, 'inputrow_testimonials',
                "<?php echo e(asset('custom/img/logo-placeholder-image-2.png')); ?>", `${theme}`, color, asset_path);


            testimonials_row_no = data;

        }



        var socials_row_no = <?php echo e($social_no); ?>;

        function socialRepeater(el) {

            var data = repeaterInput(el, 'social_links', socials_row_no, 'inputrow_socials', theme_path, `${theme}`, color,
                asset_path);
            socials_row_no = data;
        }
       $("#is_business_hours_enabled").change(function() {
            var $input = $(this);
            var enable = $input.is(":checked");

            if (enable == true) {
                $('#business-hours-div').show();
                $('.business-hours-div').show();
                $('#showElement').show();
            }
            if (enable == false) {
                $('#showElement').hide();
                $('#business-hours-div').hide();
                $('.business-hours-div').hide();
            }
        }).change();


        $("#is_appoinment_enabled").change(function() {
            var $input = $(this);
            var enable = $input.is(":checked");

            if (enable == true) {
                $('#appointment-div').show();
                $('#showAppoinment').show();
            }
            if (enable == false) {
                $('#appointment-div').hide();
                $('#showAppoinment').hide();
            }
        }).change();


        $("#is_socials_enabled").change(function() {
            var $input = $(this);
            var enable = $input.is(":checked");

            if (enable == true) {
                $('#social-div').show();
                $('.social-div').show();
                $('#showSocials').show();
            }
            if (enable == false) {
                $('#social-div').hide();
                $('#showSocials').hide();
            }
        }).change();

        $("#is_testimonials_enabled").change(function() {
            var $input = $(this);
            var enable = $input.is(":checked");

            if (enable == true) {

                $('#testimonials-div').show();
                $('.showTestimonials').show();
            }
            if (enable == false) {
                $('#testimonials-div').hide();
                $('.showTestimonials').hide();
            }
        }).change();
        $("#is_services_enabled").change(function() {
            var $input = $(this);
            var enable = $input.is(":checked");

            if (enable == true) {

                $('#services-div').show();
                $('.showServices').show();
            }
            if (enable == false) {
                $('#services-div').hide();
                $('.showServices').hide();
            }
        }).change();
        $("#is_product_enabled").change(function() {
            var $input = $(this);
            var enable = $input.is(":checked");

            if (enable == true) {

                $('#product-div').show();
                $('.showProducts').show();
            }
            if (enable == false) {
                $('#product-div').hide();
                $('.showProducts').hide();
            }
        }).change();
        $("#is_contacts_enabled").change(function() {
            var $input = $(this);
            var enable = $input.is(":checked");

            if (enable == true) {
                $('#showContact').show();
                $('#showContact_preview').show();
                $('#contact-div').show();
                $('#contact-div1').show();
            }
            if (enable == false) {
                $('#showContact').hide();
                $('#showContact_preview').hide();
                $('#contact-div').hide();
                $('#contact-div1').hide();
            }
        }).change();
        $("#is_gallery_enabled").change(function() {
            var $input = $(this);
            var enable = $input.is(":checked");

            if (enable == true) {

                $('#gallery-div').show();
                $('.showGallery').show();
            }
            if (enable == false) {
                $('#gallery-div').hide();
                $('.showGallery').hide();
            }
        }).change();


        var count = document.querySelectorAll('.inputFormRow').length;
        if (count < 3) {
            $('.hideelement').show();
        } else {
            $('.hideelement').hide();
        }


        function changeFunction(el) {
            var data_preview_id = $(`#${el}`).data('id');
            var start_time_preview = $(`#${data_preview_id}_start`).val();
            var end_time_preview = $(`#${data_preview_id}_end`).val();
            var time_preview = start_time_preview + '-' + end_time_preview;
            //var is_closed = $(`.${data_preview_id}`).text();
            if ($(`#${data_preview_id}`).prop('checked')) {
                $(`.${data_preview_id}`).text(time_preview);
            }
            //var preview_time = $(`#${el}`).val();
            //$(`.${el}`).text(preview_time);
        }

        function getRadio(el) {
            //var classss = $(el).attr('class');
            var get_val = $(el).val();
            //alert(get_val);
            var get_class = $(el).attr('class');
            $('.' + get_class).text(get_val);
            var span_star = '';
            const arr = [
                1,
                2,
                3,
                4,
                5
            ];
            $('#' + get_class + '_star').text('')
            $.each(arr, function(index, value) {

                // Will stop running after "three"
                //return (value !== 3);
                if (value <= get_val) {
                    span_star = `<i class="star-color  fas fa-star"></i>`;
                } else {
                    span_star = `<i class="fa fa-star"></i>`;
                }

                $('#' + get_class + '_star').append(span_star);
            });

        }

        function validURL(str) {
            var pattern = new RegExp('^(https?:\\/\\/)?' + // protocol
                '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' + // domain name
                '((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address
                '(\\:\\d+)?(\\/[-a-z\\d%_@.~+]*)*' + // port and path
                '(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
                '(\\#[-a-z\\d_]*)?$', 'i'); // fragment locator
            return !!pattern.test(str);
        }

        $(".social_href").keyup(function() {
            var id = $(this).attr('id');
            var text = $(this).attr('name');
            var subtext = "Whatsapp";
            var isIncluded = text.includes(subtext);
            var preview = $(`#${id}`).val();
            var h_preview = validURL(preview);

            if (h_preview == true) {
                $(`#${id}_error_href`).text("");
                $(`#${id}_href_preview`).attr("href", preview);
            } else {
                if(isIncluded==false)
                {
                    $(`#${id}_error_href`).text("Please enter valid link");
                    $(`#${id}_href_preview`).attr("href", "#");
                }
            }

        });

        $("textarea").keyup(function() {
            var id = $(this).attr('id');
            var preview = $(`#${id}`).val();
            $(`#${id}_preview`).text(preview);
            $(`.description-div`).show();
            if ($('.description-text').val() == "") {
                $(`.description-div`).hide();
            }
        });


        $(".days").change(function() {
            var day_id = $(this).attr('id');
            if ($(this).prop('checked')) {
                var this_attr_id = $(this).attr('id');
                var start_time = $(`#${this_attr_id}_start`).val();
                var end_time = $(`#${this_attr_id}_end`).val();
                if (start_time == '' && end_time == '') {
                    //var time = start_time + '-' + end_time;
                    $(`.${day_id}`).text('00:00');

                } else {
                    var time = start_time + '-' + end_time;
                    $(`.${day_id}`).text(time);
                }
            } else {
                $(`.${day_id}`).text('closed');

            }
        });

        function changeTime(el) {
            var time_input = $(`#${el}`).val();
            $(`#${el}_preview`).text(time_input);

            // $('select').niceSelect('update');
        }

        $(document).on('click', 'input[name="theme_color"]', function() {

            var eleParent = $(this).attr('data-theme');
            $('#themefile').val(eleParent);
            var imgpath = $(this).attr('data-imgpath');
            $('.' + eleParent + '_img').attr('src', imgpath);

            $('.theme_preview_img').attr('src', imgpath);
            setTimeout(function(e) {
                $('.theme-save').trigger('click');
            }, 200);
            $(".theme-view-card").removeClass('selected-theme')
            $(this).closest('.theme-view-card').addClass('selected-theme');
        });

        $(document).ready(function() {
            setTimeout(function(e) {
                var checked = $("input[type=radio][name='theme_color']:checked");
                $('#themefile').val(checked.attr('data-theme'));
                $('.' + checked.attr('data-theme') + '_img').attr('src', checked.attr('data-imgpath'));
                $('.theme_preview_img').attr('src', checked.attr('data-imgpath'));

            }, 300);
        });

        $(document).on('change', '.domain_click#enable_storelink', function(e) {

            $('#StoreLink').show();
            $('.sundomain').hide();
            $('.domain').hide();
            $('#domainnote').hide();
            $(this).parent().removeClass('btn-secondary');
            $(this).parent().addClass('btn-primary');
            $('#enable_domain').parent().addClass('btn-secondary');
            $('#enable_domain').parent().removeClass('btn-primary');
            $('#enable_subdomain').parent().addClass('btn-secondary');
            $('#enable_subdomain').parent().removeClass('btn-primary');
        });
        $(document).on('change', '.domain_click#enable_domain', function(e) {
            $('.domain').show();
            $('#StoreLink').hide();
            $('.sundomain').hide();
            $('#domainnote').show();
            $(this).parent().removeClass('btn-secondary');
            $(this).parent().addClass('btn-primary');
            $('#enable_storelink').parent().addClass('btn-secondary');
            $('#enable_storelink').parent().removeClass('btn-primary');
            $('#enable_subdomain').parent().addClass('btn-secondary');
            $('#enable_subdomain').parent().removeClass('btn-primary');

        });
        $(document).on('change', '.domain_click#enable_subdomain', function(e) {
            $('.sundomain').show();
            $('#StoreLink').hide();
            $('.domain').hide();
            $('#domainnote').hide();
            $(this).parent().removeClass('btn-secondary');
            $(this).parent().addClass('btn-primary');
            $('#enable_storelink').parent().addClass('btn-secondary');
            $('#enable_storelink').parent().removeClass('btn-primary');
            $('#enable_domain').parent().addClass('btn-secondary');
            $('#enable_domain').parent().removeClass('btn-primary');
        });

        $(document).ready(function() {
            var checked = $("input[type=radio][name='enable_domain']:checked");
            //alert(checked);
            $(checked).closest('#enable_storelink').removeClass('btn-primary');
            $(checked).parent().addClass('btn-primary');
        });

        function myFunction() {
            var copyText = document.getElementById("myInput");
            copyText.select();
            copyText.setSelectionRange(0, 99999)
            document.execCommand("copy");
            // show_toastr('Success', "<?php echo e(__('Link copied')); ?>", 'success');
        }

        $(".textboxhover").mouseover(function() {
            $(this).removeClass("border-0");
        }).mouseout(function() {
            $(this).addClass("border-0");
        });
    </script>


        <script>
            $(document).ready(function () {
                const $enablePaymentCheckbox = $('#is_payment_enabled');
                const $paymentForm = $('#paymentForm');
                const $formFields = $paymentForm.find('[required]');
                // Function to toggle validation for form fields
                function toggleValidationClass() {
                    if ($enablePaymentCheckbox.is(':checked')) {
                        $formFields.prop('disabled', false);
                    } else {
                        $formFields.prop('disabled', true);
                    }
                }
                // Initial state check
                toggleValidationClass();

                // Listen for checkbox changes
                $enablePaymentCheckbox.on('change', toggleValidationClass);
            });
        </script>

    <script>

        $(document).ready(function () {
            const $enablePwaCheckbox = $('#pwa_business');
            const $pwaForm = $('#pwaForm');
            const $formFields = $pwaForm.find('[required]');

            // Function to toggle validation for form fields
            function toggleValidation() {
                if ($enablePwaCheckbox.is(':checked')) {
                    $formFields.prop('disabled', false);
                } else {
                    $formFields.prop('disabled', true);
                }
            }
            // Initial state check
            toggleValidation();

            // Listen for checkbox changes
            $enablePwaCheckbox.on('change', toggleValidation);
        });

    </script>
    <script>
        $(document).ready(function() {
            setTimeout(function(e) {
                var checked = $("input[type=radio][name='theme_color']:checked");
                $('#themefile').val(checked.attr('data-theme'));
                $('.' + checked.attr('data-theme') + '_img').attr('src', checked.attr('data-imgpath'));
            }, 300);

            if ($('.enable_pwa_business').is(':checked')) {
                $('.pwa_is_enable').removeClass('disabledPWA');
            } else {
                $('.pwa_is_enable').addClass('disabledPWA');
            }
            $('#pwa_business').on('change', function() {
                if ($('.enable_pwa_business').is(':checked')) {
                    $('.pwa_is_enable').removeClass('disabledPWA');
                } else {
                    $('.pwa_is_enable').addClass('disabledPWA');
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#is_custom_html_enabled').trigger('change');
            $('#is_google_map_enabled').trigger('change');
            $('#is_svg_enabled').trigger('change');
            $('#is_payment_enabled').trigger('change');
            $('#paypal').trigger('change');
            $('#stripeLabel').trigger('change');
        });
        $(document).on('change', '#is_custom_html_enabled', function(e) {
            $('.custom_html_text').hide();
            if ($("#is_custom_html_enabled").prop('checked') == true) {
                $('.custom_html_text').show();
            }
        });

        // svg
        $(document).on('change', '#is_svg_enabled', function(e) {
            $('.svg_text').hide();
            $('#svg-div').hide();
            if ($("#is_svg_enabled").prop('checked') == true) {
                $('.svg_text').show();
                $('#svg-div').show();
            }
        });
       // payment
       $(document).on('change', '#is_payment_enabled', function(e) {
            $('.payment').hide();
            $('#payment-section').hide();
            if ($("#is_payment_enabled").prop('checked') == true) {
                $('.payment').show();
                $('#payment-section').show();
            }
        });
        // stripe payment
        $(document).on('change', '#stripeLabel', function(e) {
            $('.stripe-payment-card').hide();
            if ($("#stripeLabel").prop('checked') == true) {
                $('.stripe-payment-card').show();
            }
        });
        // paypal payment
        $(document).on('change', '#paypal', function(e) {
            $('.paypal-payment-card').hide();
            if ($("#paypal").prop('checked') == true) {
                $('.paypal-payment-card').show();
            }
        });
        $(document).on('change', '#is_google_map_enabled', function(e) {
            $('.google_map_link').hide();
            $('#google-map-div').hide();
            if ($("#is_google_map_enabled").prop('checked') == true) {
                $('.google_map_link').show();
                $('#google-map-div').show();
            }
        });

        $(document).on('change', '#is_app_info_enabled', function(e) {
            $('.app_info_block').hide();
            $('#app-section').hide();
            if ($("#is_app_info_enabled").prop('checked') == true) {
                $('.app_info_block').show();
                $('#app-section').show();
            }
        });

        $(".input-text-location").each(function() {
            var textarea = $(this);
            var text = textarea.text();
            var div = $('<div id="temp"></div>');
            div.css({
                "width": "530px"
            });
            div.text(text);
            $('body').append(div);
            var divHeight = $('#temp').height();
            div.remove();
            divHeight += 32;
            this.setAttribute("style", "height:" + divHeight + "px;overflow-y:hidden;");
        }).on("input", function() {
            this.style.height = "auto";
            this.style.height = (this.scrollHeight) + "px";
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#details-setting-tab").click(function() {
                    setTimeout(function() {
                    $('.testimonial-slider').slick('refresh');
                    $('.gallery-slider').slick('refresh');
                    $('.service-slider').slick('refresh');
                    $('.product-sec-slider').slick('refresh');
                    $('.social-link-slider').slick('refresh');
                    $('.theme-slider').slick('refresh');
                    $('.testimonial-content-slider').slick('refresh');
                    $('.testimonial-image-slider').slick('refresh');

                }, 500);
            });
            $("#theme-setting-tab").click(function() {
                    setTimeout(function() {
                        $('.theme-slider').slick('refresh');
                }, 200);
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            var gallery=[];
            $( ".gallary_data" ).each(function( index ) {
                var data_id= $(this).attr('data-id');
                gallery.push(data_id);

            });
            $("input[name=galary_data]").val(gallery);
            //reset

            $(".gallery_click").click(function () {
                $(".gallery_click").parent().removeClass('btn-primary').addClass('btn-secondary');
                if ($(this).is(":checked")) {

                    //checked
                    $(this).parent().removeClass('btn-secondary');
                        $(this).parent().addClass('btn-primary');

                } else {
                    //unchecked
                        $(this).parent().removeClass('btn-primary');
                        $(this).parent().addClass('btn-secondary');
                }

            })

        });

        $(document).ready(function() {
            $('#gdpr_cookie').trigger('change');
        });
        $(document).ready(function() {
            var checked = $("input[type=radio][name='theme_color']:checked");
            $('#themefile').val(checked.attr('data-theme'));
            $(checked).closest('.theme-view-card').addClass('selected-theme');
        });

        $(document).on('change', '#gdpr_cookie', function(e) {
            $('.gdpr_cookie_text').hide();
            if ($("#gdpr_cookie").prop('checked') == true) {
                $('.gdpr_cookie_text').show();
            }
        });
        $(document).ready(function() {
            $('#branding').trigger('change');
        });
        $(document).on('change', '#branding', function(e) {
            $('.branding_text').hide();
            if ($("#branding").prop('checked') == true) {
                $('.branding_text').show();
            }
        });

        $(document).on('change', '.domain_click#enable_storelink', function(e) {
            $('#StoreLink').show();
            $('.sundomain').hide();
            $('.domain').hide();
            $('#domainnote').hide();
            $("#enable_storelink").parent().addClass('active');
            $("#enable_domain").parent().removeClass('active');
            $("#enable_subdomain").parent().removeClass('active');

        });
        $(document).on('change', '.domain_click#enable_domain', function(e) {
            $('.domain').show();
            $('#StoreLink').hide();
            $('.sundomain').hide();
            $('#domainnote').show();
            $("#enable_domain").parent().addClass('active');
            $("#enable_storelink").parent().removeClass('active');
            $("#enable_subdomain").parent().removeClass('active');
        });
        $(document).on('change', '.domain_click#enable_subdomain', function(e) {
            $('.sundomain').show();
            $('#StoreLink').hide();
            $('.domain').hide();
            $('#domainnote').hide();
            $("#enable_subdomain").parent().addClass('active');
            $("#enable_domain").parent().removeClass('active');
            $("#enable_domain").parent().removeClass('active');
        });


        $(document).on("click",".color1",function() {

            var id = $(this).attr('data-id');
            $('#color1-' + id).trigger('click');
            $(".theme-view-card").removeClass('selected-theme')
            $(this).closest('.theme-view-card').addClass('selected-theme');
            $('#themefile').val(id);
            // $(".theme-view-card").addClass('')
        });



        $('#download-qr').on('click', function() {
            var qrcode = '<?php echo e($business->slug); ?>';
            $.ajax({
                url: '<?php echo e(route('download.qr')); ?>',
                type: 'GET',
                data: {
                    "qrData": qrcode,
                },
                success: function(data) {

                    if (data.success == true) {

                        $('#qrdata').html(data.data);
                    }
                    setTimeout(() => {
                        // canvasdata();
                        var element = document.querySelector("#qrdata");
                        saveCapture(element)
                        $("#qrcodeModal").removeClass("show");
                        $("#qrcodeModal").modal('hide');
                        $("body").css("overflow",'');
                        $("body").css("padding-right",'');
                        $('body').removeClass('modal-open');
                        $('#qrcodeModal').removeClass('modal-backdrop');
                        $(".modal-backdrop").removeClass("show");

                        $("#qrdata").html('');

                    }, 2000);
                }
            });


        });

        $('.download_my_qr_code').on('click', function(e) {

            var qrfilename='<?php echo e($business->title); ?>'+'.png';

                e.preventDefault();
                var img = new Image();
                img.src = $('.code').find('img').attr('src');
                img.onload = function() {
                    var canvas = document.createElement('canvas');
                    canvas.width = img.width;
                    canvas.height = img.height;
                    var ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0);
                    var data = canvas.toDataURL('image/png');
                    var a = document.createElement("a");
                    a.download = qrfilename;
                    a.href = data;
                    a.click();
                };


        });


        // Gallery Ajax
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.remove_gallery').on('click', function(e) {
            var this_id = $(this).data('id');
            var business_id = '<?php echo e($business->id); ?>';
            $.ajax({
                url: '<?php echo e(route('destory.gallery')); ?>',
                type: 'POST',
                data: {
                    "id": this_id,
                    "business_id":business_id,
                },
                success: function(data) {
                    $(this).closest('#inputFormRow5').remove();
                    location.reload();
                }
            });

        });

        function download(url) {
            var a = $("<a style='display:none' id='js-downloder'>")
                .attr("href", url)
                .attr("download", "<?php echo e($business->slug); ?>")
                .appendTo("body");
            a[0].click();
            a.remove();
        }

        function saveCapture(element) {
            html2canvas(element).then(function(canvas) {
                download(canvas.toDataURL("image/png"));
            })
        }

        function canvasdata() {
            html2canvas($('#qrdata'), {
                onrendered: function(canvas) {
                    var a = document.createElement('a');
                    // toDataURL defaults to png, so we need to request a jpeg, then convert for file download.
                    a.href = canvas.toDataURL("image/jpeg").replace("image/jpeg", "image/octet-stream");
                    a.download = 'somefilename.jpg';
                    a.click();
                }
            });
        }
        // $(document).ready(function() {
        //     $('.theme-slider').slick('refresh');
        // });

        $(document).ready(function() {

            var slug = '<?php echo e($business->slug); ?>';
            var url_link = `<?php echo e(url('/')); ?>/${slug}`;

            // $(`.qr-link`).text(url_link);
            $('.qrcode').qrcode(url_link);

            let ele = $(".emojiarea").emojioneArea();
            $.each( ele, function( key, value ) {

                ele[key].emojioneArea.on("keyup", function(btn, event) {
                    //let sf = ele[key];
                    var get_id = ele[key].getAttribute('id');
                    var get_val = btn.html();
                    get_val = get_val.replace('&nbsp','');

                    $(`#${get_id}_preview`).html($.parseHTML( get_val ));
                    $(`.description-div`).show();
                    if ($('.description-text').val() == "") {
                        $(`.description-div`).hide();
                    }
                });
            });

        });
        $("#details-setting-tab").click(function(){
                $('.testimonial-slider').slick('refresh');
                $('.gallery-slider').slick('refresh');
                $('.service-slider').slick('refresh');
                $('.product-sec-slider').slick('refresh');
                $('.social-link-slider').slick('refresh');
                $('.theme-slider').slick('refresh');
                $('.testimonial-content-slider').slick('refresh');
                $('.testimonial-image-slider').slick('refresh');
            });
        $(document).ready(function(){
            <?php if($SITE_RTL == 'on'): ?>

                if ($('.theme-slider').length > 0) {
                    $('.theme-slider').slick({
                        // autoplay: true,
                        rows:2,
                        rtl: true,
                        slidesToShow: 4,
                        loop:false,
                        infinite:false,
                        speed: 1000,
                        slidesToScroll: 4,
                        prevArrow: '<div class="slide-arrow slick-prev"><svg viewBox="0 0 10 5"><path d="M2.37755e-08 2.57132C-3.38931e-06 2.7911 0.178166 2.96928 0.397953 2.96928L8.17233 2.9694L7.23718 3.87785C7.07954 4.031 7.07589 4.28295 7.22903 4.44059C7.38218 4.59824 7.63413 4.60189 7.79177 4.44874L9.43039 2.85691C9.50753 2.78197 9.55105 2.679 9.55105 2.57146C9.55105 2.46392 9.50753 2.36095 9.43039 2.28602L7.79177 0.69418C7.63413 0.541034 7.38218 0.544682 7.22903 0.702329C7.07589 0.859976 7.07954 1.11192 7.23718 1.26507L8.1723 2.17349L0.397965 2.17336C0.178179 2.17336 3.46059e-06 2.35153 2.37755e-08 2.57132Z"></path></svg></div>',
                        nextArrow: '<div class="slide-arrow slick-next"><svg viewBox="0 0 10 5"><path d="M2.37755e-08 2.57132C-3.38931e-06 2.7911 0.178166 2.96928 0.397953 2.96928L8.17233 2.9694L7.23718 3.87785C7.07954 4.031 7.07589 4.28295 7.22903 4.44059C7.38218 4.59824 7.63413 4.60189 7.79177 4.44874L9.43039 2.85691C9.50753 2.78197 9.55105 2.679 9.55105 2.57146C9.55105 2.46392 9.50753 2.36095 9.43039 2.28602L7.79177 0.69418C7.63413 0.541034 7.38218 0.544682 7.22903 0.702329C7.07589 0.859976 7.07954 1.11192 7.23718 1.26507L8.1723 2.17349L0.397965 2.17336C0.178179 2.17336 3.46059e-06 2.35153 2.37755e-08 2.57132Z"></path></svg></div>',
                        dots: false,
                        arrows:true,
                        // buttons: false,
                        responsive: [
                            {
                                breakpoint: 1700,
                                settings: {
                                    rows:2,
                                    slidesToShow: 3,
                                    slidesToScroll: 3,
                                }
                            },
                            {
                                breakpoint: 1200,
                                settings: {
                                    rows:2,
                                    slidesToShow: 2,
                                    slidesToScroll: 2,
                                }
                            },
                            {
                                breakpoint: 576,
                                settings: {
                                    rows:2,
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                }
                            },
                            {
                                breakpoint: 430,
                                settings: {
                                    rows:2,
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                }
                            }
                        ]
                    });
                }
            <?php else: ?>
                if ($('.theme-slider').length > 0) {
                    $('.theme-slider').slick({
                        // autoplay: true,
                        rows:2,
                        slidesToShow: 4,
                        loop:false,
                        infinite:false,
                        speed: 1000,
                        slidesToScroll: 4,
                        prevArrow: '<div class="slide-arrow slick-prev"><svg viewBox="0 0 10 5"><path d="M2.37755e-08 2.57132C-3.38931e-06 2.7911 0.178166 2.96928 0.397953 2.96928L8.17233 2.9694L7.23718 3.87785C7.07954 4.031 7.07589 4.28295 7.22903 4.44059C7.38218 4.59824 7.63413 4.60189 7.79177 4.44874L9.43039 2.85691C9.50753 2.78197 9.55105 2.679 9.55105 2.57146C9.55105 2.46392 9.50753 2.36095 9.43039 2.28602L7.79177 0.69418C7.63413 0.541034 7.38218 0.544682 7.22903 0.702329C7.07589 0.859976 7.07954 1.11192 7.23718 1.26507L8.1723 2.17349L0.397965 2.17336C0.178179 2.17336 3.46059e-06 2.35153 2.37755e-08 2.57132Z"></path></svg></div>',
                        nextArrow: '<div class="slide-arrow slick-next"><svg viewBox="0 0 10 5"><path d="M2.37755e-08 2.57132C-3.38931e-06 2.7911 0.178166 2.96928 0.397953 2.96928L8.17233 2.9694L7.23718 3.87785C7.07954 4.031 7.07589 4.28295 7.22903 4.44059C7.38218 4.59824 7.63413 4.60189 7.79177 4.44874L9.43039 2.85691C9.50753 2.78197 9.55105 2.679 9.55105 2.57146C9.55105 2.46392 9.50753 2.36095 9.43039 2.28602L7.79177 0.69418C7.63413 0.541034 7.38218 0.544682 7.22903 0.702329C7.07589 0.859976 7.07954 1.11192 7.23718 1.26507L8.1723 2.17349L0.397965 2.17336C0.178179 2.17336 3.46059e-06 2.35153 2.37755e-08 2.57132Z"></path></svg></div>',
                        dots: false,
                        arrows:true,
                        // buttons: false,
                        responsive: [
                            {
                                breakpoint: 1700,
                                settings: {
                                    rows:2,
                                    slidesToShow: 3,
                                    slidesToScroll: 3,
                                }
                            },
                            {
                                breakpoint: 1200,
                                settings: {
                                    rows:2,
                                    slidesToShow: 2,
                                    slidesToScroll: 2,
                                }
                            },
                            {
                                breakpoint: 576,
                                settings: {
                                    rows:2,
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                }
                            },
                            {
                                breakpoint: 430,
                                settings: {
                                    rows:2,
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                }
                            }
                        ]
                    });
                }
            <?php endif; ?>

        });
        //Gallery
        function getSelectedGalleryValue()
        {
            var checked = $("input[type=radio][name='galleryoption']:checked");
            var id = $(checked).attr("id");

            if(id=='enable_video')
            {
                $('.video').show();
                $('.image').hide();
                $('.custom_image').hide();
                $('.custom_video').hide();

                $('.video').addClass('d-block');
                $('.video').removeClass('d-none');
                $('.image').addClass('d-none');
                $('.custom_image').addClass('d-none');
                $('.custom_video').addClass('d-none');


            }
            else if(id=='enable_image'){

                $('.image').show();
                $('.video').hide();
                $('.custom_image').hide();
                $('.custom_video').hide();

                $('.image').addClass('d-block');
                $('.image').removeClass('d-none');
                $('.video').addClass('d-none');
                $('.custom_image').addClass('d-none');
                $('.custom_video').addClass('d-none');


            }else if(id=='enable_custom_image_link'){
                $('.video').hide();
                $('.image').hide();
                $('.custom_image').show();
                $('.custom_video').hide();

                $('.custom_image').addClass('d-block');
                $('.custom_image').removeClass('d-none');
                $('.image').addClass('d-none');
                $('.video').addClass('d-none');
                $('.custom_video').addClass('d-none');



            }
            else if(id=='enable_custom_video_link'){
                $('.video').hide();
                $('.image').hide();
                $('.custom_image').hide();
                $('.custom_video').show();

                $('.custom_video').addClass('d-block');
                $('.custom_video').removeClass('d-none');
                $('.image').addClass('d-none');
                $('.video').addClass('d-none');
                $('.custom_image').addClass('d-none');

            }

        }
    </script>
    <script type="text/javascript">
        $('.cp_link').on('click', function() {
            var value = $(this).attr('data-link');
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(value).select();
            document.execCommand("copy");
            $temp.remove();
            toastrs('<?php echo e(__('Success')); ?>', '<?php echo e(__('Link Copy on Clipboard')); ?>', 'success');
        });
    </script>

    <script type="text/javascript">
        function enablecookie() {
            const element = $('#enable_cookie').is(':checked');
            $('.cookieDiv').addClass('disabledCookie');
            if (element==true) {
                $('.cookieDiv').removeClass('disabledCookie');
                $("#cookie_logging").attr('checked', true);
                $('.ai_cookie').removeClass('disabledCookie');
            } else {
                $('.cookieDiv').addClass('disabledCookie');
                $("#cookie_logging").attr('checked', false);
                $('.ai_cookie').addClass('disabledCookie');
            }
        }

        //Custom Qr Code Scripts
        $('.qr_type').on('click', function () {
            $("input[type=radio][name='qr_type']").attr('checked', false);
            $("input[type=radio][name='qr_type']").parent().removeClass('btn-primary');
            $("input[type=radio][name='qr_type']").parent().addClass('btn-secondary');


            var value=$(this).children().attr('checked', true);
            var qr_type_val=$(this).children().attr('id');

            if(qr_type_val == 0){
                $('#qr_type_option').slideUp();
                $(this).removeClass('btn-secondary');
                $(this).addClass('btn-primary');
            }else if(qr_type_val == 2){
                $('#qr_type_option').slideDown();
                $('#text_div').slideDown();
                $('#image_div').slideUp();
                $(this).removeClass('btn-secondary');
                $(this).addClass('btn-primary');
            } else if(qr_type_val == 4){
                $('#qr_type_option').slideDown();
                $('#text_div').slideUp();
                $('#image_div').slideDown();
                $(this).removeClass('btn-secondary');
                $(this).addClass('btn-primary');
            }
            generate_qr();
        });

        function generate_qr() {

            if($("input[name='qr_type']:checked").parent().hasClass('btn-primary')==false)
            {
                var chekced=$("input[name='qr_type']:checked").parent().addClass('btn-primary');
                var qr_type_val=$("input[name='qr_type']:checked").attr('id');
                if(qr_type_val == 0){
                    $('#qr_type_option').slideUp();
                    $(this).removeClass('btn-secondary');
                    $(this).addClass('btn-primary');
                }else if(qr_type_val == 2){
                    $('#qr_type_option').slideDown();
                    $('#text_div').slideDown();
                    $('#image_div').slideUp();
                    $(this).removeClass('btn-secondary');
                    $(this).addClass('btn-primary');
                } else if(qr_type_val == 4){
                    $('#qr_type_option').slideDown();
                    $('#text_div').slideUp();
                    $('#image_div').slideDown();
                    $(this).removeClass('btn-secondary');
                    $(this).addClass('btn-primary');
                }
            }
            var card_url = '<?php echo e(env('APP_URL').'/'.$business->slug); ?>';
            $('.code').empty().qrcode({
                render: 'image',
                size: 500,
                ecLevel: 'H',
                minVersion: 3,
                quiet: 1,
                text: card_url,
                fill: $('.foreground_color').val(),
                background: $('.background_color').val(),
                radius: .01 * parseInt($('.radius').val(), 10),
                mode: parseInt($("input[name='qr_type']:checked").val(), 10),
                label: $('.qr_text').val(),
                fontcolor: $('.qr_text_color').val(),
                image: $("#image-buffer")[0],
                mSize: .01 * parseInt($('.qr_size').val(), 10)
            });
        }



        $('.qr_data').on('change', function () {
            generate_qr();
        });

        $('.qr_keyup').on('keyup', function () {
            generate_qr();
        });


        $(document).on('change', '.qr_image', function(e) {
            var img_reader, img_input = $('.qr_image')[0];
            img_input.files && img_input.files[0] && ((img_reader = new window.FileReader).onload = function (event) {
                $("#image-buffer").attr("src", event.target.result);
                setTimeout(generate_qr, 250)
                    // ) generate_qr();
            }, img_reader.readAsDataURL(img_input.files[0]))
        });
        generate_qr();

        function showimagename () {
            var uploaded_image_name = document.getElementById('file-7');
            $('.uploaded_image_name').text(uploaded_image_name.files.item(0).name);
            };

            function showvideoname () {
            var uploaded_image_name = document.getElementById('file-6');
            $('.uploaded_video_name').text(uploaded_image_name.files.item(0).name);
        };

    </script>

    <script>
        function submitForm(e) {

            var banner_val = '<?php echo e($business->banner); ?>';
            var logo_val = '<?php echo e($business->logo); ?>';
            if(banner_val==null || banner_val=='' || logo_val==null ||logo_val=='')
            {
                var banner = $('input[name=banner]')[0].files[0];
                var logo = $('input[name=logo]')[0].files[0];
                if(banner==undefined || banner=='' )
                {
                    $(`#banner_validate`).text("Banner Field is required");
                    return false;
                }
                else if(logo==undefined || logo=='' )
                {
                    $(`#banner_validate`).text("Logo Field is required");
                    return false;
                }
                else
                {
                    $(`#banner_validate`).text("");
                    return true;
                }
            }
        }

        $('.toggleCurrency').on('click', function () {
            // Get references to the select and input elements
            var selectElement = document.getElementById('<?php echo e('product_currency_select' . $product_row_no); ?>');
            var inputElement = document.getElementById('<?php echo e('product_currency_input' . $product_row_no); ?>');

            // Toggle the display style based on user interaction
            if (selectElement.style.display === 'none') {
                selectElement.style.display = 'block';
                inputElement.style.display = 'none';
            } else {
                selectElement.style.display = 'none';
                inputElement.style.display = 'block';
            }
        });

        function changeValue(el) {
        // Get a reference to the select element
            var selectElement = document.getElementById(el);
            // Check if the element exists before attaching the event listener
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            var selectedName = selectedOption.value;
            document.getElementById(el + '_preview').textContent = selectedName;
        }

        let checkboxButtons = document.querySelectorAll(".paymentButton");
        let stripeContainer = document.getElementById("stripeContainer");
        let paypalContainer = document.getElementById("paypalContainer");


        checkboxButtons.forEach(function (checkbox) {
        checkbox.addEventListener("change", function () {
            // Hide both containers on every checkbox change

                // Display the container based on the checked checkbox
                if (document.getElementById("stripeLabel").checked) {
                    stripeContainer.classList.add('active');
                } else {
                    stripeContainer.classList.remove('active');
                }
                if (document.getElementById("paypal").checked) {
                    paypalContainer.classList.add('active');
                } else {
                    paypalContainer.classList.remove('active');
                }
            });
        });

    </script>

    <script>
        $("input").keyup(function() {

            var id = $(this).attr('id');
            var preview = $(`#${id}`).val();
            $(`#${id}_preview`).text(preview);
        });
        $(function() {
            var selectedItems = $("#selected-item-hidden").val().split(",");
            if (selectedItems[0] !== '') { // Check if the array is not empty
                selectedItems.forEach(function(itemIndex) {
                    $("#selectable img").eq(parseInt(itemIndex) - 1).addClass("ui-selected");
                });
            }
            $("#selectable").selectable({
                selected: function() {

                var selectedItem = $("#selected-item-hidden").empty();
                $(".ui-selected", this).each(function() {
                    var index = $("#selectable img").index(this);
                    selectedItem.val((index + 1));
                });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            // Handle predefined color selection
            $('.colorinput-input').on('change', function () {
                let themeKey = $(this).data('theme');

                // Reset the corresponding color picker input
                $('#color-picker-' + themeKey).val('');

                // Set color_flag to false for this theme only
                $('#color-flag-' + themeKey).val('false');
            });

            // Handle custom color picker selection
            $('.colorPicker').on('input', function () {
                let selectedColor = $(this).val();
                let themeKey = $(this).attr('id').replace('color-picker-', '');

                if (selectedColor) {
                    // Uncheck radio buttons only within this theme card
                    $('#' + themeKey + ' .colorinput-input').prop('checked', false);

                    // Set color_flag only for this theme
                    $('#color-flag-' + themeKey).val('true');
                }
            });

            // Ensure only the selected theme's color is sent on form submit
        $("form").on("submit", function () {
            let selectedTheme = $("input[name='themefile']").val(); // Get the selected theme
            let customColor = $("#color-picker-" + selectedTheme).val(); // Get the custom color for selected theme
            let colorFlag = $("#color-flag-" + selectedTheme).val(); // Get the color flag for selected theme

            // Set only the selected theme's color and flag
            $("input[name='custom_color']").val(customColor);
            $("input[name='color_flag']").val(colorFlag);
        });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/business/edit.blade.php ENDPATH**/ ?>