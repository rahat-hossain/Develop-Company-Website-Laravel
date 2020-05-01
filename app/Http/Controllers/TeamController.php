<?php

namespace App\Http\Controllers;
use Image;
use File;
use App\Team;
use App\Http\Requests\TeamValidation;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function team()
    {
        $teams = Team::all();
        return view('team.index', compact('teams'));
    }

    function teaminsert(TeamValidation $request)
    {
        $info = Team::create($request->except('_token'));
        if($request->hasFile('tm_photo'))
        {
            $team_photo = $request->file('tm_photo');
            $new_name = $info->id.".".$team_photo->getClientOriginalExtension();
            $save_location = "public/uploads/team_photos/".$new_name;
            Image::make($team_photo)->resize(400, 400)->save(base_path($save_location));
            $info->tm_photo = $new_name;
            $info->save();
        }
        return back()->with('status', 'Team insert successfully!!');
    }

    function teamedit($team_id)
    {
       $team_info =  Team::findorFail($team_id);
       return view('team.edit' , compact('team_info'));
    }

    function teamupdate(Request $request, $id)
    {
        if($request->hasFile('new_image'))
        {
            unlink(base_path('public/uploads/team_photos/'.Team::findOrFail($id)->tm_photo));
            $team_photo = $request->file('new_image');
            $new_name = $id.".".$team_photo->getClientOriginalExtension();
            $save_location = "public/uploads/team_photos/".$new_name;
            Image::make($team_photo)->resize(400, 400)->save(base_path($save_location));
            $imge = $new_name;
        }else{
            $imge = Team::findOrFail($id)->tm_photo;
        }
        Team::findOrFail($request->id)->update([
            'name' => $request->name,
            'designation' => $request->designation,
            'fb' => $request->fb,
            'google' => $request->google,
            'linkedin' => $request->linkedin,
            'tm_photo' => $imge,
        ]);
        return redirect('team')->withEditstatus('Team Edited successfully!!');
    }

    function teamdelete($team_id)
    {
        $team = Team::findorFail($team_id);
        if (File::exists(public_path('uploads/team_photos/'.$team->tm_photo))) {

            unlink(public_path('uploads/team_photos/'.$team->tm_photo));
        }
        $team->delete();

        // Slider::findOrFail($slider_id)->delete();
        return back()->with('deletestatus', 'Team deleted successfully!!');
    }
}
