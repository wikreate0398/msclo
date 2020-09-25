<?php

namespace App\Repository\Interfaces;

interface OrderRepositoryInterface
{
    public function getOrders();

    public function getSumOfAllSalesAndQuantity($provider_id);

    public function getSalesFromLastMonth($provider_id);

    public function getProviderOrders($provider_id);

    public function getMinMaxProductsPrice($provider_id);

    public function dashboardData();
}
