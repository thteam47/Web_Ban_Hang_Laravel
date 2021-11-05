<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;
class CheckLogedIn
{
    public function handle(Request $request, Closure $next)
    {        
        if(Auth::check()){
            $user = User::where('id',Auth::id())->get();
            if($user[0]->active==0){
                return redirect()->intended('admin/login/otp');
            } else {
                return redirect()->intended('admin');
            }  
        }
        return $next($request);
    }
}
