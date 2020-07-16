<?php

namespace App\Utils\Facades\Cart;

use App\Repository\CartRepository;
use App\Repository\Interfaces\CartRepositoryInterface;

class Cart
{
    public function __construct()
    {
        $this->cartRepository = new CartRepository();
    }

    public function getTotalQty()
    {
        return $this->cartRepository->getTotalQty();
    }

    public function getTotalPrice()
    {
        return $this->cartRepository->getTotalPrice();
    }

    public function deleteItem($key = null)
    {
        if ($key === null) return;
        sessArray('cart')->detachByKey($key);
    }

    public function update($key = null, $data)
    {
        if ($this->has($key)) {
            sessArray('cart')->update($key, $data);
        }
    }

    public function remove()
    {
        session()->pull('cart');
    }

    public function has()
    {
        return session()->has('cart');
    }
}