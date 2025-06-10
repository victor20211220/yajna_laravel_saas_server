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
        $faqs = [
            [
                'title' => 'How do I customise my Tapeetap digital business card?',
                'content' => <<<HTML
                    <strong>1. How do I log in to edit my profile?</strong>
                    <br/><br/>
                    To edit your tapeetap digital business card, log in using your account
                    credentials via <a href="www.tapeetap.com/login" target="_blank">www.tapeetap.com/login</a>.
                    <br/><br/>
                    <strong>2. Where can I add or update my profile information?</strong>
                    <br/><br/>
                    Once logged in, in the profile section, you can customise your profile by filling
                    all information on your profile.
                    <br/><br/>
                    <strong>3. How do I add images or a banner photo?</strong>
                    <br/><br/>
                    Within the profile menu, look for “Profile picture” option in the content tab.
                    Follow the instructions to upload a file from your device.
                    <br/><br/>
                    <strong>4. Can I add links to my website or social media?</strong>
                    <br/><br/>
                    Yes, you can by simply paste the URL in the designated field in the editor.
                    <br/><br/>
                    <strong>5. How do I save my changes?</strong>
                    <br/><br/>
                     After editing, be sure to click “Save” to ensure all your details are kept.
                    <br/><br/>
                    <strong>6. What if I need help?</strong>
                    <br/><br/>
                    Tapeetap has a support page where you can write to our technicians who will
                    help you with any queries
                HTML
            ],
            [
                'title' => 'Sharing my Tapeetap digital business card',
                'content' => <<<HTML
                    <strong>1. How can I share my digital business card?</strong>
                    <br/><br/>
                    You can share your tapeetap digital business card using one of the following methods:
                    <ul>
                        <li>Use your tapeetap card to share your profile</li>
                        <li>Copy and send the link of your profile.</li>
                        <li>Show your QR code for others to scan.</li>
                    </ul>
                    <strong>Internet Access Required for Viewing:</strong>
                    <br/><br/>
                    While you can share your digital business card offline, the recipient will need
                    internet access to view your page online. If they scan your QR code without
                    internet access, the page will load automatically once they regain internet
                    reception.
                    <br/><br/>
                    <strong>2. Is there a QR code I can use?</strong>
                    <br/><br/>
                    Most digital business card platforms generate a QR code for your profile.
                    Save it to your phone or print it to make sharing easy in person.
                    <br/><br/>
                    <strong>3. Do people need an app to view my card?</strong>
                    <br/><br/>
                    No, most digital cards open in a browser. Anyone with the link or QR code
                    can view it without needing to download an app.
                    <br/><br/>
                    <strong>4. Can I update my card after sharing it?</strong>
                    <br/><br/>
                    Yes, your tapeetap digital cards are dynamic. If you update your profile,
                    anyone with the original link will see the changes instantly.
                    <br/><br/>
                    <strong>5. Is it secure to share?</strong>
                    <br/><br/>
                    Yes. Our platform allow you to control privacy settings. You can choose what
                    information is public or private.
                HTML
            ],
            [
                'title' => 'How do I manage all my contacts?',
                'content' => <<<HTML
                    <strong>1. How do I add a new contact?</strong>
                    <br/><br/>
                    You can add a new contact by clicking the "Add Contact” button in the contact
                    book dashboard. Fill in the person’s name, phone number, email, and any
                    other relevant details, then save.
                    <br/><br/>
                    <strong>2. Can I search through my contacts?</strong>
                    <br/><br/>
                    Yes. Use the search bar at the top of your contacts list to quickly find a
                    contact by name, company, or tag
                    <br/><br/>
                    <strong>3. Can I back up or export my contacts?</strong>
                    <br/><br/>
                    Yes. Tapeetap digital business card offer an option to export contacts as a
                    CSV or vCard file. Look for “Export” in the settings or contact tools section.
                    <br/><br/>
                    <strong>4. Are my contacts private?</strong>
                    <br/><br/>
                    Yes, your contacts are only visible to you unless you specifically share them
                    or give access through your settings.
                HTML
            ],
            [
                'title' => 'Troubleshooting',
                'content' => <<<HTML
                    Experiencing a bug or issue? Here’s what to do:
                    <br/><br/>
                    <strong>1. Contact Support via Email</strong>
                    <br/><br/>
                    If you prefer email, you can reach our support team at
                    <a href="mailto:support@tapeetap.com">support@tapeetap.com</a>
                    <br/><br/>
                    When sending an email, please include:
                    <ul>
                        <li>A clear description of the bug or error.</li>
                        <li>The steps you followed before the issue occurred.</li>
                        <li>Any error messages or codes displayed.</li>
                        <li>Screenshots or screen recordings (if available).</li>
                    </ul>
                    <strong>2. Why Providing Details Matters</strong>
                    <br/><br/>
                    The more details you provide, the faster we can identify and resolve the
                    issue. By sharing the exact steps leading to the error, our team can replicate
                    the problem and find a solution quickly.
                    <br/><br/>
                    We appreciate your patience and feedback as we work to improve your
                    experience with Tapeetap!
                HTML
            ],

            [
                'title' => 'How do I manage my tapeetap account',
                'content' => <<<HTML
                    <strong>1. Change your profile url and business name.</strong>
                    <br/><br/>
                    You cannot change the URL of your profile. To request a change in URL you
                    need to make a request to our support team for them to update your URL
                    accordingly with your new business name.
                    <br/><br/>
                    <strong>2. Deleting your tapeetap account</strong>
                    <br/><br/>
                    You can delete your account permanently in the settings menu. However you
                    need to note that once your account is deleted, you cannot retrieve any
                    information stored in your account.
                HTML
            ],
        ];
        return view('support.index', compact('faqs'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'attachment' => 'nullable|file|max:10240', // max 10MB
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
        $user = \Auth::user();
        config([
            'mail.driver' => $settings['mail_driver'] ?: $setting['mail_driver'],
            'mail.host' => $settings['mail_host'] ?: $setting['mail_host'],
            'mail.port' => $settings['mail_port'] ?: $setting['mail_port'],
            'mail.encryption' => $settings['mail_encryption'] ?: $setting['mail_encryption'],
            'mail.username' => $settings['mail_username'] ?: $setting['mail_username'],
            'mail.password' => $settings['mail_password'] ?: $setting['mail_password'],
            'mail.from.address' => $settings['mail_from_address'] ?: $setting['mail_from_address'],
            'mail.from.name' => $user->name ?: '',
        ]);

        Mail::mailer(config('mail.driver'))->send([], [], function ($mail) use ($request, $user) {
            $mail->to(config('mail.support_email'))
                ->subject($request->subject)
                ->replyTo($user->email)
                ->text($request->message);

            if ($request->hasFile('attachment')) {
                $mail->attach($request->file('attachment')->getRealPath(), [
                    'as' => $request->file('attachment')->getClientOriginalName(),
                    'mime' => $request->file('attachment')->getMimeType(),
                ]);
            }
        });

        return redirect()->back()->with('success', 'Email sent successfully!');
    }
}
