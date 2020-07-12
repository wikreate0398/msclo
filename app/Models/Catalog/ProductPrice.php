<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
	public $timestamps = false;

	protected $table = 'catalog_prices';

	protected $fillable = [
	    'id_product',
	    'price',
        'quantity'
    ];

	protected $casts = [
	  'quantity' => 'integer'
    ];

    public function product()
    {
        return $this->hasOne('App\Models\Catalog\Product', 'id', 'id_product');
    }
}
