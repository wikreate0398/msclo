<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class CatalogPrice extends Model
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
}
