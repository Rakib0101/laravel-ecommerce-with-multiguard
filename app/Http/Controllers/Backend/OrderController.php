<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    // Pending Orders
	public function PendingOrders(){
		$orders = Order::where('status','Pending')->orderBy('id','DESC')->get();
		return view('backend.orders.pending-orders',compact('orders'));

	} // end mehtod

    // Pending Order Details
	public function PendingOrdersDetails($order_id){

		$order = Order::with('division','district','state','user')->where('id',$order_id)->first();
    	$orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
    	return view('backend.orders.pending-order-details',compact('order','orderItem'));
	}

    	// Confirmed Orders
	public function ConfirmedOrders(){
		$orders = Order::where('status','confirmed')->orderBy('id','DESC')->get();
		return view('backend.orders.confirmed-orders',compact('orders'));

	} // end mehtod


	// Processing Orders
	public function ProcessingOrders(){
		$orders = Order::where('status','processing')->orderBy('id','DESC')->get();
		return view('backend.orders.processing-orders',compact('orders'));

	} // end mehtod


		// Picked Orders
	public function PickedOrders(){
		$orders = Order::where('status','picked')->orderBy('id','DESC')->get();
		return view('backend.orders.picked-orders',compact('orders'));

	} // end mehtod



			// Shipped Orders
	public function ShippedOrders(){
		$orders = Order::where('status','shipped')->orderBy('id','DESC')->get();
		return view('backend.orders.shipped-orders',compact('orders'));

	} // end mehtod


			// Delivered Orders
	public function DeliveredOrders(){
		$orders = Order::where('status','delivered')->orderBy('id','DESC')->get();
		return view('backend.orders.delivered-orders',compact('orders'));

	} // end mehtod


				// Cancel Orders
	public function CancelOrders(){
		$orders = Order::where('status','cancel')->orderBy('id','DESC')->get();
		return view('backend.orders.cancel-orders',compact('orders'));

	} // end mehtod

}
