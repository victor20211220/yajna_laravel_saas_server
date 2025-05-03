<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SupportController extends Controller
{
    public function index()
    {
        return view('support.index');
    }

    public function send(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $superAdmin = User::where('type', 'super admin')->first();

        if (!$superAdmin) {
            return redirect()->back()->with('error', 'Super admin not found.');
        }

        Mail::raw($request->message, function ($mail) use ($request, $superAdmin) {
            $mail->to($superAdmin->email)
                ->subject($request->subject);
        });

        return redirect()->back()->with('success', 'Email sent successfully!');
    }
}
