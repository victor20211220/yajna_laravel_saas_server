@extends('layouts.admin')
@push('css-page')
@endpush
@section('page-title')
    {{ __('Dashboard') }}
@endsection
@section('title')
    {{ __('Dashboard') }}
@endsection
@push('custom-scripts')
    <script src="{{ asset('custom/js/purpose.js') }}"></script>
    <script>
        var e = $("#chart-sales");
        ! function(e) {
            var t = {
                    chart: {
                        width: "100%",
                        zoom: {
                            enabled: !1
                        },
                        toolbar: {
                            show: !1
                        },
                        shadow: {
                            enabled: !1
                        }
                    },
                    stroke: {
                        width: 6,
                        curve: "smooth"
                    },
                    series: [{
                        name: "{{ __('Order') }}",
                        data: {!! json_encode($chartData['data']) !!}
                    }],
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
                        categories: {!! json_encode($chartData['label']) !!}
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
                    fill: {
                        type: "solid"
                    },
                    markers: {
                        size: 4,
                        opacity: .7,
                        strokeColor: "#fff",
                        strokeWidth: 3,
                        hover: {
                            size: 7
                        }
                    },
                    grid: {
                        borderColor: PurposeStyle.colors.gray[300],
                        strokeDashArray: 5
                    },
                    dataLabels: {
                        enabled: !1
                    }
                },
                a = (
                    e.data().dataset, e.data().labels, e.data().color),
                n = e.data().height,
                o = e.data().type;
            t.colors = [
                    PurposeStyle.colors.theme[a]
                ],
                t.markers.colors = [
                    PurposeStyle.colors.theme[a]
                ], t.chart.height = n || 350, t.chart.type = o || "line";
            var i = new ApexCharts(e[0], t);
        }($("#chart-sales"));
    </script>
@endpush
@php
    $admin_payment_setting = \App\Models\Utility::getAdminPaymentSetting();

@endphp

