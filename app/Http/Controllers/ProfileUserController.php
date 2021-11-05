<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class ProfileUserController extends Controller
{

	public function index(){
		$viewData['info'] = Auth::user();
		return view('profile.user',$viewData);
	}
	public function vieww(){
		return view('profile.changePass');
	}
	public function getLogout(){    
		Auth::logout();
		return redirect()->intended('login');
	}
	public function postchangePass(Request $request){
		if (Hash::check($request->currentpass, Auth::user()->password)){
			if(strcmp($request->newpass,$request->repass)==0){
				$user = User::find(Auth::id());
				$user->password = Hash::make($request->newpass);
				$user->created_at = Carbon::now();
				$user->save();
				return redirect()->back()->with('message','Change Password Successful');
			}else{
				return redirect()->back()->with('error','Repeat Password incorrect. Try again');
			}
		}else{
			return redirect()->back()->with('error','Current Password incorrect. Try again');
		}
	}
}
