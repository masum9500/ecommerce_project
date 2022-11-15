<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Category;

class SubCategoryController extends Controller
{
    public function SubCategoryView()
    {
        $categories = Category::orderBy('category_name_eng', 'ASC')->get();
        $subcategories = SubCategory::latest()->get();
        return view('backend.category.subcategory_view', compact('subcategories', 'categories'));
    }



    public function SubCategoryStore(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_name_eng' => 'required',
            'subcategory_name_ban' => 'required',
        ],[
            'subcategory_name_eng.required' => 'Input Category Name in English',
            'subcategory_name_ban.required' => 'Input Category Name in Bangla',
        ]);
        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name_eng' => $request->subcategory_name_eng,
            'subcategory_slug_eng' => strtolower(str_replace(' ', '_', $request->subcategory_name_eng)),
            'subcategory_name_ban' => $request->subcategory_name_ban,
            'subcategory_slug_ban' => str_replace(' ', '_', $request->subcategory_name_ban),
            
        ]);
        $notification = array('message' => 'Sub Category Inserted Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }



    public function SubCategoryEdit($id)
    {
        $categories = Category::orderBy('category_name_eng', 'ASC')->get();
        $subcategories = SubCategory::findOrFail($id);
        return view('backend.category.subcategory_edit', compact('subcategories', 'categories'));
    }

    


    public function SubCategoryUpdate(Request $request)
    {
        $sub_id = $request->sub_cat_id;
        SubCategory::findOrFail($sub_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name_eng' => $request->subcategory_name_eng,
            'subcategory_slug_eng' => strtolower(str_replace(' ', '_', $request->subcategory_name_eng)),
            'subcategory_name_ban' => $request->subcategory_name_ban,
            'subcategory_slug_ban' => str_replace(' ', '_', $request->subcategory_name_ban),
            
        ]);

        $notification = array('message' => 'SubCategory Updated Successfully', 'alert-type' => 'info');
        return redirect()->route('all.subcategory')->with($notification);
    }



    public function SubCategoryDelete($id)
    {
        SubCategory::findOrFail($id)->delete();
        $notification = array('message' => 'SubCategory Deleted Successfully', 'alert-type' => 'info');
            return redirect()->route('all.subcategory')->with($notification);
    }




    public function SubSubCategoryView()
    {
        $categories = Category::orderBy('category_name_eng', 'ASC')->get();
        $subsubcategories = SubSubCategory::latest()->get();
        return view('backend.category.sub_subcategory_view', compact('subsubcategories', 'categories'));
    }






    public function GetSubCategory($category_id){

        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name_eng','ASC')->get();
        return json_encode($subcat);
     }

     public function GetSubSubCategory($subcategory_id){

        $subsubcat = SubSubCategory::where('subcategory_id',$subcategory_id)->orderBy('sub_subcategory_name_eng','ASC')->get();
        return json_encode($subsubcat);
     }



    public function SubSubCategoryStore(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'sub_subcategory_name_eng' => 'required',
            'sub_subcategory_name_ban' => 'required',
        ],[
            'sub_subcategory_name_eng.required' => 'Input Sub-SubCategory Name in English',
            'sub_subcategory_name_ban.required' => 'Input Category Name in Bangla',
        ]);
        SubSubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'sub_subcategory_name_eng' => $request->sub_subcategory_name_eng,
            'sub_subcategory_slug_eng' => strtolower(str_replace(' ', '_', $request->sub_subcategory_name_eng)),
            'sub_subcategory_name_ban' => $request->sub_subcategory_name_ban,
            'sub_subcategory_slug_ban' => str_replace(' ', '_', $request->sub_subcategory_name_ban),
            
        ]);
        $notification = array('message' => 'Sub-SubCategory Inserted Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }



    public function SubSubCategoryEdit($id)
    {
        $categories = Category::orderBy('category_name_eng', 'ASC')->get();
        $subcategories = SubCategory::orderBy('subcategory_name_eng', 'ASC')->get();
        $subsubcategories = SubSubCategory::findOrFail($id);
        return view('backend.category.sub_subcategory_edit', compact('categories', 'subcategories', 'subsubcategories'));
    }



    public function SubSubCategoryUpdate(Request $request)
    {
        $sub_sub_id = $request->id;


        SubSubCategory::findOrFail($sub_sub_id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'sub_subcategory_name_eng' => $request->sub_subcategory_name_eng,
            'sub_subcategory_slug_eng' => strtolower(str_replace(' ', '_', $request->sub_subcategory_name_eng)),
            'sub_subcategory_name_ban' => $request->sub_subcategory_name_ban,
            'sub_subcategory_slug_ban' => str_replace(' ', '_', $request->sub_subcategory_name_ban),
            
        ]);
        $notification = array('message' => 'Sub-SubCategory Updated Successfully', 'alert-type' => 'success');
        return redirect()->route('all.subsubcategory')->with($notification);
    }



    public function SubSubCategoryDelete($id)
    {
        SubSubCategory::findOrFail($id)->delete();
        $notification = array('message' => 'SubSubCategory Deleted Successfully', 'alert-type' => 'info');
        return redirect()->route('all.subsubcategory')->with($notification);
    }
}
