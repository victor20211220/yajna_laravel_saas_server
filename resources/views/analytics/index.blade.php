@php
    $isProClient = \App\Models\Utility::isProClient($business->id);
@endphp
@extends('layouts.new-client')
@section('page-title')
    {{ __('Analytics') }}
@endsection
@section('title')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0 page-title">
            {{ __('Analytics') }}
        </h3>
        <div id="reportrange" class="btn btn-primary btn-icon">
            <i class="bi bi-calendar"></i>&nbsp;
            <span></span> <i class="bi bi-chevron-down btn-icon"></i>
        </div>
    </div>
@endsection
@section('content')
    <div id="analytics_page">
        <div class="row">
            <div class="col-6 col-md-3 mb-4">
                <div class="card stats-card">
                    <div class="fw-semibold">Page Views</div>
                    <div>{{ $views->count() ?: 'No view' }}</div>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-4">
                <div class="card stats-card">
                    <div class="fw-semibold">Page Clicks</div>
                    <div>{{ $clicks->count() ?: 'No click' }}</div>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-4">
                <div class="card stats-card">
                    <div class="fw-semibold position-relative">
                        <label class="form-label mb-0">CTR</label>
                        @include('components/more-info', ['label' => 'CTR (Click through rate)'])
                    </div>
                    <div>
                        {{ $ctr }}%
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-4">
                <div class="card stats-card">
                    <div class="fw-semibold">Contacts Collected</div>
                    <div>{{ $contacts_collected ?: 'No new contact' }}</div>
                </div>
            </div>
        </div>

        <div class="card stats-card mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="fw-semibold">Page Views</div>
                <div class="dropdown">
                    <a href="#" class="text-muted btn" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-download"></i>
                    </a>
                    <ul class="dropdown-menu shadow rounded border-0 p-2">
                        <li><a class="dropdown-item export-button" href="javascript:void(0)" data-source="daily-views-clicks" data-format="csv">Export
                                CSV</a></li>
                        <li><a class="dropdown-item export-button" href="javascript:void(0)" data-source="daily-views-clicks" data-format="xlsx">Export
                                XLSX</a></li>
                    </ul>
                </div>
            </div>
            <canvas id="viewsChart" height="100"></canvas>
        </div>

        <div class="row align-items-stretch">
            <div class="col-md-5 mb-4">
                <div class="card h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="fw-semibold">Type of views</div>
                        <div class="dropdown">
                            <a href="#" class="text-muted btn" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-download"></i>
                            </a>
                            <ul class="dropdown-menu shadow rounded border-0 p-2">
                                <li><a class="dropdown-item export-button" href="javascript:void(0)" data-source="views-by-device" data-format="csv">Export
                                        CSV</a></li>
                                <li><a class="dropdown-item export-button" href="javascript:void(0)" data-source="views-by-device" data-format="xlsx">Export
                                        XLSX</a></li>
                            </ul>
                        </div>
                    </div>
                    <canvas id="deviceChart" height="200"></canvas>
                </div>
            </div>
            <div class="col-md-7 mb-4">
                <div class="card h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="fw-semibold">Link Taps</div>
                        <div class="dropdown">
                            <a href="#" class="text-muted btn" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-download"></i>
                            </a>
                            <ul class="dropdown-menu shadow rounded border-0 p-2">
                                <li><a class="dropdown-item export-button" href="javascript:void(0)" data-source="clicks-by-category" data-format="csv">Export
                                        CSV</a></li>
                                <li><a class="dropdown-item export-button" href="javascript:void(0)" data-source="clicks-by-category" data-format="xlsx">Export
                                        XLSX</a></li>
                            </ul>
                        </div>
                    </div>
                    <canvas id="categoryChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const isProClient = {{ $isProClient ? "true": "false"}};
        let hasRedirected = false; // track if we’ve already handled the first load
        // Date range picker setup
        let start = moment('{{ request('start_date') ?? now()->startOfWeek()->format('YYYY-MM-DD') }}', 'YYYY-MM-DD', true);
        let end = moment('{{ request('end_date') ?? now()->endOfWeek()->format('YYYY-MM-DD') }}', 'YYYY-MM-DD', true);

        const viewsData = @json($views);
        const clicksData = @json($clicks);


        // fallback if parsing fails
        const fallbackStart = moment().startOf('week');
        const fallbackEnd = moment().endOf('week');

        if (!start.isValid()) start = fallbackStart;
        if (!end.isValid()) end = fallbackEnd;
        let selectedLabel = 'This Week';

        const predefinedRanges = {
            'This Week': [moment().startOf('week'), moment().endOf('week')],
            'Last Week': [moment().subtract(1, 'week').startOf('week'), moment().subtract(1, 'week').endOf('week')],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'This Year': [moment().startOf('year'), moment().endOf('year')],
            'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
        };

        for (const [label, range] of Object.entries(predefinedRanges)) {
            if (start.isSame(range[0], 'day') && end.isSame(range[1], 'day')) {
                selectedLabel = label;
                break;
            }
        }

        function cb(start, end, label) {
            if (label) selectedLabel = label;
            if (selectedLabel === 'Custom Range') {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            } else {
                $('#reportrange span').html(selectedLabel);
            }

            // Only redirect if it's not the very first load
            if (hasRedirected) {
                const newStart = start.format('YYYY-MM-DD');
                const newEnd = end.format('YYYY-MM-DD');
                window.location.href = `?start_date=${newStart}&end_date=${newEnd}`;
            }
            hasRedirected = true;
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: predefinedRanges,
        }, cb);

        cb(start, end, selectedLabel);

        // Build full date range from start to end
        const viewCounts = {};
        const clickCountsByDay = {};

        let currentDate = moment(start);
        while (currentDate.isSameOrBefore(end, 'day')) {
            const dayStr = currentDate.format('YYYY-MM-DD');
            viewCounts[dayStr] = 0;
            clickCountsByDay[dayStr] = 0;
            currentDate.add(1, 'day');
        }

        // Populate views
        viewsData.forEach(view => {
            const day = moment(view.created_at).format('YYYY-MM-DD');
            if (viewCounts.hasOwnProperty(day)) {
                viewCounts[day] += 1;
            }
        });

        // Populate clicks
        clicksData.forEach(click => {
            const day = moment(click.created_at).format('YYYY-MM-DD');
            if (clickCountsByDay.hasOwnProperty(day)) {
                clickCountsByDay[day] += 1;
            }
        });

        // Device counts
        const deviceCounts = {};
        viewsData.forEach(view => {
            const type = view.source || 'unknown';
            deviceCounts[type] = (deviceCounts[type] || 0) + 1;
        });

        // Click category counts
        const categoryCounts = {
            'social': 0,
            'save_contact': 0,
            'share_contact': 0,
            'contact_info': 0,
            'services': 0,
            'gallery': 0,
            'video': 0,
            'google_review': 0
        };

        if (!isProClient) { // your actual condition here
            delete categoryCounts.services;
            delete categoryCounts.gallery;
            delete categoryCounts.video;
            delete categoryCounts.google_review;
        }

        clicksData.forEach(click => {
            const category = click.category || 'unknown';
            categoryCounts[category] = (categoryCounts[category] || 0) + 1;
        });
        Chart.defaults.font.size = 14;
        const ctxViews = document.getElementById('viewsChart').getContext('2d');
        new Chart(ctxViews, {
            type: 'line',
            data: {
                labels: Object.keys(viewCounts),
                datasets: [{
                    label: 'Page Views',
                    data: Object.values(viewCounts),
                    fill: true,
                    borderColor: '#171717',
                    tension: 0.3
                }]
            }
        });

        const ctxDevice = document.getElementById('deviceChart').getContext('2d');
        new Chart(ctxDevice, {
            type: 'doughnut',
            data: {
                labels: Object.keys(deviceCounts),
                datasets: [{
                    data: Object.values(deviceCounts),
                    backgroundColor: ['#171717', '#28a745', '#ffc107']
                }]
            }
        });

        const ctxCategory = document.getElementById('categoryChart').getContext('2d');
        let labels = [
            'Social',
            'Save Contact',
            'Share Contact',
            'Contact Info',
            'Services',
            'Gallery',
            'Video',
            'Google Review'
        ];
        if (!isProClient) { // your condition here
            const excludeLabels = ['Services', 'Gallery', 'Video', 'Google Review'];
            labels = labels.filter(label => !excludeLabels.includes(label));
        }
        new Chart(ctxCategory, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Clicks',
                    data: Object.values(categoryCounts),
                    backgroundColor: '#171717'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                        }
                    }
                }
            }
        });

        // Export daily views & clicks
        $('.export-button').click(function(){
            const source = $(this).data('source');
            const format = $(this).data('format');

            const params = new URLSearchParams({
                data: source,
                format: format,
                start_date: start.format('YYYY-MM-DD'),
                end_date: end.format('YYYY-MM-DD')
            });

            window.location.href = `/analytics/export?${params.toString()}`;
        });
    </script>
@endpush
