<div class="card sticky-top" style="top:30px">
    <div class="list-group list-group-flush" id="useradd-sidenav">
        <a href="<?php echo e(route('category.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((request()->is('category*') ? 'active' : '')); ?>"><?php echo e(__('Category Settings')); ?><div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
        <a href="<?php echo e(route('business.setup')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((request()->is('business_setup*') ? 'active' : '')); ?>"><?php echo e(__('Business Settings')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
    </div>
</div>
<?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/layouts/marketplace_setup.blade.php ENDPATH**/ ?>