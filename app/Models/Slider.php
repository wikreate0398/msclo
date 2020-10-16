<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\OrderingTrait;
use App\Models\Traits\PermisionTrait;

class Slider extends Model
{
	use OrderingTrait, PermisionTrait;
	
	public $timestamps = false;

	protected $table = 'slider';

	protected $fillable = [
        'name',
        'image',
        'id_product',
        'link'
    ];

	public function scopeGetAll($query)
    {
        return $query->visible()->orderByPageUp()->with(['product' => function($query) {
            return $query->selectRaw('catalog.*')
                         ->selectRaw('(SELECT price FROM catalog_prices where catalog_prices.id_product = catalog.id ORDER BY price asc LIMIT 1) as price');
        }])->get();
    }

    public function product()
    {
        return $this->hasOne('App\Models\Catalog\Product', 'id', 'id_product');
    }
}
