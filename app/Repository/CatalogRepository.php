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

    public function getSameCats($parent_id)
    {
        return Category::where('parent_id', $parent_id)->withCount('products')->visible()->get();
    }

    public function getCategoryProducts($ids, $per_page = 20)
    {
        $data = Product::catalog($ids)
                       ->filter()
                       ->paginate($per_page);
        return $data;
    }

    public function deleteProduct($id, $provider_id)
    {
        $product = Product::whereId($id)->where('provider_id', $provider_id)->firstOrFail();
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
                          return $query->where('product_id', $idProduct)
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
                    return $query->whereIn('category_id', $idsCats);
                });
            }
            return $query->visible();
        })->orderBy('price', 'asc')->groupBy('product_id')->get();

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

    public function getSubcatsIds($dataset, $parent_id)
    {
        foreach (map_tree($dataset) as $id => $item) {
            if (!empty($item['childs'])) {
                $this->extractTreeIds($parent_id, $item['childs']);
            }
        }
        return $this->idsSubcat;
    }

    private function extractTreeIds($parent_id, $items)
    {
        foreach ($items as $item) {
            if ($parent_id == $item['parent_id']) {
                $this->idsSubcat[] = $item['id'];
            }

            if (!empty($item['childs'])) {
                $this->extractTreeIds(($parent_id == $item['parent_id']) ? $item['id'] : $parent_id, $item['childs']);
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
