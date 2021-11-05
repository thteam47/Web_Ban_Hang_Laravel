<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;
class Otp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()){                
        } else {
            if (Auth::user()->hasRole('user')){
                return redirect()->intended('/');
            }
            if(Auth::user()->active==0){
                return redirect()->intended('admin/login/otp');
            }   
        }
        return $next($request);
    }
}

