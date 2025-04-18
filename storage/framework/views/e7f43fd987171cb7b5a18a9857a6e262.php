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
                            <a href="#guideline" data-tab="guideline"
                                class="list-group-item list-group-item-action active tab-link
                     border-0"><?php echo e(__('GuideLine')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#referral_transaction" data-tab="referral_transaction"
                                class="list-group-item list-group-item-action border-0 tab-link "><?php echo e(__('Referral Transaction')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#payout" data-tab="payout"
                                class="list-group-item list-group-item-action border-0 tab-link "><?php echo e(__('Payout')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>

                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div id="guideline" class="card tab-content mb-0">
                        <div class="card-header">
                            <h5><?php echo e(__('GuideLine')); ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <div class="border rounded p-3 mb-0">
                                        <div class="form-group">
                                            <h4><?php echo e(__('Refer ' . \Auth::user()->name . ' and earn ') . (isset($admin_payment_setting['CURRENCY_SYMBOL']) ? $admin_payment_setting['CURRENCY_SYMBOL'] : '$') . ($referralSetting ? $referralSetting->threshold_amount : null) . __(' per paid signup! ')); ?>

                                            </h4>
                                            <div class="ps-3">
                                                <?php echo $referralSetting ? $referralSetting->guidelines : null; ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group border rounded p-3 mb-0 d-flex flex-column justify-content-center h-100">
                                        <h4 class="text-center"><?php echo e(__('Share Your Link')); ?></h4>
                                        <?php if(isset($referralSetting->is_enable) && $referralSetting->is_enable == 0): ?>
                                            <small class=" text-danger"><?php echo e(__('Super admin has disabled the referral program.')); ?></small>
                                            <?php endif; ?>
                                            <a href="#!" class="btn btn-sm btn-light-primary w-100 cp_link d-flex align-items-center justify-content-center flex-wrap gap-1
                                             <?php if(isset($referralSetting->is_enable) && $referralSetting->is_enable == 0): ?> disabledCookie <?php endif; ?>"
                                                data-link="<?php echo e(route('register', ['ref_id' => \Auth::user()->referral_code])); ?>"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Click to copy business link">
                                                <?php echo e(route('register', ['ref' => \Auth::user()->referral_code])); ?>

                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-copy ms-1">
                                                    <rect x="9" y="9" width="13" height="13" rx="2"
                                                        ry="2"></rect>
                                                    <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1">
                                                    </path>
                                                </svg>
                                            </a>


                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div id="referral_transaction" class="card tab-content d-none mb-0">
                        <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2">
                            <h5><?php echo e(__('Referral Transaction')); ?></h5>
                        </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table" id="pc-dt-simple">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th> <?php echo e(__('Company Name')); ?></th>
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
                                                <td><?php echo e(!empty($transaction->getUser) ? $transaction->getUser->name : '-'); ?>

                                                </td>

                                                <td><?php echo e(!empty($transaction->getPlan) ? $transaction->getPlan->name : '-'); ?>

                                                </td>
                                                <td><?php echo e((isset($admin_payment_setting['CURRENCY_SYMBOL']) ? $admin_payment_setting['CURRENCY_SYMBOL'] : '$') . $transaction->plan_price); ?>

                                                </td>
                                                <td><?php echo e($transaction->commission ? $transaction->commission : ''); ?>

                                                </td>
                                                <td><?php echo e((isset($admin_payment_setting['CURRENCY_SYMBOL']) ? $admin_payment_setting['CURRENCY_SYMBOL'] : '$') . ($transaction->plan_price * $transaction->commission) / 100); ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="payout" class=" text-white tab-content d-none">
                        <div class="card">
                            <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2">
                                <h5><?php echo e(__('Payout')); ?></h5>
                                    <?php if(\Auth::user()->commission_amount > $paidAmount): ?>
                                        <?php if($paymentRequest == null): ?>
                                            <a href="#"
                                                data-url = "<?php echo e(route('request.amount.sent', [$paidAmount])); ?>"
                                                data-ajax-popup="true" class="btn btn-primary btn-sm"
                                                data-title="<?php echo e(__('Send Request')); ?>" data-bs-toggle="tooltip"
                                                title="<?php echo e(__('Send Request')); ?>">
                                                <span class="btn-inner--icon"><i
                                                        class="ti ti-corner-up-right"></i></span>
                                            </a>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('request.amount.cancel', \Auth::user()->id)); ?>"
                                                class="btn btn-danger btn-sm" data-title="<?php echo e(__('Cancel Request')); ?>"
                                                data-bs-toggle="tooltip" title="<?php echo e(__('Cancel Request')); ?>">
                                                <span class="btn-inner--icon"><i class="ti ti-x"></i></span>
                                            </a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <div class="row row-gap">
                                    <div class="col-md-6">
                                        <div class="card mb-0">
                                            <div class="card-body d-flex align-items-center justify-content-between gap-2">
                                                <div class="currency-icon">
                                                    <p class="text-black"><?php echo e(__('Total Commission Amount')); ?></p>
                                                    <h3 class="mb-0"><?php echo e($admin_payment_setting['CURRENCY_SYMBOL'] . \Auth::user()->commission_amount); ?></h3>
                                                </div>
                                                <div class="theme-avtar bg-primary">
                                                    <i class="ti ti-report-money"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card mb-0">
                                            <div class="card-body d-flex align-items-center justify-content-between gap-2">
                                                <div class="currency-icon">
                                                    <p class="text-black"><?php echo e(__('Paid Commission Amount')); ?></p>
                                                    <h3 class="mb-0"><?php echo e($admin_payment_setting['CURRENCY_SYMBOL'] . $paidAmount); ?></h3>
                                                </div>
                                                <div class="theme-avtar bg-primary">
                                                    <i class="ti ti-report-money"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-0">
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
                                                <th> <?php echo e(__('Status')); ?></th>
                                                <th> <?php echo e(__('Requested Amount')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $transactionsOrder; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $transactions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e(++$key); ?></td>
                                                    <td><?php echo e(\Auth::user()->name); ?></td>
                                                    <td><?php echo e($transactions->date); ?></td>
                                                    <td>
                                                        <?php if($transactions->status == 0): ?>
                                                            <span
                                                                class="status_badge badge bg-danger p-2 px-3 w-50"><?php echo e(__(\App\Models\TransactionOrder::$status[$transactions->status])); ?></span>
                                                        <?php elseif($transactions->status == 1): ?>
                                                            <span
                                                                class="status_badge badge bg-warning p-2 px-3 w-50"><?php echo e(__(\App\Models\TransactionOrder::$status[$transactions->status])); ?></span>
                                                        <?php elseif($transactions->status == 2): ?>
                                                            <span
                                                                class="status_badge badge bg-primary p-2 px-3 w-50"><?php echo e(__(\App\Models\TransactionOrder::$status[$transactions->status])); ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo e((isset($admin_payment_setting['CURRENCY_SYMBOL']) ? $admin_payment_setting['CURRENCY_SYMBOL'] : '$') . $transactions->request_amount); ?>

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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/referral/company_index.blade.php ENDPATH**/ ?>