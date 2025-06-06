@php
    use App\Models\Utility;

    $company_logo = \App\Models\Utility::GetLogo();
    $logo = \App\Models\Utility::get_file('uploads/logo/');
    $users = \Auth::user();
    $bussiness_id = '';
    $bussiness_id = $users->current_business;
    $plan = \App\Models\Plan::getPlansUser($users->plan);
    $module = Nwidart\Modules\Facades\Module::all();
    $activemodule = \App\Models\userActiveModule::getActiveModule();
    // $menus = \App\Models\Utility::getMenu();
    $menus = \App\Models\Utility::moduleIsActive();


@endphp

<!-- [ navigation menu ] start -->

@if (isset($setting['cust_theme_bg']) && $setting['cust_theme_bg'] == 'on')
    <nav class="dash-sidebar light-sidebar transprent-bg">
    @else
        <nav class="dash-sidebar light-sidebar">
@endif

<div class="navbar-wrapper">
    <div class="m-header main-logo">
        <a href="#" class="b-brand">

            @if ($setting['cust_darklayout'] == 'on')
                <img src="{{ $logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-light.png') . '?' . time() }}"
                    alt="" class="img-fluid" />
            @else
                <img src="{{ $logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png') . '?' . time() }}"
                    alt="" class="img-fluid" />
            @endif

        </a>
    </div>
    <div class="navbar-content">
        <ul class="dash-navbar">

            <li
                class="dash-item {{ Request::segment(1) == 'home' || Request::segment(1) == '' || Request::segment(1) == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('home') }}" class="dash-link"><span class="dash-micon"><i
                            class="ti ti-home"></i></span><span class="dash-mtext">{{ __('Dashboard') }}</span></a>

            </li>
            @if (Auth::user()->type != 'super admin')
                <li class="dash-item dash-hasmenu">
                    <a class="dash-link {{ Request::segment(1) == 'new_business' || Request::segment(1) == 'business' ? 'active' : '' }}"
                        data-toggle="collapse" role="button"
                        aria-expanded="{{ Request::segment(1) == 'new_business' || Request::segment(1) == 'business' ? 'true' : 'false' }}"
                        aria-controls="navbar-getting-started"><span class="dash-micon"><i
                                class="ti ti-credit-card"></i></span><span
                            class="dash-mtext">{{ __('Business') }}</span><span class="dash-arrow"><i
                                data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="dash-submenu">
                        @if (\Auth::user()->can('create business'))
                            @impersonating($guard = null)
                            <li class="dash-item {{ Request::segment(1) == 'new_business' ? 'active' : '' }}">
                                <a href="#" class="dash-link" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" data-url="{{ route('business.create') }}"
                                    data-size="xl" data-bs-whatever="{{ __('Create New Business') }}">
                                    {{ __('Create Business') }}
                                </a>
                            </li>
                            @endImpersonating
                        @endif
                        @if (\Auth::user()->can('manage business'))
                            <li class="dash-item {{ Request::segment(1) == 'business' ? 'active' : '' }}">
                                <a class="dash-link" href="{{ route('business.index') }}">{{ __('Business') }}</a>

                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if (Auth::user()->type != 'super admin')

                <li
                    class="dash-item dash-hasmenu {{ Request::segment(1) == 'users' || Request::segment(1) == 'roles' || Request::segment(1) == 'userlogs' ? 'active dash-trigger' : '' }}">
                    <a class="dash-link " data-toggle="collapse" role="button"
                        aria-expanded="{{ Request::segment(1) == 'users' || Request::segment(1) == 'roles' || Request::segment(1) == 'userlogs' ? 'true' : 'false' }}"
                        aria-controls="navbar-getting-started"><span class="dash-micon"><i
                                class="ti ti-users"></i></span><span class="dash-mtext">{{ __('Staff') }}</span><span
                            class="dash-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="dash-submenu">
                        @if (Gate::check('manage user'))
                            <li
                                class="dash-item dash-hasmenu {{ Request::segment(1) == 'users' ? 'active open' : '' }}">
                                <a class="dash-link"
                                    {{ Request::route()->getName() == 'users.index' || Request::route()->getName() == 'users.create' || Request::route()->getName() == 'users.edit' ? ' active' : '' }}
                                    href="{{ route('users.index') }}">{{ __('Users') }}</span></a>
                            </li>
                        @endif
                        @if (Auth::user()->type == 'company')
                            <li
                                class="dash-item dash-hasmenu {{ Request::segment(1) == 'roles' ? 'active open' : '' }}">
                                <a class="dash-link" href="{{ route('roles.index') }}">{{ __('Roles') }}</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @else
                <li class="dash-item dash-hasmenu {{ Request::segment(1) == 'users' || Request::route()->getName() == 'user.list' ? ' active dash-trigger' : 'collapsed' }}">
                    <a href="{{ route('users.index') }}"
                        class="dash-link {{ request()->is('user.list') ? 'active' : '' }}">
                        <span class="dash-micon">
                            <i class="ti ti-user"></i>
                        </span>
                        <span class="dash-mtext">{{ __('Companies') }}</span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->type == 'super admin')
                <li class="d-none dash-item dash-hasmenu {{ Request::segment(1) == 'nfc' ? 'active dash-trigger' : '' }}">
                    <a class="dash-link " data-toggle="collapse" role="button"
                        aria-expanded="{{ Request::segment(1) == 'nfc' ? 'true' : 'false' }}"
                        aria-controls="navbar-getting-started"><span class="dash-micon"><i
                                class="ti ti-nfc"></i></span><span
                            class="dash-mtext">{{ __('NFC Business Card') }}</span><span class="dash-arrow"><i
                                data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="dash-submenu">

                        <li class="dash-item dash-hasmenu {{ Request::segment(1) == 'nfc' ? 'active open' : '' }}">
                            <a class="dash-link"
                                {{ Request::route()->getName() == 'nfc.index' || Request::route()->getName() == 'nfc.create' || Request::route()->getName() == 'nfc.edit' ? ' active' : '' }}
                                href="{{ route('nfc.index') }}">{{ __('NFC Card') }}</span></a>
                        </li>


                        <li
                            class="dash-item dash-hasmenu {{ Request::segment(1) == 'nfcorder' ? 'active open' : '' }}">
                            <a class="dash-link"
                                href="{{ route('order.request.index') }}">{{ __('Order Request') }}</a>
                        </li>

                    </ul>
                </li>
            @endif
            @if (Auth::user()->type == 'company')
                <li class="dash-item {{ Request::segment(1) == 'nfc' ? 'active' : '' }}">
                    <a href="{{ route('nfc.index') }}" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-nfc"></i></span><span class="dash-mtext">{{ __('NFC Card') }}</span></a>

                </li>
            @endif

            @if (\Auth::user()->can('manage appointment'))
                <li class="dash-item {{ Request::segment(1) == 'appointments' ? 'active' : '' }}">
                    <a href="{{ route('appointments.index') }}" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-calendar-time"></i></span><span
                            class="dash-mtext">{{ __('Appointments') }}</span></a>

                </li>
            @endif
            @if (\Auth::user()->can('manage contact'))
                <li class="dash-item {{ Request::segment(1) == 'contacts' ? 'active' : '' }}">
                    <a href="{{ route('contacts.index') }}" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-phone"></i></span><span
                            class="dash-mtext">{{ __('Contacts') }}</span></a>

                </li>
            @endif
            @if (\Auth::user()->can('calendar appointment'))
                <li class="dash-item {{ Request::segment(1) == 'appointment-calendar' ? 'active' : '' }}">
                    <a href="{{ route('appointment.calendar') }}" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-calendar"></i></span><span
                            class="dash-mtext">{{ __('Calendar') }}</span></a>

                </li>
                </li>
            @endif


            @if (count($menus) > 0 && Auth::user()->type != 'super admin')
                <li class="dash-item dash-hasmenu">
                    <a class="dash-link {{ Request::segment(1) == 'employee' || Request::segment(1) == 'client' ? 'active' : '' }}"
                        data-toggle="collapse" role="button"
                        aria-expanded="{{ Request::segment(1) == 'employee' || Request::segment(1) == 'client' ? 'true' : 'false' }}"
                        aria-controls="navbar-getting-started"><span class="dash-micon"><i
                                class="ti ti-qrcode"></i></span><span
                            class="dash-mtext">{{ __('Qr Code') }}
                            <span class="animate-character d-block">{{ __('Add-on') }}</span></span>
                            <span class="dash-arrow"><i
                                data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="dash-submenu">
                        @foreach ($menus as $module)
                                <li class="dash-item dash-hasmenu">
                                    <a class="dash-link"
                                        {{ Request::route()->getName() == $module['module'] ? 'active' : '' }}
                                        href="{{ route($module['route']) }}">{{ \App\Models\Utility::Module_Alias_Name($module['module']) }}</span></a>
                                </li>
                        @endforeach
                    </ul>
                </li>
            @endif
            @if (\Auth::user()->type != 'super admin')
            <li
                class="dash-item {{ \Request::route()->getName() == 'marketplace' || \Request::route()->getName() == 'marketplace' ? 'active' : '' }}">
                <a href="{{ route('marketplace.home') }}" class="dash-link" target="_blank"><span class="dash-micon"><i
                            class="ti ti-briefcase "></i></span><span class="dash-mtext">{{ __('Business Directory') }}</span></a>

            </li>
            @endif

            @if (\Auth::user()->can('manage plan'))
                <li
                    class="dash-item {{ \Request::route()->getName() == 'plans' || \Request::route()->getName() == 'stripe' ? 'active' : '' }}">
                    <a href="{{ route('plans.index') }}" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-award "></i></span><span
                            class="dash-mtext">{{ __('Plans') }}</span></a>

                </li>
            @endif
            @if (Auth::user()->type == 'company')
                <li class="dash-item d-none {{ Request::route()->getName() == 'referral.index' ? 'active' : '' }}">
                    <a href="{{ route('referral.index') }}" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-discount-2"></i></span><span
                            class="dash-mtext">{{ __('Referral Program') }}</span></a>

                </li>
            @endif
            @if (Auth::user()->type == 'super admin')
                <li class="dash-item d-none {{ Request::route()->getName() == 'plan_request.index' ? 'active' : '' }}">
                    <a href="{{ route('plan_request.index') }}" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-brand-telegram"></i></span><span
                            class="dash-mtext">{{ __('Plan Request') }}</span></a>

                </li>
                <li class="dash-item {{ Request::route()->getName() == 'referral.index' ? 'active' : '' }}">
                    <a href="{{ route('referral.index') }}" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-discount-2"></i></span><span
                            class="dash-mtext">{{ __('Referral Program') }}</span></a>

                </li>
                <li class="dash-item d-none {{ Request::route()->getName() == 'domain_request.index' ? 'active' : '' }}">
                    <a href="{{ route('domain_request.index') }}" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-browser"></i></span><span
                            class="dash-mtext">{{ __('Domain Request') }}</span></a>

                </li>
                <li class="dash-item d-none {{ Request::segment(1) == 'coupons' ? 'active' : '' }}">
                    <a href="{{ route('coupons.index') }}" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-gift"></i></span><span class="dash-mtext">{{ __('Coupons') }}</span></a>

                </li>

                <li class="dash-item {{ Request::segment(1) == 'order' ? 'active' : '' }}">
                    <a href="{{ route('order.index') }}" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-shopping-cart"></i></span><span
                            class="dash-mtext">{{ __('Order') }}</span></a>

                </li>
                <li class="dash-item {{ Request::segment(1) == 'email_template_lang' ? 'active' : '' }}">
                    <a href="{{ route('email-templates.index') }}" class="dash-link"><span
                            class="dash-micon"><i class="ti ti-mail"></i></span><span
                            class="dash-mtext">{{ __('Email Template') }}</span></a>

                </li>
            @endif

            @if (\Auth::user()->type == 'super admin')
                @include('landingpage::menu.landingpage')
            @endif
            @if (Auth::user()->type == 'super admin')
                <li class="dash-item {{ Request::segment(1) == 'add-on' ? 'active' : '' }}">
                    <a href="{{ route('module.index') }}" class="dash-link d-flex align-items-center"><span
                            class="dash-micon"><i class="ti ti-layout-2"></i></span><span
                            class="dash-mtext">{{ __('Add-on Manager') }}
                            <span class="d-block animate-character">{{ __('Premium') }}</span></span>
                    </a>

                </li>
            @endif
            @if (\Auth::user()->type == 'super admin')
            <li
                class="dash-item d-none {{ \Request::route()->getName() == 'marketplace' || \Request::route()->getName() == 'marketplace' ? 'active' : '' }}">
                <a href="{{ route('marketplace.home') }}" class="dash-link" target="_blank"><span class="dash-micon"><i
                            class="ti ti-briefcase "></i></span><span class="dash-mtext">{{ __('Business Directory') }}</span></a>

            </li>
            @endif
            @if (\Auth::user()->type == 'super admin')
                <li
                    class="dash-item d-none dash-hasmenu {{ Request::segment(1) == 'campaigns' ? 'active dash-trigger' : '' }}">
                    <a class="dash-link " data-toggle="collapse" role="button"
                        aria-expanded="{{ Request::segment(1) == 'campaigns' ? 'true' : 'false' }}"
                        aria-controls="navbar-getting-started"><span class="dash-micon"><i
                                class="ti ti-nfc"></i></span><span
                            class="dash-mtext">{{ __('Marketplace') }}</span><span class="dash-arrow"><i
                                data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="dash-submenu">

                        <li
                            class="dash-item dash-hasmenu {{ Request::segment(1) == 'campaigns' ? 'active open' : '' }}">
                            <a class="dash-link"
                                {{ Request::route()->getName() == 'campaigns.index' || Request::route()->getName() == 'campaigns.create' || Request::route()->getName() == 'campaigns.edit' ? ' active' : '' }}
                                href="{{ route('campaigns.index') }}">{{ __('Campaigns') }}</span></a>
                        </li>
                        <li
                            class="dash-item dash-hasmenu {{ Request::route()->getName() == 'category.index' || Request::route()->getName() == 'business.setup' }}">
                            <a class="dash-link" href="{{ route('category.index') }}">{{ __('System Setup') }}</a>
                        </li>

                    </ul>
                </li>
            @else
                <li class="dash-item {{ Request::segment(1) == 'campaigns' ? 'active' : '' }}">
                    <a href="{{ route('campaigns.index') }}" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-package"></i></span><span
                            class="dash-mtext">{{ __('Campaigns') }}</span></a>

                </li>
            @endif

            @if (\Auth::user()->can('manage company setting'))
                <li class="dash-item {{ Request::segment(1) == 'systems' ? 'active' : '' }}">
                    <a href="{{ route('systems.index') }}" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-settings"></i></span><span
                            class="dash-mtext">{{ __('Settings') }}</span></a>

                </li>
            @elseif(\Auth::user()->can('manage system setting'))
                <li class="dash-item {{ Request::segment(1) == 'systems' ? 'active' : '' }}">
                    <a href="{{ route('systems.index') }}" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-settings"></i></span><span
                            class="dash-mtext">{{ __('Settings') }}</span></a>

                </li>
            @endif

        </ul>
    </div>
</div>
</nav>
