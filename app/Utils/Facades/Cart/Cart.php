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

    public function has()
    {
        return session()->has('cart');
    }
}