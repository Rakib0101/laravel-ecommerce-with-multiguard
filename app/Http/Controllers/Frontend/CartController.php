<?php

namespace App\Http\Controllers\Frontend;


use App\Models\MyCart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
			return response()->json(['success' => 'Product Remove from Cart']);
	
		} // end mehtod 

		 // Cart Increment 
		 public function CartIncrement($rowId){
			$row = Cart::get($rowId);
			Cart::update($rowId, $row->qty + 1);
	
			return response()->json('increment');
	
		} // end mehtod    
		// Cart Increment 
		public function CartDecrement($rowId){
			$row = Cart::get($rowId);
			Cart::update($rowId, $row->qty - 1);
	
			return response()->json('decrement');
	
		} // end mehtod 
}
