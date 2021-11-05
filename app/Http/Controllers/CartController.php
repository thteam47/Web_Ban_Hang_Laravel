<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use Mail;
use Auth;
use App\Models\Models\Product;
use App\Models\Models\Buycart;
class CartController extends Controller
{
    //
	public function getAddCart($id){
		$product = Product::find($id);
		if ($product->p_status == 0) {
			return redirect()->back()->with('error',"Sản phẩm hiện tại hết hàng. Vui lòng quay lại sau");
		}
		$price = $product->p_price-$product->p_price*$product->p_promotion/100;
		Cart::add(['id' => $id, 'name' => $product->p_name, 'qty' => 1, 'price' => $price, 'options' => ['img' => $product->p_image]]);

		return redirect('cart/show');

	}
	public function getShowCart(){
		$login = (Auth::check()?1:0);
		$viewData['checklogin'] = $login;
		$viewData['items'] = Cart::content();
		$viewData['total'] = Cart::total();
		$viewData['infoUser']= Auth::user();
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
		//dd($request->all());
		if ($request->qty <= 0) {
			return redirect()->back();
		}
		Cart::update($request->rowId,$request->qty);
	}
	public function postComplete(Request $request){
		if(Auth::check()){
			if (Auth::user()->email_verified_at == NULL){
				return redirect('register/verifyemail')->with('error','Please verify your email before payment');
			}else {
				$buyCart = new Buycart();
				$buyCart->id_buyer = Auth::id();
				$buyCart->infoBuyer = 'Gmail: '. $request->email."<br>Họ tên: " .$request->name.
				"<br>Số điện thoại: ".$request->phone ."<br>Địa chỉ: ".$request->add;
				$i = 1;
				$total = 0;
				foreach (Cart::content() as $item) {
					Auth::user()->buyCarts()->attach(Product::where('p_id',$item->id)->first());
					$priceCart = $item->price*$item->qty;
					$buyCart->infoProduct .= $i . ". Tên sản phẩm: ". $item->name. "<br> Số lượng: ". $item->qty. "<br> Thành tiền: ".  $priceCart. "<br>";
					$i++;
					$total += $priceCart;
				}
				$buyCart->total = (integer)$total;
				$buyCart->save();
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
				Cart::destroy();
				
				return redirect('complete');
			}
		}
		else{
			return redirect()->back()->with('error','Vui lòng đăng nhập trước khi thanh toán');
		}
	}
}
