<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use Mail;
use App\Models\Models\Product;
class CartController extends Controller
{
    //
	public function getAddCart($id){
		$product = Product::find($id);
		$price = $product->p_price-$product->p_price*$product->p_promotion/100;
		Cart::add(['id' => $id, 'name' => $product->p_name, 'qty' => 1, 'price' => $price, 'options' => ['img' => $product->p_image]]);
		return redirect('cart/show');

	}
	public function getShowCart(){
		$viewData['items'] = Cart::content();
		$viewData['total'] = Cart::total();
		return view('cart',$viewData);
	}
	public function getDeleteCart($id){
		if ($id=='all') {
			Cart::destroy();
		}
		else {
			Cart::remove($id);
		}
		
		return redirect()->back();
	}
	public function getUpdateCart(Request $request){
		Cart::update($request->rowId,$request->qty);
	}
	public function postComplete(Request $request){
		$viewData['info'] = $request->all();
		$email = $request->email;
		$viewData['cart'] = Cart::content();
		$viewData['total'] = Cart::total();
		Mail::send('email',$viewData,function($message) use($email){
			$message->from('thaithteam47@gmail.com');
			$message->to($email,$email);
			$message->cc('thteam47@gmail.com','THteaM');
			$message->subject('Đơn thanh toán');
		});
		return redirect('complete');
	}
}
