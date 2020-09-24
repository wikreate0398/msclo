<?php

namespace App\Http\View\Composers;

use App\Repository\Interfaces\OrderRepositoryInterface;
use App\Repository\Interfaces\ProviderRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileComposer
{
    protected $providerRepository;
    protected $orderRepository;

    public function __construct(ProviderRepositoryInterface $repository, OrderRepositoryInterface $orderRepository)
    {
        $this->providerRepository = $repository;
        $this->orderRepository = $orderRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $id = Auth::user()->id;
        $view->with([
            'productsNumber' => $this->providerRepository->getProviderProducts($id)->count(),
            'ordersNumber' =>  $this->orderRepository->getProviderOrders($id)->count()
        ]);
    }
}
