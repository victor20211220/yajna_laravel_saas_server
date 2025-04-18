<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Business Analytics')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Business Analytics')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <?php if(Auth::user()->type == 'company'): ?>
        <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('business.index')); ?>"><?php echo e(__('Business')); ?></a>
        </li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Business Analytics')); ?></li>
    <?php else: ?>
    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><a
                href="<?php echo e(route('campaigns.index')); ?>"><?php echo e(__('Campaigns')); ?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Business Analytics')); ?></li>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="col-xl-12 col-lg-12 col-md-12 d-flex align-items-center justify-content-between justify-content-md-end"
        data-bs-placement="top">
        <a href="#filter_analytics" class="btn btn-sm btn-primary" id="toggle-filter-btn" data-bs-placement="top" data-bs-toggle="tooltip"
        title="<?php echo e(__('Analycis')); ?>" data-bs-original-title="<?php echo e(__('Analycis')); ?>">
            <div class="float-end"><i class="ti ti-filter"></i></div>
        </a>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12 <?php echo e($isFiltered ? '' : 'd-none'); ?>" id="filter_analytics">
            <div class=" mt-2 " id="multiCollapseExample1" style="">
                <div class="card">
                    <div class="card-body ana">
                        <?php echo e(Form::open(['route' => ['business.analytics', $id], 'method' => 'get', 'id' => 'analytics_filter'])); ?>

                        <div class="d-flex align-items-center justify-content-end">
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mx-2">
                                <div class="btn-box">
                                    <?php echo e(Form::label('start_date', __('Start date'), ['class' => 'form-label'])); ?>

                                    <input type="date" name="start_date" class="form-control"
                                        value="<?php echo e(isset($_GET['start_date']) ? $_GET['start_date'] : ''); ?>"
                                        placeholder ="">
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mx-2">
                                <div class="btn-box">
                                    <?php echo e(Form::label('end_date', __('End date'), ['class' => 'form-label'])); ?>

                                    <input type="date" name="end_date" class="form-control"
                                        value="<?php echo e(isset($_GET['end_date']) ? $_GET['end_date'] : ''); ?>" placeholder ="">
                                </div>
                            </div>

                            <div class="col-auto float-end ms-2 mt-4">
                                <a href="#" class="btn btn-sm btn-primary"
                                    onclick="document.getElementById('analytics_filter').submit(); return false;"
                                    data-bs-toggle="tooltip" title="" data-bs-original-title="<?php echo e(__('Apply')); ?>">
                                    <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                </a>
                                <a href="<?php echo e(route('business.analytics', $id)); ?>" class="btn btn-sm btn-danger"
                                    data-bs-toggle="tooltip" title="" data-bs-original-title="<?php echo e(__('Reset')); ?>">
                                    <span class="btn-inner--icon"><i class="ti ti-refresh text-white-off "></i></span>
                                </a>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-end">
                            <span class="mb-0 float-right"><?php echo e(__('Last 15 Days')); ?></span>
                        </div>
                        <h5><?php echo e(__('Appointments')); ?></h5>
                    </div>
                    <div class="card-body">
                        <div id="apex-storedashborad" data-color="primary" data-height="280"></div>
                        <h6><?php echo e(__('Promotion Data Over Time')); ?></h6>
                        <small><?php echo e(__('This chart shows the promotion periods along with the annotation of the promotion periods based on the start and end dates.')); ?></small>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-end">
                            <span class="mb-0 text-sm float-right mt-1"><?php echo e(__('Last 15 Days')); ?></span>
                        </div>
                        <h5 class="mb-0 float-left"><?php echo e(__('Platform')); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div id="user_platform-chart"></div>
                            <h6><?php echo e(__('Platform Data with Promotion Periods')); ?></h6>
                            <small><?php echo e(__('This bar chart displays the platform data along with annotations indicating the total
                                                                                        days of promotion periods.')); ?></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-md-6 col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <div class="float-end">
                            <span class="mb-0 text-sm float-right mt-1"><?php echo e(__('Last 15 Days')); ?></span>
                        </div>
                        <h5 class="mb-0 float-left"><?php echo e(__('Device Analytics')); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div id="pie-storedashborad"></div>
                            </div>
                            <div class="col-md-6">
                                <div id="pie-promotion"></div>

                            </div>

                        </div>
                        <div class="mt-4">
                            <h6><?php echo e(__('Promotion Budget Distribution')); ?></h6>
                            <small><?php echo e(__('This pie chart shows the distribution of the budget across different promotion
                                                                                    periods.')); ?>

                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6 col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <div class="float-end">
                            <span class="mb-0 text-sm float-right mt-1"><?php echo e(__('Last 15 Days')); ?></span>
                        </div>
                        <h5 class="mb-0 float-left"><?php echo e(__('Browser Analytics')); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div id="pie-storebrowser"></div>
                            </div>
                            <div class="col-md-6">
                                <div id="pie-promotion-period"></div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h6><?php echo e(__('Promotion Duration Distribution')); ?></h6>
                            <small><?php echo e(__('This pie chart shows the distribution of the total days for different promotion
                                                                                periods.')); ?>

                            </small>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body table-border-style ">
                        <h5></h5>
                        <div class="table-responsive">
                            <table class="table" id="pc-dt-simple">
                                <thead>
                                    <th><?php echo e(__('#')); ?> </th>
                                    <th><?php echo e(__('Start date')); ?> </th>
                                    <th><?php echo e(__('End Date')); ?> </th>
                                    <th><?php echo e(__('Total Days')); ?> </th>
                                    <th><?php echo e(__('Total Amount')); ?> </th>
                                    <th><?php echo e(__('Payment Method')); ?> </th>
                                    <th><?php echo e(__('Total')); ?> </th>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $promoteData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->index + 1); ?></td>
                                            <td><?php echo e($promote->start_date); ?></td>
                                            <td><?php echo e($promote->end_date); ?></td>
                                            <td><?php echo e($promote->total_days); ?></td>
                                            <td><?php echo e($promote->total_cost); ?></td>
                                            <td><?php echo e($promote->payment_method); ?></td>
                                            <td><?php echo e($promote->total_cost * $promote->total_days); ?></td>
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
<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-scripts'); ?>
    <script src="<?php echo e(asset('custom/js/purpose.js')); ?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterBtn = document.getElementById('toggle-filter-btn');
            const filterSection = document.getElementById('filter_analytics');

            filterBtn.addEventListener('click', function(e) {
                e.preventDefault();
                filterSection.classList.toggle('d-none');
            });
        });
    </script>
    <script>
        (function() {
            var xaxisAnnotations = [];

            <?php $__currentLoopData = $annotations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $annotation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                var annotation = {
                    x: "<?php echo e($annotation['startDateString']); ?>",
                    x2: "<?php echo e($annotation['endDateString']); ?>",
                    fillColor: '#ffa500',
                    opacity: 0.3,
                    label: {
                        text: 'Promotion Period',
                        borderColor: '#ffa500',
                        style: {
                            color: '#fff',
                            background: '#ffa500',
                        }
                    }
                };

                xaxisAnnotations.push(annotation);
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            var annotationsConfig = {
                xaxis: xaxisAnnotations
            };


            var options = {
                chart: {
                    height: 350,
                    type: 'line',
                    toolbar: {
                        show: false,
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                series: <?php echo json_encode($chartData['data']); ?>,
                xaxis: {
                    labels: {
                        format: "MMM",
                        style: {
                            colors: PurposeStyle.colors.gray[600],
                            fontSize: "14px",
                            fontFamily: PurposeStyle.fonts.base,
                            cssClass: "apexcharts-xaxis-label"
                        }
                    },
                    axisBorder: {
                        show: !1
                    },
                    axisTicks: {
                        show: !0,
                        borderType: "solid",
                        color: PurposeStyle.colors.gray[300],
                        height: 6,
                        offsetX: 0,
                        offsetY: 0
                    },
                    type: "text",
                    categories: <?php echo json_encode($chartData['label']); ?>

                },
                yaxis: {
                    labels: {
                        style: {
                            color: PurposeStyle.colors.gray[600],
                            fontSize: "12px",
                            fontFamily: PurposeStyle.fonts.base
                        }
                    },
                    axisBorder: {
                        show: !1
                    },
                    axisTicks: {
                        show: !0,
                        borderType: "solid",
                        color: PurposeStyle.colors.gray[300],
                        height: 6,
                        offsetX: 0,
                        offsetY: 0
                    }
                },

                grid: {
                    strokeDashArray: 4,
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    floating: true,
                    offsetY: -25,
                    offsetX: -5
                },
                annotations: annotationsConfig
            };
            var chart = new ApexCharts(document.querySelector("#apex-storedashborad"), options);
            chart.render();
        })();
        var options = {
            chart: {
                height: 200,
                type: 'donut',
            },
            dataLabels: {
                enabled: true,
            },
            series: <?php echo json_encode($devicearray['data']); ?>,
            colors: ["#CECECE", '#ffa21d', '#FF3A6E', '#3ec9d6'],
            labels: <?php echo json_encode($devicearray['label']); ?>,
            legend: {
                show: true,
                position: 'bottom',
            },
        };
        var chart = new ApexCharts(document.querySelector("#pie-storedashborad"), options);
        chart.render();
        var options = {
            chart: {
                height: 200,
                type: 'donut',
            },
            dataLabels: {
                enabled: true,
            },
            series: <?php echo json_encode($browserarray['data']); ?>,
            colors: ["#CECECE", '#ffa21d', '#FF3A6E', '#3ec9d6'],
            labels: <?php echo json_encode($browserarray['label']); ?>,
            legend: {
                show: true,
                position: 'bottom',
            },
        };
        var chart = new ApexCharts(document.querySelector("#pie-storebrowser"), options);
        chart.render();
    </script>
    <script>
        var WorkedHoursChart = (function() {
            var $chart = $('#user_platform-chart');
            var annotations = [
                <?php $__currentLoopData = $annotations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $annotation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    {
                        y: "<?php echo e($annotation['days']); ?>",
                        borderColor: "#ffa500",
                        label: {
                            borderColor: "#ffa500",
                            style: {
                                color: "#fff",
                                background: "#ffa500"
                            },
                            text: "Promotion Period[Total Day]"
                        }
                    },
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            ];

            function init($this) {
                var options = {
                    chart: {
                        height: 350,
                        type: 'bar',
                        zoom: {
                            enabled: false
                        },
                        toolbar: {
                            show: false
                        },
                        shadow: {
                            enabled: false,
                        }
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '30%',
                            borderRadius: 10,
                            dataLabels: {
                                position: 'top',
                            },
                        }
                    },
                    stroke: {
                        show: true,
                        width: 1,
                        colors: ['#fff']
                    },
                    series: [{
                        name: 'Platform',
                        data: <?php echo json_encode($platformarray['data']); ?>

                    }],
                    xaxis: {
                        labels: {
                            style: {
                                colors: PurposeStyle.colors.gray[600],
                                fontSize: '14px',
                                fontFamily: PurposeStyle.fonts.base,
                                cssClass: 'apexcharts-xaxis-label',
                            },
                        },
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: true,
                            borderType: 'solid',
                            color: PurposeStyle.colors.gray[300],
                            height: 6,
                            offsetX: 0,
                            offsetY: 0
                        },
                        title: {
                            text: '<?php echo e(__('Platform')); ?>'
                        },
                        categories: <?php echo json_encode($platformarray['label']); ?>

                    },
                    yaxis: {
                        labels: {
                            style: {
                                color: PurposeStyle.colors.gray[600],
                                fontSize: '12px',
                                fontFamily: PurposeStyle.fonts.base,
                            },
                        },
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: true,
                            borderType: 'solid',
                            color: PurposeStyle.colors.gray[300],
                            height: 6,
                            offsetX: 0,
                            offsetY: 0
                        }
                    },
                    fill: {
                        type: 'solid',
                        opacity: 1
                    },
                    markers: {
                        size: 4,
                        opacity: 0.7,
                        strokeColor: "#fff",
                        strokeWidth: 3,
                        hover: {
                            size: 7,
                        }
                    },
                    grid: {
                        borderColor: PurposeStyle.colors.gray[300],
                        strokeDashArray: 5,
                    },
                    dataLabels: {
                        enabled: false
                    },
                    // Add annotations for promotion periods
                    annotations: {
                        yaxis: annotations
                    }
                };

                // Initialize the chart
                var chart = new ApexCharts($this[0], options);

                // Render the chart
                chart.render();
            }

            // Initialize charts
            if ($chart.length) {
                $chart.each(function() {
                    init($(this));
                });
            }
        })();
    </script>
    <script>
        var options = {
            chart: {
                height: 200,
                type: 'donut',
            },
            dataLabels: {
                enabled: true,
            },
            series: <?php echo json_encode($promotionData['data']); ?>,
            colors: ["#CECECE", '#ffa21d', '#FF3A6E', '#3ec9d6'],
            labels: <?php echo json_encode($promotionData['label']); ?>,
            legend: {
                show: true,
                position: 'bottom',
            },
        };
        var chart = new ApexCharts(document.querySelector("#pie-promotion"), options);
        chart.render();
        var promotionPeriodOptions = {
            chart: {
                height: 200,
                type: 'donut',
            },
            dataLabels: {
                enabled: true,
            },
            series: <?php echo json_encode($promotionPeriodData['data']); ?>,
            colors: ["#00E396", '#008FFB', '#FEB019', '#FF4560'],
            labels: <?php echo json_encode($promotionPeriodData['label']); ?>,
            legend: {
                show: true,
                position: 'bottom',
            },
        };
        var promotionPeriodChart = new ApexCharts(document.querySelector("#pie-promotion-period"), promotionPeriodOptions);
        promotionPeriodChart.render();
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u877293075/domains/graphixjunctionvcard.com/public_html/resources/views/business/analytics.blade.php ENDPATH**/ ?>