@extends('layouts.admin')
@php
    $nfcImage = \App\Models\Utility::get_file('nfc/card_image');
    $admin_payment_setting = \App\Models\Utility::getAdminPaymentSetting();
@endphp
@section('page-title')
    {{ __('NFC Order') }}
@endsection
@section('title')
    {{ __('NFC Order') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('NFC Order') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-0">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        @if (Auth::user()->type == 'super admin')
                            <table class="table" id="pc-dt-simple">
                                <thead>
                                    <tr>
                                        <th> {{ __('Order ID') }}</th>
                                        <th> {{ __('Company') }}</th>
                                        <th> {{ __('NFC Card Name') }}</th>
                                        <th> {{ __('Business Name') }}</th>
                                        <th> {{ __('Order Status') }}</th>
                                        <th> {{ __('Created On') }}</th>
                                        <th> {{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($orderRequest as $order)
                                        <tr>
                                            <td>{{ $order->order_id }}</td>
                                            <td>{{ $order->company_name }}</td>
                                            <td>{{ $order->nfc_card_name }}</td>
                                            <td>{{ $order->business_name }}</td>
                                            <td>
                                                @if ($order->approval == '1')
                                                    <ul class="list-unstyled m-0">
                                                        <li class="dropdown dash-h-item drp-language">
                                                            <a class="dash-head-link  arrow-none me-0 btn btn-sm btn-primary"
                                                                data-bs-toggle="dropdown" href="#" role="button"
                                                                aria-haspopup="false" aria-expanded="false">
                                                                <span
                                                                    class="drp-text hide-mob">{{ ucFirst($order->status) }}</span>
                                                                <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                                                            </a>
                                                            <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
                                                                @foreach (\App\Models\OrderRequest::OrderStatus() as $key => $status)
                                                                    <a href="{{ route('change.order.status', ['id' => $order->id, 'status' => $key]) }}"
                                                                        class="dropdown-item ">
                                                                        <span>{{ $status }}</span>
                                                                    </a>
                                                                @endforeach
                                                            </div>
                                                        </li>
                                                    </ul>
                                                @elseif($order->approval == '0')
                                                    <span
                                                        class="badge fix_badge bg-danger p-2 px-3">{{ __('Rejected') }}</span>
                                                @else
                                                    <span
                                                        class="badge fix_badge bg-warning p-2 px-3">{{ __('Pending') }}</span>
                                                @endif

                                            </td>
                                            <td>{{ $order->created_at }}</td>
                                            <td class="">

                                                @if (is_null($order->approval))
                                                    <div class="action-btn  me-2">

                                                        <a href="{{ route('order.request', [$order->id, 1]) }}"
                                                            data-bs-placement="top" data-bs-toggle="tooltip" title="{{__('Accept')}}"
                                                            data-bs-original-title="{{ __('Accept') }}"
                                                            class="mx-3 btn-primary btn btn-sm  align-items-center ">
                                                            <i class="ti ti-check"></i>
                                                        </a>
                                                    </div>
                                                    <div class="action-btn ">
                                                        <a data-bs-placement="top" data-bs-toggle="tooltip"
                                                            data-bs-original-title="{{ __('Reject') }}" title="{{__('Reject')}}"
                                                            href="{{ route('order.request', [$order->id, 0]) }}"
                                                            class="mx-3 btn-danger btn btn-sm  align-items-center">
                                                            <i class="ti ti-x"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <table class="table" id="pc-dt-simple">
                                <thead>
                                    <tr>
                                        <th> {{ __('Order ID') }}</th>
                                        <th> {{ __('Company') }}</th>
                                        <th> {{ __('NFC Card Name') }}</th>
                                        <th> {{ __('Business Name') }}</th>
                                        <th> {{ __('Order Status') }}</th>
                                        <th> {{ __('Created On') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderRequest as $order)
                                        <tr>
                                            <td>{{ $order->order_id }}</td>
                                            <td>{{ $order->company_name }}</td>
                                            <td>{{ $order->nfc_card_name }}</td>
                                            <td>{{ $order->business_name }}</td>
                                            <td>

                                                @if ($order->approval == '1')
                                                    <span class="badge fix_badge bg-info  p-2 px-3">{{ ucFirst($order->status) }}</span>
                                                @elseif($order->approval == '0')
                                                    <span class="badge fix_badge bg-danger p-2 px-3">{{ __('Rejected') }}</span>
                                                @else
                                                    <span class="badge fix_badge bg-warning p-2 px-3">{{ __('Pending') }}</span>
                                                @endif

                                            </td>
                                            <td>{{ $order->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
