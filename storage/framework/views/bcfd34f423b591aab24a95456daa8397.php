<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Email Template')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Manage Email Template')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Email Template')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-0">
                <div class=" card-body table-border-style">
                    <h5></h5>
                    <div class="table-responsive">
                        <table class="table" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($EmailTemplates->count() > 0): ?>
                                    <?php $__currentLoopData = $EmailTemplates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $EmailTemplate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                        <tr>
                                            <td>
                                                <div class="font-style font-weight-bold"><?php echo e($EmailTemplate->name); ?></div>
                                            </td>

                                            <td>
                                                <a href="<?php echo e(route('manage.email.language', [$EmailTemplate->id, \Auth::user()->lang])); ?>"
                                                    data-bs-placement="top" data-bs-toggle="tooltip"
                                                    data-bs-original-title="<?php echo e(__('Email Template Show')); ?>"
                                                    class="btn btn-warning btn-sm me-2">
                                                    <i class="ti ti-eye"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr>
                                        <th scope="col" colspan="7">
                                            <h6 class="text-center p-4"><?php echo e(__('No Manually Plan Request Found.')); ?></h6>
                                        </th>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/email_templates/index.blade.php ENDPATH**/ ?>