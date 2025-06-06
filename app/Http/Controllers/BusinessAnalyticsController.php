<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\BusinessAnalytics;
use App\Models\Contacts;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BusinessAnalyticsController extends Controller
{
    public function track(Request $request)
    {
        $business = Business::findOrFail($request->business_id);

        // Don't track if the logged-in user is the owner
        if (auth()->check() && auth()->id() === $business->created_by) {
            return response()->json(['status' => 'ignored (owner)']);
        }

        BusinessAnalytics::create([
            'business_id' => $business->id,
            'type' => 'click',
            'category' => $request->category,
            'source' => detectDevice($request->header('User-Agent')),
            'created_at' => now(),
        ]);

        return response()->json(['status' => 'ok']);
    }

    public function index(Request $request)
    {
        $user = \Auth::user();
        $business = Business::find($user->current_business);
        $from = now()->startOfWeek();
        $to = now()->endOfWeek();

        // Validate date format
        if ($request->filled('start_date') && strtotime($request->start_date)) {
            $from = Carbon::parse($request->start_date)->startOfDay();
        }

        if ($request->filled('end_date') && strtotime($request->end_date)) {
            $to = Carbon::parse($request->end_date)->endOfDay();
        }

        $views = BusinessAnalytics::where('business_id', $business->id)
            ->where('type', 'view')
            ->whereBetween('created_at', [$from, $to])
            ->get();


        $clicks = BusinessAnalytics::where('business_id', $business->id)
            ->where('type', 'click')
            ->whereBetween('created_at', [$from, $to])
            ->get();

        $contacts_collected = Contacts::where('business_id', $business->id)
            ->whereBetween('created_at', [$from, $to])
            ->count();

        $ctr = $views->count() ? round(($clicks->count() / $views->count()) * 100) : 0;
        //dd(compact('business', 'views', 'clicks', 'ctr', 'contacts_collected'));
        return view('analytics.index', compact('business', 'views', 'clicks', 'ctr', 'contacts_collected'));
    }

    public function export(Request $request): StreamedResponse
    {
        $business = Business::find(\Auth::user()->current_business);
        $from = $request->filled('start_date') ? Carbon::parse($request->start_date)->startOfDay() : now()->startOfWeek();
        $to = $request->filled('end_date') ? Carbon::parse($request->end_date)->endOfDay() : now()->endOfWeek();
        $format = $request->input('format', 'csv');
        $dataType = $request->input('data');

        $isProClient = \App\Models\Utility::isProClient($business->id);

        $headers = [];
        $rows = [];

        switch ($dataType) {
            case 'daily-views-clicks':
                $views = BusinessAnalytics::where('business_id', $business->id)->where('type', 'view')->whereBetween('created_at', [$from, $to])->get();
                $daily = [];
                $date = $from->copy();
                while ($date->lte($to)) {
                    $day = $date->format('Y-m-d');
                    $daily[$day] = 0;
                    $date->addDay();
                }
                foreach ($views as $v) {
                    $d = Carbon::parse($v->created_at)->format('Y-m-d');
                    $daily[$d]++;
                }
                $headers = ['Date', 'Views'];
                $rows = collect($daily)->map(fn($v, $k) => [$k, $v])->values()->toArray();
                break;

            case 'views-by-device':
                $views = BusinessAnalytics::where('business_id', $business->id)->where('type', 'view')->whereBetween('created_at', [$from, $to])->get();
                $deviceCounts = [];
                foreach ($views as $view) {
                    $type = $view->source ?? 'unknown';
                    $deviceCounts[$type] = ($deviceCounts[$type] ?? 0) + 1;
                }
                $headers = ['Device', 'Views'];
                $rows = collect($deviceCounts)->map(fn($v, $k) => [$k, $v])->values()->toArray();
                break;

            case 'clicks-by-category':
                $clicks = BusinessAnalytics::where('business_id', $business->id)->where('type', 'click')->whereBetween('created_at', [$from, $to])->get();
                $categories = [
                    'social' => 'Social',
                    'save_contact' => 'Save Contact',
                    'share_contact' => 'Share Contact',
                    'contact_info' => 'Contact Info',
                    'services' => 'Services',
                    'gallery' => 'Gallery',
                    'video' => 'Video',
                    'google_review' => 'Google Review'
                ];
                if (!$isProClient) {
                    unset($categories['services'], $categories['gallery'], $categories['video'], $categories['google_review']);
                }

                $counts = array_fill_keys(array_keys($categories), 0);
                foreach ($clicks as $click) {
                    $key = $click->category ?? 'unknown';
                    if (isset($counts[$key])) $counts[$key]++;
                }

                $headers = ['Category', 'Clicks'];
                $rows = collect($counts)->map(fn($v, $k) => [$categories[$k], $v])->values()->toArray();
                break;
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        foreach ($headers as $col => $header) {
            $cell = chr(65 + $col) . '1';
            $sheet->setCellValue($cell, $header);
            $sheet->getStyle($cell)->getFont()->setBold(true)->setSize(16);
        }

        // Set rows
        foreach ($rows as $i => $row) {
            foreach ($row as $j => $value) {
                $cell = chr(65 + $j) . ($i + 2);
                $sheet->setCellValue($cell, $value);
                $sheet->getStyle($cell)->getFont()->setSize(16);
            }
        }

        $filename = "{$dataType}." . ($format === 'xlsx' ? 'xlsx' : 'csv');
        $writer = $format === 'xlsx' ? new Xlsx($spreadsheet) : new Csv($spreadsheet);

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => $format === 'xlsx'
                ? 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                : 'text/csv'
        ]);
    }


}
