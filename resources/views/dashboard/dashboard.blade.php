@php
    use App\Models\Utility;
    use App\Models\Business;
    $profile = Utility::get_file('uploads/avatar');
    $qr_path = Utility::get_file('qrcode');
    $businesses = Business::allBusiness();
    $currantBusiness = $users->currentBusiness();
    $bussiness_id = $users->current_business;
    $settings = Utility::settings();
    $business1 = Business::where('id', $bussiness_id)->where('created_by', \Auth::user()->creatorId())->first();
    $theme = $business1 ? $business1->theme : 'theme1' ;
    $themeData = Utility::themeOne();
    if (!empty($business1) && !empty($business1->theme_color)) {
    $color = !empty($themeData[$theme][$business1->theme_color]['theme_name'])
        ? explode('-', $business1->theme_color)[0]
        : 'color1';
    } else {
        $color = 'color1';
    }
@endphp
@extends('layouts.admin')
@push('css-page')
    <style>
        .shareqrcode img {
            width: 65%;
            height: 65%;
        }

        .shareqrcode canvas {
            width: 65%;
            height: 65%;
        }
    </style>
@endpush
@section('page-title')
    {{ __('Dashboard') }}
@endsection
@section('content')
    <div class="row">
        <div class="page-title mb-3">
            <div class="row justify-content-between align-items-center mt-n5">
                <div class="d-flex align-items-center justify-content-between gap-2 mb-3 mb-md-0">
                    <h5 class="h3 mb-0">{{ __('Dashboard') }}</h5>

                    {{-- //business Display Start --}}
                    <ul class="list-unstyled business-header ms-2 mt-n1 mb-0">
                        <li class="dropdown dash-h-item drp-language">
                            <a class="dash-head-link dropdown-toggle arrow-none me-0 cust-btn"
                                data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                data-bs-original-title="{{ __('Select your bussiness') }}">
                                <i class="ti ti-apps"></i>
                                <span class="drp-text hide-mob">{{ __(ucfirst($currantBusiness)) }}</span>
                                <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                            </a>
                            <div class="dropdown-menu dash-h-dropdown dropdown-menu-end page-inner-dropdowm dashborad-drap">
                                @foreach ($businesses as $key => $business)
                                    @if ($business['admin_enable'] == 'on')
                                        <a href="{{ route('business.change', $business['id']) }}" class="dropdown-item">
                                            <i
                                                class="@if ($bussiness_id == $business['id']) ti ti-checks text-primary @elseif($currantBusiness == $business['title']) ti ti-checks text-primary @endif "></i>
                                            <span>{{ ucfirst($business['title']) }}</span>
                                        </a>
                                    @else
                                        <a href="#" class="dropdown-item">
                                            <i class="ti ti-lock"></i>
                                            <span class="row-disabled">{{ ucfirst($business['title']) }}</span>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </li>
                    </ul>

                    {{-- //business Display End --}}

                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row dashboard-wrp">
                <div class="col-xxl-7 col-xl-12 col-12">
                    <div class="row row-gaps">
                        <div class="col-lg-8 col-md-8 col-sm-12 col-12 welcome-card mb-0 d-flex">
                            <div class="dashboard-card">
                                <img src="https://dash-demo.workdo.io/assets/images/layer.png" class="dashboard-card-layer" alt="layer">
                                <div class="card-inner">
                                    <div class="card-content">
                                        <h3 class="text-white">{{__('Good Morning')}}</h3>
                                        <p>{{ __('Have a nice day! Did you know that you can quickly add your favorite card to the business?') }}</p>
                                        <div class="btn-wrp d-flex gap-3">
                                            <button class="btn  btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-plus me-2">
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                            </svg>
                                        <span>{{ __('Quick add') }}</span> </button>
                                        <div class="dropdown-menu">
                                            @can('create business')
                                                <a href="#" data-size="xl" data-url="{{ route('business.create') }}"
                                                    data-ajax-popup="true" data-title="Create New Business" class="dropdown-item"
                                                    data-bs-placement="top" data-bs-toggle="tooltip"
                                                    title="{{__('create Business')}}" data-bs-original-title="{{ __('create Business') }}">
                                                    <span>{{ __('Add new Business') }}</span>
                                                </a>
                                            @endcan
                                            @can('create user')
                                                <a href="#" data-size="md" data-url="{{ route('users.create') }}"
                                                    data-ajax-popup="true" data-title="Create New User" class="dropdown-item"
                                                    data-bs-placement="top" data-bs-toggle="tooltip"
                                                    title="{{__('create User')}}" data-bs-original-title="{{ __('create User') }}">
                                                    <span>{{ __('Add new user') }}</span>
                                                </a>
                                            @endcan
                                            @can('create role')
                                                <a href="#" data-size="lg" data-url="{{ route('roles.create') }}"
                                                    data-ajax-popup="true" data-title="Create New Role" class="dropdown-item"
                                                    data-bs-placement="top" data-bs-toggle="tooltip"
                                                    title="{{__('create Role')}}" data-bs-original-title="{{ __('create Role') }}">
                                                    <span>{{ __('Add new role') }}</span>
                                                </a>
                                            @endcan
                                        </div>
                                            <a href="javascript:" class="btn btn-primary socialShareButton" id="socialShareButton" tabindex="0">
                                                <i class="ti ti-share text-white"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-icon  d-flex align-items-center justify-content-center">
                                        <svg width="76" height="97" viewBox="0 0 76 97" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.6" d="M67.8832 21.202H64.1445V73.6176C64.1445 76.5965 62.9627 79.4534 60.8593 81.5598C58.7559 83.6662 55.903 84.8495 52.9282 84.8495H15.5408V88.5935C15.5408 90.5794 16.3287 92.484 17.7309 93.8883C19.1332 95.2925 21.0352 96.0814 23.0183 96.0814H67.8832C69.8663 96.0814 71.7683 95.2925 73.1706 93.8883C74.5729 92.484 75.3607 90.5794 75.3607 88.5935V28.6899C75.3607 26.704 74.5729 24.7994 73.1706 23.3951C71.7683 21.9909 69.8663 21.202 67.8832 21.202Z" fill="#6FD943"/>
                                            <rect x="0.0971985" y="0.11055" width="60.5967" height="74.5806" rx="7.98218" fill="#6FD943"/>
                                            </svg>
                                    </div>
                                </div>
                                <div id="sharingButtonsContainer" class="sharingButtonsContainer" style="display: none;">
                                    <div class="Demo1 gap-2 d-flex align-items-center justify-content-center hidden">
                                        <a class="btn btn-light" href="https://www.facebook.com/sharer.php?u=" target="_blank" title="Share on facebook"><i class="fab fa-facebook" style="color: rgb(66, 103, 178);"></i></a>
                                        <a class="btn btn-light" href="https://twitter.com/share?url= : &amp;text=WorkDo%20Dash%20SaaS%20-%20Open%20Source%20ERP%20with%20Multi-Workspace&amp;via=&amp;hashtags=" target="_blank" title="Share on twitter"><i class="fab fa-twitter" style="color: rgb(0, 172, 238);"></i></a>
                                        <a class="btn btn-light" href="https://pinterest.com/pin/create/bookmarklet/?media=https%3A%2F%2Fdash-demo.workdo.io%2Fuploads%2Fmeta%2Fmeta_image.png%3F1696909315&amp;url=&amp;is_video=false&amp;description=WorkDo%20Dash%20SaaS%20-%20Open%20Source%20ERP%20with%20Multi-Workspace" target="_blank" title="Share on pinterest"><i class="fab fa-pinterest" style="color: rgb(230, 0, 35);"></i></a>
                                        <a class="btn btn-light" href="https://www.linkedin.com/shareArticle?url=&amp;title=WorkDo%20Dash%20SaaS%20-%20Open%20Source%20ERP%20with%20Multi-Workspace" target="_blank" title="Share on linkedin"><i class="fab fa-linkedin" style="color: rgb(0, 114, 177);"></i></a>
                                        <a class="btn btn-light" href="https://wa.me/?text=" target="_blank" title="Share on whatsapp"><i class="fab fa-whatsapp" style="color: rgb(30, 125, 52);"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($businessData)
                            @php
                                if ($businessData['enable_businesslink'] == 'on') {
                                    $start_url = url('/').'/'. $businessData['slug'];
                                } elseif ($businessData['enable_domain'] == 'on') {
                                    $start_url = 'https://' . $businessData['domains'] . '/';
                                } else {
                                    $start_url = 'https://' . $businessData['subdomain'] . '/';
                                }
                            @endphp
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 d-flex h-100">
                                <div class="card w-100 mb-0">
                                    <div class="card-body shareqrcode-card">

                                        <div class="mb-3 shareqrcode text-center"></div>
                                        <div class="d-flex copylink-btn-wrapper justify-content-between">
                                            <a href="#!" class="btn w-100 cp_link"
                                                data-link="{{ $start_url }}" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="" data-bs-original-title="{{__('Click to copy business link')}}">
                                                <span>{{ __('Business Link') }}</span>
                                               <div class="copylink-btn-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-copy ms-1">
                                                        <rect x="9" y="9" width="13" height="13" rx="2"
                                                            ry="2"></rect>
                                                        <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                                    </svg>
                                               </div>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 d-flex h-100">
                                <div class="card w-100 mb-0">
                                    <div class="card-body shareqrcode-card">
                                        <img src="{{ asset('storage/qr.png') }}" alt="QR Code">
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-12">
                            <div class="row row-gaps h-100 info-wrapper-row">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 info-wrapper-card">
                                    <div class="dashboard-project-card">
                                        <div class="card-inner  d-flex justify-content-between">
                                            <div class="card-content">
                                                <div class="theme-avtar bg-white">
                                                    <div class="info-icon">
                                                    <i class="ti ti-briefcase dash-micon"></i>
                                                    </div>
                                                </div>
                                                <a href="{{ route('business.index') }}"><h3 class="mt-3 mb-0 text-danger">{{ __('Total Business') }}</h3></a>
                                            </div>
                                            <h3 class="mb-0">{{ $total_bussiness }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 info-wrapper-card">
                                    <div class="dashboard-project-card">
                                        <div class="card-inner  d-flex justify-content-between">
                                            <div class="card-content">
                                                <div class="theme-avtar bg-white">
                                                    <div class="info-icon">
                                                    <i class="ti ti-clipboard-check dash-micon"></i>
                                                    </div>
                                                </div>
                                                <a href="{{ route('appointments.index') }}">
                                                    <h3 class="mt-3 mb-0">{{ __('Total Appointments') }}</h3></a>
                                            </div>
                                            <h3 class="mb-0">{{ $total_app }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 info-wrapper-card">
                                    <div class="dashboard-project-card">
                                        <div class="card-inner  d-flex justify-content-between">
                                            <div class="card-content">
                                                <div class="theme-avtar bg-white">
                                                    <div class="info-icon">
                                                    <i class="ti ti-users dash-micon"></i>
                                                    </div>
                                                </div>
                                                <a href="{{ route('users.index') }}">
                                                    <h3 class="mt-3 mb-0">{{ __('Total Staff') }}</h3></a>
                                            </div>
                                            <h3 class="mb-0">{{ $total_staff }} </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 ">
                            <div class="card">
                                <div class="card-header">
                                    <div class="float-end">
                                        <span class="mb-0 text-sm float-right mt-1">{{ __('Last 15 Days') }}</span>
                                    </div>
                                    <h5 class="mb-0 float-left">{{ __('Platform') }}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div id="user_platform-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-5 col-xl-6 col-lg-6 d-flex flex-column">
                    <div class="card dashboard-theme-card theme-preview theme-preview-1 mb-0">
                        <div class="theme-preview-body">
                            <img src="{{ asset(Storage::url('uploads/card_theme/' . $theme . '/' . $color . '.png')) }}" class="theme_preview_img">

                        </div>
                        <div class="theme-preview-btn text-center mt-3">
                            @if(isset($business1))
                            <a href="{{ route('business.edit',  $business1->id) }}" class="btn btn-primary">{{__('Edit Business')}}</a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-xxl-12 col-xl-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ __('Appointments') }}</h5>
                        </div>
                        <div class="card-body">
                            <div id="apex-storedashborad" data-color="primary" data-height="280"></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6  ol-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="float-end">
                                <span class="mb-0 text-sm float-right mt-1">{{ __('Last 15 Days') }}</span>
                            </div>
                            <h5 class="mb-0 float-left">{{ __('Browser') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div id="pie-storebrowser"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="float-end">
                                <span class="mb-0 text-sm float-right mt-1">{{ __('Last 15 Days') }}</span>
                            </div>
                            <h5 class="mb-0 float-left">{{ __('Device') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div id="pie-storedashborad"></div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Storage Limit Chart --}}
                @if (\Auth::user()->type == 'company')
                    <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>{{ __('Storage Status') }} <small>({{ $users->storage_limit . 'MB' }} /
                                        {{ $plan->storage_limit . 'MB' }})</small></h5>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div id="device-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- Storage Limit Chart End --}}
            </div>
        </div>
        <img src="{{ isset($qr_detail->image) ? $qr_path . '/' . $qr_detail->image : '' }}" id="image-buffers" crossorigin="anonymous"
            style="display: none">
    @endsection

    @push('custom-scripts')
        <script src="{{ asset('custom/js/purpose.js') }}"></script>
            <script src="{{ asset('custom/js/jquery.qrcode.min.js') }}"></script>

        <script type="text/javascript">
            $(document).on("change", "select[name='select_card']", function() {
                var b_id = $("select[name='select_card']").val();
                if (b_id == '0') {
                    window.location.href = '{{ url('/dashboard') }}';
                } else {
                    window.location.href = '{{ url('business/analytics') }}/' + b_id;
                }

            });
        </script>
         <script>
            (function() {
                var options = {
                    chart: {
                        height: 350,
                        type: 'area',
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
                    series: {!! json_encode($chartData['data']) !!},
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

                    grid: {
                        strokeDashArray: 4,
                    },
                    legend: {
                        show: false
                    },

                };
                var chart = new ApexCharts(document.querySelector("#apex-storedashborad"), options);
                chart.render();
            })();

            var options = {
                chart: {
                    height: 250,
                    type: 'donut',
                },
                dataLabels: {
                    enabled: false,
                },
                series: {!! json_encode($devicearray['data']) !!},
                colors: ["#6fd943", '#ffa21d', '#FF3A6E', '#3ec9d6'],
                labels: ["{{ __('Other') }}", "{{ __('Webkit') }}", "{{ __('Android') }}", "{{ __('iPhone') }}"],
                legend: {
                    show: true,
                    position: 'bottom',
                },
            };
            var chart = new ApexCharts(document.querySelector("#pie-storedashborad"), options);
            chart.render();

            var options = {
                chart: {
                    height: 250,
                    type: 'donut',
                },
                dataLabels: {
                    enabled: false,
                },
                series: {!! json_encode($devicearray['data']) !!},
                colors: ["#6fd943", '#ffa21d', '#FF3A6E', '#3ec9d6'],
                labels: ["{{ __('Chrome') }}", "{{ __('Firefox') }}", "{{ __('Internet Explorer') }}",
                    "{{ __('Microsoft Edge') }}"
                ],
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

                function init($this) {
                    var options = {
                        chart: {
                            height: 250,
                            type: 'bar',
                            zoom: {
                                enabled: false
                            },
                            toolbar: {
                                show: false
                            },
                            shadow: {
                                enabled: false,
                            },

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
                            data: {!! json_encode($platformarray['data']) !!},
                        }],
                        xaxis: {
                            labels: {
                                // format: 'MMM',
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
                                text: '{{ __('Platform') }}'
                            },
                            categories: {!! json_encode($platformarray['label']) !!},
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
                        }
                    }
                    // Get data from data attributes
                    var dataset = $this.data().dataset,
                        labels = $this.data().labels,
                        color = $this.data().color,
                        height = $this.data().height,
                        type = $this.data().type;

                    // Inject synamic properties
                    // options.colors = [
                    //     PurposeStyle.colors.theme[color]
                    // ];
                    // options.markers.colors = [
                    //     PurposeStyle.colors.theme[color]
                    // ];
                    options.chart.height = height ? height : 350;
                    // Init chart
                    var chart = new ApexCharts($this[0], options);
                    // Draw chart
                    setTimeout(function() {
                        chart.render();
                    }, 300);
                }

                // Events
                if ($chart.length) {
                    $chart.each(function() {
                        init($(this));
                    });
                }
            })();
        </script>
        {{-- AUTO TOOLTIP FOCUS --}}
        <script>
            $(function() {
                $(".dash-head-link.cust-btn").tooltip().tooltip("show");
                setTimeout(() => {
                    $(".dash-head-link.cust-btn").tooltip().tooltip("hide");

                    $(".cust-btn-creat").tooltip().tooltip("show");
                }, 4000);
            });
            $(function() {
                setTimeout(() => {
                    $(".cust-btn-creat").tooltip().tooltip("hide");
                }, 8000);
            });
        </script>
        <script>
            (function() {
                var options = {
                    series: [{{ number_format($storage_limit, 2) }}],
                    chart: {
                        height: 350,
                        type: 'radialBar',
                        offsetY: -20,
                        sparkline: {
                            enabled: true
                        }
                    },
                    plotOptions: {
                        radialBar: {
                            startAngle: -90,
                            endAngle: 90,
                            track: {
                                background: "#e7e7e7",
                                strokeWidth: '97%',
                                margin: 5, // margin is in pixels
                            },
                            dataLabels: {
                                name: {
                                    show: true
                                },
                                value: {
                                    offsetY: -50,
                                    fontSize: '20px'
                                }
                            }
                        }
                    },
                    grid: {
                        padding: {
                            top: -10
                        }
                    },
                    colors: ["#6FD943"],
                    labels: ['Used'],
                };
                var chart = new ApexCharts(document.querySelector("#device-chart"), options);
                chart.render();
            })();
        </script>
        <script type="text/javascript">
            $('.cp_link').on('click', function() {
                var value = $(this).attr('data-link');
                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val(value).select();
                document.execCommand("copy");
                $temp.remove();
                toastrs('{{ __('Success') }}', '{{ __('Link Copy on Clipboard') }}', 'success');
            });
        </script>
        <script>
            $(document).ready(function() {
                @if ($businessData)
                    var slug = '{{ $businessData->slug }}';
                    var url_link = `{{ route('get.vcard', ['slug' => '__SLUG__']) }}`.replace('__SLUG__', slug);

                    $(`.qr-link`).text(url_link);

                        var foreground_color =
                            `{{ isset($qr_detail->foreground_color) ? $qr_detail->foreground_color : '#000000' }}`;
                        var background_color =
                            `{{ isset($qr_detail->background_color) ? $qr_detail->background_color : '#ffffff' }}`;
                        var radius = `{{ isset($qr_detail->radius) ? $qr_detail->radius : 26 }}`;
                        var qr_type = `{{ isset($qr_detail->qr_type) ? $qr_detail->qr_type : 0 }}`;
                        var qr_font = `{{ isset($qr_detail->qr_text) ? $qr_detail->qr_text : 'vCard' }}`;
                        var qr_font_color =
                            `{{ isset($qr_detail->qr_text_color) ? $qr_detail->qr_text_color : '#f50a0a' }}`;
                        var size = `{{ isset($qr_detail->size) ? $qr_detail->size : 9 }}`;

                        $('.shareqrcode').empty().qrcode({
                            render: 'image',
                            size: 500,
                            ecLevel: 'H',
                            minVersion: 3,
                            quiet: 1,
                            text: url_link,
                            fill: foreground_color,
                            background: background_color,
                            radius: .01 * parseInt(radius, 10),
                            mode: parseInt(qr_type, 10),
                            label: qr_font,
                            fontcolor: qr_font_color,
                            image: $("#image-buffers")[0],
                            mSize: .01 * parseInt(size, 10)
                        });

                @endif
            });
        </script>
        <script>
            var timezone = '{{ !empty($settings['timezone']) ? $settings['timezone'] : 'IST' }}';

            let today = new Date(new Date().toLocaleString("en-US", {
                timeZone: timezone
            }));
            var curHr = today.getHours()
            var target = document.getElementById("greetings");

            if (curHr < 12) {
                target.innerHTML = "Good Morning,";
            } else if (curHr < 17) {
                target.innerHTML = "Good Afternoon,";
            } else {
                target.innerHTML = "Good Evening,";
            }
        </script>

        <script type="text/javascript">
            @if ($businessData)
                $(document).ready(function() {
                    var customURL = {!! json_encode(url('/' . $businessData->slug)) !!};
                    $('.Demo1').socialSharingPlugin({
                        url: customURL,
                        title: $('meta[property="og:title"]').attr('content'),
                        description: $('meta[property="og:description"]').attr('content'),
                        img: $('meta[property="og:image"]').attr('content'),
                        // enable: ['whatsapp', 'facebook', 'twitter', 'pinterest', 'linkedin']
                    });

                    $('.socialShareButton').click(function(e) {
                        e.preventDefault();
                        $('.sharingButtonsContainer').toggle();
                    });
                });
            @endif
        </script>
    @endpush