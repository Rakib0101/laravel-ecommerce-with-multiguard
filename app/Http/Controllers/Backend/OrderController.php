<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    // All Orders
    public function All(){
		$orders = Order::orderBy('id','DESC')->get();
		return view('backend.orders.index',compact('orders'));

	} // end mehtod

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
		$orders = Order::where('status','confirm')->orderBy('id','DESC')->get();
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


    public function PendingToConfirm($order_id)
    {
        Order::findOrFail($order_id)->update(['status' => 'confirm']);

        $notification = array(
              'message' => 'Order Confirm Successfully',
              'alert-type' => 'success'
          );

          return redirect()->route('admin.order.confirmed')->with($notification);


      } // end method

      public function ConfirmToProcessing($order_id){

        Order::findOrFail($order_id)->update(['status' => 'processing']);

        $notification = array(
              'message' => 'Order Processing Successfully',
              'alert-type' => 'success'
          );

          return redirect()->route('admin.order.processing')->with($notification);


      } // end method



          public function ProcessingToPicked($order_id){

        Order::findOrFail($order_id)->update(['status' => 'picked']);

        $notification = array(
              'message' => 'Order Picked Successfully',
              'alert-type' => 'success'
          );

          return redirect()->route('admin.order.picked')->with($notification);


      } // end method


       public function PickedToShipped($order_id){

        Order::findOrFail($order_id)->update(['status' => 'shipped']);

        $notification = array(
              'message' => 'Order Shipped Successfully',
              'alert-type' => 'success'
          );

          return redirect()->route('admin.order.shipped')->with($notification);


      } // end method


       public function ShippedToDelivered($order_id){

        Order::findOrFail($order_id)->update(['status' => 'delivered']);

        $notification = array(
              'message' => 'Order Delivered Successfully',
              'alert-type' => 'success'
          );

          return redirect()->route('admin.order.delivered')->with($notification);


      } // end method

}
