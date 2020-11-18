<?php

namespace App\Http\Controllers;

use App\Mail\Callback;
use App\Models\Advantage;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Catalog\Product;
use App\Models\Catalog\Category;
use App\Models\Catalog\Tag;
use App\Models\Slider;
use App\Models\User;
use App\Repository\Interfaces\ProviderRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    private $providerRepository;

    public function __construct(ProviderRepositoryInterface $providerRepository)
    {
        $this->providerRepository = $providerRepository;
    }

    public function index()
    {
        $sliders    = Slider::getAll();
        $banners    = Banner::getAll();
        $advantages = Advantage::getAll();
        $tags       = Tag::getHome();
        $products    = Product::latest()->limit(10)->get();
        $cats       = Category::getWithProducts();
        $brands     = Brand::getAll();
        $providers  = User::getHomeProviders()->chunk(4);
        $providersCats = $this->providerRepository->getCatsGroupedByProviders();

        return view('public/home', compact('sliders', 'banners', 'advantages', 'tags', 'products', 'cats', 'brands', 'providers', 'providersCats'));
    }

    public function page()
    {
        $data = \Pages::pageData();
        if (!$data) {
            abort('404');
        }

        return view('public/page', [
            'data'   => $data,
        ]);
    }

    public function callback($lang, Request $request)
    {
        if (!$request->phone) {
            return \JsonResponse::error(['messages' => 'Введите телефон']);
        }

        Mail::to(\Constant::get('EMAIL'))->send(new Callback($request->phone));

        return \JsonResponse::success([
            'messages' => 'Ваш телефон успешно сохранен. Мы вам перезвоним'
        ]);
    }
}
