<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Product;
use App\Models\Models\Category;
use App\Models\Models\Comment;
use App\Models\Models\Advertisement;
use App\Models\Models\Banner;
use Auth;
use Illuminate\Support\Facades\Hash;
class WebbhController extends Controller
{
    //
    public function index() {       
        $viewData['hot'] = Product::where([['p_hot',1],['p_active',1]])->orderBy('p_id','desc')->take(6)->get();
        $viewData['news'] = Product::orderBy('p_id','desc')->take(6)->get();
        $viewData['advs'] = Advertisement::all();
        $viewData['bans'] = Banner::all();
        $viewData['count_bans'] = Banner::count();
        $viewData['pros'] = Product::all();
        $login = (Auth::check()?1:0);
        $viewData['checklogin'] = $login;
        return view('welcome',$viewData);
    }
    public function getDetails($id) {
        $login = (Auth::check()?1:0);
        $viewData['checklogin'] = $login;
        $viewData['item'] = Product::find($id);
        $viewData['info'] = Auth::user();
        $viewData['comments'] = Comment::where('comment_product',$id)->get();
        return view('details',$viewData);
    }
    public function getCategory($id){
        $login = (Auth::check()?1:0);
        $viewData['checklogin'] = $login;
        $viewData['prodcate'] = Product::where('prod_cate',$id)->orderBy('p_id','desc')->paginate(3);
        $viewData['cateName'] = Category::find($id);
        return view('category',$viewData);
    }
    public function postComment(Request $request, $id){
        if (Auth::check()){
            if (Auth::user()->email_verified_at == NULL){
                return redirect('register/verifyemail')->with('error','Please verify your email before comment');
            }
            $com = new Comment();
            $com->comment_name = Auth::user()->name;
            $com->comment_email = Auth::user()->email;
            $com->comment_content = $request->content;
            $com->comment_product = $id;
            $com->save();
            return redirect()->back();
        }else {
            return redirect()->back()->with('error','Vui lòng đăng nhập trước khi bình luận');
        }
    }
    public function getSearch(Request $request){
        $login = (Auth::check()?1:0);
        $viewData['checklogin'] = $login;
        $result = $request->result;
        $viewData['key'] = $result;
        $result = str_replace(' ','%',$result);
        $viewData['searchKey'] = Product::where('p_name','like','%'.$result.'%')->get();
        return view('search',$viewData);
    }
    public function getComplete(){
        $login = (Auth::check()?1:0);
        $viewData['checklogin'] = $login;
        return view('complete',$viewData);
    }

}
