<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Carbon\Carbon;
use Image;

class SliderController extends Controller
{
    public function SliderView()
    {
        $sliders = Slider::latest()->get();
        return view('backend.slider.slider_view', compact('sliders'));
    }


    public function SliderStore(Request $request)
    {
        $request->validate([
            'slider_img' => 'required',
        ],[

            'slider_img.required' => 'Select Slider One Image',
        ]);


        $image = $request->file('slider_img');
        $name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(870,370)->save('upload/slider/'.$name);
        $save_url = 'upload/slider/'.$name;

        Slider::insert([
            'slider_img' => $save_url,
            'title' => $request->title,
            'description' => $request->description,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        $notification = array('message' => 'Slider Inserted Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }


    public function SliderEdit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('backend.slider.slider_edit', compact('slider'));
    }



    public function SliderUpdate(Request $request)
    {
        $slider_id = $request->id;
        $old_image = $request->old_image;


        if ($request->file('slider_img')) {
            unlink($old_image);
            $images = $request->file('slider_img');
            $name = hexdec(uniqid()).'.'.$images->getClientOriginalExtension();
            Image::make($images)->resize(870,370)->save('upload/slider/'.$name);
            $save_img = 'upload/slider/'.$name;

            Slider::findOrFail($slider_id)->update([
                'slider_img' => $save_img,
                'title' => $request->title,
                'description' => $request->description,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array('message' => 'Slider Updated Successfully', 'alert-type' => 'info');
            return redirect()->route('manage-slider')->with($notification);
        }else{
            Slider::findOrFail($slider_id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array('message' => 'Slider Updated Successfully', 'alert-type' => 'info');
            return redirect()->route('manage-slider')->with($notification);
        }
    }



    public function SliderDelete($id)
    {
        $sliders = Slider::findOrFail($id);
        $img = $sliders->slider_img;

        unlink($img);
        Slider::findOrFail($id)->delete();


        $notification = array('message' => 'Slider Deleted Successfully', 'alert-type' => 'info');
        return redirect()->route('manage-slider')->with($notification);
    }



    public function SliderActive($id)
    {
        Slider::findOrFail($id)->update([ 'status' => 1 ]);
        $notification = array('message' => 'Slider Active', 'alert-type' => 'info');
        return redirect()->back()->with($notification);
    }


    public function SliderInactive($id)
    {
        Slider::findOrFail($id)->update([ 'status' => 0 ]);
        $notification = array('message' => 'Slider Inactive', 'alert-type' => 'info');
        return redirect()->back()->with($notification);
    }
}
