<?php
    $cardLogo = \App\Models\Utility::get_file('card_logo');
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Branch')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Business')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__(' Business Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xxl-3">
            <?php echo $__env->make('layouts.marketplace_setup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-xxl-9">

            <div class="card mb-0">
                <div class="card-header">
                    <h5><?php echo e('Cost Per Day Settings'); ?></h5>
                </div>
                <?php echo e(Form::open(['route' => 'wholesale.cost-setting', 'method' => 'post'])); ?>

                <div class="card-body">
                    <div class="row">
                        <div class="repeater">
                            <div class="col-lg-12 text-end mb-2">
                                <a data-repeater-create type="button" value="Add" class="submitbtn btn btn-sm btn-primary"
                                data-bs-placement="top" data-bs-toggle="tooltip"
                                title="<?php echo e(__('Create')); ?>" data-bs-original-title="<?php echo e(__('Create')); ?>">
                                    <i class="ti ti-plus text-white"></i>
                                </a>
                            </div>
                            <div data-repeater-list="category_group">
                                <?php if(!empty($costDetail) && count($costDetail) > 0): ?>
                                    <?php $__currentLoopData = $costDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div data-repeater-item class="row row-gap align-items-end mt-3">
                                            <input type="hidden" name="id" class="cat_id" value="<?php echo e($cost->id); ?>" />
                                            <div class="col-sm-3 col-6">
                                                <?php echo e(Form::label('min', __('Min Days'), ['class' => 'mb-2'])); ?>

                                                <input class="dtpiker form-control" type="text" name="min" value="<?php echo e($cost->min); ?>" placeholder="<?php echo e(__('Enter minimum days')); ?>"  />
                                            </div>
                                            <div class="col-sm-3 col-6">
                                                <?php echo e(Form::label('max', __('Max Days'), ['class' => 'mb-2'])); ?>

                                                <input class="dtpiker form-control" type="text" name="max" value="<?php echo e($cost->max); ?>"  placeholder="<?php echo e(__('Enter maximum days')); ?>" />
                                            </div>
                                            <div class="col-sm-3 col-6">
                                                <?php echo e(Form::label('price', __('Per Day Price'), ['class' => 'mb-2'])); ?>

                                                <input class="dtpiker form-control" type="text" name="price" value="<?php echo e($cost->price); ?>"  placeholder="<?php echo e(__('Enter price per day')); ?>"  />
                                            </div>
                                            <div class="col-sm-3 col-6">
                                                <a data-repeater-delete href="javascript:void(0)" class="btn btn-sm btn-danger mb-2"
                                                    data-bs-placement="top" data-bs-toggle="tooltip"
                                                    title="<?php echo e(__('Delete')); ?>" data-bs-original-title="<?php echo e(__('Create')); ?>">
                                                    <i class="ti ti-trash text-white"></i>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <div data-repeater-item class="row row-gap align-items-end mt-3">
                                        <div class="col-sm-3 col-6">
                                            <?php echo e(Form::label('min', __('Min Days'), ['class' => 'mb-2'])); ?>

                                            <input class="dtpiker form-control" type="text" name="min" value="" required placeholder="<?php echo e(__('Enter minimum days')); ?>"/>
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <?php echo e(Form::label('max', __('Max Days'), ['class' => 'mb-2'])); ?>

                                            <input class="dtpiker form-control" type="text" name="max" value="" required placeholder="<?php echo e(__('Enter maximum days')); ?>" />
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <?php echo e(Form::label('price', __('Per Day Price'), ['class' => 'mb-2'])); ?>

                                            <input class="dtpiker form-control" type="text" name="price" value="" required   placeholder="<?php echo e(__('Enter price per day')); ?>" />
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <a data-repeater-delete href="javascript:void(0)" class="btn btn-sm btn-danger mb-2"
                                            data-bs-placement="top" data-bs-toggle="tooltip"
                                            title="<?php echo e(__('Delete')); ?>" data-bs-original-title="<?php echo e(__('Create')); ?>">
                                                <i class="ti ti-trash text-white"></i>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" name="deleted_ids" id="deleted_ids" value="">
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-print-invoice btn-primary'])); ?>

                </div>
                <?php echo e(Form::close()); ?>


            </div>

        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-scripts'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
    <script>
        $(document).ready(function () {
            var deletedIds = [];

            $('.repeater').repeater({
                initEmpty: <?php echo e(empty($costDetail) ? 'true' : 'false'); ?>,
                defaultValues: {
                    'min': '',
                    'max': '',
                    'price': ''
                },
                show: function () {
                    $(this).slideDown();
                },
                hide: function (deleteElement) {

                var totalItems = $('.repeater [data-repeater-item]').length;

                if (totalItems === 1) {
                    alert("At least one cost setting must be present. You cannot delete the last item.");
                    return;
                }


                var id = $(this).find('.cat_id').val();
                if (id) {
                    deletedIds.push(id);
                    $('#deleted_ids').val(deletedIds.join(','));
                }
                $(this).slideUp(deleteElement);
            },
            ready: function (setIndexes) {
                // Optional callback when repeater is ready
            }
            });


        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/campaigns/setup.blade.php ENDPATH**/ ?>