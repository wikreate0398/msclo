<?php

namespace App\Models;

use App\Models\Catalog\Product;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\OrderingTrait;
use App\Models\Traits\PermisionTrait;

class Slider extends Model
{
    use OrderingTrait, PermisionTrait;
    
    public $timestamps = false;

    protected $table = 'sliders';

    protected $fillable = [
        'name',
        'image',
        'product_id'
    ];

    public function scopeGetAll($query)
    {
        return $query->visible()->orderByPageUp()->with(['product' => function ($query) {
            return $query->selectRaw('products.*')
                         ->selectRaw('(SELECT price FROM product_prices where product_prices.product_id = products.id ORDER BY price asc LIMIT 1) as price');
        }])->get();
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
