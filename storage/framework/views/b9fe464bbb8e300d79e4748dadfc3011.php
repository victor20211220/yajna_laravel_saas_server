<?php $__env->startSection('page-title'); ?>
    <?php if(Auth::user()->type == 'super admin'): ?>
        <?php echo e(__('Manage Company')); ?>

    <?php else: ?>
        <?php echo e(__('Manage Users')); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php if(Auth::user()->type == 'super admin'): ?>
        <?php echo e(__('Manage Company')); ?>

    <?php else: ?>
        <?php echo e(__('Manage Users')); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <?php if(Auth::user()->type == 'super admin'): ?>
        <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Company')); ?></li>
    <?php else: ?>
        <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('User')); ?></li>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="pr-2 d-flex align-items-center gap-2 rating-btn-wrapper">
        <?php if(Auth::user()->type == 'super admin' || Auth::user()->type == 'company'): ?>
            <a href="<?php echo e(route('users.index')); ?>" class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip"
            data-bs-placement="top" title="<?php echo e(__('Grid View')); ?>"><i class="ti ti-layout-grid"></i></a>
        <?php endif; ?>
        <?php if(Auth::user()->type == 'super admin'): ?>
        <a href="#" data-size="md" data-url="<?php echo e(route('users.create')); ?>" data-ajax-popup="true"
            data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create New Company')); ?>"
            class="btn btn-sm btn-primary me-1">
            <i class="ti ti-plus"></i>
        </a>
    <?php else: ?>
        <a href="#" data-size="md" data-url="<?php echo e(route('users.create')); ?>" data-ajax-popup="true"
            data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create New User')); ?>"
            class="btn btn-sm btn-primary me-1">
            <i class="ti ti-plus"></i>
        </a>
    <?php endif; ?>
    </div>
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
                                    <th> <?php echo e(__('Avtar')); ?></th>
                                    <th> <?php echo e(__('Name')); ?></th>
                                    <th> <?php echo e(__('E-mail')); ?></th>
                                    <th><?php echo e(__('Type')); ?></th>
                                    <th> <?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $profile = \App\Models\Utility::get_file('uploads/avatar/');
                                ?>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <span class="avatar">
                                                <a href="<?php echo e(!empty($user->avatar) ? $profile . $user->avatar : asset(Storage::url('uploads/avatar/avatar.png'))); ?>" target="_blank" >
                                                    <img src="<?php echo e(!empty($user->avatar) ? $profile . $user->avatar : asset(Storage::url('uploads/avatar/avatar.png'))); ?>" height="40px" width="40px" class=" rounded border-2 border border-primary m-auto" >
                                                </a>
                                            </span>
                                        </td>
                                        <td><?php echo e($user->name); ?></td>
                                        <td><?php echo e($user->email); ?></td>
                                        <td><span class="badge bg-primary p-2 px-3 tbl-btn-w"><?php echo e($user->type); ?></span></td>
                                        <td class="" style="width: 200px;">
                                            <?php if($user->admin_enable == 'on'): ?>
                                                <?php if(\Auth::user()->type == 'super admin'): ?>
                                                    <div class="action-btn  me-2">
                                                        <a href="<?php echo e(route('login.with.company', $user->id)); ?>"
                                                            class="btn-primary-subtle btn btn-sm align-items-center text-white" title="<?php echo e(__('Login As Company')); ?>"
                                                            data-bs-toggle="tooltip" data-bs-placement="top" 
                                                            data-bs-original-title="<?php echo e(__('Login As Company')); ?>">
                                                            <i class="ti ti-replace"></i>
                                                        </a>
                                                    </div>
                                                    <div class="action-btn me-2">
                                                        <a data-url="<?php echo e(route('business.upgrade', $user->id)); ?>"
                                                            class="btn bg-warning-subtle btn-sm align-items-center text-white"
                                                            data-ajax-popup="true" data-size="lg" data-bs-toggle="tooltip"
                                                            data-title="<?php echo e(__('Company Info')); ?>"
                                                            title="<?php echo e(__('Company Info')); ?>">
                                                            <i class="ti ti-atom"></i>
                                                        </a>
                                                    </div>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit user')): ?>
                                                        <div class="action-btn me-2">
                                                            <a href="#" data-url="<?php echo e(route('plan.upgrade', $user->id)); ?>"
                                                                class="btn bg-brown-subtitle btn-sm align-items-center text-white" data-size="lg" data-bs-placement="top"
                                                                data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Upgrade Plan')); ?>"
                                                                data-ajax-popup="true" data-title="<?php echo e(__('Upgrade Plan')); ?>">
                                                                <i class="ti ti-trophy"></i>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <div class="action-btn me-2">
                                                <a href="#"
                                                    class="mx-3 bg-light-blue-subtitle btn btn-sm  align-items-center text-white"
                                                    data-size="md"
                                                    data-url="<?php echo e(route('user.reset', \Crypt::encrypt($user->id))); ?>"
                                                    data-ajax-popup="true" title="<?php echo e(__('Reset Password')); ?>"
                                                    data-bs-toggle="tooltip"
                                                    data-title="<?php echo e(__('Reset Password')); ?>">
                                                    <i class="ti ti-key"></i>
                                                </a>
                                            </div>
                                            <?php if($user->is_enable_login == 1): ?>
                                                <div class="action-btn  me-2">
                                                    <a href="<?php echo e(route('users.login', \Crypt::encrypt($user->id))); ?>"
                                                        class="mx-3 bg-danger btn btn-sm  align-items-center"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-original-title="<?php echo e(__('Login Disable')); ?>"> <span
                                                            class="text-white"><i class="ti ti-road-sign"></i></a>
                                                </div>
                                            <?php elseif($user->is_enable_login == 0 && $user->password == null): ?>
                                                <div class="action-btn me-2">
                                                    <a href="#"
                                                        data-url="<?php echo e(route('user.reset', \Crypt::encrypt($user->id))); ?>"
                                                        data-ajax-popup="true" data-size="md"
                                                        class="mx-3 bg-light-green-subtitle btn btn-sm  align-items-center login_enable"
                                                        data-titgle="<?php echo e(__('New Password')); ?>"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-original-title="<?php echo e(__('New Password')); ?>"> <span
                                                            class="text-white"><i class="ti ti-road-sign"></i></a>
                                                </div>
                                            <?php else: ?>
                                                <div class="action-btn me-2">
                                                    <a href="<?php echo e(route('users.login', \Crypt::encrypt($user->id))); ?>"
                                                        class="mx-3 bg-success btn btn-sm  align-items-center login_enable"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-original-title="<?php echo e(__('Login Enable')); ?>"> <span
                                                            class="text-white"> <i class="ti ti-road-sign"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit user')): ?>
                                                    <div class="action-btn me-2">
                                                        <a href="#" class="mx-3 bg-info btn btn-sm  align-items-center text-white"
                                                            data-url="<?php echo e(route('users.edit', $user->id)); ?>" data-ajax-popup="true"
                                                            title="<?php echo e(__('Update User')); ?>" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" data-title="<?php echo e(__('Update User')); ?>"><i
                                                        class="ti ti-pencil"></i></a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if(\Auth::user()->type != 'super admin'): ?>
                                                    <div class="action-btn me-2">

                                                        <a href="<?php echo e(route('userlogs.index', ['month' => '', 'user' => $user->id])); ?>"
                                                            class="mx-3 bg-warning btn btn-sm  align-items-center text-white" data-bs-toggle="tooltip"
                                                            data-bs-original-title="<?php echo e(__('User Log')); ?>">
                                                            <i class="ti ti-eye"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>        
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete user')): ?>
                                                    <div class="action-btn">
                                                        



                                                        <a href="#" class="bs-pass-para mx-3 bg-danger btn btn-sm align-items-center text-white show_confirm"
                                                        data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                        data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                        data-confirm-yes="delete-form-<?php echo e($user->id); ?>"
                                                        title="<?php echo e(__('Delete')); ?>" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"><i
                                                            class="ti ti-trash"></i></a>
                                                    <?php echo Form::open([
                                                        'method' => 'DELETE',
                                                        'route' => ['users.destroy', $user->id],
                                                        'id' => 'delete-form-' . $user->id,
                                                    ]); ?>

                                                    <?php echo Form::close(); ?>


                                                    </div>
                                                <?php endif; ?>
                                                <?php else: ?>
                                                <div class="text-center">
                                                    <button type="button" class="btn" data-bs-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="ti ti-lock"></i>
                                                    </button>
                                                </div>
                                            <?php endif; ?>
                                        </td>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/user/list.blade.php ENDPATH**/ ?>