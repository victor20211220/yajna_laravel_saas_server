@extends('layouts.admin')
@section('page-title')
    {{ __('Add-on Manager') }}
@endsection
@section('title')
    {{ __('Add-on Manager') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">
        {{ __('Add On') }}</li>
@endsection
@push('css-page')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <style>
        .system-version h5 {
            position: absolute;
            bottom: -44px;
            right: 27px;
        }

        .center-text {
            display: flex;
            flex-direction: column;
        }

        .center-text .text-primary {
            font-size: 14px;
            margin-top: 5px;
        }

        .theme-main {
            display: flex;
            align-items: center;
        }

        .theme-main .theme-avtar {
            margin-right: 15px;
        }

        @media only screen and (max-width: 575px) {
            .system-version h5 {
                position: unset;
                margin-bottom: 0px;
            }

            .system-version {
                text-align: center;
                margin-bottom: -22px;
            }
        }
    </style>
@endpush
@section('action-btn')
    <div class="text-end">
        <a href="{{ route('module.add') }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title=""
            data-bs-original-title="{{ __('ModuleSetup') }}">
            <i class="ti ti-plus"></i>
        </a>
    </div>
@endsection
@section('content')
    <div class="row justify-content-center px-0">
        <div class="col-12">
            <div class="add-on-banner mb-4">
                <img src="{{ asset('assets/images/add-on-banner-layer.png') }}" class="banner-layer" alt="banner-layer">
                <div class="row  row-gap align-items-center">
                    <div class="col-xxl-4 col-md-6 col-12">
                        <div class="add-on-banner-image">
                            <img src="{{ asset('assets/images/add-on-banner-image.png') }}" alt="banner-image" >
                        </div>
                    </div>
                    <div class="col-xxl-4 col-md-6 col-12">
                        <div class="add-on-banner-content text-center ">
                            <a href="https://workdo.io/vcardgo-saas-addon/" class="btn btn-light mb-3">
                                <img src="{{ asset('assets/images/workdo-logo.jpg') }}" alt="">
                                <span>Click Here</span>
                            </a>
                            <h2>{{ __('Buy More Add-on') }}</h2>
                            <p>{{ __('+' . $addOnsCount) }}<span>{{ __('Premium Add-on') }}</span></p>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-12">
                        <div class="add-on-btn d-flex flex-wrap align-items-center justify-content-xxl-end justify-content-center gap-2">
                            <a class="btn btn-primary" href="https://workdo.io/vcardgo-saas-addon/" target="new">
                            {{ __('Buy More Add-on') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ sample-page ] start -->
        <div class="event-cards col-12">
            @if (\Auth::user()->type == 'super admin')
                @if (count($modules)-1)<h3 class="mb-3">{{ __('Installed Add-on') }}</h3>
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row row-gap">
                                @foreach ($modules as $module)
                                    @if ($module->getName() != 'LandingPage' && $module->getName() != 'QRCode')
                                        @php
                                            $module_name = $module->getName();
                                            $id = strtolower(preg_replace('/\s+/', '_', $module_name));
                                            $path = $module->getPath() . '/module.json';
                                            $json = json_decode(file_get_contents($path), true);
                                        @endphp
                                        @if (!isset($json['display']) || $json['display'] == true || $module_name == 'GoogleCaptcha')
                                            <div class="col-xxl-3 col-xl-4 col-sm-6">
                                                <div class="addon-card {{ $module->isEnabled() ? 'enable_module' : 'disable_module' }}">
                                                    <div class="addon-card-image">
                                                        <img src="{{ \App\Models\Utility::get_module_img($module->getName()) }}"
                                                            alt="{{ $module->getName() }}" class="img-user"
                                                            style="max-width: 100%">
                                                    </div>
                                                    <div class="addon-card-content d-flex align-items-center justify-content-between">
                                                        <div class="addon-content-top">
                                                            <div class="text-muted mb-2">
                                                                @if ($module->isEnabled())
                                                                    <span class="badge bg-success">{{ __('Enable') }}</span>
                                                                @else
                                                                    <span class="badge bg-danger">{{ __('Disable') }}</span>
                                                                @endif
                                                            </div>
                                                            <h5 class="text-capitalize">{{ \App\Models\Utility::Module_Alias_Name($module->getName()) }}</h5>
                                                            <p class="text-muted text-sm mb-0">
                                                                {{ isset($json['description']) ? $json['description'] : '' }}
                                                            </p>
                                                        </div>
                                                        <div class="btn-group card-option">
                                                            <button type="button" class="btn border-0 p-0" data-bs-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                <i class="ti ti-dots-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu icon-dropdown dropdown-menu-end" style="">
                                                                @if ($module->isEnabled())
                                                                    <a href="#!" class="dropdown-item user-drop module_change"
                                                                        data-id="{{ $id }}" data-bs-placement="top" data-bs-toggle="tooltip"
                                                                        title="{{__('Disable')}}" data-bs-original-title="{{ __('Disable') }}">
                                                                        <i class="ti ti-road-sign"></i>
                                                                        <span>{{ __('Disable') }}</span>
                                                                    </a>
                                                                @else
                                                                    <a href="#!" class="dropdown-item user-drop module_change"
                                                                        data-id="{{ $id }}" data-bs-placement="top" data-bs-toggle="tooltip"
                                                                        title="{{__('Enable')}}" data-bs-original-title="{{ __('Enable') }}">
                                                                        <i class="ti ti-road-sign"></i>
                                                                        <span>{{ __('Enable') }}</span>
                                                                    </a>
                                                                @endif
                                                                <form action="{{ route('module.enable') }}" method="POST"
                                                                    id="form_{{ $id }}">
                                                                    @csrf
                                                                    <input type="hidden" name="name"
                                                                        value="{{ $module->getName() }}">
                                                                </form>

                                                                <a href="#"
                                                                    class="dropdown-item user-drop bs-pass-para"
                                                                    data-confirm="{{ __('Are You Sure?') }}"
                                                                    data-text="{{ __('This action can not be undone. Do you want to continue?') }}"
                                                                    data-confirm-yes="delete-form-{{ $id }}"
                                                                    title="{{ __('Remove') }}" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top">
                                                                    <i class="ti ti-trash"></i>
                                                                    <span class="text-danger">{{ __('Remove') }}</span>
                                                                </a>

                                                                {!! Form::open([
                                                                    'method' => 'DELETE',
                                                                    'route' => ['module.remove', $module->getName()],
                                                                    'id' => 'delete-form-' . $id,
                                                                ]) !!}
                                                                {!! Form::close() !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            @if (\Auth::user()->type == 'super admin')
                <h3 class="mb-3">{{ __('Explore Add-on') }}</h3>
            @endif

            @foreach ($category_wise_add_ons as $key => $category_wise_add_on)
                <div id="tab-{{ $key }}" class="card add_on_manager mb-0">
                    <div class="card-body p-3">
                        <div class="row row-gap">
                            @foreach ($category_wise_add_on as $key => $add_on)
                                <div class="col-xxl-3 col-xl-4 col-sm-6">
                                    <div class="addon-card">
                                        <div class="addon-card-image">
                                            <a href="{{ $add_on['url'] }}" target="_new">
                                                <img src="{{ $add_on['image'] }}" alt="" class="img-user" style="max-width: 100%">
                                            </a>
                                        </div>
                                        <div class="addon-card-content">
                                            <div class="addon-content-top text-center">
                                                <h5 class="text-capitalize"> {{ $add_on['aliasname'] }}</h5>
                                            </div>
                                            <div class="addon-content-bottom d-flex gap-2">
                                                <a href="{{ $add_on['url'] }}" target="_new"
                                                    class="module-link btn btn-primary text-capitalize w-100">
                                                    @if ($add_on['buynow_status']==1)
                                                        {{ __('Buy Now') }}
                                                    @else
                                                        {{ __('Coming Soon') }}
                                                    @endif
                                                </a>
                                                @if ($add_on['buynow_status']==1)
                                                    <a href="javascript:;" class="module-preview btn btn-light-primary text-capitalize w-100" title="Preview" data-name="{{ $add_on['name'] }}">
                                                        {{ __('Preview') }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="hover-img-addon btn-primary">
            <button class="close-addon-btn">
                <svg xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path
                        d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                </svg>
            </button>
            <div class="swiper">
                <div class="module-swiper-container">
                    <div class="swiper-wrapper">
                        <!-- Swiper slides will be dynamically appended here -->
                    </div>
                </div>
                <span class="swiper-button-prev"></span>
                <span class="swiper-button-next"></span>
            </div>
        </div>
    </div>

    <div class="system-version">
        @php
            $version = config('verification.system_version');
        @endphp
        {{-- <h5 class="text-muted">{{ (!empty($version) ? 'V'.$version : '')}}</h5> --}}
    </div>
@endsection
@push('custom-scripts')
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


    <script>
        $(document).on('click', '.module_change', function() {
            var id = $(this).attr('data-id');
            $('#form_' + id).submit();
        });
    </script>

    <script>
        $(".module-preview").click(function() {
            $(".hover-img-addon").toggleClass("open");
            $("body").toggleClass("no-scroll");
        });
        $(".close-addon-btn").click(function() {
            $(".hover-img-addon").removeClass("open");
            $("body").removeClass("no-scroll");
        });
        $(".module-preview").click(function() {
            // Retrieve the add-on name from the data-name attribute
            var addOnName = $(this).data('name');
            var jsonData = {!! json_encode($category_wise_add_ons) !!};


            // Find the corresponding add-on object from your JSON data
            var addOn = jsonData.add_ons.find(function(item) {
                return item.name === addOnName;
            });

            // Populate the swiper container with preview images
            var swiperWrapper = $(".swiper-wrapper");
            swiperWrapper.empty(); // Clear previous images

            addOn.preview.forEach(function(imageUrl) {
                swiperWrapper.append('<div class="swiper-slide"><img src="' + imageUrl + '"></div>');
            });

            // Initialize Swiper
            var swiper = new Swiper('.module-swiper-container', {
                // Optional parameters
                slidesPerView: 1,
                loop: true,
                mousewheel: false,
                keyboard: {
                    enabled: true
                },

                // If you need pagination

                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev"
                },
            });

            // Open the swiper modal or container
            // Example: $("#myModal").modal("show");
        });
    </script>
@endpush
