<?php

namespace App\Repository\Interfaces;

interface ProviderRepositoryInterface
{
    public function getProvidersFilter($idsCats = []);

    public function getProviderProducts($provider_id);

    public function getProviderProduct($provider_id);

    public function getCatsGroupedByProviders($provider_id = false);

    public function getProvidersList();

    public function getProviderFilterCats();

    public function getProvider($id);

    public function getProviderServices($id);
}
