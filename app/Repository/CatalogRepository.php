<?php

namespace App\Repository;

use App\Repository\Interfaces\CatalogRepositoryInterface;
use App\Models\Catalog\Category;

class CatalogRepository implements CatalogRepositoryInterface
{
    public function getCats()
    {
        return Category::visible()->orderByPageUp()->get();
    }
}