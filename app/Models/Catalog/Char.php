<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;
use App\Models\Catalog\CharProduct;
use App\Models\Catalog\Product;
use App\Models\Traits\OrderingTrait;
use App\Models\Traits\PermisionTrait;

class Char extends Model
{
    use OrderingTrait, PermisionTrait;
    
    public $timestamps = false;

    protected $table = 'chars';

    protected $fillable = [
        'name_ru',
        'name_en',
        'parent_id',
        'view_filter',
        'used_cart',
        'view',
        'type'
    ];

    protected $casts = [
        'view_filter' => 'integer',
        'used_cart'   => 'integer',
        'view'        => 'integer'
    ];

    public function childs()
    {
        return $this->hasMany(Char::class, 'parent_id', 'id')->orderByPageUp();
    }

    public function charProducts()
    {
        return $this->hasMany(CharProduct::class, 'char_id', 'id');
    }

    public function valuesProducts()
    {
        return $this->belongsToMany(Product::class, 'chars_products', 'value', 'product_id');
    }

    public function scopeFilters($query, $idsCats = [])
    {
        return $query->where('view_filter', 1)
                     ->where('parent_id', 0)
                     ->whereIn('type', ['checkbox', 'radio'])
                     ->with(['childs' => function ($query) use ($idsCats) {
                         if ($idsCats) {
                             $query->whereHas('valuesProducts', function ($query) use ($idsCats) {
                                 return $query->whereIn('category_id', $idsCats);
                             });
                         }
                         return $query->withCount(['valuesProducts' => function ($query) use ($idsCats) {
                             return $query->whereIn('category_id', $idsCats);
                         }]);
                     }])
                     ->has('childs');
    }

    public function scopeUsedCart($query, $flag = false)
    {
        if ($flag) {
            $query->where('used_cart', 1);
        }

        return $query;
    }
}
