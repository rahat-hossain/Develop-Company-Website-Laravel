<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderValidation;
use Image;
use App\Slider;
use File;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function slider()
    {
        $sliders = Slider::all();
        return view('slider.index', compact('sliders'));
    }

    function sliderinsert(SliderValidation $request)
    {
        $info = Slider::create($request->except('_token'));
        if($request->hasFile('slider_photo'))
        {
            $slider_photo = $request->file('slider_photo');
            $new_name = $info->id.".".$slider_photo->getClientOriginalExtension();
            $save_location = "public/uploads/slider_photos/".$new_name;
            Image::make($slider_photo)->resize(1920, 900)->save(base_path($save_location));
            $info->slider_photo = $new_name;
            $info->save();
        }
        return back()->with('status', 'Slider insert successfully!!');
    }

    function slideredit($slider_id)
    {
        $slider_info = Slider::findOrFail($slider_id);
        return view('slider.edit' , compact('slider_info'));
    }

    function sliderupdate(Request $request, $id)
    {
        if($request->hasFile('new_image'))
        {
            unlink(base_path('public/uploads/slider_photos/'. Slider::findOrFail($id)->slider_photo));
            $slider_photo = $request->file('new_image');
            $new_name = $id.".".$slider_photo->getClientOriginalExtension();
            $save_location = "public/uploads/slider_photos/".$new_name;
            Image::make($slider_photo)->resize(1920, 900)->save(base_path($save_location));
            Slider::findOrFail($id)->update([
                'slider_photo' => $new_name,
            ]);
        }
        return redirect('slider')->withEditstatus('Slider Edited successfully!!');
    }

    function sliderdelete($slider_id)
    {
        $slider = Slider::findorFail($slider_id);
        if (File::exists(public_path('uploads/slider_photos/'.$slider->slider_photo))) {

            unlink(public_path('uploads/slider_photos/'.$slider->slider_photo));
        }
        $slider->delete();

        // Slider::findOrFail($slider_id)->delete();
        return back()->with('deletestatus', 'Slider deleted successfully!!');
    }
}
