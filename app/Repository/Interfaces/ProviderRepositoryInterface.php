<?php

namespace App\Repository\Interfaces;

interface ProviderRepositoryInterface
{
    public function getProvidersFilter($idsCats = []);

    public function getProviderProducts($id_provider);

    public function getCatsGroupedByProviders();

    public function getProvidersList();

    public function getProviderFilterCats();

    public function getProvider($id);

    public function getProviderServices($id);

    public function getProviderOrders($id_provider);
}