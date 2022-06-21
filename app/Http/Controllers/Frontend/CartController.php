<?php

namespace App\Http\Controllers\Frontend;


use App\Models\Coupon;
use App\Models\MyCart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
	public function myCart()
	{

		$carts = Cart::content();
            $cartQty = Cart::count();
            $cartTotal = Cart::total();

            return response()->json(array(
                'carts' => $carts,
                'cartQty' => $cartQty,
                'cartTotal' => round($cartTotal, 3),

            ));
	}
	public function index()
	{

        return view('frontend.cart.index');
	}

    public function AddToCart(Request $request, $id){

        // return response()->json($request);
		if (Session::has('coupon')) {
			Session::forget('coupon');
		}
    	$product = Product::findOrFail($id);

    	if ($product->selling_price == NULL) {
			// MyCart::create([
			// 	'user_id' => Auth::id(),
			// 	'product_id' => $id,
			// 	'created_at' => Carbon::now(),
			// ]);
    		Cart::add([
    			'id' => $id,
    			'name' => $request->product_name,
    			'qty' => $request->qty,
    			'price' => $product->regular_price,
    			'weight' => 1,
    			'options' => [
    				'image' => $product->product_thambnail,
    				'color' => $request->color,
    				'size' => $request->size,
    			],
    		]);

    		return response()->json(['success' => 'Successfully Added on Your Cart']);

    	}else{

    		Cart::add([
    			'id' => $id,
    			'name' => $request->product_name,
    			'qty' => $request->qty,
    			'price' => $product->selling_price,
    			'weight' => 1,
    			'options' => [
    				'image' => $product->product_thambnail,
    				'color' => $request->color,
    				'size' => $request->size,
    			],
    		]);
			// MyCart::create([
			// 	'user_id' => Auth::id(),
			// 	'product_id' => $id,
			// 	'created_at' => Carbon::now(),
			// ]);
    		return response()->json(['success' => 'Successfully Added on Your Cart']);
    	}

    } // end mehtod

        // Mini Cart Section
        public function getCart(){

            $carts = Cart::content();
            $cartQty = Cart::count();
            $cartTotal = Cart::total();

            return response()->json(array(
                'carts' => $carts,
                'cartQty' => $cartQty,
                'cartTotal' => round($cartTotal, 3),

            ));
        } // end method

		/// remove cart
		public function removeCart($rowId){
			Cart::remove($rowId);
			if (Session::has('coupon')) {
				Session::forget('coupon');
			}
			return response()->json(['success' => 'Product Remove from Cart']);

		} // end mehtod

		 // Cart Increment
		 public function CartIncrement($rowId){
			$row = Cart::get($rowId);
			Cart::update($rowId, $row->qty + 1);
			if (Session::has('coupon')) {

				$coupon_code = Session::get('coupon')['coupon_code'];
				$coupon = Coupon::where('coupon_code',$coupon_code)->first();

			   Session::put('coupon',[
					'coupon_code' => $coupon->coupon_code,
					'discount_value' => $coupon->discount_value,
                    'discount_amount' => round(Cart::total()*$coupon->discount_value/100),
                    'total_amount' => round(Cart::total()-Cart::total()*$coupon->discount_value/100),
				]);
			}
			return response()->json('increment');

		} // end mehtod
		// Cart Increment
		public function CartDecrement($rowId){
			$row = Cart::get($rowId);
			Cart::update($rowId, $row->qty - 1);
			if (Session::has('coupon')) {

				$coupon_code = Session::get('coupon')['coupon_code'];
				$coupon = Coupon::where('coupon_code',$coupon_code)->first();

			   Session::put('coupon',[
					'coupon_code' => $coupon->coupon_code,
					'discount_value' => $coupon->discount_value,
                    'discount_amount' => round(Cart::total()*$coupon->discount_value/100),
                    'total_amount' => round(Cart::total()-Cart::total()*$coupon->discount_value/100),
				]);
			}
			return response()->json('decrement');

		} // end mehtod

        public function CouponApply(Request $request){

            //return response()->json($request);
            $coupon = Coupon::where('coupon_code', $request->coupon_name)->first();


            if($coupon){

                Session::put('coupon', [
                    'coupon_code' => $coupon->coupon_code,
                    'discount_value' => $coupon->discount_value,
                    'discount_amount' => round(Cart::total()*$coupon->discount_value/100),
                    'total_amount' => round(Cart::total()-Cart::total()*$coupon->discount_value/100),
                ]);

                return response()->json(['success' => 'valid Coupon']);

            }else{
                return response()->json(['error' => 'Invalid Coupon']);
            }
        }

        public function CouponCalc(){
            if(Session::has('coupon')){
                return response()->json([
                    'subtotal' => Cart::total(),
                    'coupon_code' => session()->get('coupon')['coupon_code'],
                    'discount_value' => session()->get('coupon')['discount_value'],
                    'discount_amount' => session()->get('coupon')['discount_amount'],
                    'total_amount' => session()->get('coupon')['total_amount'],
                ]);
            }else{
                return response()->json([
                    'total' => Cart::total(),
                ]);
            }
        }

		public function CouponRemove(){
			Session::forget('coupon');
			return response()->json(['success' => 'Coupon Remove Successfully']);
		}
}
