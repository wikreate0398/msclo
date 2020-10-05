<?php

namespace App\Repository;

use App\Models\Catalog\Char;
use App\Models\Catalog\Product;
use App\Models\Catalog\ProductPrice;
use App\Repository\Interfaces\CartRepositoryInterface;

class CartRepository implements CartRepositoryInterface
{
    public function __construct()
    {
    }

    public function getTotalQty($qty = 0)
    {
        foreach ($this->cartSess() as $key => $value) {
            if ($value['qty'] > 0) {
                $qty += $value['qty'];
            }
        }
        return $qty;
    }

    public function getTotalPrice($price = 0)
    {
        $getPrices = ProductPrice::whereIn('id_product', $this->ids())->get();
        $prices    = $this->getPricesRange($getPrices);

        foreach ($this->cartSess() as $key => $value) {
            $productPrice = $this->getPriceFromRange(
                $prices[$value['id']],
                $value['qty']
            );
            $price += $productPrice['price'] * $value['qty'];
        }
        return $price;
    }

    public function getProducts()
    {
        $lang         = lang();
        $productsData = Product::visible()
                           ->whereIn('id', $this->ids())
                           ->withRelations()
                           ->orderByPageUp()
                           ->get()
                           ->keyBy('id');

        $charsData = Char::whereIn('id', $this->charsIds())->get()->keyBy('id');

        $data = collect();

        foreach ($this->cartSess() as $cartId => $item) {
            $product = $productsData[$item['id']];

            $chars = collect();
            if ($charsData->count()) {
                if (!empty($item['chars'])) {
                    foreach ($item['chars'] as $id_char => $id_value) {
                        $chars->push([
                            'name'  => @$charsData[$id_char]["name_$lang"],
                            'value' => @$charsData[$id_value]["name_$lang"],
                        ]);
                    }
                }
            }

            $data->push([
                'cart_id'     => $cartId,
                'url'         => $product->url,
                'id'          => $item['id'],
                'id_provider' => $product->id_provider,
                'name'        => $product["name_$lang"],
                'image'       => imageThumb(@$product->images->first()->image, 'uploads/products', 300, 300, '300X300'),
                'price'       => $this->getPriceByQty($product->prices, $item['qty']),
                'qty'         => $item['qty'],
                'chars'       => $chars
            ]);
        }

        return $data;
    }

    private function ids()
    {
        return array_map(function ($item) {
            return $item['id'];
        }, $this->cartSess());
    }

    private function charsIds()
    {
        $ids = [];
        foreach ($this->cartSess() as $item) {
            if (!empty($item['chars'])) {
                $a = array_merge(
                    array_keys($item['chars']),
                    array_values($item['chars'])
                );
                foreach ($a as $k => $v) {
                    $ids[$v] = $v;
                }
            }
        }
        return $ids;
    }

    public function getPricesRange($dataPrices)
    {
        if (!$dataPrices->count()) {
            return false;
        }

        $rangePrices = collect();

        foreach ($dataPrices->groupBy('id_product') as $id_product => $items) {
            $items = $items->sortBy('quantity')->values();
            foreach ($items as $key => $item) {
                $rangePrices->push([
                    'id'    => $id_product,
                    'from'  => $items->has($key-1) ? $item['quantity'] : 0,
                    'to'    => $items->has($key+1) ? $items[$key+1]['quantity']-1 : '∞',
                    'price' => $item->price
                ]);
            }
        }

        return $rangePrices->groupBy('id');
    }

    public function getPriceByQty($dataPrices, $qty)
    {
        if (!$dataPrices->count()) {
            return false;
        }

        $rangePrices = collect();
        $dataPrices  = $dataPrices->sortBy('quantity')->values();
        foreach ($dataPrices as $key => $item) {
            $rangePrices->push([
                'id'    => $item->id_product,
                'from'  => $dataPrices->has($key-1) ? $item->quantity : 0,
                'to'    => $dataPrices->has($key+1) ? $dataPrices[$key+1]->quantity-1 : '∞',
                'price' => $item->price
            ]);
        }

        $price = $this->getPriceFromRange($rangePrices, $qty);

        return $price['price'];
    }

    public function getPriceFromRange($data, $qty)
    {
        return $data->filter(function ($item) use ($qty) {
            return ($qty <= $item['to']) ? true : false;
        })->first();
    }

    private function cartSess()
    {
        return \Session::get('cart') ?: [];
    }
}
