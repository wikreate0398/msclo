<?php

namespace App\Repository\Interfaces;

interface CatalogRepositoryInterface
{
    public function getCats();

    public function getCategory($url);

    public function getCategoryProducts($ids);

    public function getProductChars($provider_id, $usedCart = false, $lang = false);
    
    public function getFilters($idsCats = []);

    public function getSubcatsIds($allCats, $category_id);

    public function getSameCats($parent_id);

    public function getBreads($allCats, $category_id, $def = []);

    public function getMinMaxPrices($idsCats = []);

    public function getProduct($url);

    public function getProductById($id);

    public function deleteProduct($id, $provider_id);
}
