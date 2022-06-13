<?php

namespace App\Http\Controllers\User;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wishlists = Wishlist::with('product')->where('user_id', Auth::id())->latest()->get();
        return view('frontend.wishlist.index', compact('wishlists'));
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
    public function destroy(Wishlist $wishlist)
    {
        
        if($wishlist){
            $wishlist->delete();

            return redirect()->route('user.wishlist.index')->with('message', 'wishlist deleted successfully');
        }else{
            return ("Hi");
        }
    }

    // add to wishlist mehtod 

			public function AddToWishlist(Request $request, $id){
                
				if (Auth::check()) {

					$exists = Wishlist::where('user_id',Auth::id())->where('product_id',$id)->first();
                    
                    if(!$exists){
                        Wishlist::create([
                            'user_id' => Auth::id(), 
                            'product_id' => $id, 
                            'created_at' => Carbon::now(), 
                        ]);
                       return response()->json(['success' => 'Successfully Added On Your Wishlist']);
                    }else{
                        return response()->json(['error' => 'this product has already in your wishlist']);
                    }
					
		
				}else{
                    // return redirect()->route('user.login')->with('error','At first login your account');
		
					return response()->json(['error' => 'At First Login Your Account']);
		
				}
			}

    
}
