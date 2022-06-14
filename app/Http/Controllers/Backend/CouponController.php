<?php

namespace App\Http\Controllers\Backend;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::orderBy('id','DESC')->get();
    	return view('backend.coupon.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
    		'coupon_code' => 'required',
    		'discount_value' => 'required',
    		'validity' => 'required',

    	]);



	Coupon::create([
		'coupon_code' => strtoupper($request->coupon_code),
		'discount_value' => $request->discount_value, 
		'validity' => $request->validity,
		'created_at' => Carbon::now(),

        ]);

		return redirect()->back()->with('success', 'Coupon Inserted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
    	return view('backend.coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
    		'coupon_code' => 'required',
    		'discount_value' => 'required',
    		'validity' => 'required',

    	]);

        
            $coupon->coupon_code = strtoupper($request->coupon_code);
            $coupon->discount_value = $request->discount_value; 
            $coupon->validity = $request->validity;
            $coupon->created_at = Carbon::now();
    
            $coupon->update();

            return redirect()->route('admin.coupon.index')->with('success', 'Coupon updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        if($coupon){
            $coupon->delete();

            return redirect()->route('admin.coupon.index')->with('message', 'coupon deleted successfully');
        }
    }
}
