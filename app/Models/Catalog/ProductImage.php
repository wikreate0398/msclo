<?php

namespace App\Models\Catalog;

use App\Models\Traits\OrderingTrait;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use OrderingTrait;

    public $timestamps = false;

    protected $table = 'catalog_images';

    protected $fillable = [
        'id_product',
        'image',
        'page_up'
    ];

    protected $casts = [
        'page_up' => 'integer'
    ];

    public function product()
    {
        return $this->hasOne('App\Models\Catalog\Product', 'id', 'id_product');
    }
}
