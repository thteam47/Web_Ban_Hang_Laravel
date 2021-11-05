<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Mail;
use Illuminate\Support\Str;
use Illuminate\Contracts\Cache\LockTimeoutException;
use Illuminate\Support\Facades\Hash;
class ForgotpassController extends Controller
{
	public function index(){
		
		return view('password.resetPass');
	}
	public function vieww(){
		return view('password.changePass');
	}
	public function postReset(Request $request){
		$user = User::where('email',$request->email)->first();
		if($user){
			$otpNum = Str::random(10);
			$otp['num'] = $otpNum;
			$email =$request->email;
			Session::put('repass', $otpNum);
			Session::put('email', $email);
			try {
				Mail::send('password.resetpassview',$otp,function($message) use($email){
					$message->from('thaithteam47@gmail.com');
					$message->to($email,$email);
					$message->cc('thteam47@gmail.com','THteaM');
					$message->subject('Reset Password');
				});
			}
			catch(\Exception $e){
				Session::flush();
				return abort(404,'Please check connect network again');
			}
			return redirect('login/changeResetPass');
		}
		else {
			Session::flush();
			return redirect()->back()->with('error','Email incorrect. Try again');
		}
		
	}
	public function postchangeResetPass(Request $request){
		$email = Session::get('email');
		if ($email){
			if (strcmp(Session::get('repass'),$request->currentpass)==0){
				if(strcmp($request->newpass,$request->repass)==0){
					$user = User::where('email',$email)->first();
					$user->password = Hash::make($request->newpass);
					$user->save();
					Session::flush();
					return redirect('/login')->with('message','Change Password Successful');
				}else{
					return redirect()->back()->with('error','Repeat Password incorrect. Try again');
				}
			}else{
				return redirect()->back()->with('error','Current Password incorrect. Try again');
			}
		}else{
			return abort(404,'Page Not Found');
		}
	}
}
