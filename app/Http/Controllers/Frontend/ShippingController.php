<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\ShippingState;
use App\Models\ShippingDistrict;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShippingController extends Controller
{
    public function CheckoutStore(Request $request)
    {
        $data = array();
    	$data['shipping_name'] = $request->shipping_name;
    	$data['shipping_email'] = $request->shipping_email;
    	$data['shipping_phone'] = $request->shipping_phone;
    	$data['post_code'] = $request->post_code;
    	$data['division_id'] = $request->division_id;
    	$data['district_id'] = $request->district_id;
    	$data['state_id'] = $request->state_id;
    	$data['notes'] = $request->notes;
        $cartTotal = Cart::total();

    	if ($request->payment_method == 'stripe') {
    		return view('frontend.payment.stripe',compact(['cartTotal', 'data']));
    	}elseif ($request->payment_method == 'card') {
    		return view('frontend.payment.card',compact(['cartTotal', 'data']));
    	}else{
            return view('frontend.payment.cash',compact(['cartTotal', 'data']));
    	}
    }


    public function DistrictGetAjax($division_id)
    {

    	$ship = ShippingDistrict::where('division_id',$division_id)->orderBy('district_name','ASC')->get();
    	return json_encode($ship);

    } // end method


     public function StateGetAjax($district_id)
     {

    	$ship = ShippingState::where('district_id',$district_id)->orderBy('state_name','ASC')->get();
    	return json_encode($ship);

    } // end method
}
