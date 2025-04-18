@extends('layouts.admin')
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
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
    @if (Auth::user()->type == 'super admin')
        <li class="breadcrumb-item active" aria-current="page">{{ __('Company') }}</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">{{ __('User') }}</li>
    @endif
@endsection
@section('action-btn')
    <div class="pr-2 d-flex align-items-center gap-2 rating-btn-wrapper">
        @if (Auth::user()->type == 'super admin' || Auth::user()->type == 'company')
            <a href="{{ route('users.index') }}" class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip"
            data-bs-placement="top" title="{{ __('Grid View') }}"><i class="ti ti-layout-grid"></i></a>
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
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-0">
                <div class="card-body table-border-style">
                    <h5></h5>
                    <div class="table-responsive">
                        <table class="table" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th> {{ __('Avtar') }}</th>
                                    <th> {{ __('Name') }}</th>
                                    <th> {{ __('E-mail') }}</th>
                                    <th>{{ __('Type') }}</th>
                                    <th> {{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $profile = \App\Models\Utility::get_file('uploads/avatar/');
                                @endphp
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <span class="avatar">
                                                <a href="{{ !empty($user->avatar) ? $profile . $user->avatar : asset(Storage::url('uploads/avatar/avatar.png')) }}" target="_blank" >
                                                    <img src="{{ !empty($user->avatar) ? $profile . $user->avatar : asset(Storage::url('uploads/avatar/avatar.png')) }}" height="40px" width="40px" class=" rounded border-2 border border-primary m-auto" >
                                                </a>
                                            </span>
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td><span class="badge bg-primary p-2 px-3 tbl-btn-w">{{ $user->type }}</span></td>
                                        <td class="" style="width: 200px;">
                                            @if ($user->admin_enable == 'on')
                                                @if (\Auth::user()->type == 'super admin')
                                                    <div class="action-btn  me-2">
                                                        <a href="{{ route('login.with.company', $user->id) }}"
                                                            class="btn-primary-subtle btn btn-sm align-items-center text-white" title="{{ __('Login As Company') }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="top" 
                                                            data-bs-original-title="{{ __('Login As Company') }}">
                                                            <i class="ti ti-replace"></i>
                                                        </a>
                                                    </div>
                                                    <div class="action-btn me-2">
                                                        <a data-url="{{ route('business.upgrade', $user->id) }}"
                                                            class="btn bg-warning-subtle btn-sm align-items-center text-white"
                                                            data-ajax-popup="true" data-size="lg" data-bs-toggle="tooltip"
                                                            data-title="{{ __('Company Info') }}"
                                                            title="{{ __('Company Info') }}">
                                                            <i class="ti ti-atom"></i>
                                                        </a>
                                                    </div>
                                                    @can('edit user')
                                                        <div class="action-btn me-2">
                                                            <a href="#" data-url="{{ route('plan.upgrade', $user->id) }}"
                                                                class="btn bg-brown-subtitle btn-sm align-items-center text-white" data-size="lg" data-bs-placement="top"
                                                                data-bs-toggle="tooltip" data-bs-original-title="{{ __('Upgrade Plan') }}"
                                                                data-ajax-popup="true" data-title="{{ __('Upgrade Plan') }}">
                                                                <i class="ti ti-trophy"></i>
                                                            </a>
                                                        </div>
                                                    @endcan
                                                @endif
                                            <div class="action-btn me-2">
                                                <a href="#"
                                                    class="mx-3 bg-light-blue-subtitle btn btn-sm  align-items-center text-white"
                                                    data-size="md"
                                                    data-url="{{ route('user.reset', \Crypt::encrypt($user->id)) }}"
                                                    data-ajax-popup="true" title="{{ __('Reset Password') }}"
                                                    data-bs-toggle="tooltip"
                                                    data-title="{{ __('Reset Password') }}">
                                                    <i class="ti ti-key"></i>
                                                </a>
                                            </div>
                                            @if ($user->is_enable_login == 1)
                                                <div class="action-btn  me-2">
                                                    <a href="{{ route('users.login', \Crypt::encrypt($user->id)) }}"
                                                        class="mx-3 bg-danger btn btn-sm  align-items-center"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-original-title="{{ __('Login Disable') }}"> <span
                                                            class="text-white"><i class="ti ti-road-sign"></i></a>
                                                </div>
                                            @elseif ($user->is_enable_login == 0 && $user->password == null)
                                                <div class="action-btn me-2">
                                                    <a href="#"
                                                        data-url="{{ route('user.reset', \Crypt::encrypt($user->id)) }}"
                                                        data-ajax-popup="true" data-size="md"
                                                        class="mx-3 bg-light-green-subtitle btn btn-sm  align-items-center login_enable"
                                                        data-titgle="{{ __('New Password') }}"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-original-title="{{ __('New Password') }}"> <span
                                                            class="text-white"><i class="ti ti-road-sign"></i></a>
                                                </div>
                                            @else
                                                <div class="action-btn me-2">
                                                    <a href="{{ route('users.login', \Crypt::encrypt($user->id)) }}"
                                                        class="mx-3 bg-success btn btn-sm  align-items-center login_enable"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-original-title="{{ __('Login Enable') }}"> <span
                                                            class="text-white"> <i class="ti ti-road-sign"></i>
                                                    </a>
                                                </div>
                                            @endif
                                                @can('edit user')
                                                    <div class="action-btn me-2">
                                                        <a href="#" class="mx-3 bg-info btn btn-sm  align-items-center text-white"
                                                            data-url="{{ route('users.edit', $user->id) }}" data-ajax-popup="true"
                                                            title="{{ __('Update User') }}" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" data-title="{{ __('Update User') }}"><i
                                                        class="ti ti-pencil"></i></a>
                                                    </div>
                                                @endcan
                                                @if (\Auth::user()->type != 'super admin')
                                                    <div class="action-btn me-2">

                                                        <a href="{{ route('userlogs.index', ['month' => '', 'user' => $user->id]) }}"
                                                            class="mx-3 bg-warning btn btn-sm  align-items-center text-white" data-bs-toggle="tooltip"
                                                            data-bs-original-title="{{ __('User Log') }}">
                                                            <i class="ti ti-eye"></i>
                                                        </a>
                                                    </div>
                                                @endif        
                                                @can('delete user')
                                                    <div class="action-btn">
                                                        {{-- {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id]]) !!}
                                                        <a href="#!"
                                                            class="mx-3 bg-danger btn btn-sm align-items-center text-white show_confirm"
                                                            data-bs-toggle="tooltip" title='Delete'>
                                                            <i class="ti ti-trash"></i>
                                                        </a>
                                                        {!! Form::close() !!} --}}



                                                        <a href="#" class="bs-pass-para mx-3 bg-danger btn btn-sm align-items-center text-white show_confirm"
                                                        data-confirm="{{ __('Are You Sure?') }}"
                                                        data-text="{{ __('This action can not be undone. Do you want to continue?') }}"
                                                        data-confirm-yes="delete-form-{{ $user->id }}"
                                                        title="{{ __('Delete') }}" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"><i
                                                            class="ti ti-trash"></i></a>
                                                    {!! Form::open([
                                                        'method' => 'DELETE',
                                                        'route' => ['users.destroy', $user->id],
                                                        'id' => 'delete-form-' . $user->id,
                                                    ]) !!}
                                                    {!! Form::close() !!}

                                                    </div>
                                                @endcan
                                                @else
                                                <div class="text-center">
                                                    <button type="button" class="btn" data-bs-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="ti ti-lock"></i>
                                                    </button>
                                                </div>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
