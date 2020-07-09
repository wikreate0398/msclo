<?php

namespace App\Http\Controllers;
 
use App\Models\Advantage;
use App\Models\Banner;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{ 
    public function index()
    {
        $sliders    = Slider::getAll();
        $banners    = Banner::getAll();
        $advantages = Advantage::getAll();

        return view('public/home', compact('sliders', 'banners', 'advantages'));
    } 

    public function page()
    { 
        $data = \Pages::pageData();
        if (!$data) 
        {
            abort('404');
        }
        return view('public/page', [
            'data'   => $data,
        ]);
    }
}