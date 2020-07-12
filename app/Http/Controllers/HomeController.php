<?php

namespace App\Http\Controllers;
 
use App\Models\Advantage;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Catalog\Category;
use App\Models\Catalog\Tag;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders    = Slider::getAll();
        $banners    = Banner::getAll();
        $advantages = Advantage::getAll();
        $tags       = Tag::getHome();
        $cats       = Category::getWithProducts();
        $brands     = Brand::getAll();

        return view('public/home', compact('sliders', 'banners', 'advantages', 'tags', 'cats', 'brands'));
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