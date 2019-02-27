<?php
namespace App\Http\Middleware;

use Closure;
use Auth;
use Mail;

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

        if ($user->token_2fa_expiry > \Carbon\Carbon::now()){
            return $next($request);
        } 
        
        $user->token_2fa = mt_rand(10000,99999);
        $user->save();                
        
         Mail::raw('4X_Nav_App OTP: ' . $user->token_2fa, function ($message) use ($user) {
            $message->to($user->email);
         });

        return redirect('/2fa');  
    }
}