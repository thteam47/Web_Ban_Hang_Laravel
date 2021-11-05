<?php

namespace App\Http\Middleware;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;
class CheckPassExpires
{
    public function handle(Request $request, Closure $next)
    {        
        if(Auth::check()){
            //dd(Carbon::now());
            $date1 = Auth::user()->created_at;
            $date2 = Carbon::now()->subDay(60);
            if ($date1->lt($date2)){
                return redirect()->intended('profile/changePass')->with('error','To ensure safety. Please change your password after 60 days.');
            } 
        }
        return $next($request);
    }
}
