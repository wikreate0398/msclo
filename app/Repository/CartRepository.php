<?php

namespace App\Repository;

use App\Models\Catalog\ProductPrice;
use App\Repository\Interfaces\CartRepositoryInterface;
use App\Repository\Interfaces\CatalogRepositoryInterface;

class CartRepository implements CartRepositoryInterface
{
    public function __construct()
    {
    }

    public function getTotalQty($qty = 0)
    {
        foreach ($this->cartData() as $key => $value) {
            $qty += $value['qty'];
        }
        return $qty;
    }

    public function getTotalPrice($price = 0)
    {
        $getPrices = ProductPrice::whereIn('id_product', $this->ids())->get();
        $prices    = $this->getPricesRange($getPrices);

        foreach ($this->cartData() as $key => $value) {
            $productPrice = $this->getPriceFromRange(
                $prices[$value['id']], $value['qty']
            );
            $price += $productPrice['price'] * $value['qty'];
        }
        return $price;
    }

    private function ids()
    {
        return array_map(function($item) {
            return $item['id'];
        }, $this->cartData());
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
        return $data->filter(function($item) use($qty){
            return ($qty <= $item['to']) ? true : false;
        })->first();
    }

    private function cartData()
    {
        return \Session::get('cart') ?: [];
    }
}