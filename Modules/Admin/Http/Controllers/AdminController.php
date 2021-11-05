<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
use Session;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;
use DB;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $viewData['nameAuth'] = DB::table('roles')->join('roles_user','roles_user.roles_id_roles','=','roles.id_roles')
        ->join('users','roles_user.user_id','=','users.id')
        ->where('users.id',Auth::id())
        ->select('roles.name')->get();
        return view('admin::index',$viewData);
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function getLogout(){
        $userChange = User::find(Auth::id());
        $userChange->active = 0;
        $userChange->otp = 0;
        $userChange->save();       
        Auth::logout();
        return redirect()->intended('admin/login');
    }
}
