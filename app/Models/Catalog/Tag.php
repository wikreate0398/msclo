<?php

namespace App\Models\Catalog;

use App\Models\Traits\OrderingTrait;
use App\Models\Traits\PermisionTrait;
use App\Models\Catalog\Product;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use OrderingTrait, PermisionTrait;

    public $timestamps = false;

    protected $table = 'tags';

    protected $fillable = [
        'name_ru',
        'name_en',
        'view',
        'page_up'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_tags', 'tag_id', 'product_id')->visible()->orderBy('page_up', 'asc');
    }

    public function scopeGetHome($query)
    {
        return $query->visible()->orderByPageUp()->with(['products.category', 'products.images', 'products.prices'])->has('products')->get();
    }
}
