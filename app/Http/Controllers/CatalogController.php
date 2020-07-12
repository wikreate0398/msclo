<?php

namespace App\Http\Controllers;

use App\Models\Catalog\Category;
use App\Models\Catalog\Char;
use App\Models\Catalog\Product;
use App\Repository\Interfaces\CatalogRepositoryInterface;
use App\Utils\ArraySess;
use App\Utils\Crumbs\BreadFactory;
use App\Utils\Crumbs\Crumb;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    private $repository;

    public function __construct(CatalogRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function list($lang, $url)
    {
        $category = $this->repository->getCategory($url);
        $moreCats = $category->childs->count() ? $category->childs : $this->repository->getSameCats($category->parent_id);
        $allCats  = $this->repository->getCats()->keyBy('id');

        $idsCats  = array_merge([$category->id], $this->repository->getSubcatsIds($allCats->toArray(), $category->id));

        $catalog = $this->repository->getCategoryProducts($idsCats);
        $filterPrices  = $this->repository->getMinMaxPrices($idsCats);

        $filters  = $this->repository->getFilters($idsCats);
        $breads   = $this->generateBreads($this->repository->getBreads($allCats->toArray(), $category->id));

        return view('public/catalog/category', compact(['category', 'catalog', 'filters', 'breads', 'moreCats', 'filterPrices']));
    }

    private function generateBreads($items)
    {
        $crumb   = BreadFactory::init();
        $crumb->add(Crumb::name('Каталог'));

        foreach ($items as $item) {
            $crumb->add(
                Crumb::name($item->name)
                     ->link(setUri("catalog/{$item->url}"))
            );
        }

        return $crumb->toHtml();
    }

}
