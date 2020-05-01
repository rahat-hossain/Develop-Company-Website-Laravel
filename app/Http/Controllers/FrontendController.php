<?php

namespace App\Http\Controllers;

use App\About;
use App\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function index()
    {
        $abouts = About::all();
        $sliders = Slider::all();
        return view('welcome', compact('sliders', 'abouts'));
    }
}
