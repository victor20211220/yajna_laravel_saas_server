<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Settings')); ?>

<?php $__env->stopSection(); ?>
<?php
    use App\Models\Utility;
    // $logo=asset(Storage::url('uploads/'));
    $logo = \App\Models\Utility::get_file('uploads/logo/');

    $lang = \App\Models\Utility::getValByName('default_language');

    $file_type = config('files_types');
    $setting = App\Models\Utility::settings();

    $local_storage_validation = $setting['local_storage_validation'];
    $local_storage_validations = explode(',', $local_storage_validation);

    $s3_storage_validation = $setting['s3_storage_validation'];
    $s3_storage_validations = explode(',', $s3_storage_validation);

    $wasabi_storage_validation = $setting['wasabi_storage_validation'];
    $wasabi_storage_validations = explode(',', $wasabi_storage_validation);

    $logo_light = \App\Models\Utility::getValByName('company_logo_light');
    $logo_dark = \App\Models\Utility::getValByName('company_logo');

    $chatgpt_setting = App\Models\Utility::chatgpt_setting(\Auth::user()->creatorId());
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


<?php if($color == 'theme-3'): ?>
    <style>
        .btn-check:checked+.btn-outline-success,
        .btn-check:active+.btn-outline-success,
        .btn-outline-success:active,
        .btn-outline-success.active,
        .btn-outline-success.dropdown-toggle.show {
            color: #ffffff;
            background-color: #6fd943 !important;
            border-color: #6fd943 !important;

        }

        .btn-outline-success:hover {
            color: #ffffff;
            background-color: #6fd943 !important;
            border-color: #6fd943 !important;
        }

        .btn.btn-outline-success {
            color: #6fd943;
            border-color: #6fd943 !important;
        }
    </style>
