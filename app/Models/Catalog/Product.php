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
	    'code',
	    'url',
	    'id_provider',
	    'id_category',
        'name_ru', 
        'name_en',
        'description_ru',
        'description_en',
        'text_ru',
        'text_en',
        'quantity',
        'price',
        'is_new'
    ];

	protected $casts = [
	  'is_new' => 'integer',
      'view'   => 1
    ];

	public function scopeVisible($query)
    {
        return $query->where('view', 1)
                     ->has('prices');
    }

    public function chars()
    {
        return $this->hasMany('App\Models\Catalog\CharProduct', 'id_product', 'id');
    }

    public function prices()
    {
        return $this->hasMany('App\Models\Catalog\ProductPrice', 'id_product', 'id')->orderBy('price', 'asc');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Catalog\Tag', 'catalog_tags', 'id_product', 'id_tag')->orderBy('page_up', 'asc');
    }

    public function category()
    {
        return $this->hasOne('App\Models\Catalog\Category', 'id', 'id_category');
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

        if (request()->id_provider && request()->id_provider != 'all') {
            $query->where('id_provider', request()->id_provider);
        }

        $priceQuery = '(SELECT price FROM catalog_prices WHERE catalog_prices.id_product = catalog.id ORDER BY price asc LIMIT 1)';

        $query->selectRaw("$priceQuery as price");

        switch (request()->sort_by){
            case ('price_asc'):
                $query->orderByRaw("price asc");
                break;
            case ('price_desc'):
                $query->orderByRaw("price desc");
                break;
            default:
                $query->orderByPageUp();
                break;
        }

        if (request('price_from') && request('price_to')) {
            $query->whereBetween(\DB::Raw($priceQuery), [request('price_from'), request('price_to')]);
        }

        return $query;
    }

    public function scopeWithRelations($query)
    {
        return $query->with(['images', 'prices', 'category']);
    }

    public function scopeGetFavorites($query)
    {
        $ids = session()->get('favorites');
        return $query->whereIn('id', $ids ?: [])->withRelations()->orderByPageUp()->visible()->get();
    }

    public function scopeCatalog($query, $catIds)
    {
        return $query->select('catalog.*')
                     ->whereIn('id_category', $catIds)
                     ->withRelations()
                     ->visible();
    }
}
