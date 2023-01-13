<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileImageRequest;
use App\Http\Requests\ProfilePasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;

class UserController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }
    //Users List
    function users() {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('admin.user.user_list', [
            'users' => $users
        ]);
    }

    // User delete
    function user_delete($user_id) {
        User::find($user_id)->delete();
        return back();
    }

    // Profile
    function profile() {
        return view('admin.user.profile');
    }

    // Profile Name Update
    function profile_name_update(ProfileRequest $request) {
        User::find(Auth::id())->update([
            'name'=> $request->name,
        ]);
        return back()->with('success', 'Name Updated');
    }

    // Profile Password Update
    function profile_password_update(ProfilePasswordRequest $request) {
        if(Hash::check($request->old_password, Auth::user()->password)) {
            if($request->password == $request->password_confirmation) {
                User::find(Auth::id())->update([
                    'password' => bcrypt($request->password)
                ]);
                return back()->with('success_pass', "Password Updated");
            } else {
                return back()->with('wrong_password', 'New password and Confirm password do not matched!');
            }
        } else {
            return back()->with('wrong_password', 'Old password not matched!');
        }
    }

    // Profile Image Update
    function profile_image_update(Request $request) {
        $upload_file = $request->image;
        
        if(Auth::user()->image == null) {
            $extension = $upload_file->getClientOriginalExtension();
            $file_name = Auth::id().'.'.$extension;
            Image::make($upload_file)->resize(300, 200)->save(public_path('uploads/users/'.$file_name));

            User::find(Auth::id())->update([
                'image' => $file_name,
            ]);
            return back();
        } 
        else {
            $delete_from = public_path('uploads/users/'.Auth::user()->image);
            unlink($delete_from);
            $extension = $upload_file->getClientOriginalExtension();
            $file_name = Auth::id().'.'.$extension;
            Image::make($upload_file)->resize(300, 200)->save(public_path('uploads/users/'.$file_name));
            User::find(Auth::id())->update([
                'image' => $file_name,
            ]);
            return back()->with('image_update_success', 'Image Updated');
        }
    }


}
