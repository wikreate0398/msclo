<?php

namespace App\Models\Catalog;

use App\Models\Traits\OrderingTrait;
use App\Models\Traits\PermisionTrait;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use OrderingTrait, PermisionTrait;

    public $timestamps = false;

    protected $table = 'tags';

    protected $fillable = [
        'name_ru',
        'name_en'
    ];

    public function products()
    {
        return $this->belongsToMany('App\Models\Catalog\Product', 'catalog_tags', 'id_tag', 'id_product')->orderBy('page_up', 'asc');
    }

    public function scopeGetHome($query)
    {
        return $query->visible()->orderByPageUp()->with(['products.category', 'products.images', 'products.prices'])->has('products')->get();
    }
}
