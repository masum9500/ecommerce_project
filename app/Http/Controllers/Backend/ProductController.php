<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Brand;
use App\Models\Product;
use App\Models\MultiImg;
use Carbon\Carbon;
use Image;

class ProductController extends Controller
{
    public function AddProduct()
    {
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        return view('backend.product.product_add', compact('brands', 'categories'));
    }




    public function StoreProduct(Request $request)
    {

        $image = $request->file('product_thambnail');
        $name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(917,1000)->save('upload/products/thambnail/'.$name);
        $save_url = 'upload/products/thambnail/'.$name;

    
        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_ban' => $request->product_name_ban,
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_slug_ban' => str_replace(' ', '-', $request->product_name_ban),


            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_ban' => $request->product_tags_ban,
            'product_size_en' => $request->product_size_en,
            'product_size_ban' => $request->product_size_ban,
            'product_color_en' => $request->product_color_en,
            'product_color_ban' => $request->product_color_ban,



            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_ban' => $request->short_descp_ban,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_ban' => $request->long_descp_ban,


            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,


            'product_thambnail' => $save_url,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);




        $image = $request->file('multi_img');

        foreach($image as $images){

            $imgName = hexdec(uniqid()).'.'.$images->getClientOriginalExtension();
            Image::make($images)->resize(917,1000)->save('upload/products/multi-image/'.$imgName);
            $save_photo_url = 'upload/products/multi-image/'.$imgName;

            MultiImg::insert([
                'product_id' => $product_id,
                'photo_name' => $save_photo_url,
                'created_at' => Carbon::now()
            ]);
        }





        $notification = array('message' => 'Product Inserted Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);

    }




    public function ManageProduct()
    {
        $products = Product::latest()->get();
        return view('backend.product.product_view', compact('products'));
    }


    public function EditProduct($id)
    {

        $multiImgs = MultiImg::where('product_id', $id)->get();

        $subcategories = SubCategory::latest()->get();
        $subsubcategories = SubSubCategory::latest()->get();
        $product = Product::findOrFail($id);
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        return view('backend.product.product_edit', compact('product', 'brands', 'categories','subcategories','subsubcategories','multiImgs'));
    }



    public function UpdateProduct(Request $request)
    {
        $product_id = $request->id;
        Product::findOrFail($product_id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_ban' => $request->product_name_ban,
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_slug_ban' => str_replace(' ', '-', $request->product_name_ban),


            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_ban' => $request->product_tags_ban,
            'product_size_en' => $request->product_size_en,
            'product_size_ban' => $request->product_size_ban,
            'product_color_en' => $request->product_color_en,
            'product_color_ban' => $request->product_color_ban,



            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_ban' => $request->short_descp_ban,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_ban' => $request->long_descp_ban,


            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'created_at' => Carbon::now(),
            'status' => 1,
        ]);

         $notification = array('message' => 'Product Updated Successfully Without Images', 'alert-type' => 'success');
        return redirect()->route('manage-product')->with($notification);


    }




    public function UpdateProductImage(Request $request)
    {
        $imgs = $request->multi_img;

        foreach($imgs as $id => $img){
            $imgDel = MultiImg::findOrFail($id);
            unlink($imgDel->photo_name);

            $imgName = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(917,1000)->save('upload/products/multi-image/'.$imgName);
            $save_photo_url = 'upload/products/multi-image/'.$imgName;


            MultiImg::where('id', $id)->update([
                'photo_name' => $save_photo_url,
                'updated_at' => Carbon::now(),
            ]);
        }
        $notification = array('message' => 'Product Images Updated Successfully', 'alert-type' => 'info');
        return redirect()->back()->with($notification);
    }




    public function UpdateProductThambnail(Request $request)
    {
        $pro_id = $request->id;
        $oldImg = $request->old_img;
        unlink($oldImg);


        $image = $request->file('product_thambnail');
        $name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(917,1000)->save('upload/products/thambnail/'.$name);
        $save_url = 'upload/products/thambnail/'.$name;

        Product::findOrFail($pro_id)->update([
                'product_thambnail' => $save_url,
                'updated_at' => Carbon::now(),
            ]);


        $notification = array('message' => 'Product Thambnail Updated Successfully', 'alert-type' => 'info');
        return redirect()->back()->with($notification);
    }



    public function MultipleImgDelete($id)
    {
        $oldImg = MultiImg::findOrFail($id);
        unlink($oldImg->photo_name);
        MultiImg::findOrFail($id)->delete();

        $notification = array('message' => 'Product Image Deleted Successfully', 'alert-type' => 'info');
        return redirect()->back()->with($notification);
    }



    public function ProductActive($id)
    {
        Product::findOrFail($id)->update([ 'status' => 1 ]);
        $notification = array('message' => 'Product Active', 'alert-type' => 'info');
        return redirect()->back()->with($notification);
    }


    public function ProductInactive($id)
    {
        Product::findOrFail($id)->update([ 'status' => 0 ]);
        $notification = array('message' => 'Product Inactive', 'alert-type' => 'info');
        return redirect()->back()->with($notification);
    }



    public function ProductDelete($id)
    {
        $product = Product::findOrFail($id);
        unlink($product->product_thambnail);
        Product::findOrFail($id)->delete();


        $images = MultiImg::where('product_id', $id)->get();
        foreach($images as $img){
            unlink($img->photo_name);
            MultiImg::where('product_id', $id)->delete();
        }


        $notification = array('message' => 'Product Deleted Successfully', 'alert-type' => 'info');
        return redirect()->back()->with($notification);
    }
}
