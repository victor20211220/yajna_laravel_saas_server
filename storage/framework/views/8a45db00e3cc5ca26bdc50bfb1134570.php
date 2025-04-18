<?php
    // $profile=asset(Storage::url('uploads/avatar/'));
    $profile = \App\Models\Utility::get_file('uploads/avatar/');

?>
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
<?php $__env->startSection('action-btn'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create user')): ?>
        <div class="col-xl-12 col-lg-12 col-md-12 d-flex align-items-center justify-content-between justify-content-md-end"
            data-bs-placement="top">
            <?php if(Auth::user()->type == 'super admin' || Auth::user()->type == 'company' ): ?>
                <a href="<?php echo e(route('user.list')); ?>" class="btn btn-sm btn-primary me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('List View')); ?>"><i class="ti ti-list"></i></a>
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
            <?php if(Auth::user()->type == 'company'): ?>
                <a href="<?php echo e(route('userlogs.index')); ?>" class="btn btn-sm btn-primary btn-icon m-1" data-size="lg"
                    data-bs-whatever="<?php echo e(__('UserlogDetail')); ?>"> <span class="text-white">
                        <i class="ti ti-user" data-bs-toggle="tooltip"
                            data-bs-original-title="<?php echo e(__('Userlog Detail')); ?>"></i></span>
                </a>
            <?php endif; ?>
        </div>
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
<?php $__env->startSection('content'); ?>
    <div class="row user-card-row">
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-xxl-3 col-lg-4 col-sm-6">
                <div class="user-card card">
                    <?php if(\Auth::user()->type == 'super admin'): ?>
                        
                        <div class="card-header border-0 pb-0">
                            <div class="card-header-right">
                                <div class="btn-group card-option">
                                    <?php if($user->admin_enable == 'on'): ?>
                                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="feather icon-more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu icon-dropdown dropdown-menu-end">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit user')): ?>
                                                <a href="#" class="dropdown-item user-drop"
                                                    data-url="<?php echo e(route('users.edit', $user->id)); ?>" data-ajax-popup="true"
                                                    title="<?php echo e(__('Update Company')); ?>" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-title="<?php echo e(__('Update Company')); ?>"><i
                                                        class="ti ti-pencil"></i><span><?php echo e(__('Edit')); ?></span></a>
                                                <a href="#" data-url="<?php echo e(route('plan.upgrade', $user->id)); ?>"
                                                    class="dropdown-item user-drop" data-size="lg" data-bs-placement="top"
                                                    data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Upgrade Plan')); ?>"
                                                    data-ajax-popup="true" data-title="<?php echo e(__('Upgrade Plan')); ?>"><i
                                                        class="ti ti-trophy"></i><span><?php echo e(__('Upgrade Plan')); ?></span></a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('change password account')): ?>
                                                <a href="#" class="dropdown-item user-drop" data-ajax-popup="true"
                                                    data-title="<?php echo e(__('Reset Password')); ?>" title="<?php echo e(__('Reset Password')); ?>"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-url="<?php echo e(route('user.reset', \Crypt::encrypt($user->id))); ?>"><i
                                                        class="ti ti-key"></i>
                                                    <span><?php echo e(__('Reset Password')); ?></span></a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete user')): ?>
                                                <a href="#" class="bs-pass-para dropdown-item user-drop"
                                                    data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                    data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                    data-confirm-yes="delete-form-<?php echo e($user->id); ?>"
                                                    title="<?php echo e(__('Delete')); ?>" data-bs-toggle="tooltip"
                                                    data-bs-placement="top"><i
                                                        class="ti ti-trash"></i><span><?php echo e(__('Delete')); ?></span></a>
                                                <?php echo Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['users.destroy', $user->id],
                                                    'id' => 'delete-form-' . $user->id,
                                                ]); ?>

                                                <?php echo Form::close(); ?>

                                            <?php endif; ?>
                                            <a href="<?php echo e(route('login.with.company', $user->id)); ?>"
                                                class="dropdown-item user-drop" title="<?php echo e(__('Login As Company')); ?>"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-original-title="<?php echo e(__('Login As Company')); ?>">
                                                <i class="ti ti-replace"></i>
                                                <span> <?php echo e(__('Login As Company')); ?></span>
                                            </a>
                                            <?php if($user->is_enable_login == 1): ?>
                                                <a href="<?php echo e(route('users.login', \Crypt::encrypt($user->id))); ?>"
                                                    class="dropdown-item user-drop" title="<?php echo e(__('Login Disable')); ?>"
                                                    data-bs-toggle="tooltip" data-bs-placement="top">
                                                    <i class="ti ti-road-sign"></i>
                                                    <span class="text-danger"> <?php echo e(__('Login Disable')); ?></span>
                                                </a>
                                            <?php elseif($user->is_enable_login == 0 && $user->password == null): ?>
                                                <a href="#"
                                                    data-url="<?php echo e(route('user.reset', \Crypt::encrypt($user->id))); ?>"
                                                    data-ajax-popup="true" data-size="md"
                                                    title="<?php echo e(__('Login Enable')); ?>" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" class="dropdown-item login_enable user-drop"
                                                    data-title="<?php echo e(__('New Password')); ?>">
                                                    <i class="ti ti-road-sign"></i>
                                                    <span class="text-success"> <?php echo e(__('Login Enable')); ?></span>
                                                </a>
                                            <?php else: ?>
                                                <a href="<?php echo e(route('users.login', \Crypt::encrypt($user->id))); ?>"
                                                    class="dropdown-item user-drop" title="<?php echo e(__('Login Enable')); ?>"
                                                    data-bs-toggle="tooltip" data-bs-placement="top">
                                                    <i class="ti ti-road-sign"></i>
                                                    <span class="text-success"> <?php echo e(__('Login Enable')); ?></span>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    <?php else: ?>
                                        <div class="text-center">
                                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="ti ti-lock"></i>
                                            </button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <a href="<?php echo e(!empty($user->avatar) ? $profile . $user->avatar : asset(Storage::url('uploads/avatar/avatar.png'))); ?>"
                                target="_blank" class="user-image rounded border-2 border border-primary m-auto">
                                <img src="<?php echo e(!empty($user->avatar) ? $profile . $user->avatar : asset(Storage::url('uploads/avatar/avatar.png'))); ?>"
                                    class="h-100 w-100">
                            </a>
                            <div class="user-content mt-3">
                                <h5 class="mb-1"><?php echo e($user->name); ?></h5>
                                <small><?php echo e($user->email); ?></small>
                            </div>
                            <div class="card mb-0 mt-3">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <h6 class="mb-1"><?php echo e($user->getTotalBusiness()); ?></h6>
                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Businesses')); ?></p>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="mb-1"><?php echo e($user->getTotalAppoinments()); ?></h6>
                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Appointments')); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="actions d-flex mb-1">
                                        <span class="d-block text-sm text-muted"> <?php echo e(__('Plan')); ?> :
                                            <?php echo e(!empty($user->currentPlan) ? $user->currentPlan->name : ''); ?></span>
                                    </div>
                                    <div class="actions d-flex">
                                        <span class="d-block text-sm text-muted"> <?php echo e(__('Plan Expired')); ?> :
                                            <?php echo e(!empty($user->plan_expire_date) ? \Auth::user()->dateFormat($user->plan_expire_date) : __('Lifetime')); ?></span>
                                    </div>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="#" data-url="<?php echo e(route('business.upgrade', $user->id)); ?>"
                                        class="btn btn-outline-primary px-3" data-size="lg" data-bs-placement="top"
                                        data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Company Info')); ?>"
                                        data-ajax-popup="true"
                                        data-title="<?php echo e(__('Company Info')); ?>"><?php echo e(__('Admin Hub')); ?></a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if(Auth::user()->type != 'super admin'): ?>
                        
                        <div class="card-header p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">
                                    <div class="badge p-2 px-3 bg-primary"><?php echo e(ucfirst($user->type)); ?></div>
                                </h6>
                            </div>
                            <div class="card-header-right">
                                <div class="btn-group card-option">
                                    <?php if($user->admin_enable == 'on'): ?>
                                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="feather icon-more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu icon-dropdown dropdown-menu-end">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit user')): ?>
                                                <a href="#" class="dropdown-item user-drop"
                                                    data-url="<?php echo e(route('users.edit', $user->id)); ?>" data-ajax-popup="true"
                                                    title="<?php echo e(__('Update User')); ?>" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-title="<?php echo e(__('Update User')); ?>"><i
                                                        class="ti ti-pencil"></i><span><?php echo e(__('Edit')); ?></span></a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('change password account')): ?>
                                                <a href="#" class="dropdown-item user-drop" data-ajax-popup="true"
                                                    data-title="<?php echo e(__('Reset Password')); ?>"
                                                    title="<?php echo e(__('Reset Password')); ?>" data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    data-url="<?php echo e(route('user.reset', \Crypt::encrypt($user->id))); ?>"><i
                                                        class="ti ti-key"></i>
                                                    <span><?php echo e(__('Reset Password')); ?></span></a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete user')): ?>
                                                <a href="#" class="bs-pass-para dropdown-item user-drop"
                                                    data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                    data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                    data-confirm-yes="delete-form-<?php echo e($user->id); ?>"
                                                    title="<?php echo e(__('Delete')); ?>" data-bs-toggle="tooltip"
                                                    data-bs-placement="top"><i
                                                        class="ti ti-trash"></i><span><?php echo e(__('Delete')); ?></span></a>
                                                <?php echo Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['users.destroy', $user->id],
                                                    'id' => 'delete-form-' . $user->id,
                                                ]); ?>

                                                <?php echo Form::close(); ?>

                                            <?php endif; ?>
                                            <a href="<?php echo e(route('userlogs.index', ['month' => '', 'user' => $user->id])); ?>"
                                                class="dropdown-item user-drop" data-bs-toggle="tooltip"
                                                data-bs-original-title="<?php echo e(__('User Log')); ?>">
                                                <i class="ti ti-history"></i>
                                                <span><?php echo e(__('Logged Details')); ?></span></a>
                                            <?php if($user->is_enable_login == 1): ?>
                                                <a href="<?php echo e(route('users.login', \Crypt::encrypt($user->id))); ?>"
                                                    class="dropdown-item user-drop" title="<?php echo e(__('Login Disable')); ?>"
                                                    data-bs-toggle="tooltip" data-bs-placement="top">
                                                    <i class="ti ti-road-sign"></i>
                                                    <span class="text-danger"> <?php echo e(__('Login Disable')); ?></span>
                                                </a>
                                            <?php elseif($user->is_enable_login == 0 && $user->password == null): ?>
                                                <a href="#"
                                                    data-url="<?php echo e(route('user.reset', \Crypt::encrypt($user->id))); ?>"
                                                    data-ajax-popup="true" data-size="md"
                                                    title="<?php echo e(__('Login Enable')); ?>" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" class="dropdown-item login_enable user-drop"
                                                    data-title="<?php echo e(__('New Password')); ?>">
                                                    <i class="ti ti-road-sign"></i>
                                                    <span class="text-success"> <?php echo e(__('Login Enable')); ?></span>
                                                </a>
                                            <?php else: ?>
                                                <a href="<?php echo e(route('users.login', \Crypt::encrypt($user->id))); ?>"
                                                    class="dropdown-item user-drop" title="<?php echo e(__('Login Enable')); ?>"
                                                    data-bs-toggle="tooltip" data-bs-placement="top">
                                                    <i class="ti ti-road-sign"></i>
                                                    <span class="text-success"> <?php echo e(__('Login Enable')); ?></span>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    <?php else: ?>
                                        <div class="text-center">
                                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="ti ti-lock"></i>
                                            </button>
                                        </div>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="user-img-wrp d-flex align-items-center">
                                <a href="<?php echo e(!empty($user->avatar) ? asset(Storage::url('uploads/avatar/' . $user->avatar)) : asset(Storage::url('uploads/avatar/avatar.png'))); ?>"
                                    class="user-image rounded border-2 border border-primary">
                                    <img src="<?php echo e(!empty($user->avatar) ? asset(Storage::url('uploads/avatar/' . $user->avatar)) : asset(Storage::url('uploads/avatar/avatar.png'))); ?>"
                                        class="h-100 w-100">
                                </a>
                                <div class="user-content">
                                    <h5 class="mb-1"><?php echo e($user->name); ?></h5>
                                    <small><?php echo e($user->email); ?></small>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create user')): ?>
            <?php if(Auth::user()->type == 'super admin'): ?>
                <div class="col-xxl-3 col-lg-4 col-sm-6">
                    <a href="#" class="btn-addnew-project border-primary" data-ajax-popup="true" data-size="md"
                        data-title="<?php echo e(__('Create New Company')); ?>" data-url="<?php echo e(route('users.create')); ?>">
                        <div class="badge bg-primary proj-add-icon" data-bs-placement="top" data-bs-toggle="tooltip"
                            data-bs-original-title="<?php echo e(__('Create New Company')); ?>">
                            <i class="ti ti-plus"></i>
                        </div>
                        <h6 class="mt-2 mb-2"><?php echo e(__('New Company')); ?></h6>
                        <p class="text-muted text-center mb-0"><?php echo e(__('Click here to add New Company')); ?></p>
                    </a>
                </div>
            <?php else: ?>
                <div class="col-xxl-3 col-lg-4 col-sm-6">
                    <a href="#" class="btn-addnew-project border-primary" data-ajax-popup="true" data-size="md"
                        data-title="<?php echo e(__('Create New User')); ?>" data-url="<?php echo e(route('users.create')); ?>">
                        <div class="badge bg-primary proj-add-icon" data-bs-placement="top" data-bs-toggle="tooltip"
                            data-bs-original-title="<?php echo e(__('Create New User')); ?>">
                            <i class="ti ti-plus"></i>
                        </div>
                        <h6 class="mt-2 mb-2"><?php echo e(__('New User')); ?></h6>
                        <p class="text-muted text-center mb-0"><?php echo e(__('Click here to add New User')); ?></p>
                    </a>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>  
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/user/index.blade.php ENDPATH**/ ?>