@extends('layouts.new-client')
@section('page-title')
    {{ __('Analytics') }}
@endsection
@section('title')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0 page-title">
            {{ __('Analytics') }}
        </h3>
        <div id="reportrange" class="btn btn-primary">
            <i class="bi bi-calendar"></i>&nbsp;
            <span></span> <i class="bi bi-chevron-down"></i>
        </div>
    </div>
@endsection
@section('content')
    <div id="analytics_page">
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card stats-card">
                    <div class="fw-semibold">Page Views</div>
                    <div>{{ $views->count() ?: 'No view' }}</div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card stats-card">
                    <div class="fw-semibold">Page Clicks</div>
                    <div>{{ $clicks->count() ?: 'No click' }}</div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card stats-card">
                    <div class="fw-semibold">CTR</div>
                    <div>{{ $ctr }}%</div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card stats-card">
                    <div class="fw-semibold">Contacts Collected</div>
                    <div>{{ $contacts_collected ?: 'No new contact' }}</div>
                </div>
            </div>
        </div>

        <div class="card stats-card mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="fw-semibold">Page Views</div>
                <button id="exportDailyBtn" class="btn"><i class="bi bi-download"></i></button>
            </div>
            <canvas id="viewsChart" height="100"></canvas>
        </div>

        <div class="row align-items-stretch">
            <div class="col-md-5 mb-4">
                <div class="card h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="fw-semibold">Type of views</div>
                        <button id="exportDevicesBtn" class="btn"><i class="bi bi-download"></i></button>
                    </div>
                    <canvas id="deviceChart" height="200"></canvas>
                </div>
            </div>
            <div class="col-md-7 mb-4">
                <div class="card h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="fw-semibold">Link Taps</div>
                        <button id="exportCategoriesBtn" class="btn"><i class="bi bi-download"></i></button>
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
        const viewsData = @json($views);
        const clicksData = @json($clicks);

        // Date range picker setup
        let start = moment('{{ request('start_date') ?? now()->startOfMonth()->format('YYYY-MM-DD') }}', 'YYYY-MM-DD', true);
        let end = moment('{{ request('end_date') ?? now()->endOfMonth()->format('YYYY-MM-DD') }}', 'YYYY-MM-DD', true);

        // fallback if parsing fails
        const fallbackStart = moment().startOf('month');
        const fallbackEnd = moment();

        if (!start.isValid()) start = fallbackStart;
        if (!end.isValid()) end = fallbackEnd;
        let selectedLabel = 'This Month';

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

        clicksData.forEach(click => {
            const category = click.category || 'unknown';
            categoryCounts[category] = (categoryCounts[category] || 0) + 1;
        });

        const ctxViews = document.getElementById('viewsChart').getContext('2d');
        new Chart(ctxViews, {
            type: 'line',
            data: {
                labels: Object.keys(viewCounts),
                datasets: [{
                    label: 'Page Views',
                    data: Object.values(viewCounts),
                    fill: true,
                    borderColor: '#007bff',
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
                    backgroundColor: ['#007bff', '#28a745', '#ffc107']
                }]
            }
        });

        const ctxCategory = document.getElementById('categoryChart').getContext('2d');
        new Chart(ctxCategory, {
            type: 'bar',
            data: {
                labels: [
                    'Social',
                    'Save Contact',
                    'Share Contact',
                    'Contact Info',
                    'Services',
                    'Gallery',
                    'Video',
                    'Google Review'
                ],
                datasets: [{
                    label: 'Clicks',
                    data: Object.values(categoryCounts),
                    backgroundColor: '#007bff'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        function cb(start, end, label) {
            if (label) selectedLabel = label;
            if (selectedLabel === 'Custom Range') {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            } else {
                $('#reportrange span').html(selectedLabel);
            }

            const currentParams = new URLSearchParams(window.location.search);
            const currStart = currentParams.get('start_date');
            const currEnd = currentParams.get('end_date');
            const newStart = start.format('YYYY-MM-DD');
            const newEnd = end.format('YYYY-MM-DD');

            if (currStart !== newStart || currEnd !== newEnd) {
                window.location.href = `?start_date=${newStart}&end_date=${newEnd}`;
            }
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: predefinedRanges
        }, cb);

        cb(start, end, selectedLabel);


        function exportCSV(filename, headers, rows) {
            const escapeCSV = val => {
                if (typeof val === 'string' && (val.includes(',') || val.includes('"'))) {
                    return `"${val.replace(/"/g, '""')}"`;
                }
                return val;
            };

            const csv = [
                headers.map(escapeCSV).join(','),
                ...rows.map(row => row.map(escapeCSV).join(','))
            ].join('\n');

            const blob = new Blob([csv], {type: 'text/csv;charset=utf-8;'});
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.setAttribute('download', filename);
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }


        // Export daily views & clicks
        document.getElementById('exportDailyBtn').addEventListener('click', () => {
            const headers = ['Date', 'Views'];
            const labels = Object.keys(viewCounts);
            const rows = labels.map(label => [
                label,
                viewCounts[label],
            ]);
            exportCSV('daily-views-clicks.csv', headers, rows);
        });

        // Export device views
        document.getElementById('exportDevicesBtn').addEventListener('click', () => {
            const headers = ['Device', 'Views'];
            const rows = Object.entries(deviceCounts);
            exportCSV('views-by-device.csv', headers, rows);
        });

        // Export category clicks
        document.getElementById('exportCategoriesBtn').addEventListener('click', () => {
            const headers = ['Category', 'Clicks'];
            const rows = Object.entries({
                'Social': categoryCounts['social'],
                'Save Contact': categoryCounts['save_contact'],
                'Share Contact': categoryCounts['share_contact'],
                'Contact Info': categoryCounts['contact_info'],
                'Services': categoryCounts['services'],
                'Gallery': categoryCounts['gallery'],
                'Video': categoryCounts['video'],
                'Google Review': categoryCounts['google_review']
            });
            exportCSV('clicks-by-category.csv', headers, rows);
        });
    </script>
@endpush
