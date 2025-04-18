<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Settings')); ?>

<?php $__env->stopSection(); ?>
<?php
    use App\Models\Utility;
    $logo = \App\Models\Utility::get_file('uploads/logo/');
    $lang = \App\Models\Utility::getValByName('company_default_language');
    $logo_img = \App\Models\Utility::getValByName('company_logo');

    $logo_light_img = \App\Models\Utility::getValByName('company_logo_light');

    $company_favicon = \App\Models\Utility::getValByName('company_favicon');

    $setting = App\Models\Utility::settings();
    if (\Auth::user()->type == 'Super Admin') {
        $settings = Utility::settings();
    } else {
        $settings = Utility::getsettingsbyid(\Auth::user()->id);
    }
    $color = !empty($setting['color']) ? $setting['color'] : 'theme-3';
    $flag = !empty($setting['color_flag']) ? $setting['color_flag'] : 'false';
?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Settings')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-scripts'); ?>
    <script>
        var custthemebg = document.querySelector("#cust-theme-bg");
        custthemebg.addEventListener("click", function() {
            if (custthemebg.checked) {
                document.querySelector(".dash-sidebar").classList.add("transprent-bg");
                document
                    .querySelector(".dash-header:not(.dash-mob-header)")
                    .classList.add("transprent-bg");
            } else {
                document.querySelector(".dash-sidebar").classList.remove("transprent-bg");
                document
                    .querySelector(".dash-header:not(.dash-mob-header)")
                    .classList.remove("transprent-bg");
            }
        });
    </script>
<script>
    if ($('#cust-darklayout').length > 0) {
            var custthemedark = document.querySelector("#cust-darklayout");
            custthemedark.addEventListener("click", function() {
                if (custthemedark.checked) {
                    $('#main-style-link').attr('href','<?php echo e(env("APP_URL")); ?>'+'/public/assets/css/style-dark.css');
                    $('.dash-sidebar .main-logo a img').attr('src','<?php echo e($logo.$logo_light_img); ?>');
                    document.body.style.background = 'linear-gradient(141.55deg, #22242C 3.46%, #22242C 99.86%)';
                } else {
                    $('#main-style-link').attr('href','<?php echo e(env("APP_URL")); ?>'+'/public/assets/css/style.css');
                    $('.dash-sidebar .main-logo a img').attr('src','<?php echo e($logo.$logo_img); ?>');
                    document.body.style.background='linear-gradient(141.55deg, rgba(240, 244, 243, 0) 3.46%, #F0F4F3 99.86%)';
                }
            });
        }
</script>
<script type="text/javascript">
    $(document).on("click", '.send_email', function(e) {
        e.preventDefault();
        var title = $(this).attr('data-title');
        var size = 'md';
        var url = $(this).attr('data-url');

        if (typeof url != 'undefined') {
            $("#commonModal .modal-title").html(title);
            $("#commonModal .modal-dialog").addClass('modal-' + size);
            $("#commonModal").modal('show');

            $.post(url, {
                _token: '<?php echo e(csrf_token()); ?>',
                mail_driver: $("#mail_driver").val(),
                mail_host: $("#mail_host").val(),
                mail_port: $("#mail_port").val(),
                mail_username: $("#mail_username").val(),
                mail_password: $("#mail_password").val(),
                mail_encryption: $("#mail_encryption").val(),
                mail_from_address: $("#mail_from_address").val(),
                mail_from_name: $("#mail_from_name").val(),

            }, function(data) {
                $('#commonModal .modal-body').html(data);
            });
        }
    });
    $(document).on('submit', '#test_email', function(e) {
        e.preventDefault();
        $("#email_sending").show();
        var post = $(this).serialize();
        var url = $(this).attr('action');
        $.ajax({
            type: "post",
            url: url,
            data: post,
            cache: false,
            beforeSend: function() {
                $('#test_email .btn-create').attr('disabled', 'disabled');
            },
            success: function(data) {

                if (data.is_success) {
                    toastrs('Success', data.message, 'success');
                } else {
                    toastrs('Error', data.message, 'error');
                }
                $("#email_sending").hide();
                $('#commonModal').modal('hide');

            },
            complete: function() {
                $('#test_email .btn-create').removeAttr('disabled');
            },
        });
    });
