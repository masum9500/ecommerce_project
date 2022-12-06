<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\MultiImg;
use App\Models\Slider;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 1)->orderBy('id', 'DESC')->limit(6)->get();
        $featured = Product::where('featured', 1)->orderBy('id', 'DESC')->limit(6)->get();
        $hotDeails = Product::where('hot_deals', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $sliders = Slider::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $categories = Category::orderBy('category_name_eng', 'ASC')->get();
        return view('frontend.index', compact('categories', 'sliders', 'products', 'featured', 'hotDeails'));
    }

    public function UserLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function UserProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_profile', compact('user'));
    }

    public function UserProfileStore(Request $request)
    {
        $UserData = User::find(Auth::user()->id);
        $UserData->name = $request->name;
        $UserData->email = $request->email;
        $UserData->phone = $request->phone;

        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/user_images/' .$UserData->profile_photo_path));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $UserData['profile_photo_path'] = $filename;
        }
        $UserData->save();
        $notification = array('message' => 'User Profile Updated Successfully', 'alert-type' => 'success');
        return redirect()->route('dashboard')->with($notification);
    }


    public function UserChangePassword()
    {
        return view('frontend.profile.change_password');
    }


    public function UserPasswordUpdate(Request $request)
    {
        $validationData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed'
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('user.logout');
        }else{
            return redirect()->back();
        }

    }




    public function ProductDetails($id,$slug)
    {
        $multiImgs = MultiImg::where('product_id', $id)->get();
        $product = Product::findOrFail($id);
        return view('frontend.product.product_details',compact('product', 'multiImgs'));
    }
}
