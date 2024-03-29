<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\MultiImg;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Blog\BlogPost;


use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index()
    {
        $blogpost = BlogPost::latest()->get();
        $products = Product::where('status', 1)->orderBy('id', 'DESC')->limit(6)->get();
        $featured = Product::where('featured', 1)->orderBy('id', 'DESC')->limit(6)->get();
        $hotDeails = Product::where('hot_deals', 1)->where('discount_price','!=',NULL)->orderBy('id', 'DESC')->limit(3)->get();
        $special_offer = Product::where('special_offer', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $special_deals = Product::where('special_deals', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $sliders = Slider::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $categories = Category::orderBy('category_name_eng', 'ASC')->get();


        $skip_category_0 = Category::skip(0)->first();
        $skip_product_0 = Product::where('status',1)->where('category_id',$skip_category_0->id)->orderBy('id','DESC')->get();


        $skip_category_1 = Category::skip(1)->first();
        $skip_product_1 = Product::where('status',1)->where('category_id',$skip_category_1->id)->orderBy('id','DESC')->get();

        $skip_brand_1 = Brand::skip(1)->first();
        $skip_brand_product_1 = Product::where('status',1)->where('brand_id',$skip_brand_1->id)->orderBy('id','DESC')->get();



        return view('frontend.index', compact('categories', 'sliders', 'products', 'featured', 'hotDeails', 'special_offer', 'special_deals', 'skip_category_0', 'skip_product_0','skip_category_1','skip_product_1','skip_brand_1','skip_brand_product_1', 'blogpost'));

        
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

        $color_en = $product->product_color_en;
        $product_color_en = explode(',', $color_en);

        $color_ban = $product->product_color_ban;
        $product_color_ban = explode(',', $color_ban);

        $size_en = $product->product_size_en;
        $product_size_en = explode(',', $size_en);

        $size_ban = $product->product_size_ban;
        $product_size_ban = explode(',', $size_ban);

        $cat_id = $product->category_id;
        $relatedProduct = Product::where('category_id',$cat_id)->where('id','!=',$id)->orderBy('id','DESC')->get();

        return view('frontend.product.product_details',compact('product', 'multiImgs','product_color_en', 'product_color_ban', 'product_size_en', 'product_size_ban', 'relatedProduct'));
    }



    public function TagwiseProduct($tag)
    {
        
        $products = Product::where('status',1)->where('product_tags_en',$tag)->orwhere('product_tags_ban',$tag)->orderBy('id','DESC')->paginate(3);
        return view('frontend.tags.tags_view',compact('products'));
    }


    public function SubcatProduct($subcat_id, $slug)
    {
         $products = Product::where('status',1)->where('subcategory_id',$subcat_id)->orderBy('id','DESC')->paginate(3);
         $breadsubcat = SubCategory::with(['category'])->where('id',$subcat_id)->get();
        return view('frontend.product.subcat_view',compact('products','breadsubcat'));
    }


    public function SubSubcatProduct($subsubcat_id, $slug)
    {
        $products = Product::where('status',1)->where('subsubcategory_id',$subsubcat_id)->orderBy('id','DESC')->paginate(3);
        $breadsubsubcat = SubSubCategory::with(['category','subcategory'])->where('id',$subsubcat_id)->get();
        return view('frontend.product.subsubcat_view',compact('products', 'breadsubsubcat'));
    }



    public function ProductViewAjax($id)
    {
        $product = Product::with('category','brand')->findOrFail($id);

        $color = $product->product_color_en;
        $product_color = explode(',', $color);

        $size = $product->product_size_en;
        $product_size = explode(',', $size);

        return response()->json(array(
            'product' => $product,
            'color' => $product_color,
            'size' => $product_size,

        ));
    }



    public function ProductSearch(Request $request)
    {
        $item = $request->search;
        $request->validate(["search" => "required"]);
        // echo "$item";
        $categories = Category::orderBy('category_name_eng','ASC')->get();
        $products = Product::where('product_name_en','LIKE',"%$item%")->get();
        return view('frontend.product.search',compact('products','categories'));
    }

    public function SearchProduct(Request $request)
    {
        $request->validate(["search" => "required"]);

        $item = $request->search;        

        $products = Product::where('product_name_en','LIKE',"%$item%")->select('product_name_en','product_thambnail','selling_price','id','product_slug_en')->limit(5)->get();
        return view('frontend.product.search_product',compact('products'));

    }
}
