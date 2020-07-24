<?php

namespace App\Http\Controllers;

use App\Models\Catalog\Category;
use App\Models\Catalog\Char;
use App\Models\Catalog\Product;
use App\Repository\Interfaces\CatalogRepositoryInterface;
use App\Repository\Interfaces\ProviderRepositoryInterface;
use App\Utils\ArraySess;
use App\Utils\Crumbs\BreadFactory;
use App\Utils\Crumbs\Crumb;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    private $repository;

    private $providerRep;

    public function __construct(CatalogRepositoryInterface $repository, ProviderRepositoryInterface $providerRep)
    {
        $this->repository  = $repository;
        $this->providerRep = $providerRep;
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
        $providers = $this->providerRep->getProvidersFilter($idsCats);

        return view('public/catalog/category', compact(['category', 'providers', 'catalog', 'filters', 'breads', 'moreCats', 'filterPrices']));
    }

    public function viewProduct($lang, $url)
    {
        $product   = $this->repository->getProduct($url);
        $chars     = $this->repository->getProductChars($product->id);
        $charsCart = $chars->filter(function ($item) {
            return $item['used_cart'];
        });
        $allCats   = $this->repository->getCats()->keyBy('id');
        $breads    = $this->generateBreads(
            $this->repository->getBreads(
                $allCats->toArray(),
                $product->category->id,
                ['name' => $product["name_$lang"]]
            )
        );

        return view('public/catalog/product', compact(['product', 'breads', 'chars', 'charsCart']));
    }

    private function generateBreads($items)
    {
        $crumb   = BreadFactory::init();
        $crumb->add(Crumb::name('Каталог'));

        foreach ($items as $item) {
            $crumb->add(
                Crumb::name($item->name)
                     ->link(@$item->url ? setUri("catalog/{$item->url}") : '')
            );
        }

        return $crumb->toHtml();
    }

}
