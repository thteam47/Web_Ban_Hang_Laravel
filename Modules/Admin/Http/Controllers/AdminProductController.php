<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\RequestProduct;
use App\Models\Models\Product;
use App\Models\Models\Category;
use DB;
use Auth;
class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        if(Auth::user()->hasRole('seller')){
            $viewData['productList'] = DB::table('products')->join('categories','products.prod_cate','=','categories.c_id')
            ->join('users','products.prod_seller','=','users.id')
            ->where('products.prod_seller',Auth::id())
            ->orderBy('p_id','desc')
            ->select('p_id','p_name','p_price','p_image','c_name','p_hot','p_active','name','email')
            ->paginate(10);
        }else {
            $viewData['productList'] = DB::table('products')->join('categories','products.prod_cate','=','categories.c_id')
            ->join('users','products.prod_seller','=','users.id')

            ->orderBy('p_id','desc')
            ->select('p_id','p_name','p_price','p_image','c_name','p_hot','p_active','name','email')
            ->paginate(10);
        }
        
        //dd($viewData['productList']);
        return view('admin::product.index',$viewData);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

        $viewData['cateList'] = Category::all();

        return view('admin::product.create',$viewData);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(RequestProduct $requestProduct){
        //dd($requestProduct->all());
        $product = new Product();
        $filename = $requestProduct->img->getClientOriginalName();
        $product->p_name = $requestProduct->p_name;
        $product->p_description =  $requestProduct->p_description;
        $product->p_slug =  str_slug($requestProduct->p_name);
        $product->p_price =  $requestProduct->p_price;
        $product->p_promotion =  $requestProduct->p_promotion;
        $product->p_status =  $requestProduct->p_status;
        $product->p_warranty = $requestProduct->p_warranty;
        if ($requestProduct->p_accessories == "") {
            $product->p_accessories = "Không có";
        } else {
            $product->p_accessories = $requestProduct->p_accessories;
        }
        


        $product->p_description = $requestProduct->p_description;
        $product->p_image =  $filename;
        $product->p_hot =  $requestProduct->p_hot ? 1 : 0;
        $product->p_active =  $requestProduct->p_active ? 1 : 0;
        $product->p_condition =  $requestProduct->p_condition;
        $product->prod_cate = $requestProduct->prod_cate;
        $requestProduct->img->storeAs('avatar',$filename);
        $category = Category::find($product->prod_cate);
        $category->c_total_product = $category->c_total_product +1;
        $product->save();
        $category->save();

        return redirect()->back();
    }
    public function edit($id){
        $viewData['product'] = Product::find($id);
        $viewData['listCate'] = Category::all();
        return view('admin::product.update',$viewData);
    }
    public function update(RequestProduct $requestProduct,$p_id){
        $product = Product::find($p_id);
        if($requestProduct->file('imgAdv')){
            $filename = $requestProduct->file('imgAdv')->getClientOriginalName();
            $product->p_image =  $filename;
            $requestProduct->file('imgAdv')->storeAs('avatar',$filename);
        }   
        $product->p_name = $requestProduct->p_name;
        $product->p_description =  $requestProduct->p_description;
        $product->p_slug =  str_slug($requestProduct->p_name);
        $product->p_price =  $requestProduct->p_price;
        $product->p_promotion =  $requestProduct->p_promotion;
        $product->p_status =  $requestProduct->p_status;
        $product->p_warranty = $requestProduct->p_warranty;
        $product->p_accessories = $requestProduct->p_accessories;
        $product->p_description = $requestProduct->p_description;
        $product->p_hot =  $requestProduct->p_hot ? 1 : 0;
        $product->p_active =  $requestProduct->p_active ? 1 : 0;
        $product->p_condition =  $requestProduct->p_condition;
        if ($requestProduct->prod_cate == $product->prod_cate) {
            $product->prod_cate = $requestProduct->prod_cate;
        }
        else {
            $categoryD = Category::find($product->prod_cate);
            $categoryD->c_total_product = $categoryD->c_total_product -1;
            $categoryD->save();
            $categoryU = Category::find($requestProduct->prod_cate);
            $categoryU->c_total_product = $categoryU->c_total_product +1;
            $categoryU->save();
            $product->prod_cate = $requestProduct->prod_cate;

        }      
        $product->save();

        return redirect('admin/product');
    }
    
    public function detroyX($id){
        $product = Product::find($id);
        $category = Category::find($product->prod_cate);
        $category->c_total_product = $category->c_total_product -1;
        $category->save();
        $product->delete();
        return redirect()->back();
    }
    public function getCategories(){
        return Category::all();
    }
}
