<?php

namespace App\Repository;

use App\Models\Catalog\Char;
use App\Models\Catalog\Product;
use App\Models\Catalog\ProductPrice;
use App\Models\User;
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

    public function getSubcategory($id_category)
    {
        return Category::where('parent_id', $id_category)->with('childs')->visible()->get();
    }

    public function getSameCats($id_parent)
    {
        return Category::where('parent_id', $id_parent)->withCount('products')->visible()->get();
    }

    public function getCategoryProducts($ids, $per_page = 20)
    {
        $data = Product::catalog($ids)
                       ->filter()
                       ->paginate($per_page);
        return $data;
    }

    public function getSearchProducts($query, $per_page)
    {
        return Product::search($query)
                     ->filter()
                     ->paginate($per_page);
    }

    public function deleteProduct($id, $id_provider)
    {
        $product = Product::whereId($id)->where('id_provider', $id_provider)->firstOrFail();
        $product->delete();
    }

    public function getProduct($url)
    {
        return Product::whereUrl($url)->with(['category', 'chars'])
                      ->withRelations()
                      ->visible()
                      ->firstOrFail();
    }

    public function getProductById($id)
    {
        return Product::whereId($id)->visible()->firstOrFail();
    }

    public function getProductChars($idProduct, $usedCart = false, $lang = false)
    {
        $lang = $lang ?: lang();
        $chars = Char::orderByPageUp()
                      ->with(['charProducts' => function ($query) use ($idProduct) {
                          return $query->where('id_product', $idProduct)
                                       ->with('optionValue');
                      }])
                      ->usedCart($usedCart)
                      ->where('parent_id', 0)
                      ->get();

        $data = collect();
        foreach ($chars as $char) {
            if ($char->type == 'input') {
                $value = @$char->charProducts->first()['value'];
            } else {
                $value = collect();
                foreach ($char->charProducts as $item) {
                    $value->push([
                        'id'   => $item->optionValue->id,
                        'name' => $item->optionValue["name_$lang"],
                    ]);
                }
            }

            $data->push([
                'id'        => $char->id,
                'name'      => $char["name_$lang"],
                'type'      => $char->type,
                'used_cart' => $char->used_cart,
                'value'     => $value
            ]);
        }

        return $data->filter(function ($item) {
            return ($item['type'] != 'input' && !$item['value']->count()) ? false : true;
        });
    }

    public function getMinMaxPrices($idsCats = false)
    {
        $prices = ProductPrice::whereHas('product', function ($query) use ($idsCats) {
            if (!empty($idsCats)) {
                $query->whereHas('category', function ($query) use ($idsCats) {
                    return $query->whereIn('id_category', $idsCats);
                });
            }
            return $query->visible();
        })->orderBy('price', 'asc')->groupBy('id_product')->get();

        return collect([
            'min' => $prices->min('price'),
            'max' => $prices->max('price')
        ]);
    }

    public function getFilters($idsCats = [])
    {
        return Char::filters($idsCats)->get()->filter(function ($item) {
            return $item->childs->count();
        });
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

    public function getBreads($allCats, $idCategory, $def = [], $breadcrumbs_array = [])
    {
        if (!$idCategory) {
            return false;
        }

        if ($def) {
            $breadcrumbs_array[] = (object) $def;
        }

        $lang = lang();
        for ($i = 0; $i < count($allCats); $i++) {
            if (isset($allCats[$idCategory])) {
                $category = $allCats[$idCategory];
                $breadcrumbs_array[$idCategory] = (object) [
                    'name' => $category["name_{$lang}"],
                    'url'  => $category['url']
                ];
                $idCategory = $allCats[$idCategory]['parent_id'];
            } else {
                break;
            }
        }

        return (object) array_reverse($breadcrumbs_array, true);
    }
}
