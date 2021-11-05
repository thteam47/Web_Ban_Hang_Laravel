<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Models\Buycart;
use Auth;
use DB;
class AdminBuycartController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        
        $viewData['data'] = Buycart::all();
        return view('admin::buycart.index',$viewData);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function updateStatus(Request $request) {
        $buyCart = Buycart::find($request->id);
        $buyCart->status = $request->status;
        $buyCart->save();
    }
}
