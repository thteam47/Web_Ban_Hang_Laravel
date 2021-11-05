<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
use Session;
use Mail;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\RateLimiter;

class AdminLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('admin::admin_login');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */



    // public function throttleKey()
    // {
    //     return Str::lower(request('email')) . '|' . request()->ip();
    // }
    public function postLogin(Request $request) {
        //$this->checkTooManyFailedAttempts($request->email);
        //dd($request->all());

        $countLogin = Session::get('countLogin');
        if ($countLogin){
            try{
                $countLogin = Crypt::decryptString($countLogin);    
            } catch (DecryptException $e) {
                Session::flush();
                return abort(404,'I see you have bad behavior with our website. Please stop.');
            }  
            if ($countLogin>5){
                Session::flush();
                return abort(404,'You have entered the wrong email or password too many times. Please come back.');
            }else {
                $countLogin+=1;
            }
        }else {
            $countLogin = 1;
        }           
        Session::put('countLogin', Crypt::encryptString($countLogin));
        $data = ['email'=>$request->email, 'password' =>$request->password];
        if ($request->remember == "re"){
            $remember = true;
        }
        else {
            $remember = false;
        }
        if (Auth::attempt($data,$remember)){

            if(Auth::user()->hasRole('user')){
                Auth::logout();
                return redirect()->intended('admin/login')->with('error','Tài khoản hoặc mật khẩu chưa đúng');      
            }else {
                $otpNum = rand(100000,999999);    
                Cookie::queue('otp',Crypt::encryptString($otpNum), 1);               
                $otp['num'] = $otpNum;               
                $email =$request->email;
                try {
                    Mail::send('otpview',$otp,function($message) use($email){
                        $message->from('thaithteam47@gmail.com');
                        $message->to($email,$email);
                        $message->cc('thteam47@gmail.com','THteaM');
                        $message->subject('Mã xác thực');
                    });
                }                    
                catch(\Exception $e){
                    Session::flush();
                    return abort(404,'Please check the network connection again.');
                }
                $userChange = User::find(Auth::id());
                $userChange->otp = $otpNum;
                $userChange->save();
                return redirect('admin/login/otp');
            }
        }
        else {
            return back()->withInput()->with('error','Tài khoản hoặc mật khẩu chưa đúng');
        }

    }
}
