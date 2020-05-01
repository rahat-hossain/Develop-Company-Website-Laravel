<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceValidation;
use Image;
use File;
use App\Service;
use Auth;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function service()
    {
        $services = Service::all();
        return view('service.index', compact('services'));
    }

    function serviceinsert(ServiceValidation $request)
    {
        $info = Service::create($request->except('_token'));
        if($request->hasFile('services_photo'))
        {
            $services_photo = $request->file('services_photo');
            $new_name = $info->id.".".$services_photo->getClientOriginalExtension();
            $save_location = "public/uploads/service_photos/".$new_name;
            Image::make($services_photo)->resize(100, 60)->save(base_path($save_location));
            $info->services_photo = $new_name;
            $info->save();
        }
        return back()->with('status', 'Service insert successfully!!');
    }

    function serviceedit($service_id)
    {
        $service_info =  Service::findorFail($service_id);
       return view('service.edit' , compact('service_info'));
    }

    function serviceupdate(Request $request, $id)
    {
        if($request->hasFile('new_image'))
        {
            unlink(base_path('public/uploads/service_photos/'. Service::findOrFail($id)->services_photo));
            $service_photo = $request->file('new_image');
            $new_name = $id.".".$service_photo->getClientOriginalExtension();
            $save_location = "public/uploads/service_photos/".$new_name;
            Image::make($service_photo)->resize(100, 60)->save(base_path($save_location));
            Service::findOrFail($id)->update([
                'services_photo' => $new_name,
            ]);
        }
        Service::findOrFail($request->id)->update([
            'title' => $request->title,
            'short_description' => $request->short_description,
        ]);
        return redirect('service')->withEditstatus('Service Edited successfully!!');
    }

    function servicedelete($service_id)
    {
        $service = Service::findorFail($service_id);
        if (File::exists(public_path('uploads/service_photos/'.$service->services_photo))) {

            unlink(public_path('uploads/service_photos/'.$service->services_photo));
        }
        $service->delete();

        // Slider::findOrFail($slider_id)->delete();
        return back()->with('deletestatus', 'Service deleted successfully!!');
    }
}
