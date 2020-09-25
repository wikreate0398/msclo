<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\OrderingTrait;
use App\Models\Catalog\CharProduct;
use App\Models\Catalog\ProductImage;
use App\Models\Catalog\Tag;
use App\Models\User;
use App\Models\Traits\PermisionTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use OrderingTrait, PermisionTrait, SoftDeletes;
    
    public $timestamps = true;

    protected $table = 'products';

    protected $fillable = [
        'code',
        'url',
        'provider_id',
        'category_id',
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
        return $this->hasMany(CharProduct::class, 'product_id', 'id');
    }

    public function prices()
    {
        return $this->hasMany(ProductPrice::class, 'product_id', 'id')->orderBy('price', 'asc');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id')->orderBy('page_up', 'asc');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function provider()
    {
        return $this->hasOne(User::class, 'id', 'provider_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id')->orderByPageUp();
    }

    public function scopeFilter($query)
    {
        if (request()->params) {
            $query->whereHas('chars', function ($query) {
                return $query->whereIn('value', explode(',', request()->params));
            });
        }

        if (request()->providers) {
            $query->whereIn('provider_id', explode(',', request()->providers));
        }

        if (request()->provider_id && request()->provider_id != 'all') {
            $query->where('provider_id', request()->provider_id);
        }

        $priceQuery = '(SELECT price FROM product_prices WHERE product_prices.product_id = products.id ORDER BY price asc LIMIT 1)';

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

    public function scopeCatalog($query, $catIds)
    {
        return $query->select('products.*')
                     ->whereIn('category_id', $catIds)
                     ->withRelations()
                     ->visible();
    }
}
