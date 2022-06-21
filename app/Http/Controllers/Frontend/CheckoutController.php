<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\ShippingDivision;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    public function index(){
        if(Auth::check()){
            $carts = Cart::content();
            $cartQty = Cart::count();
            $cartTotal = Cart::total();
            $divisions = ShippingDivision::orderBy('division_name','ASC')->get();
            return view('frontend.checkout.index', compact(['carts', 'cartQty', 'cartTotal', 'divisions']));
        }else{
            return redirect()->back()->with('message', 'You should login first');
        }
    }
}
