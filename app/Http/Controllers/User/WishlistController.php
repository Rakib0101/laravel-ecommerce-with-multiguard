<?php

namespace App\Http\Controllers\User;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // add to wishlist mehtod 

			public function AddToWishlist(Request $request, $product_id){
                dd($request);
				if (Auth::check()) {

					$exists = Wishlist::where('user_id',Auth::id())->where('product_id',$product_id)->first();
		
					Wishlist::create([
						'user_id' => Auth::id(), 
						'product_id' => $product_id, 
						'created_at' => Carbon::now(), 
					]);
				   return response()->json(['success' => 'Successfully Added On Your Wishlist']);
		
				}else{
		
					return response()->json(['error' => 'At First Login Your Account']);
		
				}
			}
}
