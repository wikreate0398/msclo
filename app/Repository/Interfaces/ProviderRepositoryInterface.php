<?php

namespace App\Repository\Interfaces;

interface ProviderRepositoryInterface
{
    public function getProvidersFilter($idsCats = []);

    public function getProviderProducts($id_provider);

    public function getProviderProduct($id_provider);

    public function getCatsGroupedByProviders($id_provider = false);

    public function getProvidersList();

    public function getProviderFilterCats();

    public function getProvider($id);

    public function getProviderServices($id);
}
