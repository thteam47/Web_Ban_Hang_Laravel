<?php

namespace Modules\Admin\Http\Controllers;


use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\RequestCategory;
use App\Models\Models\Category;
class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $categories = Category::all();
        $viewData = [
            'categories' => $categories
        ];
        return view('admin::category.index',$viewData);

    }
    public function create(){
    	return view ('admin::category.create');
    }
    public function store(RequestCategory $requestCategory){
        //dd($requestCategory->all());
        $this->insertOrUpdate($requestCategory);

        return redirect()->back();
    }
    public function edit($id){
        $category = Category::find($id);
        
        return view('admin::category.update',compact('category'));
    }
    public function update(RequestCategory $requestCategory,$id){
        
        $this->insertOrUpdate($requestCategory,$id);

        return redirect()->back();
    }
    public function insertOrUpdate(RequestCategory $requestCategory,$id=''){
        $result =1;
        try {
            $category = new Category();
            if ($id){
                $category = Category::find($id);
            }
            $category->c_name = $requestCategory->name;
            $category->c_icon =  "fa ".$requestCategory->icon;
            $category->c_slug =  str_slug($requestCategory->name);
            if (!$requestCategory->active) $category->c_active =0;           
            $category->save();
        } catch (Exception $e) {
            $result =0;
            Log::error("[Error insertUpdate Category]".$e->getMessage());
        }
        return $result;
    }
    public function detroyX($id){
        Category::find($id)->delete();
        return redirect()->back();
    }


}
