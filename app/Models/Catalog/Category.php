<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\OrderingTrait;
use App\Models\Traits\PermisionTrait;

class Category extends Model
{
	use OrderingTrait, PermisionTrait;
	
	public $timestamps = false;

	protected $table = 'categories';

	protected $fillable = [
        'name_ru', 
        'name_en',
        'parent_id'
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Catalog\Product', 'id_category', 'id')->orderByPageUp()->visible();
    }

    public function childs()
    {
        return $this->hasMany('App\Models\Catalog\Category', 'parent_id', 'id')->orderByPageUp()->withCount('products');
    }

	public function scopeGetWithProducts($query)
    {
        return $query->with('products')->has('products')->get();
    }
}
