@extends('layouts.admin')
@php
    // $profile=asset(Storage::url('uploads/avatar/'));
    $profile = \App\Models\Utility::get_file('uploads/avatar/');

@endphp
@section('page-title')
    @if (Auth::user()->type == 'super admin')
        {{ __('Manage Company') }}
    @else
        {{ __('Manage Users') }}
    @endif
@endsection
@section('title')
    @if (Auth::user()->type == 'super admin')
        {{ __('Manage Company') }}
    @else
        {{ __('Manage Users') }}
    @endif
@endsection
@section('action-btn')
    @can('create user')
        <div class="col-xl-12 col-lg-12 col-md-12 d-flex align-items-center justify-content-between justify-content-md-end"
            data-bs-placement="top">
            @if (Auth::user()->type == 'super admin' || Auth::user()->type == 'company' )
                <a href="{{ route('user.list') }}" class="btn btn-sm btn-primary me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('List View') }}"><i class="ti ti-list"></i></a>
            @endif
            @if (Auth::user()->type == 'super admin')
                <a href="#" data-size="md" data-url="{{ route('users.create') }}" data-ajax-popup="true"
                    data-bs-toggle="tooltip" title="{{ __('Create') }}" data-title="{{ __('Create New Company') }}"
                    class="btn btn-sm btn-primary me-1">
                    <i class="ti ti-plus"></i>
                </a>
            @else
                <a href="#" data-size="md" data-url="{{ route('users.create') }}" data-ajax-popup="true"
                    data-bs-toggle="tooltip" title="{{ __('Create') }}" data-title="{{ __('Create New User') }}"
                    class="btn btn-sm btn-primary me-1">
                    <i class="ti ti-plus"></i>
                </a>
            @endif
            @if (Auth::user()->type == 'company')
                <a href="{{ route('userlogs.index') }}" class="btn btn-sm btn-primary btn-icon m-1" data-size="lg"
                    data-bs-whatever="{{ __('UserlogDetail') }}"> <span class="text-white">
                        <i class="ti ti-user" data-bs-toggle="tooltip"
                            data-bs-original-title="{{ __('Userlog Detail') }}"></i></span>
                </a>
            @endif
        </div>
    @endcan
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
    @if (Auth::user()->type == 'super admin')
        <li class="breadcrumb-item active" aria-current="page">{{ __('Company') }}</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">{{ __('User') }}</li>
    @endif
