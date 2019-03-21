<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Device;
use Jenssegers\Agent\Agent;
use Mail;
use App\Mail\OTP;

class TwoFactorController extends Controller
{
	public function __construct() { 
		$this->middleware('auth');
	}

    public function verifyTwoFactor(Request $request)
    {
        // $request->validate([
        //     '2fa' => 'required',
        // ]);

        $user = Auth::user();

        $device = Device::where([
        	['user_id', '=', $user->id],
        	['ip', '=', $_SERVER['REMOTE_ADDR']],
        	['user_agent', '=', $_SERVER['HTTP_USER_AGENT']]            	
        ])->first();
        $attempts = ++$device->attempts;
        $device->save();

        if ($device->attempts > 4) {
        	Auth::logout();
        	$device->attempts = 0;
        	$device->save();
        	return redirect('/');
        }

        if($request->input('2fa') == $user->token_2fa && $user->token_2fa_expiry > \Carbon\Carbon::now()){            
            // $user->token_2fa_expiry = \Carbon\Carbon::now()->addMinutes(config('session.lifetime'));
            // $user->save();

            $device->is_verified = true;
            $device->attempts = 0;
            $device->save();

            return redirect('/home');
        } else {
            return view('auth.two_factor', compact('attempts'))->with('error', 'Incorrect or expired OTP.');
        }
    }

    public function showTwoFactorForm()
    {
        return view('auth.two_factor');
    }  

    public function resendOTPEmail() {
    	$user = Auth::user();
    	$agent = new Agent();

    	// Mail::raw("Login On New Device: " . $agent->browser() . ", " . $agent->platform() . ", " . $agent->device() . ". 4X_Nav_App OTP: $user->token_2fa", function ($message) use ($user) {
     //        $message->to($user->email);
     //    });

        Mail::to($user->email)->queue(new OTP($user));

        return redirect('/2fa')->with("success", "OTP has been resent susccessfully");
    }
}
