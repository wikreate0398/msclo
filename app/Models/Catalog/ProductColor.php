<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    protected $fillable = [
        'product_id',
        'color_id'
    ];
}
