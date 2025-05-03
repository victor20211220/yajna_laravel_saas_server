@php
    $user = \Auth::user();
    $business_id = $user->current_business;
@endphp
@extends('layouts.new-client')
@section('page-title')
    {{ __('Contact Book') }}
@endsection
@section('title')
    <h3 class="mb-2 page-title">
        {{ __('Contact Book') }}
    </h3>
@endsection
@section('content')
    <div id="contactBookPage">
        <div class="pb-2"></div>
        <div class="mb-4 d-none d-xl-block">
            All the contacts you collect will appear here. You can follow up, export, or organize them with
            tags.
        </div>
        <div class="d-flex justify-content-start align-items-center mb-4 gap-3">
            <button class="btn btn-primary" id="openCreateContactModalBtn">
                {!! svg('user_interface/contact_book.svg', ['class' => 'me-3']) !!} Create Contact
            </button>
            <button id="exportCSV" class="btn btn-white">
                {!! svg('user_interface/export_contacts.svg', ['class' => 'me-3']) !!} Export Contacts
            </button>
        </div>

        <div class="d-flex gap-3 align-items-start justify-content-start mb-3 filter-inputs flex-column flex-md-row">
            <div class="position-relative">
                <i class="bi bi-search position-absolute top-50 translate-middle-y ms-3"></i>
                <input type="text" class="form-control ps-5" placeholder="Search"
                       id="searchInput">
            </div>
            <div id="reportrange" class="form-control d-flex justify-content-between align-items-center">
                <i class="bi bi-calendar4"></i>
                <span></span> <img src="{{ asset('assets/images/icons/user_interface/arrows.svg') }}" alt="" width="7px"
                                   height="11px">
            </div>

        </div>
        <div class="card table-responsive">
            <table id="contactsTable" class="table table-hover borderless">
                <thead>
                <tr>
                    <th><input type="checkbox" id="checkAll"></th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date Added</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($contacts_details as $val)
                    <tr>
                        <td><input type="checkbox" class="row-checkbox"></td>
                        <td>{{ $val->name }}</td>
                        <td>{{ $val->email }}</td>
                        <td>{{ \Carbon\Carbon::parse($val->created_at)->format('d F, Y') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="createContactModal" tabindex="-1" aria-labelledby="createContactModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4">
                    <div class="modal-header border-0">
                        <h5 class="modal-title fw-bold mx-auto" id="createContactModalLabel">Create Contact</h5>
                        <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('contacts.store') }}">
                            @csrf
                            <div class="d-grid gap-3 mb-4">
                                <input type="text" name="name"
                                       class="form-control bg-secondary border-0 rounded-3 py-3 text-center"
                                       placeholder="Name" required>

                                <input type="text" name="phone"
                                       class="form-control bg-secondary border-0 rounded-3 py-3 text-center"
                                       placeholder="Phone number" required>

                                <input type="email" name="email"
                                       class="form-control bg-secondary border-0 rounded-3 py-3 text-center"
                                       placeholder="Email">

                                <input type="text" name="company"
                                       class="form-control bg-secondary border-0 rounded-3 py-3 text-center"
                                       placeholder="Company">

                                <input type="text" name="job_title"
                                   class="form-control bg-secondary border-0 rounded-3 py-3 text-center"
                                       placeholder="Job Title">

                                <textarea name="message"
                                          class="form-control bg-light border-0 rounded-3 py-3 text-center"
                                          rows="3" placeholder="Notes"></textarea>
                                <input type="hidden" name="business_id" value="{{ $business_id }}">
                            </div>

                            <div class="d-grid">
                                <button type="submit"
                                        class="btn btn-primary rounded-3 py-2 d-flex justify-content-center align-items-center gap-2">
                                    <i class="bi bi-arrow-repeat"></i>
                                    <span>Create Contact</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom-scripts')
    <script>
        $(function () {
            var start = moment().startOf('month');
            var end = moment();
            var selectedLabel = 'This Month';

            function cb(start, end, label) {
                if (label) {
                    selectedLabel = label;
                }

                if (selectedLabel === 'Custom Range') {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                } else {
                    $('#reportrange span').html(selectedLabel);
                }

                filterRowsByDateRange(start, end);
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'This Week': [moment().startOf('week'), moment().endOf('week')],
                    'Last Week': [moment().subtract(1, 'week').startOf('week'), moment().subtract(1, 'week').endOf('week')],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    'This Year': [moment().startOf('year'), moment().endOf('year')],
                    'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
                }
            }, cb);
            // initial call with label
            cb(start, end, selectedLabel);


            const table = document.querySelector('#contactsTable');
            dataTable = new simpleDatatables.DataTable(table, {
                searchable: false,
                paging: false,
                columns: [
                    {select: 0, sortable: false}, // last column (index 4) = dropdown
                ],
            });

            $('#searchInput').on('input', function () {
                dataTable.search(this.value);
            });

            $('#entriesSelect').on('change', function () {
                dataTable.options.perPage = parseInt(this.value);
                dataTable.update();
            });

            $('#exportCSV').on('click', function () {
                dataTable.export({
                    type: "csv",
                    filename: "contacts_export",
                    download: true
                });
            });


            $('#clearDateFilter').on('click', function () {
                $('#fromDate, #toDate').val('');
                $('#contactsTable tbody tr').show();
            });

            function filterRowsByDateRange(start, end) {
                const from = new Date(start);
                const to = new Date(end);

                $('#contactsTable tbody tr').each(function () {
                    const dateText = $(this).find('td').eq(3).text().trim();
                    const rowDate = new Date(dateText);

                    const inRange =
                        (!isNaN(from) ? rowDate >= from : true) &&
                        (!isNaN(to) ? rowDate <= to : true);

                    $(this).toggle(inRange);
                });
            }

            $('#checkAll').on('change', function () {
                $('.row-checkbox').prop('checked', this.checked);
            });

            $('#openCreateContactModalBtn').click(function () {
                $('#createContactModal').modal('show');
            })

        });

    </script>
@endpush
