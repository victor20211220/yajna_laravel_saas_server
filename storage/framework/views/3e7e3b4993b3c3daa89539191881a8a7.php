<?php
    use App\Models\Utility;
    $chatgpt_setting = App\Models\Utility::chatgpt_setting(\Auth::user()->creatorId());
?>
<?php echo e(Form::model($plan, ['route' => ['plans.update', $plan->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data','class' => 'needs-validation', 'novalidate'])); ?>

<?php if(isset($chatgpt_setting['chatgpt_key']) && !empty($chatgpt_setting['chatgpt_key'])): ?>
<div class="col-xl-12 col-lg-12 col-md-12 d-flex align-items-center justify-content-between justify-content-md-end mb-3"" data-bs-placement="top">
        <a href="javascript:void(0)" data-size="lg" class="btn btn-sm btn-primary" data-ajax-popup-over="true"
            data-url="<?php echo e(route('generate', ['plan'])); ?>" data-bs-toggle="tooltip" data-bs-placement="top"
            title="<?php echo e(__('Generate')); ?>" data-title="<?php echo e(__('Generate content with AI')); ?>">
            <i class="fas fa-robot"></i>&nbsp;<?php echo e(__('Generate with AI')); ?>

        </a>
    </div>
<?php endif; ?>
<div class="row">
    <div class="form-group col-md-6">
        <?php echo e(Form::label('name', __('Name'), ['class' => 'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
        <?php echo e(Form::text('name', null, ['class' => 'form-control font-style', 'placeholder' => __('Enter Plan Name'), 'required' => 'required'])); ?>

    </div>
    <?php if($plan->id != 1): ?>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('price', __('Price'), ['class' => 'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
            <?php echo e(Form::number('price', null, ['class' => 'form-control', 'placeholder' => __('Enter Plan Price'), 'required' => 'required', 'min' => '1', 'step' => '0.01'])); ?>

        </div>
    <?php endif; ?>
    <div class="form-group col-md-6">
        <?php echo e(Form::label('duration', __('Duration'), ['class' => 'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
        <?php echo Form::select('duration', $arrDuration, null, ['class' => 'form-control select2', 'required' => 'required']); ?>

    </div>
    <div class="form-group col-md-6">
        <?php echo e(Form::label('max_users', __('Max User'), ['class' => 'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
        <?php echo e(Form::number('max_users', null, ['class' => 'form-control', 'placeholder' => __('Enter Max User Create Limit'), 'min' => '-1','required'=>'required'])); ?>

        <span class="small"><?php echo e(__('Note: "-1" for Unlimited')); ?></span>
    </div>
    <div class="form-group col-md-6">
        <?php echo e(Form::label('business', __('Max Business'), ['class' => 'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
        <?php echo e(Form::number('business', null, ['class' => 'form-control', 'placeholder' => __('Enter Max Business Create Limit'), 'min' => '-1','required'=>'required'])); ?>

        <span class="small"><?php echo e(__('Note: "-1" for Unlimited')); ?></span>
    </div>
    <div class="form-group col-md-6">
        <label for="storage_limit" class="form-label"><?php echo e(__('Storage limit')); ?></label><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
        <div class="input-group">
            <input class="form-control" required="required" name="storage_limit" type="number" id="storage_limit" min=1
                value="<?php echo e($plan->storage_limit); ?>">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2"><?php echo e(__('MB')); ?></span>
            </div>
        </div>
        <span class="small"><?php echo e(__('Note: upload size ( In MB)')); ?></span>
    </div>
    <?php if($plan['id'] == 1): ?>
        <div class="col-md-6">
        </div>
    <?php endif; ?>
    <div class="col-6">

        <div class="form-check form-switch custom-switch-v1">
            <input type="checkbox" class="form-check-input input-primary" name="enable_custdomain"
                id="enable_custdomain" <?php echo e($plan['enable_custdomain'] == 'on' ? 'checked=checked' : ''); ?>>
            <label class="form-check-label" for="enable_custdomain"><?php echo e(__('Enable Domain')); ?></label>
        </div>
    </div>
    <div class="col-6">
        <div class="form-check form-switch custom-switch-v1">
            <input type="checkbox" class="form-check-input input-primary" name="enable_custsubdomain"
                id="enable_custsubdomain" <?php echo e($plan['enable_custsubdomain'] == 'on' ? 'checked=checked' : ''); ?>>
            <label class="form-check-label" for="enable_custsubdomain"><?php echo e(__('Enable Sub Domain')); ?></label>
        </div>
    </div>
    <div class="col-6"><br>
        <div class="form-check form-switch custom-switch-v1">
            <input type="checkbox" class="form-check-input input-primary" name="enable_branding" id="enable_branding"
                <?php echo e($plan['enable_branding'] == 'on' ? 'checked=checked' : ''); ?>>
            <label class="form-check-label" for="enable_branding"><?php echo e(__('Enable Branding')); ?></label>
        </div>
    </div>
    <div class="col-6"><br>
        <div class="form-check form-switch custom-switch-v1">
            <input type="checkbox" class="form-check-input input-primary" name="pwa_business" id="pwa_business"
                <?php echo e($plan['pwa_business'] == 'on' ? 'checked=checked' : ''); ?>>
            <label class="branding-control-label form-control-label"
                for="pwa_business"><?php echo e(__('Progressive Web App (PWA)')); ?></label>
        </div>
    </div>

    <div class="col-6"><br>
        <div class="form-check form-switch custom-switch-v1">
            <input type="checkbox" class="form-check-input" name="enable_chatgpt" id="enable_chatgpt"
                <?php echo e($plan['enable_chatgpt'] == 'on' ? 'checked=checked' : ''); ?>>
            <label class="custom-control-label form-check-label"
                for="enable_chatgpt"><?php echo e(__('Enable Chatgpt')); ?></label>
        </div>
    </div>
    <?php if($plan['id'] != 1): ?>
        <div class="col-6"><br>
            <div class="form-check form-switch custom-switch-v1">
                <input type="checkbox" class="form-check-input" name="is_trial" id="trial"
                    <?php echo e($plan['is_trial'] == 'on' ? 'checked=checked' : ''); ?>>
                <label class="custom-control-label form-check-label" for="trial"><?php echo e(__('Is Trial Days')); ?></label>
            </div>
        </div>
        <div class="form-group col-md-6 trial_day_div">
            <?php echo e(Form::label('trial_day', __('Trial Days'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::number('trial_day', null, ['class' => 'form-control trial_day_input', 'min' => '0'])); ?>

        </div>
    <?php endif; ?>
    <?php if($plan['id'] != 1): ?>
        <?php if(count($modules) - 1): ?>
            <div class="horizontal mt-3">
                <div class="verticals twelve">
                    <div class="form-group col-md-6">
                        <?php echo e(Form::label('Select Themes', __('Add On'), ['class' => 'form-control-label'])); ?><br>
                        <small class="text-danger"><?php echo e(__('Note:Click to select add-on ')); ?></small>
                    </div>
                    <?php if(count($modules)): ?>
                         <ul class="uploaded-pics-module select-module-wrp">
                            <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($module->getName() != 'LandingPage'): ?>
                                    <?php if(in_array($module, \App\Models\Utility::getshowModuleList())): ?>
                                        <?php
                                            $id = strtolower(preg_replace('/\s+/', '_', $module->getName()));
                                            $path = $module->getPath() . '/module.json';
                                            $json = json_decode(file_get_contents($path), true);
                                        ?>
                                        <li>
                                            <input class="d-none form-check-input modules" name="modules[]"
                                                value="<?php echo e($module->getName()); ?>" id="checkthis<?php echo e($loop->index); ?>"
                                                <?php echo e(in_array($module->getName(), explode(',', $plan->module)) == true ? 'checked' : ''); ?>

                                                type="checkbox" id="modules">

                                            <label for="checkthis<?php echo e($loop->index); ?>"><img
                                                    src="<?php echo e(\App\Models\Utility::get_module_img($module->getName())); ?><?php echo e('?' . time()); ?>" /></label>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php else: ?>
                        <div class="col-lg-12 col-md-12">
                            <div class="card p-5">
                                <div class="d-flex justify-content-center">
                                    <div class="ms-3 text-center">
                                        <h3><?php echo e(__('Add-on Not Available')); ?></h3>
                                        <p class="text-muted"><?php echo e(__('Click ')); ?><a
                                                href="<?php echo e(route('module.index')); ?>"><?php echo e(__('here')); ?></a>
                                            <?php echo e(__('To Acctive Add-on')); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
<div class="horizontal mt-3 mb-3">
    <div class="verticals twelve">
        <div class="form-group col-md-6">
            <?php echo e(Form::label('Select Themes', __('Business Select Themes'), ['class' => 'form-label'])); ?>

        </div>
        <ul class="uploaded-pics select-module-wrp select-theme">
            <?php $__currentLoopData = \App\Models\Utility::themeOne(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    if (in_array($key, $plan->getThemes())) {
                        $checked = 'checked';
                    } else {
                        $checked = '';
                    }
                ?>
                <li>
                    <input type="checkbox" id="checkthis<?php echo e($loop->index); ?>" value="<?php echo e($key); ?>"
                        name="themes[]" <?php echo e($checked); ?> />
                    <label for="checkthis<?php echo e($loop->index); ?>"><img
                            src="<?php echo e(asset(Storage::url('uploads/card_theme/' . $key . '/color1.png'))); ?>" /></label>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>


</div>

<div class="form-group col-md-12">
    <?php echo e(Form::label('description', __('Description'), ['class' => 'form-label'])); ?>

    <?php echo Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3','placeholder'=>__('Enter Desciption')]); ?>

</div>

</div>
<div class="modal-footer p-0 pt-3">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
    <input class="btn btn-primary" type="submit" value="<?php echo e(__('Update')); ?>">
</div>
<?php echo e(Form::close()); ?>

<script>
    $(document).ready(function() {
        $('#enable_branding').trigger('change');
    });
    $(document).on('change', '#enable_branding', function(e) {
        $('.showbranding').hide();
        if ($("#enable_branding").prop('checked') == true) {
            $('.showbranding').show();
        }
    });
</script>
<script>
    $(document).ready(function() {
        var isTrialChecked = $('#trial').prop('checked');

        if (isTrialChecked) {
            $('.trial_day_div').show();
        } else {
            $('.trial_day_div').hide();
        }


        // Attach an event listener to the checkbox
        $('#trial').change(function() {
            if (this.checked) {
                // If checkbox is checked, show the trial day textbox
                $('.trial_day_div').show();
                $('.trial_day_input').prop('required', true);
            } else {
                // If checkbox is unchecked, hide the trial day textbox
                $('.trial_day_div').hide();
                $('.trial_day_input').prop('required', false);
            }
        });
    });
</script>
<?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/plan/edit.blade.php ENDPATH**/ ?>