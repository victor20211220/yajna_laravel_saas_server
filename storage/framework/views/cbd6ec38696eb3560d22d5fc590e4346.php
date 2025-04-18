<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Userlog')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Userlog')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Userlog')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Userlog')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12">
        <div class=" mt-2 " id="multiCollapseExample1" style="">
            <div class="card">
                <div class="card-body">
                    <?php echo e(Form::open(['route' => ['userlogs.index'], 'method' => 'get', 'id' => 'userlog_filter'])); ?>

                    <div class="row row-gap align-items-end">
                        <div class="col-xl-3 col-md-4 col-sm-6 col-12">
                            <div class="btn-box">
                                <?php echo e(Form::label('month', __('Month'), ['class' => 'form-label'])); ?>

                                <input type="month" name="month" class="form-control" value="<?php echo e(isset($_GET['month']) ? $_GET['month'] : ''); ?>" placeholder ="">
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-4 col-sm-6 col-12">
                            <div class="btn-box">
                                <?php echo e(Form::label('user', __('User'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::select('user', $userList, isset($_GET['user']) ? $_GET['user'] : '', ['class' => 'form-control select ', 'id' => 'user_id'])); ?>

                            </div>
                        </div>
                        <div class="col-auto d-flex float-end pb-1">
                            <a href="#" class="btn btn-sm btn-primary me-2"
                                onclick="document.getElementById('userlog_filter').submit(); return false;"
                                data-bs-toggle="tooltip" title="" data-bs-original-title="<?php echo e(__('Apply')); ?>">
                                <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                            </a>
                            <a href="<?php echo e(route('userlogs.index')); ?>" class="btn btn-sm btn-danger"
                                data-bs-toggle="tooltip" title="" data-bs-original-title="<?php echo e(__('Reset')); ?>">
                                <span class="btn-inner--icon"><i class="ti ti-refresh text-white-off "></i></span>
                            </a>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
     </div>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body table-border-style ">
                <h5></h5>
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                            <th><?php echo e(__('User')); ?> </th>
                            <th><?php echo e(__('Role')); ?> </th>
                            <th><?php echo e(__('Email')); ?> </th>
                            <th><?php echo e(__('Last Login At')); ?> </th>
                            <th><?php echo e(__('IP')); ?> </th>
                            <th><?php echo e(__('Country')); ?> </th>
                            <th><?php echo e(__('OS Name')); ?> </th>
                            <th><?php echo e(__('Device Name')); ?> </th>
                            <th width="200px"><?php echo e(__('Action')); ?> </th>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $userlogdetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userlogs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                             $json=json_decode($userlogs->details);
                        ?>
                            <tr>
                                <td><?php echo e(ucfirst($userlogs->name)); ?></td>
                                <td><span class="badge rounded p-2 m-1 px-3 bg-primary"><?php echo e(ucfirst($userlogs->type)); ?></span></td>
                                <td><?php echo e($userlogs->email); ?></td>
                                <td><?php echo e($userlogs->date); ?></td>
                                <td><?php echo e($userlogs->ip); ?></td>
                                <td><?php echo e($json->country); ?></td>
                                <td><?php echo e($json->os_name); ?></td>
                                <td><?php echo e($json->device_type); ?></td>
                                <td>
                                    <div class="action-btn me-2">
                                        <a href="#" class="mx-3 bg-secondary btn btn-sm d-inline-flex align-items-center " data-url="<?php echo e(route('userlogs.show',$userlogs->id)); ?>" data-size="lg" data-ajax-popup="true"  data-title="<?php echo e(__('View UserLog')); ?>" title="<?php echo e(__('View')); ?>" data-bs-toggle="tooltip" data-bs-placement="top"><span class="text-white"><i class="ti ti-eye text-white"></i></span></a>
                                    </div>
                                    <div class="action-btn me-2">
                                        <a href="#" class="bg-danger bs-pass-para mx-3 btn btn-sm d-inline-flex align-items-center" data-confirm="<?php echo e(__('Are You Sure?')); ?>" data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="delete-form-<?php echo e($userlogs->id); ?>"
                                        title="<?php echo e(__('Delete')); ?>" data-bs-toggle="tooltip"
                                        data-bs-placement="top"><span class="text-white"><i
                                                class="ti ti-trash"></i></span></a>
                                    </div>
                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['userlogs.destroy', $userlogs->id],'id'=>'delete-form-'.$userlogs->id]); ?>

                                    <?php echo Form::close(); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('custom-scripts'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/userlog/index.blade.php ENDPATH**/ ?>