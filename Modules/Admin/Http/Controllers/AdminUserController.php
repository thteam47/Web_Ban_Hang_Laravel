<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Models\Product;
use App\Models\Models\Category;
use App\Models\User;
use App\Models\Roles;
use DB;
use Session;
use Auth;
class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $viewData['userList'] = User::with('roles')->orderBy('id','asc')->paginate(10);
        return view('admin::user.index',$viewData);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $viewData['listRoles'] = Roles::all();
        return view('admin::user.create',$viewData);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function assign_roles(Request $request){       
        $user = User::where('email',$request->email)->first();
        if (Auth::id()==$user->id){
            return redirect()->back();
        }else {
            //if ($user->roles()->hasRole(''))
            if (strcmp($request->role,'admin_role')==0){
                if ($user->hasRole('admin')){
                    $user->roles()->detach();
                    $user->roles()->attach(Roles::where('name','user')->first());
                }else{                    
                    $user->roles()->detach();
                    $user->roles()->attach(Roles::where('name','admin')->first());
                }
            }
            if (strcmp($request->role,'assistant_role')==0){
                if ($user->hasRole('assistant')){
                    if($user->hasRole('seller')){
                        if($user->hasRole('user')){
                            $user->roles()->detach(Roles::where('name','user')->first());
                        }
                        $user->roles()->detach(Roles::where('name','assistant')->first());
                    }else{
                        $user->roles()->detach();
                        $user->roles()->attach(Roles::where('name','user')->first());
                    }
                }else{
                    if($user->hasRole('admin')){
                        $user->roles()->detach(Roles::where('name','admin')->first());
                        $user->roles()->attach(Roles::where('name','assistant')->first());
                    }else{
                        if($user->hasRole('user')){
                            $user->roles()->detach(Roles::where('name','user')->first());
                        }
                        $user->roles()->attach(Roles::where('name','assistant')->first());       
                    }                   
                }
            }

            if(strcmp($request->role,'seller_role')==0){
                if ($user->hasRole('seller')){
                    if($user->hasRole('assistant')){
                        if($user->hasRole('user')){
                            $user->roles()->detach(Roles::where('name','user')->first());
                        }
                        $user->roles()->detach(Roles::where('name','seller')->first());
                    }else{
                        $user->roles()->detach();
                        $user->roles()->attach(Roles::where('name','user')->first());
                    }
                }else{
                    if($user->hasRole('admin')){
                        $user->roles()->detach(Roles::where('name','admin')->first());
                        $user->roles()->attach(Roles::where('name','seller')->first());
                    }else{
                        if($user->hasRole('user')){
                            $user->roles()->detach(Roles::where('name','user')->first());
                        }
                        $user->roles()->attach(Roles::where('name','seller')->first());       
                    }                   
                }
            }
            if(strcmp($request->role,'user_role')==0){
                if ($user->hasRole('user')){
                    return redirect()->back();
                }else{                    
                    $user->roles()->detach();
                    $user->roles()->attach(Roles::where('name','user')->first());
                }
            }
        }
    }


    public function detroyX($id){
        if(Auth::id()==$id){
            return redirect()->back();
        }
        $user = User::find($id);
        if ($user) {
            $user->roles()->detach();
            $user->delete();
        }
        return redirect()->back();
    }

}
