<?php

namespace App\Http\Controllers\Profile;
 
use App\Models\Order\Order;
use App\Repository\Interfaces\ProviderRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;

class OrdersController extends Controller
{
    private $repository;

    public function __construct(ProviderRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $orders = $this->repository->getProviderOrders(user()->id);
        return view('profile.orders', compact('orders'));
    }
}
