<?php

namespace App\Repository;

use App\Models\Catalog\Product;
use App\Models\Provider\ProviderService;
use App\Models\User;
use App\Models\Catalog\Category;
use App\Repository\Interfaces\ProviderRepositoryInterface;

class ProviderRepository implements ProviderRepositoryInterface
{
    private $idsSubcat = [];

    public function getProviderProducts($provider_id, $view = 1)
    {
        $data = Product::withRelations();

        if ($view) {
            $data->visible();
        }
        $data = $data->where('provider_id', $provider_id)
                     ->get();

        return $data;
    }

    public function getProviderProduct($provider_id, $view = 1)
    {
        $data = Product::withRelations();

        if ($view) {
            $data->visible();
        }
        $data = $data->where('provider_id', $provider_id)
                     ->orderBy('created_at', 'desc')
                     ->take(1)
                     ->get();

        return $data;
    }

    public function getProvidersFilter($idsCats = [])
    {
        return User::provider()->whereProdsInCats($idsCats)->get();
    }

    public function getCatsGroupedByProviders($provider_id = false)
    {
        $providers = User::getProvidersCats($provider_id);
        $cats      = collect();
        foreach ($providers as $provider) {
            foreach ($provider->products->groupBy('category_id') as $category_id => $products) {
                $cats->push([
                    'provider_id'   => $provider->id,
                    'category_id'   => $category_id,
                    'countProducts' => $products->count(),
                    'category_data' => $products->first()->category
                ]);
            }
        }
        return $cats->groupBy('provider_id');
    }

    public function getProviderFilterCats()
    {
        return Category::has('products')->visible()->get();
    }

    public function getProvidersList()
    {
        return User::provider()
                   ->filterProviders()
                   ->hasVisibleProducts()
                   ->paginate(request('per_page') ?: 20);
    }

    public function getProvider($id)
    {
        return User::whereId($id)
                   ->provider()
                   ->with(['files'])
                   ->hasVisibleProducts()
                   ->firstOrFail();
    }

    public function getProviderServices($id, $lang = false)
    {
        $lang = $lang ?: lang();
        $chars = ProviderService::orderByPageUp()
                                ->with(['providerServiceIntersect' => function ($query) use ($id) {
                                    return $query->where('provider_id', $id)
                                                 ->with('optionValue');
                                }])
                                ->where('parent_id', 0)
                                ->get();

        $data = collect();
        foreach ($chars as $char) {
            if ($char->type == 'input') {
                $value = @$char->providerServiceIntersect->first()['value'];
            } elseif ($char->type == 'self_checkbox') {
                $value = collect();
                foreach ($char->providerServiceIntersect as $item) {
                    $value->push([
                        'id'   => $item->service_id,
                        'name' => $item->value,
                    ]);
                }
            } else {
                $value = collect();
                foreach ($char->providerServiceIntersect as $item) {
                    $value->push([
                        'id'   => $item->optionValue->id,
                        'name' => $item->optionValue["name_$lang"],
                    ]);
                }
            }

            if (!empty($value)) {
                $data->push([
                    'id'        => $char->id,
                    'name'      => $char["name_$lang"],
                    'type'      => $char->type,
                    'used_cart' => $char->used_cart,
                    'value'     => $value
                ]);
            }
        }

        return $data->filter(function ($item) {
            return ($item['type'] != 'input' && !$item['value']->count()) ? false : true;
        });
    }
}
