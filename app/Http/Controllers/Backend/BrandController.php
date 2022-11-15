<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Image;

class BrandController extends Controller
{
    public function BrandView()
    {
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_view', compact('brands'));
    }

    public function BrandStore(Request $request)
    {
        $request->validate([
            'brand_name_en' => 'required',
            'brand_name_ban' => 'required',
            'brand_image' => 'required',
        ],[

            'brand_name_en.required' => 'Input Brand Name in English',
            'brand_name_ban.required' => 'Input Brand Name in Bangla',
        ]);


        $image = $request->file('brand_image');
        $name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/brand/'.$name);
        $save_url = 'upload/brand/'.$name;

        Brand::insert([
            'brand_name_en' => $request->brand_name_en,
            'brand_slug_en' => strtolower(str_replace(' ', '_', $request->brand_name_en)),
            'brand_name_ban' => $request->brand_name_ban,
            'brand_slug_bn' => str_replace(' ', '_', $request->brand_name_ban),
            'brand_image' => $save_url,
        ]);

        $notification = array('message' => 'Brand Inserted Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);

    }





    public function BrandEdit($id)
    {

        $brand = Brand::findOrFail($id);
        return view('backend.brand.brand_edit', compact('brand'));
    }


    public function BrandUpdate(Request $request)
    {
        $brand_id = $request->id;
        $old_image = $request->old_image;


        if ($request->file('brand_image')) {
            unlink($old_image);
            $image = $request->file('brand_image');
            $name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('upload/brand/'.$name);
            $save_url = 'upload/brand/'.$name;

            Brand::findOrFail($brand_id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_slug_en' => strtolower(str_replace(' ', '_', $request->brand_name_en)),
                'brand_name_ban' => $request->brand_name_ban,
                'brand_slug_bn' => str_replace(' ', '_', $request->brand_name_ban),
                'brand_image' => $save_url,
            ]);

            $notification = array('message' => 'Brand Updated Successfully', 'alert-type' => 'info');
            return redirect()->route('all.brand')->with($notification);
        }else{
            Brand::findOrFail($brand_id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_slug_en' => strtolower(str_replace(' ', '_', $request->brand_name_en)),
                'brand_name_ban' => $request->brand_name_ban,
                'brand_slug_bn' => str_replace(' ', '_', $request->brand_name_ban),
            ]);

            $notification = array('message' => 'Brand Updated Successfully', 'alert-type' => 'info');
            return redirect()->route('all.brand')->with($notification);
        }

    }




    public function BrandDelete($id)
    {
        $brand = Brand::findOrFail($id);
        $img = $brand->brand_image;

        unlink($img);
        Brand::findOrFail($id)->delete();


        $notification = array('message' => 'Brand Deleted Successfully', 'alert-type' => 'info');
            return redirect()->route('all.brand')->with($notification);
    }
}
