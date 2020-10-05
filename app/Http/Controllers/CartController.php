<?php

namespace App\Http\Controllers;

use App\Models\Order\Order;
use App\Models\Order\OrderProduct;
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

    public function showCheckout()
    {
        $crumb   = BreadFactory::init();
        $crumb->add(Crumb::name('Корзина')->link(route('view_cart', ['lang' => lang()])))
              ->add(Crumb::name('Оформить'));
        $breads  = $crumb->toHtml();
        $products = $this->cartRepository->getProducts();

        return view('public.cart.checkout', compact(['products', 'breads']));
    }

    public function checkout($lang, Request $request)
    {
        try {
            if (!isAuth() or !cart()->has()) {
                return;
            }

            $req = collect(['name', 'lastname', 'agree', 'payment_type', 'city', 'street', 'house', 'phone']);
            $req->each(function ($v) {
                if (!request($v)) {
                    throw new \ValidationError('Заполните все обязательные поля');
                }
            });

            $order = Order::create([
                'name'         => $request->name,
                'lastname'     => $request->lastname,
                'payment_type' => $request->payment_type,
                'city'         => $request->city,
                'street'       => $request->street,
                'house'        => $request->house,
                'phone'        => $request->phone,
                'comment'      => $request->comment,
                'company'      => $request->company,
                'id_user'      => user()->id,
                'rand'         => generate_id(6),
                'total_price'  => cart()->getTotalPrice()
            ]);

            $products = $this->cartRepository->getProducts();
            foreach ($products as $product) {
                OrderProduct::create([
                    'id_order'    => $order->id,
                    'id_provider' => $product['id_provider'],
                    'id_product'  => $product['id'],
                    'qty'         => $product['qty'],
                    'price'       => $product['price']
                ]);
            }

            cart()->remove();
            return \JsonResponse::success(['redirect' => route('order_added', ['lang' => lang()])]);
        } catch (\ValidationError $e) {
            return \JsonResponse::error(['messages' => $e->getMessage()]);
        }
    }

    public function success()
    {
        $crumb   = BreadFactory::init();
        $crumb->add(Crumb::name('Корзина'))
              ->add(Crumb::name('Оформить'));
        $breads  = $crumb->toHtml();
        return view('public.cart.success', compact(['breads']));
    }

    public function add($lang, Request $request)
    {
        $product = $this->catalogRepository->getProductById($request->id);

        try {
            if (isAuth() && $product->id_provider == user()->id) {
                throw new \ValidationError('Вы не можете покупать свои товары');
            }

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

    public function changeQty($lang, Request $request)
    {
        $product = $this->catalogRepository->getProductById($request->id);
        $price   = $this->cartRepository->getPriceByQty($product->prices, $request->qty);

        if (cart()->has($request->cartId)) {
            cart()->update($request->cartId, [
                'qty' => $request->qty
            ]);
        }

        return \JsonResponse::success([
            'price'      => $price,
            'qty'        => $request->qty,
            'totalQty'   => $this->cartRepository->getTotalQty(),
            'totalPrice' => $this->cartRepository->getTotalPrice()
        ]);
    }

    public function removeCart($lang, Request $request)
    {
        if (cart()->has($request->cartId)) {
            cart()->deleteItem($request->cartId);
        }

        return \JsonResponse::success([
            'totalQty'   => $this->cartRepository->getTotalQty(),
            'totalPrice' => $this->cartRepository->getTotalPrice()
        ]);
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
        $chars = $this->catalogRepository->getProductChars($product->id, true)->keyBy('id');
        if (!empty($request->char)) {
            foreach ($request->char as $id_char => $id_value) {
                if (empty($chars[$id_char]) or !in_array($id_value, $chars[$id_char]['value']->pluck('id')->toArray())) {
                    throw new \ValidationError('Укажите все параметры');
                }
            }
        }
    }
}
