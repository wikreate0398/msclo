<?php

namespace App\Repository;

use App\Models\Catalog\Char;
use App\Models\Catalog\Product;
use App\Models\Catalog\ProductPrice;
use App\Repository\Interfaces\CatalogRepositoryInterface;
use App\Models\Catalog\Category;

class CatalogRepository implements CatalogRepositoryInterface
{
    private $idsSubcat = [];

    public function getCats()
    {
        return Category::visible()->withCount('products')->orderByPageUp()->get();
    }

    public function getCategory($url)
    {
        return Category::whereUrl($url)->with('childs')->visible()->firstOrFail();
    }

    public function getSameCats($id_parent)
    {
        return Category::where('parent_id', $id_parent)->withCount('products')->visible()->get();
    }

    public function getCategoryProducts($ids)
    {
        $data = Product::catalog($ids)
                       ->filter()
                       ->paginate(request('per_page') ?: 20);
        return $data;
    }

    public function getMinMaxPrices($idsCats)
    {
        $prices = ProductPrice::whereHas('product', function($query) use($idsCats) {
            return $query->whereHas('category', function($query) use($idsCats) {
                return $query->whereIn('id_category', $idsCats);
            });
        })->get();

        return collect([
            'min' => $prices->min('price'),
            'max' => $prices->max('price')
        ]);
    }

    public function getFilters($idsCats = [])
    {
        return Char::filters($idsCats)->get();
    }

    public function getSubcatsIds($dataset, $id_parent)
    {
        foreach (map_tree($dataset) as $id => $item) {
            if (!empty($item['childs'])) {
                $this->extractTreeIds($id_parent, $item['childs']);
            }
        }
        return $this->idsSubcat;
    }

    private function extractTreeIds($id_parent, $items)
    {
        foreach ($items as $item) {
            if ($id_parent == $item['parent_id']) {
                $this->idsSubcat[] = $item['id'];
            }

            if (!empty($item['childs'])) {
                $this->extractTreeIds(($id_parent == $item['parent_id']) ? $item['id'] : $id_parent, $item['childs']);
            }
        }
    }

    public function getBreads($allCats, $idCategory, $breadcrumbs_array = [])
    {
        if(!$idCategory) return false;

        $lang = lang();
        for($i = 0; $i < count($allCats); $i++){
            if(isset($allCats[$idCategory])){
                $category = $allCats[$idCategory];
                $breadcrumbs_array[$idCategory] = (object) [
                    'name' => $category["name_{$lang}"],
                    'url'  => $category['url']
                ];
                $idCategory = $allCats[$idCategory]['parent_id'];
            }else break;
        }

        return (object) array_reverse($breadcrumbs_array, true);
    }
}