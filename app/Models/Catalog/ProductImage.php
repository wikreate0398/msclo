<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    public $timestamps = false;

    protected $table = 'catalog_images';

    protected $fillable = [
        'id_product',
        'image'
    ];
}
