<?php
    $cardLogo = \App\Models\Utility::get_file('card_logo');
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Campaigns')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Campaigns')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Campaigns')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Campaigns')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <?php if(Auth::user()->type == 'company'): ?>
        <div class="col-xl-12 col-lg-12 col-md-12 d-flex align-items-center justify-content-between justify-content-md-end"
            data-bs-placement="top">
            <a href="#" data-size="lg" data-url="<?php echo e(route('campaigns.create')); ?>" data-ajax-popup="true"
                data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create New Campaigns')); ?>"
                class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="mt-4" id="multiCollapseExample1">
        <div class="card">
            <div class="card-body">
                <?php echo e(Form::open(['route' => ['campaigns.index'], 'method' => 'get', 'id' => 'cam_filter'])); ?>

                <div class="row row-gap align-items-end">
                    <?php if(Auth::user()->type == 'super admin'): ?>
                        <div class="col-xxl-2 col-md-4 col-sm-6 col-12">
                            <div class="btn-box">
                                <?php echo e(Form::label('user', __('User'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::select('user', $userList, isset($_GET['user']) ? $_GET['user'] : '', ['class' => 'form-control select ', 'id' => 'user_id'])); ?>

                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="col-xxl-2 col-md-4 col-sm-6 col-12">
                        <div class="btn-box">
                            <?php echo e(Form::label('cat_type', __('Category'), ['class' => 'form-label'])); ?>

                            <?php echo e(Form::select('cat_type', $catList, isset($_GET['cat_type']) ? $_GET['cat_type'] : '', ['class' => 'form-control select ', 'id' => 'user_id'])); ?>

                        </div>
                    </div>
                    <div class="col-xxl-2 col-md-4 col-sm-6 col-12">
                        <div class="btn-box">
                            <?php echo e(Form::label('business', __('Business'), ['class' => 'form-label'])); ?>

                            <?php echo e(Form::select('business', $businessList, isset($_GET['business']) ? $_GET['business'] : '', ['class' => 'form-control select ', 'id' => 'user_id'])); ?>

                        </div>
                    </div>

                    <div class="col-xxl-2 col-md-4 col-sm-6 col-12">
                        <div class="btn-box">
                            <?php echo e(Form::label('start_date', __('Start date'), ['class' => 'form-label'])); ?>

                            <input type="date" name="start_date" class="form-control"
                                value="<?php echo e(isset($_GET['start_date']) ? $_GET['start_date'] : ''); ?>" placeholder ="">
                        </div>
                    </div>
                    <div class="col-xxl-2 col-md-4 col-sm-6 col-12">
                        <div class="btn-box">
                            <?php echo e(Form::label('end_date', __('End date'), ['class' => 'form-label'])); ?>

                            <input type="date" name="end_date" class="form-control"
                                value="<?php echo e(isset($_GET['end_date']) ? $_GET['end_date'] : ''); ?>" placeholder ="">
                        </div>
                    </div>

                    <div class="col-auto float-end d-flex pb-1">
                        <a href="#" class="btn btn-sm btn-primary me-2"
                            onclick="document.getElementById('cam_filter').submit(); return false;"
                            data-bs-toggle="tooltip" title="" data-bs-original-title="<?php echo e(__('Apply')); ?>">
                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                        </a>
                        <a href="<?php echo e(route('campaigns.index')); ?>" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                            title="" data-bs-original-title="<?php echo e(__('Reset')); ?>">
                            <span class="btn-inner--icon"><i class="ti ti-refresh text-white-off "></i></span>
                        </a>
                    </div>
                </div>
                <?php echo e(Form::close()); ?>

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
                            <th><?php echo e(__('Campaign Name')); ?> </th>
                            <th><?php echo e(__('User')); ?> </th>
                            <th><?php echo e(__('Category')); ?> </th>
                            <th><?php echo e(__('Business Name')); ?> </th>
                            <th><?php echo e(__('Start date')); ?> </th>
                            <th><?php echo e(__('End Date')); ?> </th>
                            <th><?php echo e(__('Total Days')); ?> </th>
                            <th><?php echo e(__('Total Amount')); ?> </th>
                            <th><?php echo e(__('Payment Method')); ?> </th>
                            <th><?php echo e(__('Status')); ?> </th>

                            <th width="200px"><?php echo e(__('Action')); ?> </th>

                        </thead>
                        <tbody>

                            <?php $__currentLoopData = $campaignsData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaigns): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(ucfirst($campaigns->name)); ?></td>
                                    <td><?php echo e(ucfirst($campaigns->users->name)); ?></td>
                                    <td><?php echo e($campaigns->categories->name); ?></td>
                                    <td><?php echo e(isset($campaigns->businesses->title)? $campaigns->businesses->title :'-'); ?></td>
                                    <td><?php echo e($campaigns->start_date); ?></td>
                                    <td><?php echo e($campaigns->end_date); ?></td>
                                    <td><?php echo e($campaigns->total_days); ?></td>
                                    <td><?php echo e($campaigns->total_cost); ?></td>
                                    <td><?php echo e($campaigns->payment_method); ?></td>
                                    <td>
                                        <span
                                            class="badge fix_badge
                                            <?php if($campaigns->status == 0): ?> bg-danger
                                            <?php elseif($campaigns->status == 1): ?> bg-info
                                            <?php elseif($campaigns->status == 2): ?> bg-warning
                                            <?php elseif($campaigns->status == 3): ?> bg-secondary <?php endif; ?>
                                            p-2 px-3" style="width:100px;">
                                            <?php echo e(\App\Models\Campaigns::$statuses[$campaigns->status]); ?>

                                        </span>
                                    </td>

                                    <td>
                                        <div class="action-btn-wrp d-flex align-items-center gap-1">
                                            <?php if(Auth::user()->type != 'company'): ?>
                                                <?php if($campaigns->approval == 1): ?>
                                                    <div class="form-check form-switch custom-switch-v1">
                                                        <input type="checkbox" name="campaigns_status"
                                                            class="form-check-input input-primary campaigns_status_active"
                                                            value="1" data-id="<?php echo e($campaigns->id); ?>"
                                                            data-name="campaigns"
                                                            <?php echo e($campaigns->status == '1' ? 'checked' : ''); ?>>
                                                        <label class="form-check-label" for="campaigns_status"></label>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if(is_null($campaigns->approval) && !is_null($campaigns->total_cost)): ?>
                                                    <div class="action-btn me-2 ">
                                                        <a href="#" class="btn btn-sm  btn-icon bg-info "
                                                            data-url="<?php echo e(route('view.status.campaigns', $campaigns->id)); ?>"
                                                            data-size="md" data-ajax-popup="true"
                                                            data-title="<?php echo e(__('Change Status')); ?>"
                                                            title="<?php echo e(__('Status')); ?>" data-bs-toggle="tooltip"
                                                            data-bs-placement="top">
                                                            <span class="text-white"><i
                                                                    class="ti ti-caret-right text-white"></i></span></a>
                                                    </div>
                                                <?php endif; ?>

                                                <div class="action-btn me-2">
                                                    <a class="btn btn-sm  btn-icon bg-warning" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom"
                                                        data-bs-original-title="<?php echo e(__('Preview')); ?>"
                                                        href="<?php echo e(url('/' . $campaigns->businesses->slug)); ?>"
                                                        target="-blank"><span class="text-white"><i
                                                                class="ti ti-eye"></i></span></a>
                                                </div>
                                            <?php endif; ?>
                                            <div class="action-btn  ">
                                                <a href="<?php echo e(route('campaigns.business.analytics', $campaigns->id)); ?>"
                                                    class="bg-secondary btn btn-sm d-inline-flex align-items-center"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-original-title="<?php echo e(__('Analytics')); ?>"> <span
                                                        class="text-white"> <i
                                                            class="ti ti-brand-google-analytics  text-white"></i></span></a>
                                            </div>

                                        </div>
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
    <script>
        $(document).on("click", ".campaigns_status_active", function() {
            var id = $(this).attr('data-id');
            var is_disable = ($(this).is(':checked')) ? $(this).val() : 0;

            $.ajax({
                url: '<?php echo e(route('campaigns.enable')); ?>',
                type: 'POST',
                data: {
                    "is_disable": is_disable,
                    "id": id,
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(data) {
                    if (data.is_success == true) {
                        toastrs('<?php echo e(__('Success')); ?>', data.msg, 'success');
                    } else if (data.is_success == false) {
                        toastrs('<?php echo e(__('Error')); ?>', data.msg, 'error');
                        $('.campaigns_status_active[data-id="' + id + '"]').prop('checked', !
                            is_disable);
                    }
                    setTimeout(() => {
                        location.reload();
                    }, 2000);

                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/campaigns/index.blade.php ENDPATH**/ ?>