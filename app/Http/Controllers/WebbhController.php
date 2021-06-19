<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Product;
use App\Models\Models\Category;
use App\Models\Models\Comment;
use App\Models\Models\Advertisement;

class WebbhController extends Controller
{
    //
    public function index() {

    	$viewData['hot'] = Product::where([['p_hot',1],['p_active',1]])->orderBy('p_id','desc')->take(4)->get();
    	$viewData['news'] = Product::orderBy('p_id','desc')->take(4)->get();
        $viewData['advs'] = Advertisement::all();
        $viewData['count_advs'] = Advertisement::count();
    	return view('welcome',$viewData);
    }
    public function getDetails($id) {
    	$viewData['item'] = Product::find($id);
        $viewData['comments'] = Comment::where('comment_product',$id)->get();
    	return view('details',$viewData);
    }
    public function getCategory($id){
        $viewData['prodcate'] = Product::where('prod_cate',$id)->orderBy('p_id','desc')->paginate(1);
        $viewData['cateName'] = Category::find($id);
        return view('category',$viewData);
    }
    public function postComment(Request $request, $id){
        $com = new Comment();
        $com->comment_name = $request->name;
        $com->comment_email = $request->email;
        $com->comment_content = $request->content;
        $com->comment_product = $id;
        $com->save();
        return redirect()->back();
    }
    public function getSearch(Request $request){
        $result = $request->result;
        $viewData['key'] = $result;
        $result = str_replace(' ','%',$result);
        $viewData['searchKey'] = Product::where('p_name','like','%'.$result.'%')->get();
        return view('search',$viewData);
    }
    public function getComplete(){
        return view('complete');
    }

}
