<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\OrderingTrait;
use App\Models\Traits\PermisionTrait;

class Product extends Model
{
	use OrderingTrait, PermisionTrait;
	
	public $timestamps = false;

	protected $table = 'catalog';

	protected $fillable = [
	    'url',
	    'id_provider',
	    'id_category',
        'name_ru', 
        'name_en',
        'description_ru',
        'description_en',
        'quantity',
        'price',
        'is_new'
    ];

	protected $casts = [
	  'is_new' => 'integer'
    ];

    public function chars()
    {
        return $this->hasMany('App\Models\Catalog\CharProduct', 'id_product', 'id');
    }

    public function prices()
    {
        return $this->hasMany('App\Models\Catalog\ProductPrice', 'id_product', 'id');
    }

    public function images()
    {
        return $this->hasMany('App\Models\Catalog\ProductImage', 'id_product', 'id');
    }

    public function scopeFilter($query)
    {
        if (request()->params) {
            $query->whereHas('chars', function($query) {
                return $query->whereIn('value', explode(',', request()->params));
            });
        }

        if (request()->id_provider) {
            $query->where('id_provider', request()->id_provider);
        }

        return $query;
    }
}