<?php endif; ?>
<?php if($color == 'theme-2'): ?>
    <style>
        .btn-check:checked+.btn-outline-success,
        .btn-check:active+.btn-outline-success,
        .btn-outline-success:active,
        .btn-outline-success.active,
        .btn-outline-success.dropdown-toggle.show {
            color: #ffffff;
            background: linear-gradient(141.55deg, rgba(240, 244, 243, 0) 3.46%, #4ebbd3 99.86%)#1f3996 !important;
            border-color: #1F3996 !important;

        }

        .btn-outline-success:hover {
            color: #ffffff;
            background: linear-gradient(141.55deg, rgba(240, 244, 243, 0) 3.46%, #4ebbd3 99.86%)#1f3996 !important;
            border-color: #1F3996 !important;
        }

        .btn.btn-outline-success {
            color: #1F3996;
            border-color: #1F3996 !important;
        }
    </style>
<?php endif; ?>
<?php if($color == 'theme-4'): ?>
    <style>
        .btn-check:checked+.btn-outline-success,
        .btn-check:active+.btn-outline-success,
        .btn-outline-success:active,
        .btn-outline-success.active,
        .btn-outline-success.dropdown-toggle.show {
            color: #ffffff;
            background-color: #584ed2 !important;
            border-color: #584ed2 !important;

        }

        .btn-outline-success:hover {
            color: #ffffff;
            background-color: #584ed2 !important;
            border-color: #584ed2 !important;
        }

        .btn.btn-outline-success {
            color: #584ed2;
            border-color: #584ed2 !important;
        }
    </style>
<?php endif; ?>
<?php if($color == 'theme-1'): ?>
    <style>
        .btn-check:checked+.btn-outline-success,
        .btn-check:active+.btn-outline-success,
        .btn-outline-success:active,
        .btn-outline-success.active,
        .btn-outline-success.dropdown-toggle.show {
            color: #ffffff;
            background: linear-gradient(141.55deg, rgba(81, 69, 157, 0) 3.46%, rgba(255, 58, 110, 0.6) 99.86%), #51459d !important;
            border-color: #51459d !important;

        }

        .btn-outline-success:hover {
            color: #ffffff;
            background: linear-gradient(141.55deg, rgba(81, 69, 157, 0) 3.46%, rgba(255, 58, 110, 0.6) 99.86%), #51459d !important;
            border-color: #51459d !important;
        }

        .btn.btn-outline-success {
            color: #51459d;
            border-color: #51459d !important;
        }
    </style>
<?php endif; ?>
<?php $__env->startPush('custom-scripts'); ?>
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300
        });
        var multipleCancelButton = new Choices(
            '#choices-multiple-remove-button', {
                removeItemButton: true,
            }
        );
        var multipleCancelButton = new Choices(
            '#choices-multiple-remove-button1', {
                removeItemButton: true,
            }
        );
        var multipleCancelButton = new Choices(
            '#choices-multiple-remove-button2', {
                removeItemButton: true,
            }
        );
    </script>
    <script>
        $(document).ready(function() {
            if ($('.gdpr_fulltime').is(':checked')) {

                $('.fulltime').show();
            } else {

                $('.fulltime').hide();
            }

            $('#gdpr_cookie').on('change', function() {
                if ($('.gdpr_fulltime').is(':checked')) {

                    $('.fulltime').show();
                } else {

                    $('.fulltime').hide();
                }
            });
        });
    </script>
    <script src="<?php echo e(asset('custom/libs/jquery-mask-plugin/dist/jquery.mask.min.js')); ?>"></script>
    <script>
        function myFunction() {
            var copyText = document.getElementById("myInput");
            copyText.select();
            copyText.setSelectionRange(0, 99999)
            document.execCommand("copy");
            show_toastr('Success', "<?php echo e(__('Link copied')); ?>", 'success');
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
    </script>
    <script>
        function check_theme(color_val) {
            $('.theme-color').prop('checked', false);
            $('input[value="' + color_val + '"]').prop('checked', true);
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

        $(document).on('change', '[name=storage_setting]', function() {
            if ($(this).val() == 's3') {
                $('.s3-setting').removeClass('d-none');
                $('.wasabi-setting').addClass('d-none');
                $('.local-setting').addClass('d-none');
            } else if ($(this).val() == 'wasabi') {
                $('.s3-setting').addClass('d-none');
                $('.wasabi-setting').removeClass('d-none');
                $('.local-setting').addClass('d-none');
            } else {
                $('.s3-setting').addClass('d-none');
                $('.wasabi-setting').addClass('d-none');
                $('.local-setting').removeClass('d-none');
            }
        });
    </script>
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
                    $('#main-style-link').attr('href', '<?php echo e(env('APP_URL')); ?>' +
                        '/public/assets/css/style-dark.css');
                    $('.dash-sidebar .main-logo a img').attr('src', '<?php echo e($logo . $logo_light); ?>');
                    document.body.style.background = 'linear-gradient(141.55deg, #22242C 3.46%, #22242C 99.86%)';
                } else {
                    $('#main-style-link').attr('href', '<?php echo e(env('APP_URL')); ?>' + '/public/assets/css/style.css');
                    $('.dash-sidebar .main-logo a img').attr('src', '<?php echo e($logo . $logo_dark); ?>');
                    document.body.style.background =
                        'linear-gradient(141.55deg, rgba(240, 244, 243, 0) 3.46%, #F0F4F3 99.86%)';
                }
            });
        }
    </script>

    <script type="text/javascript">
        function enablecookie() {
            const element = $('#enable_cookie').is(':checked');
            $('.cookieDiv').addClass('disabledCookie');
            if (element == true) {
                $('.cookieDiv').removeClass('disabledCookie');
                $("#cookie_logging").attr('checked', true);
            } else {
                $('.cookieDiv').addClass('disabledCookie');
                $("#cookie_logging").attr('checked', false);
            }
        }
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
            if (/^theme-\d+$/) {
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
                    <a href="#brand-settings"
                        class="list-group-item list-group-item-action border-0"><?php echo e(__('Brand Settings')); ?>

                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                    </a>
                    <a href="#email-settings"
                        class="list-group-item list-group-item-action border-0"><?php echo e(__('Email Settings')); ?>

                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                    </a>
                    <a href="#payment-settings"
                        class="list-group-item list-group-item-action border-0"><?php echo e(__('Payment Settings')); ?>

                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                    </a>
                    <a href="#recaptcha-settings"
                        class="list-group-item list-group-item-action border-0"><?php echo e(__('ReCaptcha Settings')); ?>

                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                    </a>
                    <a href="#storage-settings"
                        class="list-group-item list-group-item-action border-0"><?php echo e(__('Storage Settings')); ?>

                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                    </a>
                    <a href="#cache-settings"
                        class="list-group-item list-group-item-action border-0"><?php echo e(__('Cache Settings')); ?>

                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                    </a>
                    <a href="#cookie-settings"
                        class="list-group-item list-group-item-action border-0"><?php echo e(__('Cookie Settings')); ?>

                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                    </a>
                    <a href="#chatgpt-settings"
                        class="list-group-item list-group-item-action border-0"><?php echo e(__('ChatGPT Settings')); ?>

                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-9 setting-menu-div">
            <div id="brand-settings" class="card">
                <?php echo e(Form::model($settings, ['url' => 'systems', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'mb-0'])); ?>

                <div class="card-header p-3">
                    <h5><?php echo e(__('Brand Settings')); ?></h5>
                    <small class="text-muted"><?php echo e(__('Edit your brand details')); ?></small>
                </div>
                <div class="card-body px-3">
                    <div class="row row-gap">
                        <div class="col-md-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header p-3">
                                    <h5><?php echo e(__('Logo Dark')); ?></h5>
                                </div>
                                <div class="card-body p-3 setting-logo-box">
                                    <a href="<?php echo e($logo . 'logo-dark.png'); ?>" target="_blank"
                                        class="logo-content img-fluid  text-center">
                                        <img id="dark-logo" alt="your image"
                                            src="<?php echo e($logo . 'logo-dark.png' . '?' . time()); ?>" width="150px"
                                            class="img_setting">
                                    </a>
                                    <div class="choose-files text-center mt-3">
                                        <label for="logo">
                                            <div class="bg-primary company_logo_update"> <i
                                                    class="ti ti-upload px-1"></i><?php echo e(__('Select image')); ?>

                                            </div>
                                            <input type="file" class="form-control file" name="logo" id="logo"
                                                data-filename="editlogo"
                                                onchange="document.getElementById('dark-logo').src = window.URL.createObjectURL(this.files[0])">
                                        </label>
                                    </div>
                                    <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-logo text-xs text-danger"
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
                                    <a href="<?php echo e($logo . 'logo-light.png'); ?>" target="_blank"
                                        class="logo-content img-fluid dark-logo text-center">
                                        <img id="light-logo" alt="your image"
                                            src="<?php echo e($logo . 'logo-light.png' . '?' . time()); ?>">
                                    </a>
                                    <div class="choose-files text-center mt-3">
                                        <label for="landing_logo">
                                            <div class="bg-primary company_favicon_update">
                                                <i class="ti ti-upload px-1"></i><?php echo e(__('Select image')); ?>

                                            </div>
                                            <input type="file" class="form-control file" name="landing_logo"
                                                id="landing_logo" data-filename="landing_logo_update"
                                                onchange="document.getElementById('light-logo').src = window.URL.createObjectURL(this.files[0])">
                                        </label>
                                    </div>
                                    <?php $__errorArgs = ['landing_logo'];
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
                                    <a href="<?php echo e($logo . (isset($logo) && !empty($logo) ? $logo : 'favicon.png')); ?>"
                                        target="_blank" class="logo-content img-fluid  text-center">
                                        <img id="favicon-logo" alt="your image"
                                            src="<?php echo e($logo . 'favicon.png' . '?' . time()); ?>">
                                    </a>
                                    <div class="choose-files text-center mt-3">
                                        <label for="favicon">
                                            <div class="bg-primary company_favicon_update"> <i
                                                    class="ti ti-upload px-1"></i><?php echo e(__('Select image')); ?>

                                            </div>
                                            <input type="file" class="form-control file" name="favicon"
                                                id="favicon" data-filename="favicon_update"
                                                onchange="document.getElementById('favicon-logo').src = window.URL.createObjectURL(this.files[0])">
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
                        <div class="col-xxl-3 col-sm-6 col-12">
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
                        <div class="col-xxl-3 col-sm-6 col-12">
                            <div class="form-group mb-0">
                                <?php echo e(Form::label('footer_text', __('Footer Text'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('footer_text', null, ['class' => 'form-control', 'placeholder' => __('Footer Text')])); ?>

                                <?php $__errorArgs = ['footer_text'];
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
                        <div class="col-xxl-3 col-sm-6 col-12">
                            <div class="form-group mb-0">
                                <?php echo e(Form::label('default_language', __('Default Language'), ['class' => 'form-label'])); ?>

                                <div class="changeLanguage">
                                    <select name="default_language" id="default_language" class="form-control select2">
                                        <?php $__currentLoopData = App\Models\Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if($lang == $code): ?> selected <?php endif; ?>
                                                value="<?php echo e($code); ?>">
                                                <?php echo e(ucFirst($language)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-sm-6 col-12">
                            <div class="form-group mb-0">
                                <?php echo e(Form::label('Page Settings', __('Landing Page Settings'), ['class' => 'form-label'])); ?>

                                <select name="display_landing_page" class="form-control select2">
                                    <option value="on"
                                        <?php echo e($settings['display_landing_page'] == 'on' ? 'selected="selected"' : ''); ?>>
                                        <?php echo e(__('Enable Landing Page')); ?></option>
                                    <option value="directory_page"
                                        <?php echo e($settings['display_landing_page'] == 'directory_page' ? 'selected="selected"' : ''); ?>>
                                        <?php echo e(__('Enable Business Directory')); ?></option>
                                    <option value="off"
                                        <?php echo e($settings['display_landing_page'] == 'off' ? 'selected="selected"' : ''); ?>>
                                        <?php echo e(__('Disable')); ?></option>

                                </select>
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
                                                <a href="#!"
                                                    class="themes-color-change rounded-circle  <?php echo e($color == 'theme-1' ? 'active_color' : ''); ?>"
                                                    data-value="theme-1"></a>
                                                <input type="radio" class="theme_color d-none" name="color"
                                                    value="theme-1"<?php echo e($color == 'theme-1' ? 'checked' : ''); ?>>
                                                <a href="#!"
                                                    class="themes-color-change rounded-circle  <?php echo e($color == 'theme-2' ? 'active_color' : ''); ?>"
                                                    data-value="theme-2"></a>
                                                <input type="radio" class="theme_color d-none" name="color"
                                                    value="theme-2"<?php echo e($color == 'theme-2' ? 'checked' : ''); ?>>
                                                <a href="#!"
                                                    class="themes-color-change rounded-circle  <?php echo e($color == 'theme-3' ? 'active_color' : ''); ?>"
                                                    data-value="theme-3"></a>
                                                <input type="radio" class="theme_color d-none" name="color"
                                                    value="theme-3"<?php echo e($color == 'theme-3' ? 'checked' : ''); ?>>
                                                <a href="#!"
                                                    class="themes-color-change rounded-circle  <?php echo e($color == 'theme-4' ? 'active_color' : ''); ?>"
                                                    data-value="theme-4"></a>
                                                <input type="radio" class="theme_color d-none" name="color"
                                                    value="theme-4"<?php echo e($color == 'theme-4' ? 'checked' : ''); ?>>
                                                <a href="#!"
                                                    class="themes-color-change rounded-circle  <?php echo e($color == 'theme-5' ? 'active_color' : ''); ?>"
                                                    data-value="theme-5"></a>
                                                <input type="radio" class="theme_color d-none" name="color"
                                                    value="theme-5"<?php echo e($color == 'theme-5' ? 'checked' : ''); ?>>

                                                <a href="#!"
                                                    class="themes-color-change rounded-circle  <?php echo e($color == 'theme-6' ? 'active_color' : ''); ?>"
                                                    data-value="theme-6"></a>
                                                <input type="radio" class="theme_color d-none" name="color"
                                                    value="theme-6"<?php echo e($color == 'theme-6' ? 'checked' : ''); ?>>
                                                <a href="#!"
                                                    class="themes-color-change rounded-circle  <?php echo e($color == 'theme-7' ? 'active_color' : ''); ?>"
                                                    data-value="theme-7"></a>
                                                <input type="radio" class="theme_color d-none" name="color"
                                                    value="theme-7"<?php echo e($color == 'theme-7' ? 'checked' : ''); ?>>
                                                <a href="#!"
                                                    class="themes-color-change rounded-circle  <?php echo e($color == 'theme-8' ? 'active_color' : ''); ?>"
                                                    data-value="theme-8"></a>
                                                <input type="radio" class="theme_color d-none" name="color"
                                                    value="theme-8"<?php echo e($color == 'theme-8' ? 'checked' : ''); ?>>
                                                <a href="#!"
                                                    class="themes-color-change rounded-circle  <?php echo e($color == 'theme-9' ? 'active_color' : ''); ?>"
                                                    data-value="theme-9"></a>
                                                <input type="radio" class="theme_color d-none" name="color"
                                                    value="theme-9"<?php echo e($color == 'theme-9' ? 'checked' : ''); ?>>
                                                <a href="#!"
                                                    class="themes-color-change rounded-circle <?php echo e($color == 'theme-10' ? 'active_color' : ''); ?>"
                                                    data-value="theme-10"></a>
                                                <input type="radio" class="theme_color d-none" name="color"
                                                    value="theme-10"<?php echo e($color == 'theme-10' ? 'checked' : ''); ?>>
                                                <div class="color-picker-wrp">
                                                    <input type="color" value="<?php echo e($color ? $color : ''); ?>"
                                                        class="colorPicker rounded-circle <?php echo e(isset($flag) && $flag == 'true' ? 'active_color' : ''); ?>"
                                                        name="custom_color" id="color-picker">
                                                    <input type='hidden' name="color_flag"
                                                        value=<?php echo e(isset($flag) && $flag == 'true' ? 'true' : 'false'); ?>>
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
                                            <input type="checkbox" class="form-check-input" name="SITE_RTL"
                                                id="SITE_RTL" <?php echo e(env('SITE_RTL') == 'on' ? 'checked="checked"' : ''); ?>>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-4 col-sm-6 col-12">
                                <div class="card h-100 mb-0">
                                    <div class="card-header p-2">
                                        <h6 class="d-flex align-items-center gap-2">
                                            <i class="ti ti-user-plus"></i>
                                            <?php echo e(__('Enable Signup')); ?>

                                        </h6>
                                    </div>
                                    <div class="card-body p-2">
                                        <?php echo e(Form::label('signup_button', __('Enable Sign-Up Page'), ['class' => 'form-check-label f-w-600 mb-2'])); ?>

                                        <div class="form-check form-switch">
                                            <input type="checkbox" name="signup_button" id="signup_button"
                                                class="form-check-input"
                                                <?php echo e(isset($settings['signup_button']) && $settings['signup_button'] == 'on' ? 'checked="checked"' : ''); ?>>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-4 col-sm-6 col-12">
                                <div class="card h-100 mb-0">
                                    <div class="card-header p-2">
                                        <h6 class="d-flex align-items-center gap-2">
                                            <i class="ti ti-mail"></i>
                                            <?php echo e(__('Email Verification')); ?>

                                        </h6>
                                    </div>
                                    <div class="card-body p-2">
                                        <?php echo e(Form::label('email_verification', __('Enable Email Verification'), ['class' => 'form-check-label f-w-600 mb-2'])); ?>

                                        <div class="form-check form-switch">
                                            <input type="checkbox" name="email_verification" id="email_verification"
                                                class="form-check-input"
                                                <?php echo e(isset($settings['email_verification']) && $settings['email_verification'] == 'on' ? 'checked="checked"' : ''); ?>>
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
                                            <input type="checkbox" class="form-check-input" id="cust-theme-bg"
                                                name="cust_theme_bg"
                                                <?php echo e(!empty($settings['cust_theme_bg']) && $settings['cust_theme_bg'] == 'on' ? 'checked' : ''); ?> />
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
                                            <input type="checkbox" class="form-check-input" id="cust-darklayout"
                                                name="cust_darklayout"<?php echo e(!empty($settings['cust_darklayout']) && $settings['cust_darklayout'] == 'on' ? 'checked' : ''); ?> />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer p-3 text-end">
                    <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-print-invoice btn-primary '])); ?>

                </div>
                <?php echo e(Form::close()); ?>

            </div>
            <div id="email-settings" class="card">
                <div class="card-header p-3">
                    <h5><?php echo e(__('Email Settings')); ?></h5>
                    <small
                        class="text-muted"><?php echo e(__('(This SMTP will be used for system-level email sending. Additionally, if a company user does not set their SMTP, then this SMTP will be used for sending emails.)')); ?></small>
                </div>
                <?php echo e(Form::open(['route' => 'email.settings', 'method' => 'post', 'class' => 'mb-0'])); ?>

                <div class="card-body px-3">
                    <div class="row row-gap">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group mb-0">
                                <?php echo e(Form::label('mail_driver', __('Mail Driver'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('mail_driver', $settings['mail_driver'], ['class' => 'form-control', 'placeholder' => __('Enter Mail Driver')])); ?>

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
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group mb-0">
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
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group mb-0">
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
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group mb-0">
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
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group mb-0">
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
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group mb-0">
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
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group mb-0">
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
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group mb-0">
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
                </div>
                <div class="card-footer p-3">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <a href="#" data-url="<?php echo e(route('test.mail')); ?>" data-ajax-popup="true"
                                data-title="<?php echo e(__('Send Test Mail')); ?>" data-title="<?php echo e(__('Send Test Mail')); ?>"
                                data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Send Test Mail')); ?>"
                                data-bs-placement="top" class="send_email btn btn-primary">
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
            <div id="payment-settings" class="card">
                <?php echo e(Form::open(['route' => 'payment.settings', 'method' => 'post'])); ?>

                <div class="card-header p-3">
                    <h5><?php echo e(__('Payment Settings')); ?></h5>
                    <small
                        class="text-muted"><?php echo e(__('These details will be used to collect subscription plan payments.Each subscription plan will have a payment button based on the below configuration.')); ?></small>
                </div>

                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo e(Form::label('currency', __('Currency'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('currency', isset($admin_payment_setting['CURRENCY']) ? $admin_payment_setting['CURRENCY'] : '', ['class' => 'form-control font-style', 'required', 'placeholder' => __('Enter Currency')])); ?>

                                <small> <?php echo e(__('Note: Add currency code as per three-letter ISO code.')); ?><a
                                        href="https://stripe.com/docs/currencies"
                                        target="_blank"><?php echo e(__(' You can find out how to do that here.')); ?></a></small>
                                <br>
                                <?php $__errorArgs = ['currency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-currency" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo e(Form::label('currency_symbol', __('Currency Symbol *'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('currency_symbol', isset($admin_payment_setting['CURRENCY_SYMBOL']) ? $admin_payment_setting['CURRENCY_SYMBOL'] : '', ['class' => 'form-control', 'required', 'placeholder' => __('Enter Currency Symbol')])); ?>


                                <?php $__errorArgs = ['currency_symbol'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-currency_symbol" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                    <div class="faq">
                        <div class="accordion accordion-flush setting-accordion" id="accordionExample">
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFourteen">
                                    <button class="accordion-button gap-2" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFourteen" aria-expanded="true"
                                        aria-controls="collapseFourteen">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('Manually')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_manually_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_manually_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_manually_enabled" id="is_manually_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_manually_enabled']) && $admin_payment_setting['is_manually_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>

                                <div id="collapseFourteen" class="accordion-collapse collapse"
                                    aria-labelledby="headingFourteen" data-bs-parent="#accordionExample">
                                    <div class="row p-3">
                                        <p class="text-muted">
                                            <?php echo e(__('Requesting manual payment for the planned amount for the subscriptions plan.')); ?>

                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFifteen">
                                    <button class="accordion-button gap-2" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFifteen" aria-expanded="true"
                                        aria-controls="collapseFifteen">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('Bank Transfer')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_bank_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_bank_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_bank_enabled" id="is_bank_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_bank_enabled']) && $admin_payment_setting['is_bank_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>

                                <div id="collapseFifteen" class="accordion-collapse collapse"
                                    aria-labelledby="headingFifteen" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row pt-2">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <?php
                                                        $bank_detail = !empty($admin_payment_setting['bank_detail'])
                                                            ? $admin_payment_setting['bank_detail']
                                                            : '';
                                                    ?>
                                                    <?php echo e(Form::label('bank_detail', __('Bank Details'), ['class' => 'form-label'])); ?>

                                                    <textarea name="bank_detail" class="form-control" rows="6" cols="30"><?php echo e($bank_detail); ?></textarea>
                                                    <?php if($errors->has('bank_detail')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('bank_detail')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                    <small
                                                        class="text-muted"><?php echo e(__('Example:Bank:bank name</br>Account Number:0000 0000</br>')); ?></small>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button gap-2" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('Stripe')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_stripe_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_stripe_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_stripe_enabled" id="is_stripe_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_stripe_enabled']) && $admin_payment_setting['is_stripe_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>

                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row pt-1">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('stripe_key', __('Stripe Key'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::text('stripe_key', isset($admin_payment_setting['stripe_key']) ? $admin_payment_setting['stripe_key'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Stripe Key')])); ?><br>
                                                    <?php if($errors->has('stripe_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('stripe_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('stripe_secret', __('Stripe Secret'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::text('stripe_secret', isset($admin_payment_setting['stripe_secret']) ? $admin_payment_setting['stripe_secret'] : '', ['class' => 'form-control ', 'placeholder' => __('Enter Stripe Secret')])); ?>

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
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button gap-2 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('PayPal')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_paypal_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_paypal_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_paypal_enabled" id="is_paypal_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_paypal_enabled']) && $admin_payment_setting['is_paypal_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row pt-1">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-4">
                                                <div class="row">
                                                    <label class="pb-2"
                                                        for="paypal_mode"><?php echo e(__('Paypal Mode')); ?></label>
                                                    <div class="col-lg-3">
                                                        <div class="border card p-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label text-dark" for="">
                                                                    <input type="radio"
                                                                        class="form-check-input input-primary"
                                                                        name="paypal_mode" value="sandbox"
                                                                        <?php echo e((isset($admin_payment_setting['paypal_mode']) && $admin_payment_setting['paypal_mode'] == '') || (isset($admin_payment_setting['paypal_mode']) && $admin_payment_setting['paypal_mode'] == 'sandbox') ? 'checked="checked"' : ''); ?>>
                                                                    <?php echo e(__('Sandbox')); ?>

                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="border card p-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label d-block" for="">
                                                                    <input type="radio"
                                                                        class="form-check-input input-primary"
                                                                        name="paypal_mode" value="live"
                                                                        <?php echo e(isset($admin_payment_setting['paypal_mode']) && $admin_payment_setting['paypal_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                    <?php echo e(__('Live')); ?>

                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="paypal_client_id"
                                                        class="form-label"><?php echo e(__('Client ID')); ?></label>
                                                    <input type="text" name="paypal_client_id" id="paypal_client_id"
                                                        class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['paypal_client_id']) ? $admin_payment_setting['paypal_client_id'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Client ID')); ?>" />
                                                    <?php if($errors->has('paypal_client_id')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('paypal_client_id')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="paypal_secret_key"
                                                        class="form-label"><?php echo e(__('Secret Key')); ?></label>
                                                    <input type="text" name="paypal_secret_key" id="paypal_secret_key"
                                                        class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['paypal_secret_key']) ? $admin_payment_setting['paypal_secret_key'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Secret Key')); ?>" /><br>
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
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button gap-2 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        <span class="d-flex align-items-center">

                                            <?php echo e(__('Paystack')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_paystack_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_paystack_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_paystack_enabled" id="is_paystack_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_paystack_enabled']) && $admin_payment_setting['is_paystack_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row pt-1">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paypal_client_id"
                                                        class="form-label"><?php echo e(__('Public Key')); ?></label>
                                                    <input type="text" name="paystack_public_key"
                                                        id="paystack_public_key" class="form-control form-control-label"
                                                        value="<?php echo e(isset($admin_payment_setting['paystack_public_key']) ? $admin_payment_setting['paystack_public_key'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Public Key')); ?>" />
                                                    <?php if($errors->has('paystack_public_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('paystack_public_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paystack_secret_key"
                                                        class="form-label"><?php echo e(__('Secret Key')); ?></label>
                                                    <input type="text" name="paystack_secret_key"
                                                        id="paystack_secret_key" class="form-control form-control-label"
                                                        value="<?php echo e(isset($admin_payment_setting['paystack_secret_key']) ? $admin_payment_setting['paystack_secret_key'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Secret Key')); ?>" /><br>
                                                    <?php if($errors->has('paystack_secret_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('paystack_secret_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button gap-2 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false"
                                        aria-controls="collapseFour">
                                        <span class="d-flex align-items-center">

                                            <?php echo e(__('Flutterwave')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_flutterwave_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_flutterwave_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_flutterwave_enabled" id="is_flutterwave_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_flutterwave_enabled']) && $admin_payment_setting['is_flutterwave_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row pt-1">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paypal_client_id"
                                                        class="form-label"><?php echo e(__('Public Key')); ?></label>
                                                    <input type="text" name="flutterwave_public_key"
                                                        id="flutterwave_public_key" class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['flutterwave_public_key']) ? $admin_payment_setting['flutterwave_public_key'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Public Key')); ?>" />
                                                    <?php if($errors->has('flutterwave_public_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('flutterwave_public_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paystack_secret_key"
                                                        class="form-label"><?php echo e(__('Secret Key')); ?></label>
                                                    <input type="text" name="flutterwave_secret_key"
                                                        id="flutterwave_secret_key" class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['flutterwave_secret_key']) ? $admin_payment_setting['flutterwave_secret_key'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Secret Key')); ?>" /><br>
                                                    <?php if($errors->has('flutterwave_secret_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('flutterwave_secret_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFive">
                                    <button class="accordion-button gap-2 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false"
                                        aria-controls="collapseFive">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('Razorpay')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_razorpay_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_razorpay_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_razorpay_enabled" id="is_razorpay_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_razorpay_enabled']) && $admin_payment_setting['is_razorpay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row pt-1">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paypal_client_id"
                                                        class="form-label"><?php echo e(__('Public Key')); ?></label>

                                                    <input type="text" name="razorpay_public_key"
                                                        id="razorpay_public_key" class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['razorpay_public_key']) ? $admin_payment_setting['razorpay_public_key'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Public Key')); ?>" />
                                                    <?php if($errors->has('razorpay_public_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('razorpay_public_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paystack_secret_key"
                                                        class="form-label"><?php echo e(__('Secret Key')); ?></label>
                                                    <input type="text" name="razorpay_secret_key"
                                                        id="razorpay_secret_key" class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['razorpay_secret_key']) ? $admin_payment_setting['razorpay_secret_key'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Secret Key')); ?>" /><br>
                                                    <?php if($errors->has('razorpay_secret_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('razorpay_secret_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSix">
                                    <button class="accordion-button gap-2 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false"
                                        aria-controls="collapseSix">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('Mercado Pago')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_mercado_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_mercado_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_mercado_enabled" id="is_mercado_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_mercado_enabled']) && $admin_payment_setting['is_mercado_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row pt-2">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-4">
                                                <div class="row pt-1">
                                                    <label class="pb-2"
                                                        for="paypal_mode"><?php echo e(__('Mercado Mode')); ?></label>
                                                    <div class="col-lg-3">
                                                        <div class="border card p-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label d-block" for="">
                                                                    <input type="radio" name="mercado_mode"
                                                                        class="form-check-input input-primary"
                                                                        value="sandbox"
                                                                        <?php echo e((isset($admin_payment_setting['mercado_mode']) && $admin_payment_setting['mercado_mode'] == '') || (isset($admin_payment_setting['mercado_mode']) && $admin_payment_setting['mercado_mode'] == 'sandbox') ? 'checked="checked"' : ''); ?>>
                                                                    <label class="form-check-label d-block"
                                                                        for="">
                                                                        <?php echo e(__('Sandbox')); ?>

                                                                    </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="border card p-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label d-block" for="">
                                                                    <input type="radio"
                                                                        class="form-check-input input-primary"
                                                                        name="mercado_mode" value="live"
                                                                        <?php echo e(isset($admin_payment_setting['mercado_mode']) && $admin_payment_setting['mercado_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="form-check-label d-block"
                                                                        for="">
                                                                        <?php echo e(__('Live')); ?>

                                                                    </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mercado_access_token"
                                                        class="form-label"><?php echo e(__('Access Token')); ?></label>
                                                    <input type="text" name="mercado_access_token" id="mercado_app_id"
                                                        class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['mercado_access_token']) ? $admin_payment_setting['mercado_access_token'] : ''); ?>"
                                                        placeholder="<?php echo e(__('App ID')); ?>" /><br>
                                                    <?php if($errors->has('mercado_access_token')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('mercado_access_token')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSeven">
                                    <button class="accordion-button gap-2 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false"
                                        aria-controls="collapseSeven">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('Paytm')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_paytm_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_paytm_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_paytm_enabled" id="is_paytm_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_paytm_enabled']) && $admin_payment_setting['is_paytm_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseSeven" class="accordion-collapse collapse"
                                    aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row pt-1">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-4">
                                                <div class="row pt-2">
                                                    <label class="pb-2"
                                                        for="paypal_mode"><?php echo e(__('Paytm Environment')); ?></label>
                                                    <div class="col-lg-3">
                                                        <div class="border card p-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label d-block" for="">
                                                                    <input type="radio" name="paytm_mode"
                                                                        class="form-check-input input-primary"
                                                                        value="local"
                                                                        <?php echo e((isset($admin_payment_setting['paytm_mode']) && $admin_payment_setting['paytm_mode'] == '') || (isset($admin_payment_setting['paytm_mode']) && $admin_payment_setting['paytm_mode'] == 'local') ? 'checked="checked"' : ''); ?>>
                                                                    <?php echo e(__('Local')); ?>

                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="border card p-3">
                                                            <div class="form-check">

                                                                <label class="form-check-label d-block" for="">
                                                                    <input type="radio" name="paytm_mode"
                                                                        class="form-check-input input-primary"
                                                                        value="production"
                                                                        <?php echo e(isset($admin_payment_setting['paytm_mode']) && $admin_payment_setting['paytm_mode'] == 'production' ? 'checked="checked"' : ''); ?>>
                                                                    <?php echo e(__('Production')); ?>

                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="paytm_public_key"
                                                        class="form-label"><?php echo e(__('Merchant ID')); ?></label>
                                                    <input type="text" name="paytm_merchant_id" id="paytm_merchant_id"
                                                        class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['paytm_merchant_id']) ? $admin_payment_setting['paytm_merchant_id'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Merchant ID')); ?>" />
                                                    <?php if($errors->has('paytm_merchant_id')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('paytm_merchant_id')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="paytm_secret_key"
                                                        class="form-label"><?php echo e(__('Merchant Key')); ?></label>
                                                    <input type="text" name="paytm_merchant_key"
                                                        id="paytm_merchant_key" class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['paytm_merchant_key']) ? $admin_payment_setting['paytm_merchant_key'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Merchant Key')); ?>" />
                                                    <?php if($errors->has('paytm_merchant_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('paytm_merchant_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="paytm_industry_type" class="form-label">
                                                        <?php echo e(__('Industry Type')); ?></label>
                                                    <input type="text" name="paytm_industry_type"
                                                        id="paytm_industry_type" class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['paytm_industry_type']) ? $admin_payment_setting['paytm_industry_type'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Industry Type')); ?>" /><br>
                                                    <?php if($errors->has('paytm_industry_type')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('paytm_industry_type')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingEight">
                                    <button class="accordion-button gap-2 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false"
                                        aria-controls="collapseEight">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('Mollie')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_mollie_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_mollie_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_mollie_enabled" id="is_mollie_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_mollie_enabled']) && $admin_payment_setting['is_mollie_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseEight" class="accordion-collapse collapse"
                                    aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row pt-1">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mollie_api_key"
                                                        class="form-label"><?php echo e(__('Mollie Api Key')); ?></label>
                                                    <input type="text" name="mollie_api_key" id="mollie_api_key"
                                                        class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['mollie_api_key']) ? $admin_payment_setting['mollie_api_key'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Mollie Api Key')); ?>" />
                                                    <?php if($errors->has('mollie_api_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('mollie_api_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mollie_profile_id"
                                                        class="form-label"><?php echo e(__('Mollie Profile Id')); ?></label>
                                                    <input type="text" name="mollie_profile_id" id="mollie_profile_id"
                                                        class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['mollie_profile_id']) ? $admin_payment_setting['mollie_profile_id'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Mollie Profile Id')); ?>" />
                                                    <?php if($errors->has('mollie_profile_id')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('mollie_profile_id')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mollie_partner_id"
                                                        class="form-label"><?php echo e(__('Mollie Partner Id')); ?></label>
                                                    <input type="text" name="mollie_partner_id" id="mollie_partner_id"
                                                        class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['mollie_partner_id']) ? $admin_payment_setting['mollie_partner_id'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Mollie Partner Id')); ?>" /><br>
                                                    <?php if($errors->has('mollie_partner_id')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('mollie_partner_id')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingNine">
                                    <button class="accordion-button gap-2 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false"
                                        aria-controls="collapseNine">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('Skrill')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_skrill_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_skrill_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_skrill_enabled" id="is_skrill_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_skrill_enabled']) && $admin_payment_setting['is_skrill_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row pt-1">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mollie_api_key"
                                                        class="form-label"><?php echo e(__('Skrill Email')); ?></label>
                                                    <input type="email" name="skrill_email" id="skrill_email"
                                                        class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['skrill_email']) ? $admin_payment_setting['skrill_email'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Skrill Email')); ?>" /><br>
                                                    <?php if($errors->has('skrill_email')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('skrill_email')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTen">
                                    <button class="accordion-button gap-2 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false"
                                        aria-controls="collapseTen">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('CoinGate')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_coingate_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_coingate_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_coingate_enabled" id="is_coingate_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_coingate_enabled']) && $admin_payment_setting['is_coingate_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row pt-1">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-4">
                                                <div class="row pt-2">
                                                    <label class="pb-2"
                                                        for="paypal_mode"><?php echo e(__('CoinGate Mode')); ?></label>
                                                    <div class="col-lg-3">
                                                        <div class="border card p-3">
                                                            <div class="form-check">

                                                                <label class="form-check-label d-block" for="">
                                                                    <input type="radio" name="coingate_mode"
                                                                        class="form-check-input input-primary"
                                                                        value="sandbox"
                                                                        <?php echo e((isset($admin_payment_setting['coingate_mode']) && $admin_payment_setting['coingate_mode'] == '') || (isset($admin_payment_setting['coingate_mode']) && $admin_payment_setting['coingate_mode'] == 'sandbox') ? 'checked="checked"' : ''); ?>>
                                                                    <?php echo e(__('Sandbox')); ?>

                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="border card p-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label d-block" for="">
                                                                    <input type="radio"
                                                                        class="form-check-input input-primary"
                                                                        name="coingate_mode" value="live"
                                                                        <?php echo e(isset($admin_payment_setting['coingate_mode']) && $admin_payment_setting['coingate_mode'] == 'live' ? 'checked="checked"' : ''); ?>><?php echo e(__('Live')); ?>

                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="coingate_auth_token"
                                                        class="form-label"><?php echo e(__('CoinGate Auth Token')); ?></label>
                                                    <input type="text" name="coingate_auth_token"
                                                        id="coingate_auth_token" class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['coingate_auth_token']) ? $admin_payment_setting['coingate_auth_token'] : ''); ?>"
                                                        placeholder="<?php echo e(__('CoinGate Auth Token')); ?>" /><br>
                                                    <?php if($errors->has('coingate_auth_token')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('coingate_auth_token')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingEleven">
                                    <button class="accordion-button gap-2 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseEleven" aria-expanded="false"
                                        aria-controls="collapseEleven">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('PaymentWall')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_paymentwall_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_paymentwall_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_paymentwall_enabled" id="is_paymentwall_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_paymentwall_enabled']) && $admin_payment_setting['is_paymentwall_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseEleven" class="accordion-collapse collapse"
                                    aria-labelledby="headingEleven" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row pt-1">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paymentwall_public_key"
                                                        class="form-label"><?php echo e(__('Public Key')); ?></label>
                                                    <input type="text" name="paymentwall_public_key"
                                                        id="paymentwall_public_key" class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['paymentwall_public_key']) ? $admin_payment_setting['paymentwall_public_key'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Public Key')); ?>" />
                                                    <?php if($errors->has('paymentwall_public_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('paymentwall_public_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paymentwall_private_key"
                                                        class="form-label"><?php echo e(__('Private Key')); ?></label>
                                                    <input type="text" name="paymentwall_private_key"
                                                        id="paymentwall_private_key"
                                                        class="form-control form-control-label"
                                                        value="<?php echo e(isset($admin_payment_setting['paymentwall_private_key']) ? $admin_payment_setting['paymentwall_private_key'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Private Key')); ?>" /><br>
                                                    <?php if($errors->has('paymentwall_private_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('paymentwall_private_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingtwelve">
                                    <button class="accordion-button gap-2 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTwelve"
                                        aria-expanded="false" aria-controls="collapseTwelve">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('Toyyibpay')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_toyyibpay_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_toyyibpay_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_toyyibpay_enabled" id="is_toyyibpay_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_toyyibpay_enabled']) && $admin_payment_setting['is_toyyibpay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseTwelve" class="accordion-collapse collapse"
                                    aria-labelledby="headingtwelve" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row pt-2">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="toyyibpay_secret_key"
                                                        class="form-label"><?php echo e(__('Secret Key')); ?></label>
                                                    <input type="text" name="toyyibpay_secret_key"
                                                        id="toyyibpay_secret_key" class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['toyyibpay_secret_key']) ? $admin_payment_setting['toyyibpay_secret_key'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Secret Key')); ?>" />
                                                    <?php if($errors->has('toyyibpay_secret_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('toyyibpay_secret_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="toyyibpay_category_code"
                                                        class="form-label"><?php echo e(__('Category Code')); ?></label>
                                                    <input type="text" name="toyyibpay_category_code"
                                                        id="toyyibpay_category_code"
                                                        class="form-control form-control-label"
                                                        value="<?php echo e(isset($admin_payment_setting['toyyibpay_category_code']) ? $admin_payment_setting['toyyibpay_category_code'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Category Code')); ?>" /><br>
                                                    <?php if($errors->has('toyyibpay_category_code')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('toyyibpay_category_code')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThirteen">
                                    <button class="accordion-button gap-2 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThirteen"
                                        aria-expanded="false" aria-controls="collapseThirteen">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('Payfast')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_payfast_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_payfast_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_payfast_enabled" id="is_payfast_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_payfast_enabled']) && $admin_payment_setting['is_payfast_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseThirteen" class="accordion-collapse collapse"
                                    aria-labelledby="headingThirteen" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="row pt-2">
                                                <label class="pb-2"
                                                    for="payfast_mode"><?php echo e(__('Payfast Mode')); ?></label>
                                                <div class="col-lg-3">
                                                    <div class="border card p-3">
                                                        <div class="form-check">
                                                            <label class="form-check-label d-block" for="">
                                                                <input type="radio"
                                                                    class="form-check-input input-primary"
                                                                    name="payfast_mode" value="sandbox"
                                                                    <?php echo e((isset($admin_payment_setting['payfast_mode']) && $admin_payment_setting['payfast_mode'] == '') || (isset($admin_payment_setting['payfast_mode']) && $admin_payment_setting['payfast_mode'] == 'sandbox') ? 'checked="checked"' : ''); ?>>
                                                                <?php echo e(__('Sandbox')); ?>

                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="border card p-3">
                                                        <div class="form-check">
                                                            <label class="form-check-label d-block" for="">
                                                                <input type="radio"
                                                                    class="form-check-input input-primary"
                                                                    name="payfast_mode" value="live"
                                                                    <?php echo e(isset($admin_payment_setting['payfast_mode']) && $admin_payment_setting['payfast_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                <?php echo e(__('Live')); ?>

                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row pt-2">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="payfast_merchant_id"
                                                        class="form-label"><?php echo e(__('Merchant Id')); ?></label>
                                                    <input type="text" name="payfast_merchant_id"
                                                        id="payfast_merchant_id" class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['payfast_merchant_id']) ? $admin_payment_setting['payfast_merchant_id'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Merchant Id')); ?>" />
                                                    <?php if($errors->has('payfast_merchant_id')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('payfast_merchant_id')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="payfast_merchant_key"
                                                        class="form-label"><?php echo e(__('Merchant Key')); ?></label>
                                                    <input type="text" name="payfast_merchant_key"
                                                        id="payfast_merchant_key"
                                                        class="form-control form-control-label"
                                                        value="<?php echo e(isset($admin_payment_setting['payfast_merchant_key']) ? $admin_payment_setting['payfast_merchant_key'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Merchant Key')); ?>" /><br>
                                                    <?php if($errors->has('payfast_merchant_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('payfast_merchant_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="payfast_signature"
                                                        class="form-label"><?php echo e(__('Salt Passphrase')); ?></label>
                                                    <input type="text" name="payfast_signature"
                                                        id="payfast_signature" class="form-control form-control-label"
                                                        value="<?php echo e(isset($admin_payment_setting['payfast_signature']) ? $admin_payment_setting['payfast_signature'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Salt Passphrase')); ?>" /><br>
                                                    <?php if($errors->has('payfast_signature')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('payfast_signature')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingsixteen">
                                    <button class="accordion-button gap-2 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapsesixteen"
                                        aria-expanded="false" aria-controls="collapsesixteen">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('Iyzipay')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_iyzipay_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_iyzipay_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_iyzipay_enabled" id="is_iyzipay_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_iyzipay_enabled']) && $admin_payment_setting['is_iyzipay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapsesixteen" class="accordion-collapse collapse"
                                    aria-labelledby="headingsixteen" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="row pt-2">
                                                <label class="pb-2"
                                                    for="iyzipay_mode"><?php echo e(__('Iyzipay Mode')); ?></label>
                                                <div class="col-lg-3">
                                                    <div class="border card p-3">
                                                        <div class="form-check">
                                                            <label class="form-check-label d-block" for="">
                                                                <input type="radio"
                                                                    class="form-check-input input-primary"
                                                                    name="iyzipay_mode" value="sandbox"
                                                                    <?php echo e((isset($admin_payment_setting['iyzipay_mode']) && $admin_payment_setting['iyzipay_mode'] == '') || (isset($admin_payment_setting['iyzipay_mode']) && $admin_payment_setting['iyzipay_mode'] == 'sandbox') ? 'checked="checked"' : ''); ?>>
                                                                <?php echo e(__('Sandbox')); ?>

                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="border card p-3">
                                                        <div class="form-check">
                                                            <label class="form-check-label d-block" for="">
                                                                <input type="radio"
                                                                    class="form-check-input input-primary"
                                                                    name="iyzipay_mode" value="live"
                                                                    <?php echo e(isset($admin_payment_setting['iyzipay_mode']) && $admin_payment_setting['iyzipay_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                <?php echo e(__('Live')); ?>

                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row pt-2">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="iyzipay_key"
                                                        class="form-label"><?php echo e(__('Iyzipay Key')); ?></label>
                                                    <input type="text" name="iyzipay_key" id="iyzipay_key"
                                                        class="form-control form-control-label"
                                                        value="<?php echo e(isset($admin_payment_setting['iyzipay_key']) ? $admin_payment_setting['iyzipay_key'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Iyzipay Key')); ?>" /><br>
                                                    <?php if($errors->has('iyzipay_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('iyzipay_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="iyzipay_secret"
                                                        class="form-label"><?php echo e(__('Iyzipay Secret')); ?></label>
                                                    <input type="text" name="iyzipay_secret" id="iyzipay_secret"
                                                        class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['iyzipay_secret']) ? $admin_payment_setting['iyzipay_secret'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Iyzipay Secret')); ?>" />
                                                    <?php if($errors->has('iyzipay_secret')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('iyzipay_secret')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingseventeen">
                                    <button class="accordion-button gap-2 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseseventeen"
                                        aria-expanded="false" aria-controls="collapseseventeen">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('SSpay')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_sspay_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_sspay_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_sspay_enabled" id="is_sspay_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_sspay_enabled']) && $admin_payment_setting['is_sspay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseseventeen" class="accordion-collapse collapse"
                                    aria-labelledby="headingseventeen" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row pt-2">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="sspay_secret_key"
                                                        class="form-label"><?php echo e(__('Secret Key')); ?></label>
                                                    <input type="text" name="sspay_secret_key"
                                                        id="sspay_secret_key" class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['sspay_secret_key']) ? $admin_payment_setting['sspay_secret_key'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Secret Key')); ?>" />
                                                    <?php if($errors->has('sspay_secret_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('sspay_secret_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="sspay_category_code"
                                                        class="form-label"><?php echo e(__('Category Code')); ?></label>
                                                    <input type="text" name="sspay_category_code"
                                                        id="sspay_category_code" class="form-control form-control-label"
                                                        value="<?php echo e(isset($admin_payment_setting['sspay_category_code']) ? $admin_payment_setting['sspay_category_code'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Category Code')); ?>" /><br>
                                                    <?php if($errors->has('sspay_category_code')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('sspay_category_code')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingeightteen">
                                    <button class="accordion-button gap-2 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseeightteen"
                                        aria-expanded="false" aria-controls="collapseeightteen">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('Paytab')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_paytab_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_paytab_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_paytab_enabled" id="is_paytab_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_paytab_enabled']) && $admin_payment_setting['is_paytab_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseeightteen" class="accordion-collapse collapse"
                                    aria-labelledby="headingeightteen" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row pt-2">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paytab_profile_id"
                                                        class="form-label"><?php echo e(__('Profile Id')); ?></label>
                                                    <input type="text" name="paytab_profile_id"
                                                        id="paytab_profile_id" class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['paytab_profile_id']) ? $admin_payment_setting['paytab_profile_id'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Profile Id')); ?>" />
                                                    <?php if($errors->has('paytab_profile_id')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('paytab_profile_id')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paytab_server_key"
                                                        class="form-label"><?php echo e(__('Server Key')); ?></label>
                                                    <input type="text" name="paytab_server_key"
                                                        id="paytab_server_key" class="form-control form-control-label"
                                                        value="<?php echo e(isset($admin_payment_setting['paytab_server_key']) ? $admin_payment_setting['paytab_server_key'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Server Key')); ?>" /><br>
                                                    <?php if($errors->has('paytab_server_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('paytab_server_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paytab_region"
                                                        class="form-label"><?php echo e(__('Region')); ?></label>
                                                    <input type="text" name="paytab_region" id="paytab_region"
                                                        class="form-control form-control-label"
                                                        value="<?php echo e(isset($admin_payment_setting['paytab_region']) ? $admin_payment_setting['paytab_region'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Region')); ?>" /><br>
                                                    <?php if($errors->has('paytab_region')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('paytab_region')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingNineteen">
                                    <button class="accordion-button gap-2 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseNineteen"
                                        aria-expanded="false" aria-controls="collapseNineteen">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('Benefit')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_benefit_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_benefit_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_benefit_enabled" id="is_benefit_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_benefit_enabled']) && $admin_payment_setting['is_benefit_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseNineteen" class="accordion-collapse collapse"
                                    aria-labelledby="headingNineteen" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-4">
                                                <div class="row pt-2">
                                                    <label class="pb-2"
                                                        for="benefit_mode"><?php echo e(__('Benefit Mode')); ?></label>
                                                    <div class="col-lg-3">
                                                        <div class="border card p-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label d-block" for="">
                                                                    <input type="radio"
                                                                        class="form-check-input input-primary"
                                                                        name="benefit_mode" value="sandbox"
                                                                        <?php echo e((isset($admin_payment_setting['benefit_mode']) && $admin_payment_setting['benefit_mode'] == '') || (isset($admin_payment_setting['benefit_mode']) && $admin_payment_setting['benefit_mode'] == 'sandbox') ? 'checked="checked"' : ''); ?>>
                                                                    <?php echo e(__('Sandbox')); ?>

                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="border card p-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label d-block" for="">
                                                                    <input type="radio"
                                                                        class="form-check-input input-primary"
                                                                        name="benefit_mode" value="live"
                                                                        <?php echo e(isset($admin_payment_setting['benefit_mode']) && $admin_payment_setting['benefit_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                    <?php echo e(__('Live')); ?>

                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="benefit_secret_key"
                                                        class="form-label"><?php echo e(__('Secret Key')); ?></label>
                                                    <input type="text" name="benefit_secret_key"
                                                        id="benefit_secret_key" class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['benefit_secret_key']) ? $admin_payment_setting['benefit_secret_key'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Secret Key')); ?>" />
                                                    <?php if($errors->has('benefit_secret_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('benefit_secret_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="benefit_publishable_key"
                                                        class="form-label"><?php echo e(__('Publishable Key')); ?></label>
                                                    <input type="text" name="benefit_publishable_key"
                                                        id="benefit_publishable_key" class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['benefit_publishable_key']) ? $admin_payment_setting['benefit_publishable_key'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Publishable Key')); ?>" /><br>
                                                    <?php if($errors->has('benefit_publishable_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('benefit_publishable_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwenty">
                                    <button class="accordion-button gap-2" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwenty" aria-expanded="true"
                                        aria-controls="collapseTwenty">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('Cashfree')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_cashfree_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_cashfree_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_cashfree_enabled" id="is_cashfree_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_cashfree_enabled']) && $admin_payment_setting['is_cashfree_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseTwenty" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwenty" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row pt-2">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('cashfree_key', __('Cashfree Key'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::text('cashfree_key', isset($admin_payment_setting['cashfree_key']) ? $admin_payment_setting['cashfree_key'] : '', ['class' => 'form-control', 'placeholder' => __('Cashfree Key')])); ?><br>
                                                    <?php if($errors->has('cashfree_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('cashfree_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('cashfree_secret', __('Cashfree Secret'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::text('cashfree_secret', isset($admin_payment_setting['cashfree_secret']) ? $admin_payment_setting['cashfree_secret'] : '', ['class' => 'form-control ', 'placeholder' => __('Cashfree Secret')])); ?>

                                                    <?php if($errors->has('cashfree_secret')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('cashfree_secret')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwenty-One">
                                    <button class="accordion-button gap-2" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwenty-One" aria-expanded="true"
                                        aria-controls="collapseTwenty-One">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('Aamarpay')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_aamarpay_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_aamarpay_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_aamarpay_enabled" id="is_aamarpay_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_aamarpay_enabled']) && $admin_payment_setting['is_aamarpay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseTwenty-One" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwenty-One" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row pt-2">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('aamarpay_store_id', __('Store Id'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::text('aamarpay_store_id', isset($admin_payment_setting['aamarpay_store_id']) ? $admin_payment_setting['aamarpay_store_id'] : '', ['class' => 'form-control', 'placeholder' => __('Store Id')])); ?><br>
                                                    <?php if($errors->has('aamarpay_store_id')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('aamarpay_store_id')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('aamarpay_signature_key', __('Signature Key'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::text('aamarpay_signature_key', isset($admin_payment_setting['aamarpay_signature_key']) ? $admin_payment_setting['aamarpay_signature_key'] : '', ['class' => 'form-control', 'placeholder' => __('Signature Key')])); ?><br>
                                                    <?php if($errors->has('aamarpay_signature_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('aamarpay_signature_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('aamarpay_description', __('Description'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::text('aamarpay_description', isset($admin_payment_setting['aamarpay_description']) ? $admin_payment_setting['aamarpay_description'] : '', ['class' => 'form-control', 'placeholder' => __('Description')])); ?><br>
                                                    <?php if($errors->has('aamarpay_description')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('aamarpay_description')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwentytwo">
                                    <button class="accordion-button gap-2" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwentytwo" aria-expanded="true"
                                        aria-controls="collapseTwentytwo">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('Pay TR')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_paytr_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_paytr_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_paytr_enabled" id="is_paytr_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_paytr_enabled']) && $admin_payment_setting['is_paytr_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseTwentytwo" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwentyfour" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row pt-2">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('paytr_merchant_id', __('Merchant Id'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::text('paytr_merchant_id', isset($admin_payment_setting['paytr_merchant_id']) ? $admin_payment_setting['paytr_merchant_id'] : '', ['class' => 'form-control', 'placeholder' => __('Merchant Id')])); ?><br>
                                                    <?php if($errors->has('paytr_merchant_id')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('paytr_merchant_id')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('paytr_merchant_key', __('Merchant Key'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::text('paytr_merchant_key', isset($admin_payment_setting['paytr_merchant_key']) ? $admin_payment_setting['paytr_merchant_key'] : '', ['class' => 'form-control', 'placeholder' => __('Merchant Key')])); ?><br>
                                                    <?php if($errors->has('paytr_merchant_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('paytr_merchant_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('paytr_merchant_salt', __('Merchant Salt'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::text('paytr_merchant_salt', isset($admin_payment_setting['paytr_merchant_salt']) ? $admin_payment_setting['paytr_merchant_salt'] : '', ['class' => 'form-control', 'placeholder' => __('Merchant Salt')])); ?><br>
                                                    <?php if($errors->has('paytr_merchant_salt')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('paytr_merchant_salt')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwentythree">
                                    <button class="accordion-button gap-2" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwentythree" aria-expanded="true"
                                        aria-controls="collapseTwentythree">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('Midtrans')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_midtrans_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_midtrans_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_midtrans_enabled" id="is_midtrans_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_midtrans_enabled']) && $admin_payment_setting['is_midtrans_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseTwentythree" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwentyfour" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row pt-2">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-4">
                                                <div class="row pt-2">
                                                    <label class="pb-2"
                                                        for="midtrans_mode"><?php echo e(__('Midtrans Mode')); ?></label>
                                                    <div class="col-lg-3">
                                                        <div class="border card p-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label d-block" for="">
                                                                    <input type="radio"
                                                                        class="form-check-input input-primary"
                                                                        name="midtrans_mode" value="sandbox"
                                                                        <?php echo e((isset($admin_payment_setting['midtrans_mode']) && $admin_payment_setting['midtrans_mode'] == '') || (isset($admin_payment_setting['midtrans_mode']) && $admin_payment_setting['midtrans_mode'] == 'sandbox') ? 'checked="checked"' : ''); ?>>
                                                                    <?php echo e(__('Sandbox')); ?>

                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="border card p-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label d-block" for="">
                                                                    <input type="radio"
                                                                        class="form-check-input input-primary"
                                                                        name="midtrans_mode" value="live"
                                                                        <?php echo e(isset($admin_payment_setting['midtrans_mode']) && $admin_payment_setting['midtrans_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                    <?php echo e(__('Live')); ?>

                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('secret_key', __('Secret Key'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::text('midtrans_secret_key', isset($admin_payment_setting['midtrans_secret_key']) ? $admin_payment_setting['midtrans_secret_key'] : '', ['class' => 'form-control', 'placeholder' => __('Secret Key')])); ?><br>
                                                    <?php if($errors->has('midtrans_secret_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('midtrans_secret_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwentyfour">
                                    <button class="accordion-button gap-2" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwentyfour" aria-expanded="true"
                                        aria-controls="collapseTwentyfour">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('Xendit')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_xendit_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_xendit_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_xendit_enabled" id="is_xendit_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_xendit_enabled']) && $admin_payment_setting['is_xendit_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseTwentyfour" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwentyfour" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row pt-2">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('Api Key', __('API Key'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::text('xendit_api_key', isset($admin_payment_setting['xendit_api_key']) ? $admin_payment_setting['xendit_api_key'] : '', ['class' => 'form-control', 'placeholder' => __('Secret Key')])); ?><br>
                                                    <?php if($errors->has('xendit_api_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('xendit_api_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('xendit_token', __('Xendit Token'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::text('xendit_token', isset($admin_payment_setting['xendit_token']) ? $admin_payment_setting['xendit_token'] : '', ['class' => 'form-control', 'placeholder' => __('Token')])); ?><br>
                                                    <?php if($errors->has('xendit_token')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('xendit_token')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwentyfive">
                                    <button class="accordion-button gap-2" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwentyfive" aria-expanded="true"
                                        aria-controls="collapseTwentyfive">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('YooKassa')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_yookassa_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_yookassa_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_yookassa_enabled" id="is_yookassa_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_yookassa_enabled']) && $admin_payment_setting['is_yookassa_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseTwentyfive" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwentyfive" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row pt-2">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('shop_id', __('YooKassa Shop Id'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::text('yookassa_shop_id', isset($admin_payment_setting['yookassa_shop_id']) ? $admin_payment_setting['yookassa_shop_id'] : '', ['class' => 'form-control', 'placeholder' => __('Shop Id')])); ?><br>
                                                    <?php if($errors->has('yookassa_shop_id')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('yookassa_shop_id')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('yookassa_secret_key', __('YooKassa Secret Key'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::text('yookassa_secret_key', isset($admin_payment_setting['yookassa_secret_key']) ? $admin_payment_setting['yookassa_secret_key'] : '', ['class' => 'form-control', 'placeholder' => __('YooKassa Secret Key')])); ?><br>
                                                    <?php if($errors->has('yookassa_secret_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('yookassa_secret_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwentySix">
                                    <button class="accordion-button gap-2 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTwentySix"
                                        aria-expanded="false" aria-controls="collapseTwentySix">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('Nepalste')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_nepalste_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_nepalste_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_nepalste_enabled" id="is_nepalste_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_nepalste_enabled']) && $admin_payment_setting['is_nepalste_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseTwentySix" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwentySix" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-4">
                                                <div class="row pt-2">
                                                    <label class="pb-2"
                                                        for="nepalste_mode"><?php echo e(__('Nepalste Mode')); ?></label>
                                                    <div class="col-lg-3">
                                                        <div class="border card p-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label d-block" for="">
                                                                    <input type="radio"
                                                                        class="form-check-input input-primary"
                                                                        name="nepalste_mode" value="sandbox"
                                                                        <?php echo e((isset($admin_payment_setting['nepalste_mode']) && $admin_payment_setting['nepalste_mode'] == '') || (isset($admin_payment_setting['nepalste_mode']) && $admin_payment_setting['nepalste_mode'] == 'sandbox') ? 'checked="checked"' : ''); ?>>
                                                                    <?php echo e(__('Sandbox')); ?>

                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="border card p-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label d-block" for="">
                                                                    <input type="radio"
                                                                        class="form-check-input input-primary"
                                                                        name="nepalste_mode" value="live"
                                                                        <?php echo e(isset($admin_payment_setting['nepalste_mode']) && $admin_payment_setting['nepalste_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                    <?php echo e(__('Live')); ?>

                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="nepalste_public_key"
                                                        class="form-label"><?php echo e(__('Public Key')); ?></label>
                                                    <input type="text" name="nepalste_public_key"
                                                        id="nepalste_public_key" class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['nepalste_public_key']) ? $admin_payment_setting['nepalste_public_key'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Public Key')); ?>" /><br>
                                                    <?php if($errors->has('nepalste_public_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('nepalste_public_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="nepalste_secret_key"
                                                        class="form-label"><?php echo e(__('Secret Key')); ?></label>
                                                    <input type="text" name="nepalste_secret_key"
                                                        id="nepalste_secret_key" class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['nepalste_secret_key']) ? $admin_payment_setting['nepalste_secret_key'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Secret Key')); ?>" />
                                                    <?php if($errors->has('nepalste_secret_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('nepalste_secret_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwentySeven">
                                    <button class="accordion-button gap-2 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTwentySeven"
                                        aria-expanded="false" aria-controls="collapseTwentySeven">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('Paiement Pro')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_paiement_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_paiement_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_paiement_enabled" id="is_paiement_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_paiement_enabled']) && $admin_payment_setting['is_paiement_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseTwentySeven" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwentySeven" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paiement_merchant_id"
                                                        class="form-label"><?php echo e(__('Merchant ID')); ?></label>
                                                    <input type="text" name="paiement_merchant_id"
                                                        id="paiement_merchant_id" class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['paiement_merchant_id']) ? $admin_payment_setting['paiement_merchant_id'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Merchant ID')); ?>" />
                                                    <?php if($errors->has('paiement_merchant_id')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('paiement_merchant_id')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwentyEight">
                                    <button class="accordion-button gap-2 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTwentyEight"
                                        aria-expanded="false" aria-controls="collapseTwentyEight">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('CinetPay')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_cinetpay_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_cinetpay_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_cinetpay_enabled" id="is_cinetpay_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_cinetpay_enabled']) && $admin_payment_setting['is_cinetpay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseTwentyEight" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwentyEight" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row pt-2">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cinetpay_site_id"
                                                        class="form-label"><?php echo e(__('Site Id')); ?></label>
                                                    <input type="text" name="cinetpay_site_id"
                                                        id="cinetpay_site_id" class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['cinetpay_site_id']) ? $admin_payment_setting['cinetpay_site_id'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Site Id')); ?>" />
                                                    <?php if($errors->has('cinetpay_site_id')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('cinetpay_site_id')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cinetpay_api_key"
                                                        class="form-label"><?php echo e(__('API KEY')); ?></label>
                                                    <input type="text" name="cinetpay_api_key"
                                                        id="cinetpay_api_key" class="form-control form-control-label"
                                                        value="<?php echo e(isset($admin_payment_setting['cinetpay_api_key']) ? $admin_payment_setting['cinetpay_api_key'] : ''); ?>"
                                                        placeholder="<?php echo e(__('API KEY')); ?>" /><br>
                                                    <?php if($errors->has('cinetpay_api_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('cinetpay_api_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cinetpay_secret_key"
                                                        class="form-label"><?php echo e(__('SECRET KEY')); ?></label>
                                                    <input type="text" name="cinetpay_secret_key"
                                                        id="cinetpay_secret_key" class="form-control form-control-label"
                                                        value="<?php echo e(isset($admin_payment_setting['cinetpay_secret_key']) ? $admin_payment_setting['cinetpay_secret_key'] : ''); ?>"
                                                        placeholder="<?php echo e(__('SECRET KEY')); ?>" /><br>
                                                    <?php if($errors->has('cinetpay_secret_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('cinetpay_secret_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwentyNine">
                                    <button class="accordion-button gap-2 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTwentyNine"
                                        aria-expanded="false" aria-controls="collapseTwentyNine">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('PayHere')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_payhere_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_payhere_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_payhere_enabled" id="is_payhere_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_payhere_enabled']) && $admin_payment_setting['is_payhere_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseTwentyNine" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwentyNine" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-4">
                                                <div class="row pt-2">
                                                    <label class="pb-2"
                                                        for="payhere_mode"><?php echo e(__('PayHere Mode')); ?></label>
                                                    <div class="col-lg-3">
                                                        <div class="border card p-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label d-block" for="">
                                                                    <input type="radio"
                                                                        class="form-check-input input-primary"
                                                                        name="payhere_mode" value="sandbox"
                                                                        <?php echo e((isset($admin_payment_setting['payhere_mode']) && $admin_payment_setting['payhere_mode'] == '') || (isset($admin_payment_setting['payhere_mode']) && $admin_payment_setting['payhere_mode'] == 'sandbox') ? 'checked="checked"' : ''); ?>>
                                                                    <?php echo e(__('Sandbox')); ?>

                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="border card p-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label d-block" for="">
                                                                    <input
                                                                        type="radio"class="form-check-input input-primary"
                                                                        name="payhere_mode" value="live"
                                                                        <?php echo e(isset($admin_payment_setting['payhere_mode']) && $admin_payment_setting['payhere_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                    <?php echo e(__('Live')); ?>

                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="payhere_merchant_id"
                                                        class="form-label"><?php echo e(__('Merchant ID')); ?></label>
                                                    <input type="text" name="payhere_merchant_id"
                                                        id="payhere_merchant_id" class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['payhere_merchant_id']) ? $admin_payment_setting['payhere_merchant_id'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Merchant ID')); ?>" />
                                                    <?php if($errors->has('payhere_merchant_id')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('payhere_merchant_id')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="payhere_merchant_secret"
                                                        class="form-label"><?php echo e(__('Merchant Secret')); ?></label>
                                                    <input type="text" name="payhere_merchant_secret"
                                                        id="payhere_merchant_secret" class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['payhere_merchant_secret']) ? $admin_payment_setting['payhere_merchant_secret'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Merchant Secret')); ?>" />
                                                    <?php if($errors->has('payhere_merchant_secret')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('payhere_merchant_secret')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="payhere_app_id"
                                                        class="form-label"><?php echo e(__('App ID')); ?></label>
                                                    <input type="text" name="payhere_app_id" id="payhere_app_id"
                                                        class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['payhere_app_id']) ? $admin_payment_setting['payhere_app_id'] : ''); ?>"
                                                        placeholder="<?php echo e(__('App ID')); ?>" /><br>
                                                    <?php if($errors->has('payhere_app_id')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('payhere_app_id')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="payhere_app_secret"
                                                        class="form-label"><?php echo e(__('App Secret')); ?></label>
                                                    <input type="text" name="payhere_app_secret"
                                                        id="payhere_app_secret" class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['payhere_app_secret']) ? $admin_payment_setting['payhere_app_secret'] : ''); ?>"
                                                        placeholder="<?php echo e(__('App Secret')); ?>" /><br>
                                                    <?php if($errors->has('payhere_app_secret')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('payhere_app_secret')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThirty">
                                    <button class="accordion-button gap-2 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThirty"
                                        aria-expanded="false" aria-controls="collapseThirty">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('Fedapay')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_fedapay_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_fedapay_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_fedapay_enabled" id="is_fedapay_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_fedapay_enabled']) && $admin_payment_setting['is_fedapay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseThirty" class="accordion-collapse collapse"
                                    aria-labelledby="headingNineteen" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-4">
                                                <div class="row pt-2">
                                                    <label class="pb-2"
                                                        for="fedapay_mode"><?php echo e(__('Fedapay Mode')); ?></label>
                                                    <div class="col-lg-3">
                                                        <div class="border card p-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label d-block" for="">
                                                                    <input type="radio"
                                                                        class="form-check-input input-primary"
                                                                        name="fedapay_mode" value="sandbox"
                                                                        <?php echo e((isset($admin_payment_setting['fedapay_mode']) && $admin_payment_setting['fedapay_mode'] == '') || (isset($admin_payment_setting['fedapay_mode']) && $admin_payment_setting['fedapay_mode'] == 'sandbox') ? 'checked="checked"' : ''); ?>>
                                                                    <?php echo e(__('Sandbox')); ?>

                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="border card p-3">
                                                            <div class="form-check">
                                                                <label class="form-check-label d-block" for="">
                                                                    <input type="radio"
                                                                        class="form-check-input input-primary"
                                                                        name="fedapay_mode" value="live"
                                                                        <?php echo e(isset($admin_payment_setting['fedapay_mode']) && $admin_payment_setting['fedapay_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                    <?php echo e(__('Live')); ?>

                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="fedapay_public_key"
                                                        class="form-label"><?php echo e(__('Public Key')); ?></label>
                                                    <input type="text" name="fedapay_public_key"
                                                        id="fedapay_public_key" class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['fedapay_public_key']) ? $admin_payment_setting['fedapay_public_key'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Public Key')); ?>" /><br>
                                                    <?php if($errors->has('fedapay_public_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('fedapay_public_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="fedapay_secret_key"
                                                        class="form-label"><?php echo e(__('Secret Key')); ?></label>
                                                    <input type="text" name="fedapay_secret_key"
                                                        id="fedapay_secret_key" class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['fedapay_secret_key']) ? $admin_payment_setting['fedapay_secret_key'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Secret Key')); ?>" />
                                                    <?php if($errors->has('fedapay_secret_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('fedapay_secret_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThirtyOne">
                                    <button class="accordion-button gap-2 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThirtyOne"
                                        aria-expanded="false" aria-controls="collapseThirtyOne">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('Tap')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_tap_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_tap_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_tap_enabled" id="is_tap_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_tap_enabled']) && $admin_payment_setting['is_tap_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseThirtyOne" class="accordion-collapse collapse"
                                    aria-labelledby="headingThirtyOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="tap_secret_key"
                                                        class="form-label"><?php echo e(__('Secret Key')); ?></label>
                                                    <input type="text" name="tap_secret_key" id="tap_secret_key"
                                                        class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['tap_secret_key']) ? $admin_payment_setting['tap_secret_key'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Secret Key')); ?>" />
                                                    <?php if($errors->has('tap_secret_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('tap_secret_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThirtyTwo">
                                    <button class="accordion-button gap-2 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThirtyTwo"
                                        aria-expanded="false" aria-controls="collapseThirtyTwo">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('AuthorizeNet')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_authorizenet_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_authorizenet_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_authorizenet_enabled" id="is_authorizenet_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_authorizenet_enabled']) && $admin_payment_setting['is_authorizenet_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseThirtyTwo" class="accordion-collapse collapse"
                                    aria-labelledby="headingThirtyTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-4">
                                                <div class="row pt-2">
                                                    <label class="pb-2"
                                                        for="paypal_mode"><?php echo e(__('AuthorizeNet Mode')); ?></label>
                                                    <div class="col-lg-3">
                                                        <div class="border card p-3">
                                                            <div class="form-check">

                                                                <label class="form-check-label d-block" for="">
                                                                    <input type="radio" name="authorizenet_mode"
                                                                        class="form-check-input input-primary"
                                                                        value="local"
                                                                        <?php echo e((isset($admin_payment_setting['authorizenet_mode']) && $admin_payment_setting['authorizenet_mode'] == '') || (isset($admin_payment_setting['authorizenet_mode']) && $admin_payment_setting['authorizenet_mode'] == 'local') ? 'checked="checked"' : ''); ?>>
                                                                    <?php echo e(__('Local')); ?>

                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="border card p-3">
                                                            <div class="form-check">

                                                                <label class="form-check-label d-block" for="">
                                                                    <input type="radio" name="authorizenet_mode"
                                                                        class="form-check-input input-primary"
                                                                        value="production"
                                                                        <?php echo e(isset($admin_payment_setting['authorizenet_mode']) && $admin_payment_setting['authorizenet_mode'] == 'production' ? 'checked="checked"' : ''); ?>>
                                                                    <?php echo e(__('Production')); ?>

                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="paytm_public_key"
                                                        class="form-label"><?php echo e(__('Merchant Login Id')); ?></label>
                                                    <input type="text" name="authorizenet_client_id"
                                                        id="authorizenet_client_id" class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['authorizenet_client_id']) ? $admin_payment_setting['authorizenet_client_id'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Merchant Login Id')); ?>" />
                                                    <?php if($errors->has('authorizenet_client_id')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('authorizenet_client_id')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="paytm_secret_key"
                                                        class="form-label"><?php echo e(__('Merchant Transaction Key')); ?></label>
                                                    <input type="text" name="authorizenet_merchant_key"
                                                        id="authorizenet_merchant_key" class="form-control"
                                                        value="<?php echo e(isset($admin_payment_setting['authorizenet_merchant_key']) ? $admin_payment_setting['authorizenet_merchant_key'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Merchant Transaction Key')); ?>" />
                                                    <?php if($errors->has('authorizenet_merchant_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('authorizenet_merchant_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThirtyThree">
                                    <button class="accordion-button gap-2 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThirtyThree"
                                        aria-expanded="false" aria-controls="collapseThirtyThree">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('Khalti')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_khalti_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_khalti_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_khalti_enabled" id="is_khalti_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_khalti_enabled']) && $admin_payment_setting['is_khalti_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseThirtyThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThirtyThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="khalti_public_key"
                                                        class="form-label"><?php echo e(__('Public Key')); ?></label>
                                                    <input type="text" name="khalti_public_key"
                                                        id="khalti_public_key" class="form-control form-control-label"
                                                        value="<?php echo e(isset($admin_payment_setting['khalti_public_key']) ? $admin_payment_setting['khalti_public_key'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Public Key')); ?>" />
                                                    <?php if($errors->has('khalti_public_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('khalti_public_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="khalti_secret_key"
                                                        class="form-label"><?php echo e(__('Secret Key')); ?></label>
                                                    <input type="text" name="khalti_secret_key"
                                                        id="khalti_secret_key" class="form-control form-control-label"
                                                        value="<?php echo e(isset($admin_payment_setting['khalti_secret_key']) ? $admin_payment_setting['khalti_secret_key'] : ''); ?>"
                                                        placeholder="<?php echo e(__('Secret Key')); ?>" /><br>
                                                    <?php if($errors->has('khalti_secret_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('khalti_secret_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThirtyFour">
                                    <button class="accordion-button gap-2" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThirtyFour" aria-expanded="true"
                                        aria-controls="collapseThirtyFour">
                                        <span class="d-flex align-items-center" for="easebuzz-payment">
                                            <?php echo e(__('Easebuzz')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="is_easybuzz_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="is_easybuzz_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="is_easybuzz_enabled" id="is_easybuzz_enabled"
                                                    <?php echo e(isset($admin_payment_setting['is_easybuzz_enabled']) && $admin_payment_setting['is_easybuzz_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseThirtyFour" class="accordion-collapse collapse"
                                    aria-labelledby="headingThirtyFour" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row pt-2">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('easebuzz_merchant_key', __('Merchant Key'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::text('easebuzz_merchant_key', isset($admin_payment_setting['easebuzz_merchant_key']) ? $admin_payment_setting['easebuzz_merchant_key'] : '', ['class' => 'form-control', 'placeholder' => __('Merchant Key')])); ?><br>
                                                    <?php if($errors->has('easebuzz_merchant_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('easebuzz_merchant_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('easebuzz_salt_key', __('Salt Key'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::text('easebuzz_salt_key', isset($admin_payment_setting['easebuzz_salt_key']) ? $admin_payment_setting['easebuzz_salt_key'] : '', ['class' => 'form-control', 'placeholder' => __('Salt Key')])); ?><br>
                                                    <?php if($errors->has('easebuzz_salt_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                            <?php echo e($errors->first('easebuzz_salt_key')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="easebuzz_enviroment_name"
                                                        class="col-form-label"><?php echo e(__('Easebuzz Enviroment Name')); ?></label>
                                                    <input class="form-control" placeholder="Easebuzz Enviroment Name"
                                                        name="easebuzz_enviroment_name" type="text"
                                                        value="<?php echo e($admin_payment_setting['easebuzz_enviroment_name'] ?? ''); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="ozow-payment">
                                    <button class="accordion-button gap-2" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#ozow-payment-settings" aria-expanded="true"
                                        aria-controls="ozow-payment-settings">
                                        <span class="d-flex align-items-center" for="ozow-payment">
                                            <?php echo e(__('Ozow')); ?>

                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="form-check-label"
                                                for="ozow_payment_is_enabled"><?php echo e(__('Enable')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1">
                                                <input type="hidden" name="ozow_payment_is_enabled" value="off">
                                                <input type="checkbox" class="form-check-input input-primary"
                                                    name="ozow_payment_is_enabled" id="ozow_payment_is_enabled"
                                                    <?php echo e(isset($admin_payment_setting['ozow_payment_is_enabled']) && $admin_payment_setting['ozow_payment_is_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="ozow-payment-settings" class="accordion-collapse collapse"
                                    aria-labelledby="headingThirty" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="ozow_payment_mode"
                                                    class="col-form-label"><?php echo e(__('Ozow Mode')); ?></label>
                                                <div class="d-flex">
                                                    <div class="me-2">
                                                        <div class="border card p-3">
                                                            <div class="form-check">
                                                                <label
                                                                    class="form-check-labe text-dark <?php echo e(isset($admin_payment_setting['ozow_payment_mode']) && $admin_payment_setting['ozow_payment_mode'] == 'sandbox' ? 'active' : ''); ?>">
                                                                    <input type="radio" name="ozow_payment_mode"
                                                                        value="sandbox" class="form-check-input"
                                                                        <?php echo e((isset($admin_payment_setting['ozow_payment_mode']) && $admin_payment_setting['ozow_payment_mode'] == '') || (isset($admin_payment_setting['ozow_payment_mode']) && $admin_payment_setting['ozow_payment_mode'] == 'sandbox') ? 'checked="checked"' : ''); ?>><?php echo e(__('Sandbox')); ?>

                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="me-2">
                                                        <div class="border card p-3">
                                                            <div class="form-check">
                                                                <label
                                                                    class="form-check-labe text-dark <?php echo e(isset($admin_payment_setting['ozow_payment_mode']) && $admin_payment_setting['ozow_payment_mode'] == 'live' ? 'active' : ''); ?>">
                                                                    <input type="radio" name="ozow_payment_mode"
                                                                        value="live" class="form-check-input"
                                                                        <?php echo e(isset($admin_payment_setting['ozow_payment_mode']) && $admin_payment_setting['ozow_payment_mode'] == 'live' ? 'checked="checked"' : ''); ?>><?php echo e(__('Live')); ?>

                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="ozow_site_key"
                                                        class="form-label"><?php echo e(__('Ozow Site Key')); ?></label>
                                                    <input type="text" name="ozow_site_key" id="ozow_site_key"
                                                        class="form-control"
                                                        value="<?php echo e(!isset($admin_payment_setting['ozow_site_key']) || is_null($admin_payment_setting['ozow_site_key']) ? '' : $admin_payment_setting['ozow_site_key']); ?>"
                                                        placeholder="<?php echo e(__('Ozow Site Key')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="ozow_private_key"
                                                        class="form-label"><?php echo e(__('Ozow Private Key')); ?></label>
                                                    <input type="text" name="ozow_private_key"
                                                        id="ozow_private_key" class="form-control"
                                                        value="<?php echo e(!isset($admin_payment_setting['ozow_private_key']) || is_null($admin_payment_setting['ozow_private_key']) ? '' : $admin_payment_setting['ozow_private_key']); ?>"
                                                        placeholder="<?php echo e(__('Ozow Private Key')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="ozow_api_key"
                                                        class="form-label"><?php echo e(__('Ozow Api Key')); ?></label>
                                                    <input type="text" name="ozow_api_key" id="ozow_api_key"
                                                        class="form-control"
                                                        value="<?php echo e(!isset($admin_payment_setting['ozow_api_key']) || is_null($admin_payment_setting['ozow_api_key']) ? '' : $admin_payment_setting['ozow_api_key']); ?>"
                                                        placeholder="<?php echo e(__('Ozow Api Key')); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="card-footer p-3 text-end">
                    <div class="">
                        <div class="form-group  float-end ">
                            <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-print-invoice  btn-primary '])); ?>

                        </div>
                    </div>
                </div>
                <?php echo e(Form::close()); ?>

            </div>
            <div id="recaptcha-settings" class="card">
                <form method="POST" action="<?php echo e(route('recaptcha.settings.store')); ?>" accept-charset="UTF-8"
                    class="mb-0">
                    <?php echo csrf_field(); ?>
                    <div class="card-header p-3 d-flex align-items-center justify-content-between gap-2">
                        <div>
                            <h5><?php echo e(__('ReCaptcha Settings')); ?></h5>
                            <small class="text-muted"><a
                                    href="https://phppot.com/php/how-to-get-google-recaptcha-site-and-secret-key/"
                                    target="_blank" class="text-danger">
                                    (<?php echo e(__('How to Get Google reCaptcha Site and Secret key')); ?>)
                                </a>
                            </small><br>
                        </div>
                        <div class="form-check form-switch custom-switch-v1">
                            <input type="checkbox" name="recaptcha_module" value="yes" id="recaptcha_module"
                                class="form-check-input input-primary"
                                <?php echo e($setting['RECAPTCHA_MODULE'] == 'yes' ? 'checked="checked"' : ''); ?>>
                        </div>
                    </div>

                    <div class="card-body px-3">
                        <div class="row row-gap">
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group switch-width mb-0">
                                    <label for="google_recaptcha_version"
                                        class="form-label"><?php echo e(__('Google Recaptcha Version')); ?></label>
                                    <select id="google_recaptcha_version" class="form-control choices"
                                        searchenabled="true" name="google_recaptcha_version">
                                        <option value="v2"
                                            <?php echo e($setting['RECAPTCHA_VERSION'] == 'v2' ? 'selected' : ''); ?>>
                                            <?php echo e(__('v2')); ?></option>
                                        <option value="v3"
                                            <?php echo e($setting['RECAPTCHA_VERSION'] == 'v3' ? 'selected' : ''); ?>>
                                            <?php echo e(__('v3')); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label for="google_recaptcha_key"
                                    class="form-label"><?php echo e(__('Google Recaptcha Key')); ?></label>
                                <input class="form-control" placeholder="<?php echo e(__('Enter Google Recaptcha Key')); ?>"
                                    name="google_recaptcha_key" type="text"
                                    value="<?php echo e($setting['NOCAPTCHA_SITEKEY']); ?>" id="google_recaptcha_key">
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label for="google_recaptcha_secret"
                                    class="form-label"><?php echo e(__('Google Recaptcha Secret')); ?></label>
                                <input class="form-control " placeholder="<?php echo e(__('Enter Google Recaptcha Secret')); ?>"
                                    name="google_recaptcha_secret" type="text"
                                    value="<?php echo e($setting['NOCAPTCHA_SECRET']); ?>" id="google_recaptcha_secret">
                            </div>
                        </div>
                    </div>

                    <div class="card-footer p-3 text-end">
                        <div class="">
                            <div class="form-group  float-end">
                                <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-print-invoice  btn-primary'])); ?>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div id="storage-settings" class="card">
                <?php echo e(Form::open(['route' => 'storage.setting.store', 'enctype' => 'multipart/form-data', 'class' => 'mb-0'])); ?>

                <div class="card-header p-3">
                    <h5><?php echo e(__('Storage Settings')); ?></h5>
                </div>
                <div class="card-body px-3">
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <div class="pe-2">
                            <input type="radio" class="btn-check" name="storage_setting" id="local-outlined"
                                autocomplete="off" <?php echo e($setting['storage_setting'] == 'local' ? 'checked' : ''); ?>

                                value="local" checked>
                            <label class="btn btn-outline-primary btn-sm"
                                for="local-outlined"><?php echo e(__('Local')); ?></label>
                        </div>
                        <div class="pe-2">
                            <input type="radio" class="btn-check" name="storage_setting" id="s3-outlined"
                                autocomplete="off" <?php echo e($setting['storage_setting'] == 's3' ? 'checked' : ''); ?>

                                value="s3">
                            <label class="btn btn-outline-primary btn-sm" for="s3-outlined">
                                <?php echo e(__('AWS S3')); ?></label>
                        </div>

                        <div class="pe-2">
                            <input type="radio" class="btn-check" name="storage_setting" id="wasabi-outlined"
                                autocomplete="off" <?php echo e($setting['storage_setting'] == 'wasabi' ? 'checked' : ''); ?>

                                value="wasabi">
                            <label class="btn btn-outline-primary btn-sm"
                                for="wasabi-outlined"><?php echo e(__('Wasabi')); ?></label>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div
                            class="local-setting row row-gap <?php echo e($setting['storage_setting'] == 'local' ? ' ' : 'd-none'); ?>">
                            <div class="col-md-8 col-12">
                                <div class="form-group mb-0">
                                    <?php echo e(Form::label('local_storage_validation', __('Only Upload Files'), ['class' => ' form-label'])); ?>

                                    <select name="local_storage_validation[]" class="form-control"
                                        name="choices-multiple-remove-button" id="choices-multiple-remove-button"
                                        placeholder="This is a placeholder" multiple>
                                        <?php $__currentLoopData = $file_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if(in_array($f, $local_storage_validations)): ?> selected <?php endif; ?>>
                                                <?php echo e($f); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group mb-0">
                                    <label class="form-label"
                                        for="local_storage_max_upload_size"><?php echo e(__('Max upload size ( In KB)')); ?></label>
                                    <input type="number" name="local_storage_max_upload_size" class="form-control"
                                        value="<?php echo e(!isset($setting['local_storage_max_upload_size']) || is_null($setting['local_storage_max_upload_size']) ? '' : $setting['local_storage_max_upload_size']); ?>"
                                        placeholder="<?php echo e(__('Max upload size')); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="s3-setting row <?php echo e($setting['storage_setting'] == 's3' ? ' ' : 'd-none'); ?>">

                            <div class=" row ">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="s3_key"><?php echo e(__('S3 Key')); ?></label>
                                        <input type="text" name="s3_key" class="form-control"
                                            value="<?php echo e(!isset($setting['s3_key']) || is_null($setting['s3_key']) ? '' : $setting['s3_key']); ?>"
                                            placeholder="<?php echo e(__('S3 Key')); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="s3_secret"><?php echo e(__('S3 Secret')); ?></label>
                                        <input type="text" name="s3_secret" class="form-control"
                                            value="<?php echo e(!isset($setting['s3_secret']) || is_null($setting['s3_secret']) ? '' : $setting['s3_secret']); ?>"
                                            placeholder="<?php echo e(__('S3 Secret')); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="s3_region"><?php echo e(__('S3 Region')); ?></label>
                                        <input type="text" name="s3_region" class="form-control"
                                            value="<?php echo e(!isset($setting['s3_region']) || is_null($setting['s3_region']) ? '' : $setting['s3_region']); ?>"
                                            placeholder="<?php echo e(__('S3 Region')); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="s3_bucket"><?php echo e(__('S3 Bucket')); ?></label>
                                        <input type="text" name="s3_bucket" class="form-control"
                                            value="<?php echo e(!isset($setting['s3_bucket']) || is_null($setting['s3_bucket']) ? '' : $setting['s3_bucket']); ?>"
                                            placeholder="<?php echo e(__('S3 Bucket')); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="s3_url"><?php echo e(__('S3 URL')); ?></label>
                                        <input type="text" name="s3_url" class="form-control"
                                            value="<?php echo e(!isset($setting['s3_url']) || is_null($setting['s3_url']) ? '' : $setting['s3_url']); ?>"
                                            placeholder="<?php echo e(__('S3 URL')); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="s3_endpoint"><?php echo e(__('S3 Endpoint')); ?></label>
                                        <input type="text" name="s3_endpoint" class="form-control"
                                            value="<?php echo e(!isset($setting['s3_endpoint']) || is_null($setting['s3_endpoint']) ? '' : $setting['s3_endpoint']); ?>"
                                            placeholder="<?php echo e(__('S3 Endpoint')); ?>">
                                    </div>
                                </div>
                                <div class="form-group col-8 switch-width">
                                    <?php echo e(Form::label('s3_storage_validation', __('Only Upload Files'), ['class' => ' form-label'])); ?>

                                    <select name="s3_storage_validation[]" class="form-control"
                                        name="choices-multiple-remove-button" id="choices-multiple-remove-button1"
                                        placeholder="This is a placeholder" multiple>
                                        <?php $__currentLoopData = $file_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if(in_array($f, $s3_storage_validations)): ?> selected <?php endif; ?>>
                                                <?php echo e($f); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-label"
                                            for="s3_max_upload_size"><?php echo e(__('Max upload size ( In KB)')); ?></label>
                                        <input type="number" name="s3_max_upload_size" class="form-control"
                                            value="<?php echo e(!isset($setting['s3_max_upload_size']) || is_null($setting['s3_max_upload_size']) ? '' : $setting['s3_max_upload_size']); ?>"
                                            placeholder="<?php echo e(__('Max upload size')); ?>">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="wasabi-setting row <?php echo e($setting['storage_setting'] == 'wasabi' ? ' ' : 'd-none'); ?>">
                            <div class=" row ">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="s3_key"><?php echo e(__('Wasabi Key')); ?></label>
                                        <input type="text" name="wasabi_key" class="form-control"
                                            value="<?php echo e(!isset($setting['wasabi_key']) || is_null($setting['wasabi_key']) ? '' : $setting['wasabi_key']); ?>"
                                            placeholder="<?php echo e(__('Wasabi Key')); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="s3_secret"><?php echo e(__('Wasabi Secret')); ?></label>
                                        <input type="text" name="wasabi_secret" class="form-control"
                                            value="<?php echo e(!isset($setting['wasabi_secret']) || is_null($setting['wasabi_secret']) ? '' : $setting['wasabi_secret']); ?>"
                                            placeholder="<?php echo e(__('Wasabi Secret')); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="s3_region"><?php echo e(__('Wasabi Region')); ?></label>
                                        <input type="text" name="wasabi_region" class="form-control"
                                            value="<?php echo e(!isset($setting['wasabi_region']) || is_null($setting['wasabi_region']) ? '' : $setting['wasabi_region']); ?>"
                                            placeholder="<?php echo e(__('Wasabi Region')); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label"
                                            for="wasabi_bucket"><?php echo e(__('Wasabi Bucket')); ?></label>
                                        <input type="text" name="wasabi_bucket" class="form-control"
                                            value="<?php echo e(!isset($setting['wasabi_bucket']) || is_null($setting['wasabi_bucket']) ? '' : $setting['wasabi_bucket']); ?>"
                                            placeholder="<?php echo e(__('Wasabi Bucket')); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="wasabi_url"><?php echo e(__('Wasabi URL')); ?></label>
                                        <input type="text" name="wasabi_url" class="form-control"
                                            value="<?php echo e(!isset($setting['wasabi_url']) || is_null($setting['wasabi_url']) ? '' : $setting['wasabi_url']); ?>"
                                            placeholder="<?php echo e(__('Wasabi URL')); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="wasabi_root"><?php echo e(__('Wasabi Root')); ?></label>
                                        <input type="text" name="wasabi_root" class="form-control"
                                            value="<?php echo e(!isset($setting['wasabi_root']) || is_null($setting['wasabi_root']) ? '' : $setting['wasabi_root']); ?>"
                                            placeholder="<?php echo e(__('Wasabi Root')); ?>">
                                    </div>
                                </div>
                                <div class="form-group col-8 switch-width">
                                    <?php echo e(Form::label('wasabi_storage_validation', __('Only Upload Files'), ['class' => 'form-label'])); ?>


                                    <select name="wasabi_storage_validation[]" class="form-control"
                                        name="choices-multiple-remove-button" id="choices-multiple-remove-button2"
                                        placeholder="This is a placeholder" multiple>
                                        <?php $__currentLoopData = $file_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if(in_array($f, $wasabi_storage_validations)): ?> selected <?php endif; ?>>
                                                <?php echo e($f); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-label"
                                            for="wasabi_root"><?php echo e(__('Max upload size ( In KB)')); ?></label>
                                        <input type="number" name="wasabi_max_upload_size" class="form-control"
                                            value="<?php echo e(!isset($setting['wasabi_max_upload_size']) || is_null($setting['wasabi_max_upload_size']) ? '' : $setting['wasabi_max_upload_size']); ?>"
                                            placeholder="<?php echo e(__('Max upload size')); ?>">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div><br>
                </div>

                <div class="card-footer p-3 text-end">
                    <input class="btn btn-print-invoice  btn-primary" type="submit"
                        value="<?php echo e(__('Save Changes')); ?>">

                </div>
                <?php echo e(Form::close()); ?>

            </div>
            <div id="cache-settings" class="card">
                <form method="POST" action="<?php echo e(route('cache.settings.clear')); ?>" accept-charset="UTF-8"
                    class="mb-0">
                    <?php echo csrf_field(); ?>
                    <div class="card-header p-3">
                        <h5><?php echo e(__('Cache Settings')); ?></h5>
                        <small class="text-muted"><a
                                href="https://phppot.com/php/how-to-get-google-recaptcha-site-and-secret-key/"
                                target="_blank" class="text-muted">
                                <?php echo e(__("This is a page meant for more advanced users, simply ignore it if you don't understand what cache is.")); ?>

                            </a>
                        </small><br>
                    </div>
                    <div class="card-body p-3">
                        <label for="current_cache_size" class="form-label"><?php echo e(__('Current cache size')); ?></label>
                        <div class="input-group search-form">
                            <input type="text" value="<?php echo e($file_size); ?>" class="form-control" disabled>
                            <span class="input-group-text bg-transparent"><?php echo e(__('MB')); ?></span>
                        </div>
                    </div>
                    <div class="card-footer p-3 text-end">
                        <div class="">
                            <div class="form-group float-end">
                                <?php echo e(Form::submit(__('Clear Cache'), ['class' => 'btn btn-print-invoice  btn-primary'])); ?>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
            <div id="cookie-settings" class="card">
                <?php echo e(Form::model($settings, ['route' => 'cookie.setting', 'method' => 'post', 'class' => 'mb-0'])); ?>

                <div class="card-header p-3 d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <h5><?php echo e(__('Cookie Settings')); ?></h5>
                    <div class="form-check form-switch custom-switch-v1" onclick="enablecookie()">
                        <input type="checkbox" name="enable_cookie" class="form-check-input input-primary "
                            id="enable_cookie" <?php echo e($settings['enable_cookie'] == 'on' ? ' checked ' : ''); ?>>
                    </div>
                </div>
                <div
                    class="card-body px-3 cookieDiv  <?php echo e($settings['enable_cookie'] == 'off' ? 'disabledCookie ' : ''); ?>">
                    <?php if(isset($chatgpt_setting['chatgpt_key']) && !empty($chatgpt_setting['chatgpt_key'])): ?>
                        <div class="d-flex justify-content-md-end mb-3 <?php echo e($settings['enable_cookie'] == 'off' ? 'disabledCookie ' : ''); ?>"
                            data-bs-placement="top">
                            <a href="javascript:void(0)" data-size="lg" class="btn btn-sm btn-primary"
                                data-ajax-popup-over="true" data-url="<?php echo e(route('generate', ['cookie'])); ?>"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Generate')); ?>"
                                data-title="<?php echo e(__('Generate content with AI')); ?>">
                                <i class="fas fa-robot"></i>&nbsp;<?php echo e(__('Generate with AI')); ?>

                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="row row-gap">
                        <div class="col-sm-6">
                            <div class="form-check form-switch custom-switch-v1" id="cookie_log">
                                <input type="checkbox" name="cookie_logging"
                                    class="form-check-input input-primary cookie_setting"
                                    id="cookie_logging"<?php echo e($settings['cookie_logging'] == 'on' ? ' checked ' : ''); ?>>
                                <label class="form-check-label"
                                    for="cookie_logging"><?php echo e(__('Enable logging')); ?></label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-check form-switch custom-switch-v1 ">
                                <input type="checkbox" name="necessary_cookies" class="form-check-input input-primary"
                                    id="necessary_cookies" checked onclick="return false">
                                <label class="form-check-label"
                                    for="necessary_cookies"><?php echo e(__('Strictly necessary cookies')); ?></label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-0">
                                <?php echo e(Form::label('cookie_title', __('Cookie Title'), ['class' => 'col-form-label'])); ?>

                                <?php echo e(Form::text('cookie_title', null, ['class' => 'form-control cookie_setting', 'placeholder' => __('Enter Cookie Title')])); ?>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-0">
                                <?php echo e(Form::label('strictly_cookie_title', __(' Strictly Cookie Title'), ['class' => 'col-form-label'])); ?>

                                <?php echo e(Form::text('strictly_cookie_title', null, ['class' => 'form-control cookie_setting', 'placeholder' => __('Enter Strictly Cookie Title')])); ?>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-0">
                                <?php echo e(Form::label('cookie_description', __('Cookie Description'), ['class' => ' form-label'])); ?>

                                <?php echo Form::textarea('cookie_description', null, [
                                    'class' => 'form-control cookie_setting',
                                    'rows' => '3',
                                    'placeholder' => __('Enter Cookie Description'),
                                ]); ?>

                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group mb-0">
                                <?php echo e(Form::label('strictly_cookie_description', __('Strictly Cookie Description'), ['class' => ' form-label'])); ?>

                                <?php echo Form::textarea('strictly_cookie_description', null, [
                                    'class' => 'form-control cookie_setting ',
                                    'rows' => '3',
                                    'placeholder' => __('Enter Strictly Cookie Description'),
                                ]); ?>

                            </div>
                        </div>
                        <div class="col-12">
                            <h5 class="mb-0"><?php echo e(__('More Information')); ?></h5>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-0">
                                <?php echo e(Form::label('more_information_description', __('Contact Us Description'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('more_information_description', null, [
                                    'class' => 'form-control cookie_setting',
                                    'placeholder' => __('Enter Contact Us Description'),
                                ])); ?>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-0">
                                <?php echo e(Form::label('contactus_url', __('Contact Us URL'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('contactus_url', null, [
                                    'class' => 'form-control cookie_setting',
                                    'placeholder' => __('Enter Contact Us URL'),
                                ])); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer p-3 d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <?php if(isset($settings['cookie_logging']) && $settings['cookie_logging'] == 'on'): ?>
                            <label for="file"
                                class="form-label mb-0"><?php echo e(__('Download cookie accepted data')); ?></label>
                            <a href="<?php echo e(asset(Storage::url('uploads/sample')) . '/data.csv'); ?>"
                                class="btn btn-sm btn-primary p-2">
                                <i class="ti ti-download"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                    <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn btn-primary">
                </div>
                <?php echo e(Form::close()); ?>

            </div>
            
            
            <div class="card mb-0" id="chatgpt-settings" role="tabpanel" aria-labelledby="pills-chatgpt-tab">
                <?php echo e(Form::model($settings, ['route' => 'settings.chatgptkey', 'method' => 'post', 'class' => 'mb-0'])); ?>

                <div class="card-header p-3">
                    <h5><?php echo e(__('Chat GPT Key Settings')); ?></h5>
                    <small><?php echo e(__('Edit your key details')); ?></small>
                </div>
                <div class="card-body px-3">
                    <div class="row row-gap">
                        <div class="col-sm-6 col-12">
                            <div class="form-group mb-0">
                                <?php echo e(Form::label('chatgpt_key', __('Chat GPT key'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('chatgpt_key', isset($settings['chatgpt_key']) ? $settings['chatgpt_key'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Chatgpt Key Here')])); ?>

                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group mb-0">
                                <?php echo e(Form::label('chatgpt_modal_name', __('Chat GPT Model Name'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::text('chatgpt_modal_name', isset($settings['chatgpt_modal_name']) ? $settings['chatgpt_modal_name'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Chat GPT Model Name')])); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer p-3 text-end">
                    <button class="btn btn-primary" type="submit"><?php echo e(__('Save Changes')); ?></button>
                </div>
                <?php echo e(Form::close()); ?>

                <!-- [ sample-page ] end -->
                <!-- [ Main Content ] end -->
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/settings/admin_settings.blade.php ENDPATH**/ ?>