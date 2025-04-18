<?php
    $profile=asset(Storage::url('uploads/avatar/'));
    $chatgpt_setting= \App\Models\Utility::chatgpt_setting(\Auth::user()->creatorId());
?>
<?php $__env->startSection('page-title'); ?>
   <?php echo e(__('Manage Users')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e($emailTemplate->name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Email Template')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
<div class="row">
    <div class="text-end">
        <div class="text-end">
            <div class="d-flex justify-content-end drp-languages">
                <?php if(isset($chatgpt_setting['chatgpt_key']) && (!empty($chatgpt_setting['chatgpt_key']))): ?>
                <div class="col-xl-12 col-lg-12 col-md-12 d-flex align-items-center justify-content-between justify-content-md-end"
                    data-bs-placement="top">
                    <a href="javascript:void(0)" data-size="lg" class="btn btn-sm btn-primary" data-ajax-popup-over="true"
                        data-url="<?php echo e(route('generate', ['email template'])); ?>" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="<?php echo e(__('Generate')); ?>" data-title="<?php echo e(__('Generate content with AI')); ?>">
                        <i class="fas fa-robot"></i>&nbsp;<?php echo e(__('Generate with AI')); ?>

                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="row invoice-row">
    <div class="col-lg-4 col-md-5 col-12">
        <div class="card mb-0 h-100">
            <div class="card-header card-body">
                <h5></h5>
                <?php echo e(Form::model($emailTemplate, array('route' => array('email-templates.update', $emailTemplate->id), 'method' => 'PUT'))); ?>

                <div class="row">
                    <div class="form-group col-md-12">
                        <?php echo e(Form::label('name',__('Name'),['class'=>'form-label text-dark'])); ?>

                        <?php echo e(Form::text('name',null,array('class'=>'form-control font-style','disabled'=>'disabled'))); ?>

                    </div>
                    <div class="form-group col-md-12">
                        <?php echo e(Form::label('from',__('From'),['class'=>'form-label text-dark'])); ?>

                        <?php echo e(Form::text('from',null,array('class'=>'form-control font-style','required'=>'required'))); ?>

                    </div>
                    <?php echo e(Form::hidden('lang',$currEmailTempLang->lang,array('class'=>''))); ?>

                    <div class="col-12 text-end">
                        <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn btn-print-invoice  btn-primary m-r-10">
                    </div>
                </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-7 col-12">
        <div class="card mb-0 h-100">
            <div class="card-body">
                <h5></h5>
                <div class="row text-xs">
                    <h6 class="font-weight-bold mb-4"><?php echo e(__('Variables')); ?></h6>
                    <div>
                        <?php if($emailTemplate->name == 'User Created'): ?>
                            <p class="mb-1"><?php echo e(__('App URL')); ?> : <span
                                    class="pull-right text-primary">{app_url}</span></p>
                            <p class="mb-1"><?php echo e(__('User Name')); ?> : <span
                                    class="pull-right text-primary">{user_name}</span></p>
                            <p class="mb-1"><?php echo e(__('User Email')); ?> : <span
                                    class="pull-right text-primary">{user_email}</span></p>
                            <p class="mb-1"><?php echo e(__('User Password')); ?> : <span
                                    class="pull-right text-primary">{user_password}</span></p>
                            <p class="mb-1"><?php echo e(__('User Type')); ?> : <span
                                    class="pull-right text-primary">{user_type}</span></p>
                        <?php elseif($emailTemplate->name == 'Appointment Created'): ?>
                            <p class="mb-1"><?php echo e(__('App Name')); ?> : <span
                                    class="pull-right text-primary">{app_name}</span></p>
                            <p class="mb-1"><?php echo e(__('Appointment Name')); ?> : <span
                                    class="pull-right text-primary">{appointment_name}</span></p>
                            <p class="mb-1"><?php echo e(__('Appointment Email')); ?> : <span
                                    class="pull-right text-primary">{appointment_email}</span></p>
                            <p class="mb-1"><?php echo e(__('Appointment Phone')); ?> : <span
                                    class="pull-right text-primary">{appointment_phone}</span></p>
                            <p class="mb-1"><?php echo e(__('Appointment Date')); ?> : <span
                                    class="pull-right text-primary">{appointment_date}</span></p>
                            <p class="mb-1"><?php echo e(__('Appointment Time')); ?> : <span
                                    class="pull-right text-primary">{appointment_time}</span></p>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <h5></h5>
            <div class="row row-gap">
                <div class="col-md-3 col-sm-4">
                    <div class="card sticky-top language-sidebar mb-0">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a class="list-group-item list-group-item-action border-0 <?php echo e(($currEmailTempLang->lang == $key)?'active':''); ?>" href="<?php echo e(route('manage.email.language',[$emailTemplate->id,$key])); ?>">
                                <?php echo e(Str::ucfirst($lang)); ?>

                            </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    </div>

                <div class="col-md-9 col-sm-8">
                    <div class="card h-100 p-3">
                        <?php echo e(Form::model($currEmailTempLang, array('route' => array('updateEmail.settings',$currEmailTempLang->parent_id), 'method' => 'PUT'))); ?>

                            <div class="form-group col-12">
                                <?php echo e(Form::label('subject',__('Subject'),['class'=>'form-label text-dark'])); ?>

                                <?php echo e(Form::text('subject',null,array('class'=>'form-control font-style','required'=>'required'))); ?>

                            </div>
                            <div class="form-group col-12">
                                <?php echo e(Form::label('content',__('Email Message'),['class'=>'form-label text-dark'])); ?>

                                <?php echo e(Form::textarea('content',$currEmailTempLang->content,array('class'=>'summernote','id'=>'content','required'=>'required'))); ?>

                            </div>

                            <div class="col-md-12 text-end">
                                <?php echo e(Form::hidden('lang',null)); ?>

                                <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn btn-print-invoice  btn-primary m-r-10">
                            </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-scripts'); ?>
<script src="<?php echo e(asset('custom/libs/summernote/summernote-bs4.js')); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.summernote').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough']],
                ['list', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'unlink']],
            ],
            height: 250,
        });

    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/email_templates/show.blade.php ENDPATH**/ ?>