@section('content')
    <div class="row row-gap mb-4">
        <div class="col-xxl-4 col-md-6 dash-card">
            <div class="dashboard-info-card">
                <svg class="star" xmlns="http://www.w3.org/2000/svg" width="83" height="79" viewBox="0 0 83 79" fill="none">
                    <path opacity="0.16" d="M59.0537 26.924C44.68 38.2757 42.7394 43.5902 45.6923 63.5089C34.0866 47.0541 29.0147 44.5469 10.7783 46.2497C25.1511 34.8957 27.0918 29.5812 24.1367 9.66327C35.7446 26.1172 40.8164 28.6245 59.0537 26.924Z" fill="#FF3A6E"/>
                    <path opacity="0.16" d="M78.2765 61.7004C73.0978 65.7903 72.3986 67.7051 73.4625 74.8815C69.2811 68.9531 67.4538 68.0497 60.8834 68.6633C66.0618 64.5725 66.761 62.6578 65.6963 55.4816C69.8785 61.4097 71.7058 62.3131 78.2765 61.7004Z" fill="#FF3A6E"/>
                </svg>
                <a href="{{ route('users.index')}}" class="top-info">
                    <span class="h4">{{ __('Total Users') }}</span>
                </a>
                <div class="card-inner d-flex align-items-end justify-content-between gap-2">
                    <div class="info-icon">
                        <div class="info-icon-inner">
                            <i class="ti ti-users"></i>
                        </div>
                    </div>
                    <div class="card-info text-end">
                        <h3 class="mb-3 h2">{{ $user->total_user }}</h3>
                        <div class="card-label d-flex align-items-center gap-1">
                            {{ __('Paid Users : ') }}
                            <span>{{ $user['total_paid_user'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-md-6 dash-card">
            <div class="dashboard-info-card">
                <svg class="star" xmlns="http://www.w3.org/2000/svg" width="83" height="79" viewBox="0 0 83 79" fill="none">
                    <path opacity="0.16" d="M59.0537 26.924C44.68 38.2757 42.7394 43.5902 45.6923 63.5089C34.0866 47.0541 29.0147 44.5469 10.7783 46.2497C25.1511 34.8957 27.0918 29.5812 24.1367 9.66327C35.7446 26.1172 40.8164 28.6245 59.0537 26.924Z" fill="#FF3A6E"/>
                    <path opacity="0.16" d="M78.2765 61.7004C73.0978 65.7903 72.3986 67.7051 73.4625 74.8815C69.2811 68.9531 67.4538 68.0497 60.8834 68.6633C66.0618 64.5725 66.761 62.6578 65.6963 55.4816C69.8785 61.4097 71.7058 62.3131 78.2765 61.7004Z" fill="#FF3A6E"/>
                </svg>
                <a href="{{ route('order.index')}}" class="top-info">
                    <span class="h4">{{ __('Total Orders') }}</span>
                </a>
                <div class="card-inner d-flex align-items-end justify-content-between gap-2">
                    <div class="info-icon">
                        <div class="info-icon-inner">
                            <i class="ti ti-shopping-cart dash-micon"></i>
                        </div>
                    </div>
                    <div class="card-info text-end">
                        <h3 class="mb-3 h2">{{ $user->total_orders }}</h3>
                        <div class="card-label d-flex align-items-center gap-1">
                            {{ __('Total Amount : ') }}
                            <span>{{ (isset($admin_payment_setting['CURRENCY_SYMBOL']) ? $admin_payment_setting['CURRENCY_SYMBOL']  : '$') . $user['total_orders_price'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-md-6 dash-card">
            <div class="dashboard-info-card">
                <svg class="star" xmlns="http://www.w3.org/2000/svg" width="83" height="79" viewBox="0 0 83 79" fill="none">
                    <path opacity="0.16" d="M59.0537 26.924C44.68 38.2757 42.7394 43.5902 45.6923 63.5089C34.0866 47.0541 29.0147 44.5469 10.7783 46.2497C25.1511 34.8957 27.0918 29.5812 24.1367 9.66327C35.7446 26.1172 40.8164 28.6245 59.0537 26.924Z" fill="#FF3A6E"/>
                    <path opacity="0.16" d="M78.2765 61.7004C73.0978 65.7903 72.3986 67.7051 73.4625 74.8815C69.2811 68.9531 67.4538 68.0497 60.8834 68.6633C66.0618 64.5725 66.761 62.6578 65.6963 55.4816C69.8785 61.4097 71.7058 62.3131 78.2765 61.7004Z" fill="#FF3A6E"/>
                </svg>
                <a href="{{ route('plans.index')}}" class="top-info">
                    <span class="h4">{{ __('Total Plans') }}</span>
                </a>
                <div class="card-inner d-flex align-items-end justify-content-between gap-2">
                    <div class="info-icon">
                        <div class="info-icon-inner">
                            <i class="ti ti-trophy dash-micon"></i>
                        </div>
                    </div>
                    <div class="card-info text-end">
                        <h3 class="mb-3 h2">{{ $user->total_plan }}</h3>
                        <div class="card-label d-flex align-items-center gap-1">
                            {{ __('Popular Plan : ') }}
                            <span>{{ $user['most_purchese_plan'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl-12">
            <div class="card mb-0">
                <div class="card-header">
                    <h5>{{ __('Recent Order') }}</h5>
                </div>
                <div class="card-body">
                    <div id="chart-sales"></div>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('custom-scripts')
    <script src="{{ asset('custom/js/purpose.js') }}"></script>
    <script type="text/javascript">
        (function() {
            // {!! json_encode($chartData['data']) !!}

            var options = {
                series: [{
                    name: '{{ __("Order") }}',
                    data: {!! json_encode($chartData['data']) !!}
                }],
                chart: {
                    height: 350,
                    type: 'area',
                    toolbar: {
                        show: false
                    }
                },

                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                title: {
                    text: '',
                    align: 'left'
                },
                xaxis: {

                    categories:{!! json_encode($chartData['label']) !!},
                    title: {
                        text: '{{ __("Days") }}'
                    }

                },
                yaxis: {
                    title: {
                        text: '{{ __("Order") }}',

                    },
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart-sales"), options);
            chart.render();
        })();

    </script>
@endpush
