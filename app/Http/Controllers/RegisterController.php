<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RequestRegister;
use App\Models\User;
use App\Models\Roles;
use Mail;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon;
use Auth;
class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }
    public function viewVerity()
    {
        return view('verify.viewVerify');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function postRegister(RequestRegister $request) {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $repeat = $request->repassword;
        if ($request->password != $repeat ){
        return redirect()->back()->with('error','Repeat Password Incorrect');
        }
        $user->active = 0;
        $user->otp =0;
        $user->save();
        $user = User::where('email',$request->email)->first();
        $user->roles()->attach(Roles::where('name','user')->first());
        $url = Crypt::encryptString($user->email);
        $data['url'] = "http://localhost/banhanglaravel/register/checkverifyemail/".$url;
        Cookie::queue('vertify', $url, 10);
        $email = $request->email;
        try {
            Mail::send('verify.verifymail',$data,function($message) use($email){
                $message->from('thaithteam47@gmail.com');
                $message->to($email,$email);
                $message->cc('thteam47@gmail.com','THteaM');
                $message->subject('Verify Account');
            });
        }
        catch(\Exception $e){
            Session::flush();
            return abort(404,$e);
        }
        return redirect('register/verifyemail')->with('message','Register Complete');
    }
    public function checkVetify($url){
        $urlCookie = Cookie::get('vertify');
        if ($urlCookie){
            try {
                $email = Crypt::decryptString($url);
                if (strcmp($url,$urlCookie)==0){
                    $user = User::where('email',$email)->first();
                    $user->email_verified_at = Carbon::now();
                    $user->save();
                    Cookie::forget('vertify');
                    return redirect('login')->with('message','Xác minh thành công. Vui lòng đăng nhập');
                }
                else {
                    return redirect('/register/verifyemail')->with('error','Link expired. Please resend the request.');
                }
            } catch (DecryptException $e) {
                return abort(404,'Page Not Found');
            }
        }else{
            return redirect('/register/verifyemail')->with('error','Link expired. Please resend the request.');
        }
    }
    public function RecheckVetify() {
        if (Auth::check()){
            $url = Crypt::encryptString(Auth::user()->email);
            $data['url'] = "http://localhost/banhanglaravel/register/checkverifyemail/".$url;
            Cookie::queue('vertify', $url, 10);
            $email = Auth::user()->email;
            try {
                Mail::send('verify.verifymail',$data,function($message) use($email){
                    $message->from('thaithteam47@gmail.com');
                    $message->to($email,$email);
                    $message->cc('thteam47@gmail.com','THteaM');
                    $message->subject('Verify Account');
                });
            }
            catch(\Exception $e){
                Session::flush();
                return abort(404,$e);
            }
            return redirect()->back()->with('message','Link Sent');
        }else {
            return redirect('login')->with('message','Please Login');
        }
    }
}
