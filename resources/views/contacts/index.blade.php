@php
    $user = \Auth::user();
    $business_id = $user->current_business;
@endphp
@extends('layouts.new-client')
@section('page-title')
    {{ __('Contact Book') }}
@endsection
@section('title')
    <div class="mb-4">
        <h3 class="page-title">
            {{ __('Contact Book') }}
        </h3>
    </div>
@endsection
@section('content')
    <div id="contactBookPage" class="bg-white bg-md-transparent pb-3 pb-md-0">
        <div class="mb-4 d-none d-xl-block lh-1">
            All the contacts you collect will appear here. You can follow up, export, or organize them with
            tags.
        </div>
        <div
            class="d-flex justify-content-between justify-content-md-start align-items-center px-3 px-md-0 py-3 py-md-4 pt-md-0 mb-3 mb-md-4 border-bottom border-secondary gap-3">
            <button class="btn btn-primary btn-icon" id="openCreateContactModalBtn">
                {!! svg('user_interface/contact_book.svg', ['class' => 'me-3']) !!} Create Contact
            </button>
            <button id="exportCSV" class="btn btn-secondary btn-md-white btn-icon">
                {!! svg('user_interface/export_contacts.svg', ['class' => 'me-3']) !!} Export Contacts
            </button>
        </div>

        <div class="d-flex gap-3 px-3 px-md-0 align-items-start justify-content-start mb-3 mb-md-4 filter-inputs flex-column flex-md-row">
            <div class="position-relative btn-icon">
                <i class="bi bi-search position-absolute top-50 translate-middle-y ms-3"></i>
                <input type="text" class="form-control ps-5" placeholder="Search"
                       id="searchInput">
            </div>
            <div id="reportrange" class="form-control btn-icon">
                <i class="bi bi-calendar4"></i>
                <span></span> <img src="{{ asset('assets/images/icons/user_interface/arrows.svg') }}" alt="" width="7px"
                                   height="11px">
            </div>

        </div>
        <div class="card table-responsive mx-3 mx-md-0 border-1 border-md-0 border-secondary">
            <table id="contactsTable" class="table table-hover borderless contacts-table mb-0">
                <thead class="d-none d-md-table-header-group">
                <tr>
                    <th><input type="checkbox" id="checkAll"></th>
                    <th>Name</th>
                    <th class="d-none d-md-table-cell">Email</th>
                    <th class="d-none d-md-table-cell">Date Added</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($contacts_details as $val)
                    <tr>
                        <td><input type="checkbox" class="row-checkbox"></td>
                        <td>
                            <a href="#" class="view-contact text-decoration-none" data-id="{{ $val->id }}">
                                <span class="d-block">{{ $val->name }}</span>
                                <span class="d-block d-md-none text-muted">{{ $val->email }}</span>
                            </a>
                        </td>
                        <td class="d-none d-md-table-cell">{{ $val->email }}</td>
                        <td class="d-none d-md-table-cell">{{ \Carbon\Carbon::parse($val->created_at)->format('d F, Y') }}</td>
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
        <div class="modal fade" id="viewContactModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4">
                    <div class="modal-header border-0">
                        <h5 class="modal-title fw-bold mx-auto">Contact Details</h5>
                        <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-start">
                        <!-- Content injected via JS -->
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
            var end = moment().endOf('month');
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

        $(document).on('click', '.view-contact', function (e) {
            e.preventDefault();
            const contactId = $(this).data('id');

            $.ajax({
                url: `/contacts/${contactId}/show`,
                method: 'GET',
                success: function (data) {
                    // fallback to empty string if null
                    const safe = (val) => val ?? '';

                    $('#viewContactModal .modal-body').html(`
                        <p><strong>Name:</strong> ${safe(data.name)}</p>
                        <p><strong>Phone:</strong> ${safe(data.phone)}</p>
                        <p><strong>Email:</strong> ${safe(data.email)}</p>
                        <p><strong>Company:</strong> ${safe(data.company)}</p>
                        <p><strong>Job Title:</strong> ${safe(data.job_title)}</p>
                        <p><strong>Notes:</strong> ${safe(data.message)}</p>
                    `);

                    $('#viewContactModal').modal('show');
                }
            });
        });

    </script>
@endpush
