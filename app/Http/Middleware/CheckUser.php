<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;
class CheckUser
{
    public function handle(Request $request, Closure $next)
    {        
        if(!Auth::check()){
            return redirect()->intended('/login');
        }else {
            if ((Auth::user()->email_verified_at == NULL)){
                return redirect('/register/verifyemail')->with('error','Please Verify Email.');
            }
        }
        return $next($request);
    }
}
