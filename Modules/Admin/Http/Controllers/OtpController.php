<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Auth;
use Session;
use Exception;
class OtpController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        //$id = {{ Cookie::get('id') }};
        return view('admin::otp');
    }

    
    public function postOtp(Request $request){
        try {
            $countOtp = Session::get('countOtp');
            if ($countOtp){
                $countOtp = Crypt::decryptString($countOtp);    
                if ($countOtp>=4){
                    $userChange = User::find(Auth::id());
                    $userChange->otp = 0;
                    $userChange->save();
                    Auth::logout();
                    Session::flush();
                    return redirect()->intended('admin/login')->with('error','Mã otp nhập sai quá nhiều. Vui lòng đăng nhập lại');
                }else {
                    $countOtp+=1;
                }
            }else {
                $countOtp = 0;
            }           
            Session::put('countOtp', Crypt::encryptString($countOtp));
        } catch (DecryptException $e) {
            Session::flush();
            return abort(404,'I see you have bad behavior with our website. Please stop.');
        }   
        $otpCookie = Cookie::get('otp');
        if ($otpCookie){
            try {
                $otp = Crypt::decryptString($otpCookie);
                if($otp==$request->otp){
                    $userChange = User::find(Auth::id());
                    $userChange->active = 1;
                    $userChange->save();
                    Cookie::queue(Cookie::forget('otp'));
                    Session::flush();
                    return redirect()->intended('admin');
                }else{
                    return back()->withInput()->with('error','Mã otp sai. Còn '.(5-$countOtp).' lần thử lại');
                }
            } catch (DecryptException $e) {
                Session::flush();
                Auth::logout();
                return abort(404,'Page Not Found');
            }
        }else{
            Auth::logout();
            Session::flush();
            return redirect('admin/login')->with('error','Otp expired. Please login agian.');
        }



    } 
}
