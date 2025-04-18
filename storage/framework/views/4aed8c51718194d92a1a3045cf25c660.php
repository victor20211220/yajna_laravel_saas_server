<?php echo e(Form::open(['url' => route('campaigns.store'), 'enctype' => 'multipart/form-data','class' => 'needs-validation', 'novalidate'])); ?>

<div class="row">

  <div class="form-group col-md-12">
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
        <?php echo e(Form::text('name', null, ['class' => 'form-control font-style', 'required' => 'required', 'placeholder' => __('Enter Campaigns Name')])); ?>

    </div>
    <div class="form-group col-6">
        <?php echo e(Form::label('category', __('Category'), ['class' => 'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
        <?php echo Form::select('category', $category, null, [
            'class' => 'form-control select2 business_category ',
            'required' => 'required',
        ]); ?>

        <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <small class="invalid-role" role="alert">
                <strong class="text-danger"><?php echo e($message); ?></strong>
            </small>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    </div>

    <div class="form-group col-md-6">
        <?php echo e(Form::label('business', __('Business'), ['class' => 'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
        <?php echo Form::select('business', [], null, [
            'class' => 'form-control select2 ',
            'required' => 'required',
            'id' => 'business',
        ]); ?>

    </div>
    <div class="col-6 form-group">
        <?php echo e(Form::label('Start Date', __('Start Date'), ['class' => 'form-control-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
        <?php echo e(Form::date('start_date', null, ['class' => 'form-control mt-2 start_date', 'required' => 'required', 'min' => \Carbon\Carbon::now()->format('Y-m-d'), 'onchange' => 'updateEndDateMin()'])); ?>

        <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="invalid-favicon text-xs text-danger" role="alert"><?php echo e($message); ?></span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="col-6 form-group">
        <?php echo e(Form::label('End Date', __('End Date'), ['class' => 'form-control-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
        <?php echo e(Form::date('end_date', null, ['class' => 'form-control mt-2 end_date', 'required' => 'required'])); ?>

        <?php $__errorArgs = ['end_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="invalid-favicon text-xs text-danger" role="alert"><?php echo e($message); ?></span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="col-6 form-group">
        <?php echo e(Form::label('total_days', __('Total Days'), ['class' => 'form-label'])); ?>

        <?php echo e(Form::number('total_days', null, ['class' => 'form-control total_days', 'readonly' => 'readonly','placeholder'=>__('Total Days')])); ?>

        <?php $__errorArgs = ['total_days'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="invalid-favicon text-xs text-danger" role="alert"><?php echo e($message); ?></span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="col-6 form-group">
        <?php echo e(Form::label('total_cost', __('Total Cost'), ['class' => 'form-label'])); ?>

        <?php echo e(Form::number('total_cost', null, ['class' => 'form-control total_cost', 'readonly' => 'readonly','placeholder'=>__('Total Cost')])); ?>


        <?php $__errorArgs = ['total_cost'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="invalid-favicon text-xs text-danger" role="alert"><?php echo e($message); ?></span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="row coupon-div d-none">
        <div class="col-md-11">
            <div class="form-group">
                <label for="bank_coupon" class="form-label"><?php echo e(__('Coupon')); ?></label>
                <input type="text" id="bank_coupon" name="coupon" class="form-control coupon"
                    placeholder="<?php echo e(__('Enter Coupon Code')); ?>">
            </div>
        </div>
        <div class="col-1 my-auto">
            <a href="#" class="apply-btn btn btn-lg btn-primary btn-create apply-coupon-promote mt-2"
                data-bs-toggle="tooltip" data-bs-title="<?php echo e(__('Apply')); ?>"><span><i
                        data-feather="save"></i></span></a>
        </div>
        <small><?php echo e(__('After apply coupon the final cost is ::')); ?> <b> <span class="coupon-price">-</span></b> </small>
    </div>

    <div class="row form-group">
        <?php echo e(Form::label('total_cost', __('Payment Method'), ['class' => 'form-label'])); ?>

        <?php
            $enabledPayments = \App\Models\Utility::isEnablePayment();
        ?>
            <?php $__currentLoopData = $enabledPayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-12 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="ms-3">
                                        <label for="<?php echo e($payment); ?>-payment">
                                            <h5 class="mb-0 text-capitalize pointer payment-option"
                                                value="<?php echo e($payment); ?>"><?php echo e($payment); ?></h5>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input payment_method" name="payment_method"
                                        id="<?php echo e($payment); ?>-payment" type="radio" value="<?php echo e($payment); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<div class="modal-footer p-0 pt-3">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
    <input class="btn btn-primary" type="submit" value="<?php echo e(__('Create')); ?>">
</div>
<?php echo e(Form::close()); ?>

<script>
    var selectedBusinessId = '<?php echo e(isset($promoteData->business) ? $promoteData->business : 0); ?>';

    function getBusiness(category_id) {
        $.ajax({
            url: '<?php echo e(route('campaigns.business')); ?>',
            type: 'POST',
            data: {
                "category_id": category_id,
                "_token": "<?php echo e(csrf_token()); ?>",
            },
            success: function(data) {
                $('#business').empty();
                $('#business').append('<option value="">Select Business</option>');
                $.each(data, function(key, value) {
                    var selected = (key == selectedBusinessId) ? 'selected' : '';
                    $('#business').append('<option value="' + key + '" ' + selected + '>' + value +
                        '</option>');
                });
            }
        });
    }


    $(document).on('change', 'select[name=category]', function() {
        var category_id = $(this).val();
        getBusiness(category_id);
    });

    $(document).ready(function() {
        var initialCategoryId = '<?php echo e(isset($promoteData->category) ? $promoteData->category : 0); ?>';
        if (initialCategoryId) {
            getBusiness(initialCategoryId);
        }
    });

    function findPrice(total_days) {
        $.ajax({
            url: '<?php echo e(route('campaigns.costing')); ?>',
            type: 'POST',
            data: {
                "total_days": total_days,
                "_token": "<?php echo e(csrf_token()); ?>",
            },
            success: function(data) {
                if (data.costData && data.costData.price) {
                        $('.total_cost').val(data.costData.price*total_days);
                        $('.coupon-div').removeClass('d-none');
                    } else {
                        $('.total_cost').val('');
                        $('.coupon-div').addClass('d-none');
                    }
                }
            });
        }

        function calculateTotalDaysTotalCost() {
            var startDate = $('.start_date').val();
            var endDate = $('.end_date').val();

            if (startDate && endDate) {
                var startDateObj = new Date(startDate);
                var endDateObj = new Date(endDate);
                var timeDiff = endDateObj.getTime() - startDateObj.getTime();
                var totalDays = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
                $('.total_days').val(totalDays);
                findPrice(totalDays);
            } else {
                $('.total_days').val('');
            }
            var totalDays = parseInt($('.total_days').val(), 10);
        }
        $('.end_date, .start_date').change(calculateTotalDaysTotalCost);



        feather.replace();
        $(document).on('click', '.apply-coupon-promote', function() {
            var ele = $(this);
            var coupon = ele.closest('.row').find('.coupon').val();

            $.ajax({
                url: '<?php echo e(route('apply.coupon.promote')); ?>',
                type: 'GET',
                datType: 'json',
                data: {
                    coupon: coupon,
                    total_cost: $('.total_cost').val()
                },
                headers: {
                    'Content-Type': 'application/json'
                },
                success: function(data) {
                    if (data.is_success == true) {
                        $('.coupon-price').text(data.final_price);
                        $('.total_cost').val(data.price);
                        toastrs('<?php echo e(__('Success')); ?>', data.message, 'success');
                    } else if (data.is_success == false) {
                        toastrs('<?php echo e(__('Error')); ?>', data.message, 'error');
                    } else {
                        toastrs('<?php echo e(__('Error')); ?>', 'Coupon code is required', 'error');
                    }
                }
            })
        });

        function updateEndDateMin() {
            var startDate = document.querySelector('.start_date').value;
            document.querySelector('.end_date').min = startDate;
        }
</script>
<?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/campaigns/create.blade.php ENDPATH**/ ?>