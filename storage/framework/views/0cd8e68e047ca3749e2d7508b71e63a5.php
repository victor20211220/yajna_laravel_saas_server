<?php
    $nfcImage = \App\Models\Utility::get_file('nfc/card_image');
    $admin_payment_setting = \App\Models\Utility::getAdminPaymentSetting();
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('NFC Order')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('NFC Order')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('NFC Order')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-0">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <?php if(Auth::user()->type == 'super admin'): ?>
                            <table class="table" id="pc-dt-simple">
                                <thead>
                                    <tr>
                                        <th> <?php echo e(__('Order ID')); ?></th>
                                        <th> <?php echo e(__('Company')); ?></th>
                                        <th> <?php echo e(__('NFC Card Name')); ?></th>
                                        <th> <?php echo e(__('Business Name')); ?></th>
                                        <th> <?php echo e(__('Order Status')); ?></th>
                                        <th> <?php echo e(__('Created On')); ?></th>
                                        <th> <?php echo e(__('Action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $__currentLoopData = $orderRequest; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($order->order_id); ?></td>
                                            <td><?php echo e($order->company_name); ?></td>
                                            <td><?php echo e($order->nfc_card_name); ?></td>
                                            <td><?php echo e($order->business_name); ?></td>
                                            <td>
                                                <?php if($order->approval == '1'): ?>
                                                    <ul class="list-unstyled m-0">
                                                        <li class="dropdown dash-h-item drp-language">
                                                            <a class="dash-head-link  arrow-none me-0 btn btn-sm btn-primary"
                                                                data-bs-toggle="dropdown" href="#" role="button"
                                                                aria-haspopup="false" aria-expanded="false">
                                                                <span
                                                                    class="drp-text hide-mob"><?php echo e(ucFirst($order->status)); ?></span>
                                                                <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                                                            </a>
                                                            <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
                                                                <?php $__currentLoopData = \App\Models\OrderRequest::OrderStatus(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <a href="<?php echo e(route('change.order.status', ['id' => $order->id, 'status' => $key])); ?>"
                                                                        class="dropdown-item ">
                                                                        <span><?php echo e($status); ?></span>
                                                                    </a>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                <?php elseif($order->approval == '0'): ?>
                                                    <span
                                                        class="badge fix_badge bg-danger p-2 px-3"><?php echo e(__('Rejected')); ?></span>
                                                <?php else: ?>
                                                    <span
                                                        class="badge fix_badge bg-warning p-2 px-3"><?php echo e(__('Pending')); ?></span>
                                                <?php endif; ?>

                                            </td>
                                            <td><?php echo e($order->created_at); ?></td>
                                            <td class="">

                                                <?php if(is_null($order->approval)): ?>
                                                    <div class="action-btn  me-2">

                                                        <a href="<?php echo e(route('order.request', [$order->id, 1])); ?>"
                                                            data-bs-placement="top" data-bs-toggle="tooltip" title="<?php echo e(__('Accept')); ?>"
                                                            data-bs-original-title="<?php echo e(__('Accept')); ?>"
                                                            class="mx-3 btn-primary btn btn-sm  align-items-center ">
                                                            <i class="ti ti-check"></i>
                                                        </a>
                                                    </div>
                                                    <div class="action-btn ">
                                                        <a data-bs-placement="top" data-bs-toggle="tooltip"
                                                            data-bs-original-title="<?php echo e(__('Reject')); ?>" title="<?php echo e(__('Reject')); ?>"
                                                            href="<?php echo e(route('order.request', [$order->id, 0])); ?>"
                                                            class="mx-3 btn-danger btn btn-sm  align-items-center">
                                                            <i class="ti ti-x"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <table class="table" id="pc-dt-simple">
                                <thead>
                                    <tr>
                                        <th> <?php echo e(__('Order ID')); ?></th>
                                        <th> <?php echo e(__('Company')); ?></th>
                                        <th> <?php echo e(__('NFC Card Name')); ?></th>
                                        <th> <?php echo e(__('Business Name')); ?></th>
                                        <th> <?php echo e(__('Order Status')); ?></th>
                                        <th> <?php echo e(__('Created On')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $orderRequest; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($order->order_id); ?></td>
                                            <td><?php echo e($order->company_name); ?></td>
                                            <td><?php echo e($order->nfc_card_name); ?></td>
                                            <td><?php echo e($order->business_name); ?></td>
                                            <td>

                                                <?php if($order->approval == '1'): ?>
                                                    <span class="badge fix_badge bg-info  p-2 px-3"><?php echo e(ucFirst($order->status)); ?></span>
                                                <?php elseif($order->approval == '0'): ?>
                                                    <span class="badge fix_badge bg-danger p-2 px-3"><?php echo e(__('Rejected')); ?></span>
                                                <?php else: ?>
                                                    <span class="badge fix_badge bg-warning p-2 px-3"><?php echo e(__('Pending')); ?></span>
                                                <?php endif; ?>

                                            </td>
                                            <td><?php echo e($order->created_at); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/nfc/orderdetail.blade.php ENDPATH**/ ?>