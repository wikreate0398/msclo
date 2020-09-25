<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    public $timestamps = false;

    protected $table = 'product_tags';

    protected $fillable = [
        'product_id',
        'tag_id'
    ];
}
