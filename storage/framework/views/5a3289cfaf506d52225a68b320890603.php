<?php
    $logo = asset(Storage::url('uploads/logo/'));
    $company_logo = \App\Models\Utility::getValByName('company_logo');
?>

<?php $__env->startSection('content'); ?>
    <div class="card-body">
        <?php if(session('status') == 'verification-link-sent'): ?>
            <div class="mb-4 font-medium text-sm text-green-600 text-primary">
                <?php echo e(__('A new verification link has been sent to the email address you provided during registration.')); ?>

            </div>
        <?php elseif(session('status') == 'smtp'): ?>
        <div class="mb-4 font-medium text-lg text-green-600 text-danger">
            <?php echo e(__('Email SMTP settings does not configured so please contact to your site admin.')); ?>

        </div>
        <?php endif; ?>
        <div>
            <h2 class="mb-3 f-w-600"><?php echo e(__('Verification')); ?> <span class="text-primary"><?php echo e(__('')); ?></span></h2>
            <p><?php echo e(__('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.')); ?>

            </p>
        </div>

        <div class="custom-login-form">
            <div class="form-group mb-3">
                <form method="POST" action="<?php echo e(route('verification.send')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <?php echo e(__('Resend Verification Email')); ?>

                    </button>
                </form>
            </div>
            <div class="form-group mb-3">
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-danger btn-sm"> <?php echo e(__('Logout')); ?></button>
                </form>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/auth/verify-email.blade.php ENDPATH**/ ?>