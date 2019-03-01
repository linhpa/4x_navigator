<?php
namespace App\Http\Middleware;

use Closure;
use Auth;
use Mail;
use App\Device;
use Jenssegers\Agent\Agent;
use App\Mail\OTP;

class TwoFactorVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        $user = Auth::user();
        $agent = new Agent();
        // if ($user->token_2fa_expiry > \Carbon\Carbon::now()){
        //     $user->token_2fa_expiry = \Carbon\Carbon::now()->addMinutes(config('session.lifetime'));
        //     $user->save();
        //     return $next($request);
        // } 

        $device = Device::where([
            ['user_id', '=', $user->id],
            ['ip', '=', $_SERVER['REMOTE_ADDR']],
            ['user_agent', '=', $_SERVER['HTTP_USER_AGENT']]                
        ])->first();

        if ($device) {
            if ($device->is_verified) {
                return $next($request);
            }
        } else {
            Device::create([
                'user_id' => $user->id,
                'ip' => $_SERVER['REMOTE_ADDR'],
                'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                'platform' => $agent->platform(),
                'device_name' => $agent->device(),
                'browser' => $agent->browser(),
            ]);
        }
        
        $user->token_2fa = mt_rand(10000, 99999);
        $user->token_2fa_expiry = \Carbon\Carbon::now()->addMinutes(10);
        $user->save();
        
        // Mail::raw("Login On New Device: " . $agent->browser() . ", " . $agent->platform() . ", " . $agent->device() . ". 4X_Nav_App OTP: $user->token_2fa", function ($message) use ($user) {
        //     $message->to($user->email);
        // });

        Mail::to($user->email)->queue(new OTP($user));

        return redirect('/2fa');  
    }
}