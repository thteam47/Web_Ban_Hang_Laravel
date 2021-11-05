<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;
class CheckLoginUser
{
    public function handle(Request $request, Closure $next)
    {        
        if(Auth::check()){
            if(Auth::user()->hasRole('user')){
                return redirect()->intended('/');
            } else {
                if(Auth::user()->active==0){
                    return redirect()->intended('admin/login/otp');
                }else {
                    return redirect()->intended('/');
                }              
            }  
        }
        return $next($request);
    }
}