</script>
<script>

    $('.colorPicker').on('click', function(e) {
               $('body').removeClass('custom-color');
               if (/^theme-\d+$/) {
                   $('body').removeClassRegex(/^theme-\d+$/);
               }
               $('body').addClass('custom-color');
               $('.themes-color-change').removeClass('active_color');
               $(this).addClass('active_color');
               const input = document.getElementById("color-picker");
               setColor();
               input.addEventListener("input", setColor);

               function setColor() {
                   $(':root').css('--color-customColor', input.value);
               }

               $(`input[name='color_flag`).val('true');
           });

           $('.themes-color-change').on('click', function() {

           $(`input[name='color_flag`).val('false');

               var color_val = $(this).data('value');
               $('body').removeClass('custom-color');
               if(/^theme-\d+$/)
               {
                   $('body').removeClassRegex(/^theme-\d+$/);
               }
               $('body').addClass(color_val);
               $('.theme-color').prop('checked', false);
               $('.themes-color-change').removeClass('active_color');
               $('.colorPicker').removeClass('active_color');
               $(this).addClass('active_color');
               $(`input[value=${color_val}]`).prop('checked', true);
           });

           $.fn.removeClassRegex = function(regex) {
       return $(this).removeClass(function(index, classes) {
           return classes.split(/\s+/).filter(function(c) {
               return regex.test(c);
           }).join(' ');
       });
   };
   </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <!-- [ sample-page ] start -->
        <div class="row">
            <div class="col-xl-3">
                <div class="card mb-xl-0 sticky-top" style="top:30px">
                    <div class="list-group list-group-flush" id="useradd-sidenav">
                        <a href="#site-settings"
                            class="list-group-item list-group-item-action border-0"><?php echo e(__('Site Settings')); ?>

                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                        <a href="#Google_Setting"
                            class="list-group-item list-group-item-action border-0"><?php echo e(__('Google Calendar Settings')); ?>

                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                        <a href="#Webhook_Setting"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Webhook Settings')); ?>

                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                        <a href="#email-settings"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Email Settings')); ?>

                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 setting-menu-div">
                <div id="site-settings" class="card">
                    <?php echo e(Form::model($setting, ['route' => 'company.settings.store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class'=>'mb-0'])); ?>

                    <div class="card-header p-3">
                        <h5><?php echo e(__('Site Settings')); ?></h5>
                        <small class="text-muted"><?php echo e(__('Edit your site details')); ?></small>
                    </div>
                    <div class="card-body px-3">
                        <div class="row row-gap">
                            <div class="col-md-4 col-sm-6 col-12">
                                <div class="card">
                                    <div class="card-header p-3">
                                        <h5><?php echo e(__('Logo Dark')); ?></h5>
                                    </div>
                                    <div class="card-body p-3 setting-logo-box">
                                        <a href="<?php echo e($logo . (isset($logo_img) && !empty($logo_img) ? $logo_img : 'logo-dark.png')); ?>" class="logo-content img-fluid  text-center" target="_blank">
                                            <img id="blah" alt="your image"
                                                src="<?php echo e($logo . (isset($logo_img) && !empty($logo_img) ? $logo_img : 'logo-dark.png').'?'.time()); ?>"
                                                width="150px" class="big-logo">
                                        </a>
                                        <div class="choose-files text-center mt-3">
                                            <label for="company_logo">
                                                <div class="bg-primary company_logo_update"> <i
                                                        class="ti ti-upload px-1"></i><?php echo e(__('Select image')); ?>

                                                </div>
                                                <input type="file" class="form-control file" name="company_logo"
                                                    id="company_logo" data-filename="edit-logo"
                                                    onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                            </label>
                                        </div>
                                        <?php $__errorArgs = ['logo'];
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
                            <div class="col-md-4 col-sm-6 col-12">
                                <div class="card">
                                    <div class="card-header p-3">
                                        <h5><?php echo e(__('Logo Light')); ?></h5>
                                    </div>
                                    <div class="card-body p-3 setting-logo-box">
                                        <a href="<?php echo e($logo . (isset($logo_light_img) && !empty($logo_light_img) ? $logo_light_img : 'company_logo_light.png')); ?>" class="logo-content img-fluid dark-logo text-center" target="_blank">
                                            <img id="blah1" alt="your image"
                                                src="<?php echo e($logo . (isset($logo_light_img) && !empty($logo_light_img) ? $logo_light_img : 'company_logo_light.png').'?'.time()); ?>">
                                        </a>
                                        <div class="choose-files text-center mt-3">
                                            <label for="logo_light">
                                                <div class="bg-primary company_favicon_update"> <i
                                                        class="ti ti-upload px-1"></i><?php echo e(__('Select image')); ?>

                                                </div>
                                                <input type="file" class="form-control file"
                                                    name="company_logo_light" id="logo_light"
                                                    data-filename="logo_light_update"
                                                    onchange="document.getElementById('blah1').src = window.URL.createObjectURL(this.files[0])">
                                            </label>
                                        </div>
                                        <?php $__errorArgs = ['logo-light'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-company_favicon text-xs text-danger"
                                            role="alert"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-12">
                                <div class="card">
                                    <div class="card-header p-3">
                                        <h5><?php echo e(__('Favicon')); ?></h5>
                                    </div>
                                    <div class="card-body p-3 setting-logo-box">
                                        <a href="<?php echo e($logo . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png')); ?>" class="logo-content img-fluid  text-center" target="_blank">
                                            <img id="blah2" alt="your image"
                                                src="<?php echo e($logo . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png').'?'.time()); ?>" class="img_setting">
                                        </a>
                                        <div class="choose-files text-center mt-3">
                                            <label for="company_favicon">
                                                <div class="bg-primary company_favicon_update "> <i
                                                        class="ti ti-upload px-1"></i><?php echo e(__('Select image')); ?>

                                                </div>
                                                <input type="file" name="company_favicon" id="company_favicon"
                                                    class="form-control file"
                                                    data-filename="company_favicon_update"
                                                    onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])">
                                            </label>
                                        </div>
                                        <?php $__errorArgs = ['favicon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-company_favicon text-xs text-danger"
                                                role="alert"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-gap mt-3">
                            <div class="col-md-4 col-sm-6 col-12">
                                <div class="form-group mb-0">
                                    <?php echo e(Form::label('title_text', __('Title Text'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('title_text', null, ['class' => 'form-control', 'placeholder' => __('Title Text')])); ?>

                                    <?php $__errorArgs = ['title_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-title_text" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-12">
                                <div class="form-group mb-0">
                                    <?php echo e(Form::label('timezone', __('Timezone'), ['class' => 'form-label'])); ?>

                                    <select type="text" name="timezone" class="form-control" id="timezone">
                                        <option value=""><?php echo e(__('Select Timezone')); ?></option>
                                        <?php $__currentLoopData = $timezones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $timezone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($k); ?>"
                                                <?php echo e($setting['timezone'] == $k ? 'selected' : ''); ?>>
                                                <?php echo e($timezone); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-12">
                                <div class="form-group mb-0">
                                    <?php echo e(Form::label('default_language', __('Default Language'), ['class' => 'form-label'])); ?>

                                    <div class="changeLanguage">
                                        <select name="company_default_language" id="company_default_language"
                                            class="form-control select2">
                                            <?php $__currentLoopData = App\Models\Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if($lang == $code): ?> selected <?php endif; ?>
                                                    value="<?php echo e($code); ?>">
                                                    <?php echo e(ucFirst($language)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-1 border-top px-3">
                        <div class="setting-card setting-logo-box">
                            <h5 class="mb-3"><?php echo e(__('Theme Customizer')); ?></h5>
                            <div class="row row-gap">
                                <div class="col-xxl-3 col-md-4 col-sm-6 col-12">
                                    <div class="card h-100 mb-0">
                                        <div class="card-header p-2">
                                            <h6 class="d-flex align-items-center gap-2">
                                                <i class="ti ti-credit-card"></i>
                                                <?php echo e(__('Primary color settings')); ?>

                                            </h6>
                                        </div>
                                        <div class="card-body p-2">
                                            <div class="color-wrp mt-0">
                                                <div class="theme-color themes-color">
                                                    <a href="#!" class="themes-color-change rounded-circle <?php echo e($color == 'theme-1' ? 'active_color' : ''); ?>" data-value="theme-1"></a>
                                                    <input type="radio" class="theme_color d-none" name="color" value="theme-1"<?php echo e($color == 'theme-1' ? 'checked' : ''); ?>>
                                                    <a href="#!" class="themes-color-change rounded-circle <?php echo e($color == 'theme-2' ? 'active_color' : ''); ?>" data-value="theme-2"></a>
                                                    <input type="radio" class="theme_color d-none" name="color" value="theme-2"<?php echo e($color == 'theme-2' ? 'checked' : ''); ?>>
                                                    <a href="#!" class="themes-color-change rounded-circle <?php echo e($color == 'theme-3' ? 'active_color' : ''); ?>" data-value="theme-3"></a>
                                                    <input type="radio" class="theme_color d-none" name="color" value="theme-3"<?php echo e($color == 'theme-3' ? 'checked' : ''); ?>>
                                                    <a href="#!" class="themes-color-change rounded-circle <?php echo e($color == 'theme-4' ? 'active_color' : ''); ?>" data-value="theme-4"></a>
                                                    <input type="radio" class="theme_color d-none" name="color" value="theme-4"<?php echo e($color == 'theme-4' ? 'checked' : ''); ?>>
                                                    <a href="#!" class="themes-color-change rounded-circle <?php echo e($color == 'theme-5' ? 'active_color' : ''); ?>" data-value="theme-5"></a>
                                                    <input type="radio" class="theme_color d-none" name="color" value="theme-5"<?php echo e($color == 'theme-5' ? 'checked' : ''); ?>>
                                                    <a href="#!" class="themes-color-change rounded-circle <?php echo e($color == 'theme-6' ? 'active_color' : ''); ?>" data-value="theme-6"></a>
                                                    <input type="radio" class="theme_color d-none" name="color" value="theme-6"<?php echo e($color == 'theme-6' ? 'checked' : ''); ?>>
                                                    <a href="#!" class="themes-color-change rounded-circle <?php echo e($color == 'theme-7' ? 'active_color' : ''); ?>" data-value="theme-7"></a>
                                                    <input type="radio" class="theme_color d-none" name="color" value="theme-7"<?php echo e($color == 'theme-7' ? 'checked' : ''); ?>>
                                                    <a href="#!" class="themes-color-change rounded-circle <?php echo e($color == 'theme-8' ? 'active_color' : ''); ?>" data-value="theme-8"></a>
                                                    <input type="radio" class="theme_color d-none" name="color" value="theme-8"<?php echo e($color == 'theme-8' ? 'checked' : ''); ?>>
                                                    <a href="#!" class="themes-color-change rounded-circle <?php echo e($color == 'theme-9' ? 'active_color' : ''); ?>" data-value="theme-9"></a>
                                                    <input type="radio" class="theme_color d-none" name="color" value="theme-9"<?php echo e($color == 'theme-9' ? 'checked' : ''); ?>>
                                                    <a href="#!" class="themes-color-change rounded-circle <?php echo e($color == 'theme-10' ? 'active_color' : ''); ?>" data-value="theme-10"></a>
                                                    <input type="radio" class="theme_color d-none" name="color" value="theme-10"<?php echo e($color == 'theme-10' ? 'checked' : ''); ?>>
                                                    <div class="color-picker-wrp ">
                                                        <input type="color" value="<?php echo e($color ? $color : ''); ?>" class="colorPicker rounded-circle <?php echo e(isset($flag) && $flag == 'true' ? 'active_color' : ''); ?>" name="custom_color" id="color-picker">
                                                        <input type='hidden' name="color_flag" value = <?php echo e(isset($flag) && $flag == 'true' ? 'true' : 'false'); ?>>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-md-4 col-sm-6 col-12">
                                    <div class="card h-100 mb-0">
                                        <div class="card-header p-2">
                                            <h6 class="d-flex align-items-center gap-2">
                                                <i class="ti ti-align-right"></i>
                                                <?php echo e(__('Enable RTL')); ?>

                                            </h6>
                                        </div>
                                        <div class="card-body p-2">
                                            <?php echo e(Form::label('SITE_RTL', __('RTL Layout'), ['class' => 'form-check-label f-w-600 mb-2'])); ?>

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input"
                                                    name="SITE_RTL" id="SITE_RTL"
                                                    <?php echo e($setting['SITE_RTL'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-md-4 col-sm-6 col-12">
                                    <div class="card h-100 mb-0">
                                        <div class="card-header p-2">
                                            <h6 class="d-flex align-items-center gap-2">
                                                <i class="ti ti-layout-sidebar"></i>
                                                <?php echo e(__('Sidebar settings')); ?>

                                            </h6>
                                        </div>
                                        <div class="card-body p-2">
                                            <?php echo e(Form::label('cust-theme-bg', __('Transparent layout'), ['class' => 'f-w-600 mb-2'])); ?>

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" id="cust-theme-bg" name="cust_theme_bg" <?php echo e(!empty($settings['cust_theme_bg']) && $settings['cust_theme_bg'] == 'on' ? 'checked' : ''); ?>/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-md-4 col-sm-6 col-12">
                                    <div class="card h-100 mb-0">
                                        <div class="card-header p-2">
                                            <h6 class="d-flex align-items-center gap-2">
                                                <i class="ti ti-sun"></i>
                                                <?php echo e(__('Layout settings')); ?>

                                            </h6>
                                        </div>
                                        <div class="card-body p-2">
                                            <?php echo e(Form::label('cust-darklayout', __('Dark Layout'), ['class' => 'form-check-label f-w-600 mb-2'])); ?>

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" id="cust-darklayout" name="cust_darklayout"<?php echo e(!empty($settings['cust_darklayout']) && $settings['cust_darklayout'] == 'on' ? 'checked' : ''); ?> />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-3 text-end">
                        <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn btn-lg btn-primary">
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
                <div id="Google_Setting" class="card text-white">
                    <?php echo e(Form::open(['url' => route('setting.GoogleCalendaSetting'), 'enctype' => 'multipart/form-data'])); ?>

                    <div class="card-header p-3 d-flex align-items-center justify-content-between gap-2">
                        <div>
                            <h5 class=""><?php echo e(__('Google Calendar Settings')); ?></h5>
                            <small class="text-secondary font-weight-bold"><?php echo e(__('Edit your Google Calendar')); ?></small>
                        </div>
                        <div class="form-check form-switch custom-switch-v1">
                            <input type="checkbox" name="Google_Calendar" id="Google_Calendar" class="form-check-input input-primary"
                                <?php echo e(isset($settings['Google_Calendar']) && $settings['Google_Calendar'] == 'on' ? 'checked="checked"' : ''); ?>>
                            <label class="custom-label form-label" for="Google_Calendar"></label>
                        </div>
                    </div>
                    <div class="card-body px-3">
                        <div class="row row-gap">
                            <div class="col-sm-6 col-12">
                                <div class="form-group mb-0">
                                    <label for="google_calender_id" class="form-label text-black"><?php echo e(__('Google calendar id')); ?></label>
                                        <input type="text" name="google_calender_id" class="form-control"
                                        placeholder="Enter Google calendar id"
                                        value="<?php echo e(!empty($settings['google_calender_id']) ? $settings['google_calender_id'] : ''); ?>">
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="form-group mb-0">
                                    <label for="google_calender_json_file" class="form-label text-black"><?php echo e(__('Google calendar json file')); ?></label>
                                    <input type="file" name="google_calender_json_file" id="json_file"
                                        class="form-control custom-input-file"
                                        placeholder="Enter Google calendar json file"
                                        value="<?php echo e(!empty($settings['google_calender_json_file']) ? $settings['google_calender_json_file'] : ''); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end p-3">
                        <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-lg btn-primary'])); ?>

                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
                
                <div id="Webhook_Setting" class="card text-white">
                    <div class="card-header p-3 d-flex align-items-center justify-content-between gap-2">
                        <h5><?php echo e(__('Webhook Settings')); ?></h5>
                            <a href="#" class="btn btn-sm btn-primary btn-icon m-1" data-bs-target="#exampleModal"
                                data-url="<?php echo e(route('webhook.create')); ?>" data-bs-whatever="<?php echo e(__('Create Webhook')); ?>" data-bs-toggle="modal">
                                <span class="text-white">
                                    <i class="ti ti-plus text-white" data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Create Webhook')); ?>"></i></span>
                            </a>
                    </div>
                    <div class="card-body px-3">
                        <div class="table-responsive">
                            <table class="table" id="dataTable">
                                <thead>
                                <tr>
                                    <th> <?php echo e(__('Module')); ?></th>
                                    <th> <?php echo e(__('Method')); ?></th>
                                    <th> <?php echo e(__('URL')); ?></th>
                                    <th class="text-right"> <?php echo e(__('Action')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $webhook; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $webhook_detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($webhook_detail->module); ?></td>
                                        <td><?php echo e($webhook_detail->method); ?></td>
                                        <td><?php echo e($webhook_detail->url); ?></td>
                                        <td class="action">
                                            <div class="action-btn  me-2">
                                                <a href="#" class="mx-3 btn bg-info btn-sm d-inline-flex align-items-center" data-toggle="modal" data-target="#commonModal" data-ajax-popup="true" data-size="md" data-url="<?php echo e(route('webhook.edit',$webhook_detail->id)); ?>" data-title="<?php echo e(__('Webhook Edit')); ?>" data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Webhook Edit')); ?>"> <span class="text-white"><i
                                                    class="ti ti-pencil text-white"></i></span></a>
                                            </div>
                                            <div class="action-btn me-2">
                                                <a href="#"
                                                    class="bs-pass-para bg-danger mx-3 btn btn-sm d-inline-flex align-items-center"
                                                    data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                    data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                    data-confirm-yes="delete-form-<?php echo e($webhook_detail->id); ?>"
                                                    title="<?php echo e(__('Delete')); ?>" data-bs-toggle="tooltip"
                                                    data-bs-placement="top"><span class="text-white"><i
                                                            class="ti ti-trash"></i></span></a>
                                            </div>
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['webhook.destroy', $webhook_detail->id],'id'=>'delete-form-'.$webhook_detail->id]); ?>

                                            <?php echo Form::close(); ?>


                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                
                <div id="email-settings" class="card mb-0">
                    <div class="card-header p-3">
                        <h5><?php echo e(__('Email Settings')); ?></h5>
                        <small class="text-muted"><?php echo e(__('(This SMTP will be used for sending your company-level email. If this field is empty, then SuperAdmin SMTP will be used for sending emails.)')); ?></small>
                    </div>
                    <?php echo e(Form::open(['route' => 'company.email.settings', 'method' => 'post','class'=>'mb-0'])); ?>

                    <div class="card-body px-3">
                        <div class="row row-gap">
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12 form-group mb-0">
                                <?php echo e(Form::label('mail_driver', __('Mail Driver'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('mail_driver',$settings['mail_driver'], ['class' => 'form-control', 'placeholder' => __('Enter Mail Driver')])); ?>

                                <?php $__errorArgs = ['mail_driver'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-mail_driver" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12 form-group mb-0">
                                <?php echo e(Form::label('mail_host', __('Mail Host'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('mail_host', $settings['mail_host'], ['class' => 'form-control ', 'placeholder' => __('Enter Mail Host')])); ?>

                                <?php $__errorArgs = ['mail_host'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-mail_driver" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12 form-group mb-0">
                                <?php echo e(Form::label('mail_port', __('Mail Port'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('mail_port', $settings['mail_port'], ['class' => 'form-control', 'placeholder' => __('Enter Mail Port')])); ?>

                                <?php $__errorArgs = ['mail_port'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-mail_port" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12 form-group mb-0">
                                <?php echo e(Form::label('mail_username', __('Mail Username'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('mail_username', $settings['mail_username'], ['class' => 'form-control', 'placeholder' => __('Enter Mail Username')])); ?>

                                <?php $__errorArgs = ['mail_username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-mail_username" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12 form-group mb-0">
                                <?php echo e(Form::label('mail_password', __('Mail Password'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('mail_password', $settings['mail_password'], ['class' => 'form-control', 'placeholder' => __('Enter Mail Password')])); ?>

                                <?php $__errorArgs = ['mail_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-mail_password" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12 form-group mb-0">
                                <?php echo e(Form::label('mail_encryption', __('Mail Encryption'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('mail_encryption', $settings['mail_encryption'], ['class' => 'form-control', 'placeholder' => __('Enter Mail Encryption')])); ?>

                                <?php $__errorArgs = ['mail_encryption'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-mail_encryption" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12 form-group mb-0">
                                <?php echo e(Form::label('mail_from_address', __('Mail From Address'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('mail_from_address', $settings['mail_from_address'], ['class' => 'form-control', 'placeholder' => __('Enter Mail From Address')])); ?>

                                <?php $__errorArgs = ['mail_from_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-mail_from_address" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12 form-group mb-0">
                                <?php echo e(Form::label('mail_from_name', __('Mail From Name'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('mail_from_name', $settings['mail_from_name'], ['class' => 'form-control', 'placeholder' => __('Enter Mail From Name')])); ?>

                                <?php $__errorArgs = ['mail_from_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-mail_from_name" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-3">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                            <div>
                                <a href="#" data-url="<?php echo e(route('test.mail')); ?>" data-ajax-popup="true"
                                    data-title="<?php echo e(__('Send Test Mail')); ?>"  data-title="<?php echo e(__('Send Test Mail')); ?>" data-bs-toggle="tooltip"
                                    data-bs-original-title="<?php echo e(__('Send Test Mail')); ?>" data-bs-placement="top"
                                    class="send_email btn m-r-10  btn-primary" >
                                    <?php echo e(__('Send Test Mail')); ?>

                                </a>
                            </div>
                            <div>
                                <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-print-invoice  btn-primary'])); ?>

                            </div>
                        </div>

                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
                
            </div>
        </div>
        <!-- [ sample-page ] end -->
    <!-- [ Main Content ] end -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('custom-scripts'); ?>
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {

        target: '#useradd-sidenav',
        offset: 300,
        })
        $(".list-group-item").click(function() {
        $('.list-group-item').filter(function() {
            // alert('fghyht');
            // return this.href == id ;
        }).parent().removeClass('text-primary');
        });

        function check_theme(color_val) {
        $('#theme_color').prop('checked', false);
        $('input[value="' + color_val + '"]').prop('checked', true);
        }
        $(document).on('click', 'input[name="theme_color"]', function() {
            var eleParent = $(this).attr('data-theme');
            $('#themefile').val(eleParent);
            var imgpath = $(this).attr('data-imgpath');
            $('.' + eleParent + '_img').attr('src', imgpath);
        });

        $(document).ready(function() {
            setTimeout(function(e) {
                var checked = $("input[type=radio][name='theme_color']:checked");
                $('#themefile').val(checked.attr('data-theme'));
                $('.' + checked.attr('data-theme') + '_img').attr('src', checked.attr('data-imgpath'));
            }, 300);
        });

        function check_theme(color_val) {

            $('.theme-color').prop('checked', false);
            $('input[value="' + color_val + '"]').prop('checked', true);
            $('#color_value').val(color_val);
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/settings/index.blade.php ENDPATH**/ ?>