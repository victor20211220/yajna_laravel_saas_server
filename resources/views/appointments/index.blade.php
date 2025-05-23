@php
    $users = \Auth::user();
    $businesses = App\Models\Business::allBusiness();
    $currantBusiness = $users->currentBusiness();
    $bussiness_id = $users->current_business;
@endphp
@extends('layouts.admin')
@section('content')
@section('page-title')
    {{ __('Appointments') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Appointments') }}</li>
@endsection
@section('title')
    {{ __('Appointments') }}
@endsection
@push('css-page')
    <style>
        .export-btn {
            float: right;
        }
    </style>
@endpush
@section('content')

    <div class="mt-4">
        <div class="card">
            <div class="card-body table-border-style">
                <div class="d-md-flex justify-content-between gap-2 mb-3">
                    <div class="d-lg-flex gap-3 align-items-end mb-3 mb-md-0 w-100">
                        {{-- //business Display Start --}}
                        <ul class="list-unstyled mb-lg-0 business-header">
                            <li class="dropdown dash-h-item drp-language">
                                <a class="dash-head-link dropdown-toggle arrow-none me-0 ml-0 cust-btn"
                                    data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                    aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    data-bs-original-title="{{ __('Select your bussiness') }}">
                                    <i class="ti ti-apps"></i>
                                    <span class="drp-text hide-mob">{{ __(ucfirst($currantBusiness)) }}</span>
                                    <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                                </a>
                                <div class="dropdown-menu dash-h-dropdown page-inner-dropdowm dashborad-drap">
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
                        {{ Form::open(['route' => ['appointments.index'], 'method' => 'get', 'id' => 'appointment_filter', 'class' => 'appointment_filter_row']) }}
                        <div class="row">
                            <div class="col-xxl-3 col-sm-4 col-12 mb-3 mb-sm-0">
                                <div class="btn-box">
                                    {{ Form::label('start_date', __('Start Date'), ['class' => 'form-label']) }}
                                    {{ Form::date('start_date', isset($_GET['start_date']) ? $_GET['start_date'] : '', ['class' => 'form-control ', 'placeholder' => __('Select Date')]) }}
                                </div>
                            </div>
                            <div class="col-xxl-3 col-sm-4 col-12 mb-3 mb-sm-0">
                                <div class="btn-box">
                                    {{ Form::label('end_date', __('End Date'), ['class' => 'form-label']) }}
                                    {{ Form::date('end_date', isset($_GET['end_date']) ? $_GET['end_date'] : '', ['class' => 'form-control ', 'placeholder' => __('Select Date')]) }}
                                </div>
                            </div>
                            <div class="col-auto float-end align-content-end mb-1">
                                <a class="btn btn-sm btn-primary me-1"
                                    onclick="document.getElementById('appointment_filter').submit(); return false;"
                                    data-bs-toggle="tooltip" title="" data-bs-original-title="{{ __('Apply') }}">
                                    <span class="btn-inner--icon text-white"><i class="ti ti-search"></i></span>
                                </a>
                                <a href="{{ route('appointments.index') }}" class="btn btn-sm btn-danger"
                                    data-bs-toggle="tooltip" title="" data-bs-original-title="{{ __('Reset') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-refresh text-white-off "></i></span>
                                </a>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                    <div class="d-flex align-items-end justify-content-md-end mb-md-1">
                        <button class="csv btn btn-sm btn-primary export-btn" data-bs-placement="top"
                            data-bs-toggle="tooltip" title="{{ __('Export') }}"
                            data-bs-original-title="{{ __('Export') }}">{{ __('Export') }}</button>
                    </div>
                </div>

                <div class="table-responsive mt-3 pb-1">
                    <table class="table" id="pc-dt-export">
                        <thead>
                            <tr>
                                <th>{{ __('Date / Time') }}</th>
                                <th>{{ __('Business Name') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Phone') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th id="ignore">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointment_deatails as $val)
                                <tr>
                                    <td>
                                        <div class="mb-1">{{ $val->date }}</div>
                                        <div>{{ $val->time }}</div>
                                    </td>
                                    <td>{{ $val->business_name }}</td>
                                    <td>{{ $val->name }}</td>
                                    <td>{{ $val->email }}</td>
                                    <td>{{ $val->phone }}</td>
                                    @if ($val->status == 'pending')
                                        <td><span
                                                class="badge bg-warning p-2 px-3 tbl-btn-w">{{ ucFirst($val->status) }}</span>
                                        </td>
                                    @else
                                        <td><span
                                                class="badge bg-success p-2 px-3 tbl-btn-w">{{ ucFirst($val->status) }}</span>
                                        </td>
                                    @endif
                                    <td class="">
                                        @can('edit appointment')
                                            <div class="action-btn  me-2">
                                                <a href="#"
                                                    class="mx-3 bg-success btn btn-sm d-inline-flex align-items-center cp_link"
                                                    data-toggle="modal" data-target="#commonModal" data-ajax-popup="true"
                                                    data-size="lg" data-url="{{ route('appointment.add-note', $val->id) }}"
                                                    data-title="{{ __('Add Note & Change Status') }}" data-bs-toggle="tooltip"
                                                    data-bs-original-title="{{ __('Add Note & Change Status') }}">
                                                    <span class="text-white"><i class="ti ti-note"></i></span></a>
                                            </div>
                                        @endcan
                                        @can('delete appointment')
                                            <div class="action-btn  me-2">
                                                <a href="#"
                                                    class="bs-pass-para mx-3 bg-danger btn btn-sm d-inline-flex align-items-center"
                                                    data-confirm="{{ __('Are You Sure?') }}"
                                                    data-text="{{ __('This action can not be undone. Do you want to continue?') }}"
                                                    data-confirm-yes="delete-form-{{ $val->id }}"
                                                    title="{{ __('Delete') }}" data-bs-toggle="tooltip"
                                                    data-bs-placement="top"><span class="text-white"><i
                                                            class="ti ti-trash"></i></span></a>
                                            </div>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['appointments.destroy', $val->id],
                                                'id' => 'delete-form-' . $val->id,
                                            ]) !!}
                                            {!! Form::close() !!}
                                        @endcan

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-8">
                <div class="card mb-xl-0">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5>{{ __('Calendar') }}</h5>
                            </div>
                            <div class="col-lg-6">
                                @if (isset($settings['Google_Calendar']) && $settings['Google_Calendar'] == 'on')
                                    <select class="form-control" name="is_live" id="is_live"
                                        style="float: right;width: 170px;" onchange="get_data()">
                                        <option value="1">{{ __('Google Calender') }}</option>
                                        <option value="0" selected="true">{{ __('Local Calender') }}</option>
                                    </select>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id='calendar' class='calendar'></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card h-100 mb-0">
                    <div class="card-body appointments-data w-100">
                        <h4 class="">{{ __('Appointments') }}</h4>
                        <small>{{ __('This data is only for current month ') }}</small>
                        <ul class="event-cards list-group list-group-flush mt-3 w-100 ">
                            @foreach ($arrayJson as $appointment)
                                @php
                                    $month = date('m', strtotime($appointment['start']));
                                @endphp
                                @if ($month == date('m'))
                                    <li class="list-group-item card mb-3 p-3">
                                        <div class="row align-items-center justify-content-between">
                                            <div class="col-auto">
                                                <div class="d-flex align-items-center">
                                                    <div class="theme-avtar bg-primary">
                                                        <i class="ti ti-calendar"></i>
                                                    </div>
                                                    <div class="ms-3">
                                                        <h6 class="">{{ $appointment['title'] }}</h6>
                                                        <small class="text-muted mt-2">{{ $appointment['start'] }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">

                                            </div>
                                        </div>
                                    </li>
                                @endif
                                <input type="hidden" class="business_id" name="business_id"
                                    value="{{ $appointment['business_id'] }}">
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script src="https://rawgit.com/unconditional/jquery-table2excel/master/src/jquery.table2excel.js"></script>
    <script>
        const table = new simpleDatatables.DataTable("#pc-dt-export", {
            searchable: true,
            fixedheight: true,
            dom: 'Bfrtip',
        });

        $('.csv').on('click', function() {
            $('#ignore').remove();
            $("#pc-dt-export").table2excel({
                filename: "appointmentDetail"
            });
            setTimeout(function() {
                location.reload();
            }, 2000);
        });
    </script>
    <script src="{{ asset('custom/libs/moment/min/moment.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            get_data();
        });

        function get_data() {
            var is_live = $('#is_live :selected').val();
            var id = $(".business_id").val();
            var start_date = $('input[name=start_date]').val();
            var end_date = $('input[name=end_date]').val();

            $.ajax({
                url: $("#path_admin").val() + "/get_appointment_data",
                method: "POST",
                data: {
                    "id": id,
                    "_token": "{{ csrf_token() }}",
                    'is_live': is_live,
                    'start_date': start_date,
                    'end_date': end_date,

                },
                success: function(data) {
                    (function() {
                        var etitle;
                        var etype;
                        var etypeclass;
                        var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                            headerToolbar: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'dayGridMonth,timeGridWeek,timeGridDay'
                            },
                            buttonText: {
                                timeGridDay: "{{ __('Day') }}",
                                timeGridWeek: "{{ __('Week') }}",
                                dayGridMonth: "{{ __('Month') }}"
                            },
                            slotLabelFormat: {
                                hour: '2-digit',
                                minute: '2-digit',
                                hour12: false,
                            },
                            allDaySlot: false,
                            themeSystem: 'bootstrap',
                            // slotDuration: '00:10:00',
                            navLinks: true,
                            droppable: true,
                            selectable: true,
                            selectMirror: true,
                            editable: true,
                            dayMaxEvents: true,
                            handleWindowResize: false,
                            height: 'auto',
                            events: data,
                            eventClick: function(e) {
                                e.jsEvent.preventDefault();
                                var title = e.title;
                                var url = e.el.href;

                                if (is_live == 0 || is_live == undefined) {
                                    if (typeof url != 'undefined') {
                                        $("#commonModal .modal-title").html(e.event.title);
                                        $("#commonModal .modal-dialog").addClass('modal-md');
                                        $("#commonModal").modal('show');

                                        $.get(url, {}, function(data) {
                                            $('#commonModal .modal-body ').html(data);
                                        });
                                        return false;
                                    }
                                }

                            }
                        });
                        calendar.render();
                    })();
                }
            });

        }
    </script>
@endpush
