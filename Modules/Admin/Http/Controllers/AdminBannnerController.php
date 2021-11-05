<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Models\Banner;

class AdminBannnerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $viewData['bans'] = Banner::all();
        return view('admin::banner.index',$viewData);
    }
    public function create(){
        return view ('admin::banner.create');
    }
    public function store(Request $request){
        $this->insertOrUpdate($request);

        return back();
    
    }
    public function edit($id){
        $ban = Banner::find($id);
        return view('admin::banner.update',compact('ban'));
    }
    public function update(Request $request,$id){
        
        $this->insertOrUpdate($request,$id);

        return back();
    }
    public function insertOrUpdate(Request $request,$id=''){
        $result =1;
        try {
            $ban = new Banner();
            if ($id){
                $ban = Banner::find($id);
            }
            if($request->file('imgBan')){
                $filename = $request->file('imgBan')->getClientOriginalName();
                $ban->ban_img =  $filename;
                $request->file('imgBan')->storeAs('banImg',$filename);
            }            
            $ban->ban_link = $request->link;           
            
            $ban->save();
        } catch (Exception $e) {
            $result =0;
            Log::error("[Error insertUpdate Banner]".$e->getMessage());
        }
        return $result;
    }
    public function detroyX($id){
        banner::find($id)->delete();
        return redirect()->back();
    }
}
