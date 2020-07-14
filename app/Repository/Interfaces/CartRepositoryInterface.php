<?php

namespace App\Repository\Interfaces;

interface CartRepositoryInterface
{
    public function getTotalQty();

    public function getTotalPrice();

    public function getPricesRange($dataPrices);

    public function getPriceFromRange($data, $qty);

    public function getPriceByQty($dataPrices, $qty);
}