<?php

namespace App\Repository;

use App\Models\Order\OrderProduct;
use App\Repository\Interfaces\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function getOrders()
    {
        $data = OrderProduct::with(['provider', 'product'])
                              ->orderBy('qty', 'desc')
                              ->take(5)
                              ->get();

        return $data;
    }
}
