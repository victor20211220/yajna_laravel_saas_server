<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\BusinessAnalytics;
use App\Models\Contacts;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

    public function index(Request $request, Business $business)
    {
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

}
