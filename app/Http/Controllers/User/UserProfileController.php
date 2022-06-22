<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function home()
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);
        return view('dashboard.user.home', compact('user'));
    }
    public function profile_edit()
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);
        return view('dashboard.user.edit', compact('user'));
    }
    public function profileUpdate(Request $request)
    {
        // return "Hi";
        $userId = Auth::user()->id;
        $user = User::find($userId);

        $user->name = $request->name;
        $user->email = $request->email;
        // dd($request);
        // if($request->file('image')){
        //     $file = $request->file('image');
        //     $file_name = date().$file->getClientOriginalName();
        //     $file->move(public_path('uploads/admin/'), $file_name);
        // }

        if($request->hasFile('image')){

            $destination = 'uploads/user/'.$user->image;
            if(File::exists($destination)){
                File::delete($destination);
            }

            $file = $request->file('image');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/user/', $file_name);
            $user->image = $file_name;
        }

        $user->save();
        return redirect()->route('user.home')->with('message', 'profile updated successfully');
    }

    public function password_edit()
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);
        return view('dashboard.user.password', compact('user'));
    }

    public function password_update(Request $request)
    {
        $user->oldpassword = Hash::make($request->password);
        $validateData = $request->validate([
                'oldpassword'=>'required',
                'password'=>'required|min:6',
                'cpassword'=>'required|same:password'
          ],[
              'cpassword.same' => 'password and confrim password does not match',
          ]);

        $userId = Auth::user()->id;
        $user = User::find($userId);

        $hashPassword = $user->password;

        if(Hash::check($request->oldpassword, $hashPassword)){

            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('user.login')->with('message', 'password update successfully, please login now !');
        }else{
            return redirect()->back();
        }
    }

    public function MyOrders()
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);
        $orders = Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();
        return view('dashboard.user.order', compact(['orders', 'user']));
    }

    public function SingleOrder($id)
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);
        $order = Order::where('id',$id)->where('user_id',Auth::id())->first();
    	$orderItem = OrderItem::with('product')->where('order_id',$id)->orderBy('id','DESC')->get();
    	return view('dashboard.user.order-details',compact(['order','orderItem', 'user']));
    }
}
