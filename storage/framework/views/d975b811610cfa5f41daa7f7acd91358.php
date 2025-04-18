<?php echo e(Form::open(['url' => 'roles', 'method' => 'post', 'class' => 'needs-validation', 'novalidate'])); ?>

<div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
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
                <?php echo e(Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Role Name'), 'required' => 'required'])); ?>

                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-name text-danger text-xs" role="alert"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php if(!empty($permissions)): ?>
                <label for="permissions" class="col-form-label"><?php echo e(__('Assign Permission to Roles')); ?></label>
                <div class="table-responsive">
                    <table class="table create-role-table">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input align-middle"
                                            name="checkall" id="checkall">
                                    </div>
                                </th>
                                <th width="10%" class="text-dark"><?php echo e(__('Module')); ?></th>
                                <th class="text-dark ps-0"><?php echo e(__('Permissions')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $modules = [
                                    'dashboard',
                                    'user',
                                    'business',
                                    'appointment',
                                    'contact',
                                    'company setting',
                                ];
                            ?>
                            <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td width="5%">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input ischeck"
                                                name="checkall" data-id="<?php echo e(str_replace(' ', '', $module)); ?>">
                                        </div>
                                    </td>
                                    <td width="8%">
                                        <label class="ischeck"
                                            data-id="<?php echo e(str_replace(' ', '', $module)); ?>"><?php echo e(ucfirst($module)); ?></label>
                                    </td>
                                    <td>
                                        <div class="row y-2">
                                            <?php if(in_array('manage ' . $module, (array) $permissions)): ?>
                                                <?php if($key = array_search('manage ' . $module, $permissions)): ?>
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        <?php echo e(Form::checkbox('permissions[]', $key, false, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key])); ?>

                                                        <?php echo e(Form::label('permission' . $key, 'Manage', ['class' => 'form-check-label'])); ?><br>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if(in_array('create ' . $module, (array) $permissions)): ?>
                                                <?php if($key = array_search('create ' . $module, $permissions)): ?>
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        <?php echo e(Form::checkbox('permissions[]', $key, false, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key])); ?>

                                                        <?php echo e(Form::label('permission' . $key, 'Create', ['class' => 'form-check-label'])); ?><br>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if(in_array('duplicate ' . $module, (array) $permissions)): ?>
                                                <?php if($key = array_search('duplicate ' . $module, $permissions)): ?>
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        <?php echo e(Form::checkbox('permissions[]', $key, false, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key])); ?>

                                                        <?php echo e(Form::label('permission' . $key, 'duplicate', ['class' => 'form-check-label'])); ?><br>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if(in_array('edit ' . $module, (array) $permissions)): ?>
                                                <?php if($key = array_search('edit ' . $module, $permissions)): ?>
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        <?php echo e(Form::checkbox('permissions[]', $key, false, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key])); ?>

                                                        <?php echo e(Form::label('permission' . $key, 'Edit', ['class' => 'form-check-label'])); ?><br>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if(in_array('delete ' . $module, (array) $permissions)): ?>
                                                <?php if($key = array_search('delete ' . $module, $permissions)): ?>
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        <?php echo e(Form::checkbox('permissions[]', $key, false, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key])); ?>

                                                        <?php echo e(Form::label('permission' . $key, 'Delete', ['class' => 'form-check-label'])); ?><br>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if(in_array('show ' . $module, (array) $permissions)): ?>
                                                <?php if($key = array_search('show ' . $module, $permissions)): ?>
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        <?php echo e(Form::checkbox('permissions[]', $key, false, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key])); ?>

                                                        <?php echo e(Form::label('permission' . $key, 'Show', ['class' => 'form-check-label'])); ?><br>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if(in_array('view ' . $module, (array) $permissions)): ?>
                                                <?php if($key = array_search('view ' . $module, $permissions)): ?>
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        <?php echo e(Form::checkbox('permissions[]', $key, false, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key])); ?>

                                                        <?php echo e(Form::label('permission' . $key, 'View', ['class' => 'form-check-label'])); ?><br>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if(in_array('theme settings ' . $module, (array) $permissions)): ?>
                                                <?php if($key = array_search('theme settings ' . $module, $permissions)): ?>
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        <?php echo e(Form::checkbox('permissions[]', $key, false, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key])); ?>

                                                        <?php echo e(Form::label('permission' . $key, 'Theme settings', ['class' => 'form-check-label'])); ?><br>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if(in_array('custom settings ' . $module, (array) $permissions)): ?>
                                                <?php if($key = array_search('custom settings ' . $module, $permissions)): ?>
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        <?php echo e(Form::checkbox('permissions[]', $key, false, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key])); ?>

                                                        <?php echo e(Form::label('permission' . $key, 'Custom settings', ['class' => 'form-check-label'])); ?><br>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if(in_array('SEO settings ' . $module, (array) $permissions)): ?>
                                                <?php if($key = array_search('SEO settings ' . $module, $permissions)): ?>
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        <?php echo e(Form::checkbox('permissions[]', $key, false, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key])); ?>

                                                        <?php echo e(Form::label('permission' . $key, 'SEO settings', ['class' => 'form-check-label'])); ?><br>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if(in_array('block settings ' . $module, (array) $permissions)): ?>
                                                <?php if($key = array_search('block settings ' . $module, $permissions)): ?>
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        <?php echo e(Form::checkbox('permissions[]', $key, false, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key])); ?>

                                                        <?php echo e(Form::label('permission' . $key, 'Block settings', ['class' => 'form-check-label'])); ?><br>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if(in_array('PWA settings ' . $module, (array) $permissions)): ?>
                                                <?php if($key = array_search('PWA settings ' . $module, $permissions)): ?>
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        <?php echo e(Form::checkbox('permissions[]', $key, false, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key])); ?>

                                                        <?php echo e(Form::label('permission' . $key, 'PWA settings', ['class' => 'form-check-label'])); ?><br>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if(in_array('pixel settings ' . $module, (array) $permissions)): ?>
                                                <?php if($key = array_search('pixel settings ' . $module, $permissions)): ?>
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        <?php echo e(Form::checkbox('permissions[]', $key, false, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key])); ?>

                                                        <?php echo e(Form::label('permission' . $key, 'Pixel settings', ['class' => 'form-check-label'])); ?><br>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if(in_array('view analytics ' . $module, (array) $permissions)): ?>
                                                <?php if($key = array_search('view analytics ' . $module, $permissions)): ?>
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        <?php echo e(Form::checkbox('permissions[]', $key, false, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key])); ?>

                                                        <?php echo e(Form::label('permission' . $key, 'View Analytics', ['class' => 'form-check-label'])); ?><br>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                            <?php if(in_array('change password ' . $module, (array) $permissions)): ?>
                                                <?php if($key = array_search('change password ' . $module, $permissions)): ?>
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        <?php echo e(Form::checkbox('permissions[]', $key, false, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key])); ?>

                                                        <?php echo e(Form::label('permission' . $key, 'Change Password', ['class' => 'form-check-label'])); ?><br>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if(in_array('buy ' . $module, (array) $permissions)): ?>
                                                <?php if($key = array_search('buy ' . $module, $permissions)): ?>
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        <?php echo e(Form::checkbox('permissions[] isscheck isscheck_' . str_replace(' ', '', $module), $key, false, ['class' => 'form-check-input', 'id' => 'permission' . $key])); ?>

                                                        <?php echo e(Form::label('permission' . $key, 'Buy', ['class' => 'form-check-label'])); ?><br>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if(in_array('calendar ' . $module, (array) $permissions)): ?>
                                                <?php if($key = array_search('calendar ' . $module, $permissions)): ?>
                                                    <div class="col-lg-3 col-sm-6 col-12 form-check">
                                                        <?php echo e(Form::checkbox('permissions[] isscheck isscheck_' . str_replace(' ', '', $module), $key, false, ['class' => 'form-check-input', 'id' => 'permission' . $key])); ?>

                                                        <?php echo e(Form::label('permission' . $key, 'Calendar', ['class' => 'form-check-label'])); ?><br>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="modal-footer p-0 border-0">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-secondary" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn btn-primary ms-2">
</div>
<?php echo e(Form::close()); ?>


<script>
    $(document).ready(function() {
        $("#checkall").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        $(".ischeck").click(function() {
            var ischeck = $(this).data('id');
            $('.isscheck_' + ischeck).prop('checked', this.checked);
        });
    });
</script>
<?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/role/create.blade.php ENDPATH**/ ?>