<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function profile_edit()
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);
        return view('dashboard.user.edit', compact('user'));
    }
    public function profileUpdate(Request $request)
    {
        return "Hi";
        $userId = Auth::user()->id;
        $user = User::find($userId);
        
        $user->name = $request->name;
        $user->email = $request->email;
        dd($request);
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
        $admin = Admin::find(1);
        return view('dashboard.admin.password', compact('admin'));
    }

    public function password_update(Request $request)
    {
        $validateData = $request->validate([
                'oldpassword'=>'required',
                'password'=>'required',
                'cpassword'=>'required|same:password'
          ]);

        $hashPassword = Admin::find(1)->password;

        if(Hash::check($request->oldpassword, $hashPassword)){
            $admin = Admin::find(1);
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();
            return redirect()->route('admin.login')->with('message', 'password update successfully, please login now !');
        }else{
            return redirect()->back();
        }
    }
}
