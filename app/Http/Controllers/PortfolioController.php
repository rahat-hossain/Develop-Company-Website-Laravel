<?php

namespace App\Http\Controllers;
use Image;
use File;
use App\Portfolio;
use App\Http\Requests\PortfolioValidation;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function portfolio()
    {
        $portfolios = Portfolio::all();
        return view('portfolio.index', compact('portfolios'));
    }

    function portfolioinsert(PortfolioValidation $request)
    {
        $info = Portfolio::create($request->except('_token'));
        if($request->hasFile('portfolio_photo'))
        {
            $portfolio_photo = $request->file('portfolio_photo');
            $new_name = $info->id.".".$portfolio_photo->getClientOriginalExtension();
            $save_location = "public/uploads/portfolio_photos/".$new_name;
            Image::make($portfolio_photo)->resize(800, 600)->save(base_path($save_location));
            $info->portfolio_photo = $new_name;
            $info->save();
        }
        return back()->with('status', 'Portfolio insert successfully!!');
    }

    function portfolioedit($portfolio_id)
    {
       $portfolio_info =  Portfolio::findorFail($portfolio_id);
       return view('portfolio.edit' , compact('portfolio_info'));
    }

    function portfolioupdate(Request $request, $id)
    {
        if($request->hasFile('new_image'))
        {
            unlink(base_path('public/uploads/portfolio_photos/'. Portfolio::findOrFail($id)->portfolio_photo));
            $portfolio_photo = $request->file('new_image');
            $new_name = $id.".".$portfolio_photo->getClientOriginalExtension();
            $save_location = "public/uploads/portfolio_photos/".$new_name;
            Image::make($portfolio_photo)->resize(800, 600)->save(base_path($save_location));
            Portfolio::findOrFail($id)->update([
                'portfolio_photo' => $new_name,
            ]);
        }
        Portfolio::findOrFail($request->id)->update([
            'short_text' => $request->short_text,
            'title' => $request->title,
        ]);
        return redirect('portfolio')->withEditstatus('Portfolio Edited successfully!!');
    }

    function portfoliodelete($portfolio_id)
    {
        $portfolio = Portfolio::findorFail($portfolio_id);
        if (File::exists(public_path('uploads/portfolio_photos/'.$portfolio->portfolio_photo))) {

            unlink(public_path('uploads/portfolio_photos/'.$portfolio->portfolio_photo));
        }
        $portfolio->delete();

        // Slider::findOrFail($slider_id)->delete();
        return back()->with('deletestatus', 'Portfolio deleted successfully!!');
    }
}
