<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $data = DB::table('settings')->where('created_by', '=', 1)->get();
        $setting = [
            'mail_driver' => '',
            'mail_host' => '',
            'mail_port' => '',
            'mail_encryption' => '',
            'mail_username' => '',
            'mail_password' => '',
            'mail_from_address' => '',
            'mail_from_name' => '',

        ];
        foreach ($data as $row) {
            $setting[$row->name] = $row->value;
        }

        $settings = Utility::getsettingsbyid($superAdmin->id);
        config([
            'mail.driver' => $settings['mail_driver'] ?: $setting['mail_driver'],
            'mail.host' => $settings['mail_host'] ?: $setting['mail_host'],
            'mail.port' => $settings['mail_port'] ?: $setting['mail_port'],
            'mail.encryption' => $settings['mail_encryption'] ?: $setting['mail_encryption'],
            'mail.username' => $settings['mail_username'] ?: $setting['mail_username'],
            'mail.password' => $settings['mail_password'] ?: $setting['mail_password'],
            'mail.from.address' => $settings['mail_from_address'] ?: $setting['mail_from_address'],
            'mail.from.name' => $settings['mail_from_name'] ?: $setting['mail_from_name'],
        ]);

        Mail::mailer(config('mail.driver'))->raw($request->message, function ($mail) use ($request, $superAdmin) {
            $mail->to($superAdmin->email)
                ->subject($request->subject);
        });

        return redirect()->back()->with('success', 'Email sent successfully!');
    }
}
