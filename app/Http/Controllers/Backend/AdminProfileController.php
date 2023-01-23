<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminProfileController extends Controller
{
    public function AdminProfile()
    {
        $data = Admin::find(1);
        return view('admin.admin_profile_view', compact('data'));
    }


    public function AdminProfileEdit()
    {
        $Admindata = Admin::find(1);
        return view('admin.admin_profile_edit', compact('Admindata'));
    }



    public function AdminProfileStor(Request $request)
    {
        $dataAdmin = Admin::find(1);
        $dataAdmin->name = $request->name;
        $dataAdmin->email = $request->email;

        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/admin_images/' .$dataAdmin->profile_photo_path));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $dataAdmin['profile_photo_path'] = $filename;
        }
        $dataAdmin->save();
        $notification = array('message' => 'Admin Profile Updated Successfully', 'alert-type' => 'success');
        return redirect()->route('admin.profile')->with($notification);
    }


    public function AdminPasswordChange()
    {
        return view('admin.admin_change_password');
    }


    public function AdminPasswordUpdate(Request $request)
    {
        $validationData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed'
        ]);

        $hashedPassword = Admin::find(1)->password;
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $admin = Admin::find(1);
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();
            return redirect()->route('admin.logout');
        }else{
            return redirect()->back();
        }

    }


    public function AllUsers()
    {
        $users = User::latest()->get();
        return view('backend.user.all_user',compact('users'));
    }
}
