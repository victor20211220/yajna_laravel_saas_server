<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacts;
use App\Models\Business;
use App\Models\User;
use App\Models\Utility;
use Illuminate\Support\Facades\Validator;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index($id = "")
    {
        $user = \Auth::user();
        $business_id = $user->current_business;

        if (!\Auth::user()->can('manage contact')) {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

        $query = Contacts::where('created_by', $user->creatorId());

        if ($business_id && $business_id != "0") {
            $query->where('business_id', $business_id);
        }

        // Search filter
        if (request()->filled('search')) {
            $search = request()->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%");
            });
        }

        // Date range filter
        if (request()->filled('date_range')) {
            $dates = explode(' - ', request()->date_range);
            if (count($dates) === 2) {
                try {
                    $from = \Carbon\Carbon::parse($dates[0])->startOfDay();
                    $to = \Carbon\Carbon::parse($dates[1])->endOfDay();
                    $query->whereBetween('created_at', [$from, $to]);
                } catch (\Exception $e) {
                    // handle parse error gracefully
                }
            }
        }

        $contacts_details = $query->orderBy('created_at', 'desc')->get();

        foreach ($contacts_details as $value) {
            $value->business_name = Contacts::getBusinessData($value->business_id);
        }

        return view('contacts.index', compact('contacts_details'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $business_id = $request->business_id;
        $business = Business::where('id', $business_id)->first();

        $business = Business::findOrFail($request->business_id);

        $contact = Contacts::create([
            'business_id' => $business->id,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'company' => $request->company,
            'job_title' => $request->job_title,
            'message' => $request->message,
            'created_by' => $business->created_by,
        ]);

        return redirect()->back()->with('success', __('Contact Created Successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Appointment_deatail $appointment_deatail
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment_deatail $appointment_deatail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Appointment_deatail $appointment_deatail
     * @return \Illuminate\Http\Response
     */
    public function edit(Contacts $Contacts, $id)
    {
        $Contacts = Contacts::where('id', $id)->first();
        return view('contacts.edit', compact('Contacts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Appointment_deatail $appointment_deatail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contacts $Contacts, $id)
    {
        $validator = \Validator::make(
            $request->all(), [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required|numeric',
                'message' => 'required',
            ]
        );
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }
        $Contacts = Contacts::where('id', $id)->first();
        $Contacts->name = $request->name;
        $Contacts->email = $request->email;
        $Contacts->phone = $request->phone;
        $Contacts->message = $request->message;
        $Contacts->save();

        return redirect()->route('contacts.index')->with('success', __('Contact successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Appointment_deatail $appointment_deatail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contacts $Contacts, $id)
    {
        if (\Auth::user()->can('delete contact')) {
            $contact = Contacts::find($id);
            if ($contact) {
                $contact->delete();
                return redirect()->back()->with('success', __('Contact successfully deleted.'));
            }
            return redirect()->back()->with('error', __('Contact not found.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function getCalenderAllData($id = null)
    {

        $objUser = \Auth::user();
        if ($id == null) {
            $appointents = Appointment_deatail::get();
        } else {
            $appointents = Appointment_deatail::where('business_id', $id)->get();
        }
        $arrayJson = [];
        foreach ($appointents as $appointent) {
            $time = explode('-', $appointent->time);
            $stime = isset($time[0]) ? trim($time[0]) . ':00' : '00:00:00';
            $etime = isset($time[1]) ? trim($time[1]) . ':00' : '00:00:00';
            $start_date = date("Y-m-d", strtotime($appointent->date)) . ' ' . $stime;
            $end_date = date("Y-m-d", strtotime($appointent->date)) . ' ' . $etime;

            $arrayJson[] = [
                "title" => '(' . $stime . ' - ' . $etime . ') ' . $appointent->name . '-' . $appointent->getBussinessName(),
                "start" => $start_date,
                "end" => $end_date,
                "app_id" => $appointent->id,
                "url" => route('appointment.details', $appointent->id),
                "className" => 'bg-info',
                "allDay" => true,
            ];
        }
        return view('appointments.calender', compact('arrayJson'));

    }

    public function getAppointmentDetails($id)
    {
        $ad = Appointment_deatail::find($id);
        return view('appointments.calender-modal', compact('ad'));
    }

    public function add_note($id)
    {

        $contact = Contacts::where('id', $id)->first();
        return view('contacts.add_note', compact('contact'));
    }

    public function note_store($id, Request $request)
    {

        if (\Auth::user()->can('edit contact')) {
            $contacts = Contacts::where('id', $id)->first();
            $contacts->status = $request->status;
            $contacts->note = $request->note;
            $contacts->save();

            return redirect()->back()->with('Success', __('Note added successfully.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
