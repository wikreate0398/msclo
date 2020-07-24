<?php

namespace App\Repository\Interfaces;

interface CatalogRepositoryInterface
{
    public function getCats();

    public function getCategory($url);

    public function getCategoryProducts($ids);

    public function getFilters($idsCats = []);

    public function getSubcatsIds($allCats, $id_category);

    public function getSameCats($id_parent);

    public function getBreads($allCats, $id_category, $def = []);

    public function getMinMaxPrices($idsCats = []);

    public function getProduct($url);

    public function getProductById($id);

    public function deleteProduct($id, $id_provider);
}