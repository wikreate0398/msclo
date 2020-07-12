<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    public $timestamps = false;

    protected $table = 'catalog_tags';

    protected $fillable = [
        'id_product',
        'id_tag'
    ];
}
