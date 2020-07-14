<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\CartRepositoryInterface;
use App\Repository\Interfaces\CatalogRepositoryInterface;
use App\Utils\Crumbs\BreadFactory;
use App\Utils\Crumbs\Crumb;
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

    public function view()
    {
        $crumb   = BreadFactory::init();
        $crumb->add(Crumb::name('Корзина'));
        $breads  = $crumb->toHtml();
        $products = $this->cartRepository->getProducts();

        return view('public.cart.view', compact(['products', 'breads']));
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

            return \JsonResponse::success([
                'message'    => 'Товар успешно добавлен в корзину',
                'totalQty'   => $this->cartRepository->getTotalQty(),
                'totalPrice' => $this->cartRepository->getTotalPrice()
            ]);

        } catch (\ValidationError $e) {
            return \JsonResponse::error(['message' => $e->getMessage()]);
        }
    }

    public function loadModal($lang, Request $request)
    {
        $product    = $this->catalogRepository->getProductById($request->id);
        $chars     = $this->catalogRepository->getProductChars($product->id);
        $charsCart = $chars->filter(function ($item) {
            return $item['used_cart'];
        });
        return view('public.cart.modal', compact(['product', 'charsCart']));
    }

    public function changePriceByQty($lang, Request $request)
    {
        $product = $this->catalogRepository->getProductById($request->id);
        $price = $this->cartRepository
                      ->getPriceByQty($product->prices, $request->qty);

        return \JsonResponse::success(['price' => $price]);
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
}
