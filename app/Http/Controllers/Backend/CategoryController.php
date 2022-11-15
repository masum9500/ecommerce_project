<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Image;

class CategoryController extends Controller
{
    public function CategoryView()
    {
        $categories = Category::latest()->get();
        return view('backend.category.category_view', compact('categories'));
    }



    public function CategoryStore(Request $request)
    {
        $request->validate([
            'category_name_eng' => 'required',
            'category_name_ban' => 'required',
            'category_icon' => 'required',
        ],[

            'category_name_eng.required' => 'Input Category Name in English',
            'category_name_ban.required' => 'Input Category Name in Bangla',
        ]);
        Category::insert([
            'category_name_eng' => $request->category_name_eng,
            'category_slug_eng' => strtolower(str_replace(' ', '_', $request->category_name_eng)),
            'category_name_ban' => $request->category_name_ban,
            'category_slug_ban' => str_replace(' ', '_', $request->category_name_ban),
            'category_icon' => $request->category_icon,
        ]);

        $notification = array('message' => 'Category Inserted Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }




    public function CategoryEdit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }




    public function CategoryUpdate(Request $request)
    {
        $cat_id = $request->id;

        Category::findOrFail($cat_id)->update([
            'category_name_eng' => $request->category_name_eng,
            'category_slug_eng' => strtolower(str_replace(' ', '_', $request->category_name_eng)),
            'category_name_ban' => $request->category_name_ban,
            'category_slug_ban' => str_replace(' ', '_', $request->category_name_ban),
            'category_icon' => $request->category_icon,
        ]);

        $notification = array('message' => 'Category Updated Successfully', 'alert-type' => 'info');
        return redirect()->route('all.category')->with($notification);
    }




    public function CategoryDelete($id)
    {
        Category::findOrFail($id)->delete();


        $notification = array('message' => 'Category Deleted Successfully', 'alert-type' => 'info');
            return redirect()->route('all.category')->with($notification);
    }
       
}
