<?php $__env->startPush('custom-scripts'); ?>
    <script>
        $(document).on('click', '.code', function() {
            var type = $(this).val();
            if (type == 'manual') {
                $('#manual').removeClass('d-none');
                $('#manual').addClass('d-block');
                $('#auto').removeClass('d-block');
                $('#auto').addClass('d-none');

                // Clear the value of the auto-generated code field
                $('#auto-code').val('');
            } else {
                $('#auto').removeClass('d-none');
                $('#auto').addClass('d-block');
                $('#manual').removeClass('d-block');
                $('#manual').addClass('d-none');

                // Clear the value of the manual code field
                $('#manual').val('');
            }
        });

        $(document).on('click', '#code-generate', function() {
            var length = 10;
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            $('#auto-code').val(result);
        });
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Coupon')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Manage Coupon')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Coupon')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create coupon')): ?>
        <div class="col-xl-12 col-lg-12 col-md-12 d-flex align-items-center justify-content-between justify-content-md-end"
            data-bs-placement="top">
            <a class="btn btn-sm btn-primary btn-icon me-2" href="<?php echo e(route('coupons.export')); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Export">
                <i class="ti ti-file-export"></i>
            </a>
            <?php if(\App\Models\Utility::getPaymentIsOn() && \Auth::user()->type == 'super admin'): ?>
                <a href="#" data-size="lg" data-url="<?php echo e(route('coupons.create')); ?>" data-ajax-popup="true"
                    data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create New Coupon')); ?>"
                    class="btn btn-sm btn-primary">
                    <i class="ti ti-plus"></i>
                </a>
            <?php endif; ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-0">
                <div class="card-body table-border-style">
                    <h5></h5>
                    <div class="table-responsive">
                        <table class="table" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th> <?php echo e(__('Name')); ?></th>
                                    <th> <?php echo e(__('Code')); ?></th>
                                    <th> <?php echo e(__('Discount')); ?></th>
                                    <th> <?php echo e(__('Limit')); ?></th>
                                    <th> <?php echo e(__('Used')); ?></th>
                                    <th> <?php echo e(__('Expiry Date')); ?></th>
                                    <th> <?php echo e(__('Status')); ?></th>
                                    <th> <?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($coupon->name); ?></td>
                                        <td><?php echo e($coupon->code); ?></td>
                                        <td><?php echo e($coupon->discount); ?></td>
                                        <td><?php echo e($coupon->limit); ?></td>
                                        <td><?php echo e($coupon->used_coupon()); ?></td>
                                        <td><?php echo e($coupon->expiry_date); ?></td>
                                        
                                        <td>
                                            <span class="badge fix_badge
                                                <?php if($coupon->is_active == 0): ?> bg-danger
                                                <?php elseif($coupon->is_active == 1): ?> bg-info
                                                <?php endif; ?>
                                                p-2 px-3 " style="width:100px">
                                                <?php echo e($coupon->is_active == 1 ? 'Active':'In Active'); ?>

                                            </span>
                                        </td>

                                        <div class="row ">
                                            <td class="">

                                                <div class="action-btn  me-2">
                                                    <a href="<?php echo e(route('coupons.show', $coupon->id)); ?>"
                                                        class=" bg-warning btn btn-sm d-inline-flex align-items-center"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-original-title="<?php echo e(__('Show Coupon')); ?>"> <span
                                                            class="text-white"> <i
                                                                class="ti ti-eye text-white"></i></span></a>
                                                </div>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit coupon')): ?>
                                                    <div class="action-btn  me-2">
                                                        <a href="#"
                                                            class=" btn bg-info btn-sm d-inline-flex align-items-center"
                                                            data-url="<?php echo e(route('coupons.edit', $coupon->id)); ?>" data-size="lg"
                                                            data-ajax-popup="true" data-title="<?php echo e(__('Edit Coupon')); ?>"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-original-title="<?php echo e(__('Edit Coupon')); ?>"> <span
                                                                class="text-white"> <i
                                                                    class="ti ti-pencil text-white"></i></span></a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete coupon')): ?>
                                                    <div class="action-btn me-2">
                                                        <a href="#"
                                                            class="bs-pass-para  bg-danger btn btn-sm d-inline-flex align-items-center"
                                                            data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                            data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                            data-confirm-yes="delete-form-<?php echo e($coupon->id); ?>"
                                                            title="<?php echo e(__('Delete')); ?>" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"><span class="text-white"><i
                                                                    class="ti ti-trash"></i></span></a>
                                                    </div>
                                                    <?php echo Form::open([
                                                        'method' => 'DELETE',
                                                        'route' => ['coupons.destroy', $coupon->id],
                                                        'id' => 'delete-form-' . $coupon->id,
                                                    ]); ?>

                                                    <?php echo Form::close(); ?>

                                                <?php endif; ?>

                                            </td>

                                        </div>

                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/coupon/index.blade.php ENDPATH**/ ?>