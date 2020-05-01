<?php

namespace App\Http\Controllers;
use Image;
use File;
use App\About;
use App\Http\Requests\AboutValidation;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function about()
    {
        $abouts = About::all();
        return view('about.index', compact('abouts'));
    }

    function aboutinsert(AboutValidation $request)
    {
        $info = About::create($request->except('_token'));
        if($request->hasFile('about_photo'))
        {
            $about_photo = $request->file('about_photo');
            $new_name = $info->id.".".$about_photo->getClientOriginalExtension();
            $save_location = "public/uploads/about_photos/".$new_name;
            Image::make($about_photo)->resize(690, 438)->save(base_path($save_location));
            $info->about_photo = $new_name;
            $info->save();
        }
        return back()->with('status', 'About insert successfully!!');
    }

    function aboutedit($about_id)
    {
       $testimonial_info =  About::findorFail($about_id);
       return view('about.edit' , compact('testimonial_info'));
    }

    function aboutupdate(Request $request, $id)
    {
        if($request->hasFile('new_image'))
        {
            unlink(base_path('public/uploads/about_photos/'. About::findOrFail($id)->about_photo));
            $about_photo = $request->file('new_image');
            $new_name = $id.".".$about_photo->getClientOriginalExtension();
            $save_location = "public/uploads/about_photos/".$new_name;
            Image::make($about_photo)->resize(690, 438)->save(base_path($save_location));
            About::findOrFail($id)->update([
                'about_photo' => $new_name,
            ]);
        }
        About::findOrFail($request->id)->update([
            'heading' => $request->heading,
            'sub_title' => $request->sub_title,
            'description' => $request->description,
        ]);
        return redirect('about')->withEditstatus('About Edited successfully!!');
    }

    function aboutdelete($about_id)
    {
        $about = About::findorFail($about_id);
        if (File::exists(public_path('uploads/about_photos/'.$about->about_photo))) {

            unlink(public_path('uploads/about_photos/'.$about->about_photo));
        }
        $about->delete();

        // Slider::findOrFail($slider_id)->delete();
        return back()->with('deletestatus', 'About deleted successfully!!');
    }
}
