<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Custom Domain Request')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Custom Domain Request')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Custom Domain Request')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-0">
                <div class=" card-body table-border-style">
                    <h5></h5>
                    <div class="table-responsive pb-1">
                        <table class="table" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Company Name')); ?></th>
                                    <th><?php echo e(__('Business Name')); ?></th>
                                    <th><?php echo e(__('Domain')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('Created On')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($domain_request->count() > 0): ?>
                                    <?php $__currentLoopData = $domain_request; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prequest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                        <tr>
                                            <td>
                                                <div class="font-style font-weight-bold"><?php echo e(!empty($prequest->user->name) ? $prequest->user->name :'-' ); ?></div>
                                            </td>
                                            <td>
                                                <div class="font-style font-weight-bold"><?php echo e(!empty($prequest->business->title) ? $prequest->business->title : '-'); ?>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="font-style font-weight-bold"><?php echo e(!empty($prequest->domain_name) ? $prequest->domain_name : '-'); ?></div>
                                            </td>
                                            <td>
                                                <?php if($prequest->status == 0): ?>
                                                    <span
                                                        class="badge fix_badges bg-danger p-2 px-3" style="width: 100px"><?php echo e(__(App\Models\DomainRequest::$statues[$prequest->status])); ?></span>
                                                <?php elseif($prequest->status == 1): ?>
                                                    <span
                                                        class="badge fix_badges bg-primary p-2 px-3" style="width: 100px"><?php echo e(__(App\Models\DomainRequest::$statues[$prequest->status])); ?></span>
                                                <?php elseif($prequest->status == 2): ?>
                                                    <span
                                                        class="badge fix_badges bg-warning p-2 px-3" style="width: 100px"><?php echo e(__(App\Models\DomainRequest::$statues[$prequest->status])); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e(\App\Models\Utility::getDateFormated($prequest->created_at, true)); ?>

                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <?php if($prequest->status == 0): ?>
                                                        <a href="<?php echo e(route('domain_request.request', [$prequest->id, 1])); ?>"
                                                            class="btn btn-sm btn-icon  btn-primary me-2" data-bs-placement="top"
                                                            data-bs-toggle="tooltip" title="<?php echo e(__('Accept')); ?>"
                                                            data-bs-original-title="<?php echo e(__('Accept')); ?>">
                                                            <i class="ti ti-check "></i>
                                                        </a>
                                                        <a href="<?php echo e(route('domain_request.request', [$prequest->id, 0])); ?>"
                                                            class="btn btn-sm btn-icon  btn-danger me-2" data-bs-toggle="tooltip"
                                                            data-bs-original-title="<?php echo e(__('Reject')); ?>" title="<?php echo e(__('Reject')); ?>">
                                                            <i class="ti ti-x "></i>
                                                        </a>
                                                    <?php endif; ?>
                                                    <a href="#"
                                                        class="bs-pass-para btn btn-sm btn-icon  btn-danger me-2"
                                                        data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                        data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                        data-confirm-yes="delete-form-<?php echo e($prequest->id); ?>"
                                                        title="<?php echo e(__('Delete')); ?>" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"><span class="text-white"><i
                                                                class="ti ti-trash"></i></span></a>
                                                    <?php echo Form::open([
                                                        'method' => 'DELETE',
                                                        'route' => ['domain_request.destroy', $prequest->id],
                                                        'id' => 'delete-form-' . $prequest->id,
                                                    ]); ?>

                                                    <?php echo Form::close(); ?>

                                                </div>
                                            </td>
                                        </tr>

                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr>
                                        <th scope="col" colspan="7">
                                            <h6 class="text-center p-4"><?php echo e(__('No Manually Domain Request Found.')); ?></h6>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/domain_request/index.blade.php ENDPATH**/ ?>