<?php

namespace App\Http\Controllers;

use App\Models\Catalog\Product;
use App\Models\Catalog\ProductPrice;
use App\Repository\Interfaces\CartRepositoryInterface;
use App\Repository\Interfaces\CatalogRepositoryInterface;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $cartRepository;

    private $catalogRepository;

    public function __construct(CartRepositoryInterface $cartRepository, CatalogRepositoryInterface $catalogRepository)
    {
        $this->cartRepository    = $cartRepository;
        $this->catalogRepository = $catalogRepository;
    }

    public function add($lang, Request $request)
    {
        $product = $this->catalogRepository->getProductById($request->id);

        try {

            if (empty($request->qty)) {
                throw new \ValidationError('Укажите кол-во');
            }

            $this->checkRequiredChars($product, $request);

            $this->attachProduct([
                'id'    => $request->id,
                'qty'   => $request->qty,
                'chars' => $request->char
            ]);

            return \JsonResponse::success(['message' => 'Товар успешно добавлен в корзину']);

        } catch (\ValidationError $e) {
            return \JsonResponse::error(['message' => $e->getMessage()]);
        }
    }

    private function attachProduct($data, $updated = false)
    {
        extract($data);
        $cartData = \Session::get('cart');
        \Session::pull('cart');

        if ($cartData) {
            foreach ($cartData as $key => $item) {
                if ($item['id'] == $id && $item['chars'] == $chars) {
                    $cartData[$key]['qty'] = $qty;
                    $updated = true;
                    break;
                }
            }
        }

        if (!$updated) {
            $cartData[] = $data;
        }

        if ($cartData) {
            \Session::put('cart', $cartData);
        }
    }

    private function checkRequiredChars($product, $request)
    {
        $chars = $this->catalogRepository->getProductChars($product->id, true)->keyBy('id');;
        foreach ($request->char as $id_char => $id_value) {
            if (empty($chars[$id_char]) or !in_array($id_value, $chars[$id_char]['value']->pluck('id')->toArray())) {
                throw new \ValidationError('Укажите все параметры');
            }
        }
    }

    public function getPriceByQty($lang, Request $request)
    {
        $price = $this->catalogRepository
                      ->getPriceByQty($request->idProduct, $request->qty);

        if ($price) {

        }
    }
}