@endsection
@section('content')
    <div class="row user-card-row">
        @foreach ($users as $user)
            <div class="col-xxl-3 col-lg-4 col-sm-6">
                <div class="user-card card">
                    @if (\Auth::user()->type == 'super admin')
                        {{-- for super admin side --}}
                        <div class="card-header border-0 pb-0">
                            <div class="card-header-right">
                                <div class="btn-group card-option">
                                    @if ($user->admin_enable == 'on')
                                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="feather icon-more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu icon-dropdown dropdown-menu-end">
                                            @can('edit user')
                                                <a href="#" class="dropdown-item user-drop"
                                                    data-url="{{ route('users.edit', $user->id) }}" data-ajax-popup="true"
                                                    title="{{ __('Update Company') }}" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-title="{{ __('Update Company') }}"><i
                                                        class="ti ti-pencil"></i><span>{{ __('Edit') }}</span></a>
                                                <a href="#" data-url="{{ route('plan.upgrade', $user->id) }}"
                                                    class="dropdown-item user-drop" data-size="lg" data-bs-placement="top"
                                                    data-bs-toggle="tooltip" data-bs-original-title="{{ __('Upgrade Plan') }}"
                                                    data-ajax-popup="true" data-title="{{ __('Upgrade Plan') }}"><i
                                                        class="ti ti-trophy"></i><span>{{ __('Upgrade Plan') }}</span></a>
                                            @endcan
                                            @can('change password account')
                                                <a href="#" class="dropdown-item user-drop" data-ajax-popup="true"
                                                    data-title="{{ __('Reset Password') }}" title="{{ __('Reset Password') }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-url="{{ route('user.reset', \Crypt::encrypt($user->id)) }}"><i
                                                        class="ti ti-key"></i>
                                                    <span>{{ __('Reset Password') }}</span></a>
                                            @endcan
                                            @can('delete user')
                                                <a href="#" class="bs-pass-para dropdown-item user-drop"
                                                    data-confirm="{{ __('Are You Sure?') }}"
                                                    data-text="{{ __('This action can not be undone. Do you want to continue?') }}"
                                                    data-confirm-yes="delete-form-{{ $user->id }}"
                                                    title="{{ __('Delete') }}" data-bs-toggle="tooltip"
                                                    data-bs-placement="top"><i
                                                        class="ti ti-trash"></i><span>{{ __('Delete') }}</span></a>
                                                {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['users.destroy', $user->id],
                                                    'id' => 'delete-form-' . $user->id,
                                                ]) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                            <a href="{{ route('login.with.company', $user->id) }}"
                                                class="dropdown-item user-drop" title="{{ __('Login As Company') }}"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-original-title="{{ __('Login As Company') }}">
                                                <i class="ti ti-replace"></i>
                                                <span> {{ __('Login As Company') }}</span>
                                            </a>
                                            @if ($user->is_enable_login == 1)
                                                <a href="{{ route('users.login', \Crypt::encrypt($user->id)) }}"
                                                    class="dropdown-item user-drop" title="{{ __('Login Disable') }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="top">
                                                    <i class="ti ti-road-sign"></i>
                                                    <span class="text-danger"> {{ __('Login Disable') }}</span>
                                                </a>
                                            @elseif ($user->is_enable_login == 0 && $user->password == null)
                                                <a href="#"
                                                    data-url="{{ route('user.reset', \Crypt::encrypt($user->id)) }}"
                                                    data-ajax-popup="true" data-size="md"
                                                    title="{{ __('Login Enable') }}" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" class="dropdown-item login_enable user-drop"
                                                    data-title="{{ __('New Password') }}">
                                                    <i class="ti ti-road-sign"></i>
                                                    <span class="text-success"> {{ __('Login Enable') }}</span>
                                                </a>
                                            @else
                                                <a href="{{ route('users.login', \Crypt::encrypt($user->id)) }}"
                                                    class="dropdown-item user-drop" title="{{ __('Login Enable') }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="top">
                                                    <i class="ti ti-road-sign"></i>
                                                    <span class="text-success"> {{ __('Login Enable') }}</span>
                                                </a>
                                            @endif
                                        </div>
                                    @else
                                        <div class="text-center">
                                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="ti ti-lock"></i>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <a href="{{ !empty($user->avatar) ? $profile . $user->avatar : asset(Storage::url('uploads/avatar/avatar.png')) }}"
                                target="_blank" class="user-image rounded border-2 border border-primary m-auto">
                                <img src="{{ !empty($user->avatar) ? $profile . $user->avatar : asset(Storage::url('uploads/avatar/avatar.png')) }}"
                                    class="h-100 w-100">
                            </a>
                            <div class="user-content mt-3">
                                <h5 class="mb-1">{{ $user->name }}</h5>
                                <small>{{ $user->email }}</small>
                            </div>
                            <div class="card mb-0 mt-3">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <h6 class="mb-1">{{ $user->getTotalBusiness() }}</h6>
                                            <p class="text-muted text-sm mb-0">{{ __('Businesses') }}</p>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="mb-1">{{ $user->getTotalAppoinments() }}</h6>
                                            <p class="text-muted text-sm mb-0">{{ __('Appointments') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="actions d-flex mb-1">
                                        <span class="d-block text-sm text-muted"> {{ __('Plan') }} :
                                            {{ !empty($user->currentPlan) ? $user->currentPlan->name : '' }}</span>
                                    </div>
                                    <div class="actions d-flex">
                                        <span class="d-block text-sm text-muted"> {{ __('Plan Expired') }} :
                                            {{ !empty($user->plan_expire_date) ? \Auth::user()->dateFormat($user->plan_expire_date) : __('Lifetime') }}</span>
                                    </div>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="#" data-url="{{ route('business.upgrade', $user->id) }}"
                                        class="btn btn-outline-primary px-3" data-size="lg" data-bs-placement="top"
                                        data-bs-toggle="tooltip" data-bs-original-title="{{ __('Company Info') }}"
                                        data-ajax-popup="true"
                                        data-title="{{ __('Company Info') }}">{{ __('Admin Hub') }}</a>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (Auth::user()->type != 'super admin')
                        {{-- for company side --}}
                        <div class="card-header p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">
                                    <div class="badge p-2 px-3 bg-primary">{{ ucfirst($user->type) }}</div>
                                </h6>
                            </div>
                            <div class="card-header-right">
                                <div class="btn-group card-option">
                                    @if ($user->admin_enable == 'on')
                                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="feather icon-more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu icon-dropdown dropdown-menu-end">
                                            @can('edit user')
                                                <a href="#" class="dropdown-item user-drop"
                                                    data-url="{{ route('users.edit', $user->id) }}" data-ajax-popup="true"
                                                    title="{{ __('Update User') }}" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-title="{{ __('Update User') }}"><i
                                                        class="ti ti-pencil"></i><span>{{ __('Edit') }}</span></a>
                                            @endcan
                                            @can('change password account')
                                                <a href="#" class="dropdown-item user-drop" data-ajax-popup="true"
                                                    data-title="{{ __('Reset Password') }}"
                                                    title="{{ __('Reset Password') }}" data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    data-url="{{ route('user.reset', \Crypt::encrypt($user->id)) }}"><i
                                                        class="ti ti-key"></i>
                                                    <span>{{ __('Reset Password') }}</span></a>
                                            @endcan
                                            @can('delete user')
                                                <a href="#" class="bs-pass-para dropdown-item user-drop"
                                                    data-confirm="{{ __('Are You Sure?') }}"
                                                    data-text="{{ __('This action can not be undone. Do you want to continue?') }}"
                                                    data-confirm-yes="delete-form-{{ $user->id }}"
                                                    title="{{ __('Delete') }}" data-bs-toggle="tooltip"
                                                    data-bs-placement="top"><i
                                                        class="ti ti-trash"></i><span>{{ __('Delete') }}</span></a>
                                                {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['users.destroy', $user->id],
                                                    'id' => 'delete-form-' . $user->id,
                                                ]) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                            <a href="{{ route('userlogs.index', ['month' => '', 'user' => $user->id]) }}"
                                                class="dropdown-item user-drop" data-bs-toggle="tooltip"
                                                data-bs-original-title="{{ __('User Log') }}">
                                                <i class="ti ti-history"></i>
                                                <span>{{ __('Logged Details') }}</span></a>
                                            @if ($user->is_enable_login == 1)
                                                <a href="{{ route('users.login', \Crypt::encrypt($user->id)) }}"
                                                    class="dropdown-item user-drop" title="{{ __('Login Disable') }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="top">
                                                    <i class="ti ti-road-sign"></i>
                                                    <span class="text-danger"> {{ __('Login Disable') }}</span>
                                                </a>
                                            @elseif ($user->is_enable_login == 0 && $user->password == null)
                                                <a href="#"
                                                    data-url="{{ route('user.reset', \Crypt::encrypt($user->id)) }}"
                                                    data-ajax-popup="true" data-size="md"
                                                    title="{{ __('Login Enable') }}" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" class="dropdown-item login_enable user-drop"
                                                    data-title="{{ __('New Password') }}">
                                                    <i class="ti ti-road-sign"></i>
                                                    <span class="text-success"> {{ __('Login Enable') }}</span>
                                                </a>
                                            @else
                                                <a href="{{ route('users.login', \Crypt::encrypt($user->id)) }}"
                                                    class="dropdown-item user-drop" title="{{ __('Login Enable') }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="top">
                                                    <i class="ti ti-road-sign"></i>
                                                    <span class="text-success"> {{ __('Login Enable') }}</span>
                                                </a>
                                            @endif
                                        </div>
                                    @else
                                        <div class="text-center">
                                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="ti ti-lock"></i>
                                            </button>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="user-img-wrp d-flex align-items-center">
                                <a href="{{ !empty($user->avatar) ? asset(Storage::url('uploads/avatar/' . $user->avatar)) : asset(Storage::url('uploads/avatar/avatar.png')) }}"
                                    class="user-image rounded border-2 border border-primary">
                                    <img src="{{ !empty($user->avatar) ? asset(Storage::url('uploads/avatar/' . $user->avatar)) : asset(Storage::url('uploads/avatar/avatar.png')) }}"
                                        class="h-100 w-100">
                                </a>
                                <div class="user-content">
                                    <h5 class="mb-1">{{ $user->name }}</h5>
                                    <small>{{ $user->email }}</small>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
        @can('create user')
            @if (Auth::user()->type == 'super admin')
                <div class="col-xxl-3 col-lg-4 col-sm-6">
                    <a href="#" class="btn-addnew-project border-primary" data-ajax-popup="true" data-size="md"
                        data-title="{{ __('Create New Company') }}" data-url="{{ route('users.create') }}">
                        <div class="badge bg-primary proj-add-icon" data-bs-placement="top" data-bs-toggle="tooltip"
                            data-bs-original-title="{{ __('Create New Company') }}">
                            <i class="ti ti-plus"></i>
                        </div>
                        <h6 class="mt-2 mb-2">{{ __('New Company') }}</h6>
                        <p class="text-muted text-center mb-0">{{ __('Click here to add New Company') }}</p>
                    </a>
                </div>
            @else
                <div class="col-xxl-3 col-lg-4 col-sm-6">
                    <a href="#" class="btn-addnew-project border-primary" data-ajax-popup="true" data-size="md"
                        data-title="{{ __('Create New User') }}" data-url="{{ route('users.create') }}">
                        <div class="badge bg-primary proj-add-icon" data-bs-placement="top" data-bs-toggle="tooltip"
                            data-bs-original-title="{{ __('Create New User') }}">
                            <i class="ti ti-plus"></i>
                        </div>
                        <h6 class="mt-2 mb-2">{{ __('New User') }}</h6>
                        <p class="text-muted text-center mb-0">{{ __('Click here to add New User') }}</p>
                    </a>
                </div>
            @endif
        @endcan
    </div>  
@endsection
