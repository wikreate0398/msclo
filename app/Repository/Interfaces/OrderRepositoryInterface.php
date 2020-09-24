<?php

namespace App\Repository\Interfaces;

interface OrderRepositoryInterface
{
    public function getOrders();

    public function getSumOfAllSalesAndQuantity($id_provider);

    public function getSalesFromLastMonth($id_provider);

    public function getProviderOrders($id_provider);

    public function getMinMaxProductsPrice($id_provider);

    public function dashboardData();
}
