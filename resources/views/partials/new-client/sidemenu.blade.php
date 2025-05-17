@php
    use App\Models\Utility;

    $company_logo = \App\Models\Utility::GetLogo();
    $logo = \App\Models\Utility::get_file('uploads/logo/');
    $user = \Auth::user();
    $bussiness_id = $user->current_business;
    $plan = \App\Models\Plan::getPlansUser($user->plan);
    $module = Nwidart\Modules\Facades\Module::all();
    $activemodule = \App\Models\userActiveModule::getActiveModule();
    // $menus = \App\Models\Utility::getMenu();
    $menus = \App\Models\Utility::moduleIsActive();
    $profile = \App\Models\Utility::get_file('uploads/avatar');
    $menuItems = [
        [
            'label' => 'Profile',
            'route' => 'business.edit',
            'icon' => 'user_interface/profile.svg',
            'params' => ['id' => $bussiness_id],
        ],
        [
            'label' => 'Contact Book',
            'route' => 'business.contacts.show',
            'params' => ['id' => $bussiness_id],
            'icon' => 'user_interface/contact_book.svg',
        ],
        [
            'label' => 'Analytics',
            'route' => 'business.analytics.index',
            'params' => ['business' => $bussiness_id],
            'icon' => 'user_interface/analytics.svg',
        ],
        [
            'label' => 'Support',
            'route' => 'support.index',
            'icon' => 'user_interface/support.svg',
        ],
        [
            'label' => 'Settings',
            'route' => 'new-settings.index',
            'icon' => 'user_interface/settings.svg',
        ],
    ];
    if(!$bussiness_id) array_splice($menuItems, 0, 3);
@endphp
    <!-- Sidebar -->
<div id="sidebar" class="sidebar p-3 position-fixed d-flex flex-column flex-shrink-0">
    {!! svg('/user_interface/close_sidebar.svg', ['class' => 'position-absolute z-3 top-0 me-3 end-0 toggle-sidebar-icon d-block d-md-none', 'id' => 'closeSidebar']) !!}
    <a class="mt-4 mt-xl-2 mb-4" href="{{ url('/') }}">
        <img src="{{ asset('assets/images/icons/logo.svg') }}" alt="" class="logo-img">
    </a>

    <!-- Menu -->
    <nav class="sidebar-nav flex flex-col space-y-2">

        @foreach ($menuItems as $item)
            @php
                $isActive = request()->routeIs($item['route']);
                $routeUrl = isset($item['params'])
                    ? route($item['route'], $item['params'])
                    : route($item['route']);
            @endphp

            <div
                class="d-flex align-items-center gap-2 rounded-2 py-2 px-3 mb-3 {{ $isActive ? 'bg-primary text-white' : '' }}">
                <div class="d-flex align-items-center justify-content-center" style="width: 20px;">
                    {!! svg($item['icon'], [
                        'class' => ($isActive ? 'fill-white' : 'fill-primary') . ' w-100 h-auto'
                    ]) !!}
                </div>
                <a href="{{ $routeUrl }}" class="text-decoration-none {{ $isActive ? 'text-white' : 'text-primary' }}">
                    {{ $item['label'] }}
                </a>
            </div>
        @endforeach

    </nav>

    <!-- Bottom section -->
    <div class="mt-auto">
        @impersonating($guard = null)
        <a class="btn btn-danger w-100 rounded-pill mb-3" href="{{ route('exit.company') }}"><i class="bi bi-ban"></i>
            {{ __('Exit Company Login') }}
        </a>
        @endImpersonating
        <div class="btn btn-primary w-100 mb-3 rounded-pill cursor-auto">{{ $plan->name }}</div>
        <div class="d-none d-md-block dropdown sidebar-user-dropdown">
            <button class="btn w-100 d-flex align-items-center justify-content-between dropdown-toggle" id="myDropdown">
                <span class="d-flex align-items-center gap-2 d-block">
                    <img class="rounded-circle user-avatar" style="width: 36px; height: 36px;"
                         src="{{ !empty($user->avatar) ? $profile . '/' . $user->avatar : $profile . '/avatar.png' }}"
                         alt=""/>
                    <span>{{ \Auth::user()->name }}</span>
                </span>
            </button>

            <ul class="dropdown-menu w-100 shadow rounded border-0 p-2" data-popper-placement="top-start">
                <li class="px-3">
                    <strong>{{ \Auth::user()->name }}</strong><br>
                    <small class="text-muted">{{ \Auth::user()->email }}</small>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a class="dropdown-item d-flex justify-content-between" href="{{ route('new-settings.index') }}">
                        <span>Account Settings</span>
                        <i class="bi bi-gear"></i>
                    </a>
                </li>
                <li><a class="dropdown-item d-flex justify-content-between" href="#"><span>Privacy</span><i
                            class="bi bi-lock"></i></a></li>
                <li><a class="dropdown-item d-flex justify-content-between" href="#"><span>Terms</span><i
                            class="bi bi-file-text"></i></a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item d-flex justify-content-between" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"><span>Logout</span><i
                            class="bi bi-box-arrow-right"></i></a></li>
            </ul>
        </div>
        <div class="d-block d-md-none">
            <button class="btn btn-transparent w-100 mb-4 border-0" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">Sign Out</button>
            <div class="text-12 text-center text-muted">&copy; {{ date('Y') }} Tapeetap. All Rights Reserved</div>
        </div>
    </div>
    <div class="py-5 my-4 d-block d-md-none"></div>
</div>

<form id="frm-logout" action="{{ route('logout') }}" method="POST" class="d-none">
    {{ csrf_field() }}
</form>
