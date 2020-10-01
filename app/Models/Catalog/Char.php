<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;
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
        'type',
        'is_color'
    ];

    protected $casts = [
        'view_filter' => 'integer',
        'used_cart'   => 'integer',
        'view'        => 'integer'
    ];

    public function childs()
    {
        return $this->hasMany('App\Models\Catalog\Char', 'parent_id', 'id')->with('charColors')->orderByPageUp();
    }

    public function charColors()
    {
        return $this->hasMany(CharColor::class, 'char_id', 'id');
    }

    public function charProducts()
    {
        return $this->hasMany('App\Models\Catalog\CharProduct', 'id_char', 'id');
    }

    public function valuesProducts()
    {
        return $this->belongsToMany('App\Models\Catalog\Product', 'chars_catalog', 'value', 'id_product');
    }

    public function scopeFilters($query, $idsCats = [])
    {
        return $query->where('view_filter', 1)
                     ->where('parent_id', 0)
                     ->whereIn('type', ['checkbox', 'radio'])
                     ->with(['childs' => function ($query) use ($idsCats) {
                         if ($idsCats) {
                             $query->whereHas('valuesProducts', function ($query) use ($idsCats) {
                                 return $query->whereIn('id_category', $idsCats);
                             });
                         }
                         return $query->withCount(['valuesProducts' => function ($query) use ($idsCats) {
                             return $query->whereIn('id_category', $idsCats);
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
