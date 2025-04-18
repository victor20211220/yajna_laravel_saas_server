<?php
    $profile = \App\Models\Utility::get_file('uploads/avatar');

    $users = \Auth::user();
    $user = Auth::user();
    $google2fa_url = "";
    $secret_key = "";
    if($user->google2fa_enable == 0 && $user->google2fa_secret != null)
    {
        $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());
        $google2fa_url = $google2fa->getQRCodeInline(
            config('app.name'),
            $user->email,
            $user->google2fa_secret
        );
        $secret_key = $user->google2fa_secret;
    }

    $data = array(
        'user' => $user,
        'secret' => $secret_key,
        'google2fa_url' => $google2fa_url
    );
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Profile Account')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
 <?php echo e(__('Profile')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-scripts'); ?>
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300
        })
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Profile')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            <a href="#useradd-2"
                                class="list-group-item list-group-item-action border-0 "><?php echo e(__('Personal info')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#useradd-3"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Change Password')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#useradd-4" class="list-group-item list-group-item-action border-0">
                                <?php echo e(__('Two Factor Authentication')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div id="useradd-2" class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Personal info')); ?></h5>
                            <small class="text-muted"><?php echo e(__('Edit details about your personal information')); ?></small>
                        </div>
                        <?php echo e(Form::model($userDetail, ['route' => ['update.account'], 'method' => 'post', 'enctype' => 'multipart/form-data','class' => 'needs-validation', 'novalidate'])); ?>

                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-lg-6 mb-3 img-validate-class">
                                    <div class="form-group">
                                        <img src="<?php echo e(!empty($users->avatar) ? $profile . '/' . $users->avatar : $profile . '/avatar.png'); ?>"
                                            id="blah" class="img-thumbnail m-2 w-25"/>
                                        <span class="profiles"></span>
                                        <div class="choose-files mt-3">
                                            <label for="avatar">
                                                <div class="bg-primary company_logo_update mb-3" style="cursor: pointer;"> <i class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?></div>

                                                <input type="file" class="form-control file d-none file-validate" id="avatar" name="profile"
                                                    data-filename="profiles"
                                                    onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                                    <span class="text-xs text-muted mb-5"><?php echo e(__('Please upload a valid image file. Size of image should not be more than 2MB.')); ?></span>
                                            </label>
                                            <p class="file-error text-danger" style=""></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <?php echo e(Form::label('name', __('Name'), ['class' => 'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
                                        <?php echo e(Form::text('name', null, ['class' => 'form-control font-style', 'placeholder' => __('Enter User Name'),'required'=>'required'])); ?>

                                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-name" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo e(Form::label('email', __('Email'), ['class' => 'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
                                        <?php echo e(Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('Enter User Email'),'required'=>'required'])); ?>

                                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-email" role="alert">
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
                        <div class="card-footer">
                            <div class="text-end">
                                <?php echo e(Form::submit(__('Save Change'), ['class' => 'btn btn-print-invoice btn-primary '])); ?>

                            </div>

                        </div>
                        <?php echo e(Form::close()); ?>


                    </div>

                    <div id="useradd-3" class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Change Password')); ?></h5>
                            <small class="text-muted"><?php echo e(__('Edit details about your Password')); ?></small>
                        </div>
                        <?php echo e(Form::model($userDetail, ['route' => ['update.password', $userDetail->id], 'method' => 'post', 'class' => 'needs-validation', 'novalidate'])); ?>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('current_password', __('Current Password'), ['class' => 'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
                                        <?php echo e(Form::password('current_password', ['class' => 'form-control', 'placeholder' => __('Enter Current Password'),'required'=>'required'])); ?>


                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('new_password', __('New Password'), ['class' => 'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
                                        <?php echo e(Form::password('new_password', ['class' => 'form-control', 'placeholder' => __('Enter New Password'),'required'=>'required'])); ?>


                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('confirm_password', __('Re-type New Password'), ['class' => 'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
                                        <?php echo e(Form::password('confirm_password', ['class' => 'form-control', 'placeholder' => __('Enter Re-type New Password'),'required'=>'required'])); ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <?php echo e(Form::submit(__('Save Change'), ['class' => 'btn btn-print-invoice  btn-primary '])); ?>

                        </div>
                        <?php echo e(Form::close()); ?>




                    </div>

                    <div id="useradd-4" class="card">
                        <div class="card-header">
                            <h5 class="mb-2"><?php echo e(__('Two Factor Authentication')); ?></h5>
                        </div>
                        <div class="card-body">
                            <p><?php echo e(__('Two factor authentication (2FA) strengthens access security by requiring two methods (also referred to as factors) to verify your identity. Two factor authentication protects against phishing, social engineering and password brute force attacks and secures your logins from attackers exploiting weak or stolen credentials.')); ?></p>
                            <?php if($data['user']->google2fa_secret == null): ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('google authentication enable')): ?>
                                    <form class="form-horizontal" method="POST" action="<?php echo e(route('generate2faSecret')); ?>">
                                        <?php echo e(csrf_field()); ?>

                                        <div class="col-lg-12 text-center">
                                            <button type="submit" class="btn btn-primary">
                                                <?php echo e(__(' Generate Secret Key to Enable 2FA')); ?>

                                            </button>
                                        </div>
                                    </form>
                                <?php endif; ?>
                            <?php elseif($data['user']->google2fa_enable == 0 && $data['user']->google2fa_secret != null): ?>
                                    1. <?php echo e(__('Install “Google Authentication App” on your')); ?> <a href="https://apps.apple.com/us/app/google-authenticator/id388497605" target="_black"> <?php echo e(__('IOS')); ?></a> <?php echo e(__('or')); ?> <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2" target="_black"><?php echo e(__('Android phone.')); ?></a><br/>
                                    2. <?php echo e(__('Open the Google Authentication App and scan the below QR code.')); ?><br/>
                                    <?php
                                        $f = finfo_open();
                                        $mime_type = finfo_buffer($f, $data['google2fa_url'], FILEINFO_MIME_TYPE);
                                    ?>
                                    <?php if($mime_type == 'text/plain'): ?>
                                        <img src="<?php echo e($data['google2fa_url']); ?>" alt="">
                                    <?php else: ?>
                                        <?php echo $data['google2fa_url']; ?>

                                    <?php endif; ?>
                                    <br/><br/>
                                    <?php echo e(__('Alternatively, you can use the code:')); ?> <code><?php echo e($data['secret']); ?></code>.<br/>
                                    3. <?php echo e(__('Enter the 6-digit Google Authentication code from the app')); ?><br/><br/>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('google authentication enable')): ?>
                                        <form class="form-horizontal" method="POST" action="<?php echo e(route('enable2fa')); ?>">
                                            <?php echo e(csrf_field()); ?>

                                            <div class="form-group<?php echo e($errors->has('verify-code') ? ' has-error' : ''); ?>">
                                                <label for="secret" class="col-form-label"><?php echo e(__('Authenticator Code')); ?></label>
                                                <input id="secret" type="password" class="form-control" name="secret" required="required" placeholder="<?php echo e(__('Enter Authenticator Code')); ?>">
                                            </div>
                                            <div class="col-lg-12 text-center">
                                                <button type="submit" class="btn btn-primary">
                                                    <?php echo e(__('Enable 2FA')); ?>

                                                </button>
                                            </div>
                                        </form>
                                    <?php endif; ?>
                            <?php elseif($data['user']->google2fa_enable == 1 && $data['user']->google2fa_secret != null): ?>
                                <div class="alert alert-success">
                                    <?php echo e(__('2FA is currently')); ?> <strong><?php echo e(__('Enabled')); ?></strong> <?php echo e(__('on your account.')); ?>

                                </div>
                                <p><?php echo e(__('If you are looking to disable Two Factor Authentication. Please confirm your password and Click Disable 2FA Button.')); ?></p>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('google authentication disable')): ?>
                                    <form class="form-horizontal" method="POST" action="<?php echo e(route('disable2fa')); ?>">
                                        <?php echo e(csrf_field()); ?>

                                        <div class="form-group<?php echo e($errors->has('current-password') ? ' has-error' : ''); ?>">
                                            <label for="change-password" class="col-form-label"><?php echo e(__('Current Password')); ?></label>
                                                <input id="current-password" type="password" class="form-control" name="current-password" required="required">
                                                <?php if($errors->has('current-password')): ?>
                                                    <span class="help-block">
                                                <strong class="text-danger"><?php echo e($errors->first('current-password')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                        </div>
                                        <div class="col-lg-12 text-center">
                                            <button type="submit" class="btn btn-primary">
                                                <?php echo e(__('Disable 2FA')); ?>

                                            </button>
                                        </div>
                                    </form>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/user/profile.blade.php ENDPATH**/ ?>