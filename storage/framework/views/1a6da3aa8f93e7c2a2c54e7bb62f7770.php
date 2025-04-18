<div class="row pb-2">
    <div class="row">
        <div class="col-md-4">
            <div class="form-control-label"><b><?php echo e(__('Order ID')); ?></b></div>
        </div>
        <div class="col-md-6">
            <p class="mb-4">
                <?php echo e($order->order_id); ?>

            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-control-label"><b><?php echo e(__('Plan Name')); ?></b></div>
        </div>
        <div class="col-md-6">
            <p class="mb-4">
                <?php echo e($order->plan_name); ?>

            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-control-label"><b><?php echo e(__('Plan Price')); ?></b></div>
        </div>
        <div class="col-md-6">
            <p class="mb-4">
                <?php echo e($order->price); ?>

            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-control-label"><b><?php echo e(__('Payment Type')); ?></b></div>
        </div>
        <div class="col-md-6">
            <p class="mb-4">
                <?php echo e($order->payment_type); ?>

            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-control-label"><b><?php echo e(__('Payment Status')); ?></b></div>
        </div>
        <div class="col-md-6">
            <p class="mb-4">
                <?php echo e($order->payment_status); ?>

            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-control-label"><b><?php echo e(__('Bank Detail')); ?></b></div>
        </div>
        <div class="col-md-6">
            <p class="mb-4">
                <?php echo $bank_detail; ?>

            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-control-label"><b><?php echo e(__('Payment Receipt')); ?></b></div>
        </div>
        <div class="col-md-6">
            <a href="<?php echo e(asset(Storage::url('bank_receipt')) . '/' . $order->receipt); ?>"
                class="btn btn-sm btn-primary mr-2 " download>
                <i class="ti ti-download"></i>
            </a>
        </div>
    </div>
</div>

<div class="modal-footer p-0 pt-3">
    <a href="<?php echo e(route('change.status', [$order->id, 1])); ?>" class="btn btn-success btn-xs">
        <?php echo e(__('Approve')); ?>

    </a>
    <a href="<?php echo e(route('change.status', [$order->id, 0])); ?>" class="btn btn-danger btn-xs">
        <?php echo e(__('Reject')); ?>

    </a>

</div>
<?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/order/view.blade.php ENDPATH**/ ?>