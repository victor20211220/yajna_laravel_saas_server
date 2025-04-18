<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginSecurityController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Generate 2FA secret key
     */
    public function generate2faSecret(Request $request)
    {
        if(\Auth::user()->can('google authentication enable'))
        {
            $user = User::find(Auth::user()->id);
            // Initialise the 2FA class
            $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());

            // Add the secret key to the registration data
            $user->google2fa_enable = 0;
            $user->google2fa_secret = $google2fa->generateSecretKey();
            $user->save();
            return redirect()->route('profile')->with('success', __('Secret key is generated.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Enable 2FA
     */
    public function enable2fa(Request $request)
    {
        if(Auth::user()->can('google authentication enable'))
        {
            $user = User::find(Auth::user()->id);
            $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());

            $secret = $request->input('secret');
            $valid = $google2fa->verifyKey($user->google2fa_secret, $secret);

            if($valid){
                $user->google2fa_enable = 1;
                $user->save();
                return redirect()->route('profile')->with('success', __('2FA is enabled successfully.'));
            }else{
                return redirect()->route('profile')->with('error',"Invalid verification Code, Please try again.");
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Disable 2FA
     */
    public function disable2fa(Request $request)
    {
        if(Auth::user()->can('google authentication disable'))
        {
            $validatedData = $request->validate([
                'current-password' => 'required',
            ]);

            if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
                // The passwords matches
                return redirect()->route('profile')->with('error', __('Your password does not matches with your account password. Please try again.'));
            }
            $user = User::find(Auth::user()->id);
            $user->google2fa_enable = 0;
            $user->google2fa_secret = null;
            $user->save();
            return redirect()->route('profile')->with('success',__("2FA is now disabled."));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
