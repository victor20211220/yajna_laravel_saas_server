@php
    use App\Models\Utility;

    $user = \Auth::user();
    $business_id = $user->current_business;
    $business = \App\Models\Business::findOrFail($business_id);

    $plan = \App\Models\Plan::getPlansUser($user->plan);
    $logo = Utility::get_file('card_logo');

    $menuItems = [
        [
            'label' => 'Profile',
            'route' => 'business.edit',
            'icon' => 'user_interface/profile.svg',
        ],
        [
            'label' => 'Contact Book',
            'route' => 'business.contacts.show',
            'icon' => 'user_interface/contact_book.svg',
        ],
        [
            'label' => 'Analytics',
            'route' => 'business.analytics.index',
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
    if(!$business_id) array_splice($menuItems, 0, 3);
@endphp
    <!-- Sidebar -->
<div id="sidebar" class="sidebar p-3 position-fixed d-flex flex-column flex-shrink-0">
    {!! svg('/user_interface/close_sidebar.svg', ['class' => 'position-absolute z-3 top-0 me-3 end-0 toggle-sidebar-icon', 'id' => 'closeSidebar']) !!}
    <a class="mt-4 mt-md-2 mb-4 text-center" href="{{ url('/') }}">
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

            <a href="{{ $routeUrl }}"
                class="{{ $isActive ? 'bg-primary text-white' : '' }} d-flex align-items-center gap-2 rounded-2 py-2 px-3 mb-3 menu-link text-decoration-none">
                <span class="d-flex align-items-center justify-content-center" style="width: 20px;">
                    {!! svg($item['icon'], [
                        'class' => ($isActive ? 'fill-white' : 'fill-primary') . ' w-100 h-auto'
                    ]) !!}
                </span>
                <span>
                    {{ $item['label'] }}
                </span>
            </a>
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
        <div class="d-none d-md-block dropdown">
            <button class="btn w-100 d-flex align-items-center justify-content-between dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
                <span class="d-flex align-items-center gap-2 d-block">
                    <img class="rounded-circle user-avatar" style="width: 36px; height: 36px;"
                         src="{{ $business->logo ? $logo.'/'.$business->logo: Utility::imagePlaceholderUrl() }}"
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
                <li><a class="dropdown-item d-flex justify-content-between" href="{{ route('about.privacy') }}"><span>Privacy</span><i
                            class="bi bi-lock"></i></a></li>
                <li><a class="dropdown-item d-flex justify-content-between" href="{{ route('about.terms') }}"><span>Terms</span><i
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
            <button class="btn btn-transparent w-100 mb-4 border-0"
                    onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">Sign Out
            </button>
            <div class="text-center">
                <a href="{{ route('about.privacy') }}" class="text-decoration-none me-2 app-text-secondary">Terms of Use</a>
                <span class="mx-1 app-text-secondary">|</span>
                <a href="{{ route('about.terms') }}" class="text-decoration-none ms-2 app-text-secondary">Privacy Policy</a>
            </div>
        </div>
    </div>
    <div class="py-5 my-4 d-block d-md-none"></div>
</div>

<form id="frm-logout" action="{{ route('logout') }}" method="POST" class="d-none">
    {{ csrf_field() }}
</form>
