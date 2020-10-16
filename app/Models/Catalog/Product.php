<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\OrderingTrait;
use App\Models\Traits\PermisionTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use OrderingTrait, PermisionTrait, SoftDeletes;
    
    public $timestamps = true;

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
      'view'   => 'integer'
    ];

    public function scopeVisible($query)
    {
        return $query->where('view', 1)
                     ->has('prices')
                     ->whereHas('provider', function ($query) {
                         return $query->active();
                     })->has('category');
    }

    public function chars()
    {
        return $this->hasMany('App\Models\Catalog\CharProduct', 'id_product', 'id');
    }

    public function prices()
    {
        return $this->hasMany(ProductPrice::class, 'id_product', 'id')->orderBy('price', 'asc');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Catalog\Tag', 'catalog_tags', 'id_product', 'id_tag')->orderBy('page_up', 'asc');
    }

    public function category()
    {
        return $this->hasOne('App\Models\Catalog\Category', 'id', 'id_category');
    }

    public function provider()
    {
        return $this->hasOne('App\Models\User', 'id', 'id_provider');
    }

    public function images()
    {
        return $this->hasMany('App\Models\Catalog\ProductImage', 'id_product', 'id')->orderByPageUp();
    }

    public function scopeFilter($query)
    {
        if (request()->params) {
            $query->whereHas('chars', function ($query) {
                return $query->whereIn('value', explode(',', request()->params));
            });
        }

        if (request()->providers) {
            $query->whereIn('id_provider', explode(',', request()->providers));
        }

        if (request()->id_provider && request()->id_provider != 'all') {
            $query->where('id_provider', request()->id_provider);
        }

        $priceQuery = '(SELECT price FROM catalog_prices WHERE catalog_prices.id_product = catalog.id ORDER BY price asc LIMIT 1)';

        $query->selectRaw("$priceQuery as price");

        switch (request()->sort_by) {
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

    public function scopeCatalog($query, $catIds = [])
    {
        return $query->select('catalog.*')
                     ->whereIn('id_category', $catIds)
                     ->withRelations()
                     ->visible();
    }

    public function scopeSearch($query, $param)
    {
        return $query->select('catalog.*')
                     ->where(function ($where) use($param) {
                        return $where->where('name_ru', 'like', "%$param%")
                                    ->orWhereHas('category', function ($query) use($param) {
                                        return $query->where('name_ru', 'like', "%$param%");
                                    });
                     })
                     ->withRelations()
                     ->visible();
    }
}
