<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Landing Page')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Landing Page')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Landing Page')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>

<link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>

<?php

    $settings = \Modules\LandingPage\Entities\LandingPageSetting::settings();
    $logo = \App\Models\Utility::get_file('uploads/landing_page_image');

?>

<?php $__env->startPush('custom-scripts'); ?>
    <script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>
    <script>
    $(document).ready(function() {
                $('.summernote').summernote({
                    height: 200,
                });
            });
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Landing Page')); ?></li>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card mb-xl-0 sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">

                            <?php echo $__env->make('landingpage::layouts.tab', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                        </div>
                    </div>
                </div>

                <div class="col-xl-9">
                    

                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-10">
                                    <h5><?php echo e(__('Custom Page')); ?></h5>
                                </div>
                            </div>
                        </div>

                        <?php echo e(Form::open(['route' => 'custom_store', 'method' => 'post', 'enctype' => 'multipart/form-data','class' => 'needs-validation', 'novalidate'])); ?>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-md-0">
                                        <?php echo e(Form::label('Site Logo', __('Site Logo'), ['class' => 'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaleab1765d328ab3f8835fc5d78676a070 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.required','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('required'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaleab1765d328ab3f8835fc5d78676a070)): ?>
<?php $attributes = $__attributesOriginaleab1765d328ab3f8835fc5d78676a070; ?>
<?php unset($__attributesOriginaleab1765d328ab3f8835fc5d78676a070); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaleab1765d328ab3f8835fc5d78676a070)): ?>
<?php $component = $__componentOriginaleab1765d328ab3f8835fc5d78676a070; ?>
<?php unset($__componentOriginaleab1765d328ab3f8835fc5d78676a070); ?>
<?php endif; ?>
                                        <div class="logo-content mt-4">
                                            <img id="image" src="<?php echo e($logo . '/' . $settings['site_logo'].'?'.time()); ?>"
                                                class="big-logo" style="filter: drop-shadow(2px 3px 7px #011C4B);"  width="150px">
                                        </div>
                                        <div class="choose-files mt-4">
                                            <label for="site_logo">
                                                <div class=" bg-primary company_logo_update" style="cursor: pointer;">
                                                    <i class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                </div>
                                                <input type="file" name="site_logo" id="site_logo"
                                                    class="form-control file d-none" data-filename="site_logo"  width="150px"
                                                    onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                                            </label>
                                        </div>
                                        <?php $__errorArgs = ['site_logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="row">
                                                <span class="invalid-logo" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            </div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group mb-0">
                                        <?php echo e(Form::label('Site Description', __('Site Description'), ['class' => 'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaleab1765d328ab3f8835fc5d78676a070 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.required','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('required'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaleab1765d328ab3f8835fc5d78676a070)): ?>
<?php $attributes = $__attributesOriginaleab1765d328ab3f8835fc5d78676a070; ?>
<?php unset($__attributesOriginaleab1765d328ab3f8835fc5d78676a070); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaleab1765d328ab3f8835fc5d78676a070)): ?>
<?php $component = $__componentOriginaleab1765d328ab3f8835fc5d78676a070; ?>
<?php unset($__componentOriginaleab1765d328ab3f8835fc5d78676a070); ?>
<?php endif; ?>
                                        <?php echo e(Form::text('site_description', $settings['site_description'], ['class' => 'form-control', 'placeholder' => __('Enter Description'),'required'=>'required'])); ?>

                                        <?php $__errorArgs = ['mail_port'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_port" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <input class="btn btn-print-invoice btn-primary" type="submit"
                                value="<?php echo e(__('Save Changes')); ?>">
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>


                    <div class="card mb-0">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-lg-9 col-md-9 col-sm-9">
                                    <h5><?php echo e(__('Menu Bar')); ?></h5>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 justify-content-end d-flex">
                                    <a data-size="lg" data-url="<?php echo e(route('custom_page.create')); ?>" data-ajax-popup="true"
                                        data-bs-toggle="tooltip"  data-bs-placement="top" data-title="<?php echo e(__('Create Menu Bar')); ?>" title="<?php echo e(__('Create Menu Bar')); ?>"
                                        class="btn btn-sm btn-primary">
                                        <i class="ti ti-plus text-light"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('No')); ?></th>
                                            <th><?php echo e(__('Name')); ?></th>
                                            <th><?php echo e(__('Action')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(is_array($pages) || is_object($pages)): ?>
                                            <?php
                                                $no = 1;
                                            ?>

                                            <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($no++); ?></td>
                                                    <td><?php echo e($value['menubar_page_name']); ?></td>
                                                    <td>
                                                        <span>
                                                            <div class="action-btn me-2">
                                                                <a href="#" class="mx-3 bg-info btn btn-sm align-items-center"
                                                                    data-url="<?php echo e(route('custom_page.edit', $key)); ?>"
                                                                    data-ajax-popup="true"
                                                                    data-title="<?php echo e(__('Edit Menu Bar')); ?>" data-size="lg"
                                                                    data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>"
                                                                    data-original-title="<?php echo e(__('Edit')); ?>">
                                                                    <i class="ti ti-pencil text-white"></i>
                                                                </a>
                                                            </div>
                                                            <?php if($value['page_slug'] != 'terms_and_conditions' && $value['page_slug'] != 'about_us' && $value['page_slug'] != 'privacy_policy'): ?>
                                                                <div class="action-btn me-2">
                                                                    <a href="#"
                                                                        class="bs-pass-para bg-danger mx-3 btn btn-sm d-inline-flex align-items-center"
                                                                        data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                                        data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                                        data-confirm-yes="delete-form-<?php echo e($key); ?>"
                                                                        title="<?php echo e(__('Delete')); ?>" data-bs-toggle="tooltip"
                                                                        data-bs-placement="top"><span class="text-white"><i
                                                                                class="ti ti-trash"></i></span></a>
                                                                </div>
                                                                <?php echo Form::open([
                                                                    'method' => 'DELETE',
                                                                    'route' => ['custom_page.destroy', $key],
                                                                    'id' => 'delete-form-' . $key,
                                                                ]); ?>

                                                                <?php echo Form::close(); ?>

                                                            </div>
                                                            <?php endif; ?>
                                                        </span>
                                                    </td>

                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/Modules/LandingPage/Resources/views/landingpage/menubar/index.blade.php ENDPATH**/ ?>