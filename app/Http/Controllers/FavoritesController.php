<?php

namespace App\Http\Controllers;

use App\Models\Catalog\Product;
use App\Utils\ArraySess;
use App\Utils\Crumbs\BreadFactory;
use App\Utils\Crumbs\Crumb;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function add(Request $request)
    {
        $arraySess = ArraySess::init('favorites');
        if ($arraySess->exist($request->idProduct)) {
            $arraySess->detach($request->idProduct);
        } else {
            $arraySess->attach($request->idProduct);
        }
        return \JsonResponse::success(['totalFav' => $arraySess->count()]);
    }

    public function list()
    {
        $products = Product::getFavorites();
        $breads   = $this->breads();

        return view('public/catalog/favorites', compact('products', 'breads'));
    }

    private function breads()
    {
        $crumb   = BreadFactory::init();
        $crumb->add(Crumb::name('Избранное'));
        return $crumb->toHtml();
    }
}
