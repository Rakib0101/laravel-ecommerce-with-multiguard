<?php

namespace App\Http\Controllers\Backend;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function profile()
    {
        if(Auth::guard('admin')){
            $admin = Admin::find(1);
            return view('dashboard.admin.profile', compact('admin'));
        }else{
            return '/admin/login';
        }
        
    }
    public function profile_edit()
    {
        $admin = Admin::find(1);
        return view('dashboard.admin.edit', compact('admin'));
    }
    public function profile_update(Request $request)
    {
        $admin = Admin::find(1);
        
        $admin->name = $request->name;
        $admin->email = $request->email;
        
        // if($request->file('image')){
        //     $file = $request->file('image');
        //     $file_name = date().$file->getClientOriginalName();
        //     $file->move(public_path('uploads/admin/'), $file_name);
        // }

        if($request->hasFile('image')){

            $destination = 'uploads/admin/'.$admin->image;
            if(File::exists($destination)){
                File::delete($destination);
            }

            $file = $request->file('image');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/admin/', $file_name);
            $admin->image = $file_name;
        }

        $admin->save();
        return redirect()->route('admin.profile')->with('message', 'profile updated successfully');
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
