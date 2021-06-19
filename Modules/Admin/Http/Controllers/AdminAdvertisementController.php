<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Models\Advertisement;

class AdminAdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $viewData['advs'] = Advertisement::all();
        return view('admin::advertisement.index',$viewData);
    }
    public function create(){
        return view ('admin::advertisement.create');
    }
    public function store(Request $request){
        $this->insertOrUpdate($request);

        return back();
    
    }
    public function edit($id){
        $adv = Advertisement::find($id);
        
        return view('admin::advertisement.update',compact('adv'));
    }
    public function update(Request $request,$id){
        
        $this->insertOrUpdate($request,$id);

        return back();
    }
    public function insertOrUpdate(Request $request,$id=''){
        $result =1;
        try {
            $adv = new Advertisement();
            if ($id){
                $adv = Advertisement::find($id);
            }
            if($request->file('imgAdv')){
                $filename = $request->file('imgAdv')->getClientOriginalName();
                $adv->adv_img =  $filename;
                $request->file('imgAdv')->storeAs('advImg',$filename);
            }            
            $adv->adv_link = $request->link;           
            
            $adv->save();
        } catch (Exception $e) {
            $result =0;
            Log::error("[Error insertUpdate Advertisement]".$e->getMessage());
        }
        return $result;
    }
    public function detroyX($id){
        advertisement::find($id)->delete();
        return redirect()->back();
    }
}
