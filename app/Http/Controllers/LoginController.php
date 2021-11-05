<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Requestlogin;
use Auth;
use Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Contracts\Cache\LockTimeoutException;
use Illuminate\Support\Facades\Crypt;
class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function postLogin(RequestLogin $request) {

        $data = ['email'=>$request->email, 'password' =>$request->password];
        if ($request->remember == "re"){
            $remember = true;
        }
        else {
            $remember = false;
        }
        if (Auth::attempt($data,$remember)){
            if(!Auth::user()->hasRole('user')){
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
            }else {
                $userChange = User::find(Auth::id());
                $userChange->active = 1;
                $userChange->save();
                if (Auth::user()->email_verified_at == NULL){
                    return redirect('register/verifyemail')->with('error','Please verify your account');
                }

            }
            return redirect('/');
        }
        else {
            return back()->withInput()->with('error','Tài khoản hoặc mật khẩu chưa đúng');
        }
    }
    public function getLogout(){    
        Auth::logout();
        return redirect()->intended('login');
    }
}
