<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Referral Program')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Referral Program')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Referral Program')); ?>

<?php $__env->stopSection(); ?>
<?php
    $admin_payment_setting = \App\Models\Utility::getAdminPaymentSetting();
?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="row">

                <div class="col-xl-3">
                    <div class="card sticky-top mb-xl-0" style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            <a href="#transaction" data-tab="transaction"
                                class="list-group-item list-group-item-action active
                     border-0 tab-link"><?php echo e(__('Transaction')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#payout_request" data-tab="payout_request"
                                class="list-group-item list-group-item-action border-0 tab-link "><?php echo e(__('Payout Request')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#settings" data-tab="settings"
                                class="list-group-item list-group-item-action border-0  tab-link"><?php echo e(__('Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div id="transaction" class="card mb-0 tab-content">
                        <div class="card-header">
                            <h5><?php echo e(__('Transaction')); ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="pc-dt-simple">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th> <?php echo e(__('Company Name')); ?></th>
                                            <th> <?php echo e(__('Referral Company Name')); ?></th>
                                            <th> <?php echo e(__('Plan Name')); ?></th>
                                            <th> <?php echo e(__('Plan Price')); ?></th>
                                            <th> <?php echo e(__('Comission(%)')); ?></th>
                                            <th> <?php echo e(__('Comission Amount')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $transactionDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td> <?php echo e(++$key); ?> </td>
                                                <td><?php echo e($transaction->getreferralUser($transaction->referral_code)); ?></td>
                                                <td><?php echo e(!empty($transaction->getUser) ? $transaction->getUser->name : '-'); ?>

                                                </td>
                                                <td><?php echo e(!empty($transaction->getPlan) ? $transaction->getPlan->name : '-'); ?>

                                                </td>
                                                <td><?php echo e($admin_payment_setting['CURRENCY_SYMBOL'] . $transaction->plan_price); ?>

                                                </td>
                                                <td><?php echo e($transaction->commission ? $transaction->commission : ''); ?>

                                                </td>
                                                <td><?php echo e($admin_payment_setting['CURRENCY_SYMBOL'] . ($transaction->plan_price * $transaction->commission) / 100); ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="payout_request" class="card mb-0 tab-content d-none">
                        <div class="card-header">
                            <h5><?php echo e(__('Payout Request')); ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th> <?php echo e(__('Company Name')); ?></th>
                                            <th> <?php echo e(__('Requested Date')); ?></th>
                                            <th> <?php echo e(__('Requested Amount')); ?></th>
                                            <th> <?php echo e(__('Action')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $payRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td> <?php echo e(++$key); ?> </td>
                                                <td><?php echo e(!empty($transaction->getCompany) ? $transaction->getCompany->name : '-'); ?>

                                                </td>
                                                <td><?php echo e($transaction->date); ?></td>
                                                <td><?php echo e($admin_payment_setting['CURRENCY_SYMBOL'] . $transaction->request_amount); ?>

                                                </td>
                                                <td class="d-flex">
                                                    <a href="<?php echo e(route('request.amount.status', [$transaction->id, 1])); ?>"
                                                        class="btn btn-success btn-sm me-2" data-bs-placement="top" data-bs-toggle="tooltip"
                                                        title="<?php echo e(__('Accept')); ?>"
                                                        data-bs-original-title="<?php echo e(__('Accept')); ?>">
                                                        <i class="ti ti-check"></i>
                                                    </a>
                                                    <a href="<?php echo e(route('request.amount.status', [$transaction->id, 0])); ?>"
                                                        class="btn btn-danger btn-sm" data-bs-toggle="tooltip"
                                                        data-bs-original-title="<?php echo e(__('Reject')); ?>" title="<?php echo e(__('Reject')); ?>">
                                                        <i class="ti ti-x"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="settings" class="card mb-0 text-white tab-content d-none">
                        <?php echo e(Form::open(['url' => route('referral.store'), 'enctype' => 'multipart/form-data','class' => 'needs-validation', 'novalidate'])); ?>

                        <div class="card-header d-flex align-items-center justify-content-between gap-2">
                            <h5 class=""><?php echo e(__('Settings')); ?></h5>
                            <div class="form-check form-switch custom-switch-v1" onclick="enableSettings()">
                                <input type="hidden" name="is_comission_setting" value="off">
                                <input type="checkbox" name="is_comission_setting" id="is_comission_setting"  class="form-check-input input-primary"
                                    <?php echo e(isset($referralSetting->is_enable) && $referralSetting->is_enable == 1 ? 'checked="checked"' : ''); ?> required="required">
                            </div>
                        </div>
                        <div class="card-body referralDiv <?php if(isset($referralSetting->is_enable) && $referralSetting->is_enable == 0): ?> disabledCookie <?php endif; ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label h6"><?php echo e(__('Commission Percentage(%)')); ?></label><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
                                        <input type="text" name="commission" class="form-control"
                                            placeholder="Enter Commission Percentage"
                                            value="<?php echo e(isset($referralSetting->commision) ? $referralSetting->commision : null); ?>" required="required">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label h6"><?php echo e(__('Minimum Threshold Amount')); ?></label><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
                                        <input type="text" name="threshold_amount" class="form-control"
                                            placeholder="Enter Minimum Threshold Amount"
                                            value="<?php echo e(isset($referralSetting->threshold_amount) ? $referralSetting->threshold_amount : null); ?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label h6"><?php echo e(__('GuideLines')); ?></label><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
                                        <textarea class="summernote" row="10" cols="50" id="note" name="guideline"><?php echo isset($referralSetting->guidelines) ? $referralSetting->guidelines : null; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer border-0 p-1 text-end">
                                <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-lg btn-primary'])); ?>

                            </div>
                        </div>

                        <?php echo e(Form::close()); ?>

                    </div>


                </div>


            </div>

            <!-- [ sample-page ] end -->
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-scripts'); ?>
    <script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>
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
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 200,
        })

        $('.tab-link').on('click', function() {
            var tabId = $(this).data('tab');

            $('.tab-content').addClass('d-none');
            $('#' + tabId).removeClass('d-none');

            $('.tab-link').removeClass('active');
            $(this).addClass('active');
        });
    </script>
    <script type="text/javascript">
        $('.cp_link').on('click', function() {
            var value = $(this).attr('data-link');
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(value).select();
            document.execCommand("copy");
            $temp.remove();
            toastrs('<?php echo e(__('Success')); ?>', '<?php echo e(__('Link Copy on Clipboard')); ?>', 'success');
        });
    </script>
     <script type="text/javascript">
        function enableSettings() {
            const element = $('#is_comission_setting').is(':checked');
            $('.referralDiv').addClass('disabledCookie');
            if (element == true) {
                $('.referralDiv').removeClass('disabledCookie');
                $("#cookie_logging").attr('checked', true);
            } else {
                $('.referralDiv').addClass('disabledCookie');
                $("#cookie_logging").attr('checked', false);
            }
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/referral/index.blade.php ENDPATH**/ ?>