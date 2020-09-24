<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\OrderRepositoryInterface;

class OrdersController extends Controller
{
    private $repository;

    public function __construct(OrderRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $orders = $this->repository->getProviderOrders(user()->id);
        return view('profile.orders', compact('orders'));
    }
}
