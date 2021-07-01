<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
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
    public function postLogin(Request $request) {
        $data = ['email'=>$request->email, 'password' =>$request->password];
        if ($request->remember == "re"){
            $remember = true;
        }
        else {
            $remember = false;
        }
        if (Auth::attempt($data,$remember)){
            return redirect()->intended('admin');
        }
        else {
            return back()->withInput()->with('error','Tài khoản hoặc mật khẩu chưa đúng');
        }
    }
}
