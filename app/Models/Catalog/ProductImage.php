<?php

namespace App\Models\Catalog;

use App\Models\Traits\OrderingTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\Catalog\Product;

class ProductImage extends Model
{
    use OrderingTrait;

    public $timestamps = false;

    protected $table = 'product_images';

    protected $fillable = [
        'product_id',
        'image',
        'page_up'
    ];

    protected $casts = [
        'page_up' => 'integer'
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